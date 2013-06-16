<?php /* Smarty version 2.6.20, created on 2013-01-15 09:10:20
         compiled from change_link.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!--主体开始 -->
	<div id="mainbody1" class="topm">
		
		<!--主体左侧开始 -->
		<div class="leftbar">

		<div class="title4"><div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['flink']; ?>
</div></div>
		<div class="content4">
		<table style="width:100%" border="0" cellpadding="0" cellspacing="0">      
      <tr valign="top">
        <td height="196">
		<?php if ($_GET['type'] == 1): ?>
		<div style="padding:20px; color:#FF0000;"><?php echo $this->_tpl_vars['lang']['link_msg']; ?>
</div>
		<?php else: ?>
		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:5px;">
          <tr>
            <td height="39" valign="top" bgcolor="#FFFFFF" style="line-height:30px; padding:5px;">
		<?php $_from = $this->_tpl_vars['link']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
			<a href="<?php echo $this->_tpl_vars['list']['url']; ?>
"  target="_blank" ><?php if ($this->_tpl_vars['list']['log']): ?><img src="<?php echo $this->_tpl_vars['list']['log']; ?>
"><?php else: ?><?php echo $this->_tpl_vars['list']['name']; ?>
<?php endif; ?></a>
		<?php endforeach; endif; unset($_from); ?>
			</td>
          </tr>
        </table>
		<?php endif; ?>
		</td>
      </tr>
      <tr valign="top">
        <td height="64">
		<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF" style="margin-left:5px;">
          <form action="" method="post" name="frmlink" id="frmlink" onsubmit="return checkform();">
            <tr bgcolor="#0066FF">
              <td height="22" colspan="2" bgcolor="#DDDDDD" style="padding:10px;"><font color="#000"  ><strong><?php echo $this->_tpl_vars['lang']['change_link']; ?>
</strong></td>
              </tr>
            <tr bgcolor="#EEEEEE">
              <td width="17%" height="30" style="padding:10px;"><?php echo $this->_tpl_vars['lang']['site_name']; ?>
</td>
              <td width="83%" height="30"><input type="text" name="linkname" size="40" /></td>
            </tr>
            <tr bgcolor="#EEEEEE">
              <td height="30" style="padding:10px;"><?php echo $this->_tpl_vars['lang']['site_url']; ?>
</td>
              <td height="30"><input type="text" name="url" size="40" /></td>
            </tr>
            <tr bgcolor="#EEEEEE">
              <td height="30" style="padding:10px;"><?php echo $this->_tpl_vars['lang']['logo_url']; ?>
</td>
              <td height="30"><input name="email" type="text" id="email" size="40" /></td>
            </tr>
            <tr bgcolor="#EEEEEE">
              <td height="30" style="padding:10px;">&nbsp;</td>
              <td height="30"><input type="submit" name="Submit" value="<?php echo $this->_tpl_vars['lang']['submit_link']; ?>
" /></td>
            </tr>
            <tr bgcolor="#0066FF">
              <td height="22" colspan="2" bgcolor="#DDDDDD" style="padding:10px;"><font color="#000"  ><?php echo $this->_tpl_vars['lang']['chlink_msg']; ?>
</td>
              </tr>
          </form>
        </table></td>
      </tr>
    </table>
<script>
function checkform()
{
	frm=document.frmlink;
	if(frm.linkname.value==""){
		alert("<?php echo $this->_tpl_vars['lang']['empty_sname']; ?>
");
		frm.linkname.focus();
		return false;
	}
	if(frm.url.value==""){
		alert("<?php echo $this->_tpl_vars['lang']['empty_surl']; ?>
");
		frm.url.focus();
		return false;
	}
}
</script>
 <div class="bottom4"></div>
</div>
</div>
<!--主体左侧结束 -->
<!--主体右侧开始 -->
		<div class="rightbar">
			<div class="right1">
				<div class="sectitle"  style="background:#366FAA;"><div class="title_left1 L2" style=" color:#FFFFFF;"><?php echo $this->_tpl_vars['lang']['site_link']; ?>
</div></div>
				 <div class="seccon">
					<ul style="line-height:22px;overflow:hidden;">
                        <?php $_from = $this->_tpl_vars['con_groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                        <li style="display:block;">
                        	<b><?php echo $this->_tpl_vars['list']['title']; ?>
</b>
                        	<?php $_from = $this->_tpl_vars['all_web']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['li']):
?>
                            <?php if ($this->_tpl_vars['li']['con_group'] == $this->_tpl_vars['list']['id']): ?><div <?php if ($this->_tpl_vars['li']['con_linkaddr'] == 'change_link.php'): ?>class='curr_web_con'<?php endif; ?>><a href="<?php echo $this->_tpl_vars['li']['con_linkaddr']; ?>
"><?php echo $this->_tpl_vars['li']['con_title']; ?>
</a></div><?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </li>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php $_from = $this->_tpl_vars['all_web']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['li']):
?>
                        <?php if ($this->_tpl_vars['li']['con_group'] < 1): ?>
                        <li><b><a href="<?php echo $this->_tpl_vars['li']['con_linkaddr']; ?>
"><?php echo $this->_tpl_vars['li']['con_title']; ?>
</a></b></li><?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
				    </ul>
			    </div>
			  	<div class="bottom5"></div>
				<div class="clear"></div>
				</div>
		</div>		
		<!--主体右侧结束 -->
</div>
<!--主体结束 -->	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>