<?php

if (isset($modules_loading) && $modules_loading == true) {

	$i = isset($modules_list) ? count($modules_list) : 0;

	$modules_list[$i]['payment_name'] = basename(__FILE__, '.php');
	
	$modules_list[$i]['payment_desc'] = 'webmoney_desc';
	
	$modules_list[$i]['payment_commission'] = '1';

	$modules_list[$i]['author'] = 'Chinascript.ru';

	$modules_list[$i]['site'] = 'http://chinascript.ru';

	$modules_list[$i]['version'] = '1.1.0';

	$modules_list[$i]['payment_config'] = array(
		array('name' => 'webmoney_key', 'type' => 'text', 'value' => ''),
		array('name' => 'webmoney_pursez', 'type' => 'text', 'value' => ''),
		array('name' => 'webmoney_purser', 'type' => 'text', 'value' => ''),
		array('name' => 'webmoney_pursee', 'type' => 'text', 'value' => ''),
		array('name' => 'webmoney_purseu', 'type' => 'text', 'value' => ''),
		
	);
}

?>
