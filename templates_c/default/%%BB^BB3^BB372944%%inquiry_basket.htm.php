<?php /* Smarty version 2.6.20, created on 2013-01-12 17:27:02
         compiled from inquiry_basket.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; Массовая рассылка
    </div>
    <div class="headtop_R"></div>		
</div>

<style>
.topm td{padding:5px; line-height:22px;}
</style>
<script>
function remove_inquery()
{	
	var cid='';
	var boxes = document.getElementsByName("cinquery");   
	for (var i = 0; i < boxes.length; i++)  
	{  
		if(boxes[i].checked)  
		{  
			cid+=boxes[i].value+',';  
		} 
	}
	
	var pid='';
	var boxes = document.getElementsByName("pinquery");   
	for (var i = 0; i < boxes.length; i++)  
	{  
		if(boxes[i].checked)  
		{  
			pid+=boxes[i].value+',';  
		} 
	}
	
	var iid='';
	var boxes = document.getElementsByName("iinquery");   
	for (var i = 0; i < boxes.length; i++)  
	{  
		if(boxes[i].checked)  
		{  
			iid+=boxes[i].value+',';  
		} 
	}
	window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/inquiry_basket.php?pid='+pid+'&cid='+cid+'&iid='+iid;
}

function do_select()
{
	 var box_l = document.getElementsByName("iinquery").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
		if(document.getElementsByName("iinquery")[j].checked==true)
		  document.getElementsByName("iinquery")[j].checked = false;
		else
		  document.getElementsByName("iinquery")[j].checked = true;
	 }
	 
	 var box_l = document.getElementsByName("pinquery").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
		if(document.getElementsByName("pinquery")[j].checked==true)
		  document.getElementsByName("pinquery")[j].checked = false;
		else
		  document.getElementsByName("pinquery")[j].checked = true;
	 }
	 
	  var box_l = document.getElementsByName("cinquery").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
		if(document.getElementsByName("cinquery")[j].checked==true)
		  document.getElementsByName("cinquery")[j].checked = false;
		else
		  document.getElementsByName("cinquery")[j].checked = true;
	 }
}
</script>
<div id="mainbody1" class="topm">
  <form id="login" name="login" action="inquire.php" method="post">
  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="inq_bas">
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF">
        При просмотре сайта, если у Вас возникнут вопросы по продуктам, Вы можете отправить сообщения поставщику. После этого можете добавить товар в корзину.
        </td>
      </tr>
      <tr>
        <td width="10%"><strong>Выбор</strong></td>
        <td width="25%"><strong>Компания</strong></td>
        <td width="50%"><strong>Название</strong></td>
        <td width="15%"><strong>Тип </strong></td>
      </tr>
      <?php $_from = $this->_tpl_vars['prolist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
      <tr>
        <td bgcolor="#FFFFFF">
        <input type="checkbox" name="pinquery" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" id="checkbox">
        <input name="userid[]" type="hidden" value="<?php echo $this->_tpl_vars['list']['userid']; ?>
">
        </td>
        <td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['list']['company']; ?>
</td>
        <td bgcolor="#FFFFFF"><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['subject']; ?>
</a></td>
        <td bgcolor="#FFFFFF">Является продукт</td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
      
      <?php $_from = $this->_tpl_vars['infolist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
      <tr>
        <td bgcolor="#FFFFFF">
        <input type="checkbox" name="iinquery" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" id="checkbox">
        <input name="userid[]" type="hidden" value="<?php echo $this->_tpl_vars['list']['userid']; ?>
">
        </td>
        <td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['list']['company']; ?>
</td>
        <td bgcolor="#FFFFFF"><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['subject']; ?>
</a></td>
        <td bgcolor="#FFFFFF">Продукт</td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
      
      <?php $_from = $this->_tpl_vars['comlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
      <tr>
        <td bgcolor="#FFFFFF">
        <input type="checkbox" name="cinquery" value="<?php echo $this->_tpl_vars['list']['userid']; ?>
">
        <input name="userid[]" type="hidden" value="<?php echo $this->_tpl_vars['list']['userid']; ?>
">
        </td>
        <td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['list']['company']; ?>
</td>
        <td bgcolor="#FFFFFF"><a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php echo $this->_tpl_vars['list']['subject']; ?>
</a></td>
        <td bgcolor="#FFFFFF">Компания</td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
      
      <?php if ($this->_tpl_vars['comlist']['0']['company'] != '' || $this->_tpl_vars['prolist']['0']['company'] != '' || $this->_tpl_vars['infolist']['0']['company'] != ''): ?>
        <tr>
        <td bgcolor="#FFFFFF" colspan="4" align="left">&nbsp;&nbsp;
        <input onClick="do_select();" type="checkbox" name="checkbox" id="checkbox">Выбрать/Снять
        <input onClick="remove_inquery();" value="Удалить" name="" type="button">
        <input value="Отправить еще раз" name="inquire" type="submit">
        </td>
      </tr>
      <?php else: ?>
      	<tr><td colspan="4" bgcolor="#FFFFFF">Массовая рассылка пуста</td></tr>
      <?php endif; ?>
      
    </table>
  </form>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>