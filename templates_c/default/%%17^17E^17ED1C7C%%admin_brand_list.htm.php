<?php /* Smarty version 2.6.20, created on 2013-02-02 12:17:03
         compiled from admin_brand_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin_brand_list.htm', 37, false),)), $this); ?>
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
<span style="float:left"><?php echo $this->_tpl_vars['lang']['edit_brand']; ?>
</span>

</div>
<div style="float:left">
<table border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF" >
	<tr bgcolor="#E8E8E8" style="font-weight:bold"> 
	  <td width="250" height="22">Бренд</td>
	  <td width="400" bgcolor="#E8E8E8">Название компании</td>
	  <td width="200" align="center" bgcolor="#E8E8E8">Дата</td>
	  <td width="200" align="center" bgcolor="#E8E8E8"><?php echo $this->_tpl_vars['lang']['operation']; ?>
</td>
	</tr>
	<?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
	<tr bgcolor="#F7F7F7"> 
	  <td width="59" height="22"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
	  <td width="628">[<?php if ($this->_tpl_vars['list']['statu'] >= 1): ?><font color=green>Размещено</font><?php else: ?><font color=red>На проверке</font><?php endif; ?>]&nbsp;<?php echo $this->_tpl_vars['list']['company']; ?>
</td>
	  <td width="196" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
	  <td height="22" align="center">
	  <a href="?menu=<?php echo $_GET['menu']; ?>
&edit=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=brand&s=admin_brand&action=m&menu=info">
	  <img src="/image/default/page_edit.png" title="Редактировать бренд"></a>
	  <a href="?deid=<?php echo $this->_tpl_vars['list']['id']; ?>
&m=brand&s=admin_brand_list&action=m&menu=info">
	  <img src="/image/default/delete.png " title="Удалить бренд"></a>	  </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<div align="right"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>