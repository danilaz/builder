<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/".$sctiptName);
include_once("auth.php");
//=============================
if(!empty($_POST['submit']))
{
	foreach($_POST['sort'] as $k=>$v)
	{
		$msql="update ".WEBCON." set con_no='$v',con_group='".$_POST['con_group'][$k]."',con_title='".$_POST['menu_name'][$k]."',con_statu='".$_POST['statu'][$k]."',con_linkaddr='".$_POST['con_linkaddr'][$k]."' where con_id=$k";
		$db->query($msql); 
	}
}
if (!empty($_POST['webcontitle'])&&!empty($_POST['addwebcon']))
{
		$msql="insert into ".WEBCON." (con_no,con_statu,con_title,con_group,con_linkaddr,con_province,con_city,lang)
		values 
		('0','1','$_POST[webcontitle]','$_POST[add_group]','$_POST[linkaddr]','$_SESSION[province]','$_SESSION[city]','$config[language]')";
		$db->query($msql); 
}
if (!empty($_GET['action'])&&$_GET['action']=='del'&&!empty($_GET['did']))
{
		$msql="delete from ".WEBCON." where con_id='$_GET[did]'";
		$db->query($msql); 
}
/****更新缓存文件*******/

/*********************/
function getwebdata()
{
	global $db,$config;
	$sql="select * from ".WEBCON." where con_statu=1 and lang='$config[language]' order by con_no asc";
	$db->query($sql);
	$re=$db->getRows();
	$li=array();
	foreach($re as $key=>$v)
	{
		if(!empty($v['con_linkaddr']))
			if(substr($v['con_linkaddr'],0,4)=='http')
				$url=$v['con_linkaddr'];
			else
				$url=$config['weburl'].'/'.$v['con_linkaddr'];
		else
			$url=$config['weburl']."/aboutus.php?type=".$v['con_id'];
		$li[$key]="<a href='$url'>".$v['con_title']."</a>";
	}
	return implode(" | ",$li);
}
//===================================
$sql="select * from ".WEBCONGROUP." where lang='$config[language]'";
$db->query($sql);
$group =$db->getRows();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<TITLE><?php echo lang_show('web_con_type');?></TITLE>
</head>
<body>
<div class="guidebox"><?php echo lang_show('web_con_type');?></div>
<div class="bigbox">
<div class="bigboxhead"><?php echo lang_show('web_con_type');?></div>
<div class="bigboxbody">

<form id="form1" action="web_con_type.php" method="POST">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr>
      <td colspan="8" align="left" style="border-top:none;">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td width="7%" height="24" align="right"  ><?php echo lang_show('con_title');?></td>
      <td width="11%" align="left"  ><input type="text" size="20" name="webcontitle" id="webcontitle"></td>
	  <td width="56%" align="left"  ><?php echo lang_show('laddr');?>
	    <input type="text" size="50" name="linkaddr" id="linkaddr">
		<select style='width:120px' name='add_group'>
			<option value=''>Выберите группу</option>
			<?php foreach($group as $g){ ?>
				<option value="<?php echo $g['id']; ?>"><?php echo $g['title']; ?></option>			
			<?php } ?>
		  </select>[<a href="web_con_group.php">Управление группами</a>]
	  </td>
      <td width="26%" align="left" ><input class="btn" type="submit" name="addwebcon" id="addwebcon" value="<?php echo lang_show('addtype');?>"></td>
			</tr>
		</table>
		</td>
    </tr>
	<tr>
      <td height='40px' colspan="8" align="left">&nbsp;</td></tr>
    <tr >
      <td width="15" height="24" align="left"><?php echo lang_show('sno');?></td>
      <td width="120" align="left" ><?php echo lang_show('stitle');?></td>
      <td width="98" align="left" >
	  <select onChange="window.location='web_con_type.php?group='+this.value;" name='group'>
		<option value=''>Выберите группу</option>
		<?php foreach($group as $g){ ?>
			<option <?php if($_GET['group']==$g['id']) echo 'selected="selected"';?> value="<?php echo $g['id']; ?>"><?php echo $g['title']; ?></option>			
		<?php } ?>
	  </select>
	  </td>
      <td width="60" align="left">Ссылка</td>
      <td width="60" align="left">Шаблон</td>
      <td width="57" align="left" ><?php echo lang_show('tp');?></td>
	  <td width="68" align="left" ><?php echo lang_show('statu');?></td>
	  <td width="123" align="left" ><?php echo lang_show('act');?></td>
    </tr>
	    <?php
		unset($sql);
		if($_SESSION["province"])
			$tsql=" and con_province='$_SESSION[province]'";
		else
			$tsql=" and (con_province='' or con_province is NULL)";
		if($_SESSION["city"])
			$tsql.=" and con_city='$_SESSION[city]'";
		else
			$tsql.=" and (con_city='' or con_city is NULL)";
		if(!empty($_GET['group']))
			$tsql.=" and con_group='$_GET[group]' ";
		
		$sql="select * from ".WEBCON." where 1 $tsql and lang='$config[language]' order by con_no";
		$db->query($sql);
		$re=$db->getRows();
        foreach($re as $v)
	    {
       ?>
        <tr>
          <td height="24" >
		  <input name="sort[<?php echo $v['con_id'];?>]" type="text" id="sort<?php echo $v['con_id'];?>" size="5" maxlength="2" value="<?php echo $v['con_no'];?>">
		  </td>
          <td >
		  <input name="menu_name[<?php echo $v['con_id'];?>]" type="text" id="menu_name<?php echo $v['con_id'];?>" size="20" maxlength="30" value="<?php echo $v['con_title'];?>">		  </td>
          <td >
		  <select style='width:80px' name='con_group[<?php echo $v['con_id'];?>]'>
			<option value=''>Выберите группу</option>
			<?php foreach($group as $g){ ?>
				<option <?php if($v['con_group']==$g['id']) echo 'selected'; ?> value="<?php echo $g['id']; ?>"><?php echo $g['title']; ?></option>			
			<?php } ?>
		  </select>
		  </td>
          <td >
		  <?php if($v['con_linkaddr']){ ?>
    <input name="con_linkaddr[<?php echo $v['con_id'];?>]" type="text" size="10" value="<?php if($v['con_linkaddr']) echo $v['con_linkaddr'];?>" >
    <?php } else {?>
	<input name="con_linkaddr[<?php echo $v['con_id'];?>]" type="text" size="10" value="<?php echo "$config[weburl]/aboutus.php?type=".$v['con_id']; ?>">
	<?php } ?>
		  </td>
          <td ><?php echo empty($v['template'])?'Default':$v['template'];?></td>
          <td ><?php 
      if ($v['con_type']=='1')
          echo lang_show('sys');
      else
          echo lang_show('comsu'); 

      ?>  </td>
          <td align="left" >
            <select name="statu[<?php echo $v['con_id'];?>]" id="statu<?php echo $v['con_id'];?>">
              <option value="1" <?php if($v['con_statu']==1) echo "selected";?>><?php echo lang_show('ison');?></option>
              <option value="0" <?php if($v['con_statu']==0) echo "selected";?>><?php echo lang_show('isoff');?></option>
          </select>		  </td>
          <td align="left" >
		  &nbsp;<a href="web_con_set.php?con_id=<?php echo $v['con_id'];?>"><img alt="<?php echo lang_show('conset');?>" src="../image/admin/edit.gif"></a>
          <a href="web_con_type.php?action=del&did=<?php echo $v['con_id'];?>" onClick="javascript:return confirm('<?php echo lang_show('suredel');?>')"><img alt="<?php echo lang_show('del');?>" src="../image/admin/del.gif"></a>          </td>
        </tr>
    <?php
    }
    ?>
            <tr>
          <td colspan="8" align="left" valign="top">
            <input class="btn" type="submit" name="submit" id="submit" value="<?php echo lang_show('subm');?>" onClick='return confirm("<?php echo lang_show('suredel');?>");'>			</td>
        </tr>
  </table>
</form>
</div>
</div>
</body>
</html>