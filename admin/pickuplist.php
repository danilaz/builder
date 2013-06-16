<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//==========================================
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
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('pickuplist_a');?>
</div>
<form method="get" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('pickuplist_desc');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellpadding="2" cellspacing="0" >
        <tr>
          <td width="*%" ><?php echo lang_show('pickuplist_b');?></td>
          <td width="15%" ><span ><?php echo lang_show('pickuplist_c');?></span></td>
          <td width="15%" align="left" ><?php echo lang_show('pickuplist_d');?></td>
          <td width="15%" ><?php echo lang_show('pickuplist_e');?></td>
          <td width="10%" ><?php echo lang_show('pickuplist_f');?></td>
          <td width="10%" ><?php echo lang_show('pickuplist_g');?></td>
        </tr>
    <?php
	$psql=NULL;
	if(!empty($_SESSION["province"]))
		$psql.=" and b.province='$_SESSION[province]'";
	if(!empty($_SESSION["city"]))
		$psql.=" and b.city='$_SESSION[city]'";
	
	$sql="SELECT a.id,a.amount,a.add_time,a.is_succeed,a.censor,b.company,b.contact
	 	FROM ".CASHPICKUP." a left join ".USER." b on a.userid=b.userid
		WHERE 1 $psql order by a.add_time desc";
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
	//=============================
	$db->query($sql);
	$re=$db->getRows();
	$coun_num=$db->num_rows();
	for($i=0;$i<$coun_num;$i++)
	{ 
	?>
        <tr onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')">
          <td><?php echo $re[$i]["company"]; ?></td>
          <td align="left"><?php echo $re[$i]["contact"]; ?></td>
          <td align="left"><?php echo $re[$i]["amount"]; ?></td>
          <td align="left"><?php echo dateformat($re[$i]["add_time"]); ?></td>
          <td>
		  <?php  
			if($re[$i]["is_succeed"] ==0)
				echo lang_show('pickuplist_h');
			else if($re[$i]["is_succeed"] ==1)
				echo lang_show('pickuplist_i');
			else  if($re[$i]["is_succeed"] ==2)
				echo lang_show('pickuplist_j');
			if(!empty($re[$i]['censor']))
				echo '('.$re[$i]['censor'].')';
		 ?>
          </td>
          <td align="center"><a href="pickupmod.php?id=<?php echo $re[$i]["id"]; ?>"><?php echo lang_show('edit');?></a></td>
          <?php 
    	}
		?>
        </tr>
        <tr>
          <td colspan="6"><div class="page"><?php echo $pages?></div></td>
        </tr>
      </table>
	</div>
</div>
</form>
</body>
</html>
