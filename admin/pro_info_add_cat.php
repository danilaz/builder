<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
include_once('../lib/allchar.php');
//=================
if(!empty($_GET['cat_type']))
{
	if($_GET['cat_type']=='com')
		$_SESSION['cat_type']=COMPANYCAT;
	elseif($_GET['cat_type']=='album')
		$_SESSION['cat_type']=ALBUMCAT;
	elseif($_GET['cat_type']=='prcat')
		$_SESSION['cat_type']=PRCAT;
	else
		$_SESSION['cat_type']=PCAT;
}
$cat_table=empty($_SESSION['cat_type'])?PCAT:$_SESSION['cat_type'];
$pic=empty($_POST['pic'])?NULL:$_POST['pic'];
$isindex=isset($_POST['isindex'])?1:0;
$_POST['isbuy']=isset($_POST['isbuy'])?1:0;

$_POST['brand']=empty($_POST['brand'])?NULL:implode(",",$_POST['brand']);
$_POST['cat_add_field']=empty($_POST['cat_add_field'])?NULL:implode(",",$_POST['cat_add_field']);

if(!empty($_POST["cat"])&&empty($_GET["id"]))
{
	if($_POST["pid"]==0)
	{
		$sql="select max(catid) as catid from $cat_table where catid<9999";
		$db->query($sql);
		$re=$db->fetchRow();
		$id=$re["catid"];
		if(!$id)
			$id=1000;
		else
			$id=substr($id*1000,0,4)+1;
	}
	else
	{
		$s=$_POST["pid"]."00";
		$b=$_POST["pid"]."99";
		$sql="select max(catid) as catid from $cat_table where catid>$s and catid<$b";
		$db->query($sql);
		$re=$db->fetchRow();
		$id=$re["catid"];
		if(!$id)
			$id=$_POST["pid"]."01";
		else
			$id=$id+1;
	}
	foreach(explode("\r\n",$_POST['cat']) as $catv)
	{
		if(!empty($catv)){
		 if(substr($cat_table,-4)=='pcat')	
		$sql="insert into $cat_table (`catid`,`cat`,`nums`,`isindex`,`pic`,`brand`,`cat_add_field`,`isbuy`) values 
			('$id','$catv','0','".$isindex."','$pic','$_POST[brand]','$_POST[cat_add_field]','$_POST[isbuy]')";
		else
		$sql="insert into $cat_table (`catid`,`cat`,`nums`,`isindex`,`pic`,`brand`,`cat_add_field`) values 
			('$id','$catv','0','".$isindex."','$pic','$_POST[brand]','$_POST[cat_add_field]')";
		$db->query($sql);
		$id+=1;
		}
	}
	creat_index();
	echo "<script>alert('Категории успешно добавлены!');window.location='pro_info_add_cat.php?aid=".$_POST["pid"]."';</script>";
}
//=================
if(!empty($_POST["cat"])&&!empty($_GET["id"]))
{	
	if($_POST['pid']!=0)
	{
		if($_POST["pid"]!==substr($_GET['id'],0,strlen($_GET['id'])-2))
		{
			$s=$_POST["pid"]."00";
			$b=$_POST["pid"]."99";
			$sql="select max(catid) as catid from $cat_table where catid>$s and catid<$b";
			$db->query($sql);
			$re=$db->fetchRow();
			$id=$re["catid"];
			if(!$id)
				$id=$_POST["pid"]."01";
			else
				$id=$id+1;
		}
		else
			$id=$_GET['id'];
		
	
		//编辑当前类别信息
		if(substr($cat_table,-4)=='pcat')	
		$sql="update $cat_table set catid='$id', cat='".$_POST['cat']."',isindex='".$isindex."' 
			,pic='$_POST[pic]',brand='$_POST[brand]',cat_add_field='$_POST[cat_add_field]',
			title='$_POST[title]',keyword='$_POST[keyword]',description='$_POST[description]',isbuy='$_POST[isbuy]' where catid='".$_GET['id']."'";
	    else
		$sql="update $cat_table set catid='$id', cat='".$_POST['cat']."',isindex='".$isindex."' 
			,pic='$_POST[pic]',brand='$_POST[brand]',cat_add_field='$_POST[cat_add_field]',
			title='$_POST[title]',keyword='$_POST[keyword]',description='$_POST[description]' where catid='".$_GET['id']."'";
		$re=$db->query($sql);
		//如果当前类别下面带有子类别把子类别一起移过去
		$s=$_GET['id']."00";
		$b=$_GET['id']."99";
		$sql="update $cat_table set catid=replace(catid,$_GET[id],$id) where catid>=$s and catid<=$b";
		$re=$db->query($sql);
		//=========================处理属于他下面的信息，进行移动======================
		if($cat_table==PCAT)
		{
			$sql="update ".PRO." set catid='$id' where catid='".$_GET['id']."'";
			$db->query($sql);
			
			$sql="update ".PRO." set catid=replace(catid,$_GET[id],$id) where catid>=$s and catid<=$b";
			$db->query($sql);
			
			$sql="update ".INFO." set catid='$id' where catid='".$_GET['id']."'";
			$db->query($sql);
			
			$sql="update ".INFO." set catid=replace(catid,$_GET[id],$id) where catid>=$s and catid<=$b";
			$db->query($sql);
		}
		elseif($cat_table==ALBUMCAT)
		{
			$sql="update ".ALBUM." set catid='$id' where catid='".$_GET['id']."'";
			$db->query($sql);
			
			$sql="update ".ALBUM." set catid=replace(catid,$_GET[id],$id) where catid>=$s and catid<=$b";
			$db->query($sql);
		}
		elseif($cat_table==COMPANYCAT)
		{
			$sql="update ".USER." set catid=replace(catid,$_GET[id],$id)";
			$db->query($sql);
		}
	}
	else
	{	
		//当前编辑的类别为一级类别，无需操作ＩＤ号和属于他的信息。
		if(substr($cat_table,-4)=='pcat')	
		$sql="update $cat_table set 
		cat='$_POST[cat]',isindex='$isindex',pic='$_POST[pic]',brand='$_POST[brand]',cat_add_field='$_POST[cat_add_field]',
			title='$_POST[title]',keyword='$_POST[keyword]',description='$_POST[description]',isbuy='$_POST[isbuy]'
			where catid='$_GET[id]'";
		else
		$sql="update $cat_table set 
		cat='$_POST[cat]',isindex='$isindex',pic='$_POST[pic]',brand='$_POST[brand]',cat_add_field='$_POST[cat_add_field]',
			title='$_POST[title]',keyword='$_POST[keyword]',description='$_POST[description]'
			where catid='$_GET[id]'";
		$re=$db->query($sql);
	}
	if($re)
	{	
		creat_index();
		msg("pro_info_cat.php");
	}
}
if(!empty($_GET['id']))
{
	$sql="select * from $cat_table where catid='$_GET[id]'";
	$db->query($sql);
	$de_cat=$db->fetchRow();
}
//=======================================================================
function creat_index()
{
	global $db,$cat_table,$config;
	$sql="select * from $cat_table";
	$db->query($sql);
	$res=$db->getRows();
	foreach($res as $v)
	{

		if(substr($str,0,1)!='\\')
		{
			$str=c(trim($v['cat']));
			$str=addslashes($str);
			$sql="update $cat_table set char_index='".substr($str,0,1)."',all_char='$str' where catid='".$v['catid']."'";
		}
		$db->query($sql);
	}
	for($i=ord("A");$i<=ord("Z");$i++)  
	{
		$c=chr($i);
		$sql="select * from $cat_table where char_index='$c' order by all_char asc";
		$db->query($sql);
		$write_str=$db->getRows();
		$write_str=serialize($write_str);//将数组序列化后生成字符串
		$write_str=str_replace("'","\'",$write_str);
		if($cat_table==PCAT)
			$pre="p";
		elseif($cat_table==OCAT)
			$pre="o";
		elseif($cat_table==COMPANYCAT)
			$pre="c";
		creat_file($c.$pre,$write_str);
	}
}
function creat_file($file,$cats)
{
	$write_cat_con_str='<?php $cats=unserialize(\''.$cats.'\');?>';//生成要写的内容
	$fp=fopen('../config/index_cat/'.$file,'w');
	fwrite($fp,$write_cat_con_str,strlen($write_cat_con_str));//将内容写入文件．
	fclose($fp);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/Calendar.js"></script>
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
weburl='<?php echo $config['weburl'];?>';
</script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript" src="../script/prototype.js"></script>
</head>
<body onLoad="document.getElementById('cat').focus();">
<div class="bigbox">
	<div class="bigboxhead tab" style=" width:90%">
    <span class="cbox <?php if($cat_table==PCAT) echo 'on';?>"><a href="?cat_type=pcat"><?php echo lang_show('pcat');?></a></span>
    <span class="cbox <?php if($cat_table==COMPANYCAT) echo 'on';?>"><a href="?cat_type=com"><?php echo lang_show('ccat');?></a></span>
    <span class="cbox <?php if($cat_table==ALBUMCAT) echo 'on';?>"><a href="?cat_type=album"><?php echo lang_show('acat');?></a></span>
    </div>
	<div class="bigboxbody" style="margin-top:-1px;"><form method="post" action=""  enctype="multipart/form-data"  style="margin-top:0px;">
	<table width="100%" cellspacing="0" cellpadding="0" align="center">
	  <tr> 
		  <td width="25%" height="24" align="right" ><?php echo lang_show('cat_level');?></td>
	      <td width="25%">
		  <select name="pid" >
              <option value="0" style='font-weight:bold; font-size:14px;'><?php echo lang_show('type_level_1');?></option>
				<?php
				if(!empty($_GET["aid"]))
					$slectid=$_GET["aid"];
				else
				{
					if($_GET["id"]>999)
						$slectid=substr($_GET["id"],0,strlen($_GET["id"])-2);
				}
				$db->query("select catid,cat from $cat_table where catid<=9999 order by nums asc");
				$catList=$db->getRows();
				foreach($catList as $v)
				{
					if($v['catid']==$slectid)
						echo "<option style='color:red;font-weight:bold;padding-left:20px;' value=".$v['catid']." selected=selected >|_".$v['cat']."</option>";
					else
						echo "<option style='color:red;font-weight:bold;padding-left:20px;' value=".$v['catid']." >|_".$v['cat']."</option>";
					$s=$v['catid'].'00';
					$b=$v['catid'].'99';
					$sql="select catid,cat from $cat_table where catid<=$b and catid>=$s order by nums asc";
					$db->query($sql);
					$scat=$db->getRows();
					foreach($scat as $sv)
					{
						if($sv['catid']==$slectid)
							echo "<option style='font-weight:bold;padding-left:40px;' value=".$sv['catid']." selected=selected >|____".$sv['cat']."</option>";
						else
							echo "<option style='font-weight:bold;padding-left:40px;' value=".$sv['catid']." >|____".$sv['cat']."</option>";
						$s=$sv['catid'].'00';
						$b=$sv['catid'].'99';
						$sql="select catid,cat from $cat_table where catid<=$b and catid>=$s order by nums asc";
						$db->query($sql);
						$tcat=$db->getRows();
						foreach($tcat as $tv)
						{
							if($tv['catid']==$slectid)
								echo "<option style='padding-left:60px;' value=".$tv['catid']." selected=selected >|________".$tv['cat']."</option>";
							else
								echo "<option style='padding-left:60px;' value=".$tv['catid']." >|________".$tv['cat']."</option>";
						}

					}
				}
				?>
            </select></td>
	      <td width="68%" style="color:#666666"><?php echo lang_show('check_cats');?></td>
	  </tr>
      <?php if(!empty($_GET['id'])){ ?>
      	  <tr>
	    <td height="24" align="right"><?php echo lang_show('pro_type_name');?></td>
	    <td>
          <input style="width:300px;" name="cat" type="text" value="<?php if(!empty($de_cat["cat"])) echo $de_cat['cat'];?>">          </td>
	    <td style="color:#666666"><?php echo lang_show('pro_type_name');?></td>
	  </tr>
	  
	    <tr>
          <td align="right">Логотип</td>
          <td><input id="pic" type="text" name="pic" style="width:300px;" value="<?php echo isset($de_cat['pic'])?$de_cat['pic']:NULL;?>">
		  </td>
		   <td>
		 [<a href="javascript:uploadfile('Загрузка логотипа','pic',22,22)">Загрузить</a>] 
		 [<a href="javascript:preview('pic');">Предпросмотр</a>]
		 [<a onclick="javascript:$('pic').value='';" href="#">Удалить</a>]</td>
        </tr>
     <?php } else{?> 
     	  <tr>
	    <td height="24" align="right"><?php echo lang_show('pro_type_name');?></td>
	    <td>
		  <textarea style="width:300px; height:200px;" name="cat" id="cat"><?php if(!empty($de_cat["cat"])) echo $de_cat['cat'];?></textarea> </td>
	    <td style="color:#666666"><?php echo lang_show('pro_type_des');?></td>
	  </tr>
      <?php } ?>
      	  <tr>
      	    <td height="24" align="right">Title</td>
      	    <td><textarea style="width:300px; height:50px;" name="title" id="title"><?php echo $de_cat['title'];?></textarea></td>
      	    <td style="color:#666666">&nbsp;</td>
   	    </tr>
      	  <tr>
      	    <td height="24" align="right" >Keyword</td>
      	    <td><textarea  style="width:300px; height:50px;" name="keyword" id="keyword"><?php echo $de_cat['keyword'];?></textarea></td>
      	    <td style="color:#666666">&nbsp;</td>
   	    </tr>
      	  <tr>
      	    <td height="24" align="right" >Description</td>
      	    <td><textarea  style="width:300px; height:50px;" name="description" id="description"><?php echo $de_cat['description'];?></textarea></td>
      	    <td style="color:#666666">&nbsp;</td>
   	    </tr>
      	  <tr>
	    <td height="24" align="right"><?php echo lang_show('indexsh');?></td>
        <td>
		<input style="width:20px;" <?php if(!isset($_GET["home"])){?>checked="checked"<?php } ?> <?php if(!empty($_GET["home"])){?>checked="checked"<?php } ?> name="isindex" type="checkbox" id="isindex" value="1"></td>
	    <td style="color:#666666"><?php echo lang_show('checkisshow');?></td>
	  </tr>
      <?php
	  if($cat_table==PCAT){
	  ?> <tr>
	    <td height="24" align="right"><?php echo lang_show('cat_add_field');?></td>
        <td colspan="2">
        <?php
		  if(!empty($de_cat['cat_add_field']))
		  	$cat_add_field=explode(",",$de_cat['cat_add_field']);
		  else
		  	$cat_add_field=array();
		  $sql="select id,catInfo from ".EXTENDFILE;
		  $db->query($sql);
		  $re=$db->getRows();
		  foreach($re as $v)
		  {
		?>
          <label><input <?php if(in_array($v['id'],$cat_add_field)) echo 'checked';?> style="width:20px;" name="cat_add_field[]" type="checkbox" value="<?php echo $v['id'];?>"><?php echo $v['catInfo'];?></label>
         <?php 
		  } 
		 ?> 
		</td>
	  </tr>
       <tr>
        <td height="24" align="right"><?php echo lang_show('isbuy');?></td>
        <td><input type="checkbox" name="isbuy" value="1" <?php if($de_cat["isbuy"]==1) echo "checked"; ?> ></td>
        <td style="color:#666666"><?php echo lang_show('isbuyshow');?></td>
      </tr>
	  <?php
		if(!empty($de_cat['brand']))
			$brand=explode(",",$de_cat['brand']);
		else
			$brand=array();
		$sql="select * from ".BRAND." order by nums asc ";
		$db->query($sql);
		$re=$db->getRows();
		if(count($re)>0)
		{
	  ?>
	    <tr>
	    <td height="24" align="right"><?php echo lang_show('brand');?></td>
        <td colspan="2">
        <?php
		  foreach($re as $v)
		  {
		?>
          <label><input <?php if(in_array($v['id'],$brand)) echo 'checked';?> style="width:20px;" name="brand[]" type="checkbox" value="<?php echo $v['id'];?>"><?php echo $v['name'];?></label>
         <?php 
		  } 
		 ?>&nbsp;</td>
	  </tr>
      <?php }} ?>
	  <tr>
	    <td height="24">&nbsp;</td>
        <td><input style="width:80px;" name="" class="btn" type="submit" value="<?php echo lang_show('subm');?>"></td>
	    <td>&nbsp;</td>
	  </tr>
	</table>
	</form>
</div>
</div>
</body>
</HTML>