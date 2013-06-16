<?php
	include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
	include_once("$config[webroot]/module/product/lang/".$config['language']."/admin_product.php");
	include_once("$config[webroot]/module/product/includes/plugin_pro_class.php");

	$pro=new pro();
	if($buid){
		$tpl->assign("get_user_common_cat",$pro->get_user_common_cat($buid));
	}

	//##ajax============================
	if(!empty($_GET['oper'])&&$_GET['oper']=='ajax')
	{
		switch($_GET['call'])
		{
			case 'search_cate':
				if(!empty($_POST['key_word'])){
					$wsql = NULL;
					$catlist = array();
					$key_words = explode(',',str_replace(' ','',$_POST['key_word']));

					if($key_words!=null){
						foreach($key_words as $word)
						{
							if($word!=''){
								$word = addslashes( $word );
								$wsql[] =" ( cat like '%$word%' OR keyword like '%$word%' )";
							}
						}
						if($wsql!=NULL){
							$wsql = implode(' or ',$wsql);
							$sql = "select catid from ".PCAT." where $wsql order by catid desc limit 0,10";
							$db->query($sql);
							
							while( $c = $db->fetchRow())
							{
								$vc = array();
								$v = $c['catid'];
								$vc[]=substr($v,0,4);
								if(strlen($v)>4)
									$vc[]=substr($v,0,6);
								if(strlen($v)>6)
									$vc[]=substr($v,0,8);
								if(strlen($v)>8)
									$vc[]=$v;
								$catlist[] = array( $v,implode(",",$vc) );
							}
						}
					}

					if($catlist!=null)
					{
						foreach($catlist as $key)
						{
							$cats[$key[0]] = $pro->getProTypeName($key[1]);
						}
					}
					echo json_encode($cats);

				}
				break;
			case 'get_cate':
				if(!empty($_POST['catid'])){
					$catid = $_POST['catid'];
					$cat['cat']='';
					$cat['brand']='';

					$vc[]=substr($catid,0,4);
					$pactidlist = substr($catid,0,4);
					if(strlen($catid)>4)
					{
						$vc[]=substr($catid,0,6);
						$pactidlist.= ",".substr($catid,0,6);
					}
					if(strlen($catid)>6){
						$vc[]=substr($catid,0,8);
						$pactidlist.= ",".substr($catid,0,8);
					}
					if(strlen($catid)>8){
						$vc[]=$catid;
						$pactidlist.= ",".$catid;
					}
					$catlist = implode(",",$vc);
					$cat['cat'] = $pro->getProTypeName( $catlist );

					include_once("$config[webroot]/module/product/includes/plugin_add_field_class.php");
					$addfield = new AddField();
					$cat['firstvalue'] = @implode('',$addfield->addfieldinput(0,$pactidlist));
					$cat['brand'] = $pro->get_brand($pactidlist);
					echo json_encode($cat);
				}
				break;
		}
		die();
	}
	//==================================================
	$sql="select * from ".PCAT." where catid<9999 order by nums asc";
	$db->query($sql);
	$re=$db->getRows();
	$tpl->assign("cat",$re);
	$tpl->assign("config",$config);
	$tpl->assign("lang",$lang);

	tplfetch("cate_show_ajax.htm",null,true);
?>