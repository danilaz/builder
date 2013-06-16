<?php /* Smarty version 2.6.20, created on 2013-01-12 15:19:19
         compiled from province_company.htm */ ?>
<?php $_from = $this->_tpl_vars['province']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=company&s=company_list&province=<?php echo $this->_tpl_vars['list']['province']; ?>
"><?php echo $this->_tpl_vars['list']['province']; ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>