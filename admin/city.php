<?php
include_once("../includes/global.php");
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//======================================
$_GET['firstRow']=empty($_GET['firstRow'])?NULL:$_GET['firstRow'];
$_GET['totalRows']=empty($_GET['totalRows'])?NULL:$_GET['totalRows'];
$_GET['province3']=empty($_GET['province3'])?NULL:$_GET['province3'];
$step=empty($_GET['step'])?NULL:$_GET['step'];

if(!empty($_POST["step"])&&$_POST["step"]=="new")
{
	$_POST['nums']=empty($_POST['nums'])?0:$_POST['nums'];
	if(!empty($_POST["city_id"]))
	{
		$sql="update ".CITY." set
	    city='$_POST[city_name]',province_id='$_POST[province_id]',nums='$_POST[nums]' where city_id='$_POST[city_id]'";
		$db->query($sql);
	}
	else
	{
		$sql="insert into ".CITY." 
		( city,province_id,nums) 
		values 
		('$_POST[city_name]','$_POST[province_id]','$_POST[nums]')";
		$db->query($sql);
	}
	msg("city.php?province3=$_GET[province3]&firstRow=$_GET[firstRow]&totalRows=$_GET[totalRows]");
}

if($step=="del")
	$db->query("delete from ".CITY." where city_id='$_GET[linkid]'");

$oldlinkid=$city_name=$city_id=$province_id=$nums=NULL;
if($step=="edit")
{
	$db->query("select * from ".CITY." where city_id='$_GET[linkid]'");
	if($db->next_record())
	{
		$oldlinkid=$linkid;
		$city_name=$db->f('city');
		$city_id=$db->f('city_id');
		$province_id=$db->f('province_id');
		$nums=$db->f('nums');
	}
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('citysearch'); ?></div>
	<div class="bigboxbody">
	<form action="" method="get" style="margin-top:0px;">
	<table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12%"><?php echo lang_show('province'); ?>:</td>
    <td width="88%">
    <select name="province3" id="province3">
	<option value="" selected><?php echo lang_show('searchcity'); ?></option>
	<?php
	$sql="select * from ".PROVINCE." order by province asc";
	$db->query($sql);
	while($db->next_record())
	{
		if(!empty($_GET["province3"])&&$_GET["province3"]==$db->f('province_id'))
			$sl='selected';
		else
			$sl=NULL;
	?>
       <option <?php echo $sl;?> value="<?php echo $db->f('province_id'); ?>"><?php  echo $db->f('province'); ?></option>
     <?php } ?>
	</select>
    </td>
  </tr>
  <tr>
    <td><?php echo lang_show('cityname'); ?>:</td>
    <td><input name="cityname" type="text" id="cityname" size="30">
      <input name="Input" class="btn" type="submit" value=" <?php echo lang_show('search'); ?> "></td>
  </tr>
</table>
</form>
	</div>
</div>

<div style="float:left; height:50px; width:80%;">&nbsp;</div>
  <form method="post" action="">
	<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('addcity'); ?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
          <td><?php echo lang_show('province'); ?>:</td>
          <td><select name="province_id" id="province_id">
			<?php
			$sql="select * from ".PROVINCE."";
			$db->query($sql);
			while($db->next_record())
			{
			?>
            <option value="<?php echo $db->f('province_id'); ?>" <?php if($province_id==$db->f('province_id')){?>selected<?php }?>><?php  echo $db->f('province'); ?></option>
            <?php  }?>
		  </select>
          </td>
        </tr>
        <tr>
          <td width="17%"><?php echo lang_show('cityname'); ?>: </td>
          <td width="83%"><input name="city_name" type="text" id="city_name" value="<?php echo $city_name;?>" size="40"></td>
        </tr>
        <tr>
          <td><?php echo lang_show('none'); ?>:</td>
          <td><input name="nums" type="text" id="nums" value="<?php echo $nums;?>" size="40">
            <?php echo lang_show('default'); ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
		    <input type="hidden" name="step" value="new">
          <?php			
			if($step=="edit")
            {
		  ?>
          <input type="hidden" name="city_id" value="<?php echo $city_id;?>">
		<?php
		}
		?>
            <input class="btn" type="submit" name="Submit" value="<?php echo lang_show('revision'); ?>"></td>
        </tr>
      </table>
	</div>
</div>

<div style="float:left; height:50px; width:80%;">&nbsp;</div>


<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('managecity'); ?></div>
	<div class="bigboxbody">
          <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr> 
              <td width="17%" height="19" ><?php echo lang_show('name'); ?></td>
              <td width="17%" height="19" ><?php echo lang_show('operation'); ?></td>
            </tr>
		<?php
		$ksql=NULL;
		if(!empty($_GET["province3"]))
			$ksql.=" and province_id='$_GET[province3]' ";
		if(!empty($_GET["cityname"]))
			$ksql.=" and city like '%$_GET[cityname]%' ";
		$sql="select * from ".CITY." where 1=1 $ksql order by nums asc";
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
		while($db->next_record())
		{
		?>
            <tr > 
              <td ><?php  echo $db->f('city'); ?> </td>
              <td width="17%" >
			   <a href="?step=edit&linkid=<?php echo $db->f('city_id'); ?>&province3=<?php echo $_GET['province3'];?>&firstRow=<?php echo $_GET['firstRow'];?>&totalRows=<?php echo $_GET['totalRows'];?>"><?php echo $editimg; ?></a>
               <a href="?step=del&linkid=<?php echo $db->f('city_id'); ?>&province3=<?php echo $_GET['province3'];?>&firstRow=<?php echo $_GET['firstRow'];?>&totalRows=<?php echo $_GET['totalRows'];?>"><?php echo $delimg; ?></a>
               </td>
            </tr>
       <?php
		}
		?>
		<tr><td colspan="2"><div class="page"><?php echo $pages?></div></td></tr>
	  </table>
  </div>
</div>

</form>
</body>
</html>