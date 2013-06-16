<?php
include_once("../includes/smarty_config.php");
//==========================
function read_dir($dir)
{
	$i=0;
	$handle = opendir($dir); 
	$rdir=array();
	while ($filename = readdir($handle))
	{ 
		if($filename!="."&&$filename!="..")
		{
		  if(!is_dir($dir.$filename))
		  { 
		  	 $pn=explode("_",$filename);
			 $type=explode("_",$_GET['type']);
			 
			 $pn=$pn[0];
		  	 if($pn==$type[0])
		   	 	$rdir[]=$filename;
		  }
	   }
	}
	return $rdir;
}

if(!empty($_GET['id']))
{
	$sql="select * from ".MLAY." where id='$_GET[id]'";
	$db->query($sql);
	$de=$db->fetchRow();
	$filter=unserialize($de['filter']);
	if(is_array($filter))
	{
		foreach($filter as $key=>$v)
		{
			if(!is_array($v))
				$filter[$key]=stripslashes($v);
		}
	}
	
}
if(!empty($_POST['submit']))
{
	if(!empty($_FILES['pic'])&&is_uploaded_file($_FILES['pic']['tmp_name']))
	{	
		$_POST['pic']=time().".jpg";
		$save_directory = $config['webroot']."/uploadfile/modules/";
		makethumb($_FILES['pic']['tmp_name'] , $save_directory.$_POST['pic'] , $_POST['width'] , $_POST['height']);
	}
	if(!empty($_POST['delpic']))
	{
		$save_directory = $config['webroot']."/uploadfile/modules/".$_POST['pic'];
		unlink($save_directory);
		unset($_POST['pic']);
	}
	$filter=addslashes(serialize($_POST));
	$sql="update ".MLAY." set filter='$filter',title='$_POST[title]',template='$_POST[template]' where id='$_GET[id]'";
	$db->query($sql);
	unset($_POST);
	msg('module.php?m=special&s=special_con.php&id='.$de['tid']);
}
include_once("$config[webroot]/module/$_GET[m]/includes/includes_modules_class.php");
$md= new includes_modules();
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/Calendar.js"></script>
</HEAD>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('hr_info_manager');?></div>
<form action="" method="post" enctype="multipart/form-data">
<div class="bigbox">
	<div class="bigboxhead">Настройка модуля содержания</div>
	<div class="bigboxbody">
<?php
if($_GET['type']=='video_plyaer'){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Название</td>
    <td><input type="text" name="title" id="title" value="<?php echo $de['title'];?>"></td>
  </tr>
  <tr>
    <td width="15%">Ссылка видео</td>
    <td width="85%">
      <input type="text" name="videourl" id="videourl" value="<?php echo $filter['videourl'];?>">    </td>
    </tr>
  <tr>
    <td>Размер видео</td>
    <td>
      <input name="width" type="text" id="width" size="10" value="<?php echo $filter['width'];?>">px
      *
      <input name="height" type="text" id="height" size="10" value="<?php echo $filter['height'];?>">px    </td>
  </tr>
  <tr>
    <td>Шаблон модуля</td>
    <td>
      <select name="template" id="template">
      <?php
	  $dir=read_dir("$config[webroot]/module/$_GET[m]/special_template/special_modules_template/");
	  foreach($dir as $v)
	  {
		if($v==$de['template'])
			$sl="selected";
		else
			$sl=NULL;
		echo "<option value='$v' $sl>$v</option>";
	  }
	  ?>
            </select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input class="btn" type="submit" name="submit" id="button" value="Отправить">    </td>
    </tr>
</table>
<?php
}
if($_GET['type']=='news_list'||$_GET['type']=='pro_list'||$_GET['type']=='offer_list'||$_GET['type']=='special_list')
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Название модуля</td>
    <td><input type="text" name="title" id="title" value="<?php echo $de['title'];?>"></td>
  </tr>
  <tr>
    <td width="15%">Фильтр</td>
    <td>
    <script>
	function show_div(id)
	{
		$('sql').style.display='none';
		$('nums').style.display='none';
		if(id!=4)
			$('nums').style.display='block';
		if(id==4)
			$('sql').style.display='block';
	}
	function $(str)
	{
		return document.getElementById(str);
	}
	</script>
<input <?php if($filter['type']==1) echo 'checked';?> onClick="show_div(this.value)" type="radio" name="type"  value="1">Новые　
<input  <?php if($filter['type']==2) echo 'checked';?> onClick="show_div(this.value)" type="radio" name="type"  value="2">Рекомендуемые　
<input <?php if($filter['type']==3) echo 'checked';?> onClick="show_div(this.value)" type="radio" name="type"  value="3">Номер id 
<input <?php if($filter['type']==4) echo 'checked';?> onClick="show_div(this.value)" type="radio" name="type" value="4">SQL

<?php
	$dp1=$dp2=NULL;
if($filter['type']!=4)
	$dp2="display:block;";
else
	$dp1="display:block;";
?>
<div id="sql" style="display:none;<?php echo $dp1;?>"><input size="60" type="text" name="sql" value="<?php echo $filter['sql'];?>">SQL </div>
<div id="nums" style="display:none;<?php echo $dp2;?>"><input type="text" name="nums" value="<?php echo $filter['nums'];?>">Количество</div></td>
    </tr>
  <tr>
    <td>Размер блока</td>
    <td>
      <input name="width" type="text" id="width" size="10" value="<?php echo $filter['width'];?>">px
      *
      <input name="height" type="text" id="height" size="10" value="<?php echo $filter['height'];?>">px    </td>
  </tr>
  <tr>
    <td>Шаблон модуля</td>
    <td>
      <select name="template" id="template">
      <?php
	  $dir=read_dir("$config[webroot]/module/$_GET[m]/special_template/special_modules_template/");
	  foreach($dir as $v)
	  {
		if($v==$de['template'])
			$sl="selected";
		else
			$sl=NULL;
		echo "<option value='$v' $sl>$v</option>";
	  }
	  ?>
      </select>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input class="btn" type="submit" name="submit" id="submit" value="Отправить">     </td>
    </tr>
</table>
<?php } 
if($_GET['type']=='article'){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%">Название модуля</td>
    <td width="85%"><input type="text" name="title" id="title" value="<?php echo $de['title'];?>"></td>
  </tr>
  <tr>
    <td>Содержание статьи</td>
    <td><textarea name="con" id="con" cols="100" rows="20"><?php echo $filter['con'];?></textarea></td>
  </tr>
  <tr>
    <td>Шаблон модуля</td>
    <td><select name="template" id="template">
        <?php
	  $dir=read_dir("$config[webroot]/module/$_GET[m]/special_template/special_modules_template/");
	  foreach($dir as $v)
	  {
		if($v==$de['template'])
			$sl="selected";
		else
			$sl=NULL;
		echo "<option value='$v' $sl>$v</option>";
	  }
	  ?>
          </select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn" type="submit" name="submit" id="submit" value="Отправить"></td>
  </tr>
</table>
<?php
}
if($_GET['type']=='picture'){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Название модуля</td>
    <td><input type="text" name="title" id="title" value="<?php echo $de['title'];?>"></td>
  </tr>
  <tr>
    <td width="15%">Рисунок: </td>
    <td width="85%">
    <?php 
	if(!empty($filter['pic'])) 
		echo "<img width='$filter[width]' height='$filter[height]' src='../uploadfile/modules/$filter[pic]' ><br>
		<input name='pic' type='hidden' value='$filter[pic]'>
		<input name='delpic' type='checkbox' value='1'>
		";
	else
		{
	?>
    <input name="pic" type="file">
	<?php 
		} 
    ?>
    </td>
  </tr>
  <tr>
    <td>Размер изображения: </td>
    <td>
      <input type="text" name="width" value="<?php echo $filter['width'];?>">

      px *
      <input type="text" name="height" value="<?php echo $filter['height'];?>" >
      px      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn" type="submit" name="submit" id="submit" value="Отправить"></td>
  </tr>
</table>
<br>　

<?php } ?>
    </div>
  </div>  
    
</form>
</body>
</html>