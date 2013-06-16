<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
@include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//====================================
if($_GET['action']=='del'&&$_GET['id']>0)
{
	$sql="delete from ".USERTEMP." where id='$_GET[id]'";
	$db->query($sql);
	msg('user_template.php');
}
else if(!empty($_POST['submit'])&&$_POST["submit"]==lang_show('delete')&&!empty($_POST['id']))
{	
	$id=implode(',',$_POST['id']);
	$sql="delete from ".USERTEMP." where id IN($id)";
	$db->query($sql);
	msg('user_template.php');
}
else if(!empty($_POST['submit'])&&$_POST["submit"]=='addtpl'&&!empty($_POST['usergroup']))
{	
	$tm=time();
	$group_id=implode(',',$_POST['usergroup']);
	$sql="insert into ".USERTEMP." (`tname`,`ccatid`,`point`,`group_id`,`temp_file`,`time`,`sort_order`,statu)
	 VALUES('$_POST[tname]','$_POST[cat]','$_POST[point]','$group_id','$_POST[temp_file]','$tm','$_POST[sort]',1)";
	 $db->query($sql);
	 msg('user_template.php');
}
else if(!empty($_POST['submit'])&&$_POST["submit"]=='edit'&&!empty($_POST['usergroup']))
{
	$id=$_POST['editID'];
	if($id>0)
	{
		$tm=time();
		$group_id=implode(',',$_POST['usergroup']);
		$sql="update ".USERTEMP." set `tname`='$_POST[tname]',`ccatid`='$_POST[cat]',`point`='$_POST[point]',`group_id`='$group_id',`temp_file`='$_POST[temp_file]',`sort_order`='$_POST[sort]',`statu`='$_POST[statu]' where id='$id'";
		$db->query($sql);
		msg('user_template.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<TITLE> <?php echo lang_show('admin_system');?></TITLE>
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
weburl='<?php echo $config['weburl'];?>';
</script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript" src="../script/prototype.js"></script>
</head>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo;Управление шаблонами</div>
<?php
if(empty($_GET['action']))
	$_GET['action']=NULL;
if(empty($_GET['action'])&&$_GET['action']!="add")
{	
	$sql="select t.id,t.tname,t.ccatid,t.group_id,t.temp_file,t.point,t.sort_order,t.statu,c.cat from ".USERTEMP." t left join ".COMPANYCAT." c on c.catid=t.ccatid";
	//================================
	include_once("../includes/page_utf_class.php");
	$page = new Page;
	$page->listRows=5;
	if (!$page->__get('totalRows')){
		$db->query($sql);
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  limit ".$page->firstRow.",5";
	$pages = $page->prompt();
	//=====================
	$db->query($sql);
	$de=$db->getRows();
	$list=array();
	include($config['webroot']."/config/usergroup.php");
	foreach($de as $pl)
	{	
		$groud_id=explode(',',$pl['group_id']);
		foreach($groud_id as $id)
		{
			foreach($group as $v)
			{	
				if($v['group_id']==$id)
				{
					$pl['usergroup'][]=$v['name'];
				}
			}
		}
		$pl['usergroup']=implode(',',$pl['usergroup']);
		$list[]=$pl;
	}
?>
<script>
function do_select()
{	 
	 var box_l = document.getElementsByName("id[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
		if(document.getElementsByName("id[]")[j].checked==true)
		  document.getElementsByName("id[]")[j].checked = false;
		else
		  document.getElementsByName("id[]")[j].checked = true;
	 }
}
function check_sele()
{
	 var box_l = document.getElementsByName("id[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
		if(document.getElementsByName("id[]")[j].checked==true)
		return true;
	 }
	 alert("Выберите хотя бы один!");
	 return false;
}
</script>
<div class="bigbox">
<div class="bigboxhead">Управление шаблонами</div>
    <div class="bigboxbody">
    <form name="user_tpl" method="post" action="" onsubmit="return check_sele()">
    <table width="100%" border="0">
	    <tr>
		  <td height="31" width="26"><label><input type="checkbox" name="checkbox" onclick="do_select()" />&nbsp;</label></td>
          <td width="162" align="center"><b>Шаблон</b></td>
		  <td width="84"><b>Название</b></td>
		  <td width="84"><b>Категория</b></td>
		  <td width="226"><b>Членство</b></td>
          <td width="47"><b>Статус</b></td>
          <td width="84" align="center"><b>Баллы</b></td>
		  <td width="154" align="center"><b>Порядок</b></td>
          <td width="86" align="center"><b>Действие</b></td>
        </tr>
		<?php
		if($list)
		{
			$statu=array('<font color=red>Отключен</font>','Включен');
			foreach($list as $t)
			{
		?>
		<tr>
			<td  align="center"><input type="checkbox" name="id[]" value="<?php echo $t['id'];?>" /></td>
			<td align="center">
				<img style="border: 1px solid #A9BAD3; padding:4px; height:114px; width:97px;" src="../templates/<?php echo $t['temp_file'];?>/img/temp.jpg" /><br /></td>
			<td><?php echo $t['tname'];?></td>
			<td><?php echo $t['cat'];?></td>
			<td><?php echo $t['usergroup'];?></td>
			<td><?php echo $statu[$t['statu']];?></td>
			<td align="center"><?php echo $t['point'];?></td>
			<td align="center"><?php echo $t['sort_order'];?></td>
			<td align="center"><a title="Редактировать" href="?action=modify&edit=<?php echo $t['id'];?>"><?php echo $editimg;?></a>&nbsp;<a title="Удалить" href="?action=del&id=<?php echo $t['id'];?>" onclick="return confirm('Вы, действительно хотите удалить шаблон \'<?php echo $t['tname'];?>\'?')"><?php echo $delimg;?></a></td>
		</tr>
		<?php
			}
		}
		?>
		<tr>
		<td colspan="2"><input type="submit" onclick="return confirm('Вы, действительно хотите удалить?')" name="submit" value="Удалить"></td>
		<td colspan="7"><div class="page">&nbsp;<?php echo $pages;?></div></td>
		</tr>
		<tr><td colspan="9"><b><a style="padding-right:100px;" href="?action=add">+Добавить шаблон</a></b></td>
	    </tr>
	</table>
	</form>
</div>
</div>
<?php
}
?>
<?php
if(!empty($_GET['action'])&&$_GET["action"]=="modify"&&empty($_POST['submit']))
{
	$cats=get_comcat();
	//#===================================
	$templist=array();
	$handle = opendir($config['webroot']."/templates"); 
	while ($filename = readdir($handle))
	{ 
		if($filename!="."&&$filename!="..")
		{
		  if(is_dir($config['webroot']."/templates/".$filename)&&substr($filename,0,5)=="user_")
		  {
			$templist[]=$filename;
		  }
	   }
	}
	sort($templist);
	//==================================
	$sql="select * from ".USERTEMP." where id='$_GET[edit]'";
	$db->query($sql);
	$de=$db->fetchRow();
?>
<form method="post" action="user_template.php" onsubmit="return check_value()">
<div class="bigbox">
	<div class="bigboxhead">Редактирование шаблона</div>
<div class="bigboxbody">
<table width="100%" height="283" border="0" cellpadding="0" cellspacing="0">
	  <tr>
	  <td>Статус модуля</td>
		<td><label><input type="radio" name="statu" checked value='0' >Отключен</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" <?php if($de['statu']==1) echo "checked";?> value='1' name="statu">Включен</label></td>
	  </tr>
	  <tr>
        <td width="80" height="40">Применить категорию</td>
        <td>
          <select name="cat">
			<?php
			foreach($cats as $cat)
			{
			?>
			<option <?php if($de['ccatid']==$cat['catid']) echo "selected";?>  value="<?php echo $cat['catid'];?>"><?php echo $cat['cat'];?></option>
			<?php
			}
			?>		
		  </select></td>
        </tr>
		<tr>
		<td>Название шаблона</td>
		<td><input type='text' name='tname' id='tname' value='<?php echo $de['tname'];?>' /></td>
	  </tr>
	　　<tr>
		<td>Группа</td>
		<td>
		<?php
		include($config['webroot']."/config/usergroup.php");
		$group_id=explode(',',$de['group_id']);
		foreach($group as $v)
		{
			if($v['group_id']>1)
			{
	   ?>
          <input name="usergroup[]" type="checkbox" <?php if(in_array($v['group_id'],$group_id)) echo "checked";?>  value="<?php echo $v['group_id']; ?>">
          <?php echo $v['name']; ?><br>
       <?php
			}
		}
	   ?>
		</td>
	  </tr>
	  <tr>
		<td>Файл шаблона</td>
		<td>
			<select name='temp_file'>
			<?php
				$sql="select temp_file as dir from ".USERTEMP." where id!='$_GET[edit]'";
				$db->query($sql);
				$re=$db->getRows();
				foreach($re as $pl)
				{
					$dirs[]=$pl['dir'];
				}
				foreach($templist as $t)
				{	
					if(!in_array($t,$dirs))
					{
						echo "<option value=\"$t\" ";
						if($de['temp_file']==$t)
							echo "selected ";
						echo ">$t</option>";
					}
				}
			?>
			</select>
		</td>
	  </tr>
	  <tr>
		<td>Баллы</td>
		<td><input type='text' name='point' id='point' value='<?php echo $de['point'];?>' /></td>
	  </tr>
	  <tr>
		<td>Порядок</td>
		<td><input type='text' name='sort' id='sort' maxlength=4 value='<?php echo $de['sort_order'];?>' /></td>
	  </tr>
      <tr>
        <td height="43">&nbsp;</td>
        <td>
		<input class="btn" type="submit"  value="Определить"/>
		<input type="hidden" name="submit" value="edit"/>
		<input type="hidden" name="editID" value="<?php echo $de['id'];?>"/>
          &nbsp;&nbsp;
          <input class="btn" type="button" name="cancel2" id="cancel2" value="Отменить" onClick='javascript:window.location="user_template.php"' /></td>
      </tr>
    </table>
</div>
</div>
</form>
<?php
}
?>

<?php
if(!empty($_GET['action'])&&$_GET["action"]=="add"&&empty($_POST['submit']))
{
	$cats=get_comcat();
	$templist=array();
	$handle = opendir($config['webroot']."/templates"); 
	while ($filename = readdir($handle))
	{ 
		if($filename!="."&&$filename!="..")
		{
		  if(is_dir($config['webroot']."/templates/".$filename)&&substr($filename,0,5)=="user_")
		  {
			$templist[]=$filename;
		  }
	   }
	}
	sort($templist);
?>
<form method="post" action="user_template.php" onsubmit="return check_value()">
<div class="bigbox">
	<div class="bigboxhead">Добавить шаблон</div>
<div class="bigboxbody">
<table width="100%" height="283" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="80" height="40">Применить категорию</td>
        <td>
          <select name="cat">
			<?php
				foreach($cats as $cat)
				{
					echo "<option value=\"$cat[catid]\">$cat[cat]</option>";
				}
			?>		
		  </select></td>
        </tr>
      <tr>
		<td>Название шаблона</td>
		<td><input type='text' name='tname' id='tname' value='' /></td>
	  </tr>
	　　<tr>
		<td>Группа</td>
		<td>
		<?php
		include($config['webroot']."/config/usergroup.php");
		foreach($group as $v)
		{
			if($v['group_id']>1)
			{
	   ?>
          <input name="usergroup[]" type="checkbox" value="<?php echo $v['group_id']; ?>">
          <?php echo $v['name']; ?><br>
       <?php
			}
		}
	   ?>
		</td>
	  </tr>
	  <tr>
		<td>Файл шаблона</td>
		<td>
			<select name='temp_file'>
			<?php
	   			$sql="select temp_file as dir from ".USERTEMP;
				$db->query($sql);
				$re=$db->getRows();
				$dirs=array();
				foreach($re as $pl)
				{
					$dirs[]=$pl['dir'];
				}
				foreach($templist as $t)
				{	
					if(!in_array($t,$dirs))
						echo "<option value=\"$t\">$t</option>";
				}
			?>
			</select>
		</td>
	  </tr>
	  <tr>
		<td>Баллы</td>
		<td><input type='text' name='point' id='point' value='' /></td>
	  </tr>
	  <tr>
		<td>Порядок</td>
		<td><input type='text' name='sort' id='sort' maxlength=4 value='' /></td>
	  </tr>
      <tr>
        <td height="43">&nbsp;</td>
        <td>
		<input class="btn" type="submit"  value="Добавить"/>
		<input type="hidden" name="submit" value="addtpl"/>
          &nbsp;&nbsp;
          <input class="btn" type="button" name="cancel2" id="cancel2" value="Отменить" onClick='javascript:window.location="user_template.php"' /></td>
      </tr>
    </table>
</div>
</div>
</form>
<script>
function check_value()
{
	if(!$('tname').value)
	{
		alert('Укажите название шаблона!');
		$('tname').focus();
		return false;
	}
	var group=document.getElementsByName('usergroup[]');
	var chk=0;
	for(var i=0;i<group.length;i++)
	{
		if(group[i].checked==true)
		{
			chk++;
			break;
		}
	}
	if(chk<1)
	{
		alert('Выберите группу!');
		return false;
	}
	var point = $('point').value;
	if(point!=''&&!point.match(/^(:?(:?\d+.\d+)|(:?\d+))$/))
	{
		alert('Неправильное количество баллов!');
		$('point').focus();
		return false;
	} 
	var sort = $('sort').value;
	if(sort!=''&&!point.match(/^(:?(:?\d+.\d+)|(:?\d+))$/))
	{
		alert('Неправильно указан порядок!');
		$('sort').focus();
		return false;
	} 
}
</script>
<?php
}
?>
</body>
</html>