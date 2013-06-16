<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//====================================
if(!empty($_POST['addvercode']))
{
	$sql="insert into ".REGVERFCODE." (question,answer) VALUES ('$_POST[verquestion]','$_POST[veranswer]')"; 
	$db->query($sql);
}
if(!empty($_POST['action'])&&$_POST['action']=='delete'&&!empty($_POST['id']))
{
	$sql="delete from  ".REGVERFCODE." where id=".$_POST['id']; 
	$db->query($sql);
}
if(!empty($_POST['deletecheck']))
{
	if(is_array($_POST["checkip"]))
	{
		$deltn=implode(",",$_POST["checkip"]);
		$sql="delete from  ".REGVERFCODE." where id in($deltn)"; 
		$db->query($sql);	
	}
}
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
	 for(var j = 0 ; j < document.getElementsByName("checkip[]").length; j++)
	 {
	  	if(document.getElementsByName("checkip[]")[j].checked==true)
	  	  document.getElementsByName("checkip[]")[j].checked = false;
		else
		  document.getElementsByName("checkip[]")[j].checked = true;
	 }
}
function checkcontent()
{
	if (document.regvercode.verquestion.value==""||document.regvercode.veranswer.value=="")
	{ 
		alert("<?php echo lang_show('quesnull');?>") 
		return false;  
	}  
	else 
		return true;
}
</script>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('ureg_ques');?></div>
	<div class="bigboxbody">
	<form name="regvercode" action="user_reg_verf.php" method="POST" style="margin-top:0px;">
      
<table width="100%" height="105" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="24" colspan="3" align="left" >
             <?php echo lang_show('regques');?>
             <input name="verquestion" type="text" id="verquestion" size="30" maxlength="40">
			<?php echo lang_show('quesan');?>
			<input name="veranswer" type="text" id="veranswer" size="30" maxlength="35">
<input class="btn" type="submit" name="addvercode" id="addvercode" value="<?php echo lang_show('addques');?>" onClick="return checkcontent();">          </td>
        </tr>
        <tr>
          <td height="27" align="left" ><input type="checkbox" name="checkipall" id="checkipall" onClick="checkall()">
            <?php echo lang_show('regques');?></td>
          <td width="398" align="left" ><?php echo lang_show('quesan');?></td>
        </tr>
        <?php
           unset($sql);
		   $sql="select * from ".REGVERFCODE;
		   $page = new Page;
	       $page->listRows=20;
	       if (!$page->__get('totalRows'))
		   {
		       $db->query($sql);
		       $page->totalRows = $db->num_rows();
	        }
	       $sql .= "  limit ".$page->firstRow.",20";
	       $pages = $page->prompt();   
           $db->query($sql);
           $re=$db->getRows();
           foreach($re as $v)
	       {
        ?>
        <tr>
          <td height="27" align="left" ><input type="checkbox" name="checkip[]" value="<?php echo $v['id'];?>">
            <?php echo $v['question']; ?></td>
          <td align="left" ><?php echo $v['answer']; ?></td>
       </tr>
	   <?php
		   }
		?>
		 <tr>
          <td height="27" align="left" ><input class="btn" type="submit" name="deletecheck" id="deletecheck" value="<?php echo lang_show('delcheck');?>"></td>
          <td align="left" ><div class="page"><?php echo $pages?></div></td>
        </tr>
      </table>
	</form>
	</div>
</div>
</body>
</html>