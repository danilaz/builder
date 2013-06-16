<?php
include_once("$config[webroot]/module/".$_GET['m']."/includes/news_function.php");
if(!empty($_POST['act']))
{
	if(!empty($_FILES['img_url'])&&is_uploaded_file($_FILES['img_url']['tmp_name']))
	{
		if(!empty($_POST['pic']))
		{
			$file="../uploadfile/news/".$_POST['pic'];
			@unlink($file);
			$file="../uploadfile/news/big/".$_POST['pic'];	
			@unlink($file);
		}
		$pname=time().".jpg";
		$savefile="../uploadfile/news/".$pname;
		$bsavefile="../uploadfile/news/big/".$pname;
		makethumb($_FILES['img_url']['tmp_name'],$savefile,140,125);
		makethumb($_FILES['img_url']['tmp_name'],$bsavefile,275,200);
	}
	
	if(!empty($_POST['pic']) and empty($pname))
	{
		$pname=$_POST['pic'];
	}
	
	$imgs_url="";	
	if($_POST['newstempid']==1)
	{
		preg_match_all('/\<img.*?src\=\\\"(.*?)\\\"[^>]*>/i',$_POST['body'],$match);
		$imgs_url=implode('|',$match[1]);
	}
	
	preg_match_all('/\<embed.*?src\=\\\"(.*?)\\\"[^>]*>/i',$_POST['body'],$match);
	$video_url=implode('|',$match[1]);
	
	if(empty($video_url))	
		$video_url="";
	
	
	$titlefont=implode('|',$_POST['titlefont']);
	
	$time=time();
	if(!empty($_POST['time']))
		$time=strtotime($_POST['time']);
	
	if(empty($pname))
	   $ispic=0;
	else
	   $ispic=1;
	
	if(empty($_POST['smalltext']))
	{
		$con=$_POST['body'];
		$str = explode('<p>',$con);
		foreach($str as $i=>$k)
		{
			$val=trim(strip_tags($k));
			if(!empty($val))
			{
				$_POST['smalltext']=trim(str_replace("&nbsp;","",$val));
				break;
			}
		}
	}
	
	if(empty($_POST['closepl']))
		$_POST['closepl']=0;	
	if(empty($_POST['rec']))
		$_POST['rec']=0;
	if(empty($_POST['istop']))
		$_POST['istop']=0;
	if(empty($_POST['pass']))
		$_POST['pass']=0;
	
	@$vote=implode(',',$_POST['vote']).',';
	@$special=implode(',',$_POST['special']).',';
	
	if($_POST['act']=='add')
	{	
		foreach(explode(',',$_POST['type']) as $val)
		{
			$sql="INSERT ".NEWSD."(classid,title,ftitle,keyboard,titleurl,isrec,istop,ispass,onclick,titlefont,uid,uptime,smalltext,writer,source,titlepic,ispic,isgid,ispl,userfen,newstempid,imgs_url,videos_url,vote,special,lastedittime) VALUES ('$val','$_POST[title]','$_POST[ftitle]','$_POST[key]','$_POST[links]','$_POST[rec]','$_POST[istop]','$_POST[pass]','$_POST[onclick]','$titlefont','0','$time','$_POST[smalltext]','$_POST[writer]','$_POST[source]','$pname','$ispic','$_POST[group]','$_POST[closepl]','$_POST[userfen]','$_POST[newstempid]','$imgs_url','$video_url','$vote','$special','".time()."')";
			$re=$db->query($sql);
			$id=$db->lastid();
			$sql="INSERT INTO ".NEWSDATA." (nid,con) values ('$id','$_POST[body]')";
			$re=$db->query($sql);
		}
		msg("module.php?m=news&s=newslist.php&classid=$_GET[type]");
	}
	if($_POST['act']=='edit' and !empty($_GET['newsid']))
	{
		$sql="update ".NEWSD." set title='$_POST[title]',ftitle='$_POST[ftitle]',keyboard='$_POST[key]',titleurl='$_POST[links]', isrec='$_POST[rec]', istop='$_POST[istop]',ispass='$_POST[pass]',onclick='$_POST[onclick]',titlefont='$titlefont',uptime='$time',smalltext='$_POST[smalltext]',writer='$_POST[writer]',source='$_POST[source]',titlepic='$pname',ispic='$ispic',isgid='$_POST[group]',ispl='$_POST[closepl]',userfen='$_POST[userfen]',newstempid='$_POST[newstempid]',imgs_url='$imgs_url',videos_url='$video_url',vote='$vote',special='$special',lastedittime='".time()."' where nid= $_GET[newsid]";
		$re=$db->query($sql);
		$sql="update ".NEWSDATA." set con='$_POST[body]' where nid= $_GET[newsid]";  
		$re=$db->query($sql);
		
		unset($_GET['newsid']);
		unset($_GET['s']);
	    $getstr=implode('&',convert($_GET));
		msg("module.php?m=news&s=newslist.php&$getstr");
	}
}
if(!empty($_GET['newsid']))
{
	$sql="select * from ".NEWSD." where nid=".$_GET['newsid'];
	$db->query($sql);
	$de=$db->fetchRow();
	$de['con']=get_newsdata($de['nid']);
	$de['titlefont']=explode('|',$de['titlefont']);
	$col=array_pop($de['titlefont']);
	$de['vote']=explode(',',$de['vote']);
	$de['special']=explode(',',$de['special']);
}
?>
<html>
<HEAD>
<TITLE></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../lib/calendar/calendar.css" >
<style>
.bigboxbody td{ padding-left:5px; border:0px}
.bigboxbody select{ width:120px;} 
#colortab td{ padding:0px;}
.bigbox tr{ background:#f0f0f0}
.radio{ float:left; margin-right:4px;}
.radio { margin-top:5px } 
* html .radio { margin-top:0px } 
*+html .radio { margin-top:0px}
u{ text-decoration:none; float:left; margin-right:6px;}
.sel{ width:515px !important; height:160px; padding:2px 0px;}
.sel .option{  padding:2px 4px !important;}
.sel option{ font-size:14px; height:20px; line-height:20px; padding:2px 6px;  }

</style>
</HEAD>
<script src="../script/prototype.js" type="text/javascript"></script>
<script src="../script/select_color.js"></script>
<script>
function setTab(name,cursel,n)
{
	for(i=1;i<=n;i++)
	{   var menu=document.getElementById(name+i);
		var con=document.getElementById("con_"+name+"_"+i);
		menu.className=i==cursel?"current":"tag";
		con.style.display=i==cursel?"block":"none";
	}
}
function setValue(a)
{
    if($('sel'+a).selectedIndex!=0)
	$(a).value=$('sel'+a).options[$('sel'+a).selectedIndex].text;
	else
	$(a).value='';
	$(a+'id').value=$('sel'+a).value
} 

function get_value()
{
	frames['form'].document.forms[0].vname.value
	
}
</script>
<body>
<form method="post" action="" enctype="multipart/form-data" onSubmit="return checkval(this)">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('news'); ?></div>
	<div class="bigboxbody">
  	<input type="hidden" value="<?php if($_GET['type']) { echo $_GET['type']; } else { echo implode(',',$_POST['type']); } ?>" name="type">
	<input type="hidden" name="act" value="<?php if(isset($_GET['newsid'])) echo "edit"; else echo "add"; ?>" />
	<table border="0" cellpadding="2" cellspacing="1" width="100%" bgcolor="#dddddd">
      <tr height="65">
           <td width="10%" height="22" align="center">Заголовок</td>
           <td height="22" align="left" valign="middle" colspan="2">
           <input type="text" class="input"  name="ftitle" id="ftitle" size="60" value="<?php if(!empty($de["ftitle"])) echo $de["ftitle"];?>"><br>
           
           Жирный <input  type="checkbox" name="titlefont[]" value="b" <?php if (@in_array('b',$de['titlefont'])) echo 'checked="checked"'; ?> >
           Курсив <input type="checkbox" name="titlefont[]" value="i" <?php if (@in_array('i',$de['titlefont'])) echo 'checked="checked"'; ?> >
           Зачеркнутый <input type="checkbox" name="titlefont[]" value="s" <?php if (@in_array('s',$de['titlefont'])) echo 'checked="checked"'; ?> >&nbsp;&nbsp;
           Цвет <input type="text" id="color" name="titlefont[]"  size="18" onClick="coloropen(event)" value="<?php if( $col!='b' and $col!='i' and $col!='s') echo $col; ?>"  style="background-color:<?php if( $col!='b' and $col!='i' and $col!='s') echo $col; else echo "FFFFFF"; ?>" > 
           
        
            
           <div id="colorpane" style="position:absolute;z-index:999;display:none;"></div>
           </td>
      </tr>
	  <tr>
	      <td align="center">Подзаголовок</td>
		  <td colspan="2">
              <input type="text" class="input" name="title" id="title" size="60" value="<?php if(!empty($de["title"])) echo $de["title"];?>">
		  </td>
	  </tr> 
   
      <tr>
           <td align="center" rowspan="7">Атрибуты</td>
           <td width="20%">Информация по данным</td>
		   <td>
            Рекомендуемые <input type="checkbox" name="rec" id="rec" value="1" <?php if($de["isrec"]==1) echo " checked"; ?> />    
            Проверка <input type="checkbox" name="pass" id="pass" value="1"  <?php if($de["ispass"]==1 or !isset($de["ispass"])) echo " checked"; ?>  />        
            Последние новости <input type="checkbox" name="istop" id="istop" value="1" <?php if($de["istop"]==1) echo " checked"; ?>  /> &nbsp;
			</td>
        </tr>
       <tr>
           <td>Ключевые слова: </td>
		   <td><input type="text" class="input"  name="key" id="key" size="48" value="<?php if(!empty($de["keyboard"])) echo $de["keyboard"];?>" />
           <span class="grey"> (Если несколько ключевых слов, разделите запятой)</span></td>
       </tr>
       <tr>
           <td>Внешняя ссылка: </td>
		   <td><input type="text"  class="input" name="links" id="links" size="48" value="<?php if(!empty($de["titleurl"])) echo $de["titleurl"];?>" /> </td>
       </tr>
	   <tr>
         <td>Доступ </td>
         <td> 
              <select name="group" id="group">
			  	<?php 
				  foreach(get_group() as $key=>$val)
				  {
					if($key>1)  
				    {
						if($de["isgid"]==$val['group_id'])	 
						   $str="selected";
						else
						   $str="";
						echo "<option $str value='".$val['group_id']."'>".$val['name']."</option>";
				    }
				  }
				?>
			  </select>&nbsp;&nbsp;&nbsp;&nbsp;  
             Списание баллов: <input type="text" name="userfen" id="userfen" size="6"  value="<?php if(!empty($de["userfen"])) echo $de["userfen"];else echo "0" ;?>" />
         </td>
       </tr>
       <tr>
         <td>Количество кликов: </td>
         <td><input size="18" type="text" id="onclick" name="onclick" value="<?php if(!empty($de["onclick"])) echo $de["onclick"]; else echo "0" ;?>" />&nbsp;&nbsp;&nbsp;&nbsp;  
           Закрыть комментарии: <input type="checkbox" value="1" name="closepl" <?php if($de["ispl"]==1) echo " checked"; ?> /></td>
       </tr>
        <tr>
       		<td>Выберите голосование: <a href="module.php?m=vote&s=vote.php">+</td>
      		<td>
            	<?php 
					$sql="select id,title from ".NEWSVOTE." order by id asc";	
					$db->query($sql);
					$re=$db->getRows();
					foreach($re as $val)
					{   
						if(is_array($de['vote']))	
						{
							if(in_array($val['id'],$de['vote']))
								$str="checked";
							else
								$str="";
						}
						echo "<input $str type='checkbox' class='radio' name='vote[]' id='vote' value='$val[id]' /><u>$val[title]</u>";
					}
				?>
              </td> 
        </tr>
      
        <tr>
      		<td>Похожие новости: <a href="module.php?m=special&s=add_special.php">+</a> <a href="#" title="Связка похожих новостей"><img align="absmiddle" src="../image/admin/Help Circle.jpg" border="0" ></a></td>
            <td>
				<?php 
					$sql="select id,name from ".SPE." order by id asc";	
					$db->query($sql);
					$re=$db->getRows();
					foreach($re as $val)
					{
						if(is_array($de['special']))	
						{
							if(in_array($val['id'],$de['special']))
								$str="checked";
							else
								$str="";
						}
						 echo "<input $str type='checkbox' class='radio' name='special[]' id='vote' value='$val[id]' /><u>$val[name]</u>";
					}
				?>
              </td> 
        </tr>
       
       
	   <tr>
           <td align="center">Дата размещения</td>
           <td colspan="2">
		     <input type="text" class="input"  name="time" id="time" size="20" value="<?php if(!empty($de["uptime"])) echo date('Y-m-d H:i:s',$de["uptime"]); ?>" />
			 <input value="Разместить сейчас" type="button" onClick="$('time').value='<?php echo date("Y-m-d H:i:s") ?>'">
		   </td>
       </tr> 
	          <tr>
           <td align="center">Автор</td>
           <td colspan="2">
           <input type="text" class="input" name="writer" id="writer" value="<?php if(!empty($de["writer"])) echo $de["writer"]; ?>" /> 
		   </td>
        </tr> 
       <tr>
           <td align="center">Источник</td>
           <td colspan="2">
           <input type="text" class="input"  name="source" id="source" value="<?php if(!empty($de["source"])) echo $de["source"]; ?>">
		   </td>
        </tr>
       <tr>
           <td align="center">Изображение</td>
           <td colspan="2">
           	 <?php if(!empty($de["titlepic"])) { ?> 
             <img src="<?php echo $config['weburl'] ?>/uploadfile/news/<?php echo $de["titlepic"]?>"> <br>
			 <input type="hidden" name="pic" value="<?php echo $de["titlepic"]; ?> ">
			 <?php }  ?>
           	  <input type="file" id="img_url" name="img_url" size="21" >
           </td>
        </tr>
       <tr>
           <td align="center">Введение</td>
           <td colspan="2">
           <textarea maxlength="200" name="smalltext" id="smalltext" rows="3" cols="100"><?php if(!empty($de["smalltext"])) echo $de["smalltext"]; ?></textarea>
           </td>
        </tr> 
          
      
        <tr>
           <td align="center">Шаблон содержания</td>
           <td colspan="2">
            <select name="newstempid" id="newstempid">
            <?php 
             foreach(lang_show('newstempid') as $key=>$val)
             {
               echo "<option value='".($key)."'>".$val."</option>";
             }
            ?>
            </select> Для вставки изображений в шаблон, нажмите <img align="absmiddle" src="<?php echo $config['weburl'] ?>/lib/fckeditor/editor/images/spacer.gif" style="background-position: 0px -672px; background-image: url(<?php echo $config['weburl'] ?>/lib/fckeditor/editor/skins/office2003/fck_strip.gif); height:16px; width:16px; border:none; "> (разрыв страницы) и затем вставьте изображение 
           </td>
        </tr>
        <tr><td align="center">Текст новости</td><td colspan="2">
           <?php
			if(empty($de["con"]))
				$de["con"]=NULL;
			$BasePath = "../lib/fckeditor/";
			include($BasePath."fckeditor.php");	
			$fck_en = new FCKeditor('body') ;
			if($config['language']=='cn')
				$fck_en->Config['DefaultLanguage']='zh-cn';
			else
			$fck_en->Config['DefaultLanguage']='en';
			$fck_en->BasePath    = $BasePath ;
			$fck_en->ToolbarSet  = 'Default' ;
			$fck_en->Width='100%';
			$fck_en->Height=500;
			$fck_en->Config['ToolbarStartExpanded'] = true;
			$fck_en->Value = stripslashes($de["con"]);
			echo $fck_en->CreateHtml();
		  ?>
           </td>
        </tr>
        
        <tr>
          <td></td>
          <td colspan="2">
              <input name="aid" type="hidden" id="aid" value="">
              <input name="action" type="hidden" id="action" value="<?php if(!empty($_GET["id"])) echo "edit";else echo "submit"; ?>">
              <input type="submit" id="btn" name="submit" value="<?php if(!isset($_GET['newsid'] )) echo "Отправить"; else echo "Изменить" ?>">&nbsp;
              <input type="reset" value="Отмена">
          </td>
        </tr> 
    </table>
    </div>
</div>
</form>
</body>
<script>
function getHTML(v,ob,sscatid,scatid,tcatid)
{	
    var url = '../ajax_back_end.php';
	var pars = 
	var myAjax = new Ajax.Request(
				url,
				{method: 'post', parameters: pars, onComplete: showResponse}
				);
	function showResponse(originalRequest)
	{
		var getstr=originalRequest.responseText;
		
    }
　}
</script>
</html>
