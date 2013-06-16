<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=================
if(empty($_GET['cat_type']))
	$_GET['cat_type']=NULL;

if(!empty($_POST['senddata']) && $_POST['senddata']!=""){
	if(empty($_POST['fieldname'])){
		echo "<script>alert('".lang_show('alert_field_name')."');history.back();</script>";exit();
	}else{
		$fieldname=$_POST['fieldname'];
	}
	if(empty($_POST["PidValue"]))
	{
		$tsql = "select id from ".EXTENDFILE." where catName='".$fieldname."'";
		$db->query($tsql);
		$re = $db->fetchRow();
		if($re['id']>0){
			echo "<div style=\"text-align:center; color:#F00;\">".lang_show('alert_chongfu')."<br>
			<a href='pro_info_add_field.php?cat_type=afield'>".lang_show('alert_fanhui')."</a></div>";
			exit();
		}
	}
	
	$posttemp=substr($fieldname,0,1);
	if(is_numeric($posttemp)){
		echo "<script>alert('".lang_show('alert_no_num')."');history.back();</script>";
		exit();
	}
	if(empty($_POST["fieldinfo"])){
		echo "<script>alert('".lang_show('alert_field_display')."');history.back();</script>";exit();
	}else{
		$fielddisplay=$_POST["fieldinfo"];
	}
	if($_POST['displayType']==0){
		echo "<script>alert('".lang_show('alert_select_display_type')."');history.back();</script>";exit();
	}else{
		$fielddisplaytype = $_POST['displayType'];
	}
	$fieldisneed = $_POST['radio'];
	$fielddefaultvalue=$_POST['defaultvalue'];
	$fieldpro=$_POST['fieldpro'];
	if($fieldpro==0){
		echo "<script>alert('".lang_show('alert_field_type')."');history.back();</script>";exit();
	}
	$fieldlen=$_POST['fieldlen'];
	if(!is_numeric($fieldlen)&& $fieldlen!=""){
		echo "<script>alert('".lang_show('alert_input_num')."');history.back();</script>";
		exit();
	}
	$inputitem = "";
	if(!empty($_POST['inputselectvalue'])){
		if($_POST['inputselectvalue']=="")
			echo "<script>alert('".lang_show('alert_selectitem')."');history.back();</script>";
		else
			$inputitem=$_POST['inputselectvalue'];		
	}
	
	$fieldistop = $_POST['isdisplay'];
	if(empty($_POST["PidValue"])){
	$sql = "insert into ".EXTENDFILE." (catName,catInfo,IsNeed,defaultValue,fieldPro,fieldLen,IsDisplay,displayType,catItem) values";
	$sql.=" ('".$fieldname."','".$fielddisplay."','".$fieldisneed."','".$fielddefaultvalue."','".$fieldpro."','".$fieldlen."','".$fieldistop."','".$fielddisplaytype."','".$inputitem."')";
	}else{
		$sql = "update ".EXTENDFILE." set catName='".$fieldname."',catInfo='".$fielddisplay."',IsNeed='".$fieldisneed."',defaultValue='".$fielddefaultvalue."',fieldPro='".$fieldpro."',fieldLen='".$fieldlen."',IsDisplay='".$fieldistop."',displayType='".$fielddisplaytype."',catItem='".$inputitem."' where id=".$_POST["PidValue"];
	}
	if($db->query($sql))
		msg('pro_info_edit_field.php?cat_type=efield');
	
}

if(!empty($_GET['id']))
{
	$sql="select * from ".EXTENDFILE." where id='$_GET[id]'";
	$db->query($sql);
	$de_cat=$db->fetchRow();
}
else
	$de_cat=NULL;
if(empty($_GET))
	$_GET=NULL;
?>
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />

</head>
<body onLoad="document.getElementById('fieldname').focus();">
<div class="bigbox">
	<div class="bigboxhead tab" style="width:90%">
    <span class="cbox <?php if(empty($_GET['cat_type']) || $_GET['cat_type']=='afield') echo 'on';?>"><a href="pro_info_add_field.php?cat_type=afield"><?php echo lang_show('fcat');?></a></span>
    <span class="cbox <?php if(!empty($_GET['cat_type'])&&$_GET['cat_type']=='efield') echo 'on';?>"><a href="pro_info_edit_field.php?cat_type=efield"><?php echo lang_show('efcat');?></a></span>
    </div>
	<div class="bigboxbody" style="margin-top:-1px;"><form method="post" action="" style="margin-top:0px;">
	<table width="100%" cellspacing="0" cellpadding="0" id="addfield" align="center">
	  <tr>
	    <td height="24" align="right">
		<?php echo lang_show('field_display_name');?></td>
	    <td>
		<input name="fieldname" type="text" id="fieldname" value="<?php if(!empty($de_cat["catName"])) echo $de_cat['catName'];?>" ></td>
	    <td><?php echo lang_show('beizhu_1');?></td>
	  </tr>
      <tr>
	    <td height="24"  align="right"><?php echo lang_show('field_info_name');?></td>
        <td><input id="fieldinfo" name="fieldinfo" value="<?php if(!empty($de_cat['catInfo'])) echo $de_cat['catInfo'];?>" type="text"></td>
	    <td>&nbsp;</td>
	  </tr>
      	  <tr>
      	    <td height="24" align="right"><?php echo lang_show('field_display_type');?></td>
      	    <td ><select name="displayType" id="displayType" onChange="InDefaultValue(this.value,'<?php echo lang_show('fieldselectvalue'); ?>','<?php echo lang_show('fieldeg');?>','<?php echo lang_show('egstr');?>');">
            <option value="0"><?php echo lang_show('field_display_type_1');?></option>
              <?php
			  $tempDisplay=lang_show('displayType');
              foreach($tempDisplay as $dt=>$values){
						if($dt==$de_cat['displayType'])
							echo "<option value=".$dt." selected=selected >".$values."</option>";
						else
							echo "<option value=".$dt." >".$values."</option>";
			}
			   ?>
            </select></td>
      	    <td>&nbsp;</td>
   	    </tr>
      	  <tr id="adddefault">
      	    <td height="24" align="right"><?php echo lang_show('field_is_needfill');?></td>
      	    <td>            
		<?php
		$de_IsNeed=$de_IsNeed1=NULL;
		if($de_cat['IsNeed']!=""){
			if($de_cat['IsNeed']=="1"){
				$de_IsNeed="checked";
			}else{
				$de_IsNeed1="checked";
			}
		}else{
			$de_IsNeed="checked";
		}
		?>
            <input name="radio" type="radio" id="Isneed" style="width: 20px;" value="1" <?php echo $de_IsNeed;?>><?php echo lang_show('yes');?>
   	        <input type="radio" name="radio" id="Isneed2" style="width: 20px;" value="0" <?php echo $de_IsNeed1;?>><?php echo lang_show('no');?></td>
      	    <td>&nbsp;</td>
   	    </tr>
      	  <tr>
      	    <td height="24" align="right"><?php echo lang_show('field_default_value');?></td>
      	    <td><input type="text" name="defaultvalue" value="<?php if(!empty($de_cat['defaultValue'])) echo $de_cat['defaultValue'];?>" id="defaultvalue"></td>
      	    <td id="selectdisplay">&nbsp;</td>
   	    </tr>
      	  <tr>
	    <td height="24" align="right"><?php echo lang_show('field_pro_');?></td>
        <td >
        <select name="fieldpro" id="fieldpro">
        <option value="0">
			  <?php echo lang_show('field_pro_1');?></option>
              <?php
              	$tempPro=lang_show('fieldpro');
				foreach($tempPro as $pr=>$values){
					if($pr==$de_cat['fieldPro']){
						echo "<option value=\"".$pr."\" selected=selected >".$values."</option>";
					}else{
						echo "<option value=\"".$pr."\" >".$values."</option>";
					}
				}
			  ?>
        </select>
		</td>
	    <td>&nbsp;</td>
	  </tr>
      <tr>
        <td height="24" align="right"><?php echo lang_show('field_len');?></td>
        <td colspan="2"><input type="text" name="fieldlen" value="<?php if(!empty($de_cat['fieldLen'])) echo $de_cat['fieldLen'];?>"  id="fieldlen"></td>
      </tr>
      <tr>
        <td height="24"  align="right"><?php echo lang_show('field_is_webdisplay');?></td>
        <td colspan="2">
		<?php
		$de_checked1=NULL;
		if($de_cat['IsDisplay']!=""){
			if($de_cat['IsDisplay']=="1"){
				$de_checked="checked";
			}else{
				$de_checked1="checked";
			}
		}else{
			$de_checked="checked";
		}
		?>
        <input name="isdisplay" type="radio" id="isdisplay" style="width: 20px;" value="1" <?php echo $de_checked;?>><?php echo lang_show('yes');?>
        <input type="radio" name="isdisplay" id="isdisplay2" style="width: 20px;" value="0" <?php echo $de_checked1;?>><?php echo lang_show('no');?></td>
      </tr>
	  <tr>
	    <td height="24">&nbsp;</td>
        <td><input style="width:80px;" name="senddata" id="senddata" class="btn" type="submit" value="<?php echo lang_show('subm');?>">
          <input type="hidden" name="PidValue" id="PidValue" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>"></td>
	    <td>&nbsp;</td>
	  </tr>
	</table>
	</form>
</div>
</div>
<script language="javascript">
<?php 
if(!empty($_GET['id']))
{
?>
InDefaultValue('<?php echo $de_cat['displayType'];?>','<?php echo lang_show('fieldselectvalue'); ?>','<?php echo lang_show('fieldeg');?>','<?php echo lang_show('egstr');?>');
<?php
}
?>
//由lineid得到行号
function getlineNum(lineid)
{
	var j=0;
	for(i=0;i<addfield.rows.length;i++)
	{
			if(addfield.rows[i].id==lineid)
			{
				return j;
			}
			j++;
	}
	return -1;
}
//删除行
function delline(lineid)
{
	for(var i=addfield.rows.length-1;i>=0;i--)
	{
			if(addfield.rows[i].id.indexOf(lineid)!=-1)
			{
				addfield.deleteRow(i);
				break;
			}
	}
}
//values:选项值,info：生成行的数明文字
function InDefaultValue(values,info,display,egstr){
	var trobj = document.getElementById("selectdisplay");	
	if(values<=2){
		delline("InsertInto");
		trobj.innerHTML="";
	}else{
		if(getlineNum("InsertIntotemp")=="-1"){
			addListener();
			var tempob = new Object();
			tempob.catInfo=info+"：";
			tempob.catName="temp";
			tempob.infos = display;
			tempob.value = '<?php echo $de_cat['catItem'];?>';
			var innum = getlineNum("adddefault");
			InsertRows("addfield",tempob,innum,null,"InsertInto");
			trobj.innerHTML=egstr;
		}
	}
}

//allsearchhead:Table名称,data：数据,addtype：在第几行插入新行,pro:属性,rowsnamepre:行Id前缀
function InsertRows(allsearchhead,data,addtype,pro,rowsnamepre){
	var newrows = document.getElementById("addfield").insertRow(addtype);
	newrows.id=rowsnamepre+""+data.catName;
	var cells = newrows.cells;
	for(var i=0;i<3;i++){
			var newcell = newrows.insertCell(cells.length);
			switch(i){
				case 0:
					newcell.height="24px";// 
					newcell.style.cssText="text-align:right;";
					newcell.innerHTML=data.catInfo;
				break;
				case 1:
					var tts = "<input type=\"text\" name=\"inputselectvalue\" id=\"inputselectvalue\" value=\""+data.value+"\" >";
						newcell.innerHTML=tts;
				break;
				case 2:
					newcell.innerHTML=data.infos+"<font color=#ff0000> Знаки "," и "|" для раделения</font>";
				break;
			}
		}
}
function addListener(){
	var oodi = document.getElementById("senddata");
	if (window.attachEvent)
	{							 //IE 的事件代
		oodi.attachEvent("onclick",function(){if(document.getElementById("inputselectvalue").value==""){alert("Укажите вариант!");return false}return true;}); 
	}
	else
	{
											 //其它浏览器的事件代码
		oodi.addEventListener("click",function(){if(document.getElementById("inputselectvalue").value==""){alert("Укажите вариант!");return false}return true;},false);
	}
} 
</script>
</body>
</HTML>