<?php /* Smarty version 2.6.20, created on 2013-01-27 04:37:28
         compiled from brand_content.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'brand_content.htm', 18, false),array('modifier', 'date_format', 'brand_content.htm', 36, false),array('insert', 'label', 'brand_content.htm', 51, false),)), $this); ?>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/brand/templates/default/brand.css" rel="stylesheet" type="text/css" />
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand">Бренды</a> &raquo; <?php echo $this->_tpl_vars['brand']['name']; ?>
</a>
    </div>
    <div class="headtop_R"></div>		
</div>

<center>
<div class="brandmain">
<!--中间左边-->
 <div class="left">
     <div class="left_top">&nbsp;&nbsp;Информация</div>
     <div class="left_content" style="padding-left:20px;" >
       <table width="100%" border="0" cellpadding="0" cellspacing="0">
       <tr>
       <td width="82%" height="30" align="left">
	   Название: <a target="_blank" href="?m=product&s=product_list&brand=<?php echo ((is_array($_tmp=$this->_tpl_vars['brand']['name'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><?php echo $this->_tpl_vars['brand']['name']; ?>
</a>
	   </td>
       <td class="brand_img" width="18%" rowspan="4" valign="top">
			<?php if ($this->_tpl_vars['brand']['pic'] != ''): ?>
			    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&s=content&id=<?php echo $this->_tpl_vars['brand']['id']; ?>
">
				<img src="<?php echo $this->_tpl_vars['brand']['pic']; ?>
"/></a>
            <?php else: ?>
			    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&s=content&id=<?php echo $this->_tpl_vars['brand']['id']; ?>
">
            	<img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/nopic.gif"  alt="<?php echo $this->_tpl_vars['list']['title']; ?>
" /></a>
            <?php endif; ?>
		</td>
       </tr>
      <tr><td height="30" align="left">Компания: <?php echo $this->_tpl_vars['brand']['company']; ?>
</td></tr>
      <tr><td height="30" align="left">Телефон: <?php echo $this->_tpl_vars['brand']['tel']; ?>
</td></tr>
	  <tr><td height="30" align="left">Сайт бренда: <a target="_blank" href="<?php echo $this->_tpl_vars['brand']['url']; ?>
"><?php echo $this->_tpl_vars['brand']['url']; ?>
</a></td></tr>
	  <tr><td height="30" align="left">Сайт компании: <a target="_blank" href="<?php echo $this->_tpl_vars['brand']['inner_url']; ?>
"><?php echo $this->_tpl_vars['brand']['inner_url']; ?>
</a></td></tr>
	  <tr><td height="30" align="left">Страна: <?php echo $this->_tpl_vars['brand']['country']; ?>
</td></tr>
	  <tr><td height="30" align="left">Область и город: <?php echo $this->_tpl_vars['brand']['province']; ?>
 <?php echo $this->_tpl_vars['brand']['city']; ?>
</td></tr>
      <tr><td height="30" align="left">Обновлено: <?php echo ((is_array($_tmp=$this->_tpl_vars['brand']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td></tr>
       </table>
     </div>
     <div class="left_top">&nbsp;&nbsp;Описание</div>
     <div class="left_content">
       <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr><td align="left"><?php echo $this->_tpl_vars['brand']['con']; ?>
</td></tr>
       </table>
     </div>
 </div>
 
<!--中间右边--> 
 <div class="right">
   <div class="right_top">&nbsp;&nbsp;Обзор по областям</div>
   <div class="right_tj">
   <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'province', 'temp' => 'province_brand')), $this); ?>

   </div>
   <br />
   <div class="right_top">&nbsp;&nbsp;Рекомендуемые бренды</div>
   <div class="right_tj">
     <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'brand', 'temp' => 'brand_list', 'rec' => 2, 'limit' => 5)), $this); ?>

	 <div class="clear"></div>
   </div>
 </div>

</div>
</center>