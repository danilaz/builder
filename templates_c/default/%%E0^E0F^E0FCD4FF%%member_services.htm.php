<?php /* Smarty version 2.6.20, created on 2013-01-13 02:43:56
         compiled from member_services.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <strong><a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['mservices']; ?>
</strong>
    </div>
    <div class="headtop_R"></div>		
</div>

<div id="mainbody1" class="topm">
<table width='100%' border="0" cellpadding="5" cellspacing="1" bgcolor="#E4E4E4" class="member_sev"> 
	<tr class="title4">
      <td width="200"><?php echo $this->_tpl_vars['msg']['2']; ?>
</td>
	  <?php $_from = $this->_tpl_vars['gs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
		  <?php if ($this->_tpl_vars['num'] > 1 && $this->_tpl_vars['list']['statu'] == 1): ?>
		  	<td><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
		  <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
    </tr>
	<?php $_from = $this->_tpl_vars['gp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
		<?php if ($this->_tpl_vars['list']['0'] != ''): ?>
			<tr bgcolor="#FFFFFF">
			 <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gz']):
?>
			 	<td><?php echo $this->_tpl_vars['gz']; ?>
</td>
			 <?php endforeach; endif; unset($_from); ?>
			</tr>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>