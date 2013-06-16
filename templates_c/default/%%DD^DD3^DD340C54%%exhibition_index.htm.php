<?php /* Smarty version 2.6.20, created on 2013-01-12 19:54:03
         compiled from exhibition_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'exhibition_index.htm', 16, false),array('modifier', 'truncate', 'exhibition_index.htm', 73, false),array('modifier', 'strip_tags', 'exhibition_index.htm', 74, false),array('modifier', 'date_format', 'exhibition_index.htm', 76, false),)), $this); ?>
<script language="javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/Calendar.js"></script>
<script language="javascript">
	var cdr = new Calendar("cdr");
	document.write(cdr);
	cdr.showMoreDay = true;
</script>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/exhibition.css" rel="stylesheet" type="text/css" />
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['exh_center']; ?>
</a>
    </div>
    <div class="headtop_R"></div>		
</div>

	<div id="mainbody1" class="m1">
    	<div class="ex_fla"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_flash', 'flash' => true, 'img' => 'true', 'width' => '325', 'height' => '240', 'limit' => 10)), $this); ?>
</div>
        <div class="zhanhui_news"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'exhibition', 'temp' => 'exhibition_lasted', 'limit' => 10)), $this); ?>
</div>
        <div class="ex_ex"> 
            <div class="sectitle"><div class="title_left1 L2">&nbsp;<?php echo $this->_tpl_vars['lang']['ser_exh']; ?>
</div></div>       
           	<div class="seccon">
			<form name="exh_serarch" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/" method="GET">
			<table class="zhanhui_search" align="center">
				<tr><td width="60"><strong><?php echo $this->_tpl_vars['lang']['keyword']; ?>
</strong></td>
                <td><input style="width:180px;" type="text" name="key"></td></tr>
				<tr><td width="60"><strong><?php echo $this->_tpl_vars['lang']['time']; ?>
</strong></td><td><select name="years" style="font-size:11px;"><option value='' selected="selected"><?php echo $this->_tpl_vars['lang']['select_year']; ?>
</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014<option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option></select>
				&nbsp;&nbsp;&nbsp;<select name="months" style="font-size:11px;"><option value="" selected="selected"><?php echo $this->_tpl_vars['lang']['select_mothe']; ?>
</option><option value="1">01</option><option value="2" >02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6" >06</option><option value="7">07</option><option value="8" >08</option><option value="9" >09</option><option value="10">10</option><option value="11" >11</option><option value="12">12</option></select></td></tr>
				<tr>
				  <td style="height:28px;">&nbsp;</td>
				  <td>
				  <input name="m" type="hidden" value="exhibition" />
				  <input name="s" type="hidden" value="exhibition_list" />
				  <input style="margin:5px 0px 4px 0;font-size:11px;" type="submit" value="<?php echo $this->_tpl_vars['lang']['search']; ?>
 выставки" />
				  </td>
			  </tr>  
			</table>
			</form>
		    <div style="line-height:28px; border-bottom:1px dashed silver; font-size:14px; font-weight:bold;"><?php echo $this->_tpl_vars['lang']['exh_cop']; ?>
</div>
			<table align="center" style="line-height:18px;">
				<tr><td width="70" align="center" valign="middle"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/zhanhui_server.gif"></td>
				<td><?php echo $this->_tpl_vars['lang']['whant_send']; ?>
<br>
				<span style="color:#cc0000;font-weight:bold;"><?php echo $this->_tpl_vars['lang']['tell']; ?>
<?php echo $this->_tpl_vars['config']['owntel']; ?>
</span></td></tr>
			</table>

			    </div>
        </div>
        <div class="clear" style="height:10px;"></div>
		<div class="leftbar_exhibition" style="float:right;">
			<div class="title4">
                <div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['rec_exh']; ?>
</div>
                <div class="more">
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_list">
                <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/more.gif" />
                </a>
                </div>
            </div>
			<div class="content4">
					<ul class="list6">
                    <li>
					<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=30&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
                 		<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <?php $_from = $this->_tpl_vars['exhibition']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                      <tr>
                        <td width="11%">
                        <a rel="nofollow" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">
						<?php if ($this->_tpl_vars['list']['pic'] != ''): ?>
                        <img width="100" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/exhibitimg/<?php echo $this->_tpl_vars['list']['pic']; ?>
.jpg"  alt="<?php echo $this->_tpl_vars['list']['title']; ?>
" />
						<?php else: ?>
						 <img width="100" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/nopic.gif"  alt="<?php echo $this->_tpl_vars['list']['title']; ?>
" />
						<?php endif; ?>
                         </a>
                        </td>
                        <td width="70%">
                        <strong><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" target="_blank" style="margin-left:5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 150, "...", true) : smarty_modifier_truncate($_tmp, 150, "...", true)); ?>
</a></strong><br/>
                        	<font style="font-weight:100;margin-left:5px;"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 150, "...", true) : smarty_modifier_truncate($_tmp, 150, "...", true)); ?>
</font><br />
				            &nbsp;&nbsp;[<?php echo $this->_tpl_vars['list']['country']; ?>
-<?php echo $this->_tpl_vars['list']['city']; ?>
]&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['list']['showroom']; ?>
</td>
                        <td align="center" width="19%">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['stime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<br/>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['etime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                      </tr>
					  <tr height="1">
					    <td colspan="3">
						   <hr size="1" width="100%"  noshade style="border-top:1px dashed #dddddd">
						</td>
					  <tr>
                      <?php endforeach; else: ?>
                      <tr>
                        <td colspan="3">
                        	<?php echo $this->_tpl_vars['lang']['no_exh']; ?>
<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php"><?php echo $this->_tpl_vars['lang']['add_info']; ?>
 </a>
                        </td>
                      </tr>
                      <?php endif; unset($_from); ?>
                    </table>

					</li>
				</ul>
		  </div>
		</div>
		<div class="rightbar" style="float:left; margin-left:0px;">
			<div class="right1">
				<div class="sectitle" >
					<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['showroom']; ?>
</div>
		        </div>
				 <div class="seccon">
					<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'showroom', 'temp' => 'exhibition_showroom', 'limit' => 5)), $this); ?>

                    <div class="clear"></div>
			     </div>
		  </div>
			<div class="right1 m1">
				<div class="sectitle" >
					<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['news']; ?>
</div>
		        </div>
				<div class="seccon" >
					<ul class="li_list">
                        <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_default_list', 'catname' => 'Новости с выставок', 'leng' => 28, 'limit' => 5)), $this); ?>

				   </ul>
                   <div class="clear"></div>
			    </div>
				<div class="clear"></div>
			</div>
		</div>		
	</div>	