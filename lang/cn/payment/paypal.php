<?php
$lang_ext = array(
	'paypal'=>'PayPal',
	'paypal_desc' => 'PayPal онлайн платежный шлюз, является мировым лидером, с более чем 71600 тысяч учетных записей пользователей. В PayPal доступно 56 валют (канадский доллар, евро, фунт стерлингов, доллар США, японская иена, австралийский доллар, гонконгский доллар). Сайт: http://www.paypal.com',
	'paypal_account' => 'Merchant Account',
    'paypal_category' => 'Валюта для платежей',
	'paypal_category_options' => array(
		'USD' => 'USD',
		'HKD' => 'HKD',
		'EUR' => 'EUR',
		'HKD' => 'HKD',
		'JPY' => 'JPY',),
);

$lang = array_merge($lang, $lang_ext);
?>