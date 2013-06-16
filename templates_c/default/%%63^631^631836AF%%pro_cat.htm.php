<?php /* Smarty version 2.6.20, created on 2013-01-12 15:02:55
         compiled from pro_cat.htm */ ?>
<div class="maintitle">
    <span class="title_t1">Отрасли</span>
    <span class="title_more">
        <a href="<?php echo $this->_tpl_vars['config']['weurl']; ?>
/?m=offer&s=offer_list">Подробнее</a>
    </span>
</div>		
<div class="maincontent">
	<div class="charcat">
		<script>
		var cityurl='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
		</script>
		<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/get_index_cat.js" type=text/javascript></script>
<!-- 		<div class="home_cat">
			<li style="margin-left:3px;">5По алфавиту</li>
			<li id="A" onmouseover="get_index_cat('A','p');">A</li>
			<li id="B" onmouseover="get_index_cat('B','p');">B</li>
			<li id="C" onmouseover="get_index_cat('C','p');">C</li>
			<li id="D" onmouseover="get_index_cat('D','p');">D</li>
			<li id="E" onmouseover="get_index_cat('E','p');">E</li>
			<li id="F" onmouseover="get_index_cat('F','p');">F</li>
			<li id="G" onmouseover="get_index_cat('G','p');">G</li>
			<li id="H" onmouseover="get_index_cat('H','p');">H</li>
			<li id="I" onmouseover="get_index_cat('I','p');">I</li>
			<li id="J" onmouseover="get_index_cat('J','p');">J</li>
			<li id="K" onmouseover="get_index_cat('K','p');">K</li>
			<li id="L" onmouseover="get_index_cat('L','p');">L</li>
			<li id="M" onmouseover="get_index_cat('M','p');">M</li>
			<li id="N" onmouseover="get_index_cat('N','p');">N</li>
			<li id="O" onmouseover="get_index_cat('O','p');">O</li>
			<li id="P" onmouseover="get_index_cat('P','p');">P</li>
			<li id="Q" onmouseover="get_index_cat('Q','p');">Q</li>
			<li id="R" onmouseover="get_index_cat('R','p');">R</li>
			<li id="S" onmouseover="get_index_cat('S','p');">S</li>
			<li id="T" onmouseover="get_index_cat('T','p');">T</li>
			<li id="U" onmouseover="get_index_cat('U','p');">U</li>
			<li id="V" onmouseover="get_index_cat('V','p');">V</li>
			<li id="W" onmouseover="get_index_cat('W','p');">W</li>
			<li id="X" onmouseover="get_index_cat('X','p');">X</li>
			<li id="Y" onmouseover="get_index_cat('Y','p');">Y</li>
			<li id="Z" onmouseover="get_index_cat('Z','p');">Z</li>
		</div> -->
		<div id="ajax_cat" class="homeajax_cat" onmouseout="this.style.display='none';"></div>
	</div>
	<ul class="list5 overflow" style="padding-top:10px;">
		<li>
		<?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['cList']):
?>
				<div class="L_left1">
					<h3>
					<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_list&id=<?php echo $this->_tpl_vars['cList']['catid']; ?>
" 
					title="<?php echo $this->_tpl_vars['cList']['cat']; ?>
"><?php if ($this->_tpl_vars['cList']['pic']): ?><img src="<?php echo $this->_tpl_vars['cList']['pic']; ?>
"> <?php endif; ?><?php echo $this->_tpl_vars['cList']['cat']; ?>
</a><!-- <font size="2"> (<?php echo $this->_tpl_vars['cList']['rec_nums']; ?>
)</font> -->
					</h3>
					<p>
					 <?php $_from = $this->_tpl_vars['cList']['scat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nums'] => $this->_tpl_vars['sublist']):
?>
							<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_list&id=<?php echo $this->_tpl_vars['sublist']['catid']; ?>
" 
							title="<?php echo $this->_tpl_vars['sublist']['cat']; ?>
"><?php echo $this->_tpl_vars['sublist']['cat']; ?>
</a> <span style="color:#CCCCCC">|</span>
					 <?php endforeach; endif; unset($_from); ?>
					 
					</p>
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


