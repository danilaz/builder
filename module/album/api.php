<?php
include("$config[webroot]/module/album/includes/plugin_album_class.php");

class album_api extends album
{
	function album_api()
	{
		parent::album();
	}
	
	function update_uid($array)
	{	
		$this->album_merge_user($array);
	}
}
?>