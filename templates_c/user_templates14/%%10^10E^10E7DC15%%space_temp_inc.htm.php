<?php /* Smarty version 2.6.20, created on 2012-10-27 18:45:31
         compiled from space_temp_inc.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'space_temp_inc.htm', 6, false),array('function', 'geturl', 'space_temp_inc.htm', 163, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html"; charset=utf-8">
<title><?php echo $this->_tpl_vars['title']; ?>
-<?php echo $this->_tpl_vars['shopconfig']['hometitle']; ?>
-<?php echo $this->_tpl_vars['config']['company']; ?>
</title>
<meta name="description" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['description'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
,<?php echo $this->_tpl_vars['shopconfig']['homedes']; ?>
">
<meta name="keywords" content="<?php echo $this->_tpl_vars['keyword']; ?>
,<?php echo $this->_tpl_vars['shopconfig']['homekeyword']; ?>
">
</head>
<style type="text/css">
<!--
#imageFlow{top:700px; width:620px; left:410px; background-color:#CCCCCC;}
* { margin:0; padding:0; }
img { border:0; }
th { text-align:right; }
ul, li { list-style:none; }
<?php if ($this->_tpl_vars['shopconfig']['styleimg'] != ''): ?>
body { background-color:#006946;line-height:22px;}
<?php else: ?>
body { background-color:#006946;}
<?php endif; ?>
body,td {font-size:12px; line-height:22px; }
body, div, input, select, textarea, td { font-family:Arial, Tahoma, Verdana, Helvetica, sans-serif; }
img, input, select { vertical-align:middle }
ul, li {list-style:none;list-style-image:none;list-style-position:outside;list-style-type:none; margin:0px;}
a * { cursor:pointer; }
a:link, a:visited {color:#000000; text-decoration:none;}
a:hover {color:#000000; text-decoration:underline;}

#top { margin-left:auto; margin-right:auto; background-image:url(<?php echo $this->_tpl_vars['img']; ?>
topBg.gif); background-repeat:repeat-x; height:24px; line-height:24px; font-size: 12px; border-bottom:1px solid #C4C4C4; border-top:1px solid #FFFFFF; padding-right:10px; padding-left:10px; clear:both; font-weight:bold; }
#top a { color:#022e9f }
#top a:hover { color:#E66D02 }

#header{ margin-left:10px;height:132px;width:1005px;}
.company_name div{color:#000; font-size:22px;}
.company_name span{color:#6C8AB5}
#name{ width:1005px; height:95px; margin-bottom:0px;background:url(<?php echo $this->_tpl_vars['img']; ?>
top.jpg) no-repeat;}
#name table{ float:left;}
#navmenu{ width:1005px; float:left; height:37px; margin-top:0px;}
#nav{height:37px;line-height:37px;overflow:hidden;font-size:12px;margin-left:0px;font-weight: bold; font-family:"arial,helvetica,verdana,sans-serif"; padding-left:35px; background:url(<?php echo $this->_tpl_vars['img']; ?>
/nav.jpg) repeat-x;}
#nav a {text-align:center; margin-left:1px; background:url(<?php echo $this->_tpl_vars['img']; ?>
line.jpg) no-repeat right; display:block; width:100px; height:37px;}
#nav a:link, #nav a:hover, #nav a:visited {cursor:pointer;display:block !important;display:inline;zoom:1; text-decoration:none;float:left;}
#nav a:link, #nav a:visited {color:#fff;background-repeat: no-repeat;background-position:right top;}
#nav a:hover {color:#000;text-decoration:none;}
#nav .now:link, #nav .now:visited, #nav .now:hover {color:#000;text-decoration:none;}


#main { margin-left:10px;background:url(<?php echo $this->_tpl_vars['img']; ?>
/con_bg.jpg) #FFF repeat-x top;overflow:hidden; width:1005px;}
#menu {float:left;font-size:12px;margin-right:10px;line-height:1.3; width:225px; margin-top:14px;}
.tp { margin-left:10px;height:292px; width:1005px;}
#menu .bt {display:none;}
.item { line-height:37px; background:url(<?php echo $this->_tpl_vars['img']; ?>
/l_tit.jpg) no-repeat; width:225px;  height:37px;font-weight:bold;color:#FFFFFF;display:block;overflow:hidden;text-decoration: none;}
#menu .o a, #menu .o span{color:#1a498e;background-color:#f8a829; background-image:url(<?php echo $this->_tpl_vars['img']; ?>
leftTitleBg.gif);background-repeat:repeat-x;background-position:left top;}
.item span {display:block;padding-left:25px; font-size:14px; height:37px; line-height:37px;}
#menu div.now a, #menu div.now span {color:#1a498e;background-color:#f8a829;background-image:url(<?php echo $this->_tpl_vars['img']; ?>
leftTitleBg.gif) ;background-repeat:repeat-x;background-position:left top;}

#mProtop {padding-left:30px; padding-right:30px;margin-top:0px; background:url(<?php echo $this->_tpl_vars['img']; ?>
/l_bg.jpg) no-repeat; width:165px; height:15px;}

#mPro {padding:30px; padding-top:5px;margin-top:0px; background:url(<?php echo $this->_tpl_vars['img']; ?>
/l_bg_bot.jpg); width:165px; height:268px;background-position:bottom; float:left;}
#mPro li{ background:url(<?php echo $this->_tpl_vars['img']; ?>
line2.jpg) no-repeat left bottom;}
#mPro .now {padding:5px 25px 5px 25px;background-color:#ffffff;color:#1a498e;border-bottom:1px solid #295690;}
#mPro li a:link, #mPro li a:visited { color:#000;padding:5px 25px 5px 25px;margin:0px; height:18px;}
#mPro li a:hover {padding:5px 25px 5px 25px;color:#FF0000;margin:0px;}
#mPro div.r {margin:0px;padding:5px;background-color:#7e8c97;}
#mPro div.r a:link, #mPro div.r a:visited {color:#eef2f7;}
#mPro div.r li a:link, #mPro div.r li a:visited {background-image:none;}
#mPro #moreCat {border:1px solid #295690;width:170px;margin-left:215px;>margin-left:0px;margin-top:-15px; margin-top:5px;padding: 0px;}

#mPro div.r { padding-right:10px; padding-top:5px; }
#mPro div.r a:link, #mPro div.r a:visited { text-decoration:underline;}
#mPro ul li a:link, #mPro ul li a:visited, div.r #moreCat a:link, div.r #moreCat a:visited { text-decoration:none; display:block }
#mPro .now { font-weight:bold; }
#mPro #moreCat { position:absolute; padding:10px; text-align: left; }
#mPro #moreCat ul li { padding-bottom:5px; padding-top:5px; }
#mPro li a{background:url(<?php echo $this->_tpl_vars['img']; ?>
icon2.jpg) no-repeat left center;}
#content { float:right;width:760px; margin-top:14px;}
#bottom { margin-left:10px; margin-top:10px;padding-top:10px; height:132px; background:url(<?php echo $this->_tpl_vars['img']; ?>
bottom.jpg) #fff repeat-x left top;text-align:center; width:1005px;}


.common_box{ width:100%; margin-bottom:5px; background-color:#FFFFFF;}
.common_box2{ width:494px; margin-bottom:5px; background-color:#FFFFFF;}
.common_box table{border-collapse:collapse;}
.common_box td{ padding-bottom:10px; padding-right:15px;}
.guide_ba{ line-height:42px; background:url(<?php echo $this->_tpl_vars['img']; ?>
/titbg2.jpg) no-repeat;font-weight:bold; width:494px; height:42px;color:#fff;text-align:left;}
.guide_ba2{ background:url(<?php echo $this->_tpl_vars['img']; ?>
/titbg.jpg) no-repeat;font-weight:bold;  height:42px;color:#fff;text-align:left;}
.guide_ba span,.guide_ba2 span{ padding-left:15px; margin-left:10px; }
.guide_ba img{ margin-right:15px;}
.guide_ba2 img{ margin-left:230px;}
.info_text{text-align:left}

.li_pro_list{ padding-top:0px!important; padding-top:5px; width:100%; height:90px; background-color:#FFFFFF;}
.li_pro_list li{width:85px; height:90px;float:left;}
.li_pro_list li img{width:82px; height:75px;padding:3px;}
.li_pro_list_img{width:85px; float:left}
.li_pro_list_con{float:right; width:620px;}
.pro_list_col{float:left; margin-left:7px;}
.pro_list_col img{width:150px; height:150px; border:1px solid #CCCCCC; padding:1px;}

.com_intro{ background-color:#FFFFFF;}
.shop_pro_list{ padding-top:0px!important; padding-top:5px; width:100%; height:auto; background-color:#FFFFFF;}
.shop_pro_list li{width:95px;float:left;margin-left:10px;}
.shop_pro_list li img{width:92px; height:80px;padding:3px;}
.newoffer{padding-top:0px!important; padding-top:5px; width:100%;background-color:#FFFFFF;}
.newoffer li{width:100%; padding:3px;}
.content{margin:0px;background-image: url(<?php echo $this->_tpl_vars['img']; ?>
main_info_bg.jpg) ;background-repeat:repeat-x;background-position:left top;}
.com_contact{background-color:#FFFFFF;}
.mb_main{ width:1026px; height:auto;display:block;margin-left:auto; margin-right:auto; margin-top:0px;background-color:#FFF;}
.com_contact tr{ width:225px;}
#link{line-height:46px; border:1px solid #dbdbdb; padding-left:60px; background:url(<?php echo $this->_tpl_vars['img']; ?>
/link.jpg) no-repeat left; height:46px; clear:both; width:940px;}
#link a{ margin-right:15px;}
.links{ margin-left:340px; margin-top:30px;}
.links a{ margin-right:5px; background:left center; padding-left:15px;}
.links a,.links a:visited,.links a:hover{ color:#FFF;}
.links a:hover{ text-decoration:underline;}
.probox{display:block; width:150px; margin:3px; text-align:center;}
.padding10{padding:5px;}
.borderC {border-bottom:1px dashed #cccccc}
-->
</style>
<body>
<?php if ($this->_tpl_vars['com']['jsbook'] && $_GET['action'] != 'mail'): ?>
<script src="api/mail_box_js.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=<?php echo $_GET['action']; ?>
" type=text/javascript></script>
<?php endif; ?>
<div id="top">
    <div style="float:left">
        <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><?php echo $this->_tpl_vars['config']['company']; ?>
</a> | <?php echo $this->_tpl_vars['lang']['mem_shop']; ?>
 <?php echo $this->_tpl_vars['com']['company']; ?>

    </div>
	<div style="float:right;margin-right:10px;margin-left:10px;background:#FFFFFF;height:30px;width:100px;text-algin:center;">
	<li style="margin-left:22px;"><font style="font-size:25px;color:#FF0000"><?php echo $this->_tpl_vars['com']['time_long']; ?>
</font> место</li>
    </div>
    <div style="float:right">
        <?php if ($this->_tpl_vars['buid']): ?>
        <a href="main.php"><?php echo $this->_tpl_vars['lang']['my_office']; ?>
</a><?php else: ?><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['config']['regname']; ?>
"><?php echo $this->_tpl_vars['lang']['free_reg']; ?>
</a> | 
        <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php"><?php echo $this->_tpl_vars['lang']['login']; ?>
</a><?php endif; ?> | 
        <a href="javascript:myAddPanel()"><?php echo $this->_tpl_vars['lang']['add_fav']; ?>
</a>
    </div>
</div>
<div class="mb_main">
<div id="header">
<div id="name">
<table width="420" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="130" height="100" align="center" valign="middle"><?php echo $this->_tpl_vars['com']['medal']; ?>
</td>
    <td width="320" align="left" class="company_name">
    	<div><strong><?php echo $this->_tpl_vars['com']['company']; ?>
</strong></div><span><?php if ($this->_tpl_vars['shopconfig']['home_advs_show'] == '1'): ?><?php echo $this->_tpl_vars['shopconfig']['home_advs_content']; ?>
<?php endif; ?></span>
    </td>
  </tr>
</table>
		<table width="220px" border="0" cellspacing="0" cellpadding="0" class="links"> 
  <tr>
    <td><a href="/" style="background:url(<?php echo $this->_tpl_vars['img']; ?>
/icon3.jpg) no-repeat">Главная</a> <a href="javascript:myAddPanel()" style="background:url(<?php echo $this->_tpl_vars['img']; ?>
/icon4.jpg) no-repeat">В избранное</a> <a href="#" style="background:url(<?php echo $this->_tpl_vars['img']; ?>
/icon5.jpg) no-repeat">Связь</a></td>
  </tr>
</table>

</div>

<div id="navmenu">
<div id="nav">
    <?php $_from = $this->_tpl_vars['shopconfig']['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        <?php if ($this->_tpl_vars['list']['menu_show'] == '1'): ?>
        	<?php if ($this->_tpl_vars['list']['menu_link'] != ''): ?>
       	<a <?php if ($this->_tpl_vars['list']['menu_link'] == $_GET['action']): ?>class="now" <?php endif; ?> href="shop.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=<?php echo $this->_tpl_vars['list']['menu_link']; ?>
&m=<?php echo $this->_tpl_vars['list']['module']; ?>
"><?php echo $this->_tpl_vars['list']['menu_name']; ?>
</a>
            <?php else: ?>
<a <?php if ($_GET['action'] == ''): ?>class="now" <?php endif; ?> href="<?php echo smarty_function_geturl(array('type' => '','user' => $this->_tpl_vars['com']['user'],'uid' => $this->_tpl_vars['com']['userid'],'tid' => '','com' => $this->_tpl_vars['com']['company']), $this);?>
"><?php echo $this->_tpl_vars['list']['menu_name']; ?>
</a>
            <?php endif; ?>
        <?php endif; ?>       
    <?php endforeach; endif; unset($_from); ?>
</div>
</div>
</div>
	<div class="tp"><img src="<?php echo $this->_tpl_vars['img']; ?>
flash.jpg" /></div>
    <div id="main">
    <div id="menu">
        <div class="item"><span><?php echo $this->_tpl_vars['lang']['pro_index']; ?>
</span></div>
		<div id="mProtop"></div>
        <div id="mPro" class="exp">
          <ul>    
           <?php $_from = $this->_tpl_vars['custom_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
<li><a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=offer_list&m=offer&cat=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['name']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
(<?php echo $this->_tpl_vars['list']['count']; ?>
)</a></li>
                <?php endforeach; endif; unset($_from); ?>
          </ul>
        </div>
        
</div>
    <div id="content">
		<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=46&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
    	<?php echo $this->_tpl_vars['output']; ?>

    </div>
	<?php if ($this->_tpl_vars['list']['link_name']): ?>
     <div id="link">
		<?php $_from = $this->_tpl_vars['ulink']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
			<a href="<?php echo $this->_tpl_vars['list']['link_url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['list']['link_name']; ?>
</a>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<?php endif; ?>
</div>

<div id="bottom">
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
   <td height="62" align="center" valign="middle">
<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><?php echo $this->_tpl_vars['config']['company']; ?>
</a><br />
	<?php echo $this->_tpl_vars['lang']['web_other']; ?>
 <a href="?m=company"><?php echo $this->_tpl_vars['lang']['company_cat']; ?>
</a> , <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product"><?php echo $this->_tpl_vars['lang']['pro_dir']; ?>
</a>, <a href="?m=offer"><?php echo $this->_tpl_vars['lang']['offer_dir']; ?>
</a><br />
	<?php echo $this->_tpl_vars['lang']['web_des']; ?>
      </tr>
  <tr>
 <td height="44" align="center" valign="middle" style="color:#000000"><?php echo $this->_tpl_vars['bt']; ?>
</td>
</table>
</div>

<script>
function myAddPanel()
{
	var title="<?php echo $this->_tpl_vars['config']['company']; ?>
";
	var url="<?php echo $this->_tpl_vars['config']['weburl']; ?>
";
	var desc="<?php echo $this->_tpl_vars['config']['company']; ?>
";
	
	if ((typeof window.sidebar == 'object') && (typeof window.sidebar.addPanel == 'function'))
		window.sidebar.addPanel(title,url,desc);
	else
		window.external.AddFavorite(url,title);
}
</script>
</div>
</body>
</html>