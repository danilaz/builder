<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//====================================
if(empty($_GET['deltag'])&&!empty($_GET['tagname']))
{
	$sql="delete from ".TAGS." where tagname='".trim($_GET['tagname'])."'";
	$db->query($sql);
	$sql="delete from ".CTAGS." where tagname='".trim($_GET['tagname'])."'";
	$db->query($sql);
}
if(!empty($_GET['delcheck'])&&$_GET['delcheck']==lang_show('deletecheck')&&is_array($_GET["checktag"]))
{
	$deltn=implode("','",$_GET["checktag"]);
	$sql="delete from ".TAGS."  where  tagname in ('".$deltn."')";
	$db->query($sql);
	$sql="delete from ".CTAGS." where  tagname in ('".$deltn."')";
	$db->query($sql);	
}

if(!empty($_GET['name']))
	$ssql=" and tagname like '%$_GET[name]%' ";
$sql="select * from ".TAGS." where 1 $ssql ";
//=============================
	$page = new Page;
	$page->listRows=50;
	if (!$page->__get('totalRows')){
		$db->query($sql);
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  limit ".$page->firstRow.",50";
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
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('taglist');?></div>
	<div class="bigboxbody">
	<form name="iplockset" action="tag_manage.php" method="GET" style="margin-top:0px;">
      <table width="100%" height="175" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="24" colspan="4" align="left" >
            <input name="name" type="text" id="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>" >
            <input class="btn" type="submit" name="submit" id="submit" value="<?php echo lang_show('search');?>">		 </td>
        </tr>
        <tr style="font-weight:bold;">
          <td colspan="2" align="left" >
          <input type="checkbox" name="checktagall" id="checktagall" onClick="checkall()">TAG
		  </td>
          <td width="134" align="left"   ><?php echo lang_show('clicknum');?></td>
          <td width="307" height="38" align="left"   ><?php echo lang_show('action');?></td>
        </tr>
        <?php
	      foreach ($re as $v)
          {
        ?>
        <tr>
          <td colspan="2" align="left" >
          <input type="checkbox" name="checktag[]" value="<?php echo $v['tagname'];?>">		    <?php echo $v['tagname'];?></td>
          <td align="left" ><?php echo $v['total'];?></td>
          <td height="24" align="left" ><a href="tag_manage.php?tagname=<?php echo urlencode($v['tagname']);?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"><?php echo $delimg;?></a></td>
        </tr>
        <?php
        }
        ?>
        <tr>
          <td width="168" height="24" align="left"  >
          <input type="checkbox" name="checktagall" id="checktagall" onClick="checkall()">
		  <input  class="btn" type="submit" name="delcheck" id="delcheck" value="<?php echo lang_show('deletecheck');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"></td>
          <td height="24" colspan="3" align="right">&nbsp;<div class="page"><?php echo $pages;?></div></td>
        </tr>
	</table>
	</form>
	</div>
</div>
</body>
</html>