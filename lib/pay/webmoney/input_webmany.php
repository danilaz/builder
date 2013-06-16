<?php

include_once("../../../includes/global.php");

$sql="select * from ".ALLUSER." where user='$_POST[USER]'";
$db->query($sql);
$user=$db->fetchRow();
$user=$user['user'];

$sql="select * from ".PAYMENT." where payment_type='webmoney'";
$db->query($sql);
$payment=$db->fetchRow();
$configs['webmoney_commission'] = $payment['payment_commission'];
$payment=unserialize($payment[payment_config]);
foreach($payment as $v) $configs[$v['name']] = $v['value'];

$dom  = new domDocument('1.0','Windows-1251');
if ($dom->load('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d.m.Y'))) {
	$currency = array();
	$valute = $dom->getElementsByTagName('Valute');
	foreach($valute as $val) {
		$v = $val->getElementsByTagName('Value')->item(0)->nodeValue;
		$c = $val->getElementsByTagName('CharCode')->item(0)->nodeValue;
		$currency[$c] = str_replace(',','.',$v);
	}
	$currency['RUR'] = '1';
}

if($_POST['LMI_PAYEE_PURSE'] == $configs['webmoney_purser']) $curr = 'RUR';
elseif($_POST['LMI_PAYEE_PURSE'] == $configs['webmoney_pursez']) $curr = 'USD';
elseif($_POST['LMI_PAYEE_PURSE'] == $configs['webmoney_pursee']) $curr = 'EUR';
elseif($_POST['LMI_PAYEE_PURSE'] == $configs['webmoney_purseu']) $curr = 'UAH';

$amount = $_POST['LMI_PAYMENT_AMOUNT'];
$amount = $amount * $currency[$curr];
$amount = $amount - ($amount/100*$configs['webmoney_commission']);
$amount = (floor($amount*100))/100;

if($_POST['LMI_PREREQUEST'] == 1) {
	if(!isset($user)) {
		echo "ERR: ПОЛЬЗОВАТЕЛЯ $_POST[USER] НЕ СУЩЕСТВУЕТ";
		exit;
	}
	if(!isset($curr)) {
		echo "ERR: НЕВЕРНЫЙ КОШЕЛЕК ПОЛУЧАТЕЛЯ ".$_POST['LMI_PAYEE_PURSE'];
		exit;
	}
	if($amount==0) {
		echo "ERR: НЕВЕРНАЯ СУММА ".$_POST['LMI_PAYMENT_AMOUNT'];
		exit;
	}
	echo "YES";
} else {
	$common_string = $_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].
		$_POST['LMI_MODE'].$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].
		$_POST['LMI_SYS_TRANS_DATE'].$configs[webmoney_key].$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM'];
	$hash = strtoupper(md5($common_string));
	if($hash != $_POST['LMI_HASH']) exit;
	$sql="update ".ALLUSER." SET cash=cash+$amount where user='$_POST[USER]'";
	$db->query($sql);
}
?>
