<?php
include("../includes/page_utf_class.php");
//=======================

if($_GET["submit"]==lang_show('delete'))
{
	
	if(isset($_GET["del"]) && is_array($_GET["del"]))	
	{
		include_once("../includes/tag_inc.php");
		foreach($_GET["del"] as $id)
		{
			$db->query("delete from ".EXHIBIT." where id='$id'");
			del_tag($id,3);
		}
	}
}
elseif($_GET["submit"]==lang_show('rc'))
{
	if(isset($_GET["del"]) && is_array($_GET["del"]))	
	{
		$id=implode(",",$_GET["del"]);
		$sql="update ".EXHIBIT." set is_rec=1 where id in ($id)";
		$db->query($sql);
	}
}
elseif($_GET["submit"]==lang_show('unrc'))
{
	if(isset($_GET["del"]) && is_array($_GET["del"]))	
	{
		$id=implode(",",$_GET["del"]);
		$sql="update ".EXHIBIT." set is_rec=0 where id in ($id)";
		$db->query($sql);
	}
}
if(empty($_GET["keyword"]))
	$_GET["keyword"]=NULL;
?>
<html>
<HEAD>
<TITLE> <?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>

<form name=frmlist action="" method="get">
<?php
if(!empty($_GET['firstRow']))
{
?>
<input name="firstRow" type="hidden" value="<?php echo $_GET['firstRow'];?>">
<?php
}
if(!empty($_GET['firstRow']))
{
?>
<input name="totalRows" type="hidden" value="<?php echo $_GET['totalRows'];?>">
<?php } ?>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('query');?></div>
	<div class="bigboxbody">
	<span  style="font-size:12px; padding-left:20px;"><?php echo lang_show('title');?>:</span><input name="keyword" value="<?php echo $_GET["keyword"];?>" type="text">  <input name="" class="btn" type="submit" value="<?php echo lang_show('search');?>">
		<input name="m" type="hidden" value="<?php echo $_GET['m'];?>">
	<input name="s" type="hidden" value="<?php echo $_GET['s'];?>">
	</div>
</div>
<div style="float:left; height:50px; width:50%;">&nbsp;</div>

<script language="javascript">
function do_select()
{
	 var box_l = document.getElementsByName("del[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("del[]")[j].checked==true)
	  	  document.getElementsByName("del[]")[j].checked = false;
		else
		  document.getElementsByName("del[]")[j].checked = true;
	 }
}
function checkstate() 
{
	 var box_l = document.getElementsByName("del[]").length;
	 var count=0;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("del[]")[j].checked==false)
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
	<div class="bigboxhead"><?php echo lang_show('news_list');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" >
    <tr > 
      <td width="20" height="20" ><input onClick="do_select()" name="" type="checkbox"></td>
      <td width="*" > <?php echo lang_show('title');?></td>
      <td width="76" align="center" ><?php echo lang_show('is_support');?></td>
      <td width="180" align="center" ><?php echo lang_show('show_time');?></td>
      <td width="161" align="center" ><?php echo lang_show('post_time');?></td>
      <td width="75" align="center" ><?php echo lang_show('manager');?></td>
    </tr>
    <?php 
	$sqld=NULL;
	if(!empty($_GET["keyword"]))
		$sqld=" where title like '%".trim($_GET['keyword'])."%' ";
	$sql="select * from ".EXHIBIT." $sqld order by id desc";
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
		unset($_GET['s']);
	    $getstr=implode('&',convert($_GET));
		if(count($re))
		{
			foreach($re as $va)
			{
			?> 
		<tr bgcolor="#eeeeee"> 
		  <td width="20"><input name="del[]" type="checkbox" id="del[]" value="<?php echo $va['id']; ?>"></td>
		  <td width="404">
           <?php echo $va['statu']?"<img src='../image/default/on.gif' />":"<img src='../image/default/off.gif' />";?>
           <?php if($va['pic']) echo "<img src='../image/default/image_s.gif'>";?>
		   <?php echo $va['title']; ?>          </td>
			  <td align="center"><?php if ($va['is_rec']==1) echo lang_show('rc'); else  echo lang_show('nrc'); ?></td>
			  <?php 
				if (!empty($va['stime']))
				     $sttime=date("Y-m-d",$va['stime']);
				else
					$sttime=NULL;
                if (!empty($va['etime']))
				    $entime=date("Y-m-d",$va['etime']);
				else
					$entime=NULL;
			?>
		  <td width="180" align="center"><?php echo $sttime." - ".$entime; ?></td>
		  <td width="161" align="center"><?php echo $va['addTime']; ?> </td>
		  <td width="75" align="center">
		  <a href="module.php?m=exhibition&s=exhibit.php&id=<?php echo $va['id']."&$getstr" ;?>"><?php echo lang_show('modify');?></a>
		  </td>
		</tr>
			<?php 
			}
		}
	 ?> 
	 <tr bgcolor="#eeeeee">
		  <td colspan="2">
          <input onClick="return checkstate();" class="btn" type="submit" name="submit" value="<?php echo lang_show('delete');?>">
          <input class="btn" type="submit" name="submit" value="<?php echo lang_show('rc');?>">
            <input class="btn" type="submit" name="submit" value="<?php echo lang_show('unrc');?>">
            <input name="action" type="hidden" id="action" value="submit"></td>
		  <td colspan="5" align="center"><div class="page"><?php echo $pages?></div></td>
	    </tr>
  </table>

  </div>
</div>
  </form>
</body>
</html>
