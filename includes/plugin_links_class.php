<?php
class links
{
	var $db;
	var $tpl;
	var $page;
	function links()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	
	function add_link()
	{
		global $buid;
		$sql="insert into ".ULINK." 
		(userid,link_name,link_url,link_con,num) 
		 VALUES
		('$buid','$_POST[link_name]','$_POST[link_url]','$_POST[link_con]','$_POST[num]')";
		return $this->db->query($sql);
	}
	function link_list()
	{
		global $buid;
		$sql="SELECT * FROM 
			  	".ULINK." 
			  WHERE 
			  	userid='$buid' order by num asc";
		$this->db->query($sql);
		return $this->db->getRows();
	}
	function del_link($id)
	{
		global $buid;
		$sql="delete from ".ULINK." WHERE link_id='$id' and userid='$buid'";
		$this->db->query($sql);
	}

}
?>
