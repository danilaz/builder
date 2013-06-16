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
	foreach($_POST as $pname=>$pvalue)
	{
		if ($pname!="submit")
		{
			unset($sql);
			$sql="select * from ".POINTCONFIG." where `index`='$pname'";
			$db->query($sql);
			if($db->num_rows())
			{
			   $sql1=" update ".POINTCONFIG." SET value='$pvalue' where `index`='$pname'";
			}
			else
			{
			   $sql1="insert into ".POINTCONFIG." (`index`,value) values ('$pname','$pvalue')";
			}
			$db->query($sql1);
		}
	}
	/****更新缓存文件*********/
	$write_config_con_array=read_config();//从库里取出数据生成config数组
	$write_config_con_str=serialize($write_config_con_array);//将数组序列化后生成字符串
	$write_config_con_str=str_replace("'","\'",$write_config_con_str);
	
	$write_config_con_str='<?php $point_config=unserialize(\''.$write_config_con_str.'\');?>';//生成要写的内容
	$fp=fopen('../config/point_config.php','w');
	fwrite($fp,$write_config_con_str,strlen($write_config_con_str));//将内容写入文件．
	fclose($fp);
	/*********************/
	msg("point_config.php");
	exit;
}
//===读库函数，生成config形式的数组====
function read_config()
{
	global $db;
	$sql="select * from ".POINTCONFIG;
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $v)
	{
		$index=$v['index'];
		$value=$v['value'];
		$point_config[$index]=$value;
	}
	return $point_config;
}
include_once("../config/point_config.php");
//===================================
?>
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.STYLE15 {
	color: #666666;
	font-size: 12px;
}
.STYLE17 {color: #181818}
-->   
 </style> 
</head>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('sysconfig');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('user_point_config');?></div>
	<div class="bigboxbody">
	<form name="sysconfig" action="point_config.php" method="post" style="margin-top:0px;">
	  <table width="100%">
        <tr>
          <td width="143" height="34" align="left"  ><?php echo lang_show('is_apply');?></td>
          <td colspan="3" align="left"  ><input type="radio" name="point" value="1" <?php
		  if (!empty($point_config['point'])&&$point_config['point']==1)
			echo "checked";
		  ?>>
              <?php echo lang_show('apply');?>
              <input type="radio" name="point" value="0" <?php
		  if ($point_config['point']==0)
			echo "checked";
		  ?>>
              <?php echo lang_show('forbid');?> </td>
        </tr>
        <tr>
          <td height="34" align="left"  ><?php echo lang_show('user_reg');?></td>
          <td align="left"  ><input name="reg_user" type="text" id="reg_user" size="10" maxlength="8"   value="<?php echo $point_config['reg_user'];?>"/>
              <?php echo lang_show('base_point');?></td>
          <td height="34" align="left"  ><?php echo lang_show('com_info');?></td>
          <td align="left"  ><input name="company_info" type="text" id="company_info" size="10" maxlength="8"    value="<?php echo $point_config['company_info'];?>"/>
              <?php echo lang_show('epoint');?></td>
        </tr>
        <tr>
          <td align="left"  ><?php echo lang_show('pubpro');?></td>
          <td align="left" ><input name="add_product" type="text" id="add_product" size="10" maxlength="8"   value="<?php echo $point_config['add_product'];?>"/>
              <?php echo lang_show('epoint');?></td>
          <td height="36" align="left" ><?php echo lang_show('upvideo');?></td>
          <td align="left" ><input name="pub_vidio" type="text" id="pub_vidio" size="10" maxlength="8"    value="<?php echo $point_config['pub_vidio'];?>"/>
              <?php echo lang_show('epoint');?></td>
        </tr>
        <tr>
          <td height="36" align="left"  ><?php echo lang_show('flashpro');?></td>
          <td align="left" ><input name="renew_product" type="text" id="renew_product" size="10" maxlength="8"  	value="<?php echo $point_config['renew_product'];?>">
              <?php echo lang_show('epoint');?></td>
          <td height="36" align="left" ><?php echo lang_show('puboffer');?></td>
          <td align="left" ><input name="add_offer" type="text" id="add_offer" size="10" maxlength="8"  	value="<?php echo $point_config['add_offer'];?>">
              <?php echo lang_show('epoint');?></td>
        </tr>
        <tr>
          <td align="left"  ><?php echo lang_show('subcribe');?></td>
          <td align="left" ><input name="sub_scribe" type="text" id="sub_scribe" size="10" maxlength="8"  	value="<?php echo $point_config['sub_scribe'];?>">
              <?php echo lang_show('epoint');?></td>
          <td align="left"  ><?php echo lang_show('flashoffer');?></td>
          <td align="left" ><input name="renew_offer" type="text" id="renew_offer" size="10" maxlength="8"  	value="<?php echo $point_config['renew_offer'];?>">
              <?php echo lang_show('epoint');?></td>
        </tr>
        <tr>
          <td align="left"  ><?php echo lang_show('pubproject');?></td>
          <td align="left" ><input name="add_project" type="text" id="add_project" size="10" maxlength="8"  	value="<?php echo $point_config['add_project'];?>">
              <?php echo lang_show('epoint');?> </td>
          <td width="248" align="left"  ><?php echo lang_show('pubnews');?></td>
          <td width="271" align="left" ><input name="add_news" type="text" id="add_news" size="10" maxlength="8"  	value="<?php echo $point_config['add_news'];?>">
              <?php echo lang_show('epoint');?> </td>
        </tr>
        <tr>
          <td height="38" align="left"  ><?php echo lang_show('delpro');?></td>
          <td width="304" align="left" ><input name="del_product" type="text" id="del_product" size="10" maxlength="8"  	value="<?php echo $point_config['del_product'];?>">
              <?php echo lang_show('epoint');?></td>
          <td width="248" align="left" ><?php echo lang_show('delproject');?></td>
          <td width="271" align="left" ><input name="del_project" type="text" id="del_project" size="10" maxlength="8"  	value="<?php echo $point_config['del_project'];?>">
              <?php echo lang_show('epoint');?> </td>
        </tr>
        <tr>
          <td height="30" align="left"  ><?php echo lang_show('delnews');?></td>
          <td width="304" align="left"><input name="del_news" type="text" id="del_news" size="10" maxlength="8"  	value="<?php echo $point_config['del_news'];?>">
              <?php echo lang_show('epoint');?></td>
          <td width="248" align="left" ><?php echo lang_show('deloffer');?></td>
          <td width="271" align="left" ><input name="del_offer" type="text" id="del_offer" size="10" maxlength="8"  	value="<?php echo $point_config['del_offer'];?>">
              <?php echo lang_show('epoint');?> </td>
        </tr>
        <tr>
          <td height="27" align="left"><?php echo lang_show('pubjob');?></td>
          <td align="left"><input name="pub_job" type="text" id="pub_job" size="10" maxlength="8"  	value="<?php echo $point_config['pub_job'];?>">
              <?php echo lang_show('epoint');?></td>
          <td align="left"  >
            <?php echo lang_show('lookinfo');?></td>
          <td align="left"><input name="look_contact" type="text" id="look_contact" size="10" maxlength="8"  	value="<?php echo $point_config['look_contact'];?>">
              <?php echo lang_show('epoint');?></td>
        </tr>
        <tr>
          <td height="34" align="left"   ><?php echo lang_show('comorder');?></td>
          <td  align="left" ><input name="com_order" type="text" id="com_order" size="10" maxlength="8"  	value="<?php echo $point_config['com_order'];?>">
              <?php echo lang_show('epoint');?> </td>
          <td align="left"> <?php echo lang_show('ev_logo');?> </td>
          <td align="left"><input name="every_logo" type="text" id="every_logo" size="10" maxlength="8"  	value="<?php echo $point_config['every_logo'];?>">
              <?php echo lang_show('epoint');?> </td>
        </tr>
        <tr>
          <td height="34" align="left"   ><?php echo lang_show('rmbtopoint');?><?php echo lang_show('epoint');?></td>
          <td  align="left" ><p>
              <input name="rmb_point" type="text" id="rmb_point" size="10" maxlength="8"  	value="<?php echo $point_config['rmb_point'];?>">
              <?php echo lang_show('epoint');?> </td>
          <td height="34" align="left"   ><?php echo lang_show('endorder');?></td>
          <td align="left" ><p>
              <input name="end_order" type="text" id="end_order" size="10" maxlength="8"  	value="<?php echo $point_config['end_order'];?>">
              <?php echo lang_show('epoint');?> </td>
        </tr>
        <tr>
          <td height="34" align="left"   ><?php echo lang_show('promsite');?></td>
          <td align="left" ><input name="promote" type="text" id="promote" size="10" maxlength="8"  	value="<?php echo $point_config['promote'];?>">
              <?php echo lang_show('epoint');?></td>
          <td height="34" align="left"   ><?php echo lang_show('answer');?></td>
          <td align="left" ><input name="answer" type="text" id="answer" size="10" maxlength="8"  	value="<?php echo $point_config['answer'];?>">
              <?php echo lang_show('epoint');?></td>
        </tr>
        <tr>
          <td height="34" align="left"   ><?php echo lang_show('bestanswer');?></td>
          <td align="left" ><input name="bestanswer" type="text" id="bestanswer" size="10" maxlength="8"  	value="<?php echo $point_config['bestanswer'];?>">
              <?php echo lang_show('epoint');?></td>
          <td height="34" align="left"   ><?php echo lang_show('questionexpired');?></td>
          <td align="left" ><input name="question_expired" type="text" id="question_expired" size="10" maxlength="8"  	value="<?php echo $point_config['question_expired'];?>"></td>
        </tr>
        <tr>
          <td height="34" align="right"   >&nbsp;</td>
          <td height="34" colspan="3" align="left" ><input class="btn" type="submit" name="submit" value="<?php echo lang_show('submit');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"></td>
        </tr>
		  <tr>
          <td height="34" colspan="4" align="left" style="color:#666666"><?php echo lang_show('use_des');?></td>
        </tr>
      </table>

	</form>
	</div>
</div>
</body>
</HTML>