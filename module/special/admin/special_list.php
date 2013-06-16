<?php
include_once("../includes/page_utf_class.php");
//==========================
if(!empty($_GET['deid']))
{
	$sql="delete from ".SPE." where id='$_GET[deid]'";
	$db->query($sql);
	@unlink($config['webroot']."/uploadfile/newsimg/special/".$_GET['deid'].".jpg");//专题图片
	$sql="select * from ".MLAY." where tid='$_GET[deid]' and type=1 and name='picture'";
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $v)
	{
		$v=unserialize($v['filter']);
		$pic = $config['webroot']."/uploadfile/modules/".$v['pic'];
		@unlink($pic);
	}
	$sql="delete from ".MLAY." where tid='$_GET[deid]' and type=1";
	$db->query($sql);
}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/Calendar.js"></script>
</HEAD>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('hr_info_manager');?></div>
<form action="" method="post" enctype="multipart/form-data">
<div class="bigbox">
	<div class="bigboxhead">Дополнительные темы</div>
	<div class="bigboxbody">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr >
        <td width="18%">Название функции</td>
        <td width="27%">Период</td>
        <td width="19%">Автор</td>
        <td width="17%">Дата</td>
        <td width="19%">Управление</td>
      </tr>
	  <?php
      $sql="select * from ".SPE." order by id desc";
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
      foreach($re as $v)
      {
      ?>
  <tr>
    <td><?php echo $v['name'];?></td>
    <td><?php echo dateformat($v['stime']);?> / <?php echo dateformat($v['etime']);?></td>
    <td><?php echo $v['add_user'];?></td>
    <td><?php echo dateformat($v['add_time']);?></td>
    <td>
        <a href="module.php?m=special&s=special_list.php&deid=<?php echo $v['id'];?>">Удалить</a> |
        <a href="module.php?m=special&s=add_special.php&edit=<?php echo $v['id'];?>">Изменить</a> |
        <a href="module.php?m=special&s=special_con.php&id=<?php echo $v['id'];?>">Сочетание содержания</a>    </td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td colspan="5"><div class="page"><?php echo $pages?></div></td>
    </tr>
</table>

    </div>
</div>
</form>
</body>
</html>