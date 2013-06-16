<?php
class tradealter
{
	var $db;
	var $tpl;
	var $page;
	function tradealter()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	
	function email_list($uid='')
	{
		$sql="select email from ".ALLUSER." where userid='$uid'";
		$this->db->query($sql);
		$rs=$this->db->fetchRow();
		return $rs;
	}
	function list_subscribe($id="")
	{
		global $buid;
		if(empty($id))
		{
			$sql="select * from ".SUBSCRIBE." where userid='$buid' order by uptime desc";
			$this->db->query($sql);
			$re=$this->db->getRows();
		}
		else
		{
			$sql="select * from ".SUBSCRIBE." where id='$id'";
			$this->db->query($sql);
			$re=$this->db->fetchRow();
		}
		return $re;
	}
	function up_subscribe($sid='')
	{
		global $buid;
		if(!empty($sid)){
			$nt=time();
			$sql="update ".SUBSCRIBE." set keywords='$_POST[keycon]',ktype='$_POST[ktype]',validity='$_POST[validity]',frequency='$_POST[frequency]',uptime='$nt' where id='$sid'";
			$this->db->query($sql);
		}
		else
		{	
			$nt=time();
			$sql="insert into ".SUBSCRIBE." (userid,keywords,ktype,validity,frequency,uptime) values ( '$buid','$_POST[keycon]','$_POST[ktype]','$_POST[validity]','$_POST[frequency]','$nt')";
			$this->db->query($sql);
			include("config/point_config.php");
			if($point_config['point']=='1'&&$point_config['sub_scribe']!='0')
			renew_point('',$point_config['sub_scribe']);
		}
	}
	function delete_subscribe($did="")
	{
		global $buid;
		$sql="delete  from ".SUBSCRIBE." where  id='$did'";
		$this->db->query($sql);
	}
}
?>
