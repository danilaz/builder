<?php
$lang_ext = array(
	'alipay'=>'Alipay',
	'alipay_desc' => 'Alipay website(www.alipay.com) is a leading online platform for payment. You need to sign with Alipay company before you can use it.',
	'alipay_account' => 'Alipay account',
    'alipay_key' => 'Transaction security verification code',
	'alipay_partner_id' => 'Cooperator ID',
	'alipay_interface' => 'Select connection type',
	'alipay_interface_options' => array(
		'0' => 'Use standard double connections',
		'1' => 'Use assurance trade connection',
		'2' => 'Use instant payment collection connection',),
);

$lang = array_merge($lang, $lang_ext);
?>