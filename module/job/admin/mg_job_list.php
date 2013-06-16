<?php
if(!empty($_POST["de"]))
{
	$id=implode(",",$_POST["de"]);
	if($_POST["action"]==lang_show('delete'))
		$sql="delete from ".ZP." where id in ($id)";
	if($_POST["action"]==lang_show('rc'))
		$sql="update ".ZP." SET statu=2 where id in ($id)";
	$db->query($sql);
	unset($sql);
}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('hr_info_manager');?></div>
<form method="get" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('hr_query');?></div>
	<div class="bigboxbody">
        <span  style="font-size:12px; padding-left:20px;"><?php echo lang_show('post_name');?>: </span>
		<input type="text" name="keyword"> &nbsp;<input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>">
		<input name="m" type="hidden" value="<?php echo $_GET['m'];?>">
	    <input name="s" type="hidden" value="<?php echo $_GET['s'];?>">
	</div>
</div>
</form>
<div style="float:left; height:50px; width:50%;">&nbsp;</div>
<form action="" method="post">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('hr_manager');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr> 
      <td ><input onClick="do_select();" type="checkbox" name="checkbox" value="checkbox"></td>
      <td ><?php echo lang_show('hr_post');?></td>
      <td ><?php echo lang_show('infopub');?></td>
      <td ><?php echo lang_show('post_time');?></td>
      <td ><?php echo lang_show('statu');?></td>
      <td align="center" ><?php echo lang_show('hr_manag');?></td>
      </tr>
    <?php
	$sql=NULL;
	if(!empty($_GET["keyword"]))
		$sql=" and a.title like '%$_GET[keyword]%' ";
	if($_SESSION["province"])
		$sql.=" and b.province='$_SESSION[province]'";
	if($_SESSION["city"])
		$sql.=" and b.city='$_SESSION[city]'";
		
	$sql="SELECT a.*,b.company FROM ".ZP." a left join ".USER." b on a.userid=b.userid where 1 $sql ORDER BY ID DESC";
		//=============================
		include_once("../includes/page_utf_class.php");
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$db->query($sql);
			$page->totalRows = $db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",20";
		$pages = $page->prompt();
		//==================================
	$db->query($sql);
	$re=$db->getRows();
	$count_num=count($re);
	for($i=0;$i<$count_num;$i++)
	{
	?> 
         <tr  onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')"> 
         <td width="49"><input type="checkbox" name="de[]" value="<?php echo $re[$i]["id"]; ?>"></td>
         <td width="209"><?php echo $re[$i]["title"];?></td>
         <td width="338" align="left">
		 <a href="<?php echo $config["weburl"]; ?>/shop.php?uid=<?php echo $re[$i]["userid"]; ?>" target="_blank">
		 <?php echo $re[$i]["company"]; ?>		 </a>		 </td>
         <td width="230" align="left"><?php echo $re[$i]["uptime"]; ?></td>
         <td width="57" align="left"><?php echo $re[$i]["statu"]; ?></td>
         <td width="116" align="center"> 
         <a href="module.php?m=job&s=jobmod.php&id=<?php echo $re[$i]["id"]; ?>"><?php echo lang_show('edit');?></a></td>
        </tr>
	<?php 
    }
	?>
	 <tr>
	   <td colspan="3">
	   <input onClick="return confirm('<?php echo lang_show('are_you_sure');?>');" class="btn" type="submit" name="action" value="<?php echo lang_show('delete');?>">
	   <input class="btn" type="submit" name="action" value="<?php echo lang_show('rc');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">	   </td>
	   <td colspan="3" align="right"><div class="page"><?php echo $pages?></div></td>
	 </tr>
  </table>
  </div>
</div>
</form>
</body>
</html>
