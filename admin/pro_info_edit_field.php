<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
include_once("../includes/page_utf_class.php");
header('Content-Type: text/html; charset=utf-8');
//=================
if(!empty($_POST['submit']) && $_POST['submit']!=""){
	if(is_array($_POST["de"]))
	{
		$id=implode(",",$_POST["de"]);
		$sql="delete from ".EXTENDFILE." where id in ($id)";
		$db->query($sql);
		echo "<script>alert('".lang_show('edit_s')."');</script>";
	}	
}
//=================
?>
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="bigbox">

	<div class="bigboxhead">
    <span class="cbox <?php if(empty($_GET['cat_type']) || $_GET['cat_type']=='afield') echo 'on';?>"><a href="pro_info_add_field.php?cat_type=afield"><?php echo lang_show('fcat');?></a></span>
    <span class="cbox <?php if(!empty($_GET['cat_type'])&&$_GET['cat_type']=='efield') echo 'on';?>"><a href="pro_info_edit_field.php?cat_type=efield"><?php echo lang_show('efcat');?></a></span>
    </div>
	<div class="bigboxbody" style="margin-top:-1px;">
    <form method="post" action="" style="margin-top:0px;">
	<script language="javascript">

function do_select()
{
	 var box_l = document.getElementsByName("de[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("de[]")[j].checked==true)
	  	  document.getElementsByName("de[]")[j].checked = false;
		else
		  document.getElementsByName("de[]")[j].checked = true;
	 }
}
function CheckIsSelect(){
	var event = document.getElementsByName("de[]");
	for(var j=0; j<event.length; j++){
        if(event[j].checked){// && event[j].disabled
			return true;
        }
	}
	return false;
}
</script>
  <table width="100%" border="0" align="left" cellpadding="2" cellspacing="0" >
    <tr > 
      <td width="70" height="20" ><input onClick="do_select()" style="width:20px;" name="" type="checkbox"></td>
      <td width="159" ><?php echo lang_show('field_edit_display_name');?></td>
      <td width="127" ><?php echo lang_show('field_edit_pro_');?></td>
      <td width="129" ><?php echo lang_show('field_edit_product_name');?></td>
      <td width="111" align="center" ><?php echo lang_show('field_edit_info_name');?></td>
      <td width="224" align="center" ><?php echo lang_show('field_edit_display_type');?></td>
	  <td width="85" align="center" ><?php echo lang_show('field_edit_para');?></td>
    </tr>
    <?php
	$tsql="select id,catName,catInfo,defaultValue,fieldPro,displayType from ".EXTENDFILE;
		//=============================
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$db->query($tsql);
			$page->totalRows = $db->num_rows();
		}
        $tsql .= "  limit ".$page->firstRow.",20";
		$pages = $page->prompt();
	//=====================
		$db->query($tsql);
		$re=$db->getRows();
		foreach($re as $va)
		{
	?> 
    <tr bgcolor="#eeeeee"> 
      <td width="70"> 
      <input name="de[]" type="checkbox" style="width:20px;" value="<?php echo $va['id']; ?>">		</td>
      <td width="159">
	  <?php echo $va['catName']; ?>      </td>
      <td width="127">
      <?
	  $editTemp = lang_show('fieldpro');
      	echo $editTemp[$va['fieldPro']];
	  ?>      </td>
      <td>
      <?php
      	if($va['defaultValue']!=""){
			echo $va['defaultValue'];
		}else{
			echo "Нет значения по умолчанию";
		}
	  ?></td>
      <td align="center">
	  <?php echo $va['catInfo']; ?>      </td>
      <td width="224" align="center"> 
      <?php
	  $editTempType=lang_show('displayType');
      	echo $editTempType[$va['displayType']];
	  ?> </td>
	  <td  width="85" align="center"><a href="pro_info_add_field.php?id=<?php echo $va['id']; ?>&cat_type=afield"><?php echo lang_show('field_edit_update');?></a></td>    
    </tr>
    <?php 
	}
	?> 
	    <tr bgcolor="#eeeeee">
      <td colspan="4"><input class="btn" type="submit" name="submit" value="<?php echo lang_show('delete')?>" style="width:60px;" onClick="if(CheckIsSelect()){return confirm('<?php echo lang_show('edit_yes')?>');}else{alert('<?php echo lang_show('edit_no')?>');return false;}"></td>
      <td colspan="3" align="center"><div class="page"><?php echo $pages?></div></td>
      </tr>
  </table>
</form>
</div>
    
	
</div>
</div>
</body>
</HTML>