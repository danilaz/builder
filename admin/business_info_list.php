<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//==========================================
if(isset($_GET["step"]))
{
	if($_GET["step"]=="del")
	{
		$db->query("delete from ".BUSINESS." where id='$_GET[deid]'");
	}
}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/prototype.js"></script>
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>
<form method="get" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('search_business_info');?></div>
	<div class="bigboxbody">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="13%"><?php echo lang_show('key_word');?></td>
               <td width="87%"><input type="text" name="key" value="<?php if(isset($_GET["key"]))echo $_GET["key"];?>"></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td><input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>"></td>
             </tr>
           </table>
	</div>
</div>
</form>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('business_info_list');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="2" cellspacing="0" >
    <tr > 
      <td width="116" > <?php echo lang_show('business_info_name');?>  </td>
      <td width="170" > <?php echo lang_show('business_info_uptime');?></td>
      <td width="348" ><?php echo lang_show('business_info_com');?></td>
      <td width="132" ><?php echo lang_show('business_info_regtime');?></td>
      <td width="78" ><?php echo lang_show('recommend');?></td>
      <td width="108" align="center" ><?php echo lang_show('manager');?></td>
      </tr>
    <?php
	$psql=NULL;
	if(isset($_GET["key"]))
		$psql=" and (b.company like '%$_GET[key]%') ";
	if(!empty($_SESSION["province"]))
		$psql.=" and b.province='$_SESSION[province]'";
	if(!empty($_SESSION["city"]))
		$psql.=" and b.city='$_SESSION[city]'";
		
	$sql="SELECT
	 		a.*,b.company,b.regtime 
	 	FROM 
			".BUSINESS." a,".USER." b
		WHERE
	  		a.userid=b.userid $psql order by id desc ";
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
	//=====================
	$db->query($sql);
	$re=$db->getRows();
	$coun_num=$db->num_rows();
	for($i=0;$i<$coun_num;$i++)
	{ 
	?> 
      <tr  onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')"> 
        <td><?php echo $re[$i]["person_name"]; ?></td>
        <td align="left"><?php echo $re[$i]["uptime"]; ?></td>
        <td align="left"><?php echo $re[$i]["company"]; ?></td>
        <td align="left"><?php echo $re[$i]["regtime"]; ?></td>
        <td><?php  $status=array('0'=>lang_show('notpass'),'1'=>lang_show('auditpass')); $key=$re[$i]['statu'];echo $status[$key]; ?></td>
        <td align="center"> 
        <a href="business_info_detail.php?id=<?php echo $re[$i]["id"]; ?>"><?php echo lang_show('edit');?></a> | 
        <a href="?step=del&deid=<?php echo $re[$i]["id"]; ?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>')"><?php echo lang_show('delete');?></a>		</td>
		</tr>
        <?php 
    	}
		?>
      <tr>
        <td height="24" colspan="6" align="right"><div class="page"><?php echo $pages?></div></td>
      </tr>
  </table>
  </div>
</div>
</body>
</html>
