<?php
if(!empty($_POST['submit']))
{
	include_once($config['webroot'].'/lib/allchar.php');
	$str=c(trim($_POST['name']));
	$fstr=substr($str,0,1);
	
	$_POST['nums']=empty($_POST['nums'])?1:$_POST['nums'];
	$_POST['statu']=empty($_POST['statu'])?1:$_POST['statu'];
	if($_POST['country']=='china'||$_POST['country']=='Китай')
	{
		$_POST['province']=$_POST['provinces'];
		$_POST['city']=$_POST['citys'];
	}
	$time=time();
	if(!empty($_GET['id']))
	{
		$sql="update ".BRAND." set name='".$_POST['name']."',nums='".$_POST['nums']."',$ssql
		con='".$_POST['con']."',company='".$_POST['company']."',tel='".$_POST['tel']."',
		pic='".$_POST['pic']."',statu='".$_POST['statu']."',url='$_POST[url]',country='$_POST[country]',province='$_POST[province]',
		city='$_POST[city]',time='$time',inner_url='$_POST[inner_url]',char_index='$fstr',char_all='$str'
		where id='".$_GET['id']."'";//update
	}
	else
	{
		$sql="insert into ".BRAND." 
		(name,con,pic,nums,company,tel,statu,url,country,province,city,time,inner_url,char_index,char_all) values 
		('$_POST[name]','".$_POST['con']."','".$_POST['pic']."','".$_POST['nums']."','".$_POST['company']."',
		'".$_POST['tel']."','".$_POST['statu']."','$_POST[url]','$_POST[country]','$_POST[province]','$_POST[city]','$time','$_POST[inner_url]','$fstr','$str')";//new insert
	}
	$db->query($sql);
	admin_msg('module.php?m=brand&s=brand_list.php','Успешно размещено!');
}
if(!empty($_GET['id']))
{
	$sql="select * from ".BRAND." where id='$_GET[id]'";
	$db->query($sql);
	$de=$db->fetchRow();
}
$country=country_list();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
weburl='<?php echo $config['weburl'];?>';
</script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript" src="../script/prototype.js"></script>

</HEAD>
<body>

<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('brand');?></div>
    <div class="bigboxbody">
 <form action="" method="post" enctype="multipart/form-data">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="97" align="left"><?php echo lang_show('name');?></td>
    <td width="858">
      <input name="name" type="text" value="<?php echo $de['name'];?>" size="50"  >
    </td>
    </tr>
  <tr>
    <td align="left"><?php echo lang_show('company');?></td>
    <td>
      <input name="company" type="text" value="<?php echo $de['company'];?>" size="50" >
    </td>
    </tr>
  <tr>
    <td align="left"><?php echo lang_show('tel');?></td>
    <td>
      <input name="tel" type="text" value="<?php echo $de['tel'];?>" size="50" >
    </td>
    </tr>
  <tr>
    <td align="left">Официальный сайт</td>
    <td>
      <input name="url" type="text" id="url" value="<?php if(empty($de['url'])) echo 'http://'; else echo $de['url'];?>" size="50">
    </td>
    </tr>
	  <tr>
    <td align="left">Ваш сайт</td>
    <td>
      <input name="inner_url" type="text" id="inner_url" value="<?php if(empty($de['inner_url'])) echo 'http://'; else echo $de['inner_url'];?>" size="50">
    </td>
    </tr>
  <tr>
    <td align="left">Страна</td>
    <td>
	<script>
	function s_pc(v)
	{
		if(v=='Китай')
		{
			$('sc').style.display='block';
			$('wc').style.display='none';
		}
		else
		{
			$('sc').style.display='none';
			$('wc').style.display='block';
		}
	}
	</script>
      <select onchange="s_pc(this.value);" name="country">
	  <?php foreach($country as $v){?>
	  <option <?php if($de['country']==$v['name']) echo 'selected="selected"';?>><?php echo $v['name'];?></option>
	  <?php } ?>
      </select>
     </td>
    </tr>
  <tr>
    <td align="left">Области, города</td>
    <td>
	<style>
	<?php
	if($de['country']=='Китай'||$de['country']=='china'||empty($de['country']))
	{
		echo "#sc{display:block;}";
		echo "#wc{display:none;}";
	}
	else
	{
		echo "#sc{display:none;}";
		echo "#wc{display:block;}";
	}
	?>
	</style>
	  <div id="sc">
		  <?php 
		  $de['citys']=$de['city'];
		  include($config['webroot'].'/admin/include_prv_city.php');
		  ?>
	  </div>
	  <div id="wc">
		  <input name="province" type="text" id="province" value="<?php echo $de['province'];?>" />
		  <input name="city" type="text" id="city" value="<?php echo $de['city'];?>" />
	  </div>
    </td>
  </tr>
  <tr>
    <td align="left"><?php echo lang_show('brand_des');?></td>
    <td>
		<?php
		$BasePath = "../lib/fckeditor/";
		include($BasePath."fckeditor.php");	
		$fck_en = new FCKeditor('con') ;
		if($config['language']=='cn')
			$fck_en->Config['DefaultLanguage']='zh-cn';
		else
			$fck_en->Config['DefaultLanguage']='en';
		$fck_en->BasePath    = $BasePath ;
		$fck_en->ToolbarSet  = 'Default' ;
		$fck_en->Width='100%';
		$fck_en->Height=500;
		$fck_en->Config['ToolbarStartExpanded'] = true;
		$fck_en->Value = stripslashes($de['con']);
		echo $fck_en->CreateHtml();
	?>
	</td>
  </tr>
  <tr>
    <td align="left">Логотип</td>
    <td><input value="<?php echo $de['pic'];?>" id="pic" name="pic" type="text">
		 [<a href="javascript:uploadfile('Загрузка логотипа','pic',120,80)">Загрузить</a>] 
		 [<a href="javascript:preview('pic');">Предпросмотр</a>]
		 [<a onclick="javascript:$('pic').value='';" href="#">Удалить</a>]
	</td>
  </tr>
  <tr>
    <td align="left"><?php echo lang_show('nums');?></td>
    <td><input value="<?php echo $de['nums'];?>" name="nums" type="text" maxlength="4" size="4"></td>
    </tr>
  <tr>
    <td align="left">Разместить</td>
    <td><input <?php if($de['statu']==1) echo 'checked="checked"';?> type="checkbox" name="statu" value="2"></td>
    </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td><input class="btn" type="submit" name="submit" id="button" value="<?php echo lang_show('submit');?>"></td>
    </tr>
</table>
</form>
</div>
</div>
</body>
</html>