<?php
include_once("../includes/global.php");
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//======================================
if(isset($_GET["step"]))
	$step=$_GET["step"];
$step=isset($step)?$step:NULL;
if(!empty($_POST["step"])&&$_POST["step"]=="new")
{

	if(!empty($_POST["province_id"]))
	{
		$sql="update ".PROVINCE." set
	    province='$_POST[provinces]',sx='$_POST[sx]',country_id='$_POST[country_id]' where province_id='$_POST[province_id]'";
		$db->query($sql);
	}
	else
	{
		$sql="insert into ".PROVINCE." 
		( province,sx,country_id) 
		values 
		('$_POST[provinces]','$_POST[sx]','$_POST[country_id]')";
		$db->query($sql);
	}
	
}

	if($step=="del")
	{
		$db->query("delete from ".PROVINCE." where province_id='$_GET[linkid]'");
	}
	$country_id=NULL;
	if($step=="edit")
	{
		$db->query("select * from ".PROVINCE." where province_id='$_GET[linkid]'");
		if($db->next_record()){
		$country_id=$db->f('country_id');
		$prov=$db->f('province');
		$province_id=$db->f('province_id');
		$sx=$db->f('sx');
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
<div class="guidebox"><?php echo lang_show('sys_m');?> &raquo; <?php echo lang_show('provin_m');?></div>

<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('provincesearch'); ?></div>
	<div class="bigboxbody">
	<form action="" method="get" style="margin-top:0px;">
	<table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12%"><?php echo lang_show('search_country'); ?>:</td>
    <td width="88%"><select name="country3" id="country3">
	<option value="" selected><?php echo lang_show('select_country'); ?></option>
	<?php
	$sql="select * from ".COUNTRY." where 1 order by nums asc,ename asc";
	$db->query($sql);
	while($db->next_record())
	{
	?>
       <option value="<?php echo $db->f('id'); ?>"><?php  echo $db->f('ename'); ?></option>
     <?php } ?>
	</select>
    </td>
  </tr>
  <tr>
    <td><?php echo lang_show('p_name'); ?>:</td>
    <td><input name="province3" type="text" id="province3" size="30">
      <input name="Input" class="btn" type="submit" value=" <?php echo lang_show('search'); ?> "></td>
  </tr>
</table>
</form>
	</div>

<div style="float:left; height:50px; width:80%;">&nbsp;</div>
  <form method="post" action="?step=new">
	<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('p_mod_add');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><?php echo lang_show('c_name'); ?></td>
          <td><select name="country_id" id="country_id">
			<?php
			$sql="select * from ".COUNTRY." order by nums asc,ename asc";
			$db->query($sql);
			$re=$db->getRows();
			foreach($re as $v)
			{
			?>
            <option value="<?php echo $v['id']; ?>" <?php if($country_id==$v['id']){?>selected<?php }?>><?php  echo $v['ename']; ?> <?php  echo $v['cname']; ?></option>
            <?php  }?>
		  </select>
          </td>
        </tr>
        <tr>
          <td width="17%"><?php echo lang_show('p_name');?></td>
          <td width="83%">
          <input name="provinces" type="text" id="city" value="<?php if(isset($prov)) echo "$prov";?>" size="40"></td>
        </tr>
        <tr>
          <td><?php echo lang_show('e_name');?></td>
          <td><input name="sx" type="text" id="nums" value="<?php if(isset($sx)) echo $sx;?>" size="40">
           </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input type="hidden" name="step" value="new">
			<?php 	if($step=="edit")
	            {
		    ?>
            <input type="hidden" name="province_id" value="<?php if(isset($province_id)) echo "$province_id";?>">
			<?php
				}
			?>
            <input class="btn" type="submit" name="Submit" value="<?php echo lang_show('modify');?>"></td>
        </tr>
      </table>
	</div>	
</div>

<div style="float:left; height:50px; width:80%;">&nbsp;</div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('provin_m');?></div>
	<div class="bigboxbody">
          <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr> 
              <td width="17%" height="19" ><?php echo lang_show('p_n');?></td>
              <td width="17%" height="19" ><?php echo lang_show('p_op');?></td>
            </tr>
		<?php
		if(isset($_GET["country3"]))
			$ksql.=" and country_id='$_GET[country3]' ";
		if(isset($_GET["province3"]))
			$ksql.=" and province like '%$_GET[province3]%' ";
		$sql="select * from ".PROVINCE." where 1=1 $ksql ";
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
            <tr> 
              <td ><?php  echo $db->f('province'); ?> </td>
              <td width="17%" >
			   <a href="?step=edit&linkid=<?php echo $db->f('province_id'); ?>"><?php echo $editimg;?></a>
			   <a href="?step=del&linkid=<?php echo $db->f('province_id'); ?>"><?php echo $delimg;?></a></td>
            </tr>
       <?php
		}
		?>
		<tr><td colspan="2"><div class="page"><?php echo $pages?></div></td></tr>
	  </table>
  </div>
</div>

</div>
</form>
</body>
</html>