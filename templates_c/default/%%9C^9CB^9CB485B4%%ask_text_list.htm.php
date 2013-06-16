<?php /* Smarty version 2.6.20, created on 2013-01-12 15:02:55
         compiled from ask_text_list.htm */ ?>
<ul>
	<?php $_from = $this->_tpl_vars['ask']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
	<li>
	<?php if ($this->_tpl_vars['list']['reward']): ?><img src="image/default/mon.gif" /><?php endif; ?>
	<a href="?m=ask&s=question&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['list']['title']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>