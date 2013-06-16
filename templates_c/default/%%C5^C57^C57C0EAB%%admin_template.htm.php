<?php /* Smarty version 2.6.20, created on 2013-02-02 12:16:06
         compiled from admin_template.htm */ ?>
<div class="admin_right_top"><?php echo $this->_tpl_vars['lang']['settemp']; ?>
</div>
<form method="get" action="" id="tem_search">
<input type="hidden" name="menu" value="usershop" />
<input type="hidden" name="action" value="template" />
<table id="search_tb" cellpadding="2" cellspacing="5">
<tr>
    <td width="50"><?php echo $this->_tpl_vars['lang']['cat']; ?>
</td>
    <td>
    	<select name="cat" onchange="$('tem_search').submit();">
        	<option value=""><?php echo $this->_tpl_vars['lang']['all']; ?>
</option>
        <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
        	<option <?php if ($_GET['cat'] && $_GET['cat'] == $this->_tpl_vars['item']['catid']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['catid']; ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
        </select>
	</td>
	<td width="50"><?php echo $this->_tpl_vars['lang']['groupser']; ?>
</td>
	<td>	
        <select name="group_id" onchange="$('tem_search').submit();">
        	<option value=""><?php echo $this->_tpl_vars['lang']['all']; ?>
</option>
        <?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
        	<option <?php if ($_GET['group_id'] && $_GET['group_id'] == $this->_tpl_vars['item']['group_id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['group_id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
        </select>
    </td>
    <td><?php echo $this->_tpl_vars['lang']['point']; ?>
</td>
    <td><input type="text" style="width:30px; text-align:center;" name="min_point" id="min_point" value="<?php echo $_GET['min_point']; ?>
" />&nbsp;&mdash;&nbsp;<input type="text" style="width:30px;text-align:center;" name="max_point"  id="max_point" value="<?php echo $_GET['max_point']; ?>
" />&nbsp;</td>
<td><input type="submit" value="<?php echo $this->_tpl_vars['lang']['search']; ?>
" />
</td></tr>
</table>
</form>

<table class="admin_table" border="0" align="center" cellspacing="1" bgcolor="#DDDDDD">
<tr bgcolor="#EAEFF3">
  <td height="69" align="left" valign="top" bgcolor="#FFFFFF">
  <?php if ($_GET['nopoint'] == 1): ?>
  <div style=" padding:30px; color:#FF0000; font-weight:bold;"><?php echo $this->_tpl_vars['lang']['buy_point']; ?>
</div>
  <?php endif; ?>
  
  	<?php $_from = $this->_tpl_vars['templist']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
		  <li style="float:left;width:140px; height:180px; text-align:center;">
          <?php if ($this->_tpl_vars['list']['temp_file'] == 'default'): ?>
          <a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
&template=<?php echo $this->_tpl_vars['list']['temp_file']; ?>
">
          	  <img style="border: 1px solid #A9BAD3; padding:4px; height:114px; width:97px;" src="image/default/temp.gif" />
              </a>
          <?php else: ?>
              <a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
&template=<?php echo $this->_tpl_vars['list']['temp_file']; ?>
">
              <img style="border: 1px solid #A9BAD3; padding:4px; height:114px; width:97px;" src="templates/<?php echo $this->_tpl_vars['list']['temp_file']; ?>
/img/temp.jpg" />
              </a>
          <?php endif; ?>   
          <br /><label>
		  <?php if ($this->_tpl_vars['de']['template'] == $this->_tpl_vars['list']['temp_file']): ?>
		  		<?php echo $this->_tpl_vars['lang']['using']; ?>
&nbsp;<font color="#666666">(<?php echo $this->_tpl_vars['lang']['cena']; ?>
: <?php echo $this->_tpl_vars['list']['point']; ?>
)</font>
          <?php elseif ($this->_tpl_vars['list']['right'] == 0): ?>
          	    <?php echo $this->_tpl_vars['lang']['noright']; ?>

          <?php elseif ($this->_tpl_vars['list']['temp_file'] == 'default'): ?>
          		<?php echo $this->_tpl_vars['list']['tname']; ?>
<br />[<a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
&template=<?php echo $this->_tpl_vars['list']['temp_file']; ?>
">Просмотр</a>] [<a href="main.php?menu=usershop&action=template&select_tem=<?php echo $this->_tpl_vars['list']['id']; ?>
">Включить</a>]
          <?php else: ?>
		  		<?php echo $this->_tpl_vars['list']['tname']; ?>
&nbsp;<font color="#666666">(<?php echo $this->_tpl_vars['lang']['cena']; ?>
: <?php echo $this->_tpl_vars['list']['point']; ?>
)</font><br />[<a target="_blank" href="shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
&template=<?php echo $this->_tpl_vars['list']['temp_file']; ?>
">Просмотр</a>] [<a href="main.php?menu=usershop&action=template&select_tem=<?php echo $this->_tpl_vars['list']['id']; ?>
">Включить</a>]
		  <?php endif; ?>
          </label>
		  </li>
	 <?php endforeach; endif; unset($_from); ?>
    </td>
  </tr>
</table>
<div class="page"><?php echo $this->_tpl_vars['templist']['pages']; ?>
</div>     