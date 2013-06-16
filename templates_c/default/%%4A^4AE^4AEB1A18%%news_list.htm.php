<?php /* Smarty version 2.6.20, created on 2013-01-13 06:49:09
         compiled from news_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'news_list.htm', 34, false),array('modifier', 'strip_tags', 'news_list.htm', 35, false),array('modifier', 'replace', 'news_list.htm', 35, false),array('modifier', 'truncate', 'news_list.htm', 35, false),array('insert', 'label', 'news_list.htm', 52, false),)), $this); ?>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/news.css" rel="stylesheet" type="text/css" />
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news"><?php echo $this->_tpl_vars['lang']['bizchenter']; ?>
</a> &raquo; <?php if ($this->_tpl_vars['cat'] != ''): ?><?php echo $this->_tpl_vars['cat']; ?>
<?php else: ?><?php echo $_GET['key']; ?>
<?php endif; ?>
    </div>
    <div class="headtop_R"></div>		
</div>

<?php if (! $_GET['key'] && $this->_tpl_vars['news_menu']['0']['catid']): ?>
    <div class="second_menu">
        <li><?php echo $this->_tpl_vars['lang']['newnav']; ?>
</li>
		<?php $_from = $this->_tpl_vars['news_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
		<li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=news_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</a></li>
		<?php endforeach; endif; unset($_from); ?>
    </div>
<?php endif; ?>

<!--主体开始 -->
	<div id="mainbody1" class="m1">
	<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=28&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
		<!--主体左侧开始 -->
		<div class="leftbar_news">
			<div class="title4"><div class="title_left2 L2">
            <?php if ($this->_tpl_vars['cat'] != ''): ?><?php echo $this->_tpl_vars['cat']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['bizchenter']; ?>
<?php endif; ?>
            </div></div>
			<div class="content4 overflow">
                     <div class="newslist">
	                 <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                        <?php if (( $this->_tpl_vars['num']+1 ) % 5 == 0): ?>
                        <p style="border-bottom: 1px dotted #999999; margin-bottom:8px;">
                        <?php else: ?>
						<p>
                        <?php endif; ?>
                         <span class="time"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
                        <a <?php echo $this->_tpl_vars['list']['style']; ?>
 href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=newsd&id=<?php echo $this->_tpl_vars['list']['nid']; ?>
" title="<?php echo $this->_tpl_vars['list']['title']; ?>
" target="_blank"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['list']['ftitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, "%", "％") : smarty_modifier_replace($_tmp, "%", "％")))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, '...') : smarty_modifier_truncate($_tmp, 200, '...')); ?>
</a>
                        </p>
					<?php endforeach; endif; unset($_from); ?>
					</div>
					<div class="page"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
			</div>
		</div>
		<!--主体左侧结束 -->
		
		<!--主体右侧开始 -->
		<div class="rightbar">
		     <div class="right1">
				<div class="sectitle" >
						<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['picnew']; ?>
</div>
		        </div>
				<div class="seccon">
					<ul class="ul1 pic_list">
					  <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_list_2', 'img' => 'true', 'leng' => 100, 'limit' => 6)), $this); ?>

                    </ul> 
                    <div class="clear"></div>
			    </div>
				<div class="clear"></div>
			</div>
			<div class="right1 m1">
				<div class="sectitle" >
						<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['recread']; ?>
</div>
		        </div>
				<div class="seccon" >
					<ul class="ul1">
					 	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_default_list', 'rec' => 1, 'leng' => 100, 'limit' => 10)), $this); ?>

				   </ul>
				   <div class="clear"></div>
			    </div>
				
			</div>

		</div>		
		<!--主体右侧结束 -->
	</div>