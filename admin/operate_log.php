<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("../lang/" . $config['language'] . "/admin/script_name.php");
include_once("auth.php");
//====================================
//-------清空一个月前的日志
$st=time()-30*24*3600;
$sqlk="delete from ".OPLOG." where time<='$st'";
$db->query($sqlk);

		
if(!empty($_POST['deletecheck']))
{
  if($_SESSION["ADMIN_USER"]=="admin")
	{
		if(!empty($_POST["checktag"])&&is_array($_POST["checktag"]))
		{
		  $delid=implode(",",$_POST["checktag"]);
		  $sql="delete from ".OPLOG."  where  id in (".$delid.")";
		  $db->query($sql);	
		  msg("operate_log.php");
		}
	}
	else  
	{
		echo lang_show('noright');
		die;
	}
}	
if(!empty($_POST['beforetime'])&&!empty($_POST['delbetime']))
{
	if($_SESSION["ADMIN_USER"]=="admin")
	{
		$st=strtotime($_POST['sbeforetime']);
		$et=strtotime($_POST['beforetime']);
		$sqlk="delete from ".OPLOG." where time>='$st' and time<='$et'";
		$db->query($sqlk);
	}
	else
	{
		echo lang_show('noright');
		die;
	}
}
//----------------------------------------
$psql='';
if(!empty($_GET["username"]))
	$psql.=" and user='$_POST[username]'";
if(!empty($_GET["actime"]))
{
	$st=strtotime($_GET['actime'])-86400;
	$et=$st+172800;
	$psql.=" and time>$st and time<$et";
}
if(!empty($_GET['url']))
	$psql.=" and url like '$_GET[url]%'";
	
$sql="select * from ".OPLOG."  where 1 $psql ";
//=============================
	$page = new Page;
	$page->listRows=20;
	if (!$page->__get('totalRows')){
		$db->query($sql);
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  order by time desc limit ".$page->firstRow.",20";
	$pages = $page->prompt();
//=====================
$db->query($sql);
$re=$db->getRows();
?>
<HTML>
<head>
<TITLE><?php echo lang_show('user_admin');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/Calendar.js"></script>
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
function checktime()
{
	  	if (document.oplogd.beforetime.value=="")
		{ 
         alert("<?php echo lang_show('timeerror');?>") 
         return false;  
        }  
     else 
		 {return true;} 
}
function checkdelc() 
{
	 var box_l = document.getElementsByName("checktag[]").length;
	 var count=0;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("checktag[]")[j].checked==false)
	  	  count++;
	 }
	  if(count==box_l)
	 {
		alert("<?php echo lang_show('fchecked');?>");
		return false;
	 }
	 else
	 {
		 if(confirm("<?php echo lang_show('suerdelit');?>"))
		 {
			 return true;
		 }
		 else
			 return false;
	 }
} 
</script>
<div class="bigbox">
<div class="bigboxhead"><?php echo lang_show('beforetime');?></div>
<div class="bigboxbody">
<form name="oplogd" action="" method="POST">
<table width="100%">
<tr>
<td height="24" align="left">
<script language="javascript">
var cdr = new Calendar("cdr");
document.write(cdr);
cdr.showMoreDay = true;
</script>
<?php echo lang_show('beforetime');?>:
<input onFocus="cdr.show(this);" name="sbeforetime" type="text" id="sbeforetime" size="20" maxlength="30"> - 
<input onFocus="cdr.show(this);" name="beforetime" type="text" id="beforetime" size="20" maxlength="30">
<input class="btn" type="submit" name="delbetime" id="delbetime" value="<?php echo lang_show('delit');?>" <?php if($_SESSION["ADMIN_USER"]!="admin") echo 'disabled';?> onClick="return checktime();"></td>
</tr>
</table>
</form>  
</div>
</div>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>

<div class="bigbox">
<div class="bigboxhead"><?php echo lang_show('logrec');?></div>
	<div class="bigboxbody">
	
	<table width="100%" height="184" border="0" cellpadding="0" cellspacing="0" style="word-break:break-all">

        <tr>
          <td height="24" colspan="5" align="left" >
		  <form name="oplog" action="" method="GET">
		  <?php echo lang_show('uname');?>:&nbsp;
            <input name="username" type="text" id="username" size="20" maxlength="20" value="<?php if(!empty($_GET['username'])) echo $_GET['username'];?>">
            <?php echo lang_show('actime');?>
            <input onFocus="cdr.show(this);" name="actime" type="text" id="actime" size="20" maxlength="30" value="<?php if(!empty($_GET['actime'])) echo $_GET['actime'];?>">
            URL операции:
            <input type="text" name="url" value="<?php if(!empty($_GET['url'])) echo $_GET['url'];?>">
            <input class="btn" type="submit" name="research" id="research" value="<?php echo lang_show('query');?>">
			(Примечание: отчеты можно вывести только за месяц)
			</form>
		  </td>
        </tr>
		<form name="doplog" action="" method="post">
        <tr style="font-weight:bold;">
          <td width="4%" align="left">
            <input type="checkbox" name="checktagall" id="checktagall" onClick="checkall()">            </span></td>
          <td width="17%" align="left"  ><?php echo lang_show('actuser');?></td>
          <td width="18%" align="left"  ><?php echo lang_show('act');?></td>
          <td width="41%" align="left"  ><?php echo lang_show('acturl');?></td>
          <td width="20%" height="24" align="left"  ><?php echo lang_show('actime');?></td>
        </tr>
        <?php
	      foreach ($re as $v)
          {
			  $scrp_name=substr($v['scriptname'],0,-4);
			  if($scrp_name=='main')
				  $sn[$scrp_name]=lang_show('logo');
        ?>
        <tr>
          <td align="left" ><input type="checkbox" name="checktag[]" id="checktag[]" value="<?php echo $v['id'];?>"> </td>
          <td align="left" ><?php echo $v['user'];?></td>
          <td align="left" ><?php echo $sn[$scrp_name];?></td>
          <td align="left" ><?php echo $v['url'];?></td>
          <td height="24" align="left" >
		  <?php 
			if($config['language']!='en')	
				echo date("Y-m-d H:m:s",$v['time']);
			else 
				echo date("m/d/Y H:m:s",$v['time']);
		?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
          <td height="24" colspan="3" align="left"  ><input class="btn" type="submit" name="deletecheck" id="deletecheck" value="<?php echo lang_show('delch');?>" onClick="return checkdelc();" <?php if($_SESSION["ADMIN_USER"]!="admin") echo 'disabled';?>></td>
          <td height="24" colspan="2" align="right"  ><div class="page"><?php echo $pages?></div></td>
        </tr>
		</form>
      </table>
	</div>
</div>
</body>
</html>