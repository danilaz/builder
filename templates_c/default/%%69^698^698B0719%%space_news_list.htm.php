<?php /* Smarty version 2.6.20, created on 2013-01-12 15:17:40
         compiled from space_news_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'space_news_list.htm', 12, false),)), $this); ?>
<div class="common_box">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td align="left" class="guide_ba" colspan="2"><span><?php echo $this->_tpl_vars['lang']['news_list']; ?>
</span></td>
    </tr>
    <?php $_from = $this->_tpl_vars['news']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
    <tr>
      <td align="left" class="borderC">
            <a target="_blank" href="shop.php?uid=<?php echo $_GET['uid']; ?>
&action=news_detail&id=<?php echo $this->_tpl_vars['list']['nid']; ?>
&m=news" title="<?php echo $this->_tpl_vars['list']['title']; ?>
"><?php echo $this->_tpl_vars['list']['ftitle']; ?>
</a>
           
        </td>
        <td align="right" class="borderC"> <?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    <tr>
        <td colspan="2">&nbsp;<?php echo $this->_tpl_vars['info']['page']; ?>
</td>
    </tr>  
</table>
</div>