<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//====================================
if(!empty($_GET['action'])&&$_GET['action']=="delone"&&!empty($_GET['delid']))
{
	if(isset($_GET['delid']))
		$deleteid=$_GET['delid'];
	else
		$deleteid=NULL;
	$sql="delete from ".RESERVE_USERNAME." where id=".$deleteid; 
	$db->query($sql);
	msg("reserve_username.php"); 
}
if(!empty($_GET['submit'])&&!empty($_GET['delcheck']))
{
	if(is_array($_GET['delcheck']))
	{
		$delid=implode(",",$_GET['delcheck']);
		$sql="delete from ".RESERVE_USERNAME." where id in ($delid)";
		$db->query($sql);
	}
}
if(!empty($_POST['addreserve'])&&$_POST['addreserve']==lang_show('add_name'))
{
	if(isset($_POST['addreservename']))
		$reservename=$_POST['addreservename'];
	else
		msg("reserve_username.php");

	$sql="insert into ".RESERVE_USERNAME." (`username`) values ('$reservename')"; 
	$db->query($sql);
	msg("reserve_username.php"); 
}
?>
<HTML>
<head>
<TITLE><?php echo lang_show('m_mang');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script type="text/javascript">
function checkname()
{
	 if (document.reservename.addreservename.value=="")
		{ 
         alert("<?php echo lang_show('resumgs');?>") 
         return false;  
        }  
     else 
		 {return true;} 

}
function checkall()
{
	 for(var j = 0 ; j < document.getElementsByName("delcheck[]").length; j++)
	 {
	  	if(document.getElementsByName("delcheck[]")[j].checked==true)
	  	  document.getElementsByName("delcheck[]")[j].checked = false;
		else
		  document.getElementsByName("delcheck[]")[j].checked = true;
	 }
}
</script>
<div class="guidebox"><?php echo lang_show('m_mang');?>&raquo; <?php echo lang_show('res_name');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('m_mang');?></div>
	<div class="bigboxbody">
	
    <table width="100%" height="158" border="0">
        <tr>
          <td height="24" colspan="3" align="left" >
		  <form name="reservename" action="reserve_username.php" method="post">
            <input name="addreservename" type="text" id="addreservename" size="40">
            <input class="btn" type="submit" name="addreserve" id="addreserve" value="<?php echo lang_show('add_name');?>" onClick="javascritpt:return checkname()" >
		  </form>			</td>
        </tr>
        <tr>
          <td height="24" colspan="3" align="left" ><?php echo lang_show('resmsg');?></td>
        </tr>
		<form name="reservename" action="reserve_username.php" method="get">
        <tr>
          <td align="left" ></span>
            <input type="checkbox" name="Input"  onClick="checkall()">
            <?php echo lang_show('res_name');?></td>
          <td align="left" ><?php echo lang_show('res_stuta');?></td>
          <td height="24" align="left" ><?php echo lang_show('res_op');?></td>
        </tr>
        <?php
           unset($sql);
           $sql="select * from ".RESERVE_USERNAME." order by username asc";
           $db->query($sql);
           $re=$db->getRows();
           foreach($re as $v)
	       {
        ?>
        <tr>
          <td align="left" >
            <input name="delcheck[]" type="checkbox"  value="<?php echo $v['id'];?>"/>
          <?php echo $v['username']; ?></td>
          <td width="228" align="left" ><?php echo lang_show('resing');?></td>
          <td width="242" height="24" align="left" ><a href="reserve_username.php?action=delone&delid=<?php echo $v['id'];?>" class="STYLE15" onClick="javascript:return confirm('<?php echo lang_show('delask');?>')"><?php echo lang_show('delete');?></a></td>
        </tr>
        <?php
        }
        ?>
         <tr>
          <td height="24" colspan="3" align="left"  ><input class="btn" type="submit" name="submit" value="<?php echo lang_show('delall');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"></td>
        </tr>
		</form>
      </table>
	
	</div>
</div>
</body>
</html>