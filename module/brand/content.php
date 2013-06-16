<?php 
include("module/brand/includes/plugin_brand_class.php");
//================================
 $mybrand=new brand();
 if(!empty($_GET['id']))
 $re=$mybrand->brand_content($_GET['id']);
//===========================
$tpl->assign("brand",$re);
$tpl->assign("current","brand");
include("footer.php");
$out=tplfetch("brand_content.htm");

?>
