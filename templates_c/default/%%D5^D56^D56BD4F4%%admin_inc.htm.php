<?php /* Smarty version 2.6.20, created on 2013-01-12 15:03:29
         compiled from admin_inc.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'explode', 'admin_inc.htm', 94, false),array('modifier', 'truncate', 'admin_inc.htm', 98, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['title']): ?><?php echo $this->_tpl_vars['title']; ?>
 - <?php echo $this->_tpl_vars['config']['company']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['title']; ?>
<?php endif; ?>- Powered by B2Bbuilder</title>
<meta name="description" content="<?php echo $this->_tpl_vars['config']['description']; ?>
">
<meta name="keywords" content="<?php echo $this->_tpl_vars['config']['keyword']; ?>
">
<meta name="generator" content="<?php echo $this->_tpl_vars['config']['version']; ?>
" />
<meta name="author" content="B2Bbuilder Team and B2Bbuilder UI Team" />
<meta name="copyright" content="B2Bbuilder" />
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/admin.css" rel="stylesheet" type="text/css" />
<?php if ($_GET['m'] != 'email' && $_GET['m'] != 'spider' && $_GET['s'] != 'admin_crm_list'): ?>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/prototype.js" type=text/javascript></script>
<?php endif; ?>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/index.js" type=text/javascript></script>
<body>
</head>
<div id="header" class="header">
<div class="header">
	<div class="alibaba">
		<div class="logo">
			<a href="?menu=<?php echo $_GET['menu']; ?>
&action=main&menu=main"><img width="134" height="35" src="image/default/adminlogo.png"></a>
		</div>
		<div class="user">
		Здравствуйте, <?php echo $_COOKIE['USER']; ?>
!&nbsp;
		<a class="headerA" href="?menu=<?php echo $_GET['menu']; ?>
&action=logout"><?php echo $this->_tpl_vars['lang']['logout']; ?>
</a>
		<a class="headerA2" href="member_services.php"><?php echo $this->_tpl_vars['cominfo']['rank']; ?>
</a>
		</div>
		<div class="search">
			<div class="link">
			<a class="headerA" href="javascript:myAddPanel('<?php echo $this->_tpl_vars['config']['weburl']; ?>
','<?php echo $this->_tpl_vars['config']['company']; ?>
');">Добавить в избранное</a> | 
			<a class="headerA" href=# onClick="setHomepage('<?php echo $this->_tpl_vars['config']['weburl']; ?>
');">Сделать стартовой</a>
			</div>
			<div class="form">
			<form method="get" name="sear" id="sear" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/">
				<input name="m" id="m" type="hidden" value="offer" />
				<input name="s" id="s" type="hidden" value="offer_list" />
				<select style="width:120px; height:20px;" class="selectnav" name="type" onChange="select_form(this.value,'<?php echo $this->_tpl_vars['config']['weburl']; ?>
')">
				<option value="offer" >Продукты</option>
				<option value="company" >Компания</option>
				<option value="news" >Новости</option>
				</select>
				<input class="search_text" name="key" type="text" size="40" />
				<input name="Submit" type="submit" d="search_submit" class="search_btn_" value="Найти" />
			</form>
			</div>
		</div>
</div>

	<div class="header-nav">
		<div class="nav-l">&nbsp;</div>
		<div class="nav-m">
			<ul id="header-ul">
				<?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
					<li class="<?php if ($_GET['menu'] == $this->_tpl_vars['num']): ?>nav-f4_on<?php else: ?>nav-f<?php endif; ?>">
						<a class="navA" href="?menu=<?php echo $this->_tpl_vars['num']; ?>
&action=<?php echo $this->_tpl_vars['list']['action']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a>
					</li>
					<li class="nav-g">&nbsp;</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<ul id="header_m-ul" class="nav-m2">
			<li class="nav-f">
			<?php if ($_SESSION['IFPAY'] > 1): ?>
				<?php if ($this->_tpl_vars['config']['opensuburl'] == 1): ?>
					<a class="navA" href="http://<?php echo $_COOKIE['USER']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
" target="_blank"><?php echo $this->_tpl_vars['lang']['view_shop']; ?>
</a>
				<?php else: ?>
					<a class="navA" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
" target="_blank"><?php echo $this->_tpl_vars['lang']['view_shop']; ?>
</a>
				<?php endif; ?>
			<?php endif; ?>
			</li>
			<li class="nav-g">&nbsp;</li>
			<li class="nav-f"><a class="navA" href="index.php" target="_blank">В центр</a></li>
			</ul>
		</div>
		<div class="nav-r">&nbsp;</div>
	</div>
	<div id="guidedetail" class="guidedetail"></div>
</div>
</div>



<div id="screen">
		<div class="screen-spc"></div>
		<!--new menu-->
		<div id="leftmenu">
				<div id="tree1">
					<div class="tree_item">
						<?php $_from = $this->_tpl_vars['submenu']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
							<div class="tree_title_open"><a target="_blank"><?php echo $this->_tpl_vars['list']['name']; ?>
</a></div>
							<ul class="tree_list" style="display: block;">
								<?php $_from = $this->_tpl_vars['list']['action']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['akey'] => $this->_tpl_vars['slist']):
?>
									<?php $this->assign('gets', ((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('explode', true, $_tmp, "&") : smarty_modifier_explode($_tmp, "&"))); ?>
									<li 
									<?php if ($_GET['action'] == $this->_tpl_vars['akey'] || in_array ( $_GET['type'] , $this->_tpl_vars['gets'] ) || in_array ( $_GET['s'] , $this->_tpl_vars['gets'] )): ?>
									id="tree_list_now"<?php endif; ?>class="tree_list">
										<?php if (((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1, '') : smarty_modifier_truncate($_tmp, 1, '')) == '?' || ((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?>
										<a href="<?php echo $this->_tpl_vars['akey']; ?>
"><?php echo $this->_tpl_vars['slist']; ?>
</a>
										<?php else: ?>
										<a href="?menu=<?php echo $_GET['menu']; ?>
&action=<?php echo $this->_tpl_vars['akey']; ?>
&menu=<?php echo $_GET['menu']; ?>
"><?php echo $this->_tpl_vars['slist']; ?>
</a>
										<?php endif; ?>
									</li>
								<?php endforeach; endif; unset($_from); ?>
							</ul>
							<div class="content-spc"></div>
						<?php endforeach; endif; unset($_from); ?>
					</div>
					<div class="suggest">
						<div class="tree_title">Колл-центр</div>
						<div class="hotline_service">Горячая линия</div>
						<div class="hostline_num"><?php echo $this->_tpl_vars['config']['owntel']; ?>
</div>
						<div class="hotline_time">Время работы</div>
						<div class="hotline_time">9:00-18:00(Пн-Пт)</div>
					</div>
				</div>
		</div>
	    <!--content-->
		<div id="new-content">
		<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=45&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
		<?php echo $this->_tpl_vars['output']; ?>
</div>	
		<!--end/content-->	
	</div>
	
<div style="border-top:3px solid #FF7300; line-height:200%; text-align:center; height:150px; margin-top:10px;">
	<ul><?php echo $this->_tpl_vars['web_con']; ?>
</ul>
	<div><?php echo $this->_tpl_vars['bt']; ?>
</div>
</div>


<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jf_change.js" type=text/javascript></script>
<script type="text/javascript">
var defaultEncoding = 2;
var translateDelay = 0;
var cookieDomain = ""; 
var msgToTraditionalChinese = "Кит. традиц";
var msgToSimplifiedChinese = "Кит. упр.";
var translateButtonId = "B2Bbuilder";
translateInitilization();
</script>
</div>
</body>
</html>