<?php /* Smarty version 2.6.20, created on 2013-01-12 19:54:03
         compiled from exhibition_showroom.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'exhibition_showroom.htm', 35, false),)), $this); ?>
<style>
.hot_zhanhui{
	margin:0 auto 5px auto;
	border-bottom:1px silver dashed; padding-bottom:10px;
}
.hot_zhanhui a:visited,.hot_zhanhui a:link{
	text-decoration:none;
	color:#333;
}
.hot_zhanhui a:hover{
	text-decoration:underline;
	color:#ff6600;
}
.hot_zhanhui_logo{
	width:80px;
	height:50px;
	padding:4px;
	overflow:hidden;
	float:left;
}
.hot_zhanhui_logo img{ width:80px; height:50px;}
.hot_zhanhui_item{
	float:right;
	width:175px;
	height:22px;
	line-height:22px;
	overflow:hidden;
	color:#333;
}
</style>
<?php $_from = $this->_tpl_vars['showroom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
<ul class="hot_zhanhui">
				<li class="hot_zhanhui_logo"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_list&sroom=<?php echo $this->_tpl_vars['list']['show_room_name']; ?>
"><img src="<?php echo $this->_tpl_vars['list']['show_room_pic']; ?>
"></a></li>
				<li class="hot_zhanhui_item"><strong><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_list&sroom=<?php echo $this->_tpl_vars['list']['show_room_name']; ?>
"><?php echo $this->_tpl_vars['list']['show_room_name']; ?>
</a></strong></li>
				<li class="hot_zhanhui_item">Описание: <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['show_room_intro'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</li>
				<li class="hot_zhanhui_item">Расположение: <?php echo $this->_tpl_vars['list']['show_room_addr']; ?>
</li>
                <li style="clear:both;"></li>
</ul>
<?php endforeach; endif; unset($_from); ?>