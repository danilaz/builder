<?php
include("module/brand/includes/plugin_brand_class.php");
//=====================
 $mybrand=new brand();
 $re=$mybrand->brand_list();
//===========================
$tpl->assign("brand",$re);
$tpl->assign("current","brand");
include("footer.php");
$out=tplfetch("brand_index.htm");
?>