<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//====================================
if(!empty($_GET['action'])&&$_GET["action"]=="del")
{
	if(isset($_GET['groupid'])&&$_GET['groupid']>3)
	  $deletegroupid=$_GET['groupid'];
	else
	  $deletegroupid=0;
	$sql="delete from ".USERGROUP." where group_id='".$deletegroupid."'"; 
	$db->query($sql);
	$sql="delete from ".USERMODULES." where group_id='".$deletegroupid."'"; 
	$db->query($sql);
	msg(" membergroup.php");
}
//=======================================
$group_array=array('groupname','groupstatu','groupdes','groupdes','grouplogo','groupid','minilogo','groupfee');
if(!empty($_POST['submit'])&&$_POST["submit"]==lang_show('add')&&!empty($_POST['groupname']))
{
	$creattime=date("Y-m-d h:i:s");
	$groupn=$_POST['groupname'];
	$groups=$_POST['groupstatu'];
	$fee=$_POST['groupfee']*1;
	$minilogo=$_POST['minilogo'];
	if(!isset($_POST['groupdes']))
	   $groupd=NULL;
	else  
	   $groupd=$_POST['groupdes'];
	if (!isset($_POST['grouplogo'])) 
	   $groupl=NULL;
	else 
	   $groupl=$_POST['grouplogo'];
	
    $sql="insert into ".USERGROUP." (name,des,logo,statu,creat_time,minilogo,groupfee) 
	      values ('$groupn','$groupd','$groupl','$groups','$creattime','$minilogo','$fee')";
	$db->query($sql);
	$groupsid=$db->lastid();
	
	if(!empty($_POST['infotype']))
		$_POST['infotype']=implode(",",$_POST['infotype']);
	else
		$_POST['infotype']=NULL;

	if(!empty($_POST['shoptemp']))
		$_POST['shoptemp']=implode(",",$_POST['shoptemp']);
	else
		$_POST['shoptemp']=NULL;
	
	foreach($_POST as $key=>$v)
	{
		if(!in_array($key,$group_array))
		{
			$sql="insert into ".USERMODULES." (`index`,value,group_id) 
				  values ('$key','$v','$groupsid')";
			$db->query($sql);
		}
	}
	creat_file();
}

if(!empty($_POST['edit'])&&!empty($_POST['groupid']))
{
    unset($grpid);
	$grpid=$_POST['groupid'];  
	$groupn=$_POST['groupname'];
	$groups=$_POST['groupstatu'];
	$minilogo=$_POST['minilogo'];
	$fee=$_POST['groupfee']*1;
	$groupd=$_POST['groupdes'];
	$groupl=$_POST['grouplogo'];
	$creattime=date("Y-m-d h:i:s");	
	if(!empty($groupn))
		$sql=",name='$groupn'";
	else
		$sql=NULL;
	$sql="update ".USERGROUP." set 
		des='$groupd',logo='$groupl',minilogo='$minilogo',statu='$groups',creat_time='$creattime' ,groupfee='$fee' $sql
    	where group_id='$grpid'";
	$db->query($sql);
	
	if(!empty($_POST['infotype']))
		$_POST['infotype']=implode(",",$_POST['infotype']);
	else
		$_POST['infotype']=NULL;

	if(!empty($_POST['shoptemp']))
		$_POST['shoptemp']=implode(",",$_POST['shoptemp']);
	else
		$_POST['shoptemp']=NULL;
	foreach($_POST as $key=>$v)
	{
		if($key!="submit"&&$key!='edit')
		{
			if(!in_array($key,$group_array))
			{
				$sql="select * from ".USERMODULES." where `index`='$key' and group_id='$grpid'";
				$db->query($sql);
				if($db->num_rows())
					$sql="update ".USERMODULES." set value='$v' where `index`='$key' and group_id='$grpid'";
				else
					$sql="insert into ".USERMODULES." (`index`,value,group_id) values ('$key','$v','$grpid')";
				$db->query($sql);
			}
		}
	}
	creat_file();
	msg('membergroup.php');
}
//==================================
function creat_file()
{
	$write_group_data=get_user_group();//从库里取出数据生成数组
	$write_str=serialize($write_group_data);//将数组序列化后生成字符串
	$write_str='<?php $group = unserialize(\''.$write_str.'\');?>';//生成要写的内容
	$fp=fopen('../config/usergroup.php','w');
	fwrite($fp,$write_str,strlen($write_str));//将内容写入文件．
	fclose($fp);
}
function get_user_group()
{
	global $db;
	$sql="select * from ".USERGROUP;
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $key=>$v)
	{
		$sql="select * from ".USERMODULES." where group_id='$v[group_id]'";
		$db->query($sql);
		$mo=$db->getRows();
		foreach($mo as $mv)
		{
			$mos[$mv['index']]=$mv['value'];
		}
		$v['modeu']=$mos;
		$gid=$v['group_id'];
		$sre[$gid]=$v;
	}
	return $sre;
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
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('membergroup_manager');?></div>
<?php
if(empty($_GET['action']))
	$_GET['action']=NULL;
if(empty($_GET['action'])&&$_GET['action']!="add")
{
?>
<div class="bigbox">
<div class="bigboxhead">
<span style="float:left"><?php echo lang_show('allmembergroup');?></span>
<span style="float:right"><a style="color:#FFFFFF; padding-right:100px;" href="?action=add"><?php echo lang_show('addgroup');?></a></span>
</div>
    <div class="bigboxbody">
    <form name="groupuser" method="get" action="membergroup.php">
    <table width="100%" border="0">
	    <tr>
          <td height="31" ><b>Название</b></td>
          <td ><b>Номер</b></td>
          <td ><b>Статус</b></td>
          <td ><b>Иконка</b></td>
          <td ><b>Ежегодный взнос</b></td>
          <td ><b>Описание</b></td>
          <td width="186" ><b>Действие</b></td>
        </tr>
        <?php
        $sql="select * from ".USERGROUP." order by group_id asc";
        $db->query($sql);
        $re=$db->getRows();
        foreach($re as $v)
	    {
        ?>
        <tr>
          <td width="127" height="31" ><?php echo $v['name'];?></td>
          <td width="64" height="31" ><?php echo $v['group_id'];?></td>
          <td width="65" >
		  <?php if($v['group_id']>1){if ($v['statu']==1) echo lang_show('qiyong'); else echo lang_show('tingyong');} ?>&nbsp;		  </td>
          <td width="77" ><?php if($v['group_id']>1) echo "<img src='".$v['minilogo']."' >";?>&nbsp;</td>
          <td width="66" ><?php if($v['group_id']>1) echo $v['groupfee'] . '&nbsp;' . $config['money'];?>&nbsp;</td>
          <td width="398" ><?php echo $v['des'];?>&nbsp;</td>
          <td >
		  
		  <?php
			if($v['group_id']>=-2){
		   ?>
		  <a href="membergroup.php?action=modify&groupid=<?php echo $v['group_id']; ?>"><?php echo lang_show('xiugai');?></a>
		  <?php } ?>		  
		  
		   <?php
			if($v['group_id']>4){
		   ?>
			<a href="membergroup.php?action=del&groupid=<?php echo $v['group_id'] ;?>" onClick="javascript:return confirm('<?php echo lang_show('suredelugroup');?>')"><?php echo lang_show('shanchu');?></a>
		  <?php
			}
		   ?>
&nbsp;		   </td>
        </tr>
        <?php
          }
         ?>
		 <tr>
          <td height="31" colspan="7" style="color:#666666">
		  1. Пользователи включают в себя шесть клаасов членства по умолчанию. Участников членства по-умолчанию нельзя удалять.<br>
		  2. Первые три вида членства нельзя изменять, остальные три вида членства могут быть изменены или отключены.<br>
		  3. Если уровень членства недостаточен, Вы можете настроить его. Не разрешено поднятие с низкого на высокий уровень членства, чем выше число системы, тем более высокий уровень членства. Пользовательские типы элементов могут быть удалены.		  </td>
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
  if(isset($_GET['groupid']))
      $groupid=$_GET['groupid'];
  else
      $groupid=NULL;
  $sql="select * from ".USERMODULES." where group_id='".$groupid."'"; 
  $db->query($sql);
  $re=$db->getRows();
  foreach($re as $v)
  {
	$index=$v['index'];
	$value=$v['value'];
	$usermod[$index]=$value;
  }
  $sql="select * from ".USERGROUP." where group_id='".$groupid."'";
  $db->query($sql);
  $rs=$db->fetchRow();
?>
<form method="post" action="membergroup.php">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('groupxiugai');?></div>
<div class="bigboxbody">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%"><?php echo lang_show('shuxing');?></td>
    <td  valign="top" width="90%">
	
	<table width="100%" border="0">
	<?php
	if($_GET['groupid']>=-2)
	{
	?>
      <tr>
        <td height="40" ><?php echo lang_show('groupzt');?></td>
        <td width="630">
          <input type="radio" name="groupstatu" value="1" <?php if($rs['statu']==1) echo "checked"; ?>>
          <?php echo lang_show('qiyong');?>
          <input type="radio" name="groupstatu" value="0" <?php if($rs['statu']==0) echo "checked"; ?>>
          <?php echo lang_show('tingyong');?>
		  </td>
        </tr>
      <tr>
        <td width="232" ><?php echo lang_show('groupname');?></td>
        <td>
          <input name="groupname" type="text" id="groupname" size="32" maxlength="30" value="<?php echo $rs['name']; ?>">
		  </td>
        </tr>
      <tr>
        <td ><?php echo lang_show('gpfee');?></td>
        <td ><input name="groupfee" type="text" id="groupfee" style="width:60px;" value="<?php echo $rs['groupfee'];?>"></td>
      </tr>
	<?php 
	} 
	else
		echo '<input name="groupstatu" type="hidden" value="1">';
	?>	
      <tr>
        <td ><?php echo lang_show('groupdes');?></td>
        <td >
          
          <textarea name="groupdes" id="groupdes" style="width:380px;height:70px;"><?php echo $rs['des']; ?></textarea>        </td>
        </tr>
      <tr>
        <td><?php echo lang_show('grouplogo');?></td>
        <td >
          <input name="grouplogo" type="text" id="grouplogo" style="width:380px;" value="<?php echo $rs['logo']; ?>">
		 [<a href="javascript:uploadfile('Загрузить логотип','grouplogo',180,60)">Загрузить</a>] 
		 [<a href="javascript:preview('grouplogo');">Предпросмотр</a>]
		 [<a onclick="javascript:$('grouplogo').value='';" href="#">Удалить</a>]
		  </td>
        </tr>
      <tr>
        <td><?php echo lang_show('minilogo');?></td>
        <td>
          <input name="minilogo" type="text" style="width:380px;" id="minilogo" value="<?php if(!empty($rs['minilogo'])) echo $rs['minilogo'];?>" size="30">
          <input type="hidden" name="groupid" id="groupid" value="<?php echo $rs['group_id']; ?>">
		  [<a href="javascript:uploadfile('Загрузить логотип','minilogo',180,60)">Загрузить</a>] 
		 [<a href="javascript:preview('minilogo');">Предпросмотр</a>]
		 [<a onclick="javascript:$('minilogo').value='';" href="#">Удалить</a>]
		  
		  </td>
      </tr>
    </table>
	
	</td>
  </tr>

  <tr>
    <td width="10%" height="76"><?php echo lang_show('quanxian');?></td>
    <td width="90%"  valign="top"><table width="100%" border="0">
	<?php if($_GET['groupid']>1){?>
      <tr>
        <td width="234"  ><?php echo lang_show('chanps');?></td>
        <td width="176"  >
          <input name="pro" type="text" id="pro" maxlength="4" value="<?php echo $usermod['pro']; ?>">        </td>
        <td width="254"  ><?php echo lang_show('youqlj');?></td>
        <td width="190"  >
          
          <input name="link" type="text" id="link" maxlength="4" value="<?php echo $usermod['link'] ?>">        </td>
      </tr>
      <tr>
        <td><?php echo lang_show('shangqs');?></td>
        <td >
          
          <input name="offer" type="text" id="offer" maxlength="4" value="<?php echo $usermod['offer']; ?>">        </td>
        <td > <?php echo lang_show('zhaops');?></td>
        <td >
          
          <input name="hr" type="text" id="hr" maxlength="4" value="<?php echo $usermod['hr']; ?>">        </td>
      </tr>
      
      <tr>
        <td>Количество спроса</td>
        <td >
          
          <input name="demand" type="text" id="demand" maxlength="4" value="<?php echo $usermod['demand']; ?>">        </td>
        <td ></td>
        <td ></td>
      </tr> 
      
      <tr>
        <td><?php echo lang_show('xinws');?></td>
        <td >
          
          <input name="news" type="text" id="news" maxlength="4" value="<?php echo $usermod['news']; ?>">        </td>


        <td><?php echo lang_show('shipin');?></td>
        <td >
          
          <input name="video" type="text" id="video" maxlength="4" value="<?php echo $usermod['video']; ?>">        </td>
      </tr>
      <tr>
        <td><?php echo lang_show('tups');?></td>
        <td >
          
          <input name="album" type="text" id="album" maxlength="4" value="<?php echo $usermod['album']; ?>">        </td>

        <td><?php echo lang_show('album_cat');?></td>
        <td >
          
          <input name="album_cat" type="text" id="album_cat" maxlength="4" value="<?php if(!empty($usermod['album_cat']))echo $usermod['album_cat']; ?>">        </td>
      </tr>
      <tr>
        <td ><?php echo lang_show('projects');?></td>
        <td ><input type="text" name="project" id="project" maxlength="4" value="<?php if(!empty($usermod['project']))echo $usermod['project']; ?>">        </td>
        <td ><?php echo lang_show('subscrib');?></td>
        <td ><input type="text" name="subscribe" id="subscribe" maxlength="4" value="<?php if(!empty($usermod['subscribe']))echo $usermod['subscribe']; ?>"></td>
      </tr>
      <tr>
        <td ><?php echo lang_show('rec_pro');?></td>
        <td ><input type="text" name="rec_pro" id="rec_pro" maxlength="4" value="<?php if(!empty($usermod['rec_pro']))echo $usermod['rec_pro']; ?>"></td>
        <td ><?php echo lang_show('pro_cat');?></td>
        <td ><input name="pro_cat" type="text" id="pro_cat" maxlength="4" value="<?php if(!empty($usermod['pro_cat']))echo $usermod['pro_cat']; ?>"></td>
      </tr>
            <tr>
              <td width="118" align="left" scope="row">Проверка продуктов</td>
          <td width="227" align="left">
		  <input type="radio" name="proCheck" value="0" <?php
		  if ($usermod['proCheck']==0)
			echo "checked";
		  ?>>Да
  <input type="radio" name="proCheck" value="1" <?php
		  if ($usermod['proCheck']==1)
			echo "checked";
		  ?>>Нет
		 </td>
          <td width="135" align="left">Проверка видео</td>
          <td width="225" align="left"><input type="radio" name="user_video_fb" id="user_video_fb2" value="0" <?php
		  if ($usermod['user_video_fb']==0)
			echo "checked";
		  ?>>Да
            <input type="radio" name="user_video_fb" id="user_video_fb" value="1" <?php
		  if ($usermod['user_video_fb']==1)
			echo "checked";
		  ?>>Нет</td>
        </tr>
            <tr>
              <td align="left">Закачка видео файлов</td>
              <td align="left" ><input type="radio" name="openvideoupload" value="1" <?php
		  if ($usermod['openvideoupload']==1)
			echo "checked";
		  ?>>Да
                <input type="radio" name="openvideoupload" value="0" <?php
		  if ($usermod['openvideoupload']==0)
			echo "checked";
		  ?>>Нет</td>
              <td align="left" >Уведомления по электронной почте</td>
              <td align="left" ><input type="radio" name="openmesmail" value="1" <?php
		  if ($usermod['openmesmail']==1)
			echo "checked";
		  ?>>Да
                <input type="radio" name="openmesmail" value="0" <?php
		  if ($usermod['openmesmail']==0)
			echo "checked";
		  ?>>Нет</td>
            </tr>
            <tr>
          <td width="118" align="left">Проверка предложений</td>
          <td width="227" align="left" ><input type="radio" name="infoCheck" value="0" <?php
		  if ($usermod['infoCheck']==0)
			echo "checked";
		  ?>>Да
		<input type="radio" name="infoCheck" value="1" <?php
		  if ($usermod['infoCheck']==1)
			echo "checked";
		  ?>>Нет</td>
          <td width="135" align="left" >Проверка новостей</td>
          <td width="225" align="left" >
            <input type="radio" name="user_news_fb" id="user_news_fb" value="0" <?php
		  if ($usermod['user_news_fb']==0)
			echo "checked";
		  ?>>Да
  <input type="radio" name="user_news_fb" id="user_news_fb2" value="1" <?php
		  if ($usermod['user_news_fb']==1)
			echo "checked";
		  ?>>Нет</td>
            </tr>
            <tr>
        <td ><?php echo lang_show('user_add_news');?></td>
        <td >
          <input name="user_add_news" type="radio" id="radio" value="1" checked>
          <?php echo lang_show('qiyong');?>
          <input type="radio" name="user_add_news" id="radio2" value="0" <?php if ($usermod['user_add_news']==0) echo "checked"; ?>>
          <?php echo lang_show('tingyong');?></td>
        <td ><?php echo lang_show('jsbook');?></td>
        <td >
          <input name="jsbook" type="radio" id="radio3" value="1" checked>
          <?php echo lang_show('qiyong');?>
          <input type="radio" name="jsbook" id="radio4" value="0" <?php if ($usermod['jsbook']==0) echo "checked"; ?>>
          <?php echo lang_show('tingyong');?></td>
      </tr>
      <tr>
        <td ><?php echo lang_show('open_info_type');?></td>
        <td ><input name="open_info_type" type="radio" id="radio8" value="1" checked>
          <?php echo lang_show('qiyong');?>
          <input type="radio" name="open_info_type" id="radio7" value="0" <?php if ($usermod['open_info_type']==0) echo "checked"; ?>>
          <?php echo lang_show('tingyong');?></td>
        <td ><?php echo lang_show('mobilmsg');?></td>
        <td ><input name="mobilmsg" type="radio" id="radio5" value="1" checked >
          <?php echo lang_show('qiyong');?>
            <input type="radio" name="mobilmsg" id="radio6" value="0" <?php if ($usermod['mobilmsg']==0) echo "checked"; ?>>
            <?php echo lang_show('tingyong');?></td>
      </tr>
      <tr>

        <td ><?php echo lang_show('shop_set');?></td>
        <td ><input type="radio" name="shop_setting" id="shop_setting2" value="1" <?php if ($usermod['shop_setting']==1) echo "checked"; ?>>
        <?php echo lang_show('qiyong');?>
        <input type="radio" name="shop_setting" id="shop_setting4" value="0" <?php if ($usermod['shop_setting']==0) echo "checked"; ?>>
        <?php echo lang_show('tingyong');?> </td>
        <td ><?php echo lang_show('replace_outside_link');?></td>
        <td ><input type="radio" name="replace_outside_link" id="replace_outside_link1" value="1" <?php if ($usermod['replace_outside_link']==1) echo "checked"; ?>>
          <?php echo lang_show('qiyong');?>
          <input type="radio" name="replace_outside_link" id="replace_outside_link2" value="0" <?php if ($usermod['replace_outside_link']==0) echo "checked"; ?>>
          <?php echo lang_show('tingyong');?></td>
      </tr>
	  
      <tr>


        <td ><?php echo lang_show('shuaxsq');?></td>
        <td >
          <input type="radio" name="refresh_all_offer" id="temp5" value="1" <?php if ($usermod['refresh_all_offer']==1) echo "checked"; ?>>
<?php echo lang_show('qiyong');?>
  <input type="radio" name="refresh_all_offer" id="temp6" value="0" <?php if ($usermod['refresh_all_offer']==0) echo "checked"; ?>>
<?php echo lang_show('tingyong');?></td>
        <td ><?php echo lang_show('shuaxcp');?></td>
        <td >
          <input type="radio" name="refresh_all_pro" id="temp3" value="1" <?php if ($usermod['refresh_all_pro']==1) echo "checked"; ?>>
          <?php echo lang_show('qiyong');?>
          <input type="radio" name="refresh_all_pro" id="temp4" value="0" <?php if ($usermod['refresh_all_pro']==0) echo "checked"; ?>>
          <?php echo lang_show('tingyong');?></td>
      </tr>

	  <?php }
	 if($_GET['groupid']>0){
	  ?>
      <tr>
        <td><?php echo lang_show('infotype');?></td>
        <td colspan="3">
		<?php 
		if(!empty($usermod['infotype']))
			$usermod['infotype']=explode(',',$usermod['infotype']);
		include("../lang/$config[language]/company_type_config.php");
		unset($infoType[0]);
		foreach($infoType as $key=>$v)
		{
			if(!empty($usermod['infotype'])&&in_array($key,$usermod['infotype']))
				$ck= "checked";
			else
				$ck=NULL;
			echo '<input name="infotype[]" type="checkbox" '.$ck.' value="'.$key.'">'.$v;
		} 
		?></td>
        </tr>
		<?php } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <input class="btn" type="submit" name="edit" value="<?php echo lang_show('modifyok');?>" onClick='return confirm("<?php echo lang_show('are_you_sure');?>");'/>&nbsp;&nbsp;
     <input class="btn" type="button" name="cancel" id="cancel" value="<?php echo lang_show('cancel');?>" onclick='javascript:window.location="membergroup.php"' />
     </td>
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
?>
<form method="post" action="membergroup.php">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('groupzengjia');?></div>
<div class="bigboxbody">
<table width="100%" height="283" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="135" height="40"  ><?php echo lang_show('groupname');?></td>
        <td>
          
          <input name="groupname" type="text" id="groupname" size="32" >        </td>
        </tr>
      <tr>
        <td height="27"  ><?php echo lang_show('gpfee');?></td>
        <td ><input name="groupfee" type="text" id="groupfee" style="width:380px;" ></td>
      </tr>
      <tr>
        <td height="83"  ><?php echo lang_show('groupdes');?></td>
        <td >
          
          <textarea name="groupdes" id="groupdes" style="width:380px;height:70px;"></textarea>        </td>
        </tr>
      <tr>
        <td height="47"  ><?php echo lang_show('grouplogo');?></td>
        <td >
          <input name="grouplogo" type="text" id="grouplogo" style="width:380px;"  />        </td>
        </tr>
      <tr>
        <td height="43"><?php echo lang_show('minilogo');?></td>
        <td>
          <input name="minilogo" type="text" id="minilogo" style="width:380px;" />        </td>
        </tr>
      <tr>
        <td height="43">&nbsp;</td>
        <td>
		<input class="btn" type="submit" name="submit" value="<?php echo lang_show('addsure');?>"/>
          &nbsp;&nbsp;
          <input class="btn" type="button" name="cancel2" id="cancel2" value="<?php echo lang_show('cancel');?>" onClick='javascript:window.location="membergroup.php"' /></td>
      </tr>
    </table>
</div>
</div>
</form>
<?php
}
?>
</body>
</html>