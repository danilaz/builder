<?php
	include_once("../includes/global.php");
	//============================================
	$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
	$sctiptName = array_pop($script_tmp);
	include_once("../lang/" . $config['language'] . "/admin/global.php");
	include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
?>
<html>
<head>
<title><?php echo lang_show('use_manaul');?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center>
<div  style="width:400px; margin-left:auto; margin-right:auto;">
<div class="bigbox" style="margin-top:100px;">
	<div class="bigboxhead" style="text-align:left">Системные уведомления</div>
	<div class="bigboxbody" style="background-color:#FFFFFF;">
	<?php
		if(empty($_GET['str']))
			echo lang_show('have_no_perm');
		else
		{
			echo '<div style="text-align:center; height:100px; padding-top:20px;">
			<font style="font-size:16px; color:green;font-weight:bold;line-height:30px;">'.$_GET['str'].'</font>';
			
			if(empty($_GET['url']))
				echo '<br><a href="javascript:history.back(-2);">Нажмите здесь, чтобы вернуться</a>';
			else
			{
				echo '<br><a href="'.$_GET['url'].'">Если Ваш браузер не переходит автоматически, пожалуйста, нажмите здесь</a></div>';
			}
		}
	?>
	
	</div>
</div>
    <script>
    function gotourl(url)
	{
		setTimeout("gotourl1('"+url+"')",1500);//设定超时时间
    }
	function gotourl1(url)
	{
		window.location=url;
	}
	<?php if(!empty($_GET['url'])){ ?>
	gotourl('<?php echo $_GET['url'];?>');
	<?php } ?>
    </script>
</div>
</center>
</body>
</html>
