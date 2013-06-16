<?php /* Smarty version 2.6.20, created on 2013-01-13 14:32:13
         compiled from demand_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'demand_list.htm', 25, false),array('insert', 'getUser', 'demand_list.htm', 192, false),array('modifier', 'urlencode', 'demand_list.htm', 36, false),array('modifier', 'explode_one', 'demand_list.htm', 79, false),array('modifier', 'date_format', 'demand_list.htm', 87, false),array('modifier', 'strip_tags', 'demand_list.htm', 89, false),array('modifier', 'truncate', 'demand_list.htm', 89, false),array('function', 'html_image', 'demand_list.htm', 80, false),array('function', 'geturl', 'demand_list.htm', 91, false),)), $this); ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand'>Спрос</a> &raquo; <?php echo $this->_tpl_vars['guide']; ?>
</a>
    </div>
    <div class="headtop_R"></div>		
</div>
<div id="mainbody1" class="m1">
	  <div class="navigation">
			<?php if ($this->_tpl_vars['subcat']['0']['catid']): ?>
				<div class="title10"><div class="title_left L2"><?php echo $this->_tpl_vars['lang']['cat_nav']; ?>
</div></div>
				<div class="content10" style="padding:5px 20px;">
						<?php $_from = $this->_tpl_vars['subcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
							<p><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand&s=demand_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
 <span style="color:#CCCCCC;font-size:small"></span><!-- (<?php echo $this->_tpl_vars['list']['rec_nums']; ?>
) --></a></p>
						<?php endforeach; endif; unset($_from); ?>
                    <div class="clear"></div>
				</div>
				<div class="bottom10" style="margin-bottom:5px"></div>
			<?php endif; ?>
<div class="left2 m1">
				<div class="title9" >
					<div class="title_left1 L2">Регионы</div><div class="more"></div>
		        </div>
				 <div class="content9">
					<ul class="list2">
					<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'province', 'temp' => 'province_buylist_demand')), $this); ?>

				   </ul>
			    </div>
			</div>
	  </div>
	  			<!--主体左侧结束 -->
		<div class="rightbar1">
			
			<div style="border:1px solid #CFCFCF; margin-bottom:8px; padding:8px;clear:both; height:25px;">
				<div style="float:left; width:50%; padding-left:20px;">
				<?php $_from = $this->_tpl_vars['infoType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
				<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand&s=demand_list&catType=<?php echo $this->_tpl_vars['num']; ?>
&id=<?php echo $_GET['id']; ?>
&key=<?php echo ((is_array($_tmp=$_GET['key'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><img alt="<?php echo $this->_tpl_vars['list']; ?>
" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/demand_<?php echo $this->_tpl_vars['num']; ?>
.gif"/></a>
				<?php endforeach; endif; unset($_from); ?>
				</div>
				<div style="float:right; width:40%; text-align:right;">
				<?php if ($_GET['ifpay'] == 1): ?>
				<input onchange="window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand&s=demand_list&catType=<?php echo $_GET['catType']; ?>
&id=<?php echo $_GET['id']; ?>
&ifpay=0';" name="" type="checkbox" checked value="1" /> 
				<?php else: ?>
                <!--
				<input onchange="window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand&s=demand_list&catType=<?php echo $_GET['catType']; ?>
&id=<?php echo $_GET['id']; ?>
&ifpay=1';" name="" type="checkbox" value="1" /> 
				<?php endif; ?>
				
				Товары пользователей
                -->
				</div>
				<?php if ($this->_tpl_vars['config']['domaincity'] && $this->_tpl_vars['config']['base_url']): ?>
					<a href="http://www.<?php echo $this->_tpl_vars['config']['base_url']; ?>
/?m=demand&s=demand_list&id=<?php echo $_GET['id']; ?>
">
					<?php echo $this->_tpl_vars['lang']['lookmore']; ?>
<?php echo $this->_tpl_vars['current_cat']; ?>

					</a>
				<?php endif; ?>
			</div>
			<div class="clear"></div>

            <div class="ad"><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=4&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script></div>

        	

   

            <div class="clear"></div>
			<div class="clear"></div>
			<div class="title10"></div>
			<div class="content10">
			      <ul class="list9" style="padding-top:5px; padding-bottom:0px;">
			    <input onclick="do_select();" type="checkbox" />
                <input onclick="get_inquery();" type="button" value="Массовая рассылка" />
                <input onclick="add_inquery('info','<?php echo $this->_tpl_vars['config']['weburl']; ?>
','');" type="button" value="Добавить в рассылку" />
				</ul>
        <ul class="list9">
		<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=15&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
		<?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        	<li>
            	<div class="Lb0"><input name="inquery" type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" /></div>
				<div class="Lb1" style="width:110px;">
                <?php $this->assign('img', ((is_array($_tmp=$this->_tpl_vars['list']['pic'])) ? $this->_run_mod_handler('explode_one', true, $_tmp, ",") : smarty_modifier_explode_one($_tmp, ","))); ?>
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand&s=demand_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
"><?php echo smarty_function_html_image(array('file' => "uploadfile/zsimg/size_small/".($this->_tpl_vars['img']).".jpg",'width' => 100,'alt' => $this->_tpl_vars['list']['title']), $this);?>
</a>
                </div>
                
                <div class="Lb77">
                <p style="font-size:14px; font-weight:bold;">
                <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/demand_<?php echo $this->_tpl_vars['list']['type']; ?>
.gif"  align="absmiddle">
				<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=demand&s=demand_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
"><?php echo $this->_tpl_vars['list']['title']; ?>
</a>
				<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

                </p>
				<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...", true) : smarty_modifier_truncate($_tmp, 200, "...", true)); ?>
<br/>
                <?php if (! $_GET['key']): ?>
				<span><a rel="nofollow" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&action=demand_list&m=demand" target="_blank" style="color:#005BA6" />Все предложения</a> от компании <a rel="nofollow" style="color:#005BA6" href="<?php echo smarty_function_geturl(array('type' => '','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
" target="_blank" ><?php echo $this->_tpl_vars['list']['company']; ?>
</a> <img src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/cflag/<?php echo $this->_tpl_vars['list']['flag']; ?>
.gif' /> <?php echo $this->_tpl_vars['list']['province']; ?>
 | <?php echo $this->_tpl_vars['list']['city']; ?>
</span>
                <?php endif; ?>
				
                <div class="Lb67">
				<a rel="nofollow" href="<?php echo smarty_function_geturl(array('type' => 'mail','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
"><?php echo $this->_tpl_vars['lang']['now_requier']; ?>
</a><br />
				<a href="javascript:add_inquery('info','<?php echo $this->_tpl_vars['config']['weburl']; ?>
','<?php echo $this->_tpl_vars['list']['id']; ?>
');">В рассылку</a>
                </div>
				</div>
		</li>
		<?php endforeach; endif; unset($_from); ?>
        </ul>
		<div class="page"><?php echo $this->_tpl_vars['info']['page']; ?>
</div>
        <div class="clear"></div>
		<!--  PRODUCT LIST END -->
	</div>
</div>
</div>
		<div class="leftbar1">
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

                <ul class="phone"><span style="padding-left:25px;">Горячая линия:</span><br />

		<span class="o16" style="padding-left:25px;"><?php echo $this->_tpl_vars['config']['owntel']; ?>
</span></ul>

                <ul style="height:60px;"><li><a href="/register.php"><img width="99" height="28" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/btn1.jpg"></a></li>

                  <li><a href="main.php?action=m&amp;m=demand&amp;s=admin_demand&amp;menu=info"><img width="99" height="28" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
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

                  <li><a href="main.php?action=m&amp;m=demand&amp;s=admin_demand&amp;menu=info"><img width="99" height="28" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
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
/?m=ask&s=ask_list"><img src="image/default/more.gif" width="36" height="13" border="0" /></a></span></div>

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
			<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=16&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
		</div>


	<!--contents end-->
	</div>
</div>
<!--bodybox end-->
<script>
function do_select()
{
	 var box_l = document.getElementsByName("inquery").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
		if(document.getElementsByName("inquery")[j].checked==true)
		  document.getElementsByName("inquery")[j].checked = false;
		else
		  document.getElementsByName("inquery")[j].checked = true;
	 }
}
function get_inquery()
{	
	var pid='';
	var boxes = document.getElementsByName("inquery");   
	for (var i = 0; i < boxes.length; i++)  
	{  
		if(boxes[i].checked)  
		{  
			pid+=boxes[i].value+',';  
		} 
	}
	window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/inquire.php?contype=2&demandid='+pid;
}
</script>