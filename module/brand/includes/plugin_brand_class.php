<?php
class brand
{
	var $db;
	var $tpl;
	var $page;
	function brand()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	function brand_list()
	{	
		if(!empty($_GET['province']))
		{
			if($_GET['province']=='another')
				$sql.=" and (country!='Китай' and country!='china')";
			else
				$sql.=" and province='$_GET[province]' ";
		}
		if(!empty($_GET['searchby']))
		{
			$sql.=" and char_index='$_GET[searchby]'";
		}
		$sql="select * from ".BRAND." where 1 $sql order by time desc";
		//=============================
		include_once("includes/page_utf_class.php");
		$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
		 $sql .= "  limit ".$page->firstRow.",20";
		//=====================
		$this->db->query($sql);
		$rs["lists"]=$this->db->getRows();
		$rs["pages"]=$page->prompt();
		return $rs;
	}
	function brand_content($id)
	{
	  $sql="select * from ".BRAND." where id=".$id;
	  $this->db->query($sql);
	  $rs=$this->db->fetchRow();
	  return $rs;
	}
	
	function add_brand()
	{
		global $config,$buid;
		include_once($config['webroot'].'/lib/allchar.php');
		
		if($config['language']=='cn')
			$sql="select cname as name from ".COUNTRY." where id='$_POST[country]'";
		else
			$sql="select ename as name from ".COUNTRY." where id='$_POST[country]'";
		$this->db->query($sql);		
		$country=$this->db->fetchField('name');	
		$province=$_POST['province'];
		$city=$_POST['city'];
		if(empty($province) and empty($city))
		{
			$province=$_POST['province1'];
			$city=$_POST['city1'];
		}
		$str=c(trim($_POST['name']));
		$fstr=substr($str,0,1);
		
		$sql="insert into ".BRAND." 
		(name,con,pic,company,tel,statu,url,country,province,city,time,inner_url,uid,char_index,char_all) values 
		('$_POST[name]','".$_POST['con']."','".$_POST['pic']."','".$_POST['company']."',
		'".$_POST['tel']."','0','$_POST[url]','$country','$province','$city','".time()."','$_POST[inner_url]','$buid','$fstr','$str')";	
		$re=$this->db->query($sql);
		return $re;
	}
	
	function admin_brand_list()
	{	
		global $buid;
		$sql="select * from ".BRAND." where uid='$buid' order by time desc";
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
	
	function del_brand($deid)
	{
		$sql="delete from ".BRAND." where id='$deid'";
		$this->db->query($sql);
	}
	
	function brand_detail()
	{
		global $config;
		$sql="select * from ".BRAND." where id='$_GET[edit]'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		if($config['language']=='cn')
			$sql="select id from ".COUNTRY." where cname='$re[country]'";
		else
			$sql="select id from ".COUNTRY." where ename='$re[country]'";
		$this->db->query($sql);
			
		$re['country']=$this->db->fetchField('id');	
		//===============================
		$BasePath = "lib/fckeditor/";
		include($config['webroot']."/$BasePath/fckeditor.php");	
		$fck_en = new FCKeditor('con') ;
		$fck_en->BasePath    = $BasePath ;
		$fck_en->ToolbarSet  = 'frant' ;
		$fck_en->Width='100%';
		$fck_en->Height=500;
		$fck_en->Config['ToolbarStartExpanded'] = true;
		$fck_en->Value = stripslashes($re['con']);
		$re['con'] = $fck_en->CreateHtml();
	
		//=================================
		return $re;
	}
	
	function edit_brand()
	{
		global $config;
		include_once($config['webroot'].'/lib/allchar.php');
		
		if($config['language']=='cn')
			$sql="select cname as name from ".COUNTRY." where id='$_POST[country]'";
		else
			$sql="select ename as name from ".COUNTRY." where id='$_POST[country]'";
		$this->db->query($sql);		
		$country=$this->db->fetchField('name');	
		$province=$_POST['province'];
		$city=$_POST['city'];
		if(empty($province) and empty($city))
		{
			$province=$_POST['province1'];
			$city=$_POST['city1'];
		}
		$str=c(trim($_POST['name']));
		$fstr=substr($str,0,1);
		
		
		$sql="update ".BRAND." set name='".$_POST['name']."',con='".$_POST['con']."',company='".$_POST['company']."',tel='".$_POST['tel']."',pic='".$_POST['pic']."',statu='0',url='$_POST[url]',country='$country',province='$province',city='$city',time='".time()."',inner_url='$_POST[inner_url]',char_index='$fstr',char_all='$str' where id='".$_POST['editID']."'";
		$re=$this->db->query($sql);
		return $re;
	}
}
?>
