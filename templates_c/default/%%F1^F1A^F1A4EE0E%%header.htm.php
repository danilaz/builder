<?php /* Smarty version 2.6.20, created on 2013-05-31 17:41:28
         compiled from header.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'header.htm', 6, false),array('modifier', 'truncate', 'header.htm', 58, false),array('insert', 'getSubCity', 'header.htm', 29, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['title']): ?><?php echo $this->_tpl_vars['title']; ?>
, <?php echo $this->_tpl_vars['config']['company']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['title']; ?>
, <?php echo $this->_tpl_vars['config']['company']; ?>
<?php endif; ?> - ekolobok.com</title>
<meta name="description" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['config']['description'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", "")); ?>
" />
<meta name="keywords" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['config']['keyword'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", "")); ?>
" />
<meta name="author" content="B2Bbuilder Team and B2Bbuilder UI Team" />
<meta name="copyright" content="B2Bbuilder" />
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/prototype.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/index.js" type="text/javascript"></script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/page.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="pro.css" />
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
/image/default/icon.jpg) no-repeat right center; padding-right:15px;color:#1b77ba;">Регионы</a><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getSubCity', 'limit' => '1')), $this); ?>

				<?php else: ?>
					<?php if ($this->_tpl_vars['config']['isopencity']): ?>
					Текущий регион<?php if ($_COOKIE['PID'] == '' && $_COOKIE['CID'] == ''): ?><?php else: ?><?php echo $_COOKIE['PID']; ?>
 <?php echo $_COOKIE['CID']; ?>
<?php endif; ?>
						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/switch_city.php" style="background:url(<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/icon.jpg) no-repeat right center; padding-right:15px;color:#1b77ba;">Изменить регион</a>
					<?php endif; ?>
				<?php endif; ?>
</span> 
  </div>
</div>
<div id="wrapper">
	<div id="wrap_top">
        <div id="wrap">
        <div class="gray">
            <div id="logo">
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
">
			<img src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/logo.gif<?php endif; ?>" />
			</a>
            </div>
            <div id="logo_ad">
				<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=1&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
			</div>
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
        </div>
        <div id="navad">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="s_l"></td>
            <td id="navsearch">
			    <?php if ($_GET['m'] != '' && $_GET['m'] != 'quoted_price'): ?>
                    <form method="get" name="sear" id="sear" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/">
                    <input id="m" name="m" type="hidden" value="<?php echo $_GET['m']; ?>
" />
                    <input id="s" name="s" type="hidden" value="<?php echo $_GET['m']; ?>
_list" />
                <?php else: ?>
                    <form method="get" name="sear" id="sear" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/">
                    <input id="m" name="m" type="hidden" value="product" />
                    <input id="s" name="s" type="hidden" value="product_list" />
                <?php endif; ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="130px" style="text-align:left">
                <select id="search_type" style="width:120px; height:24px; text-align:left;color:#707070;" class="selectnav" name="type" onchange="select_form(this.value,'<?php echo $this->_tpl_vars['config']['weburl']; ?>
')">
                    <!--

<option value="product" <?php if ($this->_tpl_vars['current'] == 'product'): ?>selected="selected"<?php endif; ?> >Продукты</option>

-->
                    <option value="offer" <?php if ($this->_tpl_vars['current'] == 'offer'): ?>selected="selected"<?php endif; ?> >Предложения</option>
                    <option value="demand" <?php if ($this->_tpl_vars['current'] == 'demand'): ?>selected="selected"<?php endif; ?> >Спрос</option> 
                    <option value="company" <?php if ($this->_tpl_vars['current'] == 'company'): ?>selected="selected"<?php endif; ?> >Компании</option>
                    <option value="news" <?php if ($this->_tpl_vars['current'] == 'news'): ?>selected="selected"<?php endif; ?> >Новости</option>
					                    <!--

                    <option value="exhibition" <?php if ($this->_tpl_vars['current'] == 'exhibition'): ?>selected="selected"<?php endif; ?> >Выставки</option>
					-->
                </select>
                <script>
                  if('<?php echo $this->_tpl_vars['current']; ?>
'=='home') $('search_type').onchange();
                </script>
                </td>
                    <td width="312px"><input autocomplete="off" onkeyup="get_search_word(this.value);" value="<?php echo $_GET['key']; ?>
" type="text" class="editbox" id="key" name="key"/></td>
                    <td width="97px"><input type="submit" class="button" value="" /></td>
                    
                    <td>
                      <span> 
                        <?php if ($this->_tpl_vars['current'] == 'product' || $this->_tpl_vars['current'] == 'offer' || $this->_tpl_vars['current'] == 'home' || $this->_tpl_vars['current'] == 'demand' || $this->_tpl_vars['current'] == 'company'): ?> 
                          <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php<?php if ($this->_tpl_vars['current'] == 'product'): ?>?stype=2<?php elseif ($this->_tpl_vars['current'] == 'offer' || $this->_tpl_vars['current'] == 'home'): ?>?stype=1<?php elseif ($this->_tpl_vars['current'] == 'demand'): ?>?stype=1&m=demand<?php elseif ($this->_tpl_vars['current'] == 'company'): ?>?stype=3<?php endif; ?>">Расширенный поиск &raquo;</a>
                        <?php else: ?>
                          &nbsp;
                        <?php endif; ?>
                      </span>
                    </td>
                    
                  </tr>
                </table>
				</form>
            </td>
            <td class="s_r"></td>
          </tr>
        </table>
        </div>
	</div>
<script>
function get_search_word(k)
{
	if(k!='')
	{
		var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
		var sj = new Date();
		var pars = 'shuiji=' + sj+'&search_flag=1&key='+k;
		var myAjax = new Ajax.Request(
					url,
					{method: 'post', parameters: pars, onComplete: showResponse}
					);
	}
	function showResponse(originalRequest)
	{
		if(originalRequest.responseText!='')
		{
			$('key_select').style.display='block';
			$('key_select').innerHTML=originalRequest.responseText;
		}
		else
			$('key_select').style.display='none';
	}
	
}
function select_word(v)
{
	$('key').value=v;
	$('key_select').style.display='none';
}
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter17906014 = new Ya.Metrika({id:17906014, enableAll: true, webvisor:true});
        } catch(e) { }
    });
    
    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/17906014" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Google.Analytics counter -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36340715-1']);
  _gaq.push(['_setDomainName', 'ekolobok.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Google.Analytics counter -->