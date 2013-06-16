<?php
	
	$par = @unserialize(@base64_decode(@$argv[1]));
	if(!$par)  die('no par'."\n");
	$cat1name = $par[0];
	$cat2name = $par[1];
	$url = $par[2];
	
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
	$db = new dbMySQLi('localhost', 'u0998209_eko', 'eko', 'u0998209_ekolobok', 'utf8');
	
	require('translit.php');
	
	while($url) {
		echo $url."\n";
		$s = $f->fetchs('http://www.neobroker.ru'.$url);
		$s = str_replace('&nbsp;', ' ', $s);
		$pq = phpQuery::newDocument($s);
		$cats3 = $pq->find('table.new-goods > tr > td > h3 > a[href]');
		foreach($cats3 as $cat3) {
			$cat3name = trim(pq($cat3)->text());
			$cat3url = pq($cat3)->attr('href');
			$s = $f->fetchs('http://www.neobroker.ru'.$cat3url);
			$s = str_replace('&nbsp;', ' ', $s);
			$pq2 = phpQuery::newDocument($s);
			$prods = $pq2->find('div.cont > table.comment > tr > td.comment > p > b > a');
			foreach($prods as $prod) {
				$title = trim(pq($prod)->text());
				$desc = trim(pq($prod)->parent()->parent()->next()->html());
				if(preg_match('#<b>\s*Описание:\s*</b>(.+)<br>#Usi', $desc, $m)) {
					$desc = mb_convert_encoding(trim($m[1]), 'UTF-8', 'CP1251');
				} else {
					$desc = false;
				}
				$org = trim(pq($prod)->parent()->parent()->parent()->next()->children('table.tov_group_table')->children('tr:first-child')->children('td')->html());
				if(preg_match('#<b>Поставщик:</b> <a href="([^"]+)" onclick=".+">(.+)</a>#Usi', $org, $m)) {
					$orgsite = mb_convert_encoding(trim($m[1]), 'UTF-8', 'CP1251');
					$orgtitle = mb_convert_encoding(trim($m[2]), 'UTF-8', 'CP1251');
				} else {
					$orgsite = false;
					$orgtitle = false;
				}
				$orgdesc = trim(pq($prod)->parent()->parent()->parent()->next()->children('table.tov_group_table')->children('tr:first-child')->children('td')->children('p:last-child')->text());
				$orgreg = trim(pq($prod)->parent()->parent()->parent()->next()->children('table.tov_group_table')->children('tr:nth-child(2)')->children('td:nth-child(2)')->text());
				unset($prod);
				$user_id = $db->Fetch1('SELECT `userid` FROM `b2bbuilder_user` WHERE `user`=%s AND `company`=%s AND `url`=%s', translit($orgtitle), $orgtitle, $orgsite);
				if(!$user_id) {
					$cat1_id = $db->Fetch1('SELECT `catid` FROM `b2bbuilder_user_cat` WHERE `cat`=%s AND LENGTH(`catid`)=4', $cat1name);
					if(!$cat1_id) {
						$cat1_id = intval($db->Fetch1('SELECT MAX(`catid`)+1 FROM `b2bbuilder_user_cat` WHERE LENGTH(`catid`)=4'));
						if(!$cat1_id) $cat1_id = 1000;
						$db->Insert('b2bbuilder_user_cat', array(
							'catid' => $cat1_id,
							'cat' => $cat1name,
							'isindex' => '1'
						));
						$cat1_id = $db->InsertID();
					}
					
					$cat2_id = $db->Fetch1('SELECT `catid` FROM `b2bbuilder_user_cat` WHERE `cat`=%s AND LENGTH(`catid`)=6 AND SUBSTRING(`catid`,1,4)=%s', $cat2name, $cat1_id);
					if(!$cat2_id) {
						$cat2_id = intval($db->Fetch1('SELECT MAX(`catid`)+1 FROM `b2bbuilder_user_cat` WHERE LENGTH(`catid`)=6 AND SUBSTRING(`catid`,1,4)=%s', $cat1_id));
						if(!$cat2_id) $cat2_id = $cat1_id.'01';
						$db->Insert('b2bbuilder_user_cat', array(
							'catid' => $cat2_id,
							'cat' => $cat2name,
							'isindex' => '1'
						));
						$cat2_id = $db->InsertID();
					}
					
					$province = $db->GetOrCreate('b2bbuilder_province', 'province_id', array('province'=>$orgreg, 'country_id'=>'183'));
					$db->Insert('b2bbuilder_user_all', array(
						'user' => translit($orgtitle)
					));
					$user_id = $db->InsertID();
					$db->Insert('b2bbuilder_user', array(
						'userid' => $user_id,
						'user' => translit($orgtitle),
						'company' => $orgtitle,
						'country' => '183',
						'province' => $orgreg,
						'url' => $orgsite,
						'ctype' => $cat2name,
						'ifpay' => '1',
						'catid' => ','.$cat2_id.',',
					));
					$db->Insert('b2bbuilder_user_detail', array(
						'userid' => $user_id,
						'intro' => $desc,
						'type' => 1,
						'logo' => ''
					));
					$db->Insert('b2bbuilder_user_link', array(
						'userid' => $user_id,
						'link_name' => $orgtitle,
						'link_url' => $orgsite,
						'link_con' => $orgsite,
					));
				}
				
				$cat1_id = $db->Fetch1('SELECT `catid` FROM `b2bbuilder_product_cat` WHERE `cat`=%s AND LENGTH(`catid`)=4', $cat1name);
				if(!$cat1_id) {
					$cat1_id = intval($db->Fetch1('SELECT MAX(`catid`)+1 FROM `b2bbuilder_product_cat` WHERE LENGTH(`catid`)=4'));
					if(!$cat1_id) $cat1_id = 1000;
					$db->Insert('b2bbuilder_product_cat', array(
						'catid' => $cat1_id,
						'cat' => $cat1name,
						'isindex' => '1'
					));
					$cat1_id = $db->InsertID();
				}
				
				$cat2_id = $db->Fetch1('SELECT `catid` FROM `b2bbuilder_product_cat` WHERE `cat`=%s AND LENGTH(`catid`)=6 AND SUBSTRING(`catid`,1,4)=%s', $cat2name, $cat1_id);
				if(!$cat2_id) {
					$cat2_id = intval($db->Fetch1('SELECT MAX(`catid`)+1 FROM `b2bbuilder_product_cat` WHERE LENGTH(`catid`)=6 AND SUBSTRING(`catid`,1,4)=%s', $cat1_id));
					if(!$cat2_id) $cat2_id = $cat1_id.'01';
					$db->Insert('b2bbuilder_product_cat', array(
						'catid' => $cat2_id,
						'cat' => $cat2name,
						'isindex' => '1'
					));
					$cat2_id = $db->InsertID();
				}
				
				$cat3_id = $db->Fetch1('SELECT `catid` FROM `b2bbuilder_product_cat` WHERE `cat`=%s AND LENGTH(`catid`)=8 AND SUBSTRING(`catid`,1,6)=%s', $cat3name, $cat2_id);
				if(!$cat3_id) {
					$cat3_id = intval($db->Fetch1('SELECT MAX(`catid`)+1 FROM `b2bbuilder_product_cat` WHERE LENGTH(`catid`)=8 AND SUBSTRING(`catid`,1,6)=%s', $cat2_id));
					if(!$cat3_id) $cat3_id = $cat2_id.'01';
					$db->Insert('b2bbuilder_product_cat', array(
						'catid' => $cat3_id,
						'cat' => $cat3name,
						'isindex' => '1'
					));
					$cat3_id = $db->InsertID();
				}
				
				if(!$db->Fetch1('SELECT COUNT(1) FROM `b2bbuilder_offer` WHERE `userid`=%d AND `catid`=%d AND `title`=%s', $user_id, $cat3_id, $title)) {
					$db->Insert('b2bbuilder_offer', array(
						'userid' => $user_id,
						'catid' => $cat3_id,
						'type' => '1',
						'title' => $title,
						'valid_time' => '6',
						'con' => $desc,
						'statu' => 0,
						'country' => '183',
						'province' => $orgreg,
					));
				}
				
				/*if(!$db->Fetch1('SELECT COUNT(1) FROM `b2bbuilder_products` WHERE `userid`=%d AND `catid`=%d AND `pname`=%s', $user_id, $cat3_id, $title)) {
					$db->Insert('b2bbuilder_products', array(
						'userid'=>$user_id,
						'catid'=>$cat3_id,
						'pname'=>$title,
						'user'=>$db->Fetch1('SELECT `user` FROM `b2bbuilder_user` WHERE `userid`=%d', $user_id),
						'ifpay'=>4,
						'statu'=>0
					));
					$prod_id = $db->InsertID();
					
					$db->Insert('b2bbuilder_product_detail', array(
						'userid'=>$user_id,
						'proid'=>$prod_id,
						'detail'=>$desc,
					));
				}*/
				
			} unset($prod, $prods);
			$pq2->unloadDocument(); unset($pq2);
			unset($cat3);
		}
		unset($cats3, $cat3);
		$pq->unloadDocument(); unset($pq);
		if(preg_match('#<span class="pages_title">Другие страницы с товарами:</span>.+<b>\d+</b>\s+<a href="(/list/[^/]+/n\d+\.html)" class=wu>\d+</a>#Usi', $s, $m)) {
			$url = $m[1];
		} else {
			$url = false;
		}
	}
	
?>