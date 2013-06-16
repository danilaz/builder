<?php /* Smarty version 2.6.20, created on 2013-01-12 20:01:26
         compiled from rexhibition_list_rec.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'rexhibition_list_rec.htm', 7, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['exhibition']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #DDDDDD; margin-bottom:1px;">
  <tr>
    <td height="22"><b><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['title']; ?>
</a></b></td>
  </tr>
  <tr>
    <td height="22"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['stime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 / <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['etime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
  </tr>
    <tr>
    <td height="22"><?php echo $this->_tpl_vars['list']['country']; ?>
 <?php echo $this->_tpl_vars['list']['city']; ?>
</td>
  </tr>
</table>

<?php endforeach; endif; unset($_from); ?>