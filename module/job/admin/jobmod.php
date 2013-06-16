<?php
if(isset($_POST["action"]))
{
		if(!isset($_POST["statu"]))
			$_POST["statu"]=1;
	  	$sql="UPDATE ".ZP." SET 
			title='$_POST[name]',con='$_POST[con]',
			catid='$_POST[catid]',money='$_POST[money]',num='$_POST[num]',
			statu='$_POST[statu]',valid='$_POST[valid]'
		WHERE id='$_POST[editID]'";
	   $re=$db->query($sql);
	   if($re)
	   	msg("module.php?m=job&s=mg_job_list.php");
}
//===================
include_once("../module/job/lang/".$config['language']."/lang_hr_config.php");
$db->query("select * from ".ZP." where id='$_GET[id]'");
$de=$db->fetchRow();
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/Validator.js"></script>
</HEAD>
<body>

<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('mod_recruitment_info');?></div>
	<div class="bigboxbody">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
      <td>
          <table width="100%"  border="0" cellspacing="0" cellpadding="5" align="center" class="admin_table">
	 <form method="post" action="" enctype="multipart/form-data" onSubmit="return Validator.Validate(this,3)">
	 <tr>
	  <td width="11%" align="left"><?php echo lang_show('post_name');?></td>
	  <td width="89%">
	  <input name="name" type="text" id="name" style="width:300px;" value="<?php echo $de["title"]; ?>" dataType="Require" msg="<?php echo lang_show('post_is_request');?>"/></td>
	</tr>
	 <tr>
	   <td align="left"><?php echo lang_show('job_type');?></td>
	   <td>
	     <select name="catid" id="catid" style="width:300px;" msg="<?php echo lang_show('please_select_job_type');?>">
		 	<option value=""><?php echo lang_show('please_select_job_type');?></option>
	       <?php 
		   $sqlhr="select * from ".HRCAT;
			$db->query($sqlhr);
			$re=$db->getRows();
		   foreach($re as $key=>$v){ 
			   ?>
		   <option value="<?php echo $key?>" <?php if($de["catid"]==$key&&$de["catid"]!=""){?>selected="selected"<?php }?> ><?php echo $v['catname']; ?></option>
		   <?php } ?>
	     </select></td>
	   </tr>
	   <tr>
	   <td align="left"><?php echo lang_show('salary');?></td>
	   <td>
	   <select name="money" id="money" style="width:300px;" msg="<?php echo lang_show('please_select_salary_range');?>">
	   	 <option value=""><?php echo lang_show('please_select_salary_range');?></option>
		   <?php for($i=1;$i<count($hrmoney);$i++){?>
		   <option value="<?php echo $i?>" <?php if($de["money"]==$i){?>selected="selected"<?php }?> >
		   <?php echo $hrmoney[$i]; ?>
		   </option>
		   <?php }?>
	   </select>	   </td>
	   </tr>
	 <tr>
	   <td align="left"><?php echo lang_show('need_person');?></td>
	   <td>
	   <input value="<?php echo $de["num"]; ?>" name="num" type="text" id="num" style="width:300px;" datatype="Require" msg="<?php echo lang_show('post_is_request');?>"/></td>
	   </tr>
       
       	 <tr>
	   <td align="left"><?php echo lang_show('valid');?></td>
	   <td>
	   <input value="<?php echo $de["valid"]; ?>" name="valid" type="text" id="valid" style="width:300px;"/></td>
	   </tr>
	 <tr>
	<tr>
	  <td width="11%" align="left"><?php echo lang_show('detail');?></td>
	  <td width="89%">
			<?php
				$BasePath = "../lib/fckeditor/";
				include($BasePath."fckeditor.php");	
				$fck_en = new FCKeditor('con') ;
				$fck_en->BasePath    = $BasePath ;
				$fck_en->ToolbarSet  = 'Basic' ;
				$fck_en->Width='100%';
				$fck_en->Height=500;
				$fck_en->Config['ToolbarStartExpanded'] = true;
				$fck_en->Value = stripslashes($de["con"]);
				echo $con = $fck_en->CreateHtml();
			?>		</td>
	</tr>
	<tr bgcolor="#EAEFF3">
	  <td><?php echo lang_show('statu');?></td>
	  <td>
      <select name="statu">
      <option value="0"><?php echo lang_show('off');?></option>
      <option value="1" <?php if($de["statu"]==1) echo "selected";?>><?php echo lang_show('on');?></option>
      <option value="2" <?php if($de["statu"]==2) echo "selected";?>><?php echo lang_show('rc');?></option>
      </select>
      </td>
	  </tr>
	<tr bgcolor="#EAEFF3">
	  <td>&nbsp;</td>
	  <td>
	  <input name="Submit" class="btn" type="submit" id="Submit" value=" <?php echo lang_show('edit');?> " />
	  <input name="action" type="hidden" id="submit" value="submit" />
	  <input name="editID" type="hidden" id="editID" value="<?php echo $_GET["id"]; ?>" /></td>
	</tr>
	</form>  
</table>
        </td>
    </tr>
  </table>
</div>
</div>

</body>
</html>
