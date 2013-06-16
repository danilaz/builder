<?php
class pro
{
	var $db;
	var $tpl;
	var $page;
	function pro()
	{
		global $db;
		global $config;
		global $point_config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
		$this -> cTime  = date("Y-m-d H:i:s");
		if(!empty($_POST))
		{
			include_once($config['webroot'].'/includes/filter_class.php');
			$word=new Text_Filter();
			$_POST['con']=$word->wordsFilter($_POST['con'], $matche_row);
			$_POST['detail']=$word->wordsFilter($_POST['detail'], $matche_row);
			$_POST['title']=$word->wordsFilter($_POST['title'], $matche_row);
		}
	}
	function get_brand($id,$sbrand=NULL)
	{
		//------------------------------------------------------------
		$id=explode(",",$id);
		if(!empty($id[2]))
			$this->db->query("SELECT brand FROM ".PCAT." WHERE catid='$id[2]'");
		$brand=$this->db->fetchField('brand');
		
		if(empty($brand)&&!empty($id[1]))
		{
			$this->db->query("SELECT brand FROM ".PCAT." WHERE catid='".$id[1]."'");
			$brand=$this->db->fetchField('brand');
		}
		if(empty($brand)&&!empty($id[0]))
		{
			$this->db->query("SELECT brand FROM ".PCAT." WHERE catid='".$id[0]."'");
			$brand=$this->db->fetchField('brand');
		}
		if(!empty($brand))
		{
			$sql="select * from ".BRAND." where id in ($brand) order by nums asc ";
			$this->db->query($sql);
			$re=$this->db->getRows();
			$op=NULL;
			foreach($re as $v)
			{
				if($v['name']==$sbrand)
					$s='selected="selected"';
				else
					$s=NULL;
				$op.='<option '.$s.' value="'.$v["name"].'">'.$v["name"].'</option>';
			}
			return '<select  name="pinpai" id="pinpai"  style="width:133px;" />'.$op.'</select>';
		}
		else
			return '<input maxlength="20" type="text" name="pinpai" style="width:170px;" value="'.$sbrand.'" />';
	}
	function getProTypeName($prod)
	{
			$sql = "select cat from ".PCAT." where catid in($prod)";
			$this->db->query($sql);
			$fieldlist="";
			while($v=$this->db->fetchRow()){
				if($v["cat"]!="")
				$fieldlist.=$v["cat"]."->";
			}
			$fieldlist = trim($fieldlist,"->");
			return $fieldlist;
	}
	function get_user_common_cat($id)
	{
		$cats=array();
		$sql="select id,common_cat from ".SHOPSETTING." where userid='$id'";
		$this->db->query($sql);
		$rec=$this->db->fetchRow();
		if(!empty($rec['id']))
		{
			$cat=explode(",",$rec['common_cat']);
			foreach($cat as $v)
			{
				$vc=array();
				if(!empty($v))
				{
					$vc[]=substr($v,0,4);
					if(strlen($v)>4)
						$vc[]=substr($v,0,6);
					if(strlen($v)>6)
						$vc[]=substr($v,0,8);
					if(strlen($v)>8)
						$vc[]=$v;
					$key=implode(",",$vc);
					$cats[$key]=$this->getProTypeName($key);
				}
			}
			return $cats;
		}
		else
			return array();
	}
	function get_user_common_lower_cat()
	{
		if(!empty($_GET['cat']))
		{
			$sql="select pid from ".CUSTOM_CAT." where userid='$_GET[uid]' and type='1' and id='$_GET[cat]' order by nums asc";
			$this->db->query($sql);
			$pid=$this->db->fetchField('pid');
			if($pid!='0')
				$num=$pid;
			else
				$num=$_GET['cat'];
			$sql="select * from ".CUSTOM_CAT." where userid='$_GET[uid]' and type='1' and pid='$num' order by nums asc";
			$this->db->query($sql);
			$re=$this->db->getRows();
			return $re;
		}
	}
	function add_user_common_cat($cid)
	{
		global $buid;
		//-------------------
		$cid=explode(",",$cid);
		$id=$cid[0];
		if(!empty($cid[1]))
			$id=$cid[1];
		if(!empty($cid[2]))
			$id=$cid[2];
		if(!empty($cid[3]))
			$id=$cid[3];
		$sql="select id from ".SHOPSETTING." where userid='$buid'";
		$this->db->query($sql);
		$rec=$this->db->fetchRow();
		if($rec['id'])
			$sql="update ".SHOPSETTING." set common_cat=REPLACE(common_cat,',$id',''),common_cat=concat(common_cat,',$id') where userid='$buid'";
		else
			$sql="insert into ".SHOPSETTING." (userid,rec_pro,common_cat) values ('$buid','',',$id')";
		$re=$this->db->query($sql);
	}
	function get_user_rec($id)
	{
		$sql="select id,rec_pro from ".SHOPSETTING." where userid='$id'";
		$this->db->query($sql);
		$rec=$this->db->fetchRow();
		if(!empty($rec['id']))
			return explode(",",$rec['rec_pro']);
		else
			return array();
	}
	function rec_pro($id,$type)
	{
		global $buid,$config;
		if($type=='rec')
		{	@session_start();
			//------------------
			include($config['webroot']."/config/usergroup.php");
			$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
			$my_group=$group[$ifpay]['modeu'];
			//-------------------
			$rec=$this->get_user_rec($buid);
			$rec=count($rec);
			if($rec<$my_group['rec_pro']+1)
			{
				if($rec>0)
					$sql="update ".SHOPSETTING." set rec_pro=REPLACE(rec_pro,',$id',''),rec_pro=concat(rec_pro,',$id') where userid='$buid'";
				else
					$sql="insert into ".SHOPSETTING." (userid,rec_pro,common_cat) values ('$buid',',$id','')";
				$re=$this->db->query($sql);
				if($re)
					return 1;
				else
					return 0;
			}
			else
				return 2;//超数量了
		}
		else
		{
			$sql="update ".SHOPSETTING." set rec_pro=REPLACE(rec_pro,',$id','') where userid='$buid'";
			$re=$this->db->query($sql);
			if($re)
				return 1;
			else
				return 0;
		}
	}
	function add_pro()
	{	
		global $config,$buid;
		$pactidlist="";
		include_once("$config[webroot]/includes/tag_inc.php");
		#============================过滤<a
		include($config['webroot']."/config/usergroup.php");
		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
		$my_group=$group[$ifpay]['modeu'];
		if($my_group['replace_outside_link']==1)
		{
			$_POST["con"]=replace_outside_link($_POST["con"]);
			$_POST["detail"]=replace_outside_link($_POST["detail"]);
		}
		#================================
		$title=htmlspecialchars($_POST["title"]);
		if(empty($_POST['con']))
		   $con=substr(strip_tags($_POST["detail"]),0,100);
		else
		   $con=htmlspecialchars($_POST["con"]);
		$freight=implode(",",$_POST['freight']);
		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
		if($_POST['stime_type']==1)
			$stime=time();
		elseif($_POST['stime_type']==2)
			$stime=strtotime($_POST['stime']);
		else
			$stime=NULL;
		
		$catid=$_POST['catid'];
		$pactidlist=$_POST['catid'];
		if(!empty($_POST['tcatid'])){
			$catid=$_POST['tcatid'];
			$pactidlist.= ",".$_POST['tcatid'];
		}
		if(!empty($_POST['scatid'])){
			$catid=$_POST['scatid'];
			$pactidlist.=",".$_POST['scatid'];
		}
		if(!empty($_POST['sscatid'])){
			$catid=$_POST['sscatid'];
			$pactidlist.=",".$_POST['sscatid'];
		}
		if(!empty($catid)&&!empty($title)&&!empty($con))
			$sql="INSERT INTO ".PRO." 
				(userid,user,catid,pname,gg,pp,price,unit,con,uptime,statu,trade_type,pic,maintenance,invoice,stime_type,stime,validTime,freight_type,freight,province,city,amount,ptype,ifpay,keywords,model) 
			VALUES
				('$buid','$_COOKIE[USER]','$catid','$title',
			'$_POST[gg]','$_POST[pinpai]','$_POST[price]','$_POST[unit]','$con','$this->cTime','$my_group[proCheck]','$_POST[trade_type]','$_POST[pic]'
			,'$_POST[maintenance]','$_POST[invoice]','$_POST[stime_type]','$stime','$_POST[validTime]','$_POST[freight_type]','$freight','$_POST[province]','$_POST[city]','$_POST[amount]','$_POST[ptype]','$ifpay','$_POST[keyword]','$_POST[model]'
			)";
		else
			die("Empty contents");
		$re=$this->db->query($sql);
		$id=$this->db->lastid();
		add_tags($_POST['keyword'],1,$id);
		$re=$this->db->query("INSERT INTO ".PRODETAIL." (userid,proid,detail) VALUES ('$buid','$id','$_POST[detail]')");
		update_cat_nums($catid,'add','pro');
		if($_POST['rec_pro']==1)
			$this->rec_pro($id,'rec');
			
		if($_POST['custom_cat'])
		{
			$sql="insert into ".CUSTOM_CAT_REL." (custom_cat_id,custom_cat_type,relating_id) values 
			('$_POST[custom_cat]','1','$id')";
			$re=$this->db->query($sql);
		}
		if(!empty($_POST['pic']))
		{	
			$ar=explode(",",$_POST['pic']);
			$source = $config['webroot']."/uploadfile/zsimg/".$ar[0].".jpg";
			$source1 = $config['webroot']."/uploadfile/zsimg/size_small/".$ar[0].".jpg";
			$save_directory = $config['webroot']."/uploadfile/comimg";
			copy($source, $save_directory."/big/".$id.".jpg");
			copy($source1, $save_directory."/small/".$id.".jpg");
		}
		
		//**************************************新加字段值
		$sql = "select catid,cat_add_field from ".PCAT." where catid in(".$pactidlist.")";
		$this->db->query($sql);
		$reArray = array();
		$reI=0;
		$pro_extend_sql = "insert into ".PROEXTEND."(protypeid,productid,fieldid,fieldvalue) values ";
		$invalue="";
		while($resaddfield=$this->db->fetchRow())
		{
		   $reArray[]= $resaddfield;//['cat_add_field'];
		}
		foreach($reArray as $key => $value){
			if(trim($value["cat_add_field"])!=""){
				$sqls = "select id,catName,displayType from ".EXTENDFILE." where id in(".$value['cat_add_field'].") and IsDisplay=1";
				$this->db->query($sqls);
				while($fieldlist=$this->db->fetchRow()){
						if($fieldlist['displayType']=="5"){	
							$getvalue = implode(",",$_POST[$fieldlist['catName']]);
						}else{
							$getvalue =	$_POST[$fieldlist['catName']];
						}
					   $invalue .=  "('".$value['catid']."','".$id."','".$fieldlist['id']."','".$getvalue."'),";
				}
			}
		}
		if(strlen($invalue)>0){
			$pro_extend_sql .= trim($invalue,",").";";
			$this->db->query($pro_extend_sql);
		}
		//**************************************************
		include("$config[webroot]/config/point_config.php");
		if($point_config['point']=='1'&&$point_config['add_product']!='0')
			renew_point('',$point_config['add_product']);
		return $re;
	}

	function add_product_batch()
	{	
		global $config,$buid,$admin;
		include($config['webroot']."/includes/tag_inc.php");
		include($config['webroot']."/includes/point_inc.php");
		include($config['webroot']."/config/usergroup.php");
		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
		$my_group=$group[$ifpay]['modeu'];
		
		setlocale(LC_ALL, 'en_US.UTF-8');
		$fname = $config['webroot']."/uploadfile/preview/".$buid.".csv"; 
		$do = copy($_FILES['csv']['tmp_name'],$fname);
		$content = file_get_contents($fname);
		//echo $content; 
		$content = iconv("windows-1251","UTF-8//IGNORE",$content);
		$fp = fopen($fname, "w");
		fputs($fp, $content);
		fclose($fp);

		$sql="";
		$num=1;
		$file = fopen($fname,"r");
		//print_r($file);
		$catid=$_POST['catid'];
		if(!empty($_POST['tcatid']))
			$catid=$_POST['tcatid'];
		if(!empty($_POST['scatid']))
			$catid=$_POST['scatid'];
		while ($data = fgetcsv ($file, 2000, ",")) {
			if($num!=1){
			//print_r($data);
				$admin->check_access('pro');
				add_point(1,$buid);
				$sql="INSERT INTO ".PRO." (catid,userid,user,pname,gg,pp,price,unit,con,uptime,statu,ifpay) 
					VALUES
	 					('$catid','$buid','$_COOKIE[USER]','$data[0]','$data[4]','$data[3]','$data[1]','$data[2]','$data[6]','$this->cTime','$my_group[proCheck]','$ifpay')";
				$this->db->query($sql);
				$id=$this->db->lastid();
				$sql="INSERT INTO ".PRODETAIL." (userid,proid,detail) VALUES ('$buid','$id','$data[7]')";
				$re=$this->db->query($sql);
				add_tags($data[5],1,$id);
			}
			$num++;
		}
		fclose($file);
		@unlink($fname);
	}

	function edit_pro()
	{
		global $config,$buid;
		include_once("$config[webroot]/includes/tag_inc.php");
		$title=htmlspecialchars($_POST["title"]);
		$freight=implode(",",$_POST['freight']);
		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
		if($_POST['stime_type']==1)
			$stime=time();
		elseif($_POST['stime_type']==2)
			$stime=strtotime($_POST['stime']);
		else
			$stime=NULL;
		$catid=$_POST['catid'];
		$pactidlist= $_POST['catid'];
		$id=$_POST["editID"];
		
		if(!empty($_POST['tcatid'])){
			$catid=$_POST['tcatid'];
			$pactidlist.= ",".$_POST['tcatid'];
		}
		if(!empty($_POST['scatid'])){
			$catid=$_POST['scatid'];
			$pactidlist.= ",".$_POST['scatid'];
		}
		if(!empty($_POST['sscatid'])){
			$catid=$_POST['sscatid'];
			$pactidlist.= ",".$_POST['sscatid'];
		}	
		#过滤<a
		include($config['webroot']."/config/usergroup.php");
		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
		$my_group=$group[$ifpay]['modeu'];
		if($my_group['replace_outside_link']==1)
		{
			$_POST["con"]=replace_outside_link($_POST["con"]);
			$_POST["detail"]=replace_outside_link($_POST["detail"]);
		}
		#过滤<a
		$sql="UPDATE ".PRO."  SET
			pname='$title',gg='$_POST[gg]',catid='$catid',
			pp='$_POST[pinpai]',price='$_POST[price]',unit='$_POST[unit]',con='$_POST[con]',
			uptime='$this->cTime',trade_type='$_POST[trade_type]',pic='$_POST[pic]'
			,maintenance='$_POST[maintenance]',invoice='$_POST[invoice]',stime_type='$_POST[stime_type]',stime='$stime',validTime='$_POST[validTime]',freight_type='$_POST[freight_type]',freight='$freight',province='$_POST[province]',city='$_POST[city]',amount='$_POST[amount]',ptype='$_POST[ptype]',ifpay='$ifpay',keywords='$_POST[keyword]',model='$_POST[model]',statu='0'
		WHERE id=$id and userid='$buid'";
		$re=$this->db->query($sql);
		$sql="select proid from ".PRODETAIL." where proid='$id'";
		$this->db->query($sql);
		if($this->db->num_rows())
			$re=$this->db->query("UPDATE ".PRODETAIL." SET detail='$_POST[detail]' WHERE proid='$id'");
		else
			$re=$this->db->query("INSERT INTO ".PRODETAIL." (userid,proid,detail) VALUES ('$buid','$id','$_POST[detail]')");
		
		edit_tags($_POST['keyword'],1,$id);

		if(!empty($_POST['rec_pro'])&&$_POST['rec_pro']==1)
			$this->rec_pro($id,'rec');
		else
			$this->rec_pro($id,NULL);
		
		$sql="delete from  ".CUSTOM_CAT_REL." where relating_id=$id and custom_cat_type=1";//delete
		$this->db->query($sql);		
		if($_POST['custom_cat'])
		{
			$sql="insert into ".CUSTOM_CAT_REL." (custom_cat_id,custom_cat_type,relating_id) values 
			('$_POST[custom_cat]','1','$id')";
			$re=$this->db->query($sql);
		}		
		
		//*************************************新加数据的更新
		$delsql = "delete from ".PROEXTEND." where productid='".$id."' and protypeid not in (".$pactidlist.")";
		$this->db->query($delsql);
		if(!empty($_POST['addfieldhid']))
		{
			$updatefield = trim($_POST['addfieldhid'],",");
			if(strlen($updatefield)>0){
				$updatearray = explode(",",$updatefield);
				foreach($updatearray as $vs){
					$updatelist = explode("|",$vs);
					if($updatelist[1]=="5"){	
						$getvalue = implode(",",$_POST[$updatelist[0]]);
					}else{
						$getvalue =	$_POST[$updatelist[0]];
					}
					$upfieldsql="update ".PROEXTEND." set fieldvalue='".$getvalue."' where productid='".$id."' and fieldid='".$updatelist[3]."' and protypeid='".$updatelist[2]."'";
					
					$this->db->query("select count(id) as num from ".PROEXTEND."  where productid='".$id."' and fieldid='".$updatelist[3]."' and protypeid='".$updatelist[2]."'");
					$num=$this->db->fetchRow();
					if($num['num']>=1){
						$this->db->query($upfieldsql);
					}else{
						$pro_sql = "insert into ".PROEXTEND."(protypeid,productid,fieldid,fieldvalue) values ";
						$pro_sql .="('".$updatelist[2]."','".$id."','".$updatelist[3]."','".$getvalue."')";
						$this->db->query($pro_sql);					
					}
				}
			}
		}else{
			//**************************************新加字段值
			$sql = "select catid,cat_add_field from ".PCAT." where catid in(".$pactidlist.")";
			$this->db->query($sql);
			$reArray = array();
			$reI=0;
			$pro_extend_sql = "insert into ".PROEXTEND."(protypeid,productid,fieldid,fieldvalue) values ";
			$invalue="";
			while($resaddfield=$this->db->fetchRow())
			{
			   $reArray[]= $resaddfield;//['cat_add_field'];
			}
			if($reArray!=null){
				foreach($reArray as $key => $value){
					if(trim($value["cat_add_field"])!=""){
						$sqls = "select id,catName,displayType from ".EXTENDFILE." where id in(".$value['cat_add_field'].") and IsDisplay=1";
						$this->db->query($sqls);
						while($fieldlist=$this->db->fetchRow()){
								if($fieldlist['displayType']=="5"){	
									$getvalue = implode(",",$_POST[$fieldlist['catName']]);
								}else{
									$getvalue =	$_POST[$fieldlist['catName']];
								}
							   $invalue .=  "('".$value['catid']."','".$id."','".$fieldlist['id']."','".$getvalue."'),";
						}
					}
				}
				if(strlen($invalue)>0){
					$pro_extend_sql .= trim($invalue,",").";";
					$this->db->query($pro_extend_sql);
				}
			}
		}
		//**************************************************
		if(!empty($_POST['pic']))
		{	
			$ar=explode(",",$_POST['pic']);
			if($ar[0]>0)
			{
				$source = $config['webroot']."/uploadfile/zsimg/".$ar[0].".jpg";
				$source1 = $config['webroot']."/uploadfile/zsimg/size_small/".$ar[0].".jpg";
			}
			else
			{
				$source = $config['webroot']."/uploadfile/zsimg/".$ar[1].".jpg";
				$source1 = $config['webroot']."/uploadfile/zsimg/size_small/".$ar[1].".jpg";
			}
			$save_directory = $config['webroot']."/uploadfile/comimg";
			@copy($source, $save_directory."/big/".$id.".jpg");
			@copy($source1, $save_directory."/small/".$id.".jpg");
		}
		else
		{	
			$save_directory = $config['webroot']."/uploadfile/comimg";
			@unlink($save_directory."/big/".$id.".jpg");
			@unlink($save_directory."/small/".$id.".jpg");
		}
		return $re;
	}
	function pro_list()
	{
		global $buid,$config;
		$sql="select id,pname,uptime,pic,statu from ".PRO." where userid='$buid' order by uptime desc";
		//=============================
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query("select count(id) as num from ".PRO." where userid='$buid'");
			$num=$this->db->fetchRow();
			$page->totalRows = $num['num'];
		}
        $sql .= "  limit ".$page->firstRow.",20";
		//=====================
		$this->db->query($sql);
		while($pl=$this->db->fetchRow())
		{
			if(!file_exists("$config[webroot]/uploadfile/comimg/small/$pl[id].jpg"))
				$pl['nopic']=1;
			$re["list"][]=$pl;
		}
		$re["page"]=$page->prompt();
		return $re;
	}
	function update_pro($id)
	{
		global $buid,$config;
		if($id=="all")
		{
			include("$config[webroot]/config/point_config.php");
			if($point_config['point']=='1'&&$point_config['renew_product']!='0')
				renew_point('',$point_config['renew_product']);
			$sql="update ".PRO." SET uptime='$this->cTime' where userid='$buid'";
		}
		else
			$sql="update ".PRO." SET uptime='$this->cTime' where id=$id";
		$this->db->query($sql);
		
	}
	function del_pro($id)
	{
		global $config,$buid;
		
		include_once("$config[webroot]/includes/tag_inc.php");
		del_tag($id,1);
		include("$config[webroot]/config/point_config.php");
		if($point_config['point']=='1'&&$point_config['del_product']!='0')
			renew_point('',$point_config['del_product']);

		$this->db->query("select catid from ".PRO." where id='$id'");
		$re=$this->db->fetchRow();
		update_cat_nums($re['catid'],'del','pro');

		$this->db->query("delete from  ".PRO." where id='$id'");
		$this->db->query("delete from  ".PRODETAIL." where proid='$id'");
		$this->db->query("delete from  ".CUSTOM_CAT_REL." where relating_id=$id and custom_cat_type=1");
		//-------------------------------------
		$sql="update ".SHOPSETTING." set common_cat=REPLACE(common_cat,',$id','') where userid='$buid'";
		$this->db->query($sql);
		//*************************************新加数据的删除
		$this->db->query("delete from ".PROEXTEND." where productid='".$id."'");
		//****************************************
		@unlink($config['webroot']."/uploadfile/comimg/big/$id.jpg");
		@unlink($config['webroot']."/uploadfile/comimg/small/$id.jpg");
	}
	function pro_detail($id)
	{
		if($id)
		{	
			global $config,$buid;
			include_once("$config[webroot]/includes/tag_inc.php");
			$sql="select a.*,b.detail from ".PRO." a left join ".PRODETAIL." b on a.id=b.proid where a.id=$id and a.userid='$buid'";
			$this->db->query($sql);
			$re=$this->db->fetchRow();
			if(file_exists("uploadfile/comimg/small/$re[id].jpg"))
				$re['nopic']=0;
			else
				$re['nopic']=1;
				
			if(strlen($re['catid'])>8)
				$re['sscatid']=$re['catid'];
			if(strlen($re['catid'])>6)
				$re['scatid']=substr($re['catid'],0,8);	
			if(strlen($re['catid'])>4)
				$re['tcatid']=substr($re['catid'],0,6);
			$re['catid']=substr($re['catid'],0,4);
			$re['freight']=explode(",",$re['freight']);
			$re['rec_pro']=in_array($id,$this->get_user_rec($buid));
			
			$sql="select custom_cat_id from ".CUSTOM_CAT_REL." where relating_id='$id' and custom_cat_type=1";
			$this->db->query($sql);
			$re['custom_cat_id'] =$this->db->fetchField('custom_cat_id');
			//=====================================
			$BasePath = "lib/fckeditor/";
			include($config['webroot'].'/'.$BasePath."fckeditor.php");	
			$fck_en = new FCKeditor('detail') ;
			if($config['language']=='cn')
				$fck_en->Config['DefaultLanguage']='zh-cn';
			else
				$fck_en->Config['DefaultLanguage']='en';
			$fck_en->BasePath    = $BasePath ;
			$fck_en->ToolbarSet  = 'frant' ;
			$fck_en->Width='100%';
			$fck_en->Height=500;
			$fck_en->Config['ToolbarStartExpanded'] = true;
			$fck_en->Value = stripslashes($re['detail']);
			$re["detail"] = $fck_en->CreateHtml();
			$re['keyword']=get_tags($id,1);
			//======================================
			return $re;
		}
	}
	//==============================
	function product_detail($pid)
	{
		global $buid,$config;
		$days=array('7','15','30','90','180','365');
		$sql="update ".PRO." set read_nums=read_nums+1 where id='$pid'";
		$this->db->query($sql);
		$sql="select a.*,b.detail from ".PRO." a left join ".PRODETAIL." b on a.id=b.proid where a.id='$pid'";
		$this->db->query($sql);
		$prod=$this->db->fetchRow();
		if(empty($prod['validTime']))
			$prod['validTime']=2;
		if($prod['validTime']==6)
			$prod['have_time']=6;
		else
			$prod['have_time']=strtotime($prod['uptime'])+$days[$prod['validTime']]*24*3600-time();
		$prod['freight']=explode(",",$prod['freight']);		
		if(!empty($prod['pic']))
			$prod['pic']=explode(",",$prod['pic']);
		//=======产品类型============
		include($config['webroot']."/lang/".$config['language']."/company_type_config.php");
		$prod["trade_type"]=$trade_type[$prod['trade_type']];
		$prod["ptype"]=$ptype[$prod['ptype']];
		return $prod;
	}
	//=========该公司产品,$type==1是显示最新的,$limit显示记录数【产品详情页面】===============
	function company_other_product($uid,$type=NULL,$limit=NULL)
	{
		if(!empty($limit))
			$sub_sql="limit 0,$limit";
		else
			$sub_sql='';
		if($type=='1')
			$sql="select pname,price,userid,user,id from ".PRO." where userid='$uid' order by id desc $sub_sql";
		else
			$sql="select pname,price,userid,user,id from ".PRO." where userid='$uid' $sub_sql";
		$this->db->query($sql);
		$comrelpro=$this->db->getRows();
		return $comrelpro;
	}
	//=========同类产品===============
	function same_cat_product($catid,$num=10)
	{
		if(!empty($_POST['province']))
			$subsql=" and a.province='$_POST[province]'";
		$sql="select a.pname,a.price,a.pic,a.id,a.user,a.userid,a.unit,a.province,b.company,b.tel from ".PRO." a left join ".USER." b on a.userid=b.userid where 
			  a.catid='$catid' $subsql order by a.statu ,a.rank desc limit $num";		
		$this->db->query($sql);
		$samepro=$this->db->getRows();
		foreach($samepro as $k=>$v)
		{
			$samepro[$k]['pic']=explode(",",$v['pic']);
		}
		return $samepro;
	}
	
		
	function shop_pro_list()
	{
		global $config;
		if(!empty($_GET['cat']))
		{	
			$sql="select id from ".CUSTOM_CAT." where userid='$_GET[uid]' and type='1' and pid='".$_GET['cat']."' order by nums asc";
			$this->db->query($sql);
			$de=$this->db->getRows();
			$cats=$_GET['cat'];
			foreach($de as $val)
			{
				if($val['id'])
				$cats=$cats.','.$val['id'];
			}
			
			$sql="select a.id,a.pname,a.userid,a.price,a.user from ".PRO." a, ".CUSTOM_CAT_REL." b 
				 where a.userid='$_GET[uid]' and a.statu>0 and a.id=b.relating_id and b.custom_cat_type=1 and b.custom_cat_id in ($cats) order by uptime desc";
		}
		else
			$sql="select id,userid,pname,con,uptime,price,unit,user from ".PRO." where userid='$_GET[uid]' and statu>0 order by id desc";
		//-------------------------------------------------
		include_once($config['webroot']."/includes/page_utf_class.php");
		$page = new Page;
		$page->url='shop.php';
		$page->listRows=12;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
		$sql .= "  limit ".$page->firstRow.", ".$page->listRows;
		$infoList['page']=$page->prompt();
		//--------------------------------------------------
		$this->db->query($sql);
		while($pl=$this->db->fetchRow())
		{
			if(!file_exists("$config[webroot]/uploadfile/comimg/small/$pl[id].jpg"))
				$pl['nopic']=1;
			$infoList["list"][]=$pl;
		}
		return $infoList;
	}

	function get_user_home_pro()
	{
		global $config;
		$sql="select rec_pro from ".SHOPSETTING." where userid='$_GET[uid]'";
		$this->db->query($sql);
		$rec=$this->db->fetchField('rec_pro');
		if(!empty($rec))
		{
			$rec=substr($rec,1,strlen($rec));
			$sql="select id,pname,price from ".PRO." where statu>0 and id in ($rec) order by uptime desc";
			$this ->db ->query($sql);
			$re=$this ->db ->getRows();
			return $re;
		}
	}
	//*********************merge**************************
	function pro_merge_user($array)
	{
		$old_uid=$array['old_uid'];
		$new_uid=$array['new_uid'];
		$new_user=$array['new_user'];

		$sql = "update ".PRO." set userid='$new_uid' where userid='$old_uid'";
		$this->db->query($sql);
		$sql = "update ".PRODETAIL." set userid='$new_uid' where userid='$old_uid'";
		$this->db->query($sql);
		$sql = "update ".ORDER." set buid=IF(buid='$old_uid','$new_uid',buid),suid=IF(suid='$old_uid','$new_uid', suid)   where buid='$old_uid' or suid='$old_uid'";
		$this->db->query($sql);
	}
	
}
?>
