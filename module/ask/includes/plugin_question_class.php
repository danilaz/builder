<?php
class question
{
	var $db;
	var $tpl;
	var $page;
	function question()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	function ask_list($uid='')
	{	
			global $buid;
			$sql="select a.*,b.cat from ".QUESTION." a left join ".PCAT." b on a.catid=b.catid where userid='".$buid."' order by  a.uptime desc";
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
			$rs["lists"]=$this->db->getRows();
			$rs["pages"]=$page->prompt();
			return $rs;
	}
	function question_merge_user($array)
	{
		$old_uid=$array['old_uid'];
		$new_uid=$array['new_uid'];

		$sql = "update ".QUESTION." set userid='$new_uid' where userid='$old_uid'";
		$this->db->query($sql);
		$sql = "update ".ANSWER." set userid='$new_uid' where userid='$old_uid'";
		$this->db->query($sql);
	}
}
?>
