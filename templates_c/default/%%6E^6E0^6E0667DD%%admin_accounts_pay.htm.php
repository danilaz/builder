<?php /* Smarty version 2.6.20, created on 2013-01-13 15:54:07
         compiled from admin_accounts_pay.htm */ ?>
<script type="text/javascript" src="script/Validator.js"></script>
	<div class="admin_right_top"><?php echo $this->_tpl_vars['lang']['pay_a']; ?>
 </div>
	<table width='100%' border="0" cellpadding="7" cellspacing="1" bgcolor="#DDDDDD" class="admin_table">
    <form target="_blank" action="" method="post" onSubmit="return Validator.Validate(this,3)">
  <tr>
	<td width='18%' height="24" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['pay_f']; ?>
</td>
	<td width='82%' bgcolor="#FFFFFF" colspan="2">
    <input type="text" name="amount" autocomplete="off" dataType="Double" msg="<?php echo $this->_tpl_vars['lang']['pay_g']; ?>
">
    </td>
  </tr>
  <tr>
	<td height="24"  width='18%' align="left" bgcolor="#EAEFF3" ><?php echo $this->_tpl_vars['lang']['pay_b']; ?>
</td>
	<td bgcolor="#FFFFFF" width='82%'>
        <?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nums'] => $this->_tpl_vars['list']):
?>
            <dl style="width:100%; height:auto; float:left; text-align:left; margin-top:8px;">
                <label>
                <dd style="width:20px; float:left;"><input type="radio" value="<?php echo $this->_tpl_vars['list']['payment_type']; ?>
" name="payment_type" <?php if ($this->_tpl_vars['nums'] == 0): ?>checked<?php endif; ?>></dd>
                <dd style="width:135px; float:left; margin-left:5px;"><img width="133" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/payment/<?php echo $this->_tpl_vars['list']['payment_type']; ?>
.gif" ></dd>
                <dd style="width:450px; float:left; margin-left:5px;"><?php echo $this->_tpl_vars['list']['payment_desc']; ?>
</dd>
                </label>
            </dl>
        <?php endforeach; endif; unset($_from); ?>
      </td>
  </tr>
  <tr>
	<td height="24" align="right" bgcolor="#EAEFF3"> </td>
	<td bgcolor="#FFFFFF">
	  <input  type='submit' name='Submit' value='<?php echo $this->_tpl_vars['lang']['pay_e']; ?>
' style="width:100px;">
	  <input name="action" type="hidden" id="action" value="search" /></td>
  </tr>

  </form>
</table>