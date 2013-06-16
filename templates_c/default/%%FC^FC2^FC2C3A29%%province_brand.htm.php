<?php /* Smarty version 2.6.20, created on 2013-01-27 04:37:28
         compiled from province_brand.htm */ ?>
<table width="100%" align="center">
<tr>
<?php $_from = $this->_tpl_vars['province']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
<td align="left" style="padding-left:20px;">
	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&province=<?php echo $this->_tpl_vars['list']['province']; ?>
"><?php echo $this->_tpl_vars['list']['province']; ?>
</a>
</td>
<?php if (( $this->_tpl_vars['num']+1 ) % 2 == 0): ?></tr><tr><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</tr>
<tr><td colspan="4" align="right" style="padding-right:20px;">&raquo; <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&province=another">По всем регионам</a></td></tr>
</table>