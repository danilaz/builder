<?php /* Smarty version 2.6.20, created on 2013-02-02 12:12:23
         compiled from admin_resetpass.htm */ ?>
<form method="post" action="" enctype="multipart/form-data">
<div class="admin_right_top"><?php echo $this->_tpl_vars['lang']['ch_pass']; ?>
</div>
<table border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#DDDDDD" class="admin_table">
<?php if ($_GET['info']): ?>
<tr>
  <td width="18%" height="0" align="center" bgcolor="#EAEFF3"></td>
  <td width="82%" height="0" bgcolor="#FFFFFF" style="font-size:14px; color:#FF0000; font-weight:bold">
  <?php echo $this->_tpl_vars['lang']['notice']; ?>

        <?php if ($_GET['info'] == 1): ?>
        	<?php echo $this->_tpl_vars['lang']['old_erroy']; ?>

        <?php elseif ($_GET['info'] == 2): ?>
        	<?php echo $this->_tpl_vars['lang']['repat_erroy']; ?>

        <?php elseif ($_GET['info'] == 3): ?>
        	<?php echo $this->_tpl_vars['lang']['edit_suc']; ?>

        <?php endif; ?>
  </td>
</tr>
<?php endif; ?>
<tr>
  <td width="18%" align="right" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['cu_pass']; ?>
</td>
  <td bgcolor="#FFFFFF" width="82%"><input name="oldpass" type="password" id="oldpass" /></td>
</tr>
<tr>
  <td width="18%" align="right" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['new_pass']; ?>
</td>
  <td width="82%" bgcolor="#FFFFFF"><input name="newpass" type="password" id="newpass" /></td>
</tr>
<tr>
  <td width="18%" align="right" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['con_pass']; ?>
</td>
  <td width="82%" bgcolor="#FFFFFF"><input name="renewpass" type="password" id="renewpass" /></td>
</tr>
<tr bgcolor="#EAEFF3">
  <td align="center" bgcolor="#EAEFF3">&nbsp;</td>
  <td align="left" bgcolor="#FFFFFF">
  <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang']['submit']; ?>
" style="width:100px;" />
  <input name="action" type="hidden" id="action" value="submit" />
 </td>
</tr>	
</table>
</form>      