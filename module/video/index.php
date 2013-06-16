<?php
include("module/video/includes/plugin_video_class.php");
//=====================
$myvideo=new video();
$re=$myvideo->front_video_list($_GET['id']);
$tpl->assign("video",$re);

$sql="select * from ".VCAT." where pid=0 order by posid";
$db->query($sql);
$cat=$db->getRows();
if(count($cat)>0)
{
	foreach($cat as $key=>$v)
	{
		$sql="select * from ".VCAT." where pid='$v[id]'";
		$db->query($sql);
		$cat['sub'][]=$db->getRows();
	}
}
$tpl->assign("cat",$cat);
//=====================
$tpl->assign("current","video");
include("footer.php");
$out=tplfetch("video_index.htm");
?>