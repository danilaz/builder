<?php /* Smarty version 2.6.20, created on 2013-01-12 15:03:29
         compiled from admin_main.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin_main.htm', 27, false),array('function', 'math', 'admin_main.htm', 71, false),array('insert', 'getNotice', 'admin_main.htm', 93, false),)), $this); ?>
 <div id="new-notice" class="new-notice">
      <div class="new-notiec-top">
        <div class="nn-tl"></div>
        <div class="nn-tr"></div>
        <div class="nn-tm"></div>
      </div>
		<div class="new-notice-content"><div class="new-notice-content-main">
    <p><span class="notice-title">Уважаемый, <?php echo $_COOKIE['USER']; ?>
!</span></p>
    <p><span class="notice-content">
	   <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/admin/offfice.gif" />
       Добро пожаловать, в Ваш офис <?php echo $this->_tpl_vars['config']['company']; ?>
!
	   
	   <br />
		<?php echo $this->_tpl_vars['lang']['you_url']; ?>

		<?php if ($this->_tpl_vars['shopurl'] != ''): ?>
		  <a href="http://<?php echo $this->_tpl_vars['shopurl']; ?>
" target="_blank">http://<?php echo $this->_tpl_vars['shopurl']; ?>
</a>
		<?php else: ?>
			<?php if ($this->_tpl_vars['config']['opensuburl'] == 1): ?>
					<a href="http://<?php echo $_COOKIE['USER']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
" target="_blank">http://<?php echo $_COOKIE['USER']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
</a>
			<?php else: ?>
				   <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
" target="_blank"><?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
</a>
			<?php endif; ?>
		<?php endif; ?>
<br />
   <?php echo $this->_tpl_vars['lang']['youisg']; ?>
 <font color="green"><?php echo $this->_tpl_vars['cominfo']['rank']; ?>
</font>
   <?php if ($this->_tpl_vars['cominfo']['stime'] != '' || $this->_tpl_vars['cominfo']['etime'] != ''): ?>(период
	   <?php echo ((is_array($_tmp=$this->_tpl_vars['cominfo']['stime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

	   <?php echo $this->_tpl_vars['lang']['to']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['cominfo']['etime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
)
   <?php endif; ?>
<br /> 
  <!-- <?php echo $this->_tpl_vars['lang']['vip']; ?>

   <br />
   <div align="center"><a href="main.php?menu=<?php echo $_GET['menu']; ?>
&action=admin_upgrade_group" style="text-decoration:underline;"><?php echo $this->_tpl_vars['lang']['upvip']; ?>
</a></div>
-->
   <script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=43&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
   <br />
   
   
   <?php if ($this->_tpl_vars['config']['opensuburl'] == 1): ?>
   	   <span class="notice-content2"><?php echo $this->_tpl_vars['lang']['spurl']; ?>
</span>: 
	   <input type=text name=lat size=10 style="width:350px" value="http://<?php echo $_COOKIE['USER']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
/?spread=<?php echo $this->_tpl_vars['buid']; ?>
"> 
	   <br /><font color="grey"><?php echo $this->_tpl_vars['lang']['spreadmsg']; ?>
</font>
	   <!--<a target="_blank" href="http://<?php echo $_COOKIE['USER']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
/?spread=<?php echo $this->_tpl_vars['buid']; ?>
">http://<?php echo $_COOKIE['USER']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
/?spread=<?php echo $this->_tpl_vars['buid']; ?>
</a>-->
   <?php else: ?>
       <span class="notice-content2"><?php echo $this->_tpl_vars['lang']['spurl']; ?>
</span>: 
	   <input type=text name=lat size=10 style="width:350px" value="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
&spread=<?php echo $this->_tpl_vars['buid']; ?>
"> 
	   <br /><font color="grey"><?php echo $this->_tpl_vars['lang']['spreadmsg']; ?>
</font>
	   <!--<a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
&spread=<?php echo $this->_tpl_vars['buid']; ?>
"><?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
&spread=<?php echo $this->_tpl_vars['buid']; ?>
</a>-->
   <?php endif; ?>
	</span></p>
</div></div>
      <div class="new-notice-bottom">
        <div class="nn-bl"></div>
       <div class="nn-br"></div>
        <div class="nn-bm"></div>
      </div>
    </div>
    <div class="block">
      <div class="block-left">
        <div class="content-title">
          <div class="c-left"></div>
          <div class="c-middle"><span class="c-title">Центр сообщений</span></div>
          <div class="c-right"></div>
        </div>
        <div style="line-height:200%;" class="content-detail content-special content-table">
		  <table width="100%" border="0" cellspacing="1" cellpadding="0">
			  <tr>
				<td>
				   <?php echo $this->_tpl_vars['lang']['yoursmail']; ?>
 
				   <a href="main.php?menu=<?php echo $_GET['menu']; ?>
&action=admin_mail_list">
				   (<?php echo $this->_tpl_vars['mailNum']['new']; ?>
/<?php echo smarty_function_math(array('equation' => "x + y",'x' => $this->_tpl_vars['mailNum']['new'],'y' => $this->_tpl_vars['mailNum']['read']), $this);?>
)
				   </a>
				</td>
				<td>
					  <?php echo $this->_tpl_vars['lang']['readtimes']; ?>
 <?php echo $this->_tpl_vars['cominfo']['view_times']; ?>
 <?php echo $this->_tpl_vars['lang']['tims']; ?>

					  <?php echo $this->_tpl_vars['lang']['urew']; ?>
 <?php echo $this->_tpl_vars['cominfo']['comments']; ?>
 <?php echo $this->_tpl_vars['lang']['reviews']; ?>
 
					  <a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
&action=comments"><?php echo $this->_tpl_vars['lang']['readre']; ?>
</a>
				</td>
			  </tr>
			</table>
        </div>
		
		
	</div>
      <div class="block-right">
      	<div class="tm-title">
          <div class="c-left"></div>
          <div class="c-middle"><span style="float: left;" class="c-title">Анонс сайта</span></div>
          <div class="c-right"></div>
        </div>
        <div class="tm-detail">
          <ul class="tm-list">
            <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getNotice', 'limit' => 5)), $this); ?>

		  </ul>
		  <script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=44&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
	  </div>
		<div class="tm-title">
          <div class="c-left"></div>
          <div class="c-middle"><span class="c-title">Последние посетители</span></div>
          <div class="c-right"></div>
        </div>
        <div class="tm-detail">
         <table width="100%" border="0" cellspacing="5" cellpadding="0">
		  <tr>
		  <?php $_from = $this->_tpl_vars['uvlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nums'] => $this->_tpl_vars['list']):
?>
			<td align="center">
			<?php if ($this->_tpl_vars['list']['logo'] != 0): ?>
				<img height="50" src="uploadfile/user_portrait/<?php echo $this->_tpl_vars['list']['logo']; ?>
" />
			<?php else: ?>
				<img height="50" src="image/default/nopic.gif" />
			<?php endif; ?>
			<br /><a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['user']; ?>
</a>
			</td>
			<?php if (( $this->_tpl_vars['nums']+1 ) % 3 == 0): ?></tr><tr><?php endif; ?>
			<?php endforeach; else: ?>
			<td>Нет посетителей</td>
		  <?php endif; unset($_from); ?>
		  </tr>
		</table>
	  	</div>
      </div>
    </div>