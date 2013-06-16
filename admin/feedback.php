<?php
include_once("../includes/global.php");
//载入语言包
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=============================
if(!empty($_GET["step"])&&$_GET["step"]=="del")
{
	$db->query("delete from ".FEED." where id='$_GET[id]'");
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>

<body>

<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('feedback_manager');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="4" cellspacing="0" >
    <tr > 
      <td width="342" align="left" ><?php echo lang_show('company_name');?></td>
      <td width="162" align="center" ><?php echo lang_show('contact');?></td>
      <td width="177" align="center" ><?php echo lang_show('mail');?></td>
      <td width="145" align="center" ><?php echo lang_show('status');?></td>
      <td width="110" align="center" ><?php echo lang_show('query_reply');?></td>
      </tr>
    <?php 
	
	$tsql=NULL;
	if($_SESSION["province"])
		$tsql="  and province='$_SESSION[province]'";
	if($_SESSION["city"])
		$tsql.=" and city='$_SESSION[city]'";
	$sql="select * from ".FEED." where 1 $tsql order by id desc";
	$db->query($sql);
	$re=$db->getRows();
	for($i=0;$i<count($re);$i++)
	{
		$iflook=$re[$i]['iflook'];
		if($iflook=="0")
		{
			$say=lang_show('nolook');
		}
		elseif($iflook=="1")
		{
			$say=lang_show('noreplay');
		}elseif($iflook=="2")
		{
			$say=lang_show('isreplay');
		}
	?> 
    <tr> 
      <td width="342"> <?php echo $re[$i]['company']; ?> </td>
      <td width="162" align="center"><?php echo $re[$i]['contact']; ?> </td>
      <td width="177" align="center"><?php echo $re[$i]['email']; ?> </td>
      <td width="145" align="center"><?php echo "$say"; ?></td>
      <td align="center">
	  <a href="feedbackd.php?id=<?php echo $re[$i]['id']; ?>"><?php echo lang_show('query_reply');?></a>
	  | <a href="feedback.php?step=del&id=<?php echo $re[$i]['id']; ?>"><?php echo lang_show('delete');?></a>
	  </td>
      </tr>
    <?php 
	}
	?> 
</table>
</div>
</div>
</body>
</html>