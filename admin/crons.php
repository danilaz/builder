<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//==========================================
if(isset($_GET["step"]) && $_GET["step"]=="del")
{
	$db->query("delete from ".CRON." where id='$_GET[deid]'");
}
if(isset($_GET["execute"]) && $_GET["execute"] != '')
{
	include_once($config["webroot"]."/includes/cron_inc.php");
	execute_transact($_GET["execute"]);
	msg('crons.php',lang_show('executed'));
}
if(isset($_GET["submit"]) && $_GET["submit"] == lang_show('submit'))
{
	if(isset($_GET["de"]) && is_array($_GET["de"])) {
		for($i=0;$i<count($_GET["de"]);$i++) { //delete product image
			$activenew = isset($_GET["active".$_GET["de"][$i]]) ? 1 : 0;
			$db->query("update ".CRON." set active='$activenew' where id=".$_GET["de"][$i]);
		}
	}
	if(isset($_GET["add"]) && $_GET["add"] != '') {
		$sql = "insert into ".CRON." (name) value('$_GET[add]')";
		$db->query($sql);
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
  <form action="" method="get">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('crons_list');?><?php echo gmdate('Y-m-d H:i', strtotime('now')+8*3600); ?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellpadding="2" cellspacing="0" >
        <tr >
          <td width="50" height="24" ><?php echo lang_show('usable');?></td>
          <td width="150" ><?php echo lang_show('cron_name');?></td>
          <td width="150" ><span ><?php echo lang_show('cron_script');?></span></td>
          <td width="150" align="left" ><?php echo lang_show('frequency');?></td>
          <td width="150" ><?php echo lang_show('lasttransact');?></td>
          <td width="150" ><?php echo lang_show('nexttransact');?></td>
          <td width="150" align="center" ><?php echo lang_show('manager');?></td>
        </tr>
        <?php
	$sql = "select * from ".CRON." order by id";
	include_once("../includes/page_utf_class.php");
	$page = new Page;
	$page->listRows=20;
	if (!$page->__get('totalRows')){
		$db->query($sql);
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  limit ".$page->firstRow.",20";
	$pages = $page->prompt();

	$db->query($sql);
	$re=$db->getRows();
	$coun_num=$db->num_rows();
	$notdelet_array=array('update_expired_question.php','update_page_record.php');//不允许删除的任务功能
	for($i=0;$i<$coun_num;$i++)
	{ 
	?>
        <tr  onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')">
          <td width="52">
		  <input name="de[]" type="hidden" id="de" value="<?php echo $re[$i]['id']; ?>" />
		  <input name="active<?php echo $re[$i]['id']; ?>" type="checkbox" id="active<?php echo $re[$i]['id']; ?>" value="<?php echo $re[$i]['active']; ?>" <?php if($re[$i]['active']==1) echo "checked"; ?>></td>
          <td><?php echo $re[$i]['name']; ?></td>
          <td><?php echo $re[$i]['script']; ?></td>
          <td><?php
				if($re[$i]['week'] != -1) {
					$cycle = lang_show($re[$i]['week']);
				} else if($re[$i]['day'] == -1) {
					$cycle = lang_show('daily');
				} else {
					$cycle = lang_show('monthly');
					$cycle .= $re[$i]['day'];
					$cycle .= lang_show('day');
				}
				$cycle .= " ";
				$cycle .= $re[$i]['hours'];
				$cycle .= ":";
				$cycle .= $re[$i]['minutes'];
				echo $cycle;
	?></td>
          <td><?php if($re[$i]['lasttransact']) { echo date("Y-m-d",$re[$i]['lasttransact']); } else { echo "<b>N/A</b>"; } ?></td>
          <td><?php if($re[$i]['nexttransact']) { echo date("Y-m-d",$re[$i]['nexttransact']); } else { echo "<b>N/A</b>"; } ?></td>
          <td>
          <a href="cron_edit.php?id=<?php echo $re[$i]["id"]; ?>"><?php echo lang_show('edit');?></a>
          
          
          | <a href="?execute=<?php echo $re[$i]["id"]; ?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>')"><?php echo lang_show('execute');?></a>
          <?php if(!in_array($re[$i]['script'],$notdelet_array))
		  {
		  ?>
            | <a href="?step=del&deid=<?php echo $re[$i]["id"]; ?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>')"><?php echo lang_show('delete');?></a>
          <?php } ?>
          </td>
        </tr>
		<?php
	}
		?>
        <tr>
          <td colspan="8" align="right" ><div class="page"><?php echo $pages?></div></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" style="border:none;">
                <?php echo lang_show('add');?> <input type="text" name="add" value="" />
                <input class="btn" type="submit" name="submit" value="<?php echo lang_show('submit'); ?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
            </td>
          </tr>
          </table>
	</div>
</div>
</form>

</body>
</html>
