<?php /* Smarty version 2.6.20, created on 2013-01-17 21:22:51
         compiled from pro_picprice.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'pro_picprice.htm', 13, false),array('modifier', 'number_format', 'pro_picprice.htm', 22, false),)), $this); ?>
<!--<style>
.plist{width:220px; float:left; height:90px; overflow:hidden;}
.plist td{padding:5px}
.plist img{height:70px; width:80px; border:solid 1px #999999; padding:3px;}
</style>
<?php $_from = $this->_tpl_vars['pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
<div class="plist">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="80" align="left" valign="top"><img src='<?php echo $this->_tpl_vars['list']['img']; ?>
' width=80 height=80 /></td>
    <td align="left" valign="top">
    <b><a style="color:#F19100" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a></b><br />
    <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

    </td>
  </tr>
</table>
</div>
<?php endforeach; endif; unset($_from); ?>-->
<?php $_from = $this->_tpl_vars['pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
<div class="pro_box"> <a class="t_pro_pic" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"> <img src='<?php echo $this->_tpl_vars['list']['img']; ?>
' /> </a>
  <h4><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['pname']; ?>
</a></h4>
  <p class="top_pro_price"><span class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</span> <strong><?php echo $this->_tpl_vars['config']['money']; ?>
</strong></p>
</div>
<?php endforeach; endif; unset($_from); ?>