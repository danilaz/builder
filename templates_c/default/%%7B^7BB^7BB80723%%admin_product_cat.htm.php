<?php /* Smarty version 2.6.20, created on 2013-02-02 12:17:01
         compiled from admin_product_cat.htm */ ?>
<div class="admin_right_top"><span style="float:left"><?php echo $this->_tpl_vars['lang']['pro_cat_list']; ?>
</span></div>

<div>
<script>
function option(id)
{
	if($('subcat'+id).style.display=='none')
	{
		$('opt_text'+id).innerHTML="[-]";
		$('subcat'+id).style.display='block';
	}
	else
	{
		$('opt_text'+id).innerHTML="[+]";
		$('subcat'+id).style.display='none';

	}
}
</script>
<form action="" method="post">
<table width="100%" border="0" cellspacing="1" bgcolor="#FFFFFF" class="admin_table">
	<tr bgcolor="#E8E8E8" style="font-weight:bold" height="22">
      <td width="55" align="center" bgcolor="#EDF8FE"><?php echo $this->_tpl_vars['lang']['order']; ?>
</td>
	  <td align="left" bgcolor="#EDF8FE"><?php echo $this->_tpl_vars['lang']['pro_cat_name']; ?>
</td>
    </tr>
	<?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
	<tr>
	  <td colspan="2" valign="top" bgcolor="#F4F4F4" style="padding-left:10px;">
		  <span><img src="image/default/user_admin/icon.jpg" /></span>
		  <span><input name="nums[]" value="<?php echo $this->_tpl_vars['list']['nums']; ?>
" type="text" size="4" maxlength="2" /></span>
		  <span><input style="width:300px;" value="<?php echo $this->_tpl_vars['list']['name']; ?>
" type="text" name="name[]" /></span>
		  <span><input name="cid[]" type="hidden" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" /></span>
		  <!-- <a href="?action=admin_product_cat&menu=<?php echo $_GET['menu']; ?>
&deid=<?php echo $this->_tpl_vars['list']['id']; ?>
"> -->
		  <a href="main.php?action=m&m=product&s=admin_product_cat&menu=<?php echo $_GET['menu']; ?>
&deid=<?php echo $this->_tpl_vars['list']['id']; ?>
">
		  <img src="image/default/user_admin/jian.png" />
		  </a>
<!-- 		  <a id="opt_text<?php echo $this->_tpl_vars['num']; ?>
" href="javascript:option('<?php echo $this->_tpl_vars['num']; ?>
');">
		  <img src="image/default/user_admin/jia.png" />
		  </a> -->
		</td>
	  </tr>
	
	<tr>
      <td colspan="2" valign="top">
		  <?php $_from = $this->_tpl_vars['list']['subcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
		  	<div style="width:100%; padding-left:54px; float:left; margin:2px;">
			 <img src="image/default/user_admin/icon2.jpg" />
			  <input name="snums[]" value="<?php echo $this->_tpl_vars['slist']['nums']; ?>
" type="text" size="4" maxlength="2" />
			  <input style="width:258px;" value="<?php echo $this->_tpl_vars['slist']['name']; ?>
" type="text" name="sname[]" />
			  <input name="scid[]" type="hidden" value="<?php echo $this->_tpl_vars['slist']['id']; ?>
" />
			  <!-- <a href="?action=admin_product_cat&menu=<?php echo $_GET['menu']; ?>
&deid=<?php echo $this->_tpl_vars['slist']['id']; ?>
"> -->
			  <a href="main.php?action=m&m=product&s=admin_product_cat&menu=<?php echo $_GET['menu']; ?>
&deid=<?php echo $this->_tpl_vars['slist']['id']; ?>
">
			  <img src="image/default/user_admin/jian.png" />
			  </a>
			  </div>
		  <?php endforeach; endif; unset($_from); ?>
		  
		  <div style="display:none; width:100%; padding-left:54px;" id="subcat<?php echo $this->_tpl_vars['num']; ?>
">
		  <img src="image/default/user_admin/icon2.jpg" />
		  <input name="addsnums[]" value="" type="text" size="4" maxlength="2" />
		  <input style="width:258px;" value="" type="text" name="addsname[]" />
		  <input name="pid[]" type="hidden" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" />
		  </div>
	  </td>
      </tr>
	<?php endforeach; endif; unset($_from); ?>
	
    <tr>
      <td colspan="2" style="border-top:dashed 1px #CCCCCC;" valign="top">
	  <?php echo $this->_tpl_vars['lang']['newadd']; ?>
<input name="nums[]" type="text" size="4" maxlength="2" />
	  <input style="width:302px;" type="text" name="name[]" />
	  </td>
      </tr>
    <tr>
	  <td valign="top">&nbsp;</td>
	  <td valign="top">
	    <input type="submit" name="button" id="button" value="<?php echo $this->_tpl_vars['lang']['submit']; ?>
" />
	    <input name="action" type="hidden" id="action" value="submit" />
		</td>
    </tr>
  </table>
</form>
</div>