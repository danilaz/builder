<?php
include_once("../includes/global.php");
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//======================================
if(isset($_GET['step']))
	$step=$_GET['step'];
$step=isset($step)?$step:NULL;
if(!empty($_POST['step'])&&$_POST['step']=="new")
{
	if(!empty($_POST['id']))
	{
		$_POST['nums']=empty($_POST['nums'])?0:$_POST['nums'];
		$sql="update ".COUNTRY." set
	    ename='$_POST[ename]',cname='$_POST[cname]',postcode='$_POST[postcode]',flag='$_POST[flag]',nums='$_POST[nums]'
		where id='$_POST[id]'";
		$db->query($sql);
	}
	else
	{
		$db->query("select id from ".COUNTRY." order by id desc");
		$rid=$db->fetchRow();
		$id=$rid['id']+1;
		$sql="insert into ".COUNTRY." 
		(id,cname,ename,postcode,flag) 
		values 
		('$id','$_POST[cname]','$_POST[ename]','$_POST[postcode]','$_POST[flag]')";
		$re=$db->query($sql);
		if($re)
			msg('country.php');
	}
}

if($step=="del")
	$db->query("delete from ".COUNTRY." where id='$_GET[linkid]'");
	
if($step=="edit")
{
	$db->query("select * from ".COUNTRY." where id='$_GET[linkid]'");
	if($db->next_record())
	{
		$ename=$db->f('ename');
		$cname=$db->f('cname');
		$id=$db->f('id');
		$postcode=$db->f('postcode');
		$nums=$db->f('nums');
		$flag=$db->f('flag');
	}
}
$tsql=NULL;
if(!empty($_GET['key']))
{
	$key=$_GET['key'];
	$tsql=" and ename like '%$_GET[key]%' or cname like '%$_GET[key]%' or flag like '%$_GET[key]%'";
}
else
	$key=NULL;
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('country_m');?></div>
	<div class="bigboxbody">
    <form action="" method="get">
    <span style="font-size:12px; padding-left:25px;">Ключевые слова: </span><input name="key" type="text" value="<?php echo $key;?>">
    <input class="btn" type="submit" name="button" id="button" value="Отправить">
    </form>
    </div>
</div>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>
  <form method="post" action="?step=new">
	<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('c_mod_add');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17%"><?php echo lang_show('c_name');?></td>
          <td width="83%">
          <input name="cname" type="text" id="cname" value="<?php if(isset($cname)) echo "$cname";?>" size="40"></td>
        </tr>
        <tr>
          <td><?php echo lang_show('e_name');?></td>
          <td><input name="ename" type="text" id="ename" value="<?php if(isset($ename)) echo $ename;?>" size="40">           </td>
        </tr>
        <tr>
          <td><?php echo lang_show('postcode');?></td>
          <td><input name="postcode" type="text" id="postcode" value="<?php if(isset($postcode)) echo $postcode;?>" size="40">           </td>
        </tr>
        <tr>
          <td>Flag Name</td>
          <td><input name="flag" type="text" id="flag" value="<?php if(isset($flag)) echo $flag;?>" size="40"></td>
        </tr>
        <tr>
          <td>Nums</td>
          <td><input name="nums" type="text" id="nums" value="<?php if(isset($nums)) echo $nums;?>" size="40"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input type="hidden" name="step" value="new">

            <input type="hidden" name="id" value="<?php if(isset($id)) echo "$id";?>">

            <input class="btn" type="submit" name="Submit" value="<?php echo lang_show('modify');?>"></td>
        </tr>
      </table>
	</div>
</div>
</form>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('country_m');?></div>
	<div class="bigboxbody">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
        <tr> 
          <td width="17%" height="19" ><?php echo lang_show('c_e_n');?></td>
          <td width="17%" height="19" ><?php echo lang_show('c_c_n');?></td>
          <td width="17%" height="19" ><?php echo lang_show('postcode');?></td>
          <td width="17%" height="19" ><?php echo lang_show('c_op');?></td>
        </tr>
		<?php
		$sql="select * from ".COUNTRY." where 1 $tsql order by nums asc,ename asc";
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
              <td ><img src="../image/cflag/<?php echo $v['flag'];?>.gif" >&nbsp;&nbsp;<?php  echo $v['ename']; ?> </td>
              <td ><?php  echo $v['cname']; ?> </td>
              <td ><?php  echo $v['postcode']; ?> </td>
              <td>
               <a href="?step=edit&linkid=<?php echo $v['id']; ?>"><?php echo $editimg;?></a>
               <a href="?step=del&linkid=<?php echo $v['id']; ?>"><?php echo $delimg;?></a>
               </td>
            </tr>
       <?php
		}
		?>
	  <tr><td colspan="4"><div class="page"><?php echo $pages?></div></td></tr>
	  </table>
  </div>
</div>

</body>
</html>