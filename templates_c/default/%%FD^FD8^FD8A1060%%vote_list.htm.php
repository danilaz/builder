<?php /* Smarty version 2.6.20, created on 2013-01-12 19:52:51
         compiled from vote_list.htm */ ?>
<form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=vote&s=vote" method="post">
<table width="100%" cellspacing="0" cellpadding="3" border="0" align="center">
    <?php $_from = $this->_tpl_vars['vote']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
    <tr><td colspan='2' class="td1"><?php echo $this->_foreach['name']['iteration']; ?>
.<b><?php echo $this->_tpl_vars['list']['title']; ?>
</b> <?php if ($this->_tpl_vars['list']['end'] == 1): ?><font color="#FF0000">(Голосование закончено)</font><?php endif; ?><?php if ($this->_tpl_vars['list']['ip'] == 1): ?><br /><font color="#FF0000"><i>(Ваш голос учтен)</i></font><?php endif; ?></td></tr>
	<tr>

    <?php $_from = $this->_tpl_vars['list']['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
        $this->_foreach['loop']['iteration']++;
?>
    <td height="28"><?php if ($this->_tpl_vars['list']['end'] != 1 && $this->_tpl_vars['list']['ip'] != 1): ?><input type="<?php if ($this->_tpl_vars['list']['votetype'] == 0): ?>radio<?php else: ?>checkbox<?php endif; ?>" class="radio" value="<?php echo $this->_foreach['loop']['iteration']; ?>
" name="vote<?php echo $this->_tpl_vars['list']['id']; ?>
[]">
	<?php endif; ?>
	<u><!--<?php echo $this->_foreach['loop']['iteration']; ?>
.--><?php echo $this->_tpl_vars['slist']['0']; ?>
</u></td><?php if (( $this->_tpl_vars['num']+1 ) % 1 == 0): ?></tr><tr><?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>

	</tr>
    <tr><td colspan='2' style="border-top: 1px dashed #CFCFCF;" height="5"></td></tr>
    <input type="hidden" name="vid[]" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" />
    <?php endforeach; endif; unset($_from); ?>
    <tr><td class="td">
        <input type="submit" value="Голосовать" name="submit" class="btn_nomal_i" />&nbsp;&nbsp;
        <input type="button" onClick="javascript:window.open('<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=vote&vid=<?php echo $this->_tpl_vars['vid']; ?>
')" value="Обзор" name="button" class="btn_nomal_i" />
    </td></tr>
</table>
</form>
    