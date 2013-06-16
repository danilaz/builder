<?php /* Smarty version 2.6.20, created on 2013-01-13 17:50:32
         compiled from admin_offer_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin_offer_list.htm', 39, false),)), $this); ?>
<script type="text/javascript">
function ref(id,v)
{	
	var url = 'main.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&'+v;
	var myAjax = new Ajax.Request(
				url,
				{method: 'get', parameters: pars, onComplete: showResponse}
				);
	function showResponse(originalRequest)
	{
		var tempStr = originalRequest.responseText;
		if(tempStr!='')
		{
			$('r'+id).innerHTML='';
		}
	}
}
</script>
<div class="admin_right_top">
<span style="float:left"><?php echo $this->_tpl_vars['lang']['business_list']; ?>
</span>
<button onclick="window.location='main.php?action=m&m=offer&s=admin_offer_list&menu=info&update=all'" style="float:right; margin-right:10px; height:22px; ">
<?php echo $this->_tpl_vars['lang']['refresh']; ?>

</button>
</div>
<div style="float:left">
<table border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
	<tr bgcolor="#E8E8E8" style="font-weight:bold"> 
	  <td width="59" height="22" align="center"><?php echo $this->_tpl_vars['lang']['type']; ?>
</td>
	  <td width="628" bgcolor="#E8E8E8"><?php echo $this->_tpl_vars['lang']['business_title']; ?>
</td>
	  <td width="196" align="center" bgcolor="#E8E8E8"><?php echo $this->_tpl_vars['lang']['refresh_time']; ?>
</td>
	  <td width="216" align="center" bgcolor="#E8E8E8"><?php echo $this->_tpl_vars['lang']['operation']; ?>
</td>
	</tr>
	<?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
	<tr bgcolor="#F7F7F7"> 
	  <td width="59" height="22" align="center"><img src="./image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/offer_<?php echo $this->_tpl_vars['list']['type']; ?>
.gif"/></td>
	  <td width="628">[<?php if ($this->_tpl_vars['list']['statu'] >= 1): ?><font color="green">Опубликовано</font><?php else: ?><font color="red">На проверке</font><?php endif; ?>] <?php echo $this->_tpl_vars['list']['title']; ?>
</td>
	  <td width="196" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
	  <td height="22" align="center">
	  <a href="?menu=<?php echo $_GET['menu']; ?>
&edit=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=offer&s=admin_offer&action=m&menu=info"><img src="/image/default/page_edit.png" title="<?php echo $this->_tpl_vars['lang']['modify']; ?>
"></a>
	  <span id="r<?php echo $this->_tpl_vars['list']['id']; ?>
"><a href="javascript:ref(<?php echo $this->_tpl_vars['list']['id']; ?>
,'action=m&m=offer&s=admin_offer_list&menu=info&update=<?php echo $this->_tpl_vars['list']['id']; ?>
')">
	  <img src="/image/default/arrow_refresh.png" title="<?php echo $this->_tpl_vars['lang']['refresh']; ?>
"></a></span>
	  <a href="?deid=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=offer&s=admin_offer_list&action=m&menu=info" onclick="return confirm('<?php echo $this->_tpl_vars['lang']['sure_del']; ?>
');">
	  <img src="/image/default/delete.png" title="<?php echo $this->_tpl_vars['lang']['del']; ?>
"></a>	  </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<div align="right"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>