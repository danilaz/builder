<?php /* Smarty version 2.6.20, created on 2013-01-12 15:02:58
         compiled from login.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'getUser', 'login.htm', 105, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['title']; ?>
</a>
    </div>
    <div class="headtop_R"></div>		
</div>
<!--主体开始 -->
<div id="mainbody1" class="topm">
<script type=text/javascript>
	var nousername='<?php echo $this->_tpl_vars['lang']['nouname']; ?>
';
	var nouserpass='<?php echo $this->_tpl_vars['lang']['noupass']; ?>
';
	var norandcode='<?php echo $this->_tpl_vars['lang']['nocode']; ?>
';
</script>
    <script src="script/login.js" type=text/javascript></script>
	<!--主体左侧开始 -->
	<div class="leftbar_login">
	<div class="title4"><div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['ulogo']; ?>
</div></div>
	<div class="content4 overflow">
	<form id="login" name="login" action="login.php" method="post">
      <table width='100%' border='0' cellspacing='0' cellpadding='0'  align="left">
			<tr>
              <td height="28" colspan="2" align="left" bgcolor="#eeeeee" style=" padding-left:20px;">&nbsp;<?php echo $this->_tpl_vars['lang']['iamuser']; ?>
</td>
            </tr>
			<?php if ($_GET['user']): ?>
			<tr>
              <td height="36" align="center"></td>
              <td align="left" style="font-size:14px; color:#FF0000; font-weight:bold">
			 <?php echo $this->_tpl_vars['lang']['youpass']; ?>

			  </td>
		    </tr>
			<?php endif; ?>
			 <tr>
              <td height="36" align="right"><?php echo $this->_tpl_vars['lang']['uname']; ?>
&nbsp;&nbsp;</td>
              <td align="left">
			  <span id="tishi" style="font-size:14px; color:#FF0000; font-weight:bold"></span>
			  <input value='<?php echo $_GET['user']; ?>
' name='user' type='text' id="user" size="25"  class="tstyle" maxlength="25" tabindex="1" style="width:200px;"/>
               <?php if ($_GET['erry'] == "-1"): ?>
               		<font color="red"><?php echo $this->_tpl_vars['lang']['noname']; ?>
</font>
               <?php elseif ($_GET['erry'] == "-4"): ?>
               		<br /><font color="red"><?php echo $this->_tpl_vars['lang']['have_restpass']; ?>
</font>
               <?php else: ?>
               		<a href="<?php echo $this->_tpl_vars['config']['regname']; ?>
"><?php echo $this->_tpl_vars['lang']['regnow']; ?>
</a>
               <?php endif; ?>
               </td>
		    </tr>

			 
			 <tr>
              <td height="37" align="right"><?php echo $this->_tpl_vars['lang']['logpass']; ?>
&nbsp;&nbsp;</td>
              <td align="left">
			  <input type='password'  name='password' id="password" size="25"  maxlength="25" height="20" tabindex="2" class="tstyle" style="width:200px;"/>
                <?php if ($_GET['erry'] == "-2"): ?><font color="red"><?php echo $this->_tpl_vars['lang']['passerr']; ?>
</font><?php endif; ?>
                <a href="lostpass.php"><?php echo $this->_tpl_vars['lang']['forgetpass']; ?>
</a></td>
		    </tr>

			<tr>
              <td height="37" align="right"><?php echo $this->_tpl_vars['lang']['randcode']; ?>
&nbsp;&nbsp;</td>
              <td align="left">
			  <input type='text' name='randcode' id="randcode"  size="25"  tabindex="3" height="50" class="tstyle" style="width:200px;"/><img onclick="get_randfunc(this);" style="padding-left:5px; cursor:pointer" src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/includes/rand_func.php'/><?php if ($_GET['erry'] == "-3"): ?><font color="red"><?php echo $this->_tpl_vars['lang']['codeerr']; ?>
</font><?php endif; ?>
               </td>
		    </tr>

            <tr>
              <td height="40" align="left" bgcolor="#FFFFFF">&nbsp;</td>
              <td align="left" bgcolor="#FFFFFF">
			    <input name="action" type="hidden" value="submit" />
                <input type="image" name="imageField" src="image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/login_go.gif" onclick="return do_login();" tabindex="4" />
                <input name="forward" type="hidden" id="forward" value="<?php echo $_GET['forward']; ?>
" /><br /><br />
				</td>
            </tr>
			<tr>
              <td height="28" colspan="2" align="left" bgcolor="#eeeeee" style="padding-left:20px;">&nbsp;<?php echo $this->_tpl_vars['lang']['notuser']; ?>
</td>
            </tr>
			
	 
			 <tr>
              <td height="118" colspan="2" align="left" valign="top" style="padding-top:28px; padding-left:10px;">
			  <h3 class="STYLE1">&nbsp;<?php echo $this->_tpl_vars['lang']['notnowreg']; ?>
</h3>
                <ul style="padding:10px;">
                  <li><?php echo $this->_tpl_vars['lang']['getoffer']; ?>
</li>
                  <li><?php echo $this->_tpl_vars['lang']['contact']; ?>
</li>
                  <li><?php echo $this->_tpl_vars['lang']['myoffice']; ?>
</li>
                  <li><?php echo $this->_tpl_vars['lang']['getexh']; ?>
</li>
				  <li><?php echo $this->_tpl_vars['lang']['getmore']; ?>
</li>
               </ul>
			    <div align="center"><br /><a href="<?php echo $this->_tpl_vars['config']['regname']; ?>
"><img src="image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/join_now_on.gif" border="0" /></a><br /><br /><br /></div>
				</td>
            </tr>
		 </table>
		 </form>
		 <div class="clear"></div>
	</div>
	<div class="bottom4"></div>
	</div>
	
	<!--主体右侧开始 -->
		<div class="rightbar">
			<div class="right1">
				<div class="sectitle" >
					<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['staruser']; ?>
</div>
		        </div>
				 <div class="seccon">
					<ul>
					 	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getUser', 'leng' => '36', 'field' => 'company', 'filter' => 'star', 'limit' => 10)), $this); ?>

				   </ul>
                   <div class="clear"></div>
			    </div>
			  	<div class="bottom5"></div>
				<div class="clear"></div>
				</div>
		</div>		
		<!--主体右侧结束 -->
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>