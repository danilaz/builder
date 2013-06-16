<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//==========================================
if(!empty($_GET['deid']))
{
	$sql="delete from ".ACCOUNTS." where id='$_GET[deid]'";
	$db->query($sql);
}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="guidebox">
<?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('bank_a');?>
</div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('bank_desc');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellpadding="2" cellspacing="0" >
        <tr>
          <td width="20%"><?php echo lang_show('bank_b');?></td>
          <td width="15%" ><?php echo lang_show('bank_c');?></td>
          <td width="15%" ><?php echo lang_show('bank_d');?></td>
          <td width="15%" ><?php echo lang_show('bank_e');?></td>
          <td width="11%" ><?php echo lang_show('bank_f');?></td>
          <td width="9%" ><?php echo lang_show('bank_g');?></td>
          <td width="15%" align="center" ><?php echo lang_show('bank_h');?></td>
        </tr>
     <?php
	$psql=NULL;
	if(!empty($_SESSION['province']))
		$psql.=" and b.province='$_SESSION[province]'";
	if(!empty($_SESSION['city']))
		$psql.=" and b.city='$_SESSION[city]'";
	
	$sql="SELECT
	 		a.id,a.userid,a.bank,a.accounts,a.active,a.add_time,a.master,b.company,b.contact
	 	FROM 
			".ACCOUNTS." a left join ".USER." b on a.userid=b.userid
		WHERE
	  		1 $psql order by a.add_time desc";
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
        <tr onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')">
          <td><?php echo $re[$i]['company']; ?></td>
          <td><?php echo $re[$i]['bank']; ?></td>
          <td><?php echo $re[$i]['accounts']; ?></td>
		  <td><?php echo $re[$i]['master']; ?></td>
          <td><?php echo dateformat($re[$i]['add_time']); ?></td>
          <td><?php  
			if($re[$i]['active'] ==0)
				echo lang_show('bank_i');
			else if($re[$i]['active'] ==1)
				echo lang_show('bank_j');
		 	?>
          </td>
          <td align="center">
		  <a href="bank_account_mod.php?id=<?php echo $re[$i]['id']; ?>"><?php echo lang_show('edit');?></a>
		  <?php
		  	if($re[$i]['active'] ==0)
				echo '| <a href="?deid='.$re[$i]['id'].'">'.lang_show('delete').'</a>';
		  ?>		  </td>
          <?php 
    	}
		?>
        </tr>
        <tr>
          <td colspan="8" align="right"><div class="page"><?php echo $pages?></div></td>
        </tr>
      </table>
	</div>
</div>
</body>
</html>
