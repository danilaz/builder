<?php /* Smarty version 2.6.20, created on 2013-01-12 15:48:56
         compiled from space_album_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_image', 'space_album_list.htm', 19, false),)), $this); ?>
<style>
.album{float:left;width:150px; height:170px; padding:10px;  margin-left:5px; text-align:center}
</style>
<div class="common_box">
<table width="100%" order="0" cellpadding="0" cellspacing="0">
  <tr align="left">
    <td class="guide_ba" colspan="4"><span><?php echo $this->_tpl_vars['lang']['album']; ?>
<?php if ($this->_tpl_vars['album_cat_detail']): ?>-<?php echo $this->_tpl_vars['album_cat_detail']['name']; ?>
<?php endif; ?></span></td>
  </tr>
  <tr>
<td>

<?php $_from = $this->_tpl_vars['album']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
	<div class="album_">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td valign="middle" height="150">
					<a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=albumd&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">
					<?php $this->assign('image', $this->_tpl_vars['list']['id']); ?>
					<?php echo smarty_function_html_image(array('file' => "uploadfile/catimg/size_small/".($this->_tpl_vars['image']).".jpg",'width' => 150,'alt' => ($this->_tpl_vars['list']).".name"), $this);?>

					</a>
				</td>
			  </tr>
			</table>
		<a href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=albumd&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" title="<?php echo $this->_tpl_vars['list']['zname']; ?>
">
		<strong><?php echo $this->_tpl_vars['list']['name']; ?>
</strong> <?php echo $this->_tpl_vars['list']['count']; ?>
<?php echo $this->_tpl_vars['lang']['album_pics']; ?>
</a>
	</div>
<?php endforeach; endif; unset($_from); ?>
<div align="right"><?php echo $this->_tpl_vars['album']['page']; ?>
</div>
</td>
</table>
</div>