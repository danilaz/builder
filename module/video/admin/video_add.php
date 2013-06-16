<?php
include_once("../includes/tag_inc.php");
//=======================
if(isset($_POST["cc"]))
{
	$_POST["rank"]*=1;
	add_video();
	admin_msg("module.php?m=$_GET[m]&s=video_list.php",'Успешно сохранено!');
}

function add_video()
{
	global $buid,$config,$db;
	$date=time();
	$sql="insert ".VIDEO." (name,video_url,catid,`desc`,img_url,tj,fb,rank,`time`) 
	values
	('$_POST[name]','$_POST[video_url]','$_POST[catid]','$_POST[desc]','$_POST[img_url]','$_POST[tj]','$_POST[fb]','$_POST[rank]',$date)";
	$db->query($sql);
	$id=$db->lastid();
	add_tags($_POST['keyword'],5,$id);
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
              <td  width="107"> Название</td>
              <td width="742" > <input style="width:400px" name="name" type="text" id="name" value=""></td>
            </tr>
            <tr> 
              <td  width="107">URL видео</td>
              <td width="742" > <input style="width:400px" name="video_url" type="text" id="video_url" value=""></td>
            </tr>
			<tr>
              <td >Ключевые слова</td>
              <td ><input style="width:400px" name="keyword" type="text" id="keyword" value=""></td>
            </tr>
            <tr> 
              <td  width="107">Категории</td>
              <td width="742" > 
              <select name="catid">
              <?php $sql="select * from ".VCAT;
                    $db->query($sql);
                    $hr=$db->getRows();
					foreach ($hr as $v)
          			{
					?>
                <option value="<?php echo $v['id'];?>"><?php echo $v['catname'];?></option>
		<?php
		  }
			?>
			  </select>
              </td>
            </tr>
            <tr> 
              <td  width="107">Детали</td>
              <td >
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
					$fck_en->Value = stripslashes('');
					echo $fck_en->CreateHtml();
				?>
			</td>
            </tr>
            <tr>
              <td >Адрес фото</td>
              <td ><input name="img_url" type="text" id="img_url" value="<?php echo $de['img_url'];?>" size="70">
			 [<a href="javascript:uploadfile('Загрузка логотипа','img_url',100,100)">Загрузить</a>] 
			 [<a href="javascript:preview('img_url');">Предпросмотр</a>]
			 [<a onclick="javascript:$('img_url').value='';" href="#">Удалить</a>]</td>
            </tr>
            <tr> 
              <td  width="107">Рекомендация</td>
          	  <td > 
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
              <td height="22" width="107" >Размещение</td>
              <td height="22" ><input type="checkbox" name="fb" value="1" ></td>
            </tr>
			 <tr>
			   <td height="22" >Рейтинг</td>
			   <td height="22" ><input name="rank" type="text" id="rank" value=""></td>
		    </tr>
			 <tr>
              <td height="22" >&nbsp;</td>
              <td height="22" ><input name="cc" class="btn" type="submit" id="cc" value="Отправить"></td>
            </tr>
          </table>
        </form>
		</div>
		</div>
</body>
</html>