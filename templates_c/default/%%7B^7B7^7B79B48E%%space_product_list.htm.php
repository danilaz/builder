<?php /* Smarty version 2.6.20, created on 2013-01-12 20:38:36
         compiled from space_product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'space_product_list.htm', 22, false),array('modifier', 'strip_tags', 'space_product_list.htm', 48, false),array('modifier', 'truncate', 'space_product_list.htm', 48, false),array('modifier', 'date_format', 'space_product_list.htm', 50, false),array('function', 'html_image', 'space_product_list.htm', 36, false),)), $this); ?>
<div class="common_box">
<form action="shop.php" method="get">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr align="left">
    <td class="guide_ba" colspan="2">
	<span><?php echo $this->_tpl_vars['lang']['prolist']; ?>
</span>
	<a href="shop.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=product_list&list_type=1&cat=<?php echo $_GET['cat']; ?>
&m=product"><img style="vertical-align:middle;" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/col_list.gif"></a>
	<a href="shop.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=product_list&list_type=2&cat=<?php echo $_GET['cat']; ?>
&m=product"><img style="vertical-align:middle;" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/row_list.gif"></a>
    <?php if ($this->_tpl_vars['cat']): ?>
    <select onchange="if(this.value!='')  window.location='shop.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=product_list&list_type=1&m=product&cat='+this.value">
   		<option value="" ><?php echo $this->_tpl_vars['lang']['pro']; ?>
</option>
    	<?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        	<option value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['list']['id'] == $_GET['cat']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <?php endif; ?>
	</td>
  </tr>
      
	  <tr>
        <td class="com_intro">
        <?php $this->assign('list_type', ((is_array($_tmp=@$_GET['list_type'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['shopconfig']['shop_pro_list']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['shopconfig']['shop_pro_list']))); ?>
        <?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        	<?php if ($this->_tpl_vars['list_type'] == '1'): ?>
                 	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20" valign="top" style="border:0px;border-bottom:1px #CCCCCC dashed;"><input name="tid[]" type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" /></td>
                        <td width="100" style="border:0px;border-bottom:1px #CCCCCC dashed;">
						<div class="probox">
						<?php if ($this->_tpl_vars['com']['open_info_type']): ?>
						<a href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&action=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=product" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" target="_blank">
						<?php else: ?>
						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" target="_blank">
						<?php endif; ?>
							<?php $this->assign('imgs', $this->_tpl_vars['list']['id']); ?>
							<?php echo smarty_function_html_image(array('file' => "uploadfile/comimg/small/".($this->_tpl_vars['imgs']).".jpg",'width' => 150,'alt' => $this->_tpl_vars['list']['pname']), $this);?>

                        </a>
						</div>
						</td>
                        <td valign="top" style="border:0px;border-bottom:1px #CCCCCC dashed;">
						<?php if ($this->_tpl_vars['com']['open_info_type']): ?>
						<a href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&action=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=product" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" target="_blank">
						<?php else: ?>
						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" target="_blank">
						<?php endif; ?>
                        <strong><?php echo $this->_tpl_vars['list']['pname']; ?>
</strong>
                        </a><br />
                        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 220, "...", true) : smarty_modifier_truncate($_tmp, 220, "...", true)); ?>

						</td>
						<td width="100" style="border:0px;border-bottom:1px #CCCCCC dashed;"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                      </tr>
                    </table>
             <?php endif; ?>
             
             <?php if ($this->_tpl_vars['list_type'] == '2'): ?>
             	<div class="pro_list_col">
                      <ul>
                        <li>
						<div class="probox">
						<?php if ($this->_tpl_vars['com']['open_info_type']): ?>
						<a href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&action=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=product" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" target="_blank">
						<?php else: ?>
						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" target="_blank">
						<?php endif; ?>
						<?php $this->assign('imgs', $this->_tpl_vars['list']['id']); ?>
						<?php echo smarty_function_html_image(array('file' => "uploadfile/comimg/small/".($this->_tpl_vars['imgs']).".jpg",'width' => 100,'alt' => $this->_tpl_vars['list']['pname']), $this);?>

						</a>
						</div>
						<input name="tid[]" type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" />
                           <?php if ($this->_tpl_vars['com']['open_info_type']): ?>
						<a href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&action=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=product" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" target="_blank">
						<?php else: ?>
						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['pname']; ?>
" target="_blank">
						<?php endif; ?>
						   <strong><?php echo $this->_tpl_vars['list']['pname']; ?>
</strong>
                            </a>
                        </li>
                     </ul>
 				</div>
             <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
          </td>
      </tr>
      <tr><td colspan="2">
      <span style="float:left; margin-left:10px;">
		<input onclick="do_select();" type="checkbox" value="" />
		<input value="<?php echo $this->_tpl_vars['lang']['inquiry']; ?>
" type="submit"/>
		<input name="action" type="hidden" value="mail" />
		<input name="uid" type="hidden" value="<?php echo $_GET['uid']; ?>
" />
      </span>
	  <div class="pages"><?php echo $this->_tpl_vars['info']['page']; ?>
</div>
      </td></tr>
</table>
<script language="javascript">
function do_select()
{
	 var box_l = document.getElementsByName("tid[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("tid[]")[j].checked==true)
	  	  document.getElementsByName("tid[]")[j].checked = false;
		else
		  document.getElementsByName("tid[]")[j].checked = true;
	 }
}
</script>
</form>
</div>