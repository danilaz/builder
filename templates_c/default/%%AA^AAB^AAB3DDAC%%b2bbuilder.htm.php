<?php /* Smarty version 2.6.20, created on 2013-05-31 17:48:57
         compiled from b2bbuilder.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getOffers', 'b2bbuilder.htm', 27, false),array('insert', 'getDemands', 'b2bbuilder.htm', 42, false),array('insert', 'label', 'b2bbuilder.htm', 57, false),array('insert', 'getUser', 'b2bbuilder.htm', 114, false),array('insert', 'getFriendLink', 'b2bbuilder.htm', 157, false),)), $this); ?>
﻿<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="main">
<div class="categories">
<ul id="all_cate_list" class="cat_list_show" style="margin-top:-1px;">
      <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
      <li>
     	 <div><a <?php if ($this->_tpl_vars['list']['sub'] != null): ?>class="sup"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_list&id&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</a></div>
         <?php if ($this->_tpl_vars['list']['sub'] != null): ?>
         <p>
          <?php $_from = $this->_tpl_vars['list']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>     
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_list&id=<?php echo $this->_tpl_vars['item']['catid']; ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</a>
          <?php endforeach; endif; unset($_from); ?>
        </p>
        <?php endif; ?>
        </li>
      <?php endforeach; endif; unset($_from); ?>
    </ul>
</div>
        <div class="main_l">
            <div class="clear"></div>
            <div class="ad"><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=4&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script></div>
          <!-- <div> <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/ekolobok-art.png"> </div> -->
<div class="top_pro">
  <div class="top_branh_tit">
    <span class="yt_tit">Продаем товары</span>
  </div>
       <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getOffers', 'leng' => '30', 'type' => '1', 'limit' => '4', 'img' => 'true')), $this); ?>
 
  <div class="clear"></div>
</div>
<div class="h1_line"></div> 
<div class="top_pro"> 
  <div class="top_branh_tit">
    <span class="yt_tit">Оказываем услуги (выполняем работы)</span>
  </div>
       <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getOffers', 'leng' => '300', 'type' => '2', 'limit' => '4', 'img' => 'true')), $this); ?>
 
  <div class="clear"></div>
</div>
<div class="top_pro">
  <div class="top_branh_tit">
    <span class="yt_tit">Закупаем товары</span>
  </div>
       <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getDemands', 'leng' => '30', 'type' => '1', 'limit' => '4', 'img' => 'true')), $this); ?>
 
  <div class="clear"></div>
</div>
<div class="h1_line"></div> 
<div class="top_pro"> 
  <div class="top_branh_tit">
    <span class="yt_tit">Требуются услуги (работы)</span>
  </div>
       <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getDemands', 'leng' => '300', 'type' => '2', 'limit' => '4', 'img' => 'true')), $this); ?>
 
  <div class="clear"></div>
</div> 	
        	
            <div class="clear"></div>
 <div class="syzx">
				<div class="Menubox"><h2>Бизнес информация</h2><h3><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news">Подробнее</a></h3></div>
				<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'newstag', 'temp' => 'news_indextag')), $this); ?>

				<div class="clear"></div>
            </div>
            <div class="pro_list">
                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'rec' => 1, 'type' => 'cat', 'temp' => 'pro_cat')), $this); ?>

            </div>
            <div class="ad"><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=5&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script></div>
           
            </div>
            </div>
            <div class="main_r">
            	<?php if ($_COOKIE['USER'] == ''): ?>
				<div id="loginb2b">
				<div class="login_tit">
                <h2>Вход для участников</h2></div>
                <div class="login_con">
                <div id="login1">
                    <!--
					<ul>
                    <form autocomplete="off" method="post" action="login.php" name="login" id="login">
                    
		<div style="padding-bottom:3px;">Логин<span style="padding-left:20px;"><input type="text" onBlur="this.value=this.value==''?'Ваш логин':this.value" onFocus="this.value=this.value=='Ваш логин'?'':this.value" value="Ваш логин" class="k" name="user" id="user"></span></div>
		<div>Пароль<span style="padding-left:10px;"><input type="password" onBlur="this.value=this.value==''?'Пароль':this.value" onFocus="this.value=this.value=='Пароль'?'':this.value" value="Пароль" class="k" id="password" name="password"><input type="image" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/login.jpg"></div>
                    <input type="hidden" value="submit" name="action">
                    </form>
                    </ul>
					-->
                    <ul class="u2">
                      <a href="register.php">Регистрация</a> | <a href="lostpass.php">Забыли пароль?</a>
                    </ul>
                </div>
                <ul class="phone"><span style="padding-left:25px;">Техническая поддержка:</span><br />
		<span class="o16" style="padding-left:25px;"><?php echo $this->_tpl_vars['config']['owntel']; ?>
8800</span></ul>
                <ul style="height:60px;"><li><a href="/register.php"><img width="99" height="28" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/btn1.jpg"></a></li>
                  <li><a href="main.php?action=m&amp;m=offer&amp;s=admin_offer&amp;menu=info"><img width="99" height="28" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/btn2.jpg"></a></li></ul></div>
                 </div>
				<?php else: ?>
				<div id="loginb2bno">
				<div class="login_tit">
                <h2>Техническая поддержка</h2></div>
                <div class="nologin_con">
                <ul class="phone"><span style="padding-left:25px;">Техническая поддержка: привет</span><br />
                <span class="o16" style="padding-left:25px;"><?php echo $this->_tpl_vars['config']['owntel']; ?>
</span></ul>
                <ul style="height:28px;">
				<!-- <li><a href="/register.php"><img width="99" height="28" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/btn1.jpg"></a></li> -->
                  <li><a href="main.php?action=m&amp;m=offer&amp;s=admin_offer&amp;menu=info"><img width="99" height="28" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/btn2.jpg"></a></li></ul></div>
                 </div>					
				<?php endif; ?>				 
                 <div class="topm" id="company">
					<div class="sectitle">
						<h2>Компании</h2>
						<span style="float: right; margin-top:5px; margin-right:10px;"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=company"><img src="image/default/more.gif" width="36" height="13" border="0" /></a></span>
					</div>
                 
                    <div class="seccon">
                    	<div id="conr1" class="conr1">
                        	<ul>
                            	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'leng' => '200', 'field' => 'company', 'filter' => 'new', 'limit' => 13)), $this); ?>

                            </ul>
                        </div>
                        <div id="conr2" class="conr2">
                        	<ul>
                            	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'leng' => '200', 'field' => 'company', 'filter' => 'rec', 'limit' => 13)), $this); ?>

                            </ul>
                        </div>
                    </div>
                 </div>
				 <!--
                 <div class="topm" id="exhibition">
                 	<div class="sectitle">
                    	<h2>Новые выставки</h2>
						<span style="float: right; margin-top:5px; margin-right:10px;"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition"><img src="image/default/more.gif" width="36" height="13" border="0" /></a></span>
                    </div>
                    <div class="seccon">
                    	<ul>
                           <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'exhibition', 'temp' => 'exhibition_index_lasted', 'limit' => 2)), $this); ?>

  						</ul>
                    </div>
                 </div>
				 -->
                 <div class="ad"><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=6&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script></div>
				 <!--
				<div class="topm" id="voting">
                 	<div class="sectitle"><h2>Вопросы и ответы</h2><span style="float: right; margin-top:5px; margin-right:10px;">
	   <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask"><img src="image/default/more.gif" width="36" height="13" border="0" /></a></span></div>
                    <div class="seccon">
                        <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'ask', 'temp' => 'ask_text_list', 'limit' => 10)), $this); ?>

                    </div>
                 </div>
				 -->
				 <div class="ad"><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=7&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script></div>
            </div>
            <div class="clear"></div>
            <div id="index_link" class="topm">
				<div class="sectitle">
					<span class="title_t">Ссылки</span>
					<span style="float: right; margin-right:10px;">
						[<a href="change_link.php" target="_blank">Подробнее</a>]
					</span>
				</div>
				<div class="seccon"><p><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getFriendLink')), $this); ?>
</p></div>
       		</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--------WebKitFormBoundaryB2eRb7gVQksDNbeA
Content-Disposition: form-data; name="func"
file.upload-->