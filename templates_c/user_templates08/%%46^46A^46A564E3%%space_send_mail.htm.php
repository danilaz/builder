<?php /* Smarty version 2.6.20, created on 2012-10-29 21:53:48
         compiled from /var/www/ekolobok/data/www/ekolobok.com/templates/default/space_send_mail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', '/var/www/ekolobok/data/www/ekolobok.com/templates/default/space_send_mail.htm', 13, false),array('modifier', 'date_format', '/var/www/ekolobok/data/www/ekolobok.com/templates/default/space_send_mail.htm', 47, false),)), $this); ?>
<div class="common_box">
<script language="javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/my_lightbox.js"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="guide_ba"><span><?php echo $this->_tpl_vars['lang']['contect']; ?>
</span></td>
  </tr>
  <tr>
    <td width="20%" align="right" class="borderC"><?php echo $this->_tpl_vars['lang']['area']; ?>
</td>
    <td width="80%" class="borderC"><?php echo $this->_tpl_vars['com']['province']; ?>
·<?php echo $this->_tpl_vars['com']['city']; ?>
 </td>
  </tr>
  <tr>
    <td align="right" class="borderC"><?php echo $this->_tpl_vars['lang']['addr']; ?>
</td>
    <td class="borderC"><a onclick="alertWin('Map','',500,300,'<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/map.php?addr=<?php echo ((is_array($_tmp=$this->_tpl_vars['com']['addr'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
');" href="#"><?php echo $this->_tpl_vars['com']['addr']; ?>
</a></td>
  </tr>
  <tr>
    <td align="right" class="borderC"><?php echo $this->_tpl_vars['lang']['contect_name']; ?>
 </td>
    <td class="borderC"><?php echo $this->_tpl_vars['com']['contact']; ?>
 (<?php echo $this->_tpl_vars['com']['position']; ?>
)</td>
  </tr>
  <tr>
    <td class="borderC" align="right"><?php echo $this->_tpl_vars['lang']['tel']; ?>
 </td>
    <td><?php echo $this->_tpl_vars['com']['tel']; ?>
</td>
  </tr>
  <?php if ($this->_tpl_vars['com']['mobile'] != ''): ?>
  <tr>
    <td class="borderC" align="right"><?php echo $this->_tpl_vars['lang']['mobile']; ?>
</td>
    <td class="borderC" ><?php echo $this->_tpl_vars['com']['mobile']; ?>
</td>
  </tr>
  <?php endif; ?>
  <tr>
    <td class="borderC" align="right"><?php echo $this->_tpl_vars['lang']['fax']; ?>
 </td>
    <td class="borderC" ><?php echo $this->_tpl_vars['com']['fax']; ?>
</td>
  </tr>
  <tr>
    <td class="borderC" align="right"><?php echo $this->_tpl_vars['lang']['post']; ?>
</td>
    <td class="borderC" ><?php echo $this->_tpl_vars['com']['zip']; ?>
</td>
  </tr>
  <tr>
    <td class="borderC" align="right"><?php echo $this->_tpl_vars['lang']['weburl']; ?>
</td>
    <td class="borderC" >
	<?php if ($this->_tpl_vars['com']['url'] && $this->_tpl_vars['com']['url'] != 'http://'): ?>
	<a target="_blank" href="javascript:window.location='<?php echo $this->_tpl_vars['com']['url']; ?>
'"><?php echo $this->_tpl_vars['com']['url']; ?>
</a>
	<?php endif; ?>
	</td>
  </tr>
  <tr>
    <td class="borderC" align="right"><?php echo $this->_tpl_vars['lang']['reg_time']; ?>
 </td>
    <td class="borderC" ><?php echo ((is_array($_tmp=$this->_tpl_vars['com']['regtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 </td>
  </tr>
  <tr>
    <td align="right">Контакты</td>
    <td>
    <?php if ($this->_tpl_vars['com']['qq']): ?>
    <a title="<?php echo $this->_tpl_vars['com']['qq']; ?>
" target="blank" href="tencent://message/?uin=<?php echo $this->_tpl_vars['com']['qq']; ?>
&Site=<?php echo $this->_tpl_vars['config']['company']; ?>
&Menu=yes"> <?php echo $this->_tpl_vars['lang']['qq']; ?>
 </a>
    <?php endif; ?>
	    &nbsp;
		<?php if ($this->_tpl_vars['com']['msn']): ?>
        <script language="JavaScript" type="text/javascript">
		function SendMSNMessage(name)
		  MsgrObj.InstantMessage(name);
		function AddMSNContact(name)
		  MsgrObj.AddContact(0, name);
		</script>
        <object id="MsgrObj" classid="clsid:B69003B3-C55E-4B48-836C-BC5946FC3B28" codetype="application/x-oleobject" width="0" height="0">
        </object>
        <a title="<?php echo $this->_tpl_vars['com']['msn']; ?>
" href="#" onclick="SendMSNMessage('')"><?php echo $this->_tpl_vars['lang']['msn']; ?>
</a>
<?php endif; ?>
	
		<?php if ($this->_tpl_vars['com']['skype']): ?>
        <script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
        <a href="skype:<?php echo $this->_tpl_vars['com']['skype']; ?>
?call"> <?php echo $this->_tpl_vars['lang']['skype']; ?>
 </a> <?php endif; ?>
        </td>
  </tr>
</table>
</div>



<div class="common_box m1">
<?php if ($_GET['type'] == 1): ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td style="text-align:center"><h1><?php echo $this->_tpl_vars['lang']['success']; ?>
</h1></td></tr></table>
<?php elseif ($_GET['type'] == 2): ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td style="text-align:center"><h1><?php echo $this->_tpl_vars['lang']['fail']; ?>
</h1></td></tr></table>
<?php elseif ($_GET['type'] == 3): ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td style="text-align:center"><h1><?php echo $this->_tpl_vars['lang']['yzm_er']; ?>
</h1></td></tr></table>
<?php else: ?>
<script type="text/javascript" src="script/Validator.js"></script>
	<form method="post" action="" onSubmit="return Validator.Validate(this,3)">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" class="guide_ba"><span><?php echo $this->_tpl_vars['lang']['leve_msg']; ?>
</span></td>
        </tr>
   			 <tr>
          <td height="24" colspan="2" align="left"  style="color:#999999">
         <?php echo $this->_tpl_vars['lang']['msg_notice']; ?>

         
         <?php if ($_COOKIE['USER'] == ''): ?>
         	<?php echo $this->_tpl_vars['lang']['mem_notice']; ?>

         <?php endif; ?>
         </td>
          </tr>
              <?php if ($this->_tpl_vars['tid']): ?>
              <tr>
                <td height="24" align="right" ><?php echo $this->_tpl_vars['lang']['about']; ?>
</td>
                <td height="24" >
                <?php $_from = $this->_tpl_vars['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <?php echo $this->_tpl_vars['list']['pname']; ?>
<br />
                <?php endforeach; endif; unset($_from); ?>
                </td>
              </tr>
              <?php endif; ?>
              <tr>
                <td height="24" align="right" ><?php echo $this->_tpl_vars['lang']['receive']; ?>
</td>
                <td height="24" ><?php echo $this->_tpl_vars['com']['company']; ?>
 <?php echo $this->_tpl_vars['com']['contact']; ?>
</td>
              </tr>
            <tr>
              <td width="15%" height="24" align="right" >*<?php echo $this->_tpl_vars['lang']['mail_title']; ?>
</td>
              <td height="24" width="85%" >
              <input type="text" value="<?php echo $_GET['title']; ?>
" name="sub" style="width:400px;"  dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_title']; ?>
" />
              </td>
            </tr>
            <tr>
              <td width="15%" height="203" align="right" valign="top" >*<?php echo $this->_tpl_vars['lang']['mail_con']; ?>
</td>
              <td height="203" width="85%" valign="middle" >
              <textarea name="con"  rows="10" style="width:400px;" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_con']; ?>
"></textarea></td>
            </tr>
             <?php if ($_COOKIE['USER'] == ''): ?>
         <tr>
              <td width="15%" height="24" align="right" >*<?php echo $this->_tpl_vars['lang']['conect']; ?>
</td>
          <td height="24" width="85%" >
			  <input name="name" type="text" style="width:400px;"  dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_name']; ?>
" />			  </td>
            </tr>
            <tr>
              <td height="21" align="right" >*<?php echo $this->_tpl_vars['lang']['email']; ?>
</td>
              <td height="21" >
			  <input name="email" type="text" style="width:400px;" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_email']; ?>
" />			  </td>
            </tr>
            <tr>
              <td height="21" align="right" >*<?php echo $this->_tpl_vars['lang']['tel']; ?>
</td>
              <td height="21" >
			  <input name="tell" type="text" style="width:400px;" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_tel']; ?>
" />			  </td>
            </tr>
			<?php else: ?>
			<tr>
              <td width="15%" height="24" align="right" ><?php echo $this->_tpl_vars['lang']['sender']; ?>
</td>
              <td height="24" width="85%" >
			  <a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
"><?php echo $_COOKIE['USER']; ?>
</a>
              </td>
            </tr>
			  <?php endif; ?>
              
            <tr>
              <td height="28" align="right" >*<?php echo $this->_tpl_vars['lang']['yzm']; ?>
</td>
              <td height="28" ><input name="yzm" type="text" style="width:60px; height:20px;" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['yzm']; ?>
" />
              <img style="vertical-align:top;" src='includes/rand_func.php' width="60" height="22"/></td>
            </tr>
            
            <tr>
              <td width="15%" height="28" >&nbsp;</td>
              <td height="28" width="85%" >
              	<input type="hidden" name="contype" value="<?php if ($_GET['contype']): ?><?php echo $_GET['contype']; ?>
<?php else: ?>1<?php endif; ?>" />
              	<input type="hidden" name="tid" value="<?php echo $this->_tpl_vars['tid']; ?>
" />
			    <input type="submit" name="Submit" value="<?php echo $this->_tpl_vars['lang']['send_now']; ?>
" />
                <input name="submit" type="hidden" id="submit" value="submit" />
				<input name="toid" type="hidden"  value="<?php echo $_GET['uid']; ?>
" />
                <input type="hidden"  name="tocontact" value="<?php echo $this->_tpl_vars['com']['email']; ?>
" />
                </td>
            </tr>
        </table>
  </form>
    <?php endif; ?>
</div>