<?php /* Smarty version 2.6.20, created on 2013-01-12 19:05:05
         compiled from com_cat.htm */ ?>
<div class="maintitle">
	<span class="title_t1">Каталог компаний</span>
	<span class="title_more">
		<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=company&s=company_list">Подробнее..</a>
	</span>
</div>

<div class="maincontent">
	<ul class="list5 overflow" style="padding-top:10px;">
		<li>
		<?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['cList']):
?>
				<div class="L_left1">
					<h3  style="font-size:14px; margin-bottom:0px;">
					<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['link']; ?>
&id=<?php echo $this->_tpl_vars['cList']['catid']; ?>
" 
					title="<?php echo $this->_tpl_vars['cList']['cat']; ?>
"><?php if ($this->_tpl_vars['cList']['pic']): ?><img src="<?php echo $this->_tpl_vars['cList']['pic']; ?>
"><?php endif; ?> <?php echo $this->_tpl_vars['cList']['cat']; ?>
</a>
					</h3>
					<?php if ($this->_tpl_vars['cList']['scat']['0']['catid']): ?>
					<p>
					 <?php $_from = $this->_tpl_vars['cList']['scat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nums'] => $this->_tpl_vars['sublist']):
?>
						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['link']; ?>
&id=<?php echo $this->_tpl_vars['sublist']['catid']; ?>
" 
						title="<?php echo $this->_tpl_vars['sublist']['cat']; ?>
"><?php echo $this->_tpl_vars['sublist']['cat']; ?>
</a> <span style="color:#CCCCCC">|</span>
					 <?php endforeach; endif; unset($_from); ?>
					 
					</p>
					<?php endif; ?>
				</div>
				
				<?php if (( $this->_tpl_vars['num']+1 ) % 2 == 0): ?>
					<?php if (( $this->_tpl_vars['num']+1 ) % 4 == 0): ?>
						</li><li>
					<?php else: ?>
						</li><li class="L3" >
					<?php endif; ?>
				<?php endif; ?>
		   <?php endforeach; endif; unset($_from); ?>
		 </li>   
	</ul>
</div>