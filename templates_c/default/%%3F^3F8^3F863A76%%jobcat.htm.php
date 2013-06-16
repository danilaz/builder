<?php /* Smarty version 2.6.20, created on 2013-05-29 15:49:50
         compiled from jobcat.htm */ ?>
<div class="jobcat">
    <?php $_from = $this->_tpl_vars['jobcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
      <table cellpadding="0" cellspacing="0" width="100%" border="0">
        <tr>
           <td class="td1"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=job_list&sid=<?php echo $this->_tpl_vars['list']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['list']['catname']; ?>
</a></td>
           
        </tr>
        <tr>
           <td class="td3">
                <?php $_from = $this->_tpl_vars['list']['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['val']):
?>
                   <?php if ($this->_tpl_vars['num'] == 0): ?>
                   <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=job_list&cid=<?php echo $this->_tpl_vars['val']['id']; ?>
"><?php echo $this->_tpl_vars['val']['catname']; ?>
</a>
                   <?php else: ?>
                   | <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=job&s=job_list&cid=<?php echo $this->_tpl_vars['val']['id']; ?>
"><?php echo $this->_tpl_vars['val']['catname']; ?>
</a>
                   <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
           </td>
        </tr>
       </table> 
    <?php endforeach; endif; unset($_from); ?>
</div>