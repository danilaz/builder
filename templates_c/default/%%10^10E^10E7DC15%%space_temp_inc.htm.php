<?php /* Smarty version 2.6.20, created on 2013-01-13 16:11:05
         compiled from space_temp_inc.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'geturl', 'space_temp_inc.htm', 73, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/member.css" rel="stylesheet" type="text/css" />



<div class="menu_bottom L1">				



    <div class="headtop_L">



        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['com']['company']; ?>
</a>



    </div>		



</div>



<div class="wrapper">



   		<div class="space_left">



			<div class="space_left_body">



				<div class="space_header"><h2><?php echo $this->_tpl_vars['lang']['mem_shop']; ?>
</h2></div>



                <div class="space_conn">



               		 <ul>



					   <?php $_from = $this->_tpl_vars['shopconfig']['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>



						<?php if ($this->_tpl_vars['list']['menu_show'] == '1'): ?>



							<?php if ($this->_tpl_vars['list']['menu_link'] != ''): ?>



								<li><a <?php if ($this->_tpl_vars['list']['menu_link'] == $_GET['action']): ?>class="now" <?php endif; ?> href="shop.php?uid=<?php echo $this->_tpl_vars['com']['userid']; ?>
&action=<?php echo $this->_tpl_vars['list']['menu_link']; ?>
&m=<?php echo $this->_tpl_vars['list']['module']; ?>
"><?php echo $this->_tpl_vars['list']['menu_name']; ?>
</a></li>



							<?php else: ?>



								<li><a <?php if ($_GET['action'] == ''): ?>class="now" <?php endif; ?> href="<?php echo smarty_function_geturl(array('type' => '','user' => $this->_tpl_vars['com']['user'],'uid' => $this->_tpl_vars['com']['userid'],'tid' => '','com' => $this->_tpl_vars['com']['company']), $this);?>
"><?php echo $this->_tpl_vars['list']['menu_name']; ?>
</a></li>



							<?php endif; ?>



						<?php endif; ?>       



					  <?php endforeach; endif; unset($_from); ?>



                    </ul>



                </div>



				</div>			



			<div class="space_left_connect m1">



				<div class="space_header_connect"><h2><?php echo $this->_tpl_vars['lang']['shop_status']; ?>
</h2></div>



                <div class="space_con_con">



               		<ul>
 <li><?php if ($this->_tpl_vars['com']['avatar']): ?><img width="100" src="<?php echo $this->_tpl_vars['com']['avatar']; ?>
"/><?php endif; ?> </li> 
 <!-- <li><img width="100" src="uploadfile/userimg/<?php echo $this->_tpl_vars['com']['logo']; ?>
"/></li> -->
 <li><span>Логин:</span><?php echo $this->_tpl_vars['com']['user']; ?>
</li>
 <?php if ($this->_tpl_vars['com']['name'] != ''): ?> <li><span>Имя:</span><?php echo $this->_tpl_vars['com']['name']; ?>
</li> <?php endif; ?> 
  <?php if ($this->_tpl_vars['com']['position'] != ''): ?> <li><span>Должность:</span><?php echo $this->_tpl_vars['com']['position']; ?>
</li> <?php endif; ?> 
   <?php if ($this->_tpl_vars['com']['company'] != ''): ?><li><span>Компания:</span><?php echo $this->_tpl_vars['com']['company']; ?>
</li><?php endif; ?> 
 <?php if ($this->_tpl_vars['com']['usertel'] != ''): ?> <li><span>Телефон:</span><?php echo $this->_tpl_vars['com']['usertel']; ?>
</li> <?php endif; ?> 
 <?php if ($this->_tpl_vars['com']['mobile'] != ''): ?> <li><span>Мобильный:</span><?php echo $this->_tpl_vars['com']['mobile']; ?>
</li> <?php endif; ?> 
  <?php if ($this->_tpl_vars['com']['email'] != ''): ?> <li><span>mail:</span><?php echo $this->_tpl_vars['com']['email']; ?>
</li> <?php endif; ?> 
 <?php if ($this->_tpl_vars['com']['rank'] != ''): ?> <li><span>Статус:</span><?php echo $this->_tpl_vars['com']['rank']; ?>
</li> <?php endif; ?>
  <?php if ($this->_tpl_vars['com']['medal'] != ''): ?> <p align="center"><?php echo $this->_tpl_vars['com']['medal']; ?>
</p> <?php endif; ?> 
<!-- <li><span>Категория:</span><?php echo $this->_tpl_vars['com']['catname']; ?>
</li> -->
<!-- <?php if ($this->_tpl_vars['com']['main_pro'] != ''): ?> <li><span>Продукция:</span><?php echo $this->_tpl_vars['com']['main_pro']; ?>
</li> <?php endif; ?> -->
<!-- <?php if ($this->_tpl_vars['com']['city'] != ''): ?> 
   <li><span>Адрес:</span>
     <?php if ($this->_tpl_vars['com']['country'] != ''): ?> <?php echo $this->_tpl_vars['com']['country']; ?>
, <?php endif; ?> 
     <?php if ($this->_tpl_vars['com']['province'] != ''): ?> <?php echo $this->_tpl_vars['com']['province']; ?>
, <?php endif; ?> 
     <?php if ($this->_tpl_vars['com']['city'] != ''): ?> <?php echo $this->_tpl_vars['com']['city']; ?>
, <?php endif; ?> 
     <?php if ($this->_tpl_vars['com']['addr'] != ''): ?> <?php echo $this->_tpl_vars['com']['addr']; ?>
 <?php endif; ?> 
   </li> 
 <?php endif; ?> -->
 <!--<?php if ($this->_tpl_vars['com']['zip'] != ''): ?> <li><span>Почтовый индекс:</span><?php echo $this->_tpl_vars['com']['zip']; ?>
</li> <?php endif; ?> 
 <?php if ($this->_tpl_vars['com']['contact'] != ''): ?> <li><span>Контактное лицо:</span><?php echo $this->_tpl_vars['com']['contact']; ?>
</li> <?php endif; ?> 

 <?php if ($this->_tpl_vars['com']['tel'] != ''): ?> <li><span>Стационарный:</span><?php echo $this->_tpl_vars['com']['tel']; ?>
</li> <?php endif; ?> 
 <?php if ($this->_tpl_vars['com']['fax'] != ''): ?> <li><span>Факс:</span><?php echo $this->_tpl_vars['com']['fax']; ?>
</li> <?php endif; ?> 
 <?php if ($this->_tpl_vars['com']['url'] != ''): ?> <li><span>Сайт:</span><a href="<?php echo $this->_tpl_vars['com']['url']; ?>
"><?php echo $this->_tpl_vars['com']['url']; ?>
</a></li> <?php endif; ?> 
 <?php if ($this->_tpl_vars['com']['qq'] != ''): ?> <li><span>QQ:</span><?php echo $this->_tpl_vars['com']['qq']; ?>
</li> <?php endif; ?> 
 <?php if ($this->_tpl_vars['com']['msn'] != ''): ?> <li><span>MSN:</span><?php echo $this->_tpl_vars['com']['msn']; ?>
</li> <?php endif; ?> 
 <?php if ($this->_tpl_vars['com']['skype'] != ''): ?> <li><span>Skype:</span><a href="skype:<?php echo $this->_tpl_vars['com']['skype']; ?>
"><?php echo $this->_tpl_vars['com']['skype']; ?>
</a></li> <?php endif; ?> -->









                    </ul>





                </div>



			</div>



		</div>



		<div class="space_con"><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=46&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script><?php echo $this->_tpl_vars['output']; ?>
</div>



   </div> 



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>