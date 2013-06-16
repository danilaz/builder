<?php
include_once("../includes/page_utf_class.php");
//==========================================
if(!empty($_GET["action"]))
{
	include_once("$config[webroot]/module/video/includes/plugin_video_class.php");
	$video=new video();
	foreach($_GET["de"] as $id)
	{
		$video->del_video($id);
	}
}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('business_manager');?></div>
<form method="get" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('business_query');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="20"><?php echo lang_show('key_word');?>:</td>
    <td height="20"><input type="text" name="key" value="<?php if(!empty($_GET['key'])) echo $_GET["key"]; ?>"></td>
  </tr>
  <tr>
    <td width="8%" height="20"><?php echo lang_show('supplier');?>:</td>
    <td width="92%" height="20">
      <input name="company" type="text" id="company" value="<?php if(!empty($_GET['company'])) echo $_GET["company"]; ?>">
    </td>
  </tr>
  <tr>
    <td height="20"><?php echo lang_show('range');?>:</td>
    <td height="20">
      <select name="type">
        <option value=""><?php echo lang_show('all');?></option>
        	<?php
				$types["1"]=lang_show('type1');
				$types["2"]=lang_show('type2');
				foreach ($types as $key=>$value)
				{
					if($key==$_GET["type"]) 
						 echo "<option value='$key' selected >$value</option>"; 
					else
						 echo "<option value='$key'>$value</option>";
				}
			?>
      </select>
	  </td>
  </tr>
  <tr>
    <td height="20">
	<input name="m" type="hidden" value="<?php echo $_GET['m'];?>">
	<input name="s" type="hidden" value="<?php echo $_GET['s'];?>">&nbsp;
	</td>
    <td height="20"><input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>"></td>
  </tr>
</table>
    </div>
</div>
</form>
<div style="float:left; height:50px; width:50%;">&nbsp;</div>
  <form action="module.php" method="get">
  	<input name="m" type="hidden" value="<?php echo $_GET['m'];?>">
	<input name="s" type="hidden" value="<?php echo $_GET['s'];?>">
  <div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('business_list');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="2" cellspacing="0" >
    <tr > 
      <td width="32" height="24" ><input onClick="do_select()" type="checkbox" name="checkbox" value="checkbox"></td>
      <td width="319" ><span ><?php echo lang_show('info_title');?></span></td>
      <td width="237" align="left" ><span ><?php echo lang_show('supplier');?></span></td>
      <td width="122" align="left"  ><?php echo lang_show('update_date');?></td>
      <td width="69" align="left" ><span ><?php echo lang_show('recommend');?></span></td>
      <td width="78" align="left" ><span ><?php echo lang_show('rank');?></span></td>
      <td width="120" align="center" ><span ><?php echo lang_show('manager');?></span></td>
    </tr>
    <?php
	$scl=NULL;
	if(!empty($_GET['key']))
		$scl.=" and (a.name regexp '$_GET[key]' or a.name regexp '$_GET[key]')  ";
	if(!empty($_GET['company']))
		$scl.=" and b.company regexp '$_GET[company]' ";
	if(!empty($_GET['type']))
		$scl.=" and a.tj='$_GET[type]' ";
	if($_SESSION["province"])
		$scl.=" and b.province='$_SESSION[province]'";
	if($_SESSION["city"])
		$scl.=" and b.city='$_SESSION[city]'";
	
		
	$sql="select a.*,b.company,b.ifpay from ".VIDEO." as a left join ".USER." as b on a.userid=b.userid 
		where 1 $scl order by video_id desc ";
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
	$i=0;
	foreach($re as $v)
	{
	?> 
      <tr  onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')"> 
        <td width="32"><input name="de[]" type="checkbox" id="de" value="<?php echo $v["video_id"]; ?>"></td>
        <td width="319">
		<?php echo $v['fb']?"<img src='../image/default/on.gif' />":"<img src='../image/default/off.gif' />";?>
		<?php echo $v['name'];?></td>
        <td width="237" align="left"><?php echo "$v[company]"; ?>&nbsp;</td>
        <td width="122" align="left"><?php echo date("Y-m-d",$v["time"]);?></td>
        <td width="69" align="left"><?php if(!empty($v['tj'])){$tj=$v['tj'];echo $types[$tj]; }?></td>
        <td width="78" align="left"><?php echo $v['rank']; ?></td>
        <td width="120" align="center"> 
            <a href="module.php?m=<?php echo $_GET['m'];?>&s=video_edit.php&id=<?php echo $v["video_id"]; ?>"><?php echo lang_show('manager');?></a> |
			<a target="_blank" href="../?m=video&s=video_detail&id=<?php echo $v["video_id"]; ?>"><?php echo lang_show('preview');?></a>
		</td>
      </tr>
    <?php 
		$i++;
    	}
	?> 
  </table>
  <table width="100%" height="20" border="0" cellpadding="4" cellspacing="0">
    <tr>
      <td width="29%"><input class="btn" type="submit" name="Submit2" value="<?php echo lang_show('delete');?>">
      <input name="action" type="hidden" id="action" value="submit"></td>
      <td width="71%" align="right"><div class="page"><?php echo $pages?></div></td>
    </tr>
  </table>
    </div>
</div>
  </form>
</body>
</html>
