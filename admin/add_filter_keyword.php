<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
@include_once("../lang/" . $config['language'] . "/admin/".$sctiptName);
include_once("auth.php");
//====================================================
if($_POST['action']=='submit'&&!empty($_POST['keyword'])&&!empty($_GET['id']))
{
	
	if($_POST['statu']==1)
		$_POST['replace']='';
	$sql="update ".FILTER." set
	keyword='$_POST[keyword]',`replace`='$_POST[replace]',statu='$_POST[statu]' where id='$_GET[id]'";
	$db->query($sql);
	update_cache_filter();
	admin_msg('filter_keyword_list.php','Успешное обновлено!');
}

if($_POST['action']=='submit'&&!empty($_POST['keyword'])&&empty($_GET['id']))
{
	$time=time();
	$_POST['statu']=empty($_POST['statu'])?0:1;
	foreach(explode("\r\n",$_POST['keyword']) as $v)
	{
		$word=explode('=',$v);
		if($_POST['statu']==1)
			$word[1]='';
		if($_POST['statu']!=1&&empty($word[1]))
			$word[1]='*';
		$sql="insert into ".FILTER." (keyword,`replace`,statu,`time`) values
		 ('$word[0]','$word[1]','$_POST[statu]','$time')";
		$db->query($sql);
	}
	update_cache_filter();
	admin_msg('filter_keyword_list.php','Успешно размещено!');
}
function update_cache_filter()
{
	global $db;
	$sql="select * from ".FILTER;
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $v)
	{
		if($v['statu']==1)
		{	
			if(empty($banned))
				$banned="$v[keyword]";
			else
				$banned.="|$v[keyword]";
		}
		else
		{
			if(empty($find))
			{
				$find="'/$v[keyword]/i'";
				$replace="'$v[replace]'";
			}
			else
			{
				$find.=",'/$v[keyword]/i'";
				$replace.=",'$v[replace]'";
			}
		}
	}
	$str='<?php
	$find= array('.$find.');
	$replace=array('.$replace.');
	$banned=\'/('.$banned.')/i\';
	$_CACHE[\'word_filter\'] = Array
	(
		\'filter\' => Array
		(
			\'find\' => &$find,
			\'replace\' => &$replace
		),
		\'banned\' => &$banned
	);
	?>';
	$fp=fopen('../config/filter.inc.php','w');
	fwrite($fp,$str,strlen($str));//将内容写入文件．
	fclose($fp);
}
if(!empty($_GET['id']))
{
	$sql="select * from ".FILTER." where id='$_GET[id]'";
	$db->query($sql);
	$de=$db->fetchRow();
}
?>
<html>
<HEAD>
<TITLE>Система управления</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<form method="post" action="" enctype="multipart/form-data" onSubmit="return checkval(this)">
<div class="bigbox">
	<div class="bigboxhead">Фильтр слов</div>
	<div class="bigboxbody">
	  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">	
        <tr>
          <td width="35%" align="left" >
		  <?php if(empty($_GET['id'])){ ?>
            <textarea name="keyword" cols="50" rows="20" id="keyword"></textarea>
            <br>
            <?php }else { ?>Слово или фраза
            <input value="<?php echo $de['keyword'];?>" name="keyword" type="text" size="50">
		    <br>
			Замена
			<input name="replace" value="<?php echo $de['replace'];?>" size="50" type="text">
		    <?php } ?>		  </td>
          <td width="65%" align="left" valign="top" >
		  <?php if(empty($_GET['id'])){ ?>
              <li>Между плохими словами и замены слов, используйте "=" для присвоения нового значения;</li>
              <li>Если Вы просто хотите стереть слово, введите просто слово; </li>
              <li>Пример:<br>
                toobad<br>
                nobad<br>
                badword=good
				</li>
			<?php } else {?>
			<li>Между плохими словами и замены слов, используйте "=" для присвоения нового значения;</li>
			<?php } ?>
          </ul>
		  </td>
        </tr>
        <tr>
          <td colspan="2" ><label>
            <input name="statu" type="checkbox" <?php if($de['statu']==1) echo 'checked';?> id="statu" value="1" >
            Закрыть публикацию, если будет обнаружено плохое слово
          </label></td>
        </tr>
        <tr>
          <td colspan="2" >
		  <input class="btn" type="submit" name="cc" value="Отправить">
		  <input name="action" type="hidden" value="submit">          </td>
        </tr>
      </table>
	</div>
</div> 
</form>
</body>
</html>