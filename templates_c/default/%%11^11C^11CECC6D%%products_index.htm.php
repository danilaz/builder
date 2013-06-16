<?php /* Smarty version 2.6.20, created on 2013-01-17 21:22:50
         compiled from products_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getUser', 'products_index.htm', 39, false),array('insert', 'label', 'products_index.htm', 51, false),)), $this); ?>
<div id="main">

  <div id="left">

    <ul id="all_cate_list" class="cat_list_show" style="margin-top:-1px;">

      <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>

      <li>

     	 <div><a <?php if ($this->_tpl_vars['list']['sub'] != null): ?>class="sup"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</a></div>

         <?php if ($this->_tpl_vars['list']['sub'] != null): ?>

         <p>

          <?php $_from = $this->_tpl_vars['list']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>     

            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&id=<?php echo $this->_tpl_vars['item']['catid']; ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</a>

          <?php endforeach; endif; unset($_from); ?>

        </p>

        <?php endif; ?>

        </li>

      <?php endforeach; endif; unset($_from); ?>

    </ul>

    <div class="nr_box rec_com" style="margin-top:10px;">

      <div class="nr_tit">Сайты</div>

	  <div style="float:left; padding:5px 10px 10px;">

      <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'leng' => '200', 'field' => 'company', 'filter' => 'rec', 'limit' => 10)), $this); ?>


	  </div>

</div>

<div class="nr_box" style="margin-left:0px; float:left; height:211px;">

        <div class="nr_tit"><?php echo $this->_tpl_vars['lang']['hot_rec']; ?>
</div>

        <ul class="point_style_list">

       		<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_default_list', 'leng' => 200, 'limit' => 4)), $this); ?>


        </ul>

    </div>

  </div>

  <div id="right" class="mt1">

    <div class="rig_top">

      <div class="adv_fla"> <script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=8&catid=&sname=index.php'></script> </div>

      

    </div>

    <div class="rig_main">

      <div class="top_branh">

        <div class="top_branh_tit">

          <span class="yt_tit">Рекомендуемые бренды</span></div>

        <ul class="top_brand_cont">

        <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'brand', 'temp' => 'brand_product_index', 'rec' => 2, 'pic' => 'true', 'limit' => 8)), $this); ?>


        </ul>

      </div>

    </div>

    <div class="h1_line"></div>

    <div class="top_pro">

	  <div class="yt_add_pro"><a href="main.php?action=m&m=product&s=admin_product&menu=info">Разместить продукты</a></div>

      <div class="yt_tit">Рекомендуемые продукты</div>

      <div class="top_pro_cont">

		<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'pro', 'temp' => 'pro_picprice', 'limit' => 3, 'rec' => 1)), $this); ?>


      </div>

    </div>

    <div class="h1_line"></div>

    <div class="new_pro">

      <div class="yt_tit">Новые товары</div>

<!--      <div class="pro_box"><a href="##" ><img height="120" width="120" alt="" src="http://image.dhgate.com/dhs/oth/hp/home/2011W40/NHP/5.jpg"></a>

        <h4><a href="##">Finger Nail Rings</a></h4>

        <dl>

          <dt>MSRP: <span class="delprice">US $3.20/piece</span></dt>

          <dd>DHgate: <span class="red">US $1.30/piece</span></dd>

        </dl>

      </div>-->

      <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'pro', 'temp' => 'pro_picprice', 'limit' => 3)), $this); ?>


    </div>

    <!--div class="h1_line"></div>

    <div class="tsell_pro">

      <div class="yt_tit"><span class="more"><a href="##" style="font-size:12px;">更多>></a></span>促销信息</div>

      <ul class="sell_pro_list sell_pro_l"><li><a href="##">促销信息促销信息促销信息促销信息</a></li><li><a href="##">促销信息促销信息促销信息促销信息</a></li><li><a href="##">促销信息促销信息促销信息促销信息</a></li><li><a href="##">促销信息促销信息促销信息促销信息</a></li><li><a href="##">促销信息促销信息促销信息促销信息</a></li></ul>

      <div class="sell_pro_list sell_pro_r"><li><a href="##">促销信息促销信息促销信息促销信息</a></li><li><a href="##">促销信息促销信息促销信息促销信息</a></li><li><a href="##">促销信息促销信息促销信息促销信息</a></li><li><a href="##">促销信息促销信息促销信息促销信息</a></li><li><a href="##">促销信息促销信息促销信息促销信息</a></li></div>

    </div -->

  </div>

<div id="right_p">

            	<?php if ($_COOKIE['USER'] == ''): ?>

		<div id="loginb2b">

	<div class="login_tit">

   <h2>Вход для участников</h2></div>

      <div class="login_con">

                <div id="login1">

                    <ul>

                    <form autocomplete="off" method="post" action="login.php" name="login" id="login">

		<div style="padding-bottom:3px;">Логин<span style="padding-left:20px;"><input type="text" onBlur="this.value=this.value==''?'Ваш логин':this.value" onFocus="this.value=this.value=='Ваш логин'?'':this.value" value="Ваш логин" class="k" name="user" id="user"></span></div>

		<div>Пароль<span style="padding-left:10px;"><input type="password" onBlur="this.value=this.value==''?'Пароль':this.value" onFocus="this.value=this.value=='Пароль'?'':this.value" value="Пароль" class="k" id="password" name="password"></div>

                    <input type="hidden" value="submit" name="action">

                    </form>

                    </ul>

                    <ul class="u2">

                      <a href="register.php">Регистрация</a> | <a href="lostpass.php">Забыли пароль?</a>

                    </ul>

                </div>

                <ul class="phone"><span style="padding-left:25px;">Горячая линия:</span><br />

		<span class="o16" style="padding-left:25px;"><?php echo $this->_tpl_vars['config']['owntel']; ?>
</span></ul>

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

                <ul class="phone"><span style="padding-left:25px;">Горячая линия:</span><br />

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

                 <div class="ad"><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=6&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script></div>

				<div class="topm" id="voting">

                 	<div class="sectitle"><h2>Вопросы и ответы</h2><span style="float: right; margin-top:5px; margin-right:10px;">

	   <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list"><img src="image/default/more.gif" width="36" height="13" border="0" /></a></span></div>

                    <div class="seccon">

                        <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'ask', 'temp' => 'ask_text_list', 'limit' => 10)), $this); ?>


                    </div>

                 

</div>

 </div>

 

   <div class="h1_line"></div>

<div id="prozone_img">

  <h3>Пройдите быстрый и безопасный процесс покупки!</h3>

</div>

<div class="h1_line" style="margin-top:-10px"></div>