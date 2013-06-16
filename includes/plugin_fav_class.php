<?php
class fav
{
	var $db;
	var $tpl;
	var $page;
	function fav()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	
	function add_fav_cat()
	{
		if($_POST["title"])
		{
			global $buid;
			$sql="insert into ".FCAT." (pid,userid,name)
			 VALUES ('$_POST[pid]','$buid','$_POST[title]')";
			$this->db->query($sql);
		}
	}
	function fav_cat_list()
	{
		global $buid;
		$sql="select * from ".FCAT." where pid=0 and userid='$buid'";
		$this->db->query($sql);
		$re=$this->db->getRows();
		return $re;
	}
	function favorite($id="")
	{
		global $buid;
		if(!empty($id))
		{
            $sql="DELETE FROM ".FAVORITE." WHERE id=".$id;
			$this->db->query($sql);
			unset($sql);
		}
		$sql="select id,userid,fromid,type,url,title,picurl,des,FROM_UNIXTIME(uptime) as uptime from ".FAVORITE." where userid=".$buid." order by uptime desc";
		//=============================

	  	$page = new Page;
		$page->listRows=10;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",10";
		//=====================
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
		$re["page"]=$page->prompt();
		return $re;
	}

}
?>
