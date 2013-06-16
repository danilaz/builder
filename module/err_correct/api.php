<?php
include_once("$config[webroot]/module/err_correct/includes/correct_class.php");

class err_correct_api extends correct
{
	function err_correct_api()
	{
		parent::correct();
	}
	
	function update_uid($array)
	{	
		$this->correct_merge_user($array);
	}
}
?>