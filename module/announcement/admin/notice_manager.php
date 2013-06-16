<?php
//===============================================
if (!empty($_POST['isure'])&&$_POST['isure']==lang_show('notice_mod')&&!empty($_POST['modid']))
{
	$_POST['title']=htmlspecialchars($_POST['title']);
	$sql="update ".NOTICE." set title='".$_POST['title']."',type=".$_POST['ntype'].",starttime='".strtotime($_POST['starttime'])."',endtime='".strtotime($_POST['endtime'])."',content='".$_POST['cont']."' where id=".$_POST['modid'];
	$db->query($sql);
	msg("module.php?m=announcement&s=notice.php");
}
//=================================================
if (!empty($_POST['isure'])&&$_POST['isure']==lang_show('add_notice')&&empty($_POST['modid']))
{
	$_POST['title']=htmlspecialchars($_POST['title']);
	$sql="insert into  ".NOTICE." (`title`,`sort`,`type`,`starttime`,`endtime`,`author`,`content`) values ('".$_POST['title']."',0,'".$_POST['ntype']."','".strtotime($_POST['starttime'])."','".strtotime($_POST['endtime'])."','".$_SESSION["ADMIN_USER"]."','".$_POST['cont']."')";
	$db->query($sql);
	msg("module.php?m=announcement&s=notice.php");
}
//=================================================
if(isset($_GET['id'])&&!empty($_GET['action'])&&$_GET['action']=="del")
{
	$sql="delete from ".NOTICE." where id='$_GET[id]'";
	$db->query($sql);
	msg("module.php?m=announcement&s=notice.php");
}
if(!empty($_GET['id'])&&!empty($_GET['action'])&&$_GET['action']=="modify")
{
	$sql="select * from ".NOTICE." where id=".$_GET['id'];
	$db->query($sql);
	$de=$db->fetchRow();
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/Calendar.js"></script>
</HEAD>
<body>
<script type="text/javascript">
function checkv()
{
	 if (document.tagm.starttime.value==""||document.tagm.endtime.value==""||document.tagm.title.value=="")
		{ 
         alert("no content !"); 
         return false;  
        }  
     else 
		 {return true;} 

}
</script>
<form name="tagm" method="post" action="" enctype="multipart/form-data">
<div class="bigbox">
	<div class="bigboxhead">
	<?php 
	if (isset($_GET['action'])&&$_GET['action']=="modify")
	   $msg=lang_show('notice_mod');
	else
	   $msg=lang_show('add_notice');
	echo $msg;
	?>
	</div>
	<div class="bigboxbody">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    	<tr>
	  <td align="right"><?php echo lang_show('not_type');?></td>
	  <td >
		<input type="radio" name="ntype" id="ntype1" value="1" <?php if (isset($de["type"])&&$de["type"]==1) echo "checked"; ?>>
	   <?php echo lang_show('text_not');?>
	  <input type="radio" name="ntype" id="ntype2" value="2" <?php if (isset($de["type"])&&$de["type"]==2) echo "checked"; ?>>
	   <?php echo lang_show('url_not');?>
	   </td>
        </tr>
	    <tr> 
	      <td width="13%" align="right"><?php echo lang_show('validt');?>  </td>
          <td width="87%" >
			<script language="javascript">
			var cdr = new Calendar("cdr");
			document.write(cdr);
			cdr.showMoreDay = true;
			</script>
			<input readonly="true" name="starttime" type="text" id="starttime" size="28" value="<?php if(isset($de["starttime"])){echo date("Y-m-d",$de["starttime"]);}?>" onFocus="cdr.show(this);">
         --
          <input readonly="true" onFocus="cdr.show(this);" name="endtime" type="text" id="endtime" size="28" value="<?php if(isset($de["endtime"])){echo date("Y-m-d",$de["endtime"]);}?>"></td>
        </tr>
			    <tr> 
	      <td width="13%" align="right"><?php echo lang_show('ntitle');?></td>
          <td width="87%" >
          <input style="width:540px;" name="title" type="text" id="title" value="<?php if(isset($de["title"])){echo $de["title"];}?>"></td>
        </tr>
			    <tr> 
	      <td width="13%" height="126" align="right"><?php echo lang_show('ncon');?></td>
          <td width="87%" height="126">
          <?php
			if(isset($de["content"]))
			{
				$BasePath = "../lib/fckeditor/";
				include($BasePath."fckeditor.php");	
				$fck_en = new FCKeditor('cont') ;
				if($config['language']=='cn')
					$fck_en->Config['DefaultLanguage']='zh-cn';
				else
					$fck_en->Config['DefaultLanguage']='en';				

				$fck_en->BasePath    = $BasePath ;
				$fck_en->ToolbarSet  = 'Basic' ;
				$fck_en->Width='100%';
				$fck_en->Height=500;
				$fck_en->Config['ToolbarStartExpanded'] = true;
				$fck_en->Value = stripslashes($de["content"]);
				$cons = $fck_en->CreateHtml();
				echo $cons;
			}
			else
			{
			?>
			<script type="text/javascript" src="../lib/fckeditor/fckeditor.js"></script>
			<script type="text/javascript">
			var oFCKeditor = new FCKeditor( 'cont' ) ;
			oFCKeditor.Config['ToolbarStartExpanded'] = true ;
			oFCKeditor.BasePath		= '../lib/fckeditor/' ;
			
			oFCKeditor.ToolbarSet	= 'Basic' ;
			oFCKeditor.Width=540;
			oFCKeditor.Height=500;
			oFCKeditor.Create() ;
			</script>
			<?php } ?>			</td>
          </tr>
          <tr> 

            <td width="13%" align="right">&nbsp;</td>
            <td width="87%"> 
            <input class="btn" type="submit" name="isure" value="<?php echo $msg;?>" onClick="return checkv();"><input type="hidden" name="modid" value="<?php if (isset($de['id'])) echo $de['id'];?>">            </td>
          </tr>
      </table>   
    </div>
</div> 
</form>
</body>
</html>