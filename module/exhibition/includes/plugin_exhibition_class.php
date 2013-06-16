<?php
class exhibition
{
	var $db;
	var $tpl;
	var $page;
	function exhibition()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
		$this -> cTime	= date("Y-m-d");
	}
	
	function add_exhibition()
	{
		global $config,$buid;
		$_POST['stime']=strtotime($_POST['stime']);
		$_POST['etime']=strtotime($_POST['etime']);
		if(is_uploaded_file($_FILES['pic']['tmp_name']))
		{
			$pn=time();
			$save_directory = $config['webroot']."/uploadfile/exhibitimg/".$pn.".jpg";;
			makethumb($_FILES['pic']['tmp_name'],$save_directory,120,120);
		}
		$sql="select company,tel from ".USER." where userid=$buid";
		$this->db->query($sql);
		$re=$this->db->fetchRow($sql);
		
		$sql="INSERT ".EXHIBIT." (stime,etime,country,city,addr,statu,title,con,addTime,is_rec,cat,organizers,contractors,contact,tel,showroom,pic,uid) VALUES('$_POST[stime]','$_POST[etime]','','$_POST[city]','$_POST[addr]','0','$_POST[title]','$_POST[con]','".$this -> cTime."','0','','$_POST[organizers]','$_POST[contractors]','$re[company]','$re[tel]','','$pn','$buid')";
		$this ->db->query($sql);
		msg("main.php?action=m&m=$_GET[m]&s=admin_exhibition_list&menu=$_GET[menu]");
	}
	
	function admin_exhibition_list()
	{
		global $buid;
		$sql="select * from ".EXHIBIT." where uid=$buid order by id desc";
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
	
	function del_exhibition($id)
	{
		$this->db->query("delete from ".EXHIBIT." where id='$id'");
	}
	
	function exhibition_detail($id)
	{
		$sql="select * from ".EXHIBIT." where id=$id";
		$this->db->query($sql);
		$de=$this->db->fetchRow();
		
		$sql="select province from ".PROVINCE." where province_id=(select province_id from ".CITY." where city='$de[city]')";
		$this->db->query($sql);
		$de['province']=$this->db->fetchField('province');
		
		$BasePath = "lib/fckeditor/";
		include($BasePath."fckeditor.php");	
		$fck_en = new FCKeditor('con') ;
		$fck_en->BasePath    = $BasePath ;
		$fck_en->ToolbarSet  = 'frant' ;
		$fck_en->Width='100%';
		$fck_en->Height=500;
		$fck_en->Config['ToolbarStartExpanded'] = true;
		$fck_en->Value = stripslashes($de["con"]);
		$de["con"] = $fck_en->CreateHtml();
		return $de;
	}
	
	function edit_exhibition()
	{
		global $config;
		$_POST['stime']=strtotime($_POST['stime']);
		$_POST['etime']=strtotime($_POST['etime']);
		if(is_uploaded_file($_FILES['pic']['tmp_name']))
		{
			
			$pn=time();
			$save_directory = $config['webroot']."/uploadfile/exhibitimg/".$pn.".jpg";
			makethumb($_FILES['pic']['tmp_name'],$save_directory,120,120);
		}
		else
		{
			if(!empty($_POST['nopic'])&&$_POST['nopic']=='1')
				@unlink($config['webroot']."/uploadfile/exhibitimg/".$_POST['oldpic'].".jpg");
			else
				$pn=$_POST['oldpic'];
		}
		
		$sql="update ".EXHIBIT." SET stime='$_POST[stime]',etime='$_POST[etime]',city='$_POST[city]',addr='$_POST[addr]',statu='0',title='$_POST[title]',is_rec='0',con='$_POST[con]',organizers='$_POST[organizers]',contractors='$_POST[contractors]',pic='$pn' WHERE id='$_POST[editID]'";	
		$this->db->query($sql);
		msg("main.php?action=m&m=$_GET[m]&s=admin_exhibition_list&menu=$_GET[menu]");
	}
}
?>
