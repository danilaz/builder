<?php /* Smarty version 2.6.20, created on 2013-02-28 15:49:55
         compiled from search_product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getPro', 'search_product_list.htm', 18, false),array('function', 'geturl', 'search_product_list.htm', 160, false),array('function', 'html_image', 'search_product_list.htm', 161, false),array('modifier', 'truncate', 'search_product_list.htm', 165, false),array('modifier', 'number_format', 'search_product_list.htm', 169, false),array('modifier', 'explode_one', 'search_product_list.htm', 183, false),array('modifier', 'strip_tags', 'search_product_list.htm', 199, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product'><?php echo $this->_tpl_vars['lang']['procat']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['guide']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>

	<div id="mainbody1" class="topm">
	
		<div class="leftbar1">
			<div class="left2">
				<div class="title9" >
					<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['recpro']; ?>
</div><div class="more"></div>
		        </div>
				 <div class="content9">
					<ul class="list8">
					 	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getPro', 'leng' => '20', 'rec' => '2', 'img' => 'true', 'limit' => 6)), $this); ?>

				   </ul>
			    </div>
			  	<div class="bottom9"></div>
			</div>
		</div>

		<div class="big_img_div" id="big_img_div" style="display:none;">&nbsp;</div>
		<div class="rightbar1_search">
        <?php if ($this->_tpl_vars['subcat']['0']['cat'] || $this->_tpl_vars['brand']['0']['name']): ?>
			<div class="title10">
            	<div class="title_left L2"><?php echo $this->_tpl_vars['lang']['catnav']; ?>
</div>
            </div>
				<div class="content10">
					 <?php $_from = $this->_tpl_vars['subcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
						&nbsp;<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
 (<?php echo $this->_tpl_vars['list']['rec_nums']; ?>
)</a> &nbsp;
					 <?php endforeach; endif; unset($_from); ?>

                   
                   <?php if ($this->_tpl_vars['brand']['0']['name']): ?>
                   	<br><hr size="1"  noshade style="border:1px dotted #dddddd;float:left;width:750px;display:inline;"><br>
                      <span style="width:100%;float:left;text-align:left;line-height:25px;"><?php echo $this->_tpl_vars['lang']['brands']; ?>
</span>
                   <?php $_from = $this->_tpl_vars['brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&brand=<?php echo $this->_tpl_vars['list']['name']; ?>
&id=<?php echo $_GET['id']; ?>
&trade_type=<?php echo $_GET['trade_type']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a> &nbsp;&nbsp;
                   <?php endforeach; endif; unset($_from); ?>
                   <?php endif; ?>
			    </div>
            <div class="bottotopm0" style="margin-bottom:5px"></div>
		<?php endif; ?>

			<div class="title10">
            	<div class="title_left L2"><?php echo $this->_tpl_vars['lang']['prolist']; ?>
</div>
                <div class="lookmore">
                    <?php if ($this->_tpl_vars['config']['domaincity'] && $this->_tpl_vars['config']['base_url']): ?>
                        <a href="http://www.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
/?m=product&s=product_list&id=<?php echo $_GET['id']; ?>
"><?php echo $this->_tpl_vars['lang']['lookmore']; ?>
<?php echo $this->_tpl_vars['current_cat']; ?>
</a>
                    <?php endif; ?>
                </div>
            </div>
			<div class="content10">
			<div style="float:left;width:780px; padding:10px;text-align:left; border-bottom:2px solid #BAD9EF;">
            <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/" method="get">
			<input id="m" name="m" type="hidden" value="product" />
			<input id="s" name="s" type="hidden" value="product_list" />
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="230" style="line-height:30px;">
                <?php echo $this->_tpl_vars['lang']['keyw']; ?>
<input style="width:150px;" size="5" name="key" value="<?php echo $_GET['key']; ?>
" type="text" /><br />
                 <?php echo $this->_tpl_vars['lang']['tt']; ?>
<select style="width:155px;"  name="trade_type">
                        <?php $_from = $this->_tpl_vars['trade_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['prot']):
?>
                          <?php if ($_GET['trade_type'] == $this->_tpl_vars['num']): ?>selected='selected'<?php endif; ?> ><?php echo $this->_tpl_vars['prot']; ?>
<option value="<?php echo $this->_tpl_vars['num']; ?>
" <?php if ($_GET['trade_type'] == $this->_tpl_vars['num']): ?>selected='selected'<?php endif; ?> ><?php echo $this->_tpl_vars['prot']; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                        </select>
                </td>
                <td width="200" style="line-height:30px;">
                <?php echo $this->_tpl_vars['lang']['pric']; ?>
<input size="5" name="sprice" type="text" value="<?php echo $_GET['sprice']; ?>
" />-<input value="<?php echo $_GET['eprice']; ?>
" size="5" name="eprice" type="text" /><br />
                 <?php echo $this->_tpl_vars['lang']['utype']; ?>
<select name="ifpay" style="width:110px;">
                  <option value="0"><?php echo $this->_tpl_vars['lang']['allu']; ?>
</option>
                  <?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                      <?php if ($this->_tpl_vars['num'] > 1 && $this->_tpl_vars['list']['statu'] == 1): ?>
                      <option value="<?php echo $this->_tpl_vars['list']['group_id']; ?>
" <?php if ($_GET['ifpay'] == $this->_tpl_vars['list']['group_id']): ?>selected='selected'<?php endif; ?> ><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
                      <?php endif; ?>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
                </td>
                <td><input type="submit" value="<?php echo $this->_tpl_vars['lang']['isure']; ?>
" /></td>
              </tr>
            </table>
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
					function goto(v,type)
					{
						var url='<?php echo $this->_tpl_vars['queryurl']; ?>
';
						if(type==1)
							window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&orderby='+v+url;
						if(type==2)
							window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&province='+v+url;
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
/inquire.php?contype=1&pid='+pid;
					}
					</script>
			 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:1px dashed #BAD9EF; margin-top:5px;">
                  <tr style="padding:3px;">
                    <td width="310">
                    <input onclick="do_select();" name="" type="checkbox" value="" />
                    <input onclick="get_inquery();" name="" type="button" value="Пакетный запрос" />
                    <input onclick="add_inquery('pro','<?php echo $this->_tpl_vars['config']['weburl']; ?>
','');" name="" type="button" value="Добавить в корзину" />
                	</td>
                    <td width="300" align="center">
                     <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&show_type=1<?php echo $this->_tpl_vars['queryurl']; ?>
">
                     <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/col_list.gif" /><?php echo $this->_tpl_vars['lang']['ls']; ?>

                     </a>
                     <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&show_type=2<?php echo $this->_tpl_vars['queryurl']; ?>
">
                     <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/row_list.gif" /><?php echo $this->_tpl_vars['lang']['bp']; ?>

                     </a>
                   <?php echo $this->_tpl_vars['lang']['rsl']; ?>
<select name="orderby" onchange="goto(this.value,1)">
                      <option <?php if ($_GET['orderby'] == 1): ?>selected='selected'<?php endif; ?> value="1"> <?php echo $this->_tpl_vars['lang']['auf']; ?>
</option>
                      <option <?php if ($_GET['orderby'] == 2): ?>selected='selected'<?php endif; ?> value="2"><?php echo $this->_tpl_vars['lang']['tf']; ?>
</option>
                      <option <?php if ($_GET['orderby'] == 3): ?>selected='selected'<?php endif; ?> value="3"><?php echo $this->_tpl_vars['lang']['tsf']; ?>
</option>
                      <option <?php if ($_GET['orderby'] == 4): ?>selected='selected'<?php endif; ?> value="4"><?php echo $this->_tpl_vars['lang']['pf']; ?>
</option>
                      <option <?php if ($_GET['orderby'] == 5): ?>selected='selected'<?php endif; ?> value="5"><?php echo $this->_tpl_vars['lang']['psf']; ?>
</option>
                    </select>
                    &nbsp;&nbsp;
                    <?php echo $this->_tpl_vars['lang']['dfee']; ?>

                    </td>
                    <td>
                    <?php echo $this->_tpl_vars['lang']['addrs']; ?>
<select name="province" onchange="goto()">
                      <option value="0"><?php echo $this->_tpl_vars['lang']['allcity']; ?>
</option>
                      <?php echo $this->_tpl_vars['province']; ?>

                    </select>
                	</td>
                  </tr>
                </table>
				<input  name="id" type="hidden" value="<?php echo $_GET['id']; ?>
" />
				 </form>
			</div>
			  <ul class="list9">
			  <?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
              <?php if ($_GET['show_type'] == 2): ?>
              	 <table class="listimg">
                 <tr>
                 <td align="center" colspan="2" valign="middle" class="listimg1">
                  <a rel="nofollow" href="<?php echo smarty_function_geturl(array('type' => 'prod','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user'],'tid' => $this->_tpl_vars['list']['id']), $this);?>
">
                  <?php echo smarty_function_html_image(array('file' => $this->_tpl_vars['list']['img'],'width' => 165,'alt' => $this->_tpl_vars['list']['pname']), $this);?>

                  </a>
                  </td></tr>
                  <tr><td colspan="2" align="center">
                  <a href="<?php echo smarty_function_geturl(array('type' => 'prod','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user'],'tid' => $this->_tpl_vars['list']['id']), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['pname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20) : smarty_modifier_truncate($_tmp, 20)); ?>
</a>
                  </td></tr>
                  <tr height="27">
                      <td align="left" class="smoney">
                      <input name="inquery" type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" /><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
 <?php echo $this->_tpl_vars['config']['money']; ?>
/<?php echo $this->_tpl_vars['list']['unit']; ?>

                      </td>
                      <td valign="top" align="right">
                           <?php if ($this->_tpl_vars['list']['skype'] != ''): ?>
                            <a href="skype:<?php echo $this->_tpl_vars['list']['skype']; ?>
?call"><img height="12" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/skypeonline.png"></a>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['list']['msn'] != ''): ?>
                            <a href="msnim:chat?contact=<?php echo $this->_tpl_vars['list']['msn']; ?>
">
                            <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/ico_msn.gif" height="12" align="absmiddle"/>
                            </a>
                            <?php endif; ?>
                      </td>
                  </tr>
                  <tr style="color:#808080">
                  <td>Доставка: <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['freight'])) ? $this->_run_mod_handler('explode_one', true, $_tmp, ",") : smarty_modifier_explode_one($_tmp, ",")); ?>
 <?php echo $this->_tpl_vars['config']['money']; ?>
</td>
                  <td width="80" align="right"><?php echo $this->_tpl_vars['list']['province']; ?>
</td>
                  </tr>
                  <tr><td colspan="2"><a style="color:#808080" href="<?php echo smarty_function_geturl(array('type' => '','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a></td></tr>
                  </table> 
              <?php else: ?>
                <li>
                  <div class="Lb0"><input name="inquery" type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" /></div>
                  <div class="Lb1">
                  <a rel="nofollow" href="<?php echo smarty_function_geturl(array('type' => 'prod','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user'],'tid' => $this->_tpl_vars['list']['id']), $this);?>
">
                  <?php echo smarty_function_html_image(array('onmouseout' => "view_big_img(this, '');",'onmouseover' => "view_big_img(this, this.src);",'file' => $this->_tpl_vars['list']['img'],'width' => 80,'alt' => $this->_tpl_vars['list']['pname']), $this);?>

                  </a>
                  </div>
                  <div class="Lb2">
                    <p style="font-size:14px;"><a href="<?php echo smarty_function_geturl(array('type' => 'prod','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user'],'tid' => $this->_tpl_vars['list']['id']), $this);?>
">
					<strong><?php echo $this->_tpl_vars['list']['pname']; ?>
</strong></a></p>
                    <p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100, "...", true) : smarty_modifier_truncate($_tmp, 100, "...", true)); ?>
</p>
                    <p>
                    <?php echo $this->_tpl_vars['lang']['seller']; ?>

					<a href="<?php echo smarty_function_geturl(array('type' => '','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
<?php echo $this->_tpl_vars['list']['user_type']; ?>

					</a>
                    </p>
                  </div>
                 
                  <div class="Lb3"> <span class="bmoney"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
 <?php echo $this->_tpl_vars['config']['money']; ?>
/<?php echo $this->_tpl_vars['list']['unit']; ?>
</span></div>
                  <div class="Lb3" style="width:40px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['freight'])) ? $this->_run_mod_handler('explode_one', true, $_tmp, ",") : smarty_modifier_explode_one($_tmp, ",")); ?>
</div>
                  <div class="Lb3" style="color:#666666;">
				  <?php echo $this->_tpl_vars['list']['province']; ?>
<?php echo $this->_tpl_vars['list']['city']; ?>
<br />
				  <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/inquire.php?contype=1&pid=<?php echo $this->_tpl_vars['list']['id']; ?>
">Отправить запрос</a><br />
				  <a href="javascript:add_inquery('pro','<?php echo $this->_tpl_vars['config']['weburl']; ?>
','<?php echo $this->_tpl_vars['list']['id']; ?>
');">Добавить в корзину</a>
				  </div>
                </li>
                <?php endif; ?>
				<?php endforeach; else: ?>
				  <div style="padding:20px; font-weight:bold">
				  <?php echo $this->_tpl_vars['lang']['norelinfo']; ?>

				  <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php">
				   <?php echo $this->_tpl_vars['lang']['clicktoadd']; ?>

				  </a>
				  </div>
				<?php endif; unset($_from); ?>
		      </ul>
              <div style="padding:7px;">
              <input onclick="do_select();" name="" type="checkbox" value="" />&nbsp;
              <input onclick="get_inquery();" name="" type="button" value="Пакетный запрос" />
              </div>
			  <div class="page"><?php echo $this->_tpl_vars['info']['page']; ?>
</div>
			  <div class="clear"></div>
		  </div>
			<div class="bottotopm0"></div>
		</div>	
	</div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>