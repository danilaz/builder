<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/".$sctiptName);
include_once("auth.php");
//===========================================
if($_SESSION["province"])
	$tsql=" and con_province='$_SESSION[province]'";
else
	$tsql=" and (con_province='' or con_province is NULL)";
	
if($_SESSION["city"])
	$tsql.=" and con_city='$_SESSION[city]'";
else
	$tsql.=" and (con_city='' or con_city is NULL)";
if(!empty($_POST['con_linkaddr']))
	$ssql=" , con_linkaddr='$_POST[con_linkaddr]'";
else
	$ssql=NULL;
	
if(isset($_POST["cc"]))
{
	unset($sql);
	$sql=" update ".WEBCON." SET 
	title='$_POST[title]',keywords='$_POST[keywords]',description='$_POST[description]',
	con_desc='$_POST[con_desc]',template='$_POST[template]',msg_online='$_POST[msg_online]' $ssql 
	where con_id='$_POST[con_id]' $tsql";	
	$re=$db->query($sql);
	if($re)
		admin_msg("web_con_set.php?con_id=$_GET[con_id]",'Успешно сохранено!');
}
//============================================
if(empty($_GET['con_id']))
	$_GET["con_id"]=1;
$sql="select * from ".WEBCON." WHERE con_id='$_GET[con_id]'";
$db->query($sql);
$de=$db->fetchRow();
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<body>
<link href="main.css" rel="stylesheet" type="text/css" />
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('about_us');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('about_content_setting');?></div>
<div class="bigboxbody">
<script>
function goto(v)
{
	window.location='?con_id='+v;
}
</script>
<form method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11%"><?php echo lang_show('itype');?></td>
    <td width="89%">
	<select name="con_id" onChange="goto(this.value);">
	<?php 
	$sql="select con_id,con_title from ".WEBCON." WHERE 1";
	$db->query($sql);
	$t=$db->getRows();
	foreach($t as $v)
	{
		if($v['con_id']==$de["con_id"])
			echo '<option value='.$v['con_id'].' selected >'.$v['con_title'].'</option>';
		else
			echo '<option value='.$v['con_id'].' >'.$v['con_title'].'</option>';
	}
	?>
    </select>
	</td>
  </tr>
  <tr>
    <td>SEO Title</td>
    <td><input name="title" type="text" id="title" size="80" value="<?php if(!empty($de['title']))echo $de['title'];?>"></td>
  </tr>
  <tr>
    <td>SEO keywords </td>
    <td><input name="keywords" type="text" size="80" value="<?php if(!empty($de['keywords']))echo $de['keywords'];?>"></td>
  </tr>
  <tr>
    <td>SEO description</td>
    <td><input name="description" type="text" size="80" value="<?php if(!empty($de['description']))echo $de['description'];?>"></td>
  </tr>
    <tr>
    <td>Template</td>
    <td>
      <input name="template" type="text" value="<?php if(!empty($de['template']))echo $de['template'];?>">    </td>
  </tr>
  <tr>
    <td><?php echo lang_show('con');?></td>
    <td>
	<?php
		$BasePath = "../lib/fckeditor/";
		include($BasePath."fckeditor.php");	
		$fck_en = new FCKeditor('con_desc') ;
		if($config['language']=='cn')
			$fck_en->Config['DefaultLanguage']='zh-cn';
		else
			$fck_en->Config['DefaultLanguage']='en';
		$fck_en->BasePath    = $BasePath ;
		$fck_en->ToolbarSet  = 'Default' ;
		$fck_en->Width='100%';
		$fck_en->Height=500;
		$fck_en->Config['ToolbarStartExpanded'] = true;
		$fck_en->Value = stripslashes($de['con_desc']);
		echo $fck_en->CreateHtml();
	?>	</td>
  </tr>
  <tr>
    <td>Форма отправки</td>
    <td>
      <input name="msg_online" type="checkbox" <?php if($de['msg_online']=='1')echo 'checked';?> value="1">    </td>
  </tr>
  <tr>
    <td>Сайт</td>
    <td>
    <?php if($de['con_linkaddr']){ ?>
    <input size="60" name="con_linkaddr" type="text" value="<?php if($de['con_linkaddr']) echo $de['con_linkaddr'];?>">
    <?php } else {echo "$config[weburl]/aboutus.php?type=".$de['con_id']; } ?>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn" type="submit" name="cc" value="<?php echo lang_show('submit');?>"></td>
  </tr>
</table>
</form>
</div>
</div>
</body>
</html>
