<?php /* Smarty version 2.6.20, created on 2013-01-12 15:09:23
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getUser', 'product_list.htm', 43, false),array('function', 'geturl', 'product_list.htm', 165, false),array('function', 'html_image', 'product_list.htm', 166, false),array('modifier', 'truncate', 'product_list.htm', 170, false),array('modifier', 'number_format', 'product_list.htm', 174, false),array('modifier', 'explode_one', 'product_list.htm', 186, false),array('modifier', 'strip_tags', 'product_list.htm', 202, false),array('modifier', 'escape', 'product_list.htm', 210, false),)), $this); ?>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/my_lightbox.js" language="javascript"></script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/index.js"></script>
<script>
function do_select(name)
{
	var box_l = document.getElementsByName(name).length;
	for(var j = 0 ; j < box_l ; j++)
	{
		if(document.getElementsByName(name)[j].checked==true)
			document.getElementsByName(name)[j].checked = false;
		else
			document.getElementsByName(name)[j].checked = true;
	}
} 
</script>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/pro.css" rel="stylesheet" type="text/css" />
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

	<div id="main">
			<div id="left">
            <?php if ($this->_tpl_vars['subcat']['0']['cat']): ?>
			<div class="left2">
				<div class="title9" >
					<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['catnav']; ?>
</div>
		        </div>
                <ul id="sub_cat_nav" class="cat_list_show" style="z-index:99">
                	<?php $_from = $this->_tpl_vars['subcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
						<li style="padding:3px 5px 3px 7px">
                        <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</a>
                        
					<?php endforeach; endif; unset($_from); ?>
                 </ul>
			</div>
            <?php else: ?>
                <div class="nr_box rec_com">
      <div class="nr_tit">Рекомендуем сайты</div>
	  <div style="float:left; padding-left:5px;">
      <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'leng' => '31', 'field' => 'company', 'filter' => 'rec', 'limit' => 13)), $this); ?>

	  </div>
    </div>
            <?php endif; ?>
		</div>
		<div class="big_img_div" id="big_img_div" style="display:none;">&nbsp;</div>
		<div id="right">
		        <?php if ($this->_tpl_vars['brand']['0']['name']): ?>
			<div class="title10">
            	<div class="title_left L2"><?php echo $this->_tpl_vars['lang']['brands']; ?>
</div>
            </div>
				<div class="content10" style="padding-left:20px; padding-right:20px;">
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
			    </div>
            <div class="bottom10" style="margin-bottom:5px"></div>
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
			<div class="select">
            <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/" method="get">
			<input id="m" name="m" type="hidden" value="product" />
			<input id="s" name="s" type="hidden" value="product_list" />
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="line-height:30px;">
				Цены<input size="5" name="sprice" type="text" value="<?php echo $_GET['sprice']; ?>
" style="font-size:11px;" /> - 
				<input value="<?php echo $_GET['eprice']; ?>
" size="5" name="eprice" type="text" style="font-size:11px;" />
                </td>
				<td>
					<?php echo $this->_tpl_vars['lang']['tt']; ?>
 <select name="trade_type" style="font-size:11px;">
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
                 <?php echo $this->_tpl_vars['lang']['utype']; ?>
 <select name="ifpay" style="width:110px;" style="font-size:11px;">
                  <option value="0" style="font-size:11px;"><?php echo $this->_tpl_vars['lang']['allu']; ?>
</option>
                  <?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                      <?php if ($this->_tpl_vars['num'] > 1 && $this->_tpl_vars['list']['statu'] == 1): ?>
                      <option style="font-size:11px;" value="<?php echo $this->_tpl_vars['list']['group_id']; ?>
" <?php if ($_GET['ifpay'] == $this->_tpl_vars['list']['group_id']): ?>selected='selected'<?php endif; ?> ><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
                      <?php endif; ?>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
                </td>
                <td><input type="submit" value="<?php echo $this->_tpl_vars['lang']['isure']; ?>
" style="font-size:11px;" /></td>
              </tr>
            </table>
<script>
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
	var chk = false;
	for (var i = 0; i < boxes.length; i++)
	{
		if(boxes[i].checked)
		{   
			chk = true;
			pid+=boxes[i].value+',';
		}
	}
	if(!chk){
		for (var i = 0; i < boxes.length; i++)
		{
			pid+=boxes[i].value+',';
		}	
	}
	window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/inquire.php?contype=1&pid='+pid;
} 
</script>
			 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:1px dashed #BAD9EF;">
                  <tr>
                    <td width="746" align="left" style="padding-top:5px;">
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

                   <select name="orderby" onchange="goto(this.value,1)" style="font-size:11px;">
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
                    </td>
                    <td width="224" align="left" style="padding-top:5px;"><select name="province" onchange="goto()" style="font-size:11px;">
                      <option value="0" style="font-size:11px;"><?php echo $this->_tpl_vars['lang']['allcity']; ?>
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
			  <script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=10&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>

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
                  <a style="font-size:14px;color:#005AA6;" href="<?php echo smarty_function_geturl(array('type' => 'prod','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user'],'tid' => $this->_tpl_vars['list']['id']), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['pname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 120) : smarty_modifier_truncate($_tmp, 120)); ?>
</a>
                  </td></tr>
                  <tr height="27">
                      <td colspan="2" valign="top" align="center" class="smoney" width="200">
                      <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
 <?php echo $this->_tpl_vars['config']['money']; ?>
/<?php echo $this->_tpl_vars['list']['unit']; ?>
<br />
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
<!--                   <tr style="color:#808080">
                  <td>Доставка: <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['freight'])) ? $this->_run_mod_handler('explode_one', true, $_tmp, ",") : smarty_modifier_explode_one($_tmp, ",")); ?>
 <?php echo $this->_tpl_vars['config']['money']; ?>
</td>
                  <td width="80" align="right"><?php echo $this->_tpl_vars['list']['province']; ?>
</td>
                  </tr> -->
                  <tr><td colspan="2" align="center" style="padding:5px;border:1px solid #CCCCCC"><a style="color:#005AA6;" href="<?php echo smarty_function_geturl(array('type' => '','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
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
                    <p style="word-wrap:break-word;word-break:break-all;"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100, "...", true) : smarty_modifier_truncate($_tmp, 100, "...", true)); ?>
</p>
					                   <div class="Lb22">
					<p style="float:left">
                    <?php echo $this->_tpl_vars['lang']['seller']; ?>

					<a href="<?php echo smarty_function_geturl(array('type' => '','uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user']), $this);?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
<?php echo $this->_tpl_vars['list']['user_type']; ?>

					</a>
						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/inquire.php?contype=1&pid=<?php echo $this->_tpl_vars['list']['id']; ?>
" class="Lb6">Связаться</a>
						<a href="javascript:add_inquery('pro','<?php echo $this->_tpl_vars['config']['weburl']; ?>
','<?php echo $this->_tpl_vars['list']['id']; ?>
');" class="Lb66">В корзину</a>                 
						<?php if ($this->_tpl_vars['list']['add_crm'] == 1): ?><span id="add_crm_a_<?php echo $this->_tpl_vars['list']['id']; ?>
"><a  href="javascript:addToCRM(this,'<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['company'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
',<?php echo $this->_tpl_vars['list']['userid']; ?>
,<?php echo $this->_tpl_vars['list']['id']; ?>
);">Add-To-CRM</a></span><?php endif; ?>
                     </p>
					 </div>
                  </div>
                  <div class="Lb3"> <span class="bmoney"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
 <?php echo $this->_tpl_vars['config']['money']; ?>
/<?php echo $this->_tpl_vars['list']['unit']; ?>
</span></div>
                  <!-- <div class="Lb4"><?php echo $this->_tpl_vars['lang']['dfee']; ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['freight'])) ? $this->_run_mod_handler('explode_one', true, $_tmp, ",") : smarty_modifier_explode_one($_tmp, ",")); ?>
</div>
                  <div class="Lb5"><?php echo $this->_tpl_vars['list']['province']; ?>
 <?php echo $this->_tpl_vars['list']['city']; ?>
</div> -->

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
              <div style="padding:7px 30px; float:left;">
              <input onclick="do_select('inquery');" name="" type="checkbox" value="" />&nbsp;
              <input onclick="get_inquery();" name="" type="button" value="Пакетный запрос" />
              </div>
			  <div class="page"><?php echo $this->_tpl_vars['info']['page']; ?>
</div>
              <div class="clear"></div>
		  </div>
			<div class="bottom10"></div>
		</div>	
	</div>
<script>
var curr_id;
function addToCRM(e,title,uid,pid)
{
	curr_id=pid;
	alertWin(title,'',630,400,'<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?action=m&m=crm&s=crm_add_ajax&uid='+uid);
}
function addComplete(id)
{
	try{$('add_crm_a_'+curr_id).innerHTML='';}catch(e){}
	close_win();
}
</script>