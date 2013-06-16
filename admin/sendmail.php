<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//======================================================
if(isset($_POST["action"]))
{
	$mcon=stripslashes($_POST['body']);
	$ntime=strtotime(date("Y-m-d H:i:s")); 
	$db->query("select a.lastLoginTime,a.user,b.company,b.contact,a.email from ".ALLUSER." a,".USER." b 
	where a.userid=b.userid and a.userid='$_POST[userid]'");
    $cons=$db->fetchRow();
	$mcon=str_replace('[username]',$cons['user'],$mcon);
	$mcon=str_replace('[company]',$cons['company'],$mcon);
	$mcon=str_replace('[lastlogintime]',date("Y-m-d H:i:s",$cons['lastLoginTime']),$mcon);
	$bday=($ntime-$cons['lastLoginTime'])/86400;
	$mcon=str_replace('[betweenday]',$bday,$mcon);
	$date=date("Y-m-d H:i");
	
	$sql="insert into ".FEEDBACK." (touserid,sub,con,date,msgtype) VALUES ('$_POST[userid]','$_POST[title]','$_POST[body]','$date',3)";
	$db->query($sql);

	$re=send_mail($_POST["email"],$cons["user"],$_POST["title"],$mcon);
	if($re)
		echo "<script>alert('".lang_show('send_ok')."');window.location='member.php';</script>";
	else
       echo "<script>alert('failed send mail!');window.location='member.php';</script>";
}
//============================
$db->query("select a.email,b.company from ".ALLUSER." a left join ".USER." b on a.userid=b.userid where a.userid='$_GET[userid]'");
$userd=$db->fetchRow();
//============================
if(isset($_GET["modid"]))
{
	$db->query("select * from ".MAILMOD." where id='$_GET[modid]'");
	$mde=$db->fetchRow();
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('mem_send_mail');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('send_mail');?></div>
	<div class="bigboxbody">
<table width="100%" border="0" cellspacing="1" cellpadding="0" height="460" >
    <tr>
      <td width="248" height="460" valign="top">
      <div style="border-right: 1px solid #999999; height:400px; line-height:23px; overflow-y:scroll;">
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
		<tr><td style="border:none; font-weight:bold;">Шаблоны почты</td></tr>
			 <?php
			$db->query("select * from ".MAILMOD." order by id desc");
			$lre=$db->getRows();
			foreach($lre as $v)
			{
			?> 
            <tr> 
              <td>
<?php echo "<a href=sendmail.php?userid=$_GET[userid]&modid=".$v["id"].">&raquo; ".$v["subject"]."</a>"; ?></td>
            </tr>
			<?php
			}
			?>
        </table>
       </div>
        
        <div align="center"><a href="mailmod.php"><strong><?php echo lang_show('main_tpl_manager');?></strong></a> </div></td>
      <td width="837" height="460" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="372">
          <form action="" method="post" enctype="multipart/form-data">
            <tr> 
              <td width="14%"> <?php echo lang_show('send_to');?>:</td>
              <td width="86%">
			    <?php echo $userd['company'];?><br>
                <input name="email" type="text" value="<?php echo $userd['email']; ?>" size="60">				</td>
            </tr>
            <tr> 
              <td width="14%"> <?php echo lang_show('mail_subject');?>:</td>
              <td width="86%"> 
                <input name="title" type="text" id="title"  value="<?php if(isset($mde["subject"])) echo $mde["subject"];?>" size="60">              </td>
            </tr>
            <tr> 
              <td width="14%" height="262" valign="top"> <?php echo lang_show('mail_content');?>:</td>

              <td width="86%" valign="top"> 
                <textarea name="body" cols="60" rows="18" id="body"><?php if (isset($mde["message"])) echo $mde["message"];?></textarea>              </td>
            </tr>
            <tr> 
              <td width="14%">&nbsp;</td>
              <td width="86%">
			  <input name="action" type="hidden" value="send">
			  <input name="userid" type="hidden" id="userid" value="<?php echo $_GET["userid"]; ?>">
			  <input class="btn" type="submit" name="cc" value="<?php echo lang_show('send_mail');?>">			  </td>
            </tr>
          </form>
        </table>      </td>
    </tr>
</table>
 </div>
</div> 

</body>
</html>
