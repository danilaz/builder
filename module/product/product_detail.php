<?php
if(!empty($_GET["id"])&&is_numeric($_GET["id"]))
	$id=$_GET["id"];
else
{
	header("Location: 404.php");die();
}
include_once($config['webroot']."/module/product/includes/plugin_pro_class.php");
//==================增加的字段====
include_once("$config[webroot]/module/product/includes/plugin_add_field_class.php");
$addfield=new AddField();
$tempss = $addfield->GetViewFieldList($id);
$tpl->assign("addfieldlist",$tempss);
//============产品详情===================
$prodetail=new pro();
$prode=$prodetail->product_detail($id);
if(empty($prode['id']))
{	
	header("Location: index.php");
	die();
}	
$tpl->assign("prod",$prode);
//===========公司信息================
include_once("includes/plugin_user_class.php");
$user=new user();
$tpl->assign("cominfo",$user->get_cominfo($prode['userid']));
//===========公司其他产品================
$tpl->assign("relpro",$prodetail->company_other_product($prode['userid'],1,10));
//===========其他同类产品================
$tpl->assign("samepro",$prodetail->same_cat_product($prode['catid']));
//==========导航，keyword，description================
$guide=$ks=NULL;
$parcat=substr($prode['catid'],0,4);
$sql="select catid,cat,isbuy from ".PCAT." where catid='$parcat'";
$db->query($sql);
$pcats=$db->fetchRow();
$tpl->assign("pcat",$pcats);
if(!empty($pcats['cat']))
{
	$ks.=$pcats['cat'];
	$guide.=" <a href='$config[weburl]/?m=product&s=product_list&id=$parcat'>".$pcats['cat']."</a> &raquo; ";
}
$parcat=substr($prode['catid'],0,6);
if(strlen($parcat)==6)
{
	$sql="select catid,cat,isbuy from ".PCAT." where catid='$parcat'";
	$db->query($sql);
	$pcatss=$db->fetchRow();
	if(!empty($pcatss['cat']))
	{
		$ks.=','.$pcatss['cat'];
		$guide.=" <a href='$config[weburl]/?m=product&s=product_list&id=$parcat'>".$pcatss['cat']." </a> &raquo; ";
	}
}
$parcat=substr($prode['catid'],0,8);
if(strlen($parcat)==8)
{
	$sql="select catid,cat,isbuy from ".PCAT." where catid='$parcat'";
	$db->query($sql);
	$pcatsss=$db->fetchRow();
	if(!empty($pcatsss['cat']))
	{
		$ks.=','.$pcatsss['cat'];
		$guide.=" <a href='$config[weburl]/?m=product&s=product_list&id=$parcat'>".$pcatsss['cat']."</a> &raquo; ";
	}
}
$parcat=substr($prode['catid'],0,10);
if(strlen($parcat)==10)
{
	$sql="select catid,cat,isbuy from ".PCAT." where catid='$parcat'";
	$db->query($sql);
	$pcatssss=$db->fetchRow();
	if(!empty($pcatssss['cat']))
	{
		$ks.=','.$pcatssss['cat'];
		$guide.=" <a href='$config[weburl]/?m=product&s=product_list&id=$prode[catid]'>".$pcatssss['cat']."</a> &raquo; ";
	}
}


if($pcats['isbuy']==1 or $pcatss['isbuy']==1 or $pcatsss['isbuy']==1 or $pcatssss['isbuy']==1)
	$tpl->assign("isbuy",1);
else
	$tpl->assign("isbuy",0);
	
$tpl->assign("guide",$guide.$prode['pname']);
$tpl->assign("province",get_province());
$config['title']=$prode['pname'].'-'.$config['title'];
$config['description']=strip_tags($prode['con']);
$config['keyword']=$prode['pname'].','.$prode['keywords'].','.$prode['pp'].','.$ks;
unset($prode);

$tpl->assign("current","product");
include_once("footer.php");
//======================================
$out=tplfetch("product_detail.htm",$flag);

$tpl->assign("out",$out);
$sql="SELECT * FROM ".PCAT." WHERE catid<9999 ORDER BY nums asc,char_index";
$db->query($sql);
$re=$db->getRows();
foreach($re as $key=>$v)
{
	 $re[$key]["sub"]=readsubcat($v["catid"]);
}
$tpl->assign("cat",$re);
tplfetch("shop.htm",null,true);
?>