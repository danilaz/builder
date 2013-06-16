<?php
include_once("../includes/global.php");
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//======================================
$step=isset($_POST["step"])?$_POST["step"]:NULL;
if($step=="new")
{
	$published=isset($_POST["published"])?1:0;
	$tj=isset($_POST["tj"])?1:0;
	$orderid=$_POST["orderid"]?$_POST["orderid"]:0;
	if(empty($_POST["stime"]))
		$_POST["stime"]=time();
	else
		$_POST["stime"]=strtotime($_POST["stime"]);
	if(empty($_POST["etime"]))
		$_POST["etime"]=time();
	else
		$_POST["etime"]=strtotime($_POST["etime"]);
	if($_POST["linkid"])
	{
		$sql="update ".LINK." set
	    name='$_POST[linkname]',url='$_POST[url]',published='$published',
		orderid='$orderid',log='$_POST[log]',tj='$tj',stime='$_POST[stime]',etime='$_POST[etime]',con='$_POST[con]'
		where linkid=$_POST[linkid]";
		$db->query($sql);
	}
	else
	{
		$sql="insert into ".LINK." 
		(name,url,published,orderid,log,tj,province,city,stime,etime,con) 
		values 
		('$_POST[linkname]','$_POST[url]','$published','$orderid','$_POST[log]','$tj','$_SESSION[province]','$_SESSION[city]','$_POST[stime]','$_POST[etime]','$_POST[con]')";
		$db->query($sql);
	}
	msg("link.php");
}
$linkid=isset($_GET['linkid'])?$_GET['linkid']:NULL;
if($linkid)
{
	$db->query("select * from ".LINK." where linkid='$linkid'");
	if($db->next_record()){
		$oldlinkid=$linkid;
		$stime=$db->f('stime');
		$etime=$db->f('etime');
		$oldlinkname=$db->f('name');
		$oldlinkid=$db->f('linkid');
		$oldurl=$db->f('url');
		$oldlogo=$db->f('log');
		$oldorderid=$db->f('orderid');
		$con=$db->f('con');
		if($db->f('published')==1) $ispublished='checked'; else $ispublished='';
		if($db->f('tj')==1) $tj='checked'; else $tj='';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo lang_show('admin_system');?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/Calendar.js"></script>
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
weburl='<?php echo $config['weburl'];?>';
</script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript" src="../script/prototype.js"></script>
</HEAD>
<body>
  <form method="post" action="" enctype="multipart/form-data">
	<div class="bigbox">
	<div class="bigboxhead"> <?php echo lang_show('link_manager');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17%" align="right"><?php echo lang_show('link_name');?></td>
          <td width="83%"><input type="text" name="linkname" style="width:250px;" value="<?php echo isset($oldlinkname)?$oldlinkname:NULL;?>"></td>
        </tr>
        <tr>
          <td align="right"><?php echo lang_show('link_url');?></td>
          <td><input type="text" name="url" style="width:250px;" value="<?php echo isset($oldurl)?$oldurl:NULL;?>"></td>
        </tr>
        <tr>
          <td align="right">Лого</td>
          <td><input id="log" type="text" name="log" style="width:250px;" value="<?php echo isset($oldlogo)?$oldlogo:NULL;?>">
		 [<a href="javascript:uploadfile('Загрузите логотип','log',85,32)">Загрузить</a>] 
		 [<a href="javascript:preview('log');">Предпросмотр</a>]
		 [<a onclick="javascript:$('log').value='';" href="#">Удалить</a>]
		  </td>
        </tr>

                <tr>
                  <td align="right">Примечания</td>
                  <td><textarea style="width:250px;" name="con" rows="5" id="con"><?php echo $con;?></textarea></td>
                </tr>
				        <tr>
          <td align="right"><?php echo lang_show('VaildPeriod');?></td>
          <td>
		  	<script language="javascript">
			var cdr = new Calendar("cdr");
			document.write(cdr);
			cdr.showMoreDay = true;
			</script>
		  <input readonly name="stime" type="text" id="stime" value="<?php if(isset($stime)){echo date("Y-m-d",$stime);}?>" onFocus="cdr.show(this);">
          <input readonly onFocus="cdr.show(this);" name="etime" type="text" id="etime" value="<?php if(isset($etime)){echo date("Y-m-d",$etime);}?>">		  </td>
        </tr>
		<tr>
          <td align="right"><?php echo lang_show('sort_sort');?></td>
          <td><input style="width:100px;" name="orderid" type="text" id="orderid" value="<?php echo isset($oldorderid)?$oldorderid:NULL;?>"></td>
        </tr>
		<tr>
          <td align="right"><?php echo lang_show('is_open');?></td>
          <td><input name="published" type="checkbox" id="published" <?php echo isset($ispublished)?$ispublished:NULL;?> value="1"></td>
        </tr>
        <tr>
          <td align="right"><?php echo lang_show('is_recommend');?></td>
          <td><input name="tj" type="checkbox" id="tj" <?php echo isset($tj)?$tj:NULL;?> value="1"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input type="hidden" name="step" value="new">
            <input type="hidden" name="linkid" value="<?php echo isset($oldlinkid)?$oldlinkid:NULL;?>">
            <input class="btn" type="submit" name="Submit" value="<?php echo lang_show('submit_link');?>"></td>
        </tr>
      </table>
	</div>
</div>
</form>
</body>
</html>