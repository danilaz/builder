<?php
include_once("../includes/tag_inc.php");
//===============================================
if(!isset($_POST['is_rec']))
	$_POST['is_rec']='0';
if(!isset($_POST['statu']))
	$_POST['statu']='0';
$date=date("Y-m-d H:i:s");$pn=NULL;
if(isset($_POST['action'])&&$_POST['action']=="edit")
{
	$_POST['stime']=strtotime($_POST['stime']);
	$_POST['etime']=strtotime($_POST['etime']);
	if(is_uploaded_file($_FILES['pic']['tmp_name']))
	{
		$pn=time();
		$save_directory = $config['webroot']."/uploadfile/exhibitimg/".$pn.".jpg";
		makethumb($_FILES['pic']['tmp_name'],$save_directory,200,200);
	}
	else
	{
		if(!empty($_POST['nopic'])&&$_POST['nopic']=='1')
			@unlink($config['webroot']."/uploadfile/exhibitimg/".$_POST['oldpic'].".jpg");
		else
			$pn=$_POST['oldpic'];
	}
	$sql="update ".EXHIBIT." SET
	stime='$_POST[stime]',etime='$_POST[etime]',city='$_POST[city]',addr='$_POST[addr]',
	statu='$_POST[statu]',title='$_POST[title]',is_rec='$_POST[is_rec]',country='$_POST[country]',con='$_POST[con]',
	cat='$_POST[cat]',organizers='$_POST[organizers]',contractors='$_POST[contractors]',contact='$_POST[contact]',tel='$_POST[tel]',showroom='$_POST[showroom]',pic='$pn'
	WHERE id='$_POST[id]'";
	$re=$db->query($sql);
	edit_tags($_POST['tag'],4,$_POST['id']);
	if($re)
	{
		unset($_GET['id']);unset($_GET['s']);
		$getstr=implode('&',convert($_GET));
		admin_msg("module.php?m=exhibition&s=exhibitlist.php&$getstr",'Успешно выполнено!');
	}
}
//=================================================
if(!empty($_POST['action'])&&$_POST['action']=="submit")
{
	$_POST['stime']=strtotime($_POST['stime']);
	$_POST['etime']=strtotime($_POST['etime']);
	if(is_uploaded_file($_FILES['pic']['tmp_name']))
	{
		$pn=time();
		$save_directory = $config['webroot']."/uploadfile/exhibitimg/".$pn.".jpg";;
		makethumb($_FILES['pic']['tmp_name'],$save_directory,120,120);
	}
	$sql="INSERT ".EXHIBIT." (stime,etime,country,city,addr,statu,title,con,addTime,is_rec,cat,organizers,contractors,contact,tel,showroom,pic)
	VALUES
   ('$_POST[stime]','$_POST[etime]','$_POST[country]','$_POST[city]','$_POST[addr]','$_POST[statu]',
   '$_POST[title]','$_POST[con]','$date','$_POST[is_rec]','$_POST[cat]','$_POST[organizers]','$_POST[contractors]','$_POST[contact]','$_POST[tel]','$_POST[showroom]','$pn')";
	$re=$db->query($sql);
	$id=$db->lastid();
	add_tags($_POST['tag'],4,$id);
	if($re)
		admin_msg("module.php?m=exhibition&s=exhibitlist.php",'Успешно выполнено!');
}
if(isset($_GET['id']))
{
	$sql="select * from ".EXHIBIT." where id='$_GET[id]'";
	$db->query($sql);
	$de=$db->fetchRow();
	$de['tag']=get_tags($_GET['id'],4);
	if($de['statu'])
		$s1="checked";
	if($de['is_rec'])
		$s2="checked";
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src="../script/Calendar.js"></script>
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('news_post');?></div>
	<div class="bigboxbody">
    <form method="post" action="" enctype="multipart/form-data">
    <table width="100%" border="0"  cellpadding="4" cellspacing="0">
	    <tr>
          <td height="22" ><?php echo lang_show('state');?></td>
	      <td height="22" colspan="3">
		   <select name="country" id="country">
		  	<?php
			$sql="select * from ".COUNTRY." where 1 order by nums asc,ename asc";
			$db->query($sql);
			$country=$db->getRows();
			foreach($country as $v)
			{
			?>
		   <option value="<?php echo $v['ename'];?>" <?php if(isset($de['country'])&&$de['country']==$v['ename']) echo "selected";?>><?php echo $v['ename'];?> </option>
		  <?php
			}
			?>
            </select>			</td>
        </tr>
        <tr>
				<?php
				$sql="select * from ".SHOWROOM;
				$db->query($sql);
				$ex=$db->getRows();
				?>
                  <td ><?php echo lang_show('exroom');?></td>
			      <td colspan="3">
				  <select name="showroom" id="showroom">
				  <option value=""><?php echo lang_show('noexroom');?></option>
				  <?php
				  foreach($ex as $v)
				  {
				  ?>
			        <option value="<?php echo $v['show_room_name'];?>"<?php if(isset($de['showroom'])&&$de['showroom']==$v['show_room_name']) echo 'selected';?>><?php echo $v['show_room_name'];?></option>
					<?php
				  }
					?>
			        </select>
                    <a href="module.php?m=exhibition&s=edit_show_room.php"><?php echo lang_show('addroom');?></a>					</td>
        </tr>
		            <tr> 
            <td width="10%" height="22" > <?php echo lang_show('show_title');?></td>
            <td height="22" colspan="3"><input name="title" type="text" value="<?php if(isset($de['title'])){echo $de['title'];}?>" size="61" maxlength="100"></td>
          </tr>
        <tr> 
		          <tr>
            <td > <?php echo lang_show('tag_con');?></td>
            <td colspan="3">
            <input name="tag" type="text" id="tag" value="<?php if(isset($de['tag'])){echo $de['tag'];}?>" size="61" maxlength="40"></td>
          </tr>
		  <tr> 
	      <td width="10%" height="22" > <?php echo lang_show('show_time');?></td>
          <td height="22" colspan="3">
			<script language="javascript">
			var cdr = new Calendar("cdr");
			document.write(cdr);
			cdr.showMoreDay = true;
			</script>
		  <input readonly name="stime" type="text" id="stime" size="22" value="<?php if(isset($de['stime'])){echo date("Y-m-d",$de['stime']);}?>" onFocus="cdr.show(this);">
          <input readonly onFocus="cdr.show(this);" name="etime" type="text" id="etime" size="22" value="<?php if(isset($de['etime'])){echo date("Y-m-d",$de['etime']);}?>"></td>
        </tr>
	      <tr><td width="10%" height="22" > <?php echo lang_show('city');?></td>
          <td width="31%" height="22"><input name="city" type="text" id="city" value="<?php if(isset($de['city'])){echo $de['city'];}?>" size="40" maxlength="40"></td>
          <td width="7%" align="right"><?php echo lang_show('address');?></td>
          <td width="52%" height="22"><input name="addr" type="text" id="addr" value="<?php if(isset($de['addr'])){echo $de['addr'];}?>" size="40"></td>
        </tr>
			    <tr> 
	      <td width="10%" height="22" ><?php echo lang_show('org');?></td>
          <td width="31%" height="22"><input name="organizers" type="text" id="organizers" size="40" maxlength="100" value="<?php if(isset($de['organizers'])){echo $de['organizers'];}?>"></td>
          <td width="7%" height="22" align="right"><?php echo lang_show('cnor');?></td>
          <td width="52%"><input name="contractors" type="text" id="contractors" size="40" maxlength="100" value="<?php if(isset($de['contractors'])){echo $de['contractors'];}?>"></td>
	    </tr>



			    <tr>
                  <td ><?php echo lang_show('contact');?></td>
			      <td><input name="contact" type="text" id="contact" size="40" maxlength="50" value="<?php if(isset($de['contact'])){echo $de['contact'];}?>"></td>
                  <td align="right"><?php echo lang_show('tel');?></td>
                  <td><input name="tel" type="text" id="tel" size="40" maxlength="20" value="<?php if(isset($de['tel'])){echo $de['tel'];}?>"></td>
	    </tr>
          	<tr>
			  <td ><?php echo lang_show('excat');?></td>
			  <td colspan="3">
			  <textarea style="width:100%" name="cat" rows="2"><?php if(isset($de['cat'])){echo $de['cat'];}?></textarea>			  </td>
        	</tr>
          <tr> 

            <td width="10%" ><?php echo lang_show('show_content');?></td>

            <td colspan="3"> 
			<?php
			if(!isset($de['con']))
				$de['con']=NULL;
			$BasePath = "../lib/fckeditor/";
			include($BasePath."fckeditor.php");	
			$fck_en = new FCKeditor('con') ;
			$fck_en->BasePath    = $BasePath ;
			$fck_en->ToolbarSet  = 'Default' ;
			if($config['language']=='cn')
				$fck_en->Config['DefaultLanguage']='zh-cn';
			else
				$fck_en->Config['DefaultLanguage']='en';
			$fck_en->Width='100%';
			$fck_en->Height=500;
			$fck_en->Config['ToolbarStartExpanded'] = true;
			$fck_en->Value = stripslashes($de['con']);
			$con = $fck_en->CreateHtml();
			echo $con;
			?>			</td>
          </tr>
		   <tr>
                  <td ><?php echo lang_show('expic');?></td>
			      <td colspan="3">
				  <?php 
				  if(!empty($de['pic']))
				  {
				  echo '<img src="../uploadfile/exhibitimg/'.$de['pic'].'.jpg"  height="60"><input type="hidden" name="oldpic" id="oldpic" value="'. $de['pic'].'">';
				  echo'<br><input type="checkbox" name="nopic" id="nopic" value="1">'.lang_show('delpic');
				  }
				  ?>
				  <br/>
				  <input name="pic" type="file" id="pic" size="45">				  </td>
        </tr>
		  	   <tr>
                  <td height="22" > <?php echo lang_show('is_post');?></td>
			      <td height="22" colspan="3"><input name="statu" type="checkbox" id="statu" value="1" <?php if (isset($s1)) echo $s1;?>></td>
        </tr>
		<tr>
                  <td height="22" > <?php echo lang_show('is_support');?></td>
			      <td height="22" colspan="3"><input name="is_rec" type="checkbox" id="is_rec" value="1" <?php if (isset($s2)) echo $s2;?>></td>
        </tr>
          <tr> 

            <td width="10%">&nbsp;</td>

            <td colspan="3"> 

              <input class="btn" type="submit" name="cc" value="<?php echo lang_show('submit');?>">
              <input name="action" type="hidden" id="action" value="<?php if(isset($_GET['id'])) echo "edit";else echo "submit"; ?>">
            <input name="id" type="hidden" id="id" value="<?php if (isset($de['id'])) echo $de['id'];?>"></td>
          </tr>
      </table>
      </form>  
    </div>
</div> 

</body>
</html>