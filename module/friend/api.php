<?php
include_once("$config[webroot]/module/offer/includes/plugin_friend_class.php");

class friend_apid extends friend
{
	function friend_apid()
	{
		parent::friend();
	}
	
	function update_uid($array)
	{	
		$this->friend_merge_user($array);
	}
}
?>