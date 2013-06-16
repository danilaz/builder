<?php
include_once("$config[webroot]/module/video/includes/plugin_video_class.php");

class video_api extends video
{
	function video_api()
	{
		parent::video();
	}
	
	function update_uid($array)
	{	
		$this->video_merge_user($array);
	}
}
?>