<?php
class hr
{
	var $db;
	var $tpl;
	var $page;
	function hr()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
		$this -> cTime	= date("Y-m-d H:i:s");
	}
	
	function hrcat()
	{
		$sql="select * from ".HRCAT." where pid=0 order by posid";
		$this->db->query($sql);
		$re=$this->db->getRows();
		return $re;
	}
	
	
	function add_resume()
	{
		global $buid;
		$p=$_POST;
		if(empty($p['scatid']))
			$p['scatid']=0;
		
		$utel=$_POST['utel1'].'-'.$_POST['utel2'];
		$edu=implodearr($_POST['enum'],'edu');
		$work=implodearr($_POST['wnum'],'work');
		$language=$_POST['language1'].','.$_POST['language2'].','. $_POST['language3'];
		
		
		$sql="insert into ".RESUME."
		(userid,name,catid,scatid,degree,discipline,language,job_type,salary,experience_years,experience_detail,detail,situation,statu,time,uname,uphone,utel,umail,uage,uaddress,usex,aaddress,education)
		values
		('$buid','$p[name]','$p[catid]','$p[scatid]','$p[degree]','$p[discipline]','$language','$p[job_type]','$p[salary]','$p[experience_years]','$work','$p[detail]','$p[situation]','$p[statu]','".$this->cTime."','$_POST[uname]','$_POST[uphone]','$utel','$_POST[umail]','$_POST[uage]','$_POST[uaddress]','$_POST[usex]','$_POST[aaddress]','$edu')";
		$this->db->query($sql);
	
	}
	
	
	function edit_resume()
	{
		global $buid;
		$p=$_POST;
		if(empty($p['scatid']))
			$p['scatid']=0;
		$utel=$_POST['utel1'].'-'.$_POST['utel2'];
		$edu=implodearr($_POST['enum'],'edu');
		$work=implodearr($_POST['wnum'],'work');
		$language=$_POST['language1'].','.$_POST['language2'].','. $_POST['language3'];
		$sql="UPDATE ".RESUME." SET name='$p[name]',catid='$p[catid]',scatid='$p[scatid]',degree='$p[degree]',discipline='$p[discipline]',language='$language',job_type='$p[job_type]',salary='$p[salary]',experience_years='$p[experience_years]',experience_detail='$work',detail='$p[detail]',situation='$p[situation]',statu='$p[statu]',uname='$_POST[uname]',uphone='$_POST[uphone]',utel='$utel',umail='$_POST[umail]',uage='$_POST[uage]',uaddress='$_POST[uaddress]',usex='$_POST[usex]',aaddress='$_POST[aaddress]',education='$edu'
		WHERE 
			rid='$_POST[editID]'";
		
		$re=$this->db->query($sql);
		if($re)
			msg("main.php?action=m&m=job&s=admin_resume_list&menu=user");
	}
	function admin_resume_list($userid=NULL)
	{
		global $buid;
		if(!empty($userid))
			$buid=$userid;
		$sql="select a.*,b.catname from ".RESUME." a left join ".HRCAT." b on b.id=a.catid where a.userid='$buid' order by a.time desc";
		//=============================
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",20";
		//==============================
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
		$re["page"]=$page->prompt();
		return $re;
	}
	
	function resume_detail($id)
	{
		global $config;
		$sql="select * from ".RESUME." where rid='$id'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		
		$re['education']=explodearr($re['education']);
		$re['experience_detail']=explodearr($re['experience_detail']);
	    $re['utel']=explode("-", $re['utel']);
		$re['language']=explode(",", $re['language']);
		#################################
		$BasePath = "lib/fckeditor/";
		include($BasePath."fckeditor.php");	
		$fck_en = new FCKeditor('detail') ;
		$fck_en->BasePath    = $BasePath ;
		$fck_en->ToolbarSet  = 'B2Bbuilder' ;
		$fck_en->Width='99%';
		$fck_en->Height=300;
		$fck_en->Value = stripslashes($re["detail"]);
		$re["detail"] = $fck_en->CreateHtml();
		#####################
		return $re;
	}
	function del_resume($id)
	{
		if($id)
		{
			$sql="delete from ".RESUME." where rid='$id'";
			$this->db->query($sql);
		}
	}
	//------------------------
	function add_hr()
	{
		global $buid;
		$_POST['valid']=empty($_POST['valid'])?30:$_POST['valid'];
		if(empty($_POST['scatid']))
			$_POST['scatid']=0;
		$sql="insert into ".ZP." 
		(userid,user,catid,scatid,title,money,num,con,uptime,valid,properties,sex,year,degree,language,age) 
		values 
		('$buid','$_COOKIE[USER]','$_POST[catid]','$_POST[scatid]','$_POST[name]','$_POST[money]','$_POST[num]','$_POST[con]','$this->cTime','$_POST[valid]','$_POST[properties]','$_POST[sex]','$_POST[year]','$_POST[degree]','$_POST[language]','$_POST[age]')";
		$re=$this->db->query($sql);
		include("config/point_config.php");
		if($point_config['point']=='1'&&$point_config['pub_job']!='0')
			renew_point('',$point_config['pub_job']);
		if($re)
			msg("main.php?action=m&m=job&s=admin_job_list&menu=usershop");
	}
	function edit_hr()
	{
		$_POST['valid']=empty($_POST['valid'])?30:$_POST['valid'];
		if(empty($_POST['scatid']))
			$_POST['scatid']=0;
		$sql="UPDATE ".ZP." 
		SET 
			title='$_POST[name]',con='$_POST[con]',catid='$_POST[catid]',scatid='$_POST[scatid]',money='$_POST[money]',num='$_POST[num]',valid='$_POST[valid]',properties='$_POST[properties]',sex='$_POST[sex]',year='$_POST[year]',degree='$_POST[degree]',language='$_POST[language]',age='$_POST[age]'
		WHERE 
			id='$_POST[editID]'";
		$re=$this->db->query($sql);
		if($re)
			msg("main.php?action=m&m=job&s=admin_job_list&menu=usershop");
	}
	function admin_hr_list($userid=NULL)
	{
		global $buid;
		if(!empty($userid))
			$buid=$userid;
		$sql="select id,title,valid,uptime from ".ZP." where userid='$buid' order by uptime desc";
		//=============================
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",20";
		//=====================
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
		$re["page"]=$page->prompt();
		return $re;
	}
	function update_hr($id)
	{
		if($id)
		{
			$sql="update ".ZP." SET uptime='$this->cTime' where id=$id";
			$this->db->query($sql);
		}
	}
	function del_hr($id)
	{
		if($id)
		{
			$sql="delete from ".ZP." where id='$id'";
			$this->db->query($sql);
			include("config/point_config.php");
			if($point_config['point']=='1'&&!empty($point_config['del_job']))
				renew_point('',$point_config['del_job']);
		}
	}
	function hr_detail($id)
	{
		if($id)
		{
			global $config;
			$sql="select * from ".ZP." where id='$id'";
			$this->db->query($sql);
			$re=$this->db->fetchRow();
			#################################
			$BasePath = "lib/fckeditor/";
			include($BasePath."fckeditor.php");	
			$fck_en = new FCKeditor('con') ;
			$fck_en->BasePath    = $BasePath ;
			$fck_en->ToolbarSet  = 'B2Bbuilder' ;
			$fck_en->Width='100%';
			$fck_en->Height=500;
			$fck_en->Config['ToolbarStartExpanded'] = false;
			$fck_en->Value = stripslashes($re["con"]);
			$re["con"] = $fck_en->CreateHtml();
			#####################
			return $re;
		}
	}
	function hr_shop_detail($id)
	{
		global $config;
		$this->db->query("SELECT * FROM ".ZP." WHERE id='$id'");
		$re=$this->db->fetchRow();
		$mn=$re['money'];
		$cid=$re['catid'];
		$sql="select catname from ".HRCAT." where id=".$cid;
		$this->db->query($sql);
		$re['catid']=$this->db->fetchField('catname');
		include_once("module/job/lang/".$config['language']."/lang_hr_config.php");
		$re['money']=$hrmoney[$mn];
		return $re;
	}

	function admin_rbox_list($userid=NULL)
	{
		global $buid;
		if(!empty($userid))
			$buid=$userid;
			
		//$sql="select * from ".ZP." b left join  ".RBOX." a on a.jid = b.id where b.userid='$buid' order by uptime desc";
		$sql="select id,title,uptime,valid from ".ZP." where userid='$buid'";
		//=============================
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",20";
		//=====================
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
		foreach($re["list"] as $k=>$val){  
			$sql1="select * from ".RBOX." where jid=$val[id]";	/*$this->db->query($sql);
			$res=$this->db->getRows();
			$re["list"][$k]['box']=$res;	*/
			$this->db->query($sql1);
			$re["list"][$k]['anum']=$this->db->num_rows();
			
			$sql=$sql1." and isfeekback=1";
			$this->db->query($sql);
			$re["list"][$k]['fnum']=$this->db->num_rows();
			
			$sql=$sql1." and islook=1";
			$this->db->query($sql);
			$re["list"][$k]['lnum']=$this->db->num_rows();
		}
		$re["page"]=$page->prompt();
		return $re;
	}
    function admin_resumebox_list($userid=NULL)
	{
		global $buid;
		if(!empty($userid))
			$buid=$userid;
	    if($_GET['jid']=="0")
		{
			$sql="select id from ".ZP." where userid='$buid'";
		    $this->db->query($sql);
			$re=$this->db->getRows();
			foreach($re as $k=>$val){ 
			   $str.=$val['id'].',';
			}
			$sqlstr="jid in (".$str."0)";
		}
		else
			$sqlstr="jid = $_GET[jid]";
			
		if(!empty($_POST['state']))
		{
			if($_POST['state']==2)
			$sqlstr.=' and islook=0';
			else if($_POST['state']==3)
			$sqlstr.=' and islook=1';
			if($_POST['state']==4)
			$sqlstr.=' and isfeekback=0';
			if($_POST['state']==5)
			$sqlstr.=' and isfeekback=1';
		}	
		if($_POST['degree']!="-1" and !empty($_POST['degree']))
		{
			$sqlstr.=' and degree='.($_POST['degree']-1);
		}
		if($_POST['sex']!="-1" and !empty($_POST['sex']))
		{
			$sqlstr.=' and usex='.$_POST['sex'];
		}
		$sql="select * from ".RESUME." b left join  ".RBOX." a on a.rid = b.rid where $sqlstr order by a.time desc";
		$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",20";
		//=====================
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
		$re["page"]=$page->prompt();
		return $re;
	}
	function del_rbid($id)
	{
		if($id)
		{
			$sql="delete from ".RBOX." where rbid='$id'";
			$this->db->query($sql);
			msg("main.php?action=m&m=job&s=admin_resume_inbox&menu=usershop&jid=0");
		}
	}
	//========================
	function hr_merge_user($array)
	{
		$old_uid=$array['old_uid'];
		$new_uid=$array['new_uid'];

		$sql = "update ".ZP." set userid='$new_uid' where userid='$old_uid'";
		$this->db->query($sql);
		$sql = "update ".RESUME." set userid='$new_uid' where userid='$old_uid'";
		$this->db->query($sql);
	}

}

function explodearr($str)
{
	$arr=explode("|", $str);
	foreach($arr as $k=>$val){  
		$arr[$k]=@explode(",", $val);
	}
	return $arr;
}

function implodearr($num,$arr)
{ 
   for($i=1;$i<=$num;$i++){
	  $str=$arr.$i;
	  $value=@implode(",",$_POST[$str]);
	  if(!empty($arr)){
		  if($val==""){
			 $val=$value;
		  }
		  else{
			 $val=$val."|".$value;
		  }
 	 }
   }
   return $val;
}
?>
