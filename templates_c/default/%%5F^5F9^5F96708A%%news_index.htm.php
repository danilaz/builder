<?php /* Smarty version 2.6.20, created on 2013-01-12 19:52:51
         compiled from news_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'news_index.htm', 18, false),array('insert', 'getSpecial', 'news_index.htm', 28, false),)), $this); ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
       <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['title']; ?>
</a>
    </div>
    <div class="headtop_R"></div>		
</div>

<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/news.css" rel="stylesheet" type="text/css" />
<div id="mainbody1" class="m1">
    <div class="second_menu">
        <li><?php echo $this->_tpl_vars['lang']['title']; ?>
：</li>
        <?php $_from = $this->_tpl_vars['news_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=newslist&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</a></li>
        <?php endforeach; endif; unset($_from); ?>
    </div>
	<div>
    	<div class="news_left">
        	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_flash', 'flash' => true, 'img' => 'true', 'width' => '295', 'height' => '222', 'limit' => 5)), $this); ?>

        </div>
    	<div class="news_middle">
        	<ul><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_list_3', 'leng' => 200, 'limit' => 5)), $this); ?>
</ul>
        </div>
    	<div class="news_right">
        	
			<div class="sectitle"><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['special']; ?>
</div></div>
            <div class="seccon" style="padding:10px;">
                 <ul class="ul1">
                  <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'getSpecial', 'limit' => 6, 'leng' => 80)), $this); ?>

                 </ul>
				 <div class="clear"></div>
           </div>
        </div>
       
        <div class="adv">
        	<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=27&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
        </div>
        
        <div class="news_l">
        	<?php $_from = $this->_tpl_vars['news_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['loop']['iteration']++;
?>
                <div class="box<?php if ($this->_foreach['loop']['iteration']%2 == 0): ?>s<?php endif; ?>">
                    <div class="sectitle"><div class="title_left1 L2"><?php echo $this->_tpl_vars['list']['cat']; ?>
</div> 
                    	<a target="_blank" style="float:right; padding:6px;" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=news&s=news_list&id=<?php echo $this->_tpl_vars['list']['catid']; ?>
"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/more.gif"></a>
                    </div>
                    <div class="seccon">
                         <ul class="ul1" style="padding:10px">
                            <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_list_pic', 'catid' => $this->_tpl_vars['list']['catid'], 'img' => 'true', 'leng' => 42, 'limit' => 5)), $this); ?>

                           
                         </ul>
                   </div>
                </div>
            <?php endforeach; endif; unset($_from); ?>
        </div>
        <div class="news_r">
        	<div class="tjtw">
                <div class="sectitle"><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['RecommendedGraphic']; ?>
</div></div>
                <div class="seccon" style="margin-bottom:10px">
                     <ul class="ul1">
                       <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'news', 'temp' => 'news_list_2', 'img' => 'true', 'leng' => 16, 'limit' => 5)), $this); ?>

                     </ul>
                     <div class="clear"></div>
               </div>
            </div>
           <div class="dcwj">
               <div class="sectitle"><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['questionnaire']; ?>
</div></div>
                <div class="seccon" style="margin-bottom:10px">
                     <ul class="ul1" style="padding:20px">
                       <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'vote', 'temp' => 'vote_list', 'limit' => 2)), $this); ?>

                     </ul>
               </div>
           </div>
           
        </div>
    </div>
</div>