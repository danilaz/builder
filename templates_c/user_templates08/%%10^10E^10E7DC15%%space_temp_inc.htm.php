<?php /* Smarty version 2.6.20, created on 2012-10-29 21:28:30
         compiled from space_temp_inc.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'space_temp_inc.htm', 6, false),array('function', 'geturl', 'space_temp_inc.htm', 145, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
#imageFlow{top:615px; width:620px; left:410px; background-color:#CCCCCC;}
* { margin:0; padding:0; }
img { border:0; }
th { text-align:right; }
ul, li { list-style:none; }
<?php if ($this->_tpl_vars['shopconfig']['styleimg'] != ''): ?>
	body {background-image: url(<?php echo $this->_tpl_vars['shopconfig']['styleimg']; ?>
);}
<?php else: ?>
	body {BACKGROUND: #500109;}
<?php endif; ?>
body,td {font-size:12px; line-height:22px; }
body, div, input, select, textarea, td { font-family:Arial, Tahoma, Verdana, Helvetica, sans-serif; }
img, input, select { vertical-align:middle }
ul, li {list-style:none;list-style-image:none;list-style-position:outside;list-style-type:none; margin:0px;}
a * { cursor:pointer; font-size:14px; font-weight:100; }
a:link, a:visited {color: #006699; text-decoration:none;}
a:hover {color: #FF9900;}

#top { width:100%; border-bottom:1px #CCCCCC solid;background-image:url(<?php echo $this->_tpl_vars['img']; ?>
vip_header_bg01.gif); background-repeat:repeat-x; height:26px; line-height:26px; }
#top1{ width:980px; margin:0px auto;height:26px; line-height:26px; font-size: 12px; padding-right:10px; padding-left:10px; clear:both;}
#top1 a { color: #006699; text-decoration:none; }
#top1 a:hover { color: #FF6600; }

#header{background:url(<?php echo $this->_tpl_vars['img']; ?>
header.gif) repeat-x scroll center top;clear:both;height:204px;margin:auto;width:980px;}
.company_name h1{color:#FFFFFF; height:32px; line-height:32px;}
.company_name span{color:#6C8AB5}
#name{ height:204px;<?php if ($this->_tpl_vars['shopconfig']['headimage'] != ''): ?>background:#284B75 url(<?php echo $this->_tpl_vars['shopconfig']['headimage']; ?>
) scroll center top;<?php endif; ?>}

#navmenu{ width:980px; margin:0px auto; margin-bottom:5px;background:url(<?php echo $this->_tpl_vars['img']; ?>
menunav.jpg) repeat-x;}
#nav{height:55px;line-height:55px;overflow:hidden;font-size:14px;margin-left:70px;}
#nav a {margin-left:1px;}
#nav a:link, #nav a:hover, #nav a:visited {cursor:pointer;display:block !important;display:inline;zoom:1; padding-right:15px;padding-left:15px;text-decoration:none;float:left;}
#nav a:link, #nav a:visited {color:#FFFFFF;background-repeat: no-repeat;background-position:right top;}
#nav a:hover {background-position:left top;color: #FF0000;text-decoration:none;}
#nav .now:link, #nav .now:visited, #nav .now:hover {background-position:left top;color: #FF9900;text-decoration:none;}


#main {display:block;zoom:1;overflow:hidden;width:970px;background-color:#E3DCC1;background-position:left top;padding:0px 10px 0px 0px;margin:auto;height:100%;}
#main .tp {display:block;line-height:10px;background-color:#E3DCC1;height:10px;}

#menu {width: 220px;float:left;font-size:12px;margin-right:10px}
#menu .tp { display:none; line-height:54px; height:54px; }
#menu .bt {display:none;}
#menu .item {zoom:1;font-weight:bold; margin-bottom:2px; margin-top:2px;color:#FFFFFF;display:block;overflow:hidden;background: url(<?php echo $this->_tpl_vars['img']; ?>
left.jpg);background-repeat:repeat-x;background-position:left top;text-decoration: none;border-bottom:1px solid #ccc;}
#menu .o a, #menu .o span, #menu .item a:hover, #menu .item a:hover span {color:#1a498e;}
#menu .item span {display:block;padding:5px 25px 5px 45px; color:red;font-weight:bold; }
#menu div.now a, #menu div.now span {color:#ffffff;background-color:#ffffff;background-image: url(<?php echo $this->_tpl_vars['img']; ?>
left.jpg) ;background-repeat:repeat-x;background-position:left top;}

#mPro {padding:0px;margin-top:0px;}
#mPro .now {padding:5px 25px 5px 25px;background-color:#F5EEE0;color:#1a498e;border-bottom:1px solid #ccc;}
#mPro li a:link, #mPro li a:visited {padding:5px 25px 5px 25px;background-color:#ffffff;color:#000000; margin:0px; height:18px;}
#mPro li a:hover {padding:5px 25px 5px 25px;background-color:#ffffff;color:#FF0000; margin:0px;}
#mPro div.r {margin:0px;padding:5px;background-color: #F5EEE0;}
#mPro div.r a:link, #mPro div.r a:visited {color:#ffffff;}
#mPro div.r li a:link, #mPro div.r li a:visited {background-image:none;}
#mPro #moreCat {border:1px solid #CCCCCC;width:170px;margin-left:215px;margin-left:0px;margin-top:-15px; margin-top:5px;padding: 0px;}

#menu { line-height:1.3 }
#mPro div.r { padding-right:10px; padding-top:2px; }
#mPro div.r a:link, #mPro div.r a:visited { text-decoration:underline; }
#mPro ul li a:link, #mPro ul li a:visited, div.r #moreCat a:link, div.r #moreCat a:visited { text-decoration:none; display:block }
#mPro .now { font-weight:bold; }
#mPro #moreCat { position:absolute; padding:10px; text-align: left; }
#mPro #moreCat ul li { padding-bottom:5px; padding-top:5px; }
#content {float:right;width:740px;}
#bottom {padding-bottom:10px;padding-right:10px;margin-top:10px;text-align:right;margin:auto;width:970px;background-image:url('<?php echo $this->_tpl_vars['img']; ?>
1268011518.gif'); }
#bottom a{color:#FF6600;}
.exp{background-color: #F5EEE0;}
.exp{border:1px solid #F5F5F5;}
.exp li{margin-bottom:2px;}
#supply,#news{ width:366px; float:left;}
.clear{ clear:both;}
.guide_ba img{ float:right; margin-right:5px;}

.common_box{margin-bottom:5px; background-color: #E3DCC1;}
.common_box table{border-collapse:collapse;}
.common_box td{border:1px solid #ccc; padding:3px; text-align:left}
.guide_ba{background-image:url('<?php echo $this->_tpl_vars['img']; ?>
right.jpg'); text-align:left; padding:5px;}
.guide_ba span{margin-left:15px; font-size:14px; font-weight:bold;}
.info_text{text-align:left}

.li_pro_list{ padding-top:0px!important; padding-top:5px; width:100%; height:90px; background-color:#FFFFFF;}
.li_pro_list li{width:85px; height:90px;float:left;}
.li_pro_list li img{width:82px; height:75px;padding:3px;}
.li_pro_list_img{width:85px; float:left}
.li_pro_list_con{float:right; width:620px;}
.pro_list_col{float:left; margin-left:7px;}
.pro_list_col,.probox img{border:1px solid #CCCCCC; padding:1px; width:150px; height:150px;}
.com_intro{ background-color: #EEDEC6;}
.shop_pro_list{ padding-top:0px!important; padding-top:5px; width:100%; height:auto; background-color:#FFFFFF;}
.shop_pro_list li{width:95px;float:left;margin-left:10px;}
.shop_pro_list li img{width:92px; height:80px;padding:3px;}
.newoffer{padding-top:0px!important; padding-top:5px; width:100%;background-color:#FFFFFF;}
.newoffer li{width:100%; padding:3px;}
.content{margin:0px;background-image: url(<?php echo $this->_tpl_vars['img']; ?>
main_info_bg.jpg) ;background-repeat:repeat-x;background-position:left top;}
.com_contact{background-color:#FFFFFF;}
.borderC {border-bottom:1px dashed #cccccc}
.padding_10{padding:10px}
.padding_20{padding:20px}
</style>
<body>
<?php if ($this->_tpl_vars['config']['jsbook'] && $_GET['action'] != 'mail'): ?>
	<script src="api/mail_box_js.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=<?php echo $_GET['action']; ?>
" type=text/javascript></script>
<?php endif; ?>
<div id="top">
    <div id="top1">
		<div style="float:left">
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><?php echo $this->_tpl_vars['config']['company']; ?>
</a> 
		</div>
		<div style="float:right">
			<?php if ($this->_tpl_vars['buid']): ?>
				<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php"><?php echo $this->_tpl_vars['lang']['my_office']; ?>
</a>
			<?php else: ?>
				<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['config']['regname']; ?>
"><?php echo $this->_tpl_vars['lang']['free_reg']; ?>
<?php echo $this->_tpl_vars['config']['company']; ?>
</a> | 
				<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php"><?php echo $this->_tpl_vars['lang']['login']; ?>
</a>
			<?php endif; ?> | <a href="javascript:myAddPanel()"><?php echo $this->_tpl_vars['lang']['add_fav']; ?>
</a>
		</div>
	</div>
</div>
<div style="margin:0px auto; width:980px;background:url(/templates/user_templates8/img/1267842676.jpg) no-repeat;">
<table width="965" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="220" height="130" align="center" valign="middle"><?php if ($this->_tpl_vars['com']['logo']): ?><img width="100" height="100" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/userimg/<?php echo $this->_tpl_vars['com']['logo']; ?>
" align="middle" /><?php endif; ?></td>
    <td width="900" align="left" valign="middle" class="company_name">
    	<h2 style=" margin-top:5px;margin-left:10px; font-weight: bold;"><font color="#ffffff"><?php echo $this->_tpl_vars['com']['company']; ?>
</FONT></h2><br/><span style=" margin-top:5px;margin-left:10px; font-weight: bold;"><?php if ($this->_tpl_vars['shopconfig']['home_advs_show'] == '1'): ?><?php echo $this->_tpl_vars['shopconfig']['home_advs_content']; ?>
<?php endif; ?></span>  </td>
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
<div id="header">
<div id="name"></div>
</div>
<div id="main">
	<div class="tp"></div>
    <div id="menu">
		
		<?php if ($this->_tpl_vars['custom_cat']['0']['name']): ?>
        <div class="item"><a style="margin-left:20px;" href="#"><span><?php echo $this->_tpl_vars['lang']['pro_index']; ?>
</span></a></div>
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
        <?php endif; ?>
		
        <div class="item" style="background:url('<?php echo $this->_tpl_vars['img']; ?>
left.jpg')"><a style="margin-left:20px;" href="#"><span><?php echo $this->_tpl_vars['lang']['jslx']; ?>
</span></a></div>
         <div id="mPro" class="exp">
         <ul>
			 <li><span><a href="shop.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=mail"><?php echo $this->_tpl_vars['lang']['contact']; ?>
<?php echo $this->_tpl_vars['com']['contact']; ?>
</a><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?action=m&m=friend&s=admin_friends&friendid=<?php echo $this->_tpl_vars['com']['userid']; ?>
"><?php echo $this->_tpl_vars['lang']['addtomyfriend']; ?>
</a></span></li>
             <?php if ($this->_tpl_vars['com']['qq']): ?>
            <li class="qq"><a title="<?php echo $this->_tpl_vars['com']['qq']; ?>
" target=blank href=tencent://message/?uin=<?php echo $this->_tpl_vars['com']['qq']; ?>
&Site=<?php echo $this->_tpl_vars['config']['company']; ?>
&Menu=yes>Q Q：<img src='http://is.qq.com/webpresence/images/status/10_online.gif' border="0"></a></li>
            <?php endif; ?>
            <li><a href="msnim:chat?contact=<?php echo $this->_tpl_vars['com']['msn']; ?>
">MSN:<img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/ico_msn.gif" /></a></li>
            <li><a href="#">SKYPE:<?php echo $this->_tpl_vars['com']['skype']; ?>
</a></li>
         </ul>
         </div>
         
         <div class="item" style="background:url('<?php echo $this->_tpl_vars['img']; ?>
left.jpg')"><a style="margin-left:20px;" href="#"><span><?php echo $this->_tpl_vars['lang']['com_link']; ?>
</span></a></div>
         <div id="mPro" class="exp" style="border: #FFFFFF 1px solid;">
             <ul>
                <?php $_from = $this->_tpl_vars['ulink']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                	<li><a href="<?php echo $this->_tpl_vars['list']['link_url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['list']['link_name']; ?>
</a></li>
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
</div>

<div id="bottom" style="margin-top:5px; border-top:1px #CCCCCC solid; color:#FFCC33;">
<table  width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    
    <td align="center" valign="top">
    <?php echo $this->_tpl_vars['lang']['tgs']; ?>
 <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><?php echo $this->_tpl_vars['config']['company']; ?>
</a><br />
	<?php echo $this->_tpl_vars['lang']['web_other']; ?>
 <a href="?m=company"><?php echo $this->_tpl_vars['lang']['company_cat']; ?>
</a> , <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product"><?php echo $this->_tpl_vars['lang']['pro_dir']; ?>
</a> , <a href="?m=offer"><?php echo $this->_tpl_vars['lang']['offer_dir']; ?>
</a><br />
	<?php echo $this->_tpl_vars['lang']['web_des']; ?>

    </td>
  </tr>
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
</body>
</html>