<?php
include_once("$config[webroot]/module/offer/includes/offer_class.php");

class offer_api extends offer
{
	function offer_api()
	{
		parent::offer();
	}
	
	function update_uid($array)
	{	
		$this->offer_merge_user($array);
	}
}
?>