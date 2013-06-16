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
	$f->ref = 'http://www.neobroker.ru/org/';
	$f->cookies_process(false, true);
	$f->cookies['www.neobroker.ru']['page_cook']='150';
	
	require('class.MySQLi.php');
	$db = new dbMySQLi('localhost', 'ekolobok', 'zJ8kgqPS', 'ekolobok', 'utf8');
	
	require('translit.php');
	
	$f->fetchs('http://www.neobroker.ru/org/');
	$pq = phpQuery::newDocument($f->fetchs('http://www.neobroker.ru/org/'));
	$cats = $pq->find('div.cont > div.c3 > div[class*=col] > ol > li[value] > a[href*=org].price_list_vid_mas');
	foreach($cats as $cat) {
		$catname = trim(pq($cat)->text());
		$cat_id = $db->Fetch1('SELECT `catid` FROM `b2bbuilder_user_cat` WHERE `cat`=%s AND LENGTH(`catid`)=4', $catname);
		if(!$cat_id) {
			$cat_id = intval($db->Fetch1('SELECT MAX(`catid`)+1 FROM `b2bbuilder_user_cat` WHERE LENGTH(`catid`)=4'));
			if(!$cat_id)  $cat_id = 1000;
			$db->Insert('b2bbuilder_user_cat', array(
				'catid' => $cat_id,
				'cat' => $catname,
				'isindex' => '1'
			));
			$cat_id = $db->InsertID();
		}
		$caturl = trim(pq($cat)->attr('href'));
		while($caturl) {
			echo $caturl."\n";
			$s = $f->fetchs('http://www.neobroker.ru'.$caturl);
			$s = str_replace('&nbsp;', ' ', $s);
			$pq2 = phpQuery::newDocument($s);
			$orgs = $pq2->find('table.new-goods > tr > td > h3 > a[href]');
			foreach($orgs as $org) {
				$name = trim(pq($org)->text());
				$site = trim(pq($org)->attr('href'));
				$logo = trim(pq($org)->prev('img[src*="img-org"]')->attr('src'));
				if($logo)  $logo = 'http://www.neobroker.ru'.$logo;
				$desc = trim(pq($org)->parent()->next('p')->html());
				$desc = str_replace('<b><a href="/docs/index_what.html" target="_blank">Индекс доверия:</a></b>', '', $desc);
				$desc = preg_replace('#<span class="stars_num">[^<]+</span>#', '', $desc);
				$desc = trim(strip_tags($desc));
				$desc = mb_convert_encoding($desc, 'UTF-8', 'CP1251');
				$region = trim(pq($org)->parent()->parent()->next('td')->children('a[target="_blank"]')->text());
				
				$province = $db->GetOrCreate('b2bbuilder_province', 'province_id', array('province'=>$region, 'country_id'=>'183'));
				
				if(!$db->Fetch1('SELECT COUNT(1) FROM `b2bbuilder_user` WHERE `user`=%s AND `company`=%s AND `catid`=%s', translit($name), $name, ','.$cat_id.',')) {
					
					$db->Insert('b2bbuilder_user_all', array(
						'user' => translit($name)
					));
					$user_id = $db->InsertID();
					if($logo) {
						$i = @imagecreatefromstring($f->fetchs($logo));
						if($i) {
							$logof = '../uploadfile/logo/'.$user_id.'.jpg';
							imagejpeg($i, $logof, 88);
							$logo = 'http://ekolobok.com/uploadfile/logo/'.$user_id.'.jpg';
						}
						imagedestroy($i); unset($i);
					}
					
					$db->Insert('b2bbuilder_user', array(
						'userid' => $user_id,
						'user' => translit($name),
						'company' => $name,
						'country' => '183',
						'province' => $region,
						'url' => $site,
						'ctype' => $catname,
						'ifpay' => '1',
						'catid' => ','.$cat_id.',',
					));
					
					$db->Insert('b2bbuilder_user_detail', array(
						'userid' => $user_id,
						'intro' => $desc,
						'type' => 1,
						'logo' => $logo
					));
					
					$db->Insert('b2bbuilder_user_link', array(
						'userid' => $user_id,
						'link_name' => $name,
						'link_url' => $site,
						'link_con' => $site,
					));
					
				}
				
				unset($org);
			} unset($org, $orgs);
			$pq2->unloadDocument(); unset($pq2);
			if(preg_match('#<span class="pages_title">Другие страницы с новыми компаниями:</span>.+<b>\d+</b>\s+<a href="(/org/[^/]+/n\d+\.html)" class=wu>\d+</a>#Usi', $s, $m)) {
				$caturl = $m[1];
			} else {
				$caturl = false;
			}
		}
		unset($cat);
		
	} unset($cat, $cats);
	$pq->unloadDocument(); unset($pq);
	
?>
