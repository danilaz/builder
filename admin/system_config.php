<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=========================================入库操作
if(!empty($_POST['submit'])&&$_POST["submit"]==lang_show('submit'))
{
	unset($_POST['submit']);
	$sql="delete from ".CONFIG." where type='' or type is NULL";
	$db->query($sql);
	foreach($_POST as $pname=>$pvalue)
	{
		unset($sql);
		$sql="select * from ".CONFIG." where `index`='$pname' and type='main'";
		$db->query($sql);
		if($db->num_rows())
		{
		   $sql1=" update ".CONFIG." SET value='$pvalue',type='main' where `index`='$pname'";
		}
		else
		{
		   $sql1="insert into ".CONFIG." (`index`,value,type) values ('$pname','$pvalue','main')";
		}
		$db->query($sql1);
	}
	/****更新缓存文件*********/
	$write_config_con_array=read_config();//从库里取出数据生成数组
	$write_config_con_str=serialize($write_config_con_array);//将数组序列化后生成字符串
	$write_config_con_str=str_replace("'","\'",$write_config_con_str);
	
	$write_config_con_str='<?php $config = array_merge($config, unserialize(\''.$write_config_con_str.'\'));?>';//生成要写的内容
	$fp=fopen('../config/web_config.php','w');
	fwrite($fp,$write_config_con_str,strlen($write_config_con_str));//将内容写入文件．
	fclose($fp);
	/*********************/
	admin_msg("system_config.php","Настройки успешно сохранены!");
	exit;
}
//===读库函数，生成config形式的数组====
function read_config()
{
	global $db;
	$sql="select * from ".CONFIG." where type='main'";
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $v)
	{
		$index=$v['index'];
		$value=$v['value'];
		$configs[$index]=$value;
	}
	return $configs;
}
//===================================
function read_dir($dir)
{
	$i=0;
	$handle = opendir($dir); 
	$rdir=array();
	while ($filename = readdir($handle))
	{ 
		if($filename!="."&&$filename!=".."&&$filename!=".svn")
		{
		  if(is_dir($dir.$filename))
		  { 
		  	 if(substr($filename,0,5)!='user_'&&substr($filename,0,8)!='special_'&&substr($filename,0,5)!='email')
		   	 	$rdir[]=$filename;
		  }
	   }
	}
	return $rdir;
}
//===============================
$config=read_config();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
weburl='<?php echo $config['weburl'];?>';
</script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript" src="../script/prototype.js"></script>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('sysconfig');?></div>
<div class="bigbox">
<div class="bigboxhead"><?php echo lang_show('sysconfig');?></div>

  <div class="bigboxbody">
	<form name="sysconfig" action="system_config.php" method="post" style="margin-top:0px;">
   	  <table width="100%" border="0">
        <tr>
          <td width="17%" align="left"><?php echo lang_show('company');?></td>
          <td width="83%" align="left">
            <input name="company" type="text" id="company" size="30" maxlength="60"  value="<?php echo $config['company'];?>"/>			</td>
        </tr>
        <tr>
          <td align="left" ><?php echo lang_show('weburl');?><a href="#" title="<?php echo lang_show('weburlmsg');?>"><img src="../image/admin/Help Circle.jpg" border="0" ></a></td>
          <td align="left" ><input name="weburl" type="text" id="weburl" size="30" maxlength="60" value="<?php echo $config['weburl'];?>"/></td>
        </tr>
        <tr>
          <td width="17%" align="left" ><?php echo lang_show('enurl');?><a href="#" title="<?php echo lang_show('enurl_des');?>"><img src="../image/admin/Help Circle.jpg" border="0" ></a> </td>
          <td align="left" >
          <input name="enurl" type="text" id="enurl" size="30" maxlength="60"	value="<?php echo $config['enurl'];?>"></td>
        </tr>
		                <tr>
          <td width="17%" align="left"><?php echo lang_show('baseurl');?></td>
          <td align="left"><input name="baseurl" type="text" id="baseurl" value="<?php echo $config['baseurl'];?>" size="30"></td>
        </tr>
		<tr>
		  <td align="left">Логотип сайта</td>
		  <td align="left"><input name="logo" type="text" id="logo" value="<?php echo $config['logo'];?>" size="30">
		 [<a href="javascript:uploadfile('Загрузка логотипа','logo',180,60)">Загрузить</a>] 
		 [<a href="javascript:preview('logo');">Предпросмотр</a>]
		 [<a onclick="javascript:$('logo').value='';" href="#">Удалить</a>]
		  </td>
		</tr>
        <tr>
		  <td align="left"><?php echo lang_show('owntel');?></td>
		  <td align="left"><input name="owntel" type="text" id="owntel" size="30" maxlength="30"	value="<?php echo $config['owntel'];?>"></td>
		</tr>

		<tr>
		  <td align="left"><?php echo lang_show('regname');?></td>
		  <td align="left" ><input name="regname" type="text" value="<?php echo $config['regname'];?>" size="30"></td>
		</tr>
        <tr>
          <td width="17%" align="left"><?php echo lang_show('cacheTime');?></td>
          <td align="left" >
            <input name="cacheTime" type="text" id="cacheTime" size="30" maxlength="5"	value="<?php echo $config['cacheTime'];?>">          </td>
        </tr>
        <tr>
          <td height="28" align="left" ><?php echo lang_show('money_flag');?> <a href="#" title="<?php echo lang_show('money_flag_des');?>"><img src="../image/admin/Help Circle.jpg" border="0" ></a></td>
          <td align="left" ><input name="money" type="text" id="textfield" value="<?php echo $config['money'];?>" size="30"></td>
        </tr>
        <tr>
          <td width="17%" height="28" align="left" >
		  <?php echo lang_show('date_format');?><a title="<?php echo lang_show('timeformat_des');?>" href="#"><img src="../image/admin/Help Circle.jpg" border="0" ></a>		  </td>
          <td align="left" ><input name="date_format" type="text" id="date_format" value="<?php echo $config['date_format'];?>" size="30"></td>
        </tr>
        <tr>
          <td align="left"  ><?php echo lang_show('language');?></td>
          <td align="left">
		  <select style="width:100px;" name="language" id="language">
            <?php
		  $dir=read_dir('../lang/');
		  foreach($dir as $v)
		  {
		  	if($v==$config['language'])
				$sl="selected";
			else
				$sl=NULL;
		  	echo "<option value='$v' $sl>$v</option>";
		  }
		  ?>
          </select></td>
        </tr>
        <tr>
          <td width="17%" align="left"  ><?php echo lang_show('temp');?></td>
          <td align="left"><select style="width:100px;" name="temp" id="temp">
            <?php
		  $dir=read_dir('../templates/');
		  foreach($dir as $v)
		  {
		  	if($v==$config['temp'])
				$sl="selected";
			else
				$sl=NULL;
		  	echo "<option value='$v' $sl>$v</option>";
		  }
		  ?>
          </select></td>
        </tr>
        <tr>
          <td align="left"  ><?php echo lang_show('isopencity');?> <a title="<?php echo lang_show('isopencity_des');?>" href="#"><img src="../image/admin/Help Circle.jpg" border="0" ></a></td>
          <td align="left"  ><input type="radio" name="isopencity" id="isopencity" value="1" onClick="javascript:window.document.sysconfig.domaincity2.checked='checked';" <?php
		  if ($config['isopencity']==1)
			echo "checked";
		  ?>>
            <?php echo lang_show('apply');?>
            <input type="radio" name="isopencity" id="isopencity2" value="0" <?php
		  if ($config['isopencity']==0)
			echo "checked";
		  ?>>
            <?php echo lang_show('forbid');?></td>
        </tr>
        <tr>
          <td width="17%" align="left"  >
		  <?php echo lang_show('domaincity');?>
		  <a title="<?php echo lang_show('domaincity_des');?>" href="#"><img src="../image/admin/Help Circle.jpg" border="0" ></a>		  </td>
          <td align="left"  >
            <input type="radio" name="domaincity" value="1" onClick="javascript:window.document.sysconfig.isopencity2.checked='checked';"<?php
		  if ($config['domaincity']==1)
			echo "checked";
		  ?>>
            
            <?php echo lang_show('apply');?>
            
              <input type="radio" name="domaincity" value="0" <?php
		  if ($config['domaincity']==0)
			echo "checked";
		  ?>>
              <?php echo lang_show('forbid');?></td>
        </tr>
        <tr>
          <td align="left" ><?php echo lang_show('stopcopy');?></td>
          <td align="left" ><input type="radio" name="stopcopy" id="stopcopy" value="1" <?php
		  if ($config['stopcopy']==1)
			echo "checked";
		  ?>>
            <?php echo lang_show('apply');?>
            <input type="radio" name="stopcopy" id="stopcopy2" value="0" <?php

		  if ($config['stopcopy']==0)
			echo "checked";
		  ?>>
            <?php echo lang_show('forbid');?></td>
        </tr>
        <tr>
          <td width="17%" align="left" ><?php echo lang_show('enable_gzip');?></td>
          <td align="left" ><input type="radio" name="enable_gzip" value="1" <?php
		  if ($config['enable_gzip']==1)
		  echo "checked";
		  ?>>
            <?php echo lang_show('apply');?>
            <input type="radio" name="enable_gzip" value="0" <?php
		  if ($config['enable_gzip']==0)
			echo "checked";
		  ?>>
            <?php echo lang_show('forbid');?> </td>
        </tr>
		<tr>
		  <td height="31" align="left" scope="row"><?php echo lang_show('openstatistics');?></td>
		  <td align="left" ><input type="radio" name="openstatistics"  value="1" <?php
		  if ($config['openstatistics']==1)
			echo "checked";
		  ?>>
            <?php echo lang_show('apply');?>
            <input type="radio" name="openstatistics" value="0" <?php
		  if ($config['openstatistics']==0)
			echo "checked";
		  ?>>
            <?php echo lang_show('forbid');?></td>
	    </tr >
		<tr>
          <td width="17%" height="84" align="left" scope="row"><?php echo lang_show('copyright');?></td>
          <td align="left" ><textarea name="copyright" id="copyright" cols="45" rows="5" style="width:633px"><?php echo $config['copyright'];?></textarea>
          <br>
          Допустимы теги HTML: © &amp;copy;  &amp;nbsp; &lt;br/&gt; </td>
        </tr >
        <tr>
          <td width="17%" align="left" scope="row"><?php echo lang_show('webclose');?></td>
          <td align="left" >
            <select name="closetype" id="closetype" onChange="if(this.value==1) document.getElementById('closecon').style.display='block'; else document.getElementById('closecon').style.display='none';">
              <option <?php if($config['closetype']==0){ echo 'selected';}?> value="0"><?php echo lang_show('openall');?></option>
              <option <?php if($config['closetype']==1){ echo 'selected';}?> value="1"><?php echo lang_show('closeweb');?></option>
            </select>
            <textarea <?php if($config['closetype']==1){ echo 'style="display:block;"';} else echo 'style="display:none;"';?> name="closecon" id="closecon" cols="45" rows="5"><?php echo $config['closecon'];?></textarea>            </td>
          </tr>
        <tr>
          <td width="17%" height="40" align="right" scope="row">&nbsp;</td>
          <td align="left" ><input  class="btn" type="submit" name="submit" value="<?php echo lang_show('submit');?>"></td>
        </tr>
      </table>
    </form>
	</div>
</div>
</body>
</HTML>