<?php
class user
{
	var $db;
	var $tpl;
	var $page;
	function user()
	{
		global $db;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	
	function get_cominfo($uid)
	{
		session_start();
		global $buid,$config;$right=array();
		include($config['webroot']."/config/usergroup.php");
		//------------------user info----------
		$sql="select 
		a.company,a.user,a.contact,a.ifpay,a.regtime,a.tel,a.fax,a.country,a.province,a.city,a.addr,a.userid,b.flag 
		from ".USER." a left join ".COUNTRY." b on a.country=b.id WHERE  a.userid='$uid'";
		$this->db->query($sql);
		$cominfo=$this->db->fetchRow();
		//-------------------user rank logo-----	
		$cominfo['time_long']=date("Y")-substr($cominfo['regtime'],0,4)+1;
		$cominfo['grouplogo']=empty($group[$cominfo['ifpay']]['minilogo'])?$group[$cominfo['ifpay']]['name']:'<img src=\''.$group[$cominfo['ifpay']]['minilogo'].'\'>';
		//-------------------user gongshang-------
		$sql="select statu from ".BUSINESS." where userid='$uid'";
		$this->db->query($sql);
		$cominfo['business']=$this->db->fetchField('statu');
		//-------------------user qq,msn,skype-----
		$sql="select qq,msn,skype,position,mobile from ".ALLUSER." where userid='$uid'";
		$this->db->query($sql);
		$cominfo=@array_merge($this->db->fetchRow(),$cominfo);
		return $cominfo;
	}
	function get_user_detail($id)
	{
		if(empty($id)) return NULL;
			
		global $config;$catname=NULL;$catv=array();

		$sql="select * from ".USER." WHERE userid='$id'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		$catinfo=explode(",",$re['catid']);
		foreach($catinfo as $v)
		{
			$re['catinfo'][]=$this->get_cat_name($v);
		}
		$ifpay=empty($re['ifpay'])?2:$re['ifpay'];
		include($config['webroot']."/config/usergroup.php");
		$medallog=empty($group[$ifpay]['logo'])?$config['weburl']."/image/default/nopic.gif":$group[$ifpay]['logo'];
		$re['medal']="<img src=".$medallog." />";
		$re['rank']=$group[$ifpay]['name'];
		$re['modeu']=$group[$ifpay]['modeu'];
		return $re;
	}
	function user_shopurl($uid="")
	{
		global $buid;
		$sql="select * from ".UDOMIN." where  userid='$buid'";
		$this->db->query($sql);
        $re=$this->db->fetchRow();
		return $re['domin'];
	}
	function get_cat_name($id)
	{
		if(is_numeric($id))
		{
			global $db;
			$sql="SELECT catid,cat FROM ".COMPANYCAT." WHERE catid='$id'";
			$this->db->query($sql);
			$re=$this->db->fetchRow();
			return $re;
		}
	}
	function update_user()
	{
		global $config,$buid;$catid=NULL;$ssql=NULL;
		if(!empty($_POST['right_category_id']))
		{
			$catid=implode(",",$_POST['right_category_id']);
			$catid=",".$catid.",";
		}
		if(is_uploaded_file($_FILES['pic']['tmp_name']))
		{	
			$pn=time();
			$save_directory = $config['webroot']."/uploadfile/userimg/";
			makethumb($_FILES['pic']['tmp_name'] , $save_directory.$pn.".jpg" , 200 , 200);
			$logo=$pn.".jpg";
			$ssql=" ,logo='$logo'";
		}
		//--------------------------------------
		$this->db->query("select userid from ".USER." where userid='$buid'");
		$uid=$this->db->fetchField('userid');
		if(!empty($uid))
		{
			$sql="UPDATE ".USER." SET 
			company='$_POST[company]',contact='$_POST[contact]',tel='$_POST[tel]',fax='$_POST[fax]',zip='$_POST[zip]',
			province='$_POST[province]',addr='$_POST[addr]',city='$_POST[city]',url='$_POST[url]',ctype='$_POST[ctype]',catid='$catid',main_pro='$_POST[main_pro]',staff_num='$_POST[staff_num]',turnover='$_POST[turnover]',registered_capital='$_POST[registered_capital]' $ssql
			WHERE userid='$buid'";
			$re=$this->db->query($sql);
			
		}
		else
		{
			$pont=$point_config['point']=='1'?$point_config['reg_user']:0;
			$sql="insert into ".USER."
			(company,contact,tel,fax,zip,province,addr,city,url,ctype,userid,country,catid,logo,point,registered_capital)
			VALUES
			('$_POST[company]','$_POST[contact]','$_POST[tel]','$_POST[fax]','$_POST[zip]','$_POST[province]','$_POST[addr]','$_POST[city]',
			'$_POST[url]','$_POST[ctype]','$buid','$_POST[country]','$catid','$logo',$pont,'$_POST[registered_capital]')";
			$re=$this->db->query($sql);
			foreach($_POST['right_category_id'] as $v)
			{
				update_cat_nums($v,'add','com');
			}
		}
		return $re;
	}
	
	function update_user_info()
	{
		global $buid,$config;
		$this->db->query("select userid from ".UDETAIL." where userid='$buid' and type='$_POST[type]'");
		$uid=$this->db->fetchField('userid');
		if($uid)
			$sql="update ".UDETAIL." set intro='$_POST[intro]',logo='$_POST[logo]' where userid='$buid' and type='$_POST[type]'";
		else
			$sql="insert into ".UDETAIL." (userid,intro,type,logo) values ('$buid','$_POST[intro]','$_POST[type]','$_POST[logo]')";
		$re=$this->db->query($sql);
		
	}
	
	function get_user_info($buid,$type)
	{
		global $config;
		$this->db->query("select * from ".UDETAIL." where userid='$buid' and type='$type'");
		$de=$this->db->fetchRow();
		//===============================
		$BasePath = "lib/fckeditor/";
		include($config['webroot']."/$BasePath/fckeditor.php");	
		$fck_en = new FCKeditor('intro') ;
		if($config['language']=='cn')
			$fck_en->Config['DefaultLanguage']='zh-cn';
		else
			$fck_en->Config['DefaultLanguage']='en';
		$fck_en->BasePath    = $BasePath ;
		$fck_en->ToolbarSet  = 'frant' ;
		$fck_en->Width='100%';
		$fck_en->Height=500;
		$fck_en->Config['ToolbarStartExpanded'] = true;
		$fck_en->Value = stripslashes($de['intro']);
		$de['intro'] = $fck_en->CreateHtml();
		//=================================
		return $de;
	}

}
?>
