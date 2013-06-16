<?php /* Smarty version 2.6.20, created on 2013-03-05 09:47:39
         compiled from brand_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'brand_index.htm', 69, false),)), $this); ?>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/brand/templates/default/brand.css" rel="stylesheet" type="text/css" />
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; Все бренды</a>
    </div>
    <div class="headtop_R"></div>		
</div>

<center>
<div class="brandmain">
 <div class="left" style="overflow:hidden;">
     <div class="left_top">&nbsp;&nbsp;Список брендов</div>
<!-- 	 		<div class="home_cat">
			<li style="width:70px;">По алфавиту</li>
			<li id="A" ><a href="?m=brand&searchby=a">A</a></li>
			<li id="B" ><a href="?m=brand&searchby=b">B</a></li>
			<li id="C" ><a href="?m=brand&searchby=c">C</a></li>
			<li id="D" ><a href="?m=brand&searchby=d">D</a></li>
			<li id="E" ><a href="?m=brand&searchby=e">E</a></li>
			<li id="F" ><a href="?m=brand&searchby=f">F</a></li>
			<li id="G" ><a href="?m=brand&searchby=g">G</a></li>
			<li id="H" ><a href="?m=brand&searchby=h">H</a></li>
			<li id="I" ><a href="?m=brand&searchby=i">I</a></li>
			<li id="J" ><a href="?m=brand&searchby=j">J</a></li>
			<li id="K" ><a href="?m=brand&searchby=k">K</a></li>
			<li id="L" ><a href="?m=brand&searchby=l">L</a></li>
			<li id="M" ><a href="?m=brand&searchby=m">M</a></li>
			<li id="N" ><a href="?m=brand&searchby=n">N</a></li>
			<li id="O" ><a href="?m=brand&searchby=o">O</a></li>
			<li id="P" ><a href="?m=brand&searchby=p">P</a></li>
			<li id="Q" ><a href="?m=brand&searchby=q">Q</a></li>
			<li id="R" ><a href="?m=brand&searchby=r">R</a></li>
			<li id="S" ><a href="?m=brand&searchby=s">S</a></li>
			<li id="T" ><a href="?m=brand&searchby=t">T</a></li>
			<li id="U" ><a href="?m=brand&searchby=u">U</a></li>
			<li id="V" ><a href="?m=brand&searchby=v">V</a></li>
			<li id="W" ><a href="?m=brand&searchby=w">W</a></li>
			<li id="X" ><a href="?m=brand&searchby=x">X</a></li>
			<li id="Y" ><a href="?m=brand&searchby=y">Y</a></li>
			<li id="Z" ><a href="?m=brand&searchby=z">Z</a></li>
		</div> -->

     <div class="left_content">
      <?php $_from = $this->_tpl_vars['brand']['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        <div class="con">
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
				<td>
				<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&s=content&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">
				<?php if ($this->_tpl_vars['list']['pic'] != ''): ?>
					<img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
"/>
				<?php else: ?>
					<img width="100" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/nopic.gif"  alt="<?php echo $this->_tpl_vars['list']['title']; ?>
" />
				<?php endif; ?>
				</a>
            </td></tr>
            <tr><td align="center" style="color:#AACCEE"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=brand&s=content&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a></td></tr>
          </table>
        </div>
        <?php endforeach; endif; unset($_from); ?>
     </div><div class="clear"></div>
     <div class="page"><?php echo $this->_tpl_vars['brand']['pages']; ?>
</div>
 </div>
 
<!--中间右边--> 
 <div class="right">
    <div class="right_top">&nbsp;&nbsp;По регионам</div>
   <div class="right_tj">
   <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'province', 'temp' => 'province_brand')), $this); ?>

   </div>
   <br />
   <div class="right_top">&nbsp;&nbsp;Рекомендуемые бренды</div>
   <div class="right_tj">
     <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'brand', 'temp' => 'brand_list', 'rec' => 2, 'limit' => 5)), $this); ?>

	 <div class="clear"></div>
   </div>
 </div>

</div>
</center>