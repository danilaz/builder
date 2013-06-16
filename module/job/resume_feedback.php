<?php
include_once("module/job/lang/".$config['language']."/index.php");
	if(isset($_POST['title']) and isset($_POST['con']) )
	{  
		$sql="select userid from ".RESUME." where rid='".$_GET['id']."'";
		$db->query($sql);
		$re=$db->fetchField('userid');
		$date=time();
		$sql="insert into ".FEEDBACK."(touserid,fromuserid,msgtype,sub,con,date) 
		values('$re','$buid','1','$_POST[title]','$_POST[con]',$date)";
		$db->query($sql);
	}
	$sql="select * from ".USER." where userid=".$buid;
	$db->query($sql);
	$re=$db->fetchRow();
    $tpl->assign("re",$re);
	include_once("footer.php");
	tplfetch("resume_feedback.htm",NULL,true);
?>