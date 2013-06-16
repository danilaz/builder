<?php
include("$config[webroot]/module/job/includes/plugin_hr_class.php");

class job_api extends hr
{
	function job_api()
	{
		parent::hr();
	}
	
	function update_uid($array)
	{	
		$this->hr_merge_user($array);
	}
}
?>