<?php
include_once("../includes/tag_inc.php");
//=======================
if(isset($_POST['cc'])&&$_POST['cc']==lang_show('submit'))
{
	if(!$_POST['rank'])
		$_POST['rank']=0;
	edit_video($_GET['id']);
	msg("module.php?m=$_GET[m]&s=video_list.php");
}

function edit_video($id)
{
	global $buid,$config,$db;
	$sql="update ".VIDEO." set  name='$_POST[name]',`desc`='$_POST[desc]',img_url='$_POST[img_url]',tj='$_POST[tj]',fb='$_POST[fb]', rank='$_POST[rank]' where video_id='$id'";
	$db->query($sql);
	edit_tags($_POST['keyword'],5,$id);
}
if(!empty($_GET['id']))
{
	$db->query("select * from ".VIDEO." where video_id='$_GET[id]' ");
	$de=$db->fetchRow();
	$de['keyword']=get_tags($_GET['id'],5);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<link href="main.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
weburl='<?php echo $config['weburl'];?>';
</script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript" src="../script/prototype.js"></script>
</HEAD>
<body >
<div class="bigbox">
	<div class="bigboxhead">Размещение видео</div>
	<div class="bigboxbody">
        <form name="form1" method="post" action="" enctype="multipart/form-data">
          <table width="100%" border="0" cellpadding="4" cellspacing="0" >
            <tr> 
              <td width="107"> 
                <?php echo lang_show('info_name');?></td>
              <td width="742"> 
              <input style="width:400px" name="name" type="text" id="name" value="<?php echo $de['name']; ?>">
              </td>
            </tr>
            <tr>
              <td><?php echo lang_show('keyword');?></td>
              <td><input style="width:400px" name="keyword" type="text" id="keyword" value="<?php echo $de['keyword']; ?>"></td>
            </tr>
            <tr> 
              <td width="107"><?php echo lang_show('detail');?></td>
              <td>
				<?php
					$BasePath = "../lib/fckeditor/";
					include($BasePath."fckeditor.php");	
					$fck_en = new FCKeditor('desc') ;
					if($config['language']=='cn')
						$fck_en->Config['DefaultLanguage']='zh-cn';
					else
						$fck_en->Config['DefaultLanguage']='en';
					$fck_en->BasePath    = $BasePath ;
					$fck_en->ToolbarSet  = 'Basic' ;
					$fck_en->Width='100%';
					$fck_en->Height=500;
					$fck_en->Config['ToolbarStartExpanded'] = true;
					$fck_en->Value = stripslashes($de['desc']);
					echo $fck_en->CreateHtml();
				?>
			</td>
            </tr>
            <tr>
              <td><?php echo lang_show('img_url');?></td>
              <td><input name="img_url" type="text" id="img_url" value="<?php echo $de['img_url'];?>" size="70">
			 [<a href="javascript:uploadfile('Загрузка логотипа','img_url',100,100)">Загрузить</a>] 
			 [<a href="javascript:preview('img_url');">Предпросмотр</a>]
			 [<a onclick="javascript:$('img_url').value='';" href="#">Удалить</a>]</td>
            </tr>
            <tr> 
              <td width="107"><?php echo lang_show('is_recommend');?></td>
          	  <td> 
				<select name="tj">
				<option value="0"><?php echo lang_show('norec');?></option>
					<?php
						$types['1']=lang_show('type1');
						$types['2']=lang_show('type2');
						$types['3']=lang_show('type3');
						foreach ($types as $key=>$value)
						{
							if($key==$de['tj']) 
								 echo "<option value='$key' selected >$value</option>"; 
							else
								 echo "<option value='$key'>$value</option>";
						}
					?>
			  </select>
              </td>
            </tr>
            <tr> 
              <td width="107"  ><?php echo lang_show('is_post');?></td>
              <td  >
			  <input type="checkbox" name="fb" value="1" <?php if($de['fb']) echo 'checked="checked"';?>>			  </td>
            </tr>
			 <tr>
			   <td  ><?php echo lang_show('rank');?></td>
			   <td  ><input name="rank" type="text" id="rank" value="<?php echo $de['rank']; ?>"></td>
		    </tr>
			 <tr>
              <td  >&nbsp;</td>
              <td  ><input name="cc" class="btn" type="submit" id="cc" value="<?php echo lang_show('submit');?>"></td>
            </tr>
          </table>
        </form>
		</div>
		</div>
</body>
</html>