<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//====================================
if(!empty($_GET['action'])&&$_GET['action']=='del'&&!empty($_GET['id']))
{
     $sql="delete from ".UDOMIN." where id='".trim($_GET['id'])."'";
	 $db->query($sql);
}
if(!empty($_GET['binddomin'])&&$_GET['binddomin']==lang_show('bingd'))
{
	$sql="select userid from ".UDOMIN." where userid='".trim($_GET['uid'])."'";
	$db->query($sql);	 
	if ($db->num_rows()<=0)
	{
	  $sql="insert into ".UDOMIN." (`domin`,`userid`,`time`) values ('".trim($_GET['userdomin'])."','".$_GET['uid']."',".time().")";
	  $db->query($sql);
	}
	else
	{
	  $sql="update ".UDOMIN." set domin='".trim($_GET['userdomin'])."',time=".time()." where userid=".$_GET['uid'];
	  $db->query($sql);
	}
}
if(!empty($_GET['delcheck'])&&$_GET['delcheck']==lang_show('delch'))
{
	if(is_array($_GET["checktag"]))
	{
		$deltn=implode("','",$_GET["checktag"]);
		$sql="delete from ".UDOMIN."  where  id in (".$deltn.")";
		$db->query($sql);	
	}
}
if (!empty($_GET['userid']))
{
   $sql="select user from ".ALLUSER." where userid=".trim($_GET['userid']);
   $db->query($sql);	
   $rss=$db->fetchRow();
   $u=$rss['user'];
   $sql="select * from ".UDOMIN." where userid=".trim($_GET['userid']);
   $db->query($sql);	
   $rss=$db->fetchRow();
   $d=$rss['domin'];
}
$sql="select a.id,a.domin,a.userid,a.time,b.user from ".UDOMIN." a, ".ALLUSER." b where a.userid=b.userid  order by a.time";
//=============================
	$page = new Page;
	$page->listRows=20;
	if (!$page->__get('totalRows')){
		$db->query($sql);
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  limit ".$page->firstRow.",20";
	$pages = $page->prompt();
//=====================
$db->query($sql);
$re=$db->getRows();
?>
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script type="text/javascript">
function checkall()
{
	 for(var j = 0 ; j < document.getElementsByName("checktag[]").length; j++)
	 {
	  	if(document.getElementsByName("checktag[]")[j].checked==true)
	  	  document.getElementsByName("checktag[]")[j].checked = false;
		else
		  document.getElementsByName("checktag[]")[j].checked = true;
	 }
}
</script>
<div class="guidebox"><?php echo lang_show('umanag');?> &raquo; <?php echo lang_show('domin_b');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('udomin_b');?></div>
	<div class="bigboxbody">
	<form name="userdomin" action="user_domin.php" method="GET" style="margin-top:0px;">
<table width="100%" border="0">
      <?php
	  if (!empty($_GET['userid']))
          {
	  ?>
        <tr>
          <td height="24" colspan="6" align="left" >
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8%"><?php echo lang_show('uname');?></td>
                <td width="92%"><input name="userdname" type="text" id="userdname" size="20" maxlength="20" readonly value="<?php if (isset($u)) echo $u;?>"></td>
              </tr>
              <tr>
                <td><?php echo lang_show('bdominn');?><a href="http://www.b2b-builder.com/help_detail.php?id=460" target="_blank">?</a></td>
                <td>
                http://<input name="userdomin" type="text" id="userdomin" size="40" maxlength="50" value="<?php if (isset($d)) echo $d;?>">                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input class="btn" type="submit" name="binddomin" id="binddomin" value="<?php echo lang_show('bingd');?>">
                  <input type="hidden" name="uid" id="uid" value="<?php echo $_GET['userid'];?>">
&nbsp;&nbsp;&nbsp;<a href="user_domin.php"><?php echo lang_show('cancel');?></a></td>
              </tr>
            </table></td>
        </tr>
		<?php
		  }
		?>
        <tr>
          <td width="34" align="left"  >
          <input type="checkbox" name="checktagall" id="checktagall" onClick="checkall()">
          </td>
          <td width="181" align="left"  ><?php echo lang_show('uid');?></td>
          <td width="149" align="left" class="STYLE20"  ><?php echo lang_show('uname');?></td>
          <td width="393" align="left"  ><?php echo lang_show('bdominn');?></td>
          <td width="111" align="left"  ><?php echo lang_show('bdtime');?></td>
          <td width="91" height="29" align="left"  ><?php echo lang_show('op');?></td>
        </tr>
        <?php
	      foreach ($re as $v)
          {
        ?>
        <tr>
          <td align="left" >
            <input type="checkbox" name="checktag[]" value="<?php echo $v['id'];?>">          </td>
          <td align="left" ><?php echo $v['userid'];?></td>
          <td align="left" > <?php echo $v['user'];?></td>
          <td align="left" ><?php echo $v['domin'];?></td>
          <td align="left" ><?php echo date('Y-m-d',$v['time']);?></td>
          <td height="24" align="left" ><pre><a href="user_domin.php?action=del&id=<?php echo $v['id'];?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"><?php echo lang_show('delete');?></a></pre></td>
        </tr>
        <?php
        }
        ?>
        <tr>
          <td height="24" colspan="3" align="left"  >
		  <input class="btn" type="submit" name="delcheck" value="<?php echo lang_show('delch');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"></td>
          <td height="24" colspan="3" align="right"  >&nbsp;<div class="page"><?php echo $pages?></div></td>
        </tr>
</table>
	</form>
	</div>
</div>
</body>
</html>