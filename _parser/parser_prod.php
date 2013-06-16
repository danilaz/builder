<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	ini_set('memory_limit', '1024M');
	ini_set('max_execution_time', 0);
	set_time_limit(0);
	ignore_user_abort(true);
	require('phpQuery-onefile.php');
	require('class.Fetcher.php');
	$f = new Fetcher;
	$f->retries_on_error = 1;
	$f->ref = 'http://www.neobroker.ru/list/';
	$f->cookies_process(false, true);
	$f->cookies['www.neobroker.ru']['page_cook']='150';
	
	require('class.MySQLi.php');
	$db = new dbMySQLi('localhost', 'ekolobok', 'zJ8kgqPS', 'ekolobok', 'utf8');
	
	require('translit.php');
	
	echo "load...\n";
	$f->fetchs('http://www.neobroker.ru/list/');
	$pq = phpQuery::newDocument($f->fetchs('http://www.neobroker.ru/list/'));
	$cats = array();
	$cats1 = $pq->find('div.cont#cat_sub > div.c3 > div.c3 > dl[class^=col] > dt > a[href^="#"]');
	foreach($cats1 as $cat1) {
		$cat1name = trim(pq($cat1)->text());
		$cats2 = pq($cat1)->parent()->parent()->children('dd')->children('div')->children('ul')->children('li')->children('a');
		foreach($cats2 as $cat2) {
			$cat2name = trim(pq($cat2)->text());
			$cat2url = pq($cat2)->attr('href');
			$cats[$cat1name][] = array($cat2name, $cat2url);
			unset($cat2);
		} unset($cats2, $cat2);
		unset($cat1);
	} unset($cats1, $cat1);
	$pq->unloadDocument(); unset($pq);
	
	foreach($cats as $cat1name=>$cats2) {
		foreach($cats2 as $cat2) {
			$cat2name = $cat2[0];
			$cat2url = $cat2[1];
			passthru('php parser_prod_cat.php '.escapeshellarg(base64_encode(serialize(array($cat1name, $cat2name, $cat2url)))).' 2>&1');
		}
	}
	
?>
