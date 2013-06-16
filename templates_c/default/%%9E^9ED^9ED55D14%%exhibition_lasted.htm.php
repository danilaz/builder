<?php /* Smarty version 2.6.20, created on 2013-01-12 19:54:03
         compiled from exhibition_lasted.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'exhibition_lasted.htm', 4, false),array('modifier', 'strip_tags', 'exhibition_lasted.htm', 5, false),array('modifier', 'date_format', 'exhibition_lasted.htm', 9, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['exhibition']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nums'] => $this->_tpl_vars['list']):
?>
<?php if ($this->_tpl_vars['nums'] == 0): ?>
<!--
<div class="zhanhui_news_title"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 32, "...", true) : smarty_modifier_truncate($_tmp, 32, "...", true)); ?>
</a></div>
<div class="zhanhui_news_con"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 160, "...", true) : smarty_modifier_truncate($_tmp, 160, "...", true)); ?>
</div>
-->
<ul>
<?php endif; ?>
	<li class="zhanhui_news_ul_title">·<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['title']; ?>
</a></li><li class="zhanhui_news_ul_date"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['addTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</li>
<?php endforeach; endif; unset($_from); ?>

</ul>