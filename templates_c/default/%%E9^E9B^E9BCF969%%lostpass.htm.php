<?php /* Smarty version 2.6.20, created on 2013-01-13 04:19:32
         compiled from lostpass.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'lostpass.htm', 19, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['callpass']; ?>
</a>
    </div>
    <div class="headtop_R"></div>		
</div>
<script type="text/javascript" src="script/Validator.js"></script>
<!--主体开始 -->
	<div id="mainbody1" class="topm">
	    <!--主体右侧开始 -->
<!-- 		<div class="rightbar">
			<div class="right1">
				<div class="sectitle" >
					<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['sitelink']; ?>
</div>
		        </div>
				 <div class="seccon">
					<ul class="about_li">
					 	<?php echo ((is_array($_tmp=$this->_tpl_vars['web_con'])) ? $this->_run_mod_handler('replace', true, $_tmp, "|", "<br />") : smarty_modifier_replace($_tmp, "|", "<br />")); ?>

				   </ul>
			    </div>
			  	<div class="bottom5"></div>
				<div class="clear"></div>
			</div>
		</div> -->		
		<!--主体右侧结束 -->
		<!--主体左侧开始 -->
		<div class="leftbars">
			<div class="title4"><div class="title_left2 L2"><?php echo $this->_tpl_vars['lang']['callpass']; ?>
</div></div>
			<div class="content4 overflow">
			<div style="line-height:25px;height:210px;width:95%;margin-right:5px; padding:10px; text-align:left;">
			<form method="post" action="" onSubmit="return Validator.Validate(this,3)">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%" style="text-align:right"><?php echo $this->_tpl_vars['lang']['entercomname']; ?>
&nbsp;&nbsp;</td>
                    <td width="82%"><input name="user" type="text" id="user" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['pls_user']; ?>
" size="40" value="<?php echo $_POST['user']; ?>
" /></td>
                  </tr>
                  <tr>
                    <td style="text-align:right"><?php echo $this->_tpl_vars['lang']['email']; ?>
&nbsp;&nbsp;</td>
                    <td><input name="email" size="40" type="text" value="<?php echo $_POST['email']; ?>
" dataType="Email" msg="<?php echo $this->_tpl_vars['lang']['pls_email']; ?>
" /></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                    	<input type="submit" name="Submit" value="<?php echo $this->_tpl_vars['lang']['isure']; ?>
" />
                        <input name="action" type="hidden" id="action" value="com" />
                      </td>
                  </tr>
                </table>
			</form>		
			<?php if ($_POST['action'] != ''): ?>
			<form action="" method="post">
			<table width="95%" border="0" cellpadding="0" cellspacing="0"  style="margin-left:5px;">
			  <tr>
				<td>
                    <?php if ($this->_tpl_vars['company']['userid'] != ""): ?>
                            <input name="userid" type="radio" value="<?php echo $this->_tpl_vars['company']['userid']; ?>
|<?php echo $this->_tpl_vars['company']['email']; ?>
" />
                            <a href="shop.php?uid=<?php echo $this->_tpl_vars['company']['userid']; ?>
" target="_blank"><?php echo $this->_tpl_vars['company']['user']; ?>
</a>
                            <br />
                            <input name="action" type="hidden" id="action" value="submit" />
                            <input name="<?php echo $this->_tpl_vars['lang']['isure']; ?>
" type="submit" value="<?php echo $this->_tpl_vars['lang']['isure']; ?>
" />
                    <?php else: ?>
                            <?php echo $this->_tpl_vars['lang']['nosearch']; ?>
<a href="<?php echo $this->_tpl_vars['config']['regname']; ?>
" target="_blank"><?php echo $this->_tpl_vars['lang']['reguser']; ?>
</a>
                            <?php echo $this->_tpl_vars['lang']['contactme']; ?>
<a href="aboutus.php?type=3" target="_blank"><?php echo $this->_tpl_vars['lang']['conme']; ?>
</a>．
                    <?php endif; ?>
					
				</td>
			  </tr>
			</table>
			</form>
			<?php endif; ?>
			</div>
			<div class="bottom4"></div>
			<div class="clear"></div>
			</div>
		</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>