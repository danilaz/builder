<?php /* Smarty version 2.6.20, created on 2013-01-12 15:02:59
         compiled from comment_default.htm */ ?>
<script>
function rewiew()
{
	<?php if ($this->_tpl_vars['buid'] == ''): ?>
	alert('Вы не авторизованы! Пожалуйста, авторизируйтесь!');
	window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php<?php echo $this->_tpl_vars['return']; ?>
';
	return false;
	<?php endif; ?>
}
</script>
<form onsubmit="return rewiew();" action="" method="post">
<table style="width:100%;"cellpadding="0" cellspacing="0" bordercolor="#EAFAFD">
	<tr>
		<td class="tit33" colspan="2" align="left" style="padding:0px;">
		<h2 style="float:left; margin-left:20px;color:#333333;font-size:12px;"><?php echo $this->_tpl_vars['lang']['rewiew_add']; ?>
</h2>
		<span style="float:right; margin-right:20px;">
		Всего <?php echo $this->_tpl_vars['rank_a']['1']+$this->_tpl_vars['rank_a']['2']+$this->_tpl_vars['rank_a']['3']; ?>

		[<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/rewiew_detail.php?ctype=<?php echo $this->_tpl_vars['c_ar']['ctype']; ?>
&conid=<?php echo $this->_tpl_vars['c_ar']['cid']; ?>
">Все комментарии</a>]
		</span>
		</td>
    </tr>
	<tr>
	  <td width="4%" height="40" valign="middle">&nbsp;</td>
	  <td align="left" width="96%" valign="middle">
	  <div style="border-bottom:1px #CCCCCC solid; padding-bottom:8px; padding-top:8px; width:90%;">
	  <table width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size:11px;">
        <tr>
          <td width="12%" height="20">Отлично <img width="36" height="12" align="absmiddle" alt="" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/star1.gif"></td>
          <td width="64%"><div style="background:#FFF7D2; height:15px;"><div style="background-color:#FFA40D; height:15px;width:<?php echo $this->_tpl_vars['r1']+0; ?>
%">&nbsp;</div></div></td>
          <td width="12%" align="center"><?php echo $this->_tpl_vars['r1']+0; ?>
%</td>
          <td width="12%" align="center" bgcolor="#e1f0fb"><?php echo $this->_tpl_vars['rank_a']['1']; ?>
</td>
        </tr>
        <tr>
          <td height="20">Хорошо <img width="36" height="12" align="absmiddle" alt="" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/star2.gif"></td>
          <td ><div style="background:#FFF7D2; height:15px;"><div style="background-color:#FFA40D; height:15px; width:<?php echo $this->_tpl_vars['r2']+0; ?>
%">&nbsp;</div></div></td>
          <td align="center"><?php echo $this->_tpl_vars['r2']+0; ?>
%</td>
          <td align="center" bgcolor="#f2f8fd"><?php echo $this->_tpl_vars['rank_a']['2']; ?>
</td>
        </tr>
        <tr>
          <td height="20">Плохо <img width="36" height="12" align="absmiddle" alt="" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/star3.gif"></td>
          <td><div style="background:#FFF7D2; height:15px;"><div style="background-color:#FFA40D; height:15px; width:<?php echo $this->_tpl_vars['r3']+0; ?>
%">&nbsp;</div></div></td>
          <td align="center"><?php echo $this->_tpl_vars['r3']+0; ?>
%</td>
          <td align="center" bgcolor="#f9fcfe"><?php echo $this->_tpl_vars['rank_a']['3']; ?>
</td>
        </tr>
      </table>
	  </div>
	  </td>
	</tr>
	<tr>
		<td align="left" valign="middle">&nbsp;</td>
	    <td align="left" valign="middle" style="padding-top:5px;font-size:11px;">
		<div>
		<input checked="checked" name="rank" type="radio" value="1" /> Отлично <img width="36" height="12" align="absmiddle" alt="" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/star1.gif">
		<input name="rank" type="radio" value="2" /> Хорошо <img width="36" height="12" align="absmiddle" alt="" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/star2.gif">
		<input name="rank" type="radio" value="3" /> Плохо <img width="36" height="12" align="absmiddle" alt="" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/star3.gif">
		</div>
		<textarea onclick="document.getElementById('rands_num').style.display='block';" id="reviewcon" name="reviewcon" style="font-size:12px;width:90%; height:80px;"></textarea>
		<div style="display:none; height:30px;" id="rands_num">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="80"><?php echo $this->_tpl_vars['lang']['rewiew_encode']; ?>
</td>
			<td width="60">
			<input style="height:20px;" onclick="document.getElementById('randimg').style.display='block';this.value='';" value="Нажмите здесь..." name="myrands" type="text" id="myrands" size="16" maxlength="6"  />
			</td>
			<td align="left"><img id="randimg" style="padding-top:3px; display:none;" src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/includes/rand_func.php'/> </td>
		  </tr>
		</table>
		</div>
		</td>
	</tr>
	<tr>
  <td align="left" height="20">&nbsp;</td>
  <td align="left">
  <input type="submit" name="rewiews" value="<?php echo $this->_tpl_vars['lang']['submit_title']; ?>
" />
  </td>
  </tr>
</table>
</form>