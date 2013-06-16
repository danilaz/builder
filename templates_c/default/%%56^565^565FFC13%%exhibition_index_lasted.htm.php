<?php /* Smarty version 2.6.20, created on 2013-01-12 15:02:55
         compiled from exhibition_index_lasted.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'exhibition_index_lasted.htm', 3, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['exhibition']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/exhibitimg/<?php echo $this->_tpl_vars['list']['pic']; ?>
.jpg"></a>
      <h4><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...", true) : smarty_modifier_truncate($_tmp, 200, "...", true)); ?>
</a>
      </h4>
    </li>
<?php endforeach; endif; unset($_from); ?>