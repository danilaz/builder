<?php /* Smarty version 2.6.20, created on 2013-01-13 15:54:05
         compiled from admin_accounts_base.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'admin_accounts_base.htm', 16, false),)), $this); ?>
<script type="text/javascript" src="script/Validator.js"></script>
<script language="javascript" src="script/Calendar.js"></script>
	<div class="admin_right_top"><?php echo $this->_tpl_vars['lang']['page_title']; ?>
</div>

	<table width='100%' border="0" cellpadding="7" cellspacing="1" bgcolor="#DDDDDD" class="admin_table">

        <?php if ($_GET['pickup'] == 1): ?>
  <tr> 
	<td align="left" bgcolor="#EAEFF3" colspan="2">
            <?php echo $this->_tpl_vars['lang']['desc_one']; ?>

    </td>
  </tr>
         <?php endif; ?>
  <tr>
	<td width='18%' height="24" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['cash_one']; ?>
</td>
	<td width='82%' bgcolor="#FFFFFF"><?php echo ((is_array($_tmp=$this->_tpl_vars['re']['cash'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
 <?php echo $this->_tpl_vars['config']['money']; ?>
</td>
  </tr>
  <tr>
	<td width='18%' height="24" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['cash_two']; ?>
</td>
	<td width='82%' bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['re']['unreachable']; ?>
 <?php echo $this->_tpl_vars['config']['money']; ?>
</td>
  </tr>
  <tr>
	<td height="24" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['cash_backup']; ?>
<?php if ($this->_tpl_vars['re']['bank'] && $this->_tpl_vars['re']['active'] == 0): ?><font color="red">(<?php echo $this->_tpl_vars['lang']['cash_a']; ?>
)</font><?php endif; ?><?php if ($this->_tpl_vars['re']['bank'] && $this->_tpl_vars['re']['active'] == 1): ?><font color="blue">(<?php echo $this->_tpl_vars['lang']['cash_b']; ?>
)</font><?php endif; ?></td>
	<td bgcolor="#FFFFFF"><?php if ($this->_tpl_vars['re']['bank']): ?><?php echo $this->_tpl_vars['re']['bank']; ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['re']['accounts']; ?>
 &nbsp;&nbsp;<?php echo $this->_tpl_vars['re']['master']; ?>
<?php else: ?><a href="?menu=<?php echo $_GET['menu']; ?>
&action=admin_accounts_bind"><?php echo $this->_tpl_vars['lang']['cash_c']; ?>
</a><?php endif; ?></td>
  </tr>
</table>