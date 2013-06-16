<?php /* Smarty version 2.6.20, created on 2013-01-12 18:48:05
         compiled from province_buylist_demand.htm */ ?>
<div align="left" style="padding:10px;">
<?php $_from = $this->_tpl_vars['province']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand&s=demand_list&province=<?php echo $this->_tpl_vars['list']['province']; ?>
"><?php echo $this->_tpl_vars['list']['province']; ?>
</a> &bull;
    <?php if (( $this->_tpl_vars['num']+1 ) % 3 == 0): ?><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</div>