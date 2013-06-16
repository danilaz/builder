<?php
session_start();
include_once("../includes/global.php");
//================================================
if(!empty($_POST["user"]))
{	
	if(strtolower($_SESSION["auth"])!=strtolower($_POST["yzm"]))
	{
		msg("index.php?type=2");
		exit();
	}
	else
	{
		$user=trim($_POST["user"]);
		$ps=md5(trim($_POST["password"]));
		if($user=="admin")
			$sql="select * from ".ADMIN." where user='$user' and password='$ps'";
		else
			$sql="
			SELECT
			   a.province,a.city,b.group_perms,a.id
			FROM
			  ".ADMIN." a, ".GROUP." b
			WHERE
			   a.group_id=b.group_id and a.user='$user' AND a.password='$ps'";
		$db->query($sql);
		$re=$db->fetchRow();
		if($re["id"])
		{
			$_SESSION["ADMIN_USER"]=$user; 
			$_SESSION["ADMIN_PASSWORD"]=$ps;
			if(isset($re["province"]))
				$_SESSION["province"]=$re["province"];
			else
				$_SESSION["province"]=NULL;
			if(isset($re["city"]))
				$_SESSION["city"]=$re["city"];
			else
				$_SESSION["city"]=NULL;
			
			$sql="update ".ADMIN." set logonums=logonums+1 where user='".$user."'";
            $db->query($sql);

			header("location:main.php");
			exit();
		}
		else
		{
			header("location:index.php?type=1");
			exit();
		}
	}
}
if(!empty($_GET["action"]))
{
	if($_GET["action"]=="logout")
	{
		$_SESSION["ADMIN_USER"]="";
		$_SESSION["ADMIN_PASSWORD"]="";
		unset($_SESSION["ADMIN_USER"]);
		unset($_SESSION["ADMIN_PASSWORD"]);
		unset($_SESSION["province"]);
		unset($_SESSION["city"]);
		msg("index.php");
		exit();
	}
}
//===============================
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
?>
<html>
<head>
<title><?php echo lang_show('admin_system');?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script src="../script/index.js" type=text/javascript></script>
</head>
<body class="body">
<center>
    <div class="main">
    <div style="height:125px;"></div>
        <div class="logo"><img src="../image/admin/logo.png"></div>
           <div class="bottom">
                <form method="post" action="index.php">
                  <table width="100%" height="377px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="38" valign="top" class="bgz"></td>
                          <td valign="top">
                          <table width="469px" height="377px" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td class="cen_t"></td>
                                  </tr>
                                  <tr>
                                    <td width="469px" height="310px" valign="top" background="../image/admin/center.jpg" style="background-position:top; background-repeat:no-repeat;" class="bgbg">
                                     <div class="bt"><?php echo lang_show('user_login');?></div>
                        <div class="yhxx">
                        <div>
                              <label>
                              <span class="wz"><?php echo lang_show('username');?>:</span><span class="wb">
                                <input value="admin" type="text" name="user" value="<?php if(isset($_POST["user"])) echo $_POST["user"];?>" class="text">
                                <?php
								if(isset($_GET["type"]))
								{
								 if($_GET["type"]==1)
									echo lang_show('error_user');
								}
								?>
                              </span>
                              </label>
                        
                         </div>
              <div><label><span class="wz"><?php echo lang_show('password');?>:</span>                            
                                <span class="wb"> <input type="password" name="password" class="text">
                              </span></label>
                          
                          </div>
                            
                         <div>                            
                           <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td style="width:60px;"><span class="wz"> <?php echo lang_show('verfiy');?>:</span></td>
                                <td style=" text-align:left!important; text-align:center; width:130px;"><label><span class="wb"><input type="text" name="yzm" class="text3">&nbsp;</span></label>
                                </td>
                                <td valign="middle">
                                <img onClick="get_randfunc(this);" style="padding-top:3px; cursor:pointer;" src='../includes/rand_func.php'/>
                            <?php
								if(isset($_GET["type"]))
								{
								 if($_GET["type"]==2)
									echo lang_show('error_verfiy');
								}
								?></td>
                             </tr>
                           </table>
                         </div>
                        </div>
                        <div class="button">
                        <input name="Submit" type="image" src="../image/admin/button.jpg">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input value="<?php echo lang_show('reset');?>" name="" type="image" src="../image/admin/button2.jpg">
                        </div>
                        <div class="bwz">
                        Powered by <a target="_blank" href="http://www.b2b-builder.com">B2B-builder.com</a> © 2007-2011
                        </div>     
                               </td>
                                  </tr>
                                  <tr>
                                    <td class="cen_b">&nbsp;</td>
                                  </tr>
                                </table>
                          </td>
                      <td width="38" valign="top" class="bgy">&nbsp;</td>
                    </tr>
                  </table>
                  
             </form>  
             
         </div>
    </div>
     
</center>

</body>

</html>