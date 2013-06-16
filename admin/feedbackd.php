<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//-----------------------------------------------------------------
if(!empty($_POST["action"]))
{
	if(!empty($_POST['userid']))
	{
		$date=date("Y-m-d H:i");
		$sql="insert into ".FEEDBACK." (touserid,fromInfo,sub,con,date,msgtype)
		 VALUES ('$_POST[userid]','".lang_show('sysmsg')."','$_POST[title]','$_POST[con]','$date',3)";
		$db->query($sql);
	}
	$db->query("update ".FEED." set iflook='2' where id='$_GET[id]'");
	echo send_mail($_POST["email"],$_POST["name"],$_POST["title"],nl2br($_POST["con"]));
	admin_msg("feedback.php",'发送成功');
}
if(!empty($_GET["deid"]))
{
	$db->query("delete from ".FEED." where id='$_GET[deid]'");
	msg("feedbackd.php?id=".($_GET["deid"]+1));
}
//-----------------------------------------------------------------
$sql="select * from ".FEED." where id='$_GET[id]'";
$db->query($sql);
$de=$db->fetchRow();
if(empty($de['id']))
	msg('feedback.php');
if($de["iflook"]==0)
	$db->query("update ".FEED." set iflook='1' where id='$_GET[id]'");
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('mem_feedback');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    <tr> 
      <td width="12%"><?php echo lang_show('number');?>:</td>
      <td width="88%"><?php echo $de["id"]; ?> --[<a href="?deid=<?php echo $de["id"]; ?>"><?php echo lang_show('delete');?></a>]</td>
    </tr>
    <tr> 
      <td width="12%"><?php echo lang_show('mem_id');?>:</td>
      <td width="88%"><?php echo $de["userid"]; ?></td>
    </tr>
    <tr> 
      <td width="12%"><?php echo lang_show('company');?>:</td>
      <td width="88%"><?php echo $de["company"]; ?></td>
    </tr>
    <tr> 
      <td width="12%"><?php echo lang_show('name');?>:</td>
      <td width="88%"><?php echo $de["contact"]; ?></td>
    </tr>
    <tr> 
      <td width="12%"><?php echo lang_show('mail');?>:</td>
      <td width="88%"><?php echo $de["email"]; ?></td>
    </tr>
    <tr> 
      <td width="12%" valign="top"><?php echo lang_show('content');?>:</td>
      <td width="88%" valign="top"><?php echo nl2br($de["mes"]); ?></td>
    </tr>
    <tr> 
      <td width="12%" height="225" valign="top"> <?php echo lang_show('reply');?>:</td>
      <td width="88%" height="225" valign="top">
        <form method="post" action="">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><?php echo lang_show('recipient');?></td>
              <td width="87%">
			  <input type="hidden" name="name" value="<?php echo $de["contact"]; ?>">
              <input type="hidden" name="userid" value="<?php echo $de["userid"]; ?>">
			  <input type="text" name="email" value="<?php echo $de["email"]; ?>" style="width:300px;">
			  </td>
            </tr>
            <tr>
              <td><?php echo lang_show('title');?></td>
              <td><input type="text" name="title" style="width:300px;"></td>
            </tr>
            <tr>
              <td><?php echo lang_show('content');?></td>
              <td>
<textarea name="con" rows="15" style="width:400px;"><?php echo " \n\n\n\n\n\n\n------------------------------------\n";
echo str_replace('<br>',"\n",$de["mes"]);
?></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input class="btn" type="submit" name="action" value="<?php echo lang_show('send_reply_mail');?>">　
              </td>
            </tr>
          </table>
          </form>
		  </td>
    </tr>
  </table>
 </div>
</div>
</body>
</html>