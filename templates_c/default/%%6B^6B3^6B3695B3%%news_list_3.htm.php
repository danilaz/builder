<?php /* Smarty version 2.6.20, created on 2013-01-12 19:52:51
         compiled from news_list_3.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'news_list_3.htm', 9, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>

    <?php if ($this->_foreach['name']['iteration'] == 1): ?>  

      <h3><a target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" <?php echo $this->_tpl_vars['list']['style']; ?>
  href="<?php echo $this->_tpl_vars['list']['url']; ?>
"><?php echo $this->_tpl_vars['list']['ftitle']; ?>
</a></h3>

    <?php elseif ($this->_foreach['name']['iteration'] == 2): ?>

      <p class="nleft"> <a target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" <?php echo $this->_tpl_vars['list']['style']; ?>
  href="<?php echo $this->_tpl_vars['list']['url']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['ftitle'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 200) : smarty_modifier_truncate($_tmp, 200)); ?>
</a> </p>

    <?php elseif ($this->_foreach['name']['iteration'] == 3): ?>

      <p class="nright"> <a target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" <?php echo $this->_tpl_vars['list']['style']; ?>
  href="<?php echo $this->_tpl_vars['list']['url']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['ftitle'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 200) : smarty_modifier_truncate($_tmp, 200)); ?>
</a> </p>

      <?php else: ?>

        <li>

        	<a class="aa" target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" <?php echo $this->_tpl_vars['list']['style']; ?>
  href="<?php echo $this->_tpl_vars['list']['url']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['ftitle'])) ? $this->_run_mod_handler('truncate', true, $_tmp, $this->_tpl_vars['leng']) : smarty_modifier_truncate($_tmp, $this->_tpl_vars['leng'])); ?>
</a>

        </li>

     <?php endif; ?>  

<?php endforeach; endif; unset($_from); ?>