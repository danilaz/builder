<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
@include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=========================================
$type='home';
if(!empty($_POST['submit'])&&$_POST["submit"]==lang_show('submit'))
{
	unset($_POST['submit']);
	foreach($_POST as $pname=>$pvalue)
	{
		$sql="select * from ".CONFIG." where `index`='$pname' and type='$type'";
		$db->query($sql);
		if($db->num_rows())
		   $sql1=" update ".CONFIG." SET value='$pvalue',type='$type' where `index`='$pname'";
		else
		   $sql1="insert into ".CONFIG." (`index`,value,type) values ('$pname','$pvalue','$type')";
		$db->query($sql1);
	}
	/****更新缓存文件*********/
	$write_config_con_array=read_config($type);//从库里取出数据生成数组
	$write_config_con_str=serialize($write_config_con_array);//将数组序列化后生成字符串
	$write_config_con_str=str_replace("'","\'",$write_config_con_str);
	$write_config_con_str='<?php $'.$type.'_config = unserialize(\''.$write_config_con_str.'\');?>';//生成要写的内容
	$fp=fopen('../config/'.$type.'_config.php','w');
	fwrite($fp,$write_config_con_str,strlen($write_config_con_str));//将内容写入文件．
	fclose($fp);
	/*********************/
	admin_msg($type."_config.php","Настройки сохранены!");
	exit;
}
//===读库函数，生成config形式的数组====
function read_config($type)
{
	global $db;
	$sql="select * from ".CONFIG." where type='$type'";
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
$reg_config=read_config($type);
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
	<div class="bigboxhead">Настройка главной страницы</div>
	<div class="bigboxbody">
	<form name="sysconfig" action="" method="post" style="margin-top:0px;">
	<table width="100%" cellspacing="0">
		        <tr>
		          <td colspan="2"  align="left" >Примечание: Если укажите 0 - отображаться не будет</td>
        </tr>
		        <tr>
          <td width="16%"  align="left" >Кол-во топ слов</td>
          <td width="84%" align="left" >
            <input name="hot_num" type="text" id="hot_num" value="<?php echo $reg_config['hot_num'];?>" size="10"></td>
        </tr>
                <tr>
                  <td height="40" align="left">Кол-во предложений на главной</td>
                  <td align="left" ><input name="offer_num" type="text" id="offer_num" size="10" value="<?php echo $reg_config['offer_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во рекомендуемых продуктов на главной (графика)</td>
                  <td align="left" ><input name="pro_pic_num" type="text" id="pro_pic_num" size="10" value="<?php echo $reg_config['pro_pic_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во рекомендуемых продуктов на главной (текст)</td>
                  <td align="left" ><input name="pro_text_num" type="text" id="pro_text_num" size="10" value="<?php echo $reg_config['pro_text_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во продуктов в категории (1)</td>
                  <td align="left" ><input name="pro_cat_num" type="text" id="pro_cat_num" size="10" value="<?php echo $reg_config['pro_cat_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во продуктов в категории (2)</td>
                  <td align="left" ><input name="pro_cat1_num" type="text" id="pro_cat1_num" size="10" value="<?php echo $reg_config['pro_cat1_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Быстрый индекс категорий</td>
                  <td align="left" ><input name="cat_index" type="text" id="cat_index" size="10" value="<?php echo $reg_config['cat_index'];?>">
                  Укажите 1 или 0, соответственно (да/нет)</td>
                </tr>
                <tr>
                  <td height="40" align="left">Рынок сегодня</td>
                  <td align="left" ><input name="today_info" type="text" id="today_info" size="10" value="<?php echo $reg_config['today_info'];?>">
                  Укажите 1 или 0, соответственно (да/нет)</td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во в списке компаний</td>
                  <td align="left" ><input name="rec_user_num" type="text" id="rec_user_num" size="10" value="<?php echo $reg_config['rec_user_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во новых компаний</td>
                  <td align="left" ><input name="new_user_num" type="text" id="new_user_num" size="10" value="<?php echo $reg_config['new_user_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во выставок</td>
                  <td align="left" ><input name="exp_num" type="text" id="exp_num" size="10" value="<?php echo $reg_config['exp_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во вакансий</td>
                  <td align="left" ><input name="job_num" type="text" id="job_num" size="10" value="<?php echo $reg_config['job_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во резюме</td>
                  <td align="left" ><input name="resume_num" type="text" id="resume_num" size="10" value="<?php echo $reg_config['resume_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во вопросов</td>
                  <td align="left" ><input name="ask_num" type="text" id="ask_num" size="10" value="<?php echo $reg_config['ask_num'];?>"></td>
                </tr>
                <tr>
                  <td height="40" align="left">Кол-во опросов</td>
                  <td align="left" ><input name="post_num" type="text" id="post_num" size="10" value="<?php echo $reg_config['post_num'];?>"></td>
                </tr>
        <tr>
          <td width="16%" height="40" align="right">&nbsp;</td>
          <td width="84%" align="left" ><input  class="btn" type="submit" name="submit" value="<?php echo lang_show('submit');?>"></td>
        </tr>
      </table>
	</form>
	</div>
</div>
</body>
</HTML>