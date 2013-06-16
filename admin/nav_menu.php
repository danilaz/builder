<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/".$sctiptName);
include_once("auth.php");
//=============================
if (!empty($_POST['submit']))
{
	foreach($_POST['sort'] as $k5=>$v)
	{
		$msql="update ".MENU." set sort='$v',menu_name='".$_POST['menu_name'][$k5]."',link_addr='".$_POST['link_addr'][$k5]."',statu='".$_POST['statu'][$k5]."',selected_flag='".$_POST['selected_flag'][$k5]."' where id=$k5";
		 $db->query($msql); 
	}
    //-------------------------
	if(!empty($_POST['sub_menu_sort']))
	{
		foreach($_POST['sub_menu_sort'] as $k5=>$v)
		{
		  $msql="update ".MENU." set sort='$v',menu_name='".$_POST['sub_menu_name'][$k5]."',link_addr='".$_POST['sub_menu_linkaddr'][$k5]."',statu=".$_POST['sub_menu_statu'][$k5]."',selected_flag='".$_POST['selected_flag'][$k5]."' where id=$k5";
		  $db->query($msql); 
		}
	}
}
/****更新缓存文件*******/
$write_str=serialize(getipdata());//将数组序列化后生成字符串
$write_str='<?php $nav_menu = unserialize(\''.$write_str.'\');?>';//生成要写的内容
$fp=fopen('../config/nav_menu.php','w');
fwrite($fp,$write_str,strlen($write_str));//将内容写入文件．
fclose($fp);
/*********************/
function getipdata()
{
	global $db,$config;
	$sql="select menu_name,link_addr,selected_flag,type from ".MENU." 
	where lang='$config[language]' and partent_menu_id=0 and statu=1 order by sort asc";
	$db->query($sql);
	$re=$db->getRows();
	return $re;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<TITLE><?php echo lang_show('nav_Columns');?></TITLE>
</head>
<body>
<div class="guidebox"><?php echo lang_show('nav_config');?> </div>
<div class="bigbox">
<div class="bigboxhead">
<?php echo lang_show('nav_config');?>
<a style=" margin-left:20px;" href="nav_menu_action.php?action=add&aid=99999999"><?php echo lang_show('nav_add');?>
</a>
</div>
<div class="bigboxbody">
<form id="form1" action="nav_menu.php" method="POST" style="margin-top:0px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr>
      <td width="80" height="24" align="left"  ><?php echo lang_show('nav_sort');?></td>
      <td width="161" align="left"  ><?php echo lang_show('nav_name');?></td>
      <td align="left"  ><?php echo lang_show('nav_linkaddr');?></td>
      <td width="74" align="left"  ><?php echo lang_show('nav_type');?></td>
	  <td width="74" align="left"  ><?php echo lang_show('selflag');?></td>
      <td width="72" align="right"  ><?php echo lang_show('nav_statu');?></td>
      <td  align="center"  ><?php echo lang_show('opert');?>&nbsp;</td>
    </tr>
	    <?php
		unset($sql);
        $sql="select * from ".MENU." where lang='$config[language]' and partent_menu_id=0 order by statu desc,sort asc";
        $db->query($sql);
        $re=$db->getRows();
        foreach($re as $v)
	    {
       ?>
        <tr>
          <td ><input name="sort[<?php echo $v['id'];?>]" type="text" id="sort[<?php echo $v['id'];?>]" size="5" maxlength="2" value="<?php echo $v['sort'];?>"></td>
          <td ><input name="menu_name[<?php echo $v['id'];?>]" type="text" id="menu_name[<?php echo $v['id'];?>]" size="20" maxlength="30" value="<?php echo $v['menu_name'];?>">          </td>
          <td ><input name="link_addr[<?php echo $v['id'];?>]" type="text" id="link_addr[<?php echo $v['id'];?>]" size="30" maxlength="100" value="<?php echo $v['link_addr'];?>">
		  </td>
			<td>
			<?php 
			if ($v['type']==1)
				echo lang_show('built');
			else
				echo lang_show('custom'); 
			?>   
			</td>
	            <td >
				<input name="selected_flag[<?php echo $v['id'];?>]" type="text" id="selected_flag[<?php echo $v['id'];?>]" size="10" value="<?php echo $v['selected_flag'];?>" <?php if ($v['type']==1)echo "Readonly";?>></td>
          <td align="right" >
            <select name="statu[<?php echo $v['id'];?>]" id="statu[<?php echo $v['id'];?>]">
              <option value="1" <?php if($v['statu']==1) echo "selected";?>><?php echo lang_show('appaly');?></option>
              <option value="0" <?php if($v['statu']==0) echo "selected";?>><?php echo lang_show('forbid');?></option>
            </select>
			</td>
          <td align="right" >
		  <?php 
          if ($v['type']!=1)
          {
          ?><a href="nav_menu_action.php?action=del&did=<?php echo $v['id'];?>" onClick="javascript:return confirm('<?php echo lang_show('suredel');?>')"><img alt="<?php echo lang_show('nav_del');?>" src="../image/admin/del.gif"></a>
          <?php
          }
          ?>&nbsp;
		  </td>
        </tr>
		<?php
		}
		?>
            <tr>
          <td colspan="7" align="left" valign="top">
            <input class="btn" type="submit" name="submit" id="submit" value="<?php echo lang_show('submit');?>" onClick='return confirm("<?php echo lang_show('are_you_sure');?>");'>          </td>
        </tr>
  </table>
</form>
</div>
</div>
</body>
</html>