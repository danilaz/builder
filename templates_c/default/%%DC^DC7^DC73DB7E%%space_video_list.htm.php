<?php /* Smarty version 2.6.20, created on 2013-01-13 22:24:04
         compiled from space_video_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'space_video_list.htm', 21, false),array('modifier', 'truncate', 'space_video_list.htm', 23, false),)), $this); ?>
<div class="common_box">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr align="left">
	<td class="guide_ba" colspan="2"><span><?php echo $this->_tpl_vars['lang']['company_video']; ?>
</span></td>
  	</tr>
      <?php $_from = $this->_tpl_vars['videolist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
	  <tr>
        <td width="11%" height="82" align="center" valign="middle"  >
			<a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=video_detail&id=<?php echo $this->_tpl_vars['list']['video_id']; ?>
&m=video" title="<?php echo $this->_tpl_vars['list']['name']; ?>
">
				<?php if ($this->_tpl_vars['list']['img_url'] != ''): ?>
					<img src="<?php echo $this->_tpl_vars['list']['img_url']; ?>
" width=80 />
				<?php else: ?>
					<img width=80 src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/nopic.gif"  alt="<?php echo $this->_tpl_vars['list']['name']; ?>
" />
				<?php endif; ?>
			</a>
		</td>
        <td width="89%" valign="top" >
			<a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=video_detail&id=<?php echo $this->_tpl_vars['list']['video_id']; ?>
&m=video" title="<?php echo $this->_tpl_vars['list']['name']; ?>
">
				<strong> &raquo; <?php echo $this->_tpl_vars['list']['name']; ?>
</strong>
			</a>
				<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

			<br />
			<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['desc'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 120, "...", true) : smarty_modifier_truncate($_tmp, 120, "...", true)); ?>

		</td>
      </tr>
	  <?php endforeach; else: ?>
	  <tr>
	    <td colspan="2" ><?php echo $this->_tpl_vars['lang']['no_video']; ?>
</td>
	    </tr>
	  <?php endif; unset($_from); ?> 
    </table>
</div>