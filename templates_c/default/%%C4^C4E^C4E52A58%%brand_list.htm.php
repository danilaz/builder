<?php /* Smarty version 2.6.20, created on 2013-01-27 04:37:28
         compiled from brand_list.htm */ ?>
<?php if ($this->_tpl_vars['brand']['0']['name'] != ""): ?>
	<?php $_from = $this->_tpl_vars['brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td style="margin:2px;padding:2px;width:80px;"> <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&s=content&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
" width="80"></a></td>
			<td style="line-height:1.2em">Бренд: <?php echo $this->_tpl_vars['list']['name']; ?>
<br />
			Название компании: <?php echo $this->_tpl_vars['list']['company']; ?>
<br />
			Телефон: <?php echo $this->_tpl_vars['list']['tel']; ?>

			</td>
		</tr>
		</table>
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>