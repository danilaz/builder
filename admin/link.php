<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//======================================
$step=isset($_GET["step"])?$_GET["step"]:NULL;
if(!empty($_POST['dellink']))
{
	$id=implode(",",$_POST["de"]);
	$db->query("delete from ".LINK." where linkid in($id)");
}
//=======================
if(!isset($_GET["firstRow"]))
{
	$_GET["firstRow"]=0;
	$_GET["totalRows"]=0;
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8"> 
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>
<script language="javascript">
function do_select()
{
	 var box_l = document.getElementsByName("de[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("de[]")[j].checked==true)
	  	  document.getElementsByName("de[]")[j].checked = false;
		else
		  document.getElementsByName("de[]")[j].checked = true;
	 }
}
</script>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('search');?></div>
	<div class="bigboxbody">
	<form action="" method="get">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%"><?php echo lang_show('is_pass');?>:</td>
    <td width="85%">
      <select name="pass" id="select">
        <option value="0"><?php echo lang_show('all');?></option>
        <option value="1" <?php if(isset($_GET["pass"])&&$_GET['pass']==1)echo "selected";?>><?php echo lang_show('ispublished');?></option>
        <option value="2" <?php if(isset($_GET["pass"])&&$_GET['pass']==2)echo "selected";?>><?php echo lang_show('nopublished');?></option>
      </select>
      </td>
  </tr>
  <tr>
    <td><?php echo lang_show('is_recommend');?></td>
    <td><input name="rec" type="checkbox" value="1" <?php if(isset($_GET["rec"]))echo "checked";?>></td>
  </tr>
  <tr>
    <td><?php echo lang_show('link_name');?>:</td>
    <td><input name="keyword" type="text" id="keyword" size="30">
      <input name="Input" class="btn" type="submit" value=" <?php echo lang_show('search');?> "></td>
  </tr>
</table>
</form>
	</div>
</div>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('link_list');?></div>
	<div class="bigboxbody">
          <form action="" method="post">
          <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr>
              <td width="3%" align="right" ><input onClick="do_select();" type="checkbox" name="checkbox2" id="checkbox2"></td> 
              <td width="28%" ><?php echo lang_show('link_name');?></td>
              <td width="8%" ><?php echo lang_show('sort');?></td>
              <td width="19%" ><?php echo lang_show('link');?></td>
              <td width="11%" ><?php echo lang_show('logo');?></td>
              <td width="17%" ><?php echo lang_show('VaildPeriod');?></td>
              <td width="8%" ><?php echo lang_show('recommend');?></td>
              <td width="6%" ><?php echo lang_show('manager');?></td>
            </tr>
		<?php
		include_once("../includes/page_utf_class.php");
		
		$ksql=$tsql=NULL;
		if(isset($_GET["pass"])&&$_GET["pass"]==1)
			$ksql=" and published=0";
		if(isset($_GET["pass"])&&$_GET["pass"]==2)
			$ksql=" and published=1";
			
		if(isset($_GET["rec"]))
			$ksql.=" and tj=1";
		if(isset($_GET["keyword"]))
			$ksql.=" and name like '%$_GET[keyword]%' ";
		
		if($_SESSION["province"])
			$tsql=" and province='$_SESSION[province]'";
		if($_SESSION["city"])
			$tsql.=" and city='$_SESSION[city]'";
		else
			$tsql.="  and (city='' or city is NULL)";
		$sql="select * from ".LINK." where 1 $ksql $tsql order by published desc,tj desc, linkid desc";
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
		$i=0;
		while($db->next_record())
		{
		$i++;
		?>
           
            <tr onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')" >
              <td align="right">
                <input type="checkbox" name="de[]" id="checkbox" value="<?php echo $db->f('linkid'); ?>">
				</td> 
              <td>
			  <?php echo $db->f('published')?"<img src='../image/default/on.gif' />":"<img src='../image/default/off.gif' />"?>
			  <?php  echo $db->f('name'); ?></td>
              <td><?php  echo $db->f('orderid'); ?></td>
              <td width="19%" ><a title="<?php echo $db->f('con');?>" href="<?php  echo $db->f('url'); ?>" target="_blank"><?php  echo $db->f('url'); ?></a> </td>
              <td width="11%" >&nbsp;<?php if($db->f('log')){?><img src="<?php  echo $db->f('log'); ?>"><?php }?></td>
              <td width="17%" >
			  <?php 
			  	if($db->f('etime')-time()<0)
					echo '<font color=red>*</font>';
				echo date("Y-m-d",$db->f('stime'));?>/<?php echo date("Y-m-d",$db->f('etime'));
			  ?>              </td>
              <td width="8%" ><?php echo $db->f('tj');?></td>
              <td width="6%" ><a href="add_link.php?step=edit&linkid=<?php echo $db->f('linkid'); ?>"><?php echo $editimg;?></a>			  </td>
            </tr>
       <?php
		}
		?>
         <tr>
               <td align="right"> <input onClick="do_select();" type="checkbox" name="checkbox2" id="checkbox2"></td>
			   <td height="20" > <input onClick="return confirm('<?php echo lang_show('are_you_sure');?>');" class="btn" type="submit" name="dellink" id="button" value="<?php echo lang_show('delete');?>">			   </td>
		   		<td colspan="6">&nbsp;<div class="page"><?php echo $pages?></div></td>
            </tr>
	  </table>  
  </form>
</div>
</div>
</body>
</html>