<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
@include_once("../config/reg_config.php");
//=========================================
if(!empty($_POST['submit'])&&$_POST["submit"]==lang_show('submit'))
{
	unset($_POST['submit']);
	foreach($_POST as $pname=>$pvalue)
	{
		$sql="select * from ".CONFIG." where `index`='$pname' and type='reg'";
		$db->query($sql);
		if($db->num_rows())
		   $sql1=" update ".CONFIG." SET value='$pvalue',type='reg' where `index`='$pname'";
		else
		   $sql1="insert into ".CONFIG." (`index`,value,type) values ('$pname','$pvalue','reg')";
		$db->query($sql1);
	}
	/****更新缓存文件*********/
	$write_config_con_array=read_config();//从库里取出数据生成数组
	$write_config_con_str=serialize($write_config_con_array);//将数组序列化后生成字符串
	$write_config_con_str=str_replace("'","\'",$write_config_con_str);
	
	$write_config_con_str='<?php $reg_config = unserialize(\''.$write_config_con_str.'\');?>';//生成要写的内容
	$fp=fopen('../config/reg_config.php','w');
	fwrite($fp,$write_config_con_str,strlen($write_config_con_str));//将内容写入文件．
	fclose($fp);
	/*********************/
	admin_msg("reg_config.php","Настройки успешно сохранены!");
	exit;
}
//===读库函数，生成config形式的数组====
function read_config()
{
	global $db;
	$sql="select * from ".CONFIG." where type='reg'";
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
		if($filename!="."&&$filename!="..")
		{
		  if(is_dir($dir.$filename))
		  { 
		  	 if(substr($filename,0,5)!='user_'&&substr($filename,0,5)!='email')
		   	 	$rdir[]=$filename;
		  }
	   }
	}
	return $rdir;
}
?>
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script src="../script/prototype.js" type=text/javascript></script>
</head>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('sysconfig');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('sysconfig');?></div>
	<div class="bigboxbody">
	<form name="sysconfig" action="reg_config.php" method="post" style="margin-top:0px;">
<table width="100%" cellspacing="0">
         <tr>
           <td width="19%" align="left" ><?php echo lang_show('detail_reg');?></td>
           <td width="81%" align="left" ><input type="radio" name="detail_reg" value="1" <?php
		  if ($reg_config['detail_reg']==1)
			echo "checked";
		  ?>>
             <?php echo lang_show('apply');?>
             <input type="radio" name="detail_reg" value="0" <?php
		  if ($reg_config['detail_reg']==0)
			echo "checked";
		  ?>>
           <?php echo lang_show('forbid');?></td>
         </tr>
         <tr>
          <td width="19%" align="left" ><?php echo lang_show('openregemail');?></td>
          <td width="81%" align="left" ><input type="radio" name="openregemail" value="1" <?php
		  if ($reg_config['openregemail']==1)
			echo "checked";
		  ?>>
            <?php echo lang_show('apply');?>
  <input type="radio" name="openregemail" value="0" <?php
		  if ($reg_config['openregemail']==0)
			echo "checked";
		  ?>>
<?php echo lang_show('forbid');?></td>
        </tr>
         <tr>
           <td width="19%" align="left"><?php echo lang_show('userregverf');?></span></td>
           <td width="81%" align="left">
            <input type="radio" name="user_reg_verf" value="1" <?php
		  if (!empty($reg_config['user_reg_verf'])&&$reg_config['user_reg_verf']==1)
			echo "checked";
		  ?>>
             <?php echo lang_show('apply');?>
             <input type="radio" name="user_reg_verf" value="0" <?php
		  if ($reg_config['user_reg_verf']==0)
			echo "checked";
		  ?>>
           <?php echo lang_show('forbid'); ?>
		   <a href="user_reg_verf.php">[Настройка вопросов]</a>
		   </td>
        </tr>

         <tr>
          <td width="19%" align="left"><?php echo lang_show('user_reg');?></td>
          <td width="81%" align="left">
		  <?php
		  $user_reg_array=array('2'=>lang_show('noaudit'),'1'=>lang_show('manaudit'),'3'=>lang_show('mailaudit'));
		  ?>
		  <select name="user_reg" id="user_reg">
		  <?php foreach($user_reg_array as $key=>$v){?>
              <option value="<?php echo $key;?>" <?php if($reg_config['user_reg']==$key)echo 'selected';?>><?php echo $v;?></option>
		  <?php } ?>
           </select></td>
        </tr>

        <tr>
          <td width="19%" align="left" ><?php echo lang_show('openbbs');?></td>
          <td width="81%" align="left" ><select name="openbbs" id="select">
            <option value="0" <?php
		  if($reg_config['openbbs']==0 || empty($reg_config['openbbs']))
		  echo "selected";
		  ?>><?php echo lang_show('forbid');?></option>
            <option value="2" <?php
		  if($reg_config['openbbs']==2)
		  echo "selected";
		  ?>>UC1.5.0</option>
          </select> <a href="uc_config.php">[Настройка интеграции]</a></td>
        </tr>
		        <tr>
          <td width="19%"  align="left" ><?php echo lang_show('default_user_tem');?><a href="#" title="<?php echo lang_show('default_user_tem_des');?>"><img src="../image/admin/Help Circle.jpg" border="0" ></a></td>
          <td width="81%" align="left" >
            <input name="default_user_tem" type="text" id="default_user_tem" size="30" maxlength="60"	value="<?php echo $reg_config['default_user_tem'];?>"></td>
        </tr>
                <tr>
                  <td align="left"><?php echo lang_show('inhibit_ip');?></td>
                  <td align="left" ><input onClick="$('exception_ip_div').style.display='block';" type="radio" name="inhibit_ip" id="inhibit_ip" value="1" <?php
		  if ($reg_config['inhibit_ip']==1)
			echo "checked";
		  ?>>
             <?php echo lang_show('apply');?>
             <input onClick="$('exception_ip_div').style.display='none';" type="radio" name="inhibit_ip" id="inhibit_ip2" value="0" <?php
		  if ($reg_config['inhibit_ip']==0)
			{echo "checked";}
		  ?>>
             <?php echo lang_show('forbid');?>
			 <div id="exception_ip_div" <?php if($reg_config['inhibit_ip']!=1) echo 'style="display:none;"';?> >
             Укажите разрешенные IP адреса, по одному на каждую строку<br>
             <textarea name="exception_ip" cols="60" rows="5" id="exception_ip"><?php echo $reg_config['exception_ip'];?></textarea>
			 </div>           </td>
                </tr>
        <tr>
          <td width="19%" height="80" align="left"><?php echo lang_show('association');?></td>
          <td width="81%" align="left" >
          <textarea name="association" id="association" cols="60" rows="5"><?php echo $reg_config['association'];?></textarea>          </td>
        </tr>
        <tr>
          <td width="19%" height="80" align="left"><?php echo lang_show('webclose');?></td>
          <td width="81%" align="left" >
            <select name="closetype" id="closetype">
              <option <?php if($reg_config['closetype']==0){ echo 'selected';}?> value="0"><?php echo lang_show('openall');?></option>
              <option <?php if($reg_config['closetype']==2){ echo 'selected';}?> value="2"><?php echo lang_show('closereg');?></option>
            </select>
            <br>
            <textarea name="closecon" id="closecon" cols="60" rows="5"><?php echo $reg_config['closecon'];?></textarea>		  </td>
        </tr>
        <tr>
          <td width="19%" height="40" align="right">&nbsp;</td>
          <td width="81%" align="left" ><input  class="btn" type="submit" name="submit" value="<?php echo lang_show('submit');?>"></td>
        </tr>
      </table>
	</form>
	</div>
</div>
</body>
</HTML>