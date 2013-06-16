<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("auth.php");
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
//========================
if(isset($_GET["deid"]))
{
	$db->query("delete from ".CUSTOM_CAT_REL." where custom_cat_id='$_GET[deid]'");
}
if(isset($_GET["decatid"]))
{
	if(file_exists("../uploadfile/catimg/size_small/".$_GET["decatid"].".jpg")){
		unlink("../uploadfile/catimg/size_small/".$_GET["decatid"].".jpg");
	}
	if(file_exists("../uploadfile/catimg/".$_GET["decatid"].".jpg")){
		unlink("../uploadfile/catimg/".$_GET["decatid"].".jpg");
	}
	$db->query("delete from ".CUSTOM_CAT." where id='$_GET[decatid]'");
}
if(empty($_GET))
	$_GET=NULL;
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
var cancel = '<?php echo lang_show('cancel');?>';
var recommend = '<?php echo lang_show('recommend');?>';
</script>
<script type="text/javascript" src="../script/prototype.js"></script>
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>


<form method="get" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('cat_search');?></div>
	<div class="bigboxbody">
        <?php echo lang_show('cat_name');?> <input type="text" name="keyword" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword'];?>"> 
		&nbsp;<input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>">
	</div>
</div>
</form>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('cat_manage');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr> 
      <td width="10%" ><?php echo lang_show('cat_a');?></td>
      <td width="20%" ><?php echo lang_show('cat_b');?></td>
      <td width="*%" ><?php echo lang_show('cat_c');?></td>
      <td width="25%" ><?php echo lang_show('poster');?></td>
      <td width="6%" ><?php echo lang_show('cat_d');?></td>
      <td width="18%" align="center" ><?php echo lang_show('manager');?></td>
      </tr>
    <?php
	$sql=NULL;
		if(!empty($_GET["keyword"]))
			$sql=" and a.name like '%$_GET[keyword]%' ";
		if($_SESSION["province"])
			$sql.=" and b.province='$_SESSION[province]'";
		if($_SESSION["city"])
			$sql.=" and b.city='$_SESSION[city]'";
		$sql="SELECT 
				a.id,a.tj,a.name,a.des,b.company FROM ".CUSTOM_CAT." a,".USER." b 
			  WHERE a.userid=b.userid and a.type=6 $sql ORDER BY a.ID DESC";
		//=============================
		include_once("../includes/page_utf_class.php");
	  	$page = new Page;
		$page->listRows=10;
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
         <tr> 
         <td>
		 <img src="<?php echo $config["weburl"]; ?>/uploadfile/catimg/size_small/<?php echo $re[$i]['id'];?>.jpg " width="70" height="50">
		 </td>
         <td ><a href="album.php?catid=<?php echo $re[$i]['id'];?>"><?php echo $re[$i]["name"];?></a></td>
         <td align="left"> <?php echo $re[$i]["des"]; ?></td>
         <td align="left"> <?php echo $re[$i]["company"]; ?></td>
         <td align="left">
		 <?php
		$sql = "select count(1) as count from ".CUSTOM_CAT_REL." where custom_cat_id='".$re[$i]['id']."'";
		$db->query($sql);
		$row = $db->fetchRow();
		if($row['count']>0)
			echo '<a href="album.php?catid='.$re[$i]['id'].'">'.$row['count'].'</a>';
		else
			echo 0;
		?>
		 </td>
         <td align="center">
		 <?php
			if($row['count']>0) {
			?>
		 <?php
			if($re[$i]["tj"]==0){
		?>
				<span id="tj_album<?php echo $re[$i]["id"];?>"> <a onClick="updateAblumRec(1,'<?php echo $re[$i]["id"]; ?>');return false;" href="#"><?php echo lang_show('tj');?></a>
		 <?php
	} else {
			?>
				<span id="tj_album<?php echo $re[$i]["id"]; ?>"> <a onClick="updateAblumRec(0,'<?php echo $re[$i]["id"]; ?>');return false;" href="#"><?php echo lang_show('untj');?></a>
			<?php
	} ?>
		</span>&nbsp;
		 <a href="album_cat.php?deid=<?php echo $re[$i]["id"]; ?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"><?php echo lang_show('cat_e');?></a>
		 <?php }
		else
		{
		?>
		 <a href="album_cat.php?decatid=<?php echo $re[$i]["id"]; ?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"><?php echo lang_show('cat_f');?></a>
				<?php
		}
				?>
		 </td>
        </tr>
    <?php 
    }
	?>
  </table>
  <div align="right"><div class="page"><?php echo $pages?></div></div>
  </div>
</div>
</body>
</html>
