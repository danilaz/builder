<?php /* Smarty version 2.6.20, created on 2013-01-17 21:24:35
         compiled from exhibition_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'exhibition_list.htm', 81, false),array('modifier', 'strip_tags', 'exhibition_list.htm', 82, false),array('modifier', 'date_format', 'exhibition_list.htm', 84, false),array('insert', 'getExh', 'exhibition_list.htm', 119, false),)), $this); ?>
<script language="javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/Calendar.js"></script>
<script language="javascript">
	var cdr = new Calendar("cdr");
	document.write(cdr);
	cdr.showMoreDay = true;
</script>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/exhibition.css" rel="stylesheet" type="text/css" />
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition"><?php echo $this->_tpl_vars['lang']['exh_center']; ?>
</a>
    </div>
    <div class="headtop_R"></div>		
</div>
	<div id="mainbody1" class="m1">
		<div class="leftbar_exhibition">
		<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=31&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
			<div class="title4"><div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['exh_list']; ?>
</div></div>
			<div class="content4 overflow" style="padding:5px 20px;">
			<div style="border-bottom:1px solid #cfcfcf;margin-bottom:5px;line-height:28px; text-align:left; padding:5px;">
<form action="" method="get">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $this->_tpl_vars['lang']['keyword']; ?>
</td>
    <td><input name="key" value="<?php echo $_GET['key']; ?>
" type="text" /></td>
  </tr>
  <tr>
    <td><?php echo $this->_tpl_vars['lang']['hcity']; ?>
</td>
    <td><input name="city" type="text" id="city" size="15" maxlength="20" value="<?php if ($_GET['city']): ?><?php echo $_GET['city']; ?>
<?php endif; ?>"/>
</td>
  </tr>
  <tr>
    <td><?php echo $this->_tpl_vars['lang']['eroom']; ?>
</td>
    <td>
<select name="sroom" id="sroom">
  <option value=""><?php echo $this->_tpl_vars['lang']['rooms']; ?>
</option>
 <?php $_from = $this->_tpl_vars['sroom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
 <option value="<?php echo $this->_tpl_vars['list']['show_room_name']; ?>
" <?php if ($_GET['sroom'] == $this->_tpl_vars['list']['show_room_name']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['list']['show_room_name']; ?>
</option>
 <?php endforeach; endif; unset($_from); ?>
</select></td>
  </tr>
    <tr>
    <td><?php echo $this->_tpl_vars['lang']['shtime']; ?>
</td>
    <td><input name="showtime" type="text" id="showtime" size="15" onFocus="cdr.show(this);" value="<?php if ($_GET['showtime']): ?><?php echo $_GET['showtime']; ?>
<?php endif; ?>"/>
-
<input name="endshowtime" type="text" id="endshowtime" size="15" onFocus="cdr.show(this);" value="<?php if ($_GET['endshowtime']): ?><?php echo $_GET['endshowtime']; ?>
<?php endif; ?>"/></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>
	<input name="m" type="hidden" value="exhibition" />
	<input name="s" type="hidden" value="exhibition_list" />
	<input type="submit" id="search" value="<?php echo $this->_tpl_vars['lang']['esearch']; ?>
" />
	</td>
  </tr>
</table>
</form>
</div>		
		<ul class="list6">
                    <li>
                 		<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr height="30">
                        <td colspan="2" bgcolor="#EEEEEE" ><?php echo $this->_tpl_vars['lang']['exh_list']; ?>
</td>
                        <td width="500" bgcolor="#EEEEEE"><?php echo $this->_tpl_vars['lang']['exh_time']; ?>
</td>
                      </tr>
					  <tr height="4">
                        <td colspan="2"></td>
                        <td width="500"></td>
                      </tr>
                      <?php $_from = $this->_tpl_vars['exhibition']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                      <tr>
                        <td width="11%">
                        <a rel="nofollow" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition&s=exhibition_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">
						<?php if ($this->_tpl_vars['list']['pic'] != ''): ?>
                        &nbsp;&nbsp;<img width="100" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/exhibitimg/<?php echo $this->_tpl_vars['list']['pic']; ?>
.jpg"  alt="<?php echo $this->_tpl_vars['list']['title']; ?>
" />
						<?php else: ?>
						&nbsp;&nbsp; <img width="100" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
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
                        <td align="center">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['stime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<br/>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['etime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                      </tr>
					  <tr height="1">
					    <td colspan="3">
						   <hr size="1" width="100%"  noshade style="border:1px dotted #dddddd">
						</td>
					  <tr>
                      <?php endforeach; else: ?>
                      <tr>
                        <td colspan="3">
                        	<?php echo $this->_tpl_vars['lang']['no_exh']; ?>
 
                            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php">
                            <?php echo $this->_tpl_vars['lang']['add_info']; ?>
 </a>
                        </td>
                      </tr>
                      <?php endif; unset($_from); ?>
                      <tr><td colspan="3"><?php echo $this->_tpl_vars['exhibition']['page']; ?>
</td></tr>
                    </table>

					</li>
				</ul>
			  </div>
		</div>
		<!--主体左侧结束 -->
		
		<!--主体右侧开始 -->
		<div class="rightbar">
		<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=32&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
			<div class="right1">
			<div class="right1">
				<div class="sectitle" >
					<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['rec_exh']; ?>
</div>
		        </div>
				<div class="seccon" >
					<ul class="li_list">
					 	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getExh', 'leng' => '200', 'limit' => 15, 'rec' => 'true')), $this); ?>

				   </ul>
                   <div class="clear"></div>
			    </div>
				<div class="clear"></div>
			</div>
		</div>		
		<!--主体右侧结束 -->
	</div>
	<!--主体结束 -->	