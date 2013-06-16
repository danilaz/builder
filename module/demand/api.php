<?php
include_once("$config[webroot]/module/demand/includes/demand_class.php");

class demand_api extends demand
{
	function demand_api()
	{
		parent::demand();
	}
	
	function update_uid($array)
	{	
		$this->demand_merge_user($array);
	}
}
?>