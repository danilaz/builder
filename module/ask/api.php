<?php
include("$config[webroot]/module/ask/includes/plugin_question_class.php");

class ask_api extends question
{
	function ask_api()
	{	
		parent::question();
	}
	
	function update_uid($array)
	{	
		$this->question_merge_user($array);
	}
}
?>