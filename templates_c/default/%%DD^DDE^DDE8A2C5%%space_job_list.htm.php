<?php /* Smarty version 2.6.20, created on 2013-01-14 22:36:50
         compiled from space_job_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'space_job_list.htm', 10, false),)), $this); ?>
<div class="common_box">
<table width="100%">
  <tr align="left">
    <td class="guide_ba"><span><?php echo $this->_tpl_vars['lang']['hr_list']; ?>
</span></td>
  </tr>
  <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
  <tr>
	<td>
	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $_GET['uid']; ?>
&action=job_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=job" title="<?php echo $this->_tpl_vars['projlist']['projecttitle']; ?>
" target="_blank">
	<?php echo $this->_tpl_vars['list']['title']; ?>
</a> (<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
)
	<div style="border-bottom:1px dashed #CCCCCC;"></div>
	</td>
  </tr>
  <?php endforeach; else: ?>
   <tr>
	<td ><?php echo $this->_tpl_vars['lang']['no_hr']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
</table>
<div class="page"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
</div>