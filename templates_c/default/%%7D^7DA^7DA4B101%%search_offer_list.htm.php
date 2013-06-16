<?php /* Smarty version 2.6.20, created on 2013-03-09 08:15:40
         compiled from search_offer_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'search_offer_list.htm', 17, false),array('modifier', 'urlencode', 'search_offer_list.htm', 56, false),array('modifier', 'explode_one', 'search_offer_list.htm', 91, false),array('modifier', 'strip_tags', 'search_offer_list.htm', 100, false),array('modifier', 'truncate', 'search_offer_list.htm', 100, false),array('modifier', 'date_format', 'search_offer_list.htm', 105, false),array('function', 'html_image', 'search_offer_list.htm', 92, false),array('function', 'geturl', 'search_offer_list.htm', 98, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <strong><a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer'><?php echo $this->_tpl_vars['lang']['offercat']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['guide']; ?>
</a></strong>
    </div>
    <div class="headtop_R"></div>		
</div>

<div id="mainbody1" class="topm">
		<div class="leftbar1">
			<div class="left2">
				<div class="title9" >
					<div class="title_left1 L2">Регионы</div><div class="more"></div>
		        </div>
				 <div class="content9">
					<ul class="list2">
					<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'province', 'temp' => 'province_buylist')), $this); ?>

				   </ul>
			    </div>
			  	<div class="bottom9"></div>
			</div>
			
		</div>

		<!--主体左侧结束 -->
		<div class="rightbar1_search">
				<!---subcat start-->
			<?php if ($this->_tpl_vars['subcat']['0']['catid']): ?>
				<div class="title10"><div class="title_left L2"><?php echo $this->_tpl_vars['lang']['cat_nav']; ?>
</div></div>
				<div class="content10" >
					<ul class="nav_list">
						<?php $_from = $this->_tpl_vars['subcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
							<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
 (<?php echo $this->_tpl_vars['list']['rec_nums']; ?>
)</a>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
				</div>
				<div class="bottotopm0" style="margin-bottom:5px"></div>
			<?php endif; ?>
			<!---subcat end-->
			<div class="title10"><div class="title_left L2"><?php echo $this->_tpl_vars['lang']['offer_list']; ?>
</div>
                 <div class="lookmore">
                    <?php if ($this->_tpl_vars['config']['domaincity'] && $this->_tpl_vars['config']['base_url']): ?>
                        <a href="http://www.<?php echo $this->_tpl_vars['config']['base_url']; ?>
/?m=offer&s=offer_list&id=<?php echo $_GET['id']; ?>
"><?php echo $this->_tpl_vars['lang']['lookmore']; ?>
<?php echo $this->_tpl_vars['current_cat']; ?>
</a>
                    <?php endif; ?>
                </div>
            
            </div>
			<div class="content10">
				
			<div style="float:left;width:100%;margin:10px;text-align:left;">
                <input onclick="do_select();" name="" type="checkbox" value="" />
                <input onclick="get_inquery();" name="" type="button" value="Пакетный запрос" />
                <input onclick="add_inquery('info','<?php echo $this->_tpl_vars['config']['weburl']; ?>
','');" name="" type="button" value="Добавить в рассылку" />
                &nbsp;&nbsp;
				<?php $_from = $this->_tpl_vars['infoType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
				<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_list&catType=<?php echo $this->_tpl_vars['num']; ?>
&id=<?php echo $_GET['id']; ?>
&key=<?php echo ((is_array($_tmp=$_GET['key'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><img alt="<?php echo $this->_tpl_vars['list']; ?>
" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/offer_<?php echo $this->_tpl_vars['num']; ?>
.gif"/></a>
				<?php endforeach; endif; unset($_from); ?>
				<hr size="1" width="99%"  noshade style="border:1px dotted #dddddd">
			</div>  
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
/inquire.php?contype=2&offerid='+pid;
					}
					</script>
        <ul class="list9" style="float:left;">
		<?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        	<li>
            	<div class="Lb0"><input name="inquery" type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" /></div>
				<div class="Lb1" style="width:110px;">
                <?php $this->assign('img', ((is_array($_tmp=$this->_tpl_vars['list']['pic'])) ? $this->_run_mod_handler('explode_one', true, $_tmp, ",") : smarty_modifier_explode_one($_tmp, ","))); ?>
                <?php echo smarty_function_html_image(array('file' => "uploadfile/zsimg/size_small/".($this->_tpl_vars['img']).".jpg",'width' => 100,'alt' => $this->_tpl_vars['list']['title']), $this);?>

                </div>
                
                <div class="Lb2">
                <p style="font-size:14px; font-weight:bold;">
                <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/offer_<?php echo $this->_tpl_vars['list']['type']; ?>
.gif"  align="absmiddle">
				<a href="<?php echo smarty_function_geturl(array('type' => 'infod','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user'],'tid' => $this->_tpl_vars['list']['id']), $this);?>
" target="_blank" title="<?php echo $this->_tpl_vars['list']['title']; ?>
"><?php echo $this->_tpl_vars['list']['title']; ?>
</a>
                </p>
				<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...", true) : smarty_modifier_truncate($_tmp, 200, "...", true)); ?>
<br/>
                <?php if (! $_GET['key']): ?>
				<span><a rel="nofollow" href="<?php echo smarty_function_geturl(array('type' => 'infolist','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
" target="_blank" ><?php echo $this->_tpl_vars['lang']['browse_more']; ?>
</a>  <a rel="nofollow" href="<?php echo smarty_function_geturl(array('type' => '','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
" target="_blank" ><?php echo $this->_tpl_vars['list']['company']; ?>
</a></span>
                <?php endif; ?>
                </div>
                <div class="Lb3"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</div>
                <div class="Lb3">
				[<?php echo $this->_tpl_vars['list']['province']; ?>
&nbsp;<?php echo $this->_tpl_vars['list']['city']; ?>
]<br />
				<img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/listicon_inquiry.gif" width="18" align="absmiddle" border="0" height="14"> <a rel="nofollow" href="<?php echo smarty_function_geturl(array('type' => 'mail','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
"><?php echo $this->_tpl_vars['lang']['now_requier']; ?>
</a>
                </div>
		</li>
		<?php endforeach; else: ?>
				  <div style="padding:20px; font-weight:bold">
				 <?php echo $this->_tpl_vars['lang']['no_offer']; ?>
 
				  <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php">
				   <font color="#FF0000">
				  <?php echo $this->_tpl_vars['lang']['now_add']; ?>

				  </font>
				  </a>
				  </div>
			<?php endif; unset($_from); ?>
        </ul>
		<div class="page"><?php echo $this->_tpl_vars['info']['page']; ?>
</div>
		<!--  PRODUCT LIST END -->
		<div class="clear"></div>
	</div>
	
	<!--contents end-->
	</div>
</div>
<!--bodybox end-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>