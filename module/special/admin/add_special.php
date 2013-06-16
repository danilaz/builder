<?php
//==========================
if(!empty($_POST['submit'])&&!empty($_GET['edit']))
{
	$p=$_POST;
	$p['stime']=strtotime($p['stime']);
	$p['etime']=strtotime($p['etime']);
	$p['user_group']=implode(",",$_POST['user_group']);
	$order=empty($p['order'])?0:$p['order'];
	
	$sql="update ".SPE." 
	set name='$p[name]',stime='$p[stime]',etime='$p[etime]',template='$p[template]',layout='$p[layout]',
	keyword='$p[keyword]',con='$p[con]',`order`='$order',user_group='$p[user_group]',
	file_name='$p[file_name]' where id='$_GET[edit]'";
	$db->query($sql);
	
	if(!empty($_POST['delpic']))
	{
		$pic = $config['webroot']."/uploadfile/newsimg/special/".$_GET['edit'].".jpg";
		unlink($pic);
	}
	
	if(is_uploaded_file($_FILES['logo']['tmp_name']))
	{	
		$pic = $config['webroot']."/uploadfile/newsimg/special/$_GET[edit].jpg";
		makethumb($_FILES['logo']['tmp_name'] , $pic, 150,150);
	}
	
	msg('module.php?m=special&s=special_list.php');
	
}
if(!empty($_POST['submit'])&&empty($_GET['edit']))
{
	$p=$_POST;
	$p['stime']=strtotime($p['stime']);
	$p['etime']=strtotime($p['etime']);
	$p['user_group']=implode(",",$_POST['user_group']);
	
	$sql="insert into ".SPE." 
	(name,stime,etime,template,layout,keyword,con,`order`,user_group,file_name,add_time,add_user) 
	values ('$p[name]','$p[stime]','$p[etime]','$p[template]','$p[layout]','$p[keyword]','$p[con]','$p[order]','$p[user_group]','$p[file_name]','".time()."','$_SESSION[ADMIN_USER]')";
	$db->query($sql);
	$id=$db->lastid();	
	if(is_uploaded_file($_FILES['logo']['tmp_name']))
	{	
		$pic = $config['webroot']."/uploadfile/newsimg/special/$id.jpg";
		makethumb($_FILES['logo']['tmp_name'] , $pic, 150,150);
	}
	
	msg('module.php?m=special&s=special_list.php');
}
if(!empty($_GET['edit']))
{
	$sql="select * from ".SPE." where id='$_GET[edit]'";
	$db->query($sql);
	$de=$db->fetchRow();
}
else
	$de=NULL;
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/Calendar.js"></script>
<style>
.logo img{max-height:400px; max-width:400px}
</style>
</HEAD>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('hr_info_manager');?></div>
<form action="" method="post" enctype="multipart/form-data">
<div class="bigbox">
	<div class="bigboxhead">Специальные темы</div>
	<div class="bigboxbody">
    
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13%">Название темы: </td>
    <td width="87%">
      <input type="text" name="name" id="name" value="<?php echo $de['name'];?>" size="50">
    </td>
  </tr>
  <tr>
    <td>SEO ключевые слова:</td>
    <td><input name="keyword" type="text" id="keyword" value="<?php echo $de['keyword'];?>" size="50"></td>
  </tr>
  <tr>
    <td>Описание функции</td>
    <td><?php
			$BasePath = "../lib/fckeditor/";
			include($BasePath."fckeditor.php");	
			$fck_en = new FCKeditor('con') ;
			$fck_en->BasePath    = $BasePath ;
			if($config['language']=='cn')
				$fck_en->Config['DefaultLanguage']='zh-cn';
			else
				$fck_en->Config['DefaultLanguage']='en';
			$fck_en->ToolbarSet  = 'Default' ;
			$fck_en->Width='100%';
			$fck_en->Height=400;
			$fck_en->Config['ToolbarStartExpanded'] = true;
			$fck_en->Value = stripslashes($de["con"]);
			echo $fck_en->CreateHtml();
		?></td>
  </tr>
  <tr>
    <td>Право на просмотр</td>
    <td><?php
		$groupid=explode(",",$de['user_group']);
		$sql="select * from ".USERGROUP;
		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $v)
		{
	   ?> 
	   <input name="user_group[]" type="checkbox" <?php if(!empty($groupid)&&in_array($v['group_id'],$groupid)) echo "checked"; ?> value="<?php echo $v['group_id']; ?>"><?php echo $v['name']; ?>
	   <?php
		  }
	   ?>
       </td>
  </tr>

  <tr>
  <td>Операции</td>
    <td>
    <script language="javascript">
			var cdr = new Calendar("cdr");
			document.write(cdr);
			cdr.showMoreDay = true;
			</script>
			<input readonly name="stime" type="text" id="stime" size="28" value="<?php if(isset($de["stime"])){echo date("Y-m-d",$de["stime"]);}?>" onFocus="cdr.show(this);">
         -
            <input readonly onFocus="cdr.show(this);" name="etime" type="text" id="etime" size="28" value="<?php if(isset($de["etime"])){echo date("Y-m-d",$de["etime"]);}?>" onFocus="cdr.show(this);">
          
    </td>
  </tr>
      <tr>
    <td>Сортировка тем</td>
    <td><input type="text" name="order" id="order" value="<?php echo $de['order'];?>"></td>
  </tr>
  <tr>
    <td>Шаблон:</td>
    <td>
    <select name="template" id="template">
         <?php
		 function read_dir($dir)
		{
			$i=0;
			$handle = opendir($dir); 
			$rdir=array();
			while ($filename = readdir($handle))
			{ 
				if($filename!="."&&$filename!="..")
				{
				  if(!is_dir($dir.$filename))
				  { 
						$rdir[]=$filename;
				  }
			   }
			}
			return $rdir;
		}
		  $dir=read_dir("$config[webroot]/module/$_GET[m]/special_template/");
		  foreach($dir as $v)
		  {
		  	if($v==$config['temp'])
				$sl="selected";
			else
				$sl=NULL;
		  	echo "<option value='$v' $sl>$v</option>";
		  }
		  ?>
          </select>
     </td>
  </tr>
  <tr>
    <td>Макет шаблона:</td>
    <td>
    <input <?php if($de['layout']=='top,chenter,footer'){ echo 'checked';}?> type="radio" name="layout" id="radio" value="top,chenter,footer">
    <img src="../image/default/1cl.gif" width="24" height="28">
    
    <input <?php if($de['layout']=='top,left,chenter,footer'){ echo 'checked';}?> type="radio" name="layout" id="radio" value="top,left,chenter,footer">
    <img src="../image/default/2cll.gif" width="24" height="28">
    
    <input <?php if($de['layout']=='top,right,chenter,footer'){ echo 'checked';}?> type="radio" name="layout" id="radio" value="top,right,chenter,footer">
    <img src="../image/default/2clr.gif" width="24" height="28">
    
    <input <?php if($de['layout']=='top,left,right,chenter,footer'){ echo 'checked';}?> type="radio" name="layout" id="radio" value="top,left,right,chenter,footer">
    <img src="../image/default/3cl.gif" width="24" height="28">
    </td>
  </tr>
  <tr>
    <td>Логотип</td>
    <td class="logo">
     <?php 
	$pic = $config['webroot']."/uploadfile/newsimg/special/$de[id].jpg";
	if(file_exists($pic))
		echo "<img src='../uploadfile/newsimg/special/$de[id].jpg' width='80' height='80'>";
	?>
    <input name="logo" type="file">
    </td>
  </tr>
  <tr>
    <td>Статическая ссылка</td>
    <td><?php echo $config['weburl'];?>/special-<input type="text" name="file_name" id="file_name" value="<?php echo $de['file_name'];?>" ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn" type="submit" name="submit" id="submit" value="Отправить"></td>
  </tr>
</table>

	</div>
</div>
</form>
</body>
</html>