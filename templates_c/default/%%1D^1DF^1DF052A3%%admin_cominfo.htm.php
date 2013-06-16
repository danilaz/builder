<?php /* Smarty version 2.6.20, created on 2013-02-02 12:08:38
         compiled from admin_cominfo.htm */ ?>
<script src="script/my_lightbox.js" language="javascript"></script>
<script>
closeimg='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/icon_close.gif';
weburl='<?php echo $this->_tpl_vars['config']['weburl']; ?>
';
</script>
<div class="admin_right_top">
<?php if ($_GET['type'] == 1): ?>
	<?php echo $this->_tpl_vars['lang']['cominfo']; ?>

<?php elseif ($_GET['type'] == 2): ?>
	<?php echo $this->_tpl_vars['lang']['fzlc']; ?>

<?php elseif ($_GET['type'] == 3): ?>
	<?php echo $this->_tpl_vars['lang']['zzjg']; ?>

<?php elseif ($_GET['type'] == 4): ?>
	<?php echo $this->_tpl_vars['lang']['cgal']; ?>

<?php endif; ?>
</div>
	 <form action="" name="form" method="post" enctype="multipart/form-data" onSubmit="return Validator.Validate(this,3)">
<table width="100%" border="0" cellpadding="6" cellspacing="1" bgcolor="#DDDDDD" style="margin-bottom:4px;">
  <tr>
    <td width="10%" height="45" align="left" valign="top" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['detail']; ?>
</td>
    <td width="90%" align="left" valign="top" bgcolor="#FFFFFF">
			<?php if ($this->_tpl_vars['de']['intro'] != ''): ?>
				<?php echo $this->_tpl_vars['de']['intro']; ?>

			<?php else: ?>
				<script type="text/javascript" src="lib/fckeditor/fckeditor.js"></script>
				<script type="text/javascript">
				var oFCKeditor = new FCKeditor( 'intro' ) ;
				oFCKeditor.Config['ToolbarStartExpanded'] = true ;
				<?php if ($this->_tpl_vars['config']['language'] == 'en'): ?>
					oFCKeditor.Config['DefaultLanguage']='en';
				<?php else: ?>
					oFCKeditor.Config['DefaultLanguage']='zh-cn';
				<?php endif; ?>
				oFCKeditor.BasePath		= 'lib/fckeditor/' ;
				oFCKeditor.ToolbarSet	= 'frant' ;
				oFCKeditor.Width='100%';
				oFCKeditor.Height=400;
				oFCKeditor.Create() ;
				</script>
			<?php endif; ?>
		</td>
  </tr>
    <tr>
    <td align="left" valign="top" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['upload_pic']; ?>
</td>
    <td align="left" valign="top" bgcolor="#FFFFFF">
		<input name="logo" type="text" id="logo" value="<?php echo $this->_tpl_vars['de']['logo']; ?>
" size="60">
		[<a href="javascript:uploadfile('Загрузка логотипа','logo',300,300)">Загрузить</a>] 
		[<a href="javascript:preview('logo');">Предпросмотр</a>]
		[<a onclick="javascript:$('logo').value='';" href="#">Удалить</a>]
	</td>
    </tr>
    <tr>
    <td height="45" align="left" valign="top" bgcolor="#EAEFF3">&nbsp;</td>
    <td align="left" valign="top" bgcolor="#FFFFFF">
	  <input type='submit' name='Submit' value='<?php echo $this->_tpl_vars['lang']['submit']; ?>
' style="width:100px;" />
	  <input type='submit' name='Submit-next' value='Следующий шаг' style="width:120px;" />
      <input name="action" type="hidden" id="action" value="submit" />
      <input name="type" type="hidden" id="type" value="<?php echo $_GET['type']; ?>
" />
	  </td>
    </tr>
</table>
  </form>