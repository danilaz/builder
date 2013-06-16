<?php /* Smarty version 2.6.20, created on 2013-01-17 21:22:51
         compiled from brand_product_index.htm */ ?>
<?php if ($this->_tpl_vars['brand']['0']['name'] != ""): ?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr><?php $_from = $this->_tpl_vars['brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
		<td rowspan="13" style="margin:2px;padding:2px;width:80px;" align="center"> <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&s=content&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
" width="100"></a>
		<br /><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&s=content&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a>
		</td>
		<?php endforeach; endif; unset($_from); ?>
	</tr>
	</table>
<?php endif; ?>
<!-- <?php if ($this->_tpl_vars['brand']['0']['name'] != ""): ?>
    <?php $_from = $this->_tpl_vars['brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
    <li class="yt_branh_list">
    <a class="t_branh_pic" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&s=content&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
" /></a>
    <p><a class="sub_title1 top_branh_desc" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&s=content&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a></p>
    </li>
    <?php endforeach; endif; unset($_from); ?>
<?php endif; ?> -->