<?php
include_once("module/job/lang/".$config['language']."/index.php");
$sql="select rid,name from ".RESUME." where userid='$buid' order by time desc";
$db->query($sql);
$re=$db->getRows();
$tpl->assign("resume",$re);
include_once("footer.php");
tplfetch("resume.htm",NULL,true);
?>