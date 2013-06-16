<?php /* Smarty version 2.6.20, created on 2013-01-12 19:05:05
         compiled from companys_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getUser', 'companys_index.htm', 45, false),array('insert', 'label', 'companys_index.htm', 62, false),array('insert', 'getPlayer', 'companys_index.htm', 73, false),)), $this); ?>
 <link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/company.css" rel="stylesheet" type="text/css" />
    <div class="menu_bottom L1">				
        <div class="headtop_L">
           <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['com_res']; ?>
</a>
        </div>
        <div class="headtop_R"></div>		
    </div>
	<!--主体开始 -->
	<div id="mainbody1" class="m1">	
<div class="categories">
<ul id="all_cate_list" class="cat_list_show" style="margin-top:-1px;">

      <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>

      <li>

     	 <div><a <?php if ($this->_tpl_vars['list']['sub'] != null): ?>class="sup"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=company&s=company_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</a></div>

         <?php if ($this->_tpl_vars['list']['sub'] != null): ?>

         <p>

          <?php $_from = $this->_tpl_vars['list']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>     

            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=company&s=company_list&id=<?php echo $this->_tpl_vars['item']['catid']; ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</a>

          <?php endforeach; endif; unset($_from); ?>

        </p>

        <?php endif; ?>

        </li>

      <?php endforeach; endif; unset($_from); ?>

    </ul>
</div>
		<!--主体左侧开始 -->
		<div class="leftbar">
        	<div id="starcompany">
            	<div class="title4"><div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['star_com']; ?>
</div></div>
				<div class="content4">
					<ul>
            			<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'field' => 'company', 'filter' => 'star', 'logo' => true, 'leng' => 200, 'limit' => 4)), $this); ?>

						<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=18&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
					</ul>
					<div class="clear"></div>
            	</div>
            </div>
					<div class="right1 m1">
				<div class="sectitle" ><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['last_reg']; ?>
</div></div>
				<div class="seccon">
					<ul class="li_list">
					 	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'field' => 'company', 'filter' => 'new', 'limit' => '10', 'leng' => '200')), $this); ?>

				   </ul>
                   <div class="clear"></div>
			    </div>
				<div class="clear"></div>
			</div>	
            <div class="m1" id="companydetail">        	
                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'cat', 'temp' => 'com_cat', 'ctype' => 'com')), $this); ?>

            </div>
		</div>
		<!--主体左侧结束 -->
		
		<!--主体右侧开始 -->
		<div class="rightbar">
			<div class="right1">
				<div class="sectitle" ><div class="title_left1 L2">Реклама</div></div>
				 <div class="seccon">
					<ul class="list7">
					 	<!-- <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getPlayer', 'height' => '200', 'width' => '190')), $this); ?>
 -->
						<script style="width:200px;height:220px" src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=19&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
				    </ul>
                   <div class="clear"></div>
			    </div>
				</div>
			
		</div>		
		<!--主体右侧结束 -->
	</div>