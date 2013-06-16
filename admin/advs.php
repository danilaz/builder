<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
?>
<html>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('adv_menager');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr > 
      <td width="50" align="center"><strong><?php echo lang_show('number');?></strong></td>
      <td width="364" align="left"><strong><?php echo lang_show('name');?></strong></td>
      <td width="71" align="left"><strong><?php echo lang_show('adv_type');?></strong></td>
      <td width="81" align="left"><strong>Стоимость</strong></td>
      <td width="77" align="left"><strong>Размер</strong></td>
      <td width="73" align="left"><strong>Показов</strong></td>
      <td width="133" align="left"><strong><?php echo lang_show('include_code');?></strong></td>
      <td width="97" align="center"><strong><?php echo lang_show('operate');?></strong></td>
    </tr>
    <?php
	$adt[1]=lang_show('text');
	$adt[2]=lang_show('code');
	$adt[3]=lang_show('image');
	$adt[4]=lang_show('flash');
	$db->query("select * from ".ADVS." order by ID asc");
	$re=$db->getRows();
	for($i=0;$i<count($re);$i++)
	{
		$sql="select count(*) as num,sum(shownum) as shownum from ".ADVSCON." WHERE isopen=1 and group_id='".$re[$i]['ID']."'";
		$db->query($sql);
		$num=$db->fetchRow();
	?>
    <form name="form1" method="post" action="">
      <tr> 
        <td align="center"><?php echo $re[$i]['ID']; ?></td>
        <td align="left">
			<a <?php if($num['num']==0) echo 'style="color:#999999"';?> href="advs_con_list.php?group_id=<?php echo $re[$i]['ID']; ?>">
			<?php echo $re[$i]['name'];?>(<?php echo $num['num']; ?>)
			</a>
		</td>
        <td align="left">
			<?php 
			if(!empty($re[$i]['ad_type'])&&$re[$i]['ad_type']==1)
				echo 'Глобальная';
			elseif($re[$i]['ad_type']==2)
				echo 'Слайд шоу';
			else
				echo 'Рекламные блоки';
			?>
		</td>
        <td align="center">
			<?php 
			if(empty($re[$i]['price'])=="")
				echo $re[$i]['price'].'&nbsp;'.$config['money'];
			else
				echo ' --- ';
			?>
		</td>
        <td align="left"><?php echo $re[$i]['width'];?>*<?php echo $re[$i]['height'];?></td>
        <td align="left"><?php echo $num['shownum']; ?>&nbsp;</td>
        <td align="left"><input name="js" type="text" id="js" value="<script src='&lt;{$config.weburl}&gt;/api/ad.php?id=<?php echo $re[$i]['ID']; ?>&catid=&lt;{$smarty.get.id}&gt;&sname=&lt;{$sname}&gt;'></script>" size="25"></td>
        <td align="center">
		<a href="edit_adv.php?id=<?php echo $re[$i]['ID'];?>"><?php echo $editimg;?></a>
		</td>
      </tr>
    </form>
    <?php 
	 }
	?>
  </table>
  </div>
</div>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('manaul');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellspacing="0" cellpadding="8" >
    <tr valign="top"> 
      <td height="66">
      <?php echo lang_show('description');?>
	  </td>
    </tr>
  </table>
</div>
</div>
</body>
</html>
