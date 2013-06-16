<?php
//===============================================
if (!empty($_POST['resort'])&&$_POST['resort']==lang_show('resort'))
{
    foreach($_POST['sort'] as $key=>$v)
	{
		$msql="update ".NOTICE." set sort=".$v." where id=".$key;
		$db->query($msql); 
	}
}
if($_GET['action']=='del'&&!empty($_GET['id']))
{
	$db->query("delete from ".NOTICE." where id='$_GET[id]'");
}
$sql="select * from ".NOTICE." order by sort";
$db->query($sql);
$re=$db->getRows();
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<form name="noticem" method="post" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('noticelist');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0">
        <tr>
          <td width="50"  ><?php echo lang_show('sort');?></td>
          <td width="436"  ><?php echo lang_show('ntitle');?></td>
          <td width="110"  ><?php echo lang_show('ntype');?></td>
          <td width="178"  ><?php echo lang_show('ntime');?></td>
          <td width="86"  ><?php echo lang_show('author');?></td>
          <td width="117"  ><?php echo lang_show('manager');?></td>
        </tr>
        <?PHP
        foreach($re as $v)
	     {
        ?>
        <tr>
          <td align="left"   scope="row"> <input name="sort[<?php echo $v['id'];?>]" type="text" id="sort[<?php echo $v['id'];?>]" size="5" maxlength="5" value="<?php echo $v['sort'];?>">          </td>
          <td align="left"  ><?php echo $v['title'];?></td>
          <td align="left"  ><?php 
          if ($v['type']==1)
              echo lang_show('ntxt');
          else
              echo lang_show('nhref');
		    date("y-m-d",$v['starttime']);
           ?></td>
          <td align="left" ><?php echo date("Y-m-d",$v['starttime'])." по ".date("Y-m-d",$v['endtime']);?></td>
          <td align="left"  ><?php echo $v['author'];?></td>
          <td align="left"  >
		  <a href="module.php?m=announcement&s=notice_manager.php&action=modify&id=<?php echo $v['id'];?>"><?php echo $editimg;?></a>
		  <a href="module.php?m=announcement&s=notice.php&action=del&id=<?php echo $v['id'];?>"><?php echo $delimg;?></a>
		  </td>
        </tr>
        <?php
        }
        ?>
		<tr>
          <td colspan="6" align="left"   scope="row">
            <input class="btn" type="submit" name="resort" id="reresort" value="<?php echo lang_show('resort');?>">
          </td>
        </tr>
      </table>
	</div>
</div> 
</form>
</body>
</html>