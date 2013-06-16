<?php /* Smarty version 2.6.20, created on 2013-01-12 15:54:34
         compiled from space_demand_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'explode_one', 'space_demand_list.htm', 11, false),array('modifier', 'strip_tags', 'space_demand_list.htm', 23, false),array('modifier', 'truncate', 'space_demand_list.htm', 23, false),array('modifier', 'date_format', 'space_demand_list.htm', 25, false),array('function', 'html_image', 'space_demand_list.htm', 12, false),)), $this); ?>
<div class="common_box">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td class="guide_ba"><span><?php echo $this->_tpl_vars['lang']['demand_dir']; ?>
</span></td></tr>
<tr><td>
<?php $this->assign('list_type', $this->_tpl_vars['shopconfig']['shop_pro_list']); ?>
<?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
<?php if ($this->_tpl_vars['list_type'] == 1): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="border:none; border-bottom:1px #CCCCCC dashed;" width="100">
		<?php $this->assign('img', ((is_array($_tmp=$this->_tpl_vars['list']['pic'])) ? $this->_run_mod_handler('explode_one', true, $_tmp, ",") : smarty_modifier_explode_one($_tmp, ","))); ?>
		<?php echo smarty_function_html_image(array('file' => "uploadfile/zsimg/size_small/".($this->_tpl_vars['img']).".jpg",'width' => 100,'style' => "border:1px solid #CCCCCC; padding:1px",'alt' => $this->_tpl_vars['list']['title']), $this);?>

		</div>
	</td>
	<td valign="top" style="border:none; border-bottom:1px #CCCCCC dashed;">
	<img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/demand_<?php echo $this->_tpl_vars['list']['type']; ?>
.gif"/>
	<?php if ($this->_tpl_vars['com']['open_info_type']): ?>
	<a href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&action=demand_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=demand" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" target="_blank">
	<?php else: ?>
	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand&s=demand_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" target="_blank">
	<?php endif; ?>
	<strong><?php echo $this->_tpl_vars['company']['open_info_type']; ?>
<?php echo $this->_tpl_vars['list']['title']; ?>
</strong></a><br />
	<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 160, "...", true) : smarty_modifier_truncate($_tmp, 160, "...", true)); ?>

	</td>
	<td style="border:none; border-bottom:1px #CCCCCC dashed;" width="100"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
  </tr>
</table>
<?php else: ?>
<div class="pro_list_col" style="width:170px;">
	  <ul>
		<li>
		<div class="probox">
		<?php $this->assign('img', ((is_array($_tmp=$this->_tpl_vars['list']['pic'])) ? $this->_run_mod_handler('explode_one', true, $_tmp, ",") : smarty_modifier_explode_one($_tmp, ","))); ?>
		<img src="uploadfile/zsimg/size_small/<?php echo $this->_tpl_vars['img']; ?>
.jpg" alt=<?php echo $this->_tpl_vars['list']['title']; ?>
 />
		</div>
		</li>
		<li>
		<?php if ($this->_tpl_vars['com']['open_info_type']): ?>
		<a href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&action=demand_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=demand" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" target="_blank">
		<?php else: ?>
		<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand&s=demand_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" target="_blank">
		<?php endif; ?>
		<?php echo $this->_tpl_vars['company']['open_info_type']; ?>
<?php echo $this->_tpl_vars['list']['title']; ?>
</a>
		</li>
	 </ul>
</div>
<?php endif; ?>
<?php endforeach; else: ?>
	<?php echo $this->_tpl_vars['lang']['on_demands']; ?>

<?php endif; unset($_from); ?>

</td></tr>
</table>
	<div class="page" align="right"><?php echo $this->_tpl_vars['info']['page']; ?>
</div>
</div>