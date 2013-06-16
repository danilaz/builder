<?php /* Smarty version 2.6.20, created on 2013-05-29 16:27:38
         compiled from job_index_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'job_index_list.htm', 4, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['jobs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
     <li style="padding-left:20px;border-bottom:1px dashed #cccccc">
	     <a  href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&action=job_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=job"><?php echo $this->_tpl_vars['list']['title']; ?>
</a>
         <a  href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['company'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30) : smarty_modifier_truncate($_tmp, 30)); ?>
</a>
    </li>         
<?php endforeach; endif; unset($_from); ?>