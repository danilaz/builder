<?php
include_once("../includes/global.php");
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
@include_once("../lang/" . $config['language'] . "/admin/global.php");
@include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//======================================
if(!empty($_POST['olduser'])&&!empty($_POST['newuser'])&&(trim($_POST['olduser'])!=trim($_POST['newuser'])))
{	
	$old_user=trim($_POST['olduser']);
	$new_user=trim($_POST['newuser']);
	$new_uid=0;
	$old_uid=0;
	$sql="select userid,user from ".ALLUSER." where user IN('$old_user','$new_user')";
	$db->query($sql);
	if($db->num_rows()==2)
	{
		while($list=$db->fetchRow())
		{
			if($list['user']==$old_user)
				$old_uid = $list['userid'];
			if($list['user']==$new_user)
				$new_uid = $list['userid'];
		}
	}

	if($old_uid>0&&$new_uid>0&&$old_uid!=$new_uid)
	{	
		ext_all("update_uid",array('old_uid'=>"$old_uid",'new_uid'=>"$new_uid",'old_user'=>"$old_user",'new_user'=>"$new_user"));
		//=======================
		$sql="update ".COMMENT." set fromuid='$new_uid',fromname='$new_user' where fromuid='$old_uid'";
		$db->query($sql);
		$sql="update ".CREC." set uid=IF(uid='$old_uid','$new_uid',uid),touid=IF(touid='$old_uid','$new_uid', touid)  where uid='$old_uid' or touid='$old_uid'";
		$db->query($sql);
		$sql="update ".FCAT." set userid='$new_uid' where userid='$old_uid'";
		$db->query($sql);
		$sql="update ".FEED." set userid='$new_uid' where userid='$old_uid'";
		$db->query($sql);
		$sql = "update ".FEEDBACK." set touserid=IF(touserid='$old_uid','$new_uid',touserid),fromuserid=IF(fromuserid='$old_uid','$new_uid', fromuserid)   where touserid='$old_uid' or fromuserid='$old_uid'";
		$db->query($sql);
		$ofuid=NULL;
		$nfuid=NULL;
		$sql="select fuid from ".FRIENDS." where uid='$old_uid'";
		$db->query($sql);
		while($pl=$db->fetchRow())
		{
			$ofuid[]=$pl['fuid'];
		}
		$sql="select fuid from ".FRIENDS." where uid='$new_uid'";
		$db->query($sql);
		while($pl=$db->fetchRow())
		{
			$nfuid[]=$pl['fuid'];
		}
		$ofuid=$ofuid==NULL?NULL:implode(',',$ofuid);
		$nfuid=$nfuid==NULL?NULL:implode(',',$nfuid);
		$oasql=$ofuid==NULL?"":" and fuid not in($ofuid)";
		$nasql=$nfuid==NULL?"":" and fuid not in($nfuid)";
		$sql = "update ".FRIENDS." set uid=IF(uid='$old_uid' $nasql,'$new_uid',uid),fuid=IF(fuid='$old_uid' $oasql,'$new_uid',fuid) where uid='$old_uid' or fuid='$old_uid'";
		$db->query($sql);		
		//---------------------------------
		$sql="delete from ".ALLUSER." where userid='$old_uid'";
		$db->query($sql);
		$sql="delete from ".USER." where userid='$old_uid'";
		$db->query($sql);
		//=========================
		admin_msg($_POST['s'].".php","Пользователь '$old_user'、'$new_user' Завершено объединение данных");	
	}
	else
		admin_msg($_POST['s'].".php","Пользователь '$old_user'、'$new_user' Совмещены ошибки");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
<title><?php echo lang_show('admin_system');?></title>
</head>
<body>
<form method="post" action="">
<div class="bigbox">
	<div class="bigboxhead">Совместное членство (объединение участников)</div>
	<div class="bigboxbody">
<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center" class="menu">
  <tr height="25" style="font-weight:bold;"> 
  	<td align="center" width="50">
	Старое имя пользователя: <input type="type" name="olduser" value="" />
	</td>
	<td align="center" width="50">Новое имя пользователя: <input type="type" name="newuser" value="" /></td>
	<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2">
			<input type="submit" value="Объединить" />
			<input type="hidden" name="submit" value="merge" />
			<input type="hidden" name="s" value="merge_user" />
		</td>
	</tr>
</table>
	</div>
</div>
</form>
</body>
</html>