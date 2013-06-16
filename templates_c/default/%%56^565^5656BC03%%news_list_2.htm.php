<?php /* Smarty version 2.6.20, created on 2013-01-12 18:00:27
         compiled from news_list_2.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'news_list_2.htm', 8, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
<div>  
    <div style="text-align:center;">
        <a target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" href="<?php echo $this->_tpl_vars['list']['url']; ?>
">
           <img width="100" height="100" src="<?php echo $this->_tpl_vars['list']['pic']; ?>
" />
        </a>
	<div style="text-align:center;">
        <a target="_blank" <?php echo $this->_tpl_vars['list']['style']; ?>
  title="<?php echo $this->_tpl_vars['list']['title']; ?>
" href="<?php echo $this->_tpl_vars['list']['url']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['ftitle'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 120) : smarty_modifier_truncate($_tmp, 120)); ?>
</a>
    </div>
    </div>
</div>
<?php endforeach; endif; unset($_from); ?>