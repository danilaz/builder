<?php /* Smarty version 2.6.20, created on 2013-01-12 15:35:45
         compiled from admin_msg.htm */ ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="admin_right_top"><?php echo $this->_tpl_vars['lang']['notice']; ?>
</div>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="219" align="left" style="font-size:12px; padding-left:100px;">
	<strong>
		<h3>
			<?php if ($_GET['type'] == 'reg_next'): ?>
				<?php echo $this->_tpl_vars['lang']['reg_next']; ?>

			<?php endif; ?>
			<?php if ($_GET['type'] == 'active'): ?>
				<?php echo $this->_tpl_vars['lang']['active']; ?>

			<?php endif; ?>
            <?php if ($_GET['type'] == 'access_dine'): ?>
				<?php echo $this->_tpl_vars['lang']['access_dine']; ?>

			<?php endif; ?>
		</h3>
	</strong>
	</td>
 </tr> 
</table>