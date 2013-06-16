<?php
include_once("../includes/global.php");
//载入语言包
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//================
if(!empty($_POST["name"])&&empty($_POST["edit"]))
{
	 if(empty($_POST['company_type']))
	 	$_POST['company_type']='';
	 if(!empty($_POST["id"]))
	 {
		$s=$_POST["id"]."00";
		$b=$_POST["id"]."99";
		$sql="select max(id) as id from ".CTYPE." where id>$s and id<$b";
		$db->query($sql);
		$re=$db->fetchRow();
		$id=$re["id"];
		if(!$id)
			$id=$_POST["id"]."01";
		else
			$id=$id+1;
	  }
	  else
	  {
	  	$sql="select max(id) as id from ".CTYPE." where id<100";
		$db->query($sql);
		$re=$db->fetchRow();
		$id=$re["id"]+1;
		if($id<10)
			$id=10;
	  }
	//-------------
	$sql="insert into ".CTYPE."
	 (id,company_type,name,con) 
	 values 
	 ('$id','$_POST[company_type]','$_POST[name]','$_POST[con]')";
	$db->query($sql);
	msg("comments_list.php");
}
//================
if(!empty($_POST["id"])&&!empty($_POST["edit"]))
{
	$sql="update ".CTYPE." set name='$_POST[name]',con='$_POST[con]' where id='$_POST[id]'";
	$re=$db->query($sql);
	if($re)
		msg("comments_list.php");
}
?>
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form method="post" action="comments.php">
<div class="bigbox">
	<div class="bigboxbody">
	<table width="100%" cellspacing="0" cellpadding="0" align="center">
	 <?php
	 if(empty($_GET["sub"])&&empty($_GET["name"]))
	 {
	 ?>
	 <tr > 
		  <td width="22%" height="24" align="right" class="hh"><?php echo lang_show('companytype');?></td>
	      <td width="16%" class="hh">
		    <select name="company_type" id="company_type">
				<?php
				include_once("../lang/" . $config['language'] . "/company_type_config.php");
				foreach($companyType as $v)
				{
				?>
			  	<option value="<?php echo $v?>" <?php if(!empty($_GET['ctype'])&&$v==$_GET['ctype']) echo "selected"; ?>><?php echo $v?></option>
				<?php
				}
				?>
			</select>
		  </td>
	      <td width="62%" class="hh STYLE1"><?php echo lang_show('typemsg');?></td>
	  </tr>
	  <?php } ?>
	  <tr >
	    <td height="24" align="right" class="hh"><?php echo lang_show('markoption');?></td>
	    <td class="hh">
		<input name="name" type="text" id="name" value="<?php echo empty($_GET["name"])?NULL:urldecode($_GET["name"])?>"></td>
	    <td class="hh STYLE1"><?php echo lang_show('optionname');?></td>
	  </tr>
	  <tr >
	    <td height="24" align="right" class="hh"><?php echo lang_show('optionnote');?></td>
	    <td class="hh"><input name="con" type="text" id="con" value="<?php echo urldecode(!empty($_GET["con"])?$_GET["con"]:NULL)?>"></td>
	    <td class="hh STYLE1"><?php echo lang_show('optionnote');?></td
	    ></tr>
	  <tr >
	    <td height="76" class="hh">&nbsp;</td>
        <td valign="top" class="hh"><input name="" class="btn" type="submit" value="<?php echo lang_show('subm');?>">
          <a href="#" class="lbAction" rel="deactivate"><button><?php echo lang_show('cancel');?></button></a>	
          <input name="id" type="hidden" id="id" value="<?php echo !empty($_GET["id"])?$_GET["id"]:NULL?>">
          <input name="edit" type="hidden" id="edit" value="<?php echo !empty($_GET["edit"])?$_GET["edit"]:NULL?>">
          </td>
	    <td class="hh">&nbsp;</td>
	  </tr>
	</table>
</div>
</div>
</form> 
</body>
</HTML>