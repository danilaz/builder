<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
@include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
@include_once("../config/mail_config.php");
//=========================================
if(!empty($_POST['submit'])&&$_POST["submit"]==lang_show('submit'))
{
	unset($_POST['submit']);
	foreach($_POST as $pname=>$pvalue)
	{
		$sql="select * from ".CONFIG." where `index`='$pname' and type='mail'";
		$db->query($sql);
		if($db->num_rows())
		   $sql1=" update ".CONFIG." SET value='$pvalue',type='mail' where `index`='$pname'";
		else
		   $sql1="insert into ".CONFIG." (`index`,value,type) values ('$pname','$pvalue','mail')";
		$db->query($sql1);
	}
	/****更新缓存文件*********/
	$write_config_con_array=read_config();//从库里取出数据生成数组
	$write_config_con_str=serialize($write_config_con_array);//将数组序列化后生成字符串
	$write_config_con_str=str_replace("'","\'",$write_config_con_str);
	
	$write_config_con_str='<?php $mail_config = unserialize(\''.$write_config_con_str.'\');?>';//生成要写的内容
	$fp=fopen('../config/mail_config.php','w');
	fwrite($fp,$write_config_con_str,strlen($write_config_con_str));//将内容写入文件．
	fclose($fp);
	/*********************/
	admin_msg("mail_config.php",'Настройки успешно сохранены!');
}
//===读库函数，生成config形式的数组====
function read_config()
{
	global $db;
	$sql="select * from ".CONFIG." where type='mail'";
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
?>
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('sysconfig');?></div>
<div class="bigbox">
	<div class="bigboxhead">Настройка почты</div>
	<div class="bigboxbody">
	<form name="sysconfig" action="mail_config.php" method="post" style="margin-top:0px;">
<table width="100%" cellspacing="0">
         <tr>
           <td width="11%" align="left">Включение почты 
		<a href="http://help.b2b-builder.com/2-10.html" target="_blank"><img src="../image/admin/Help Circle.jpg" border="0" ></a></td>
           <td width="89%" align="left" >
		   <input type="radio" name="mail_statu" value="1" <?php
		  if ($mail_config['mail_statu']==1)
			echo "checked";
		  ?>>
             Открыть
               <input type="radio" name="mail_statu" value="0" <?php
		  if ($mail_config['mail_statu']==0)
			echo "checked";
		  ?>>
           Закрыть</td>
         </tr>
         <tr>
           <td width="11%" align="left" >SMTP</td>
           <td width="89%" align="left" ><input name="smtp" type="text" id="smtp" size="30" maxlength="60" value="<?php echo $mail_config['smtp'];?>"></td>
         </tr>
         <tr>
          <td width="11%" align="left" >E-mail</td>
          <td width="89%" align="left" ><input name="email" type="text" id="email" size="30" maxlength="60"	value="<?php echo $mail_config['email'];?>"></td>
        </tr>
         <tr>
           <td width="11%" align="left">Пароль</td>
           <td width="89%" align="left"><input name="emailPass" type="password" id="emailpass" size="30" maxlength="60" value="<?php echo $mail_config['emailPass'];?>"/></td>
        </tr>
        
        <tr>
          <td width="11%" height="40" align="right">&nbsp;</td>
          <td width="89%" align="left" ><input  class="btn" type="submit" name="submit" value="<?php echo lang_show('submit');?>"></td>
        </tr>
      </table>
	</form>
	</div>
</div>
</body>
</HTML>