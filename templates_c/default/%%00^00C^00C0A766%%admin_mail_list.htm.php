<?php /* Smarty version 2.6.20, created on 2013-02-02 12:09:11
         compiled from admin_mail_list.htm */ ?>
<form action="" method="post">
<script language="javascript">
function do_select()
{
	 var box_l = document.getElementsByName("deid[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("deid[]")[j].checked==true)
	  	  document.getElementsByName("deid[]")[j].checked = false;
		else
		  document.getElementsByName("deid[]")[j].checked = true;
	 }
}
</script>
<div class="admin_right_top">
<?php if ($_GET['type'] == 'outbox'): ?><?php echo $this->_tpl_vars['lang']['outbox']; ?>

<?php elseif ($_GET['type'] == 'savebox'): ?>Сохраненные
<?php elseif ($_GET['type'] == 'delbox'): ?>Корзина
<?php else: ?> <?php echo $this->_tpl_vars['lang']['inbox']; ?>

<?php endif; ?>
</div>
<table class="admin_table" border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
	<tr bgcolor="#E8E8E8" style="font-weight:bold;"> 
	  <td width="112" align="left">
	  <input type="checkbox" style="border:none" onclick="do_select();" /> 
      <img src="image/default/icon.gif" width="16" height="14" />
	  </td>
	  <td width="336" bgcolor="#E8E8E8">
      <?php if ($_GET['type'] == 'delbox'): ?>
      Получатель/Отправитель
      <?php else: ?>
      <?php if ($_GET['type'] == 'outbox'): ?><?php echo $this->_tpl_vars['lang']['receiv']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['from']; ?>
<?php endif; ?>
      <?php endif; ?>
      </td>
	  <td width="370" bgcolor="#E8E8E8"><?php echo $this->_tpl_vars['lang']['topics']; ?>
</td>
	  <td width="278" align="left" bgcolor="#E8E8E8"><?php echo $this->_tpl_vars['lang']['date']; ?>
</td>
    </tr>
	<?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
	<tr bgcolor="#F7F7F7"> 
	  <td align="left">
	  <input type="checkbox" name="deid[]" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" style="border:none" />
	  <?php if (! $this->_tpl_vars['list']['iflook']): ?>
      	<img src="image/default/unred.gif" width="16" height="14" />
	  <?php elseif ($this->_tpl_vars['list']['ifback']): ?>
      	<img src="image/default/replied.gif" width="16" height="14" />
      <?php else: ?>
        <img src="image/default/read.gif" width="16" height="14" />
	  <?php endif; ?>
	  </td>
	  <td>
	  <?php if ($this->_tpl_vars['list']['fromuserid'] || $this->_tpl_vars['list']['msgtype'] == '3'): ?>
	      <?php if ($this->_tpl_vars['list']['msgtype'] == '3'): ?>
		         <?php echo $this->_tpl_vars['lang']['system_msg']; ?>

		  <?php else: ?>
		         <?php echo $this->_tpl_vars['list']['fromname']; ?>

		  <?php endif; ?>
	 <?php else: ?>
	      <?php echo $this->_tpl_vars['lang']['tourists']; ?>

	 <?php endif; ?>
	</td>
	  <td><a href="main.php?menu=<?php echo $_GET['menu']; ?>
&action=mail_det&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['sub']; ?>
</a></td>
	  <td width="278"><?php echo $this->_tpl_vars['list']['date']; ?>
</td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td colspan="4" align="center">Нет данных</td></tr>
	<?php endif; unset($_from); ?>
</table>
<div align="right"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
<div align="left" style="width:100%;"><br>
<?php if ($_GET['type'] == 'delbox'): ?>
	<input name="remove" type="submit" value="Очистить" />
    <input name="recover" type="submit" value="Восстановить" />
<?php else: ?>
    <input name="del" type="submit" value="<?php echo $this->_tpl_vars['lang']['del']; ?>
" />
    <?php if ($_GET['type'] == 'inbox' || $_GET['type'] == ''): ?>
    <input name="save" type="submit" value="Переместить в сохраненные" />
    <?php endif; ?>
<?php endif; ?>
</div>
</form>