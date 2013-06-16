<?php /* Smarty version 2.6.20, created on 2013-01-12 15:09:23
         compiled from shop_header.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'shop_header.htm', 6, false),array('modifier', 'truncate', 'shop_header.htm', 91, false),array('insert', 'getSubCity', 'shop_header.htm', 57, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['title']): ?><?php echo $this->_tpl_vars['title']; ?>
,<?php echo $this->_tpl_vars['config']['company']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['title']; ?>
,<?php echo $this->_tpl_vars['config']['company']; ?>
<?php endif; ?>- Powered by B2Bbuilder</title>
<meta name="description" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['config']['description'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", "")); ?>
" />
<meta name="keywords" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['config']['keyword'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", "")); ?>
" />
<meta name="author" content="B2Bbuilder Team and B2Bbuilder UI Team" />
<meta name="copyright" content="B2Bbuilder" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/page.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/product/templates/default/pro.css">
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/prototype.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/index.js" type="text/javascript"></script>
<script>
var showCL = true;
function setShowCL(){
	showCL = true;
}
function offShowCL(){
	showCL = false;
}
function toggleCateDrop()
{
	if(!showCL)
		$('catalogListBox').style.display='none';
}
function cate_drop_show()
{
　	if($('catalogListBox').style.display=='block'){
		Event.stopObserving($('searchTypeBox'), "mouseover",setShowCL, false);
		Event.stopObserving($('searchTypeBox'), "mouseout",offShowCL, false);
		$('catalogListBox').style.display='none';
		Event.stopObserving(document, "click", toggleCateDrop, false);		
	}else{
		Event.observe($('searchTypeBox'), "mouseover",setShowCL, false);
		Event.observe($('searchTypeBox'), "mouseout",offShowCL, false); 
		Event.observe(document, "click", toggleCateDrop, false);
		$('catalogListBox').style.display='block';
	}
}
</script>
</head>
<body>
<div id="top">
   <div id="top_sider">
   <span style="float:left; padding-left:10px;">
   <a class="Thome" href="javascript:setHomepage('<?php echo $this->_tpl_vars['config']['weburl']; ?>
');" style=" background:url(<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/home.gif) no-repeat left center; padding-left:20px;" >Главная</a> | 
   <a href="#" onclick="window.external.addFavorite('<?php echo $this->_tpl_vars['config']['weburl']; ?>
','<?php echo $this->_tpl_vars['config']['keyword']; ?>
')" style="background:url(<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/add.gif) no-repeat left center; padding-left:20px;">В избранное</a> | 
   <script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login_statu.php"></script>
   </span> 
   <span style="float: right; padding-right:20px;">
   <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php" style="background:url(<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/home.gif) no-repeat left center; padding-left:20px;"/>Мой офис</a>
	
	<!--<?php if ($this->_tpl_vars['config']['enurl']): ?><a href="<?php echo $this->_tpl_vars['config']['enurl']; ?>
">English</a> | <?php endif; ?>-->
	   <?php if ($this->_tpl_vars['config']['domaincity'] && $this->_tpl_vars['config']['baseurl']): ?>
				<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/sub_domain_city.php" style="background:url(<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/icon.jpg) no-repeat right center; padding-right:15px;color:#1b77ba;">Города</a><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getSubCity', 'limit' => '6')), $this); ?>

				<?php else: ?>
					<?php if ($this->_tpl_vars['config']['isopencity']): ?>
					Текущий город<?php if ($_COOKIE['PID'] == '' && $_COOKIE['CID'] == ''): ?><?php else: ?><?php echo $_COOKIE['PID']; ?>
 <?php echo $_COOKIE['CID']; ?>
<?php endif; ?>
						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/switch_city.php" style="background:url(<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/icon.jpg) no-repeat right center; padding-right:15px;color:#1b77ba;">Изменить город</a>
					<?php endif; ?>
				<?php endif; ?>
</span> 
  </div>
</div>
<div id="header">
  <div id="logosearch">
    <div class="ls_top">
    <ul id="hr">
	<?php if ($_COOKIE['USER']): ?>
		<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php"/><span>Здравствуйте, <?php echo $_COOKIE['USER']; ?>
!</span> Приветствуем Вас в офисе!</a></li>
		<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?action=logout"/>Выход</a></li>
	<?php else: ?>
		<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['config']['regname']; ?>
">Регистрация</a></li>
		<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php">Войти</a></li>
	<?php endif; ?>
		<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/aboutus.php">Помощь</a></li>
		<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
">На главную сервиса</a></li>
    </ul>
	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product" id="s_logo" class='fl'>
		<img src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/logo.gif<?php endif; ?>" />
	</a>
    </div>
 <div class="nav">
                <div id="navleft">
                    <ul>
                        <?php $_from = $this->_tpl_vars['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['nav'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
        $this->_foreach['nav']['iteration']++;
?>
						<?php if ($this->_tpl_vars['num'] < 10): ?>
							<li <?php if ($this->_tpl_vars['list']['selected_flag'] == $this->_tpl_vars['current']): ?>class="current"<?php endif; ?>>
							<a href="<?php if (((is_array($_tmp=$this->_tpl_vars['list']['link_addr'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?><?php echo $this->_tpl_vars['list']['link_addr']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['list']['link_addr']; ?>
<?php endif; ?>">
								<span><?php echo $this->_tpl_vars['list']['menu_name']; ?>
</span></a>
							</li>
						<?php endif; ?>     
                      <?php endforeach; endif; unset($_from); ?>
					  <li id="nav_rigt_text">
					  <a style="font-weight:normal" href="main.php">Мой офис</a> |
					  <a style="font-weight:normal" href="aboutus.php">Сервис</a>
					  </li>
                    </ul>
                </div>
            </div>
    <div id="search_bar">
        <form method="get" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/">
          <div class="fast_sear">
            <input id="search_key" value="<?php echo $_GET['key']; ?>
" type="text" name="key"  autocomplete="off" />
            <input id="m" name="m" type="hidden" value="product" />
            <?php if ($_GET['id']): ?><input name="id" type="hidden" value="<?php echo $_GET['id']; ?>
" /><?php endif; ?>
            <input id="s" name="s" type="hidden" value="product_list" />
          </div>
          <div class="search_type" id="searchTypeBox">
            <input id="search_type_in" value="<?php if ($_GET['search_type'] != ''): ?><?php echo $_GET['search_type']; ?>
<?php else: ?>Все категории<?php endif; ?>" name="search_type" readonly="readonly" onclick="cate_drop_show();" style="width:215px;" />
            <input type="hidden" name="s_catid" id="search_catid" value="<?php echo $_GET['s_catid']; ?>
" />
            <div class="search_type_drop" id="type_drop" style="*margin-top:0.09em;" onclick="cate_drop_show();"></div>
            <div id="catalogListBox" class="search-category" style="display:none; position:relative">
            <ul class="search-category-list" style="">
              <li>Все категории</li>
              <li class="sub-line"></li>
              <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
              <li catid="<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</li>
              <?php endforeach; endif; unset($_from); ?>
            </ul>
            </div>
          </div>
          <div class="fast_r">
            <input class="search_btn" type="submit" value="Найти" style="float:left; vertical-align:text-bottom" />
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php" style="margin-left:10px;float:left; margin-top:4px;">Поиск</a> </div>
           <div class="gwc">
			<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login_statu_pro.php"></script>  
		   </div>
      </form>
    </div>
  </div>
  <div id="nav">
    <div class="nav_all_cat" id="all_cat">
	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list" style="margin-left:7px;font-weight:normal;font-size:13px;">Категории продуктов</a>
    <?php if ($_GET['s']): ?>
    <ul id="all_cate_list" class="cat_list_show cat_show_in" style="display:none; margin-left:-1px;">
      <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
      <li>
     	 <div><a <?php if ($this->_tpl_vars['list']['sub'] != null): ?>class="sup"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</a></div>
         <?php if ($this->_tpl_vars['list']['sub'] != null): ?>
         <p>
          <?php $_from = $this->_tpl_vars['list']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>     
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&id=<?php echo $this->_tpl_vars['item']['catid']; ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</a>
          <?php endforeach; endif; unset($_from); ?>
        </p>
        <?php endif; ?>
        </li>
      <?php endforeach; endif; unset($_from); ?>
    </ul>
    <?php endif; ?>
    </div>
  </div>
      <div class="s_nav_list">
      <ul>
  		<?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
			<?php if ($this->_tpl_vars['list']['catid'] < 9999 && $this->_tpl_vars['num'] < 0): ?>
				<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</a></li>
			<?php endif; ?>
       <?php endforeach; endif; unset($_from); ?>
      </ul>
    </div>
</div>