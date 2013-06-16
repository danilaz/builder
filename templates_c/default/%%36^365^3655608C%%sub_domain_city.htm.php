<?php /* Smarty version 2.6.20, created on 2013-01-12 15:44:41
         compiled from sub_domain_city.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="mainbody1" class="topm">
	<?php if ($this->_tpl_vars['config']['baseurl']): ?>
		<div style=" font-size:14px; font-weight:bold; text-align:left; padding:10px;border: 1px solid #A9BAD3;">
		<?php echo $this->_tpl_vars['lang']['selectcity']; ?>

		</div>
		<div style="border: 1px solid #A9BAD3; margin-top:5px;padding:10px;">
			<span style="width:200px;text-align:left; display:block; height:30px;">
			   <a href="http://www.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
"><strong><?php echo $this->_tpl_vars['lang']['backto']; ?>
</strong></a>
			</span>
			<?php $_from = $this->_tpl_vars['prov']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
				<div style="text-align:left; border-bottom:1px #CCCCCC dashed; margin-bottom:10px; margin-top:10px;">
				  <a href="http://<?php echo $this->_tpl_vars['list']['domain']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
">
					  <font size="+2">
						<?php echo $this->_tpl_vars['list']['con']; ?>

					  </font>
				  </a>
				  <?php $_from = $this->_tpl_vars['list']['city']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
					  <a href="http://<?php echo $this->_tpl_vars['slist']['domain']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
"><?php echo $this->_tpl_vars['slist']['con2']; ?>
</a>
				  <?php endforeach; endif; unset($_from); ?>
				</div> 
			<?php endforeach; endif; unset($_from); ?>
		<div class="clear"></div>
		</div>
	<?php else: ?>
		Не установлен основной путь к системе, дополнительное имя домена для субдомена отсутствует!
	<?php endif; ?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>