<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//==========================================
if(!empty($_POST["action"])&&$_POST['action']=="add")
{
	if(!empty($_GET["id"]))
		$sql="update ".MAILMOD." set message='$_POST[con]',subject='$_POST[subject]',title='$_POST[title]' 
			where id='$_GET[id]' ";
	else
		$sql="insert into ".MAILMOD." (subject,message,title) values ('$_POST[subject]','$_POST[con]','$_POST[title]')";
	$db->query($sql);
	msg("mailmod.php");
}

if(!empty($_GET["id"])&&$_GET["action"]=="del")
{
	$db->query("delete from ".MAILMOD." where id='$_GET[id]' ");
	msg("mailmod.php");
}
if(!empty($_GET["id"])&&$_GET["action"]=="edit")
{
	$sql="SELECT * FROM ".MAILMOD." WHERE id=$_GET[id]";
	$db->query($sql);
	$detail=$db->fetchRow();
	if(!empty($_GET["type"])&&$_GET["type"]=="view")
	{
		echo $detail["message"];
		die;
	}
}
else
{
	$detail=NULL;
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<script language="javascript">
function openwin(txt)
{
	var win = window.open("", "win", "width=900,height=800"); // a window object
	win.document.open("text/html", "replace");
	win.document.write(txt);
	win.document.close();
}
</script>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('mail_tpl');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('tpl_list');?></div>
<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    		  <tr>
		    <td ><?php echo lang_show('mail_name');?></td>
		    <td ><?php echo lang_show('mail_title');?></td>
            <td ><?php echo lang_show('operate');?></td>
	  </tr>
	<?php
	$sql="select id,subject,title,flag from ".MAILMOD." order by id desc";
	$db->query($sql);
	$re=$db->getRows();
	$num=$db->num_rows();
	if(is_array($re))
	{
		foreach($re as $v)
		{
		?>
		  <tr> 
			<td width="272"><?php echo $v["title"];?></td>
			<td width="559"><?php echo $v["subject"];?></td>
		    <td width="195">
			<a href="?id=<?php echo $v["id"]; ?>&action=edit"><?php echo lang_show('modify');?></a> | 
            <?php if(empty($v['flag'])){ ?>
			<a href="?id=<?php echo $v["id"]; ?>&action=del" onClick="return confirm('<?php echo lang_show('suredel');?>');"><?php echo lang_show('delete');?></a> | 
            <?php } ?>
			<a href="#" onClick="window.open('mailmod.php?id=<?php echo $v["id"]; ?>&action=edit&type=view', 'win', 'width=900,height=800')"><?php echo lang_show('review');?></a>
			</td>
		  </tr>
		<?php 
		}
	}
	?>
  </table>
 </div></div>
 <div style="float:left; height:50px; width:80%;">&nbsp;</div>
<div class="bigbox">
<div class="bigboxhead"><?php echo lang_show('add_tpl');?></div>
<div class="bigboxbody">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <form name="form1" method="post" action="">
      <tr>
        <td><?php echo lang_show('tpl_name');?>:</td>
        <td><input name="title" type="text" id="title" value="<?php echo $detail["title"]; ?>" size="50"></td>
      </tr>
      <tr> 
        <td width="125"><?php echo lang_show('mail_title');?>:</td>
        <td width="829"><input name="subject" type="text" id="message" value="<?php echo $detail["subject"]; ?>" size="50"></td>
      </tr>
      <tr> 
        <td><?php echo lang_show('mail_content');?>:<br>
          (<?php echo lang_show('html_doc');?>)<a href="http://help.b2b-builder.com/2-10.html" target="_blank"><img src="../image/admin/Help Circle.jpg" border="0" ></a></td>
        <td><textarea name="con" cols="" rows="" style="width:650px; height:500px;"><?php echo $detail["message"]; ?></textarea></td>
      </tr>
      <tr> 
        <td height="38">&nbsp;</td>
        <td>
		<input name="cc" class="btn" type="submit" id="cc" value="<?php echo lang_show('confirm');?>"><input name="action" type="hidden" value="add">
		<input class="btn" name="" type="button" value="<?php echo lang_show('review');?>" onClick="openwin(con.value)">
		</td>
      </tr>
    </form>
  </table>
  </div>
  </div>
</body>
</html>
