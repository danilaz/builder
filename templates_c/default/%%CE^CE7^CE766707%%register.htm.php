<?php /* Smarty version 2.6.20, created on 2013-01-12 15:44:38
         compiled from register.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getUser', 'register.htm', 153, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type=text/javascript>
	var allnotblank='<?php echo $this->_tpl_vars['lang']['allisnotblank']; ?>
';
	var passlength='<?php echo $this->_tpl_vars['lang']['passisnotlowfour']; ?>
';
	var passistooleng='<?php echo $this->_tpl_vars['lang']['passisnotlongtenw']; ?>
';
	var passnotsame='<?php echo $this->_tpl_vars['lang']['passisnotsame']; ?>
';
	var emailerror='<?php echo $this->_tpl_vars['lang']['emailiserror']; ?>
';
	var randcodeerror='<?php echo $this->_tpl_vars['lang']['codeiserror']; ?>
';
	var randcodeisemp='<?php echo $this->_tpl_vars['lang']['codeisempty']; ?>
';
	var rcodeiserror='<?php echo $this->_tpl_vars['lang']['randcodeerror']; ?>
';
	var enterusername='<?php echo $this->_tpl_vars['lang']['usernameisblank']; ?>
';
	var unameisfour='<?php echo $this->_tpl_vars['lang']['usernameislowfour']; ?>
';
	var unameisen='<?php echo $this->_tpl_vars['lang']['usernameisen']; ?>
';
	var usernameprotect='<?php echo $this->_tpl_vars['lang']['usernameisprotect']; ?>
';
	var have_blank='<?php echo $this->_tpl_vars['lang']['have_blank']; ?>
';
	
	function dis(){
		if($('submitreg').disabled==false)
		 $('submitreg').disabled=true;
		else
		 $('submitreg').disabled=false;
	}
</script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/register.js" type=text/javascript></script>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['user_reg']; ?>
</a>
    </div>
    <div class="headtop_R"></div>		
</div>

<div id="mainbody1" class="topm">
<?php if ($this->_tpl_vars['config']['closetype'] == 2): ?>
    <div style="height:300px; padding-top:150px; color:#FF0000;border: 1px solid #A9B9D3; font-size:16px">
        <?php echo $this->_tpl_vars['config']['closecon']; ?>

    </div>
<?php else: ?>
    <?php if ($_GET['regsuc']): ?>
    	<div style="height:300px; padding-top:150px; color:#FF0000;border: 1px solid #A9B9D3; font-size:16px">
    	<?php echo $this->_tpl_vars['lang']['reg_mail_msg']; ?>

        </div>
    <?php else: ?>
	<div class="leftbar_registration">
	<div class="title4"><div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['user_reg']; ?>
</div></div>
	<table width="100%" border="0" align="left" cellspacing="1" bgcolor="#b6daeb" style="margin-top:0px">
	<tr>
    <td height="39" align="left" valign="middle" bgcolor="#FFFFFF">
    <form action="" method="post">
      <table width='100%' border='0' cellspacing='0' cellpadding='0' bordercolor='#000000' bordercolorlight='#000000' bordercolordark='#FFFFFF' align="center" class="con">		
            <tr>
              <td height="28" colspan="3" align="left" bgcolor="#E8F3FD">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['lang']['baseinfo']; ?>
</td>
            </tr>
			<tr align="center">
              <td style="padding:0px;" height="1" colspan="3" bgcolor="#DDDDDD"></td>
            </tr>
		    <tr bgcolor="#FFFFFF" valign="middle" height="35">
              <td width="305" align="right"><?php echo $this->_tpl_vars['lang']['randcode']; ?>
&nbsp;&nbsp;</td>
            <td width="300" height="*"><input onFocus="show_yzm();" name="yzm" type="text" id="yzm" class="input" onChange="check_yzm()" style="width:300px;" /></td>
            <td width="373" height="*"><span id="yzm_pic"></span><span id="tishi2"></span>			  </td>
	    </tr>
		  	<tr align="right">
              <td style="padding:0px;" height="1" colspan="3" bgcolor="#DDDDDD"></td>
          </tr>
		  <?php if ($this->_tpl_vars['config']['user_reg_verf']): ?>	
			<tr bgcolor="#FFFFFF" valign="middle" height="35">
              <td width="305" align="right"><?php echo $this->_tpl_vars['lang']['randques']; ?>
&nbsp;&nbsp;</td>
            <td width="300" height="*"><input onFocus="check_yzm();show_yzwt();"  name="ckyzwt" type="text" id="ckyzwt" class="input" onChange="check_yzwt()" onclick="show_yzwt();" style="width:300px;" /></td>
            <td width="373" height="*"><span id="yzwt" ></span>&nbsp;&nbsp;<span id="tishi8" style="color:#FF0000"></span>			  </td>
	    </tr>
		  	<tr align="right">
              <td style="padding:0px;" height="1" colspan="3" bgcolor="#DDDDDD"></td>
          </tr>
		  <?php endif; ?>
					  	
            <tr>
              <td width="305" height="35" align="right" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['selcountry']; ?>
&nbsp;&nbsp;</td>
            <td height="*" colspan="2" bgcolor="#FFFFFF">
                  <select name="country" id="country" class="input" style="width:300px;">
				  	<?php $_from = $this->_tpl_vars['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                    <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
                  </select>              </td>
            </tr>
			<tr align="right">
              <td style="padding:0px;" height="1" colspan="3" bgcolor="#DDDDDD"></td>
          </tr>
            <tr>
              <td width='305' height="35" align="right" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['user_name']; ?>
&nbsp;&nbsp;</td>
              <td height="*" colspan="2" bgcolor="#FFFFFF">
			 <input name='user'  type='text' id="user" <?php if ($this->_tpl_vars['config']['user_reg_verf']): ?> onFocus="check_yzwt();" <?php endif; ?> class="input" style="width:300px;"/><span id="tishi"></span>			 </td>
            </tr>
			
			<tr align="right">
              <td style="padding:0px;" height="1" colspan="3" bgcolor="#DDDDDD"></td>
          </tr>
			
            <tr>
              <td width='305' height='40' align="right" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['user_pass']; ?>
&nbsp;&nbsp;</td>
              <td height='*' colspan="2" bgcolor="#FFFFFF"><input onFocus="check_user();" type='password'  name='password' id="password" class="input" style="width:300px;"/></td>
            </tr>
			
			<tr align="right">
              <td style="padding:0px;" height="1" colspan="3" bgcolor="#DDDDDD"></td>
          </tr>
			
            <tr>
              <td width='305' height='40' align="right" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['pass_reenter']; ?>
&nbsp;&nbsp;</td>
              <td height='*' colspan="2" bgcolor="#FFFFFF"><input type='password'  name='re_password' id="re_password" size='20' class="input" style="width:300px;"/></td>
            </tr>
			<tr align="right">
              <td style="padding:0px;" height="1" colspan="3" bgcolor="#DDDDDD"></td>
          </tr>
            <tr>
              <td width="305" height="60" align="right" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['email']; ?>
&nbsp;&nbsp;</td>
              <td height="*" colspan="2" bgcolor="#FFFFFF">
			  <input name='email' type='text' class="input" id="email" size='20' maxlength="30" style="width:300px;"/><br/><?php echo $this->_tpl_vars['lang']['email_msg']; ?>
</td>
            </tr>
			<tr align="center">
              <td style="padding:0px;" height="1" colspan="3" bgcolor="#DDDDDD"></td>
            </tr>
            <tr>
              <td width="305" height="35" align="right" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['reg_lim']; ?>
&nbsp;&nbsp;</td>
              <td height="*" colspan="2" bgcolor="#FFFFFF">
                <textarea readonly="readonly" name="trtext" rows="5"  style="font-size:12px;algin:left;margin-top:5px; width:80%;"><?php echo $this->_tpl_vars['config']['association']; ?>
</textarea>
				<br/>
                <input name="readme" id="readme" type="checkbox" value="checkbox"  onclick="dis()" style="margin-top:5px;"/> <?php echo $this->_tpl_vars['lang']['reg_read']; ?>

                </td>
            </tr>
		  	<tr>
              <td style="padding:0px;" height="1" colspan="3" align="right" bgcolor="#DDDDDD"></td>
            </tr>
            <tr>
              <td width='305' bgcolor="#FFFFFF" height="30"></td>
              <td height="*" colspan="2" bgcolor="#FFFFFF"><br />
			  <input type='submit' name='submitreg' id="submitreg" value='<?php echo $this->_tpl_vars['lang']['submit_title']; ?>
' class="input" style="width:150px;" onClick="return check()" disabled="disabled"/>
              <input name="forward" type="hidden" id="forward" value="<?php echo $_GET['forward']; ?>
" />
			  <br /><br />
              </td>
            </tr>
			 </table>
		  </form>
		</td>
		 </tr>
		</table>
	</div>
	<div class="rightbar">
		<div class="right1">
			<div class="sectitle" >
				<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['lasted_user']; ?>
</div>
			</div>
			 <div class="seccon">
				<ul class="li_list">
					<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'leng' => '36', 'field' => 'company', 'filter' => 'new', 'limit' => 15)), $this); ?>

			   </ul>
               <div class="clear"></div>
			</div>
			<div class="bottom5"></div>
			<div class="clear"></div>
		</div>
	</div>
<?php endif; ?>
<?php endif; ?>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>