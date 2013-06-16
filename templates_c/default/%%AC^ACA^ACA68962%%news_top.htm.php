<?php /* Smarty version 2.6.20, created on 2013-01-12 15:02:55
         compiled from news_top.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'news_top.htm', 5, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
	<div style="display:inline;padding-right:10px">
	<a href="<?php echo $this->_tpl_vars['list']['url']; ?>
" title="<?php echo $this->_tpl_vars['list']['title']; ?>
">
  <img alt="<?php echo $this->_tpl_vars['list']['title']; ?>
" src="<?php echo $this->_tpl_vars['list']['pic']; ?>
" title="<?php echo $this->_tpl_vars['list']['title']; ?>
"></a>
 <!-- <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['ftitle'])) ? $this->_run_mod_handler('truncate', true, $_tmp, $this->_tpl_vars['leng']) : smarty_modifier_truncate($_tmp, $this->_tpl_vars['leng'])); ?>
 -->
 
</div>
<?php endforeach; endif; unset($_from); ?>