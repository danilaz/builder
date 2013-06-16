<?php
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../includes/global.php");
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
@session_start();
//===========================================
if(empty($_SESSION["ADMIN_USER"])||empty($_SESSION["ADMIN_PASSWORD"]))
	msg('index.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<title><?php echo lang_show('business_manager_system');?></title>

</head>
<body>
<div class="bigbox">
	<div class="bigboxhead"><span style=" float:left;"><?php echo lang_show('manager_home');?></span><span style="float:right; padding-right:20px;"><?php echo lang_show('todayis');?><?php echo date("Y-m-d H:i:s", time());?></span></div>
	<div class="bigboxbody" style="margin:0px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
          <tr>
            <td height="20" colspan="2" align="left" valign="middle" style="font-weight:bold;"><?php echo lang_show('myinfo');?></td>
      </tr>
          <tr>
            <td width="19%" align="left"><?php echo lang_show('yourgroup');?></td>
            <td width="81%"><?php echo $_SESSION["ADMIN_USER"];?></td>
          </tr>
          <?php 
		  $sql="select * from ".ADMIN." where user='".$_SESSION["ADMIN_USER"]."'";
		  $db->query($sql);
          $re=$db->fetchRow();
		  ?>
		   <tr>
            <td width="19%" align="left"><?php echo lang_show('lastlogoip');?></td>
            <td><?php echo $re['logoip'];?></td>
          </tr>
          <tr>
            <td align="left"><?php echo lang_show('logoip');?></td>
            <td><?php echo getip();?></td>
          </tr>
		  <tr>
            <td align="left"><?php echo lang_show('lastlogotime');?></td>
            <td><?php echo date("Y-m-d H:i:s",$re['lastlogotime']);?></td>
          </tr>
          <tr>
            <td align="left"><?php echo lang_show('logonum');?></td>
            <td><?php echo $re['logonums'];?></td>
          </tr>
		  <tr>
		    <td align="left"><?php echo lang_show('vers');?></td>
		    <td><?php echo $config['version'];?></td>
      </tr>
		   <?php
            $lip=getip();
			$nt=time();
		    $sql="update ".ADMIN." set logoip='$lip',lastlogotime='$nt' where user='".$_SESSION["ADMIN_USER"]."'";
            $db->query($sql);
		  ?>
      </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
          <tr>
            <td height="20" align="left" valign="middle" style="font-weight:bold;"><?php echo lang_show('b2binfo');?></td>
          </tr>
          
          <tr>
            <td align="left">Powered By <a href="http://www.b2b-builder.com" style=" color:#0099CC;">B2B-builder.com</a> <?php echo lang_show('verauth');?></td>
          </tr>
        </table>
	</div>
</div>
</body>
</html>