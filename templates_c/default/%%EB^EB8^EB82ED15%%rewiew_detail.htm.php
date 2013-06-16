<?php /* Smarty version 2.6.20, created on 2013-01-12 16:42:24
         compiled from rewiew_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'rewiew_detail.htm', 25, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['guide']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>

<div id="mainbody1" class="topm">


		
<div style="width:897px; border:1px solid #cfcfcf;overflow:hidden; padding:20px 30px;" >
<div class="newstitle"><?php echo $this->_tpl_vars['tmsg']; ?>
 -- <font color="red" size="4"><?php echo $this->_tpl_vars['lang']['allrewiew']; ?>
</font></div> 
 <table width="100%" height="100%" style="border-collapse:collapse;border:solid #999;border-width:1px 0px 0px 0px;">
  <tr>
    <th width="50" height="30"scope="col" style="border-bottom: 1px solid #999999;" align="left">Номер</th>
    <th width="*" scope="col" style="border-bottom: 1px solid #999999;" align="left"><?php echo $this->_tpl_vars['lang']['revcon']; ?>
</th>
    <th width="100" align="left" style=" border-bottom:1px solid #999999"><?php echo $this->_tpl_vars['lang']['rewtime']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['revdetail']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['rev']):
?>
  <tr>
    <td scope="row" height="30" style="border-bottom: 1px dotted #999999;" align="left" ><?php echo $this->_tpl_vars['num']+1; ?>
</td>
    <td style="border-bottom: 1px dotted #999999;" align="left"><?php echo $this->_tpl_vars['rev']['content']; ?>
</td>
    <td style="border-bottom: 1px dotted #999999;" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['rev']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
  </tr>
   <?php endforeach; endif; unset($_from); ?>
</table>              
</div>	
</div>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>