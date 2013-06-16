<?php /* Smarty version 2.6.20, created on 2013-01-12 15:02:55
         compiled from news_indextag.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'news_indextag.htm', 15, false),array('modifier', 'truncate', 'news_indextag.htm', 30, false),)), $this); ?>
<script>
function setTab1(c)
{
	for(i=0;i<=3;i++)
	{
		$('tabmenu_0'+i).className='lst';
		$('tabcontent_0'+i).style.display='none';
	}
	$('tabmenu_0'+c).className='now';
	$('tabcontent_0'+c).style.display='block';
}
</script>
<div class="Contentbox">
	<div id="inf_l">
		<div style="padding-left:30px;"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_top', 'limit' => 6, 'top' => true, 'img' => true, 'leng' => 120)), $this); ?>
</div>                       
		<div id="itetopm">                        
		  <div id="inf-tab">
			<a onmouseover="setTab1(0);" class="now" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=news_list&id=<?php echo $this->_tpl_vars['newstag']['0']['catid']; ?>
" id="tabmenu_00"><?php echo $this->_tpl_vars['newstag']['0']['cat']; ?>
</a>
			<a onmouseover="setTab1(1);" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=news_list&id=<?php echo $this->_tpl_vars['newstag']['1']['catid']; ?>
" id="tabmenu_01" class="lst"><?php echo $this->_tpl_vars['newstag']['1']['cat']; ?>
</a>
			<a onmouseover="setTab1(2);" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=news_list&id=<?php echo $this->_tpl_vars['newstag']['2']['catid']; ?>
" class="lst" id="tabmenu_02"><?php echo $this->_tpl_vars['newstag']['2']['cat']; ?>
</a>
			<a onmouseover="setTab1(3);" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=news_list&id=<?php echo $this->_tpl_vars['newstag']['3']['catid']; ?>
" class="lst" id="tabmenu_03"><?php echo $this->_tpl_vars['newstag']['3']['cat']; ?>
</a>
			</div>
	  <div style="overflow:hidden;height:61px;font-weight:normal;">                      
		<div id="tabcontent_00">
		  <ul>
			<?php $_from = $this->_tpl_vars['newstag']['0']['newsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
?>
			<?php if ($this->_tpl_vars['num'] < 2): ?>
			<li>
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=newsd&id=<?php echo $this->_tpl_vars['slist']['nid']; ?>
" target="_blank" <?php echo $this->_tpl_vars['slist']['style']; ?>
 >
			<?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 232) : smarty_modifier_truncate($_tmp, 232)); ?>
</a>
			</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>  	
		  </ul>
		</div>                      
		<div id="tabcontent_01" style="display: none;">
		  <ul>                          
			<?php $_from = $this->_tpl_vars['newstag']['1']['newsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
?>
			<?php if ($this->_tpl_vars['num'] < 2): ?>
			<li>
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=newsd&id=<?php echo $this->_tpl_vars['slist']['nid']; ?>
" target="_blank" <?php echo $this->_tpl_vars['slist']['style']; ?>
 >
			<?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 232) : smarty_modifier_truncate($_tmp, 232)); ?>
</a>
			</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>  	              
		  </ul>
		</div>                      
		<div id="tabcontent_02" style="display: none;">
		  <ul>                          
			<?php $_from = $this->_tpl_vars['newstag']['2']['newsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
?>
			<?php if ($this->_tpl_vars['num'] < 2): ?>
			<li>
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=newsd&id=<?php echo $this->_tpl_vars['slist']['nid']; ?>
" target="_blank" <?php echo $this->_tpl_vars['slist']['style']; ?>
 >
			<?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 232) : smarty_modifier_truncate($_tmp, 232)); ?>
</a>
			</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>  	                                       
		  </ul>
		  </div>
		<div id="tabcontent_03" style="display: none;">
		  <ul>                          
			<?php $_from = $this->_tpl_vars['newstag']['3']['newsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
?>
			<?php if ($this->_tpl_vars['num'] < 2): ?>
			<li>
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=newsd&id=<?php echo $this->_tpl_vars['slist']['nid']; ?>
" target="_blank" <?php echo $this->_tpl_vars['slist']['style']; ?>
 >
			<?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 232) : smarty_modifier_truncate($_tmp, 232)); ?>
</a>
			</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>  	                                       
		  </ul>
		  </div>    
		<div id="tabcontent_04" style="display: none;">
		  <ul>                          
			<?php $_from = $this->_tpl_vars['newstag']['4']['newsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
?>
			<?php if ($this->_tpl_vars['num'] < 2): ?>
			<li>
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=newsd&id=<?php echo $this->_tpl_vars['slist']['nid']; ?>
" target="_blank" <?php echo $this->_tpl_vars['slist']['style']; ?>
 >
			<?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 332) : smarty_modifier_truncate($_tmp, 332)); ?>
</a>
			</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>  	                                       
		  </ul>
		  </div>
	  </div>                        
	</div>
</div>

<!-- <div id="inf_m">		      
<ul>	        
	 <li id="b2">
	 <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_list_a', 'limit' => 1, 'rec' => 1, 'user' => true, 'leng' => 30)), $this); ?>

	 </li>
	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_default_list', 'limit' => 9, 'leng' => 30)), $this); ?>

</ul> 
</div>-->
<!--<div id="inf_r">		      
	<h3><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=news_list&id=<?php echo $this->_tpl_vars['newstag']['3']['catid']; ?>
">[<?php echo $this->_tpl_vars['newstag']['3']['cat']; ?>
]</a></h3>
	<ul>
		<?php $_from = $this->_tpl_vars['newstag']['3']['newsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
?>
			<?php if ($this->_tpl_vars['num'] < 4): ?>
			<li>
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=newsd&id=<?php echo $this->_tpl_vars['slist']['nid']; ?>
" target="_blank" <?php echo $this->_tpl_vars['slist']['style']; ?>
 >
			<?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 32) : smarty_modifier_truncate($_tmp, 32)); ?>
</a>
			</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>          
	</ul>					        
	<h3><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=news_list&id=<?php echo $this->_tpl_vars['newstag']['4']['catid']; ?>
">[<?php echo $this->_tpl_vars['newstag']['4']['cat']; ?>
]</a></h3>
	<ul>					        
		<?php $_from = $this->_tpl_vars['newstag']['4']['newsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
?>
			<?php if ($this->_tpl_vars['num'] < 4): ?>
			<li>
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=newsd&id=<?php echo $this->_tpl_vars['slist']['nid']; ?>
" target="_blank" <?php echo $this->_tpl_vars['slist']['style']; ?>
 >
			<?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 32) : smarty_modifier_truncate($_tmp, 32)); ?>
</a>
			</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>  				
	</ul>					        
</div> -->