<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/product/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/product/includes/plugin_pro_class.php");
$pro=new pro();
$admin->check_access('pro');//检查权限
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
if(!empty($_GET['step']))
{	
	$admin->check_myshop();
	$re=$admin->getCatName(PCAT);
	$tpl->assign("cat",$re);
	
	$tpl->assign("get_user_common_cat",$pro->get_user_common_cat($buid));
	$tpl->assign("config",$config);
	$tpl->assign("lang",$lang);
	$output=tplfetch("admin_product_step1.htm",null,true);
}
else
{
	include_once("$config[webroot]/module/product/includes/plugin_add_field_class.php");
	$addfield = new AddField();
	
	if($submit=="submit"&&isset($_SESSION['IFPAY']))
	{
		//##===============
		$pactidlist=!empty($_POST['catid'])?$_POST['catid']:NULL;
		if(!empty($_POST['tcatid']))
			$pactidlist.= ",".$_POST['tcatid'];
		if(!empty($_POST['scatid']))
			$pactidlist.=",".$_POST['scatid'];
		if(!empty($_POST['sscatid']))
			$pactidlist.=",".$_POST['sscatid'];
		$pro->add_user_common_cat($pactidlist);//增加会员常用类别
		//###===============

		$re=$pro->add_pro();
		if($re)
			msg("main.php?action=m&m=product&s=admin_product_list&menu=$_GET[menu]");
	}
	if($submit=="edit"&&!empty($_POST['con']))
	{
		$re=$pro->edit_pro();
		if($re)
			msg("main.php?action=m&m=product&s=admin_product_list&menu=$_GET[menu]");
	}
	if(!empty($_GET['edit']))
	{
		$tpl->assign("de",$de=$pro->pro_detail($_GET['edit']));
		$pactidlist=$de['catid'];
		if(!empty($de['tcatid']))
			$pactidlist.=",".$de['tcatid'];
		if(!empty($de['scatid']))
			$pactidlist.=",".$de['scatid'];	
		if(!empty($de['sscatid']))
			$pactidlist.=",".$de['sscatid'];
		$pro->add_user_common_cat($pactidlist);//增加会员常用类别
		$tpl->assign("typenames",$pro->getProTypeName($pactidlist));
		$tpl->assign("firstvalue",$v=$addfield->addfieldinput($_GET['edit'],$pactidlist));
		$tpl->assign("brand",$pro->get_brand($pactidlist,$de['pp']));
		$tpl->assign("prov",get_province($de['province']));
	}
	else
		$tpl->assign("prov",get_province());

	//============================================
	include_once("lang/".$config['language']."/company_type_config.php");
	$tpl->assign("ptype",$ptype);
	$tpl->assign("trade_type",$trade_type);
	$tpl->assign("unit",$unit);
	$tpl->assign("validTime",$validTime);
	$tpl->assign("custom_cat",$admin->get_custom_cat_list(1,0));
	//==================================
	$tpl->assign("config",$config);
	$tpl->assign("lang",$lang);
	$output=tplfetch("admin_product.htm");
}

?>