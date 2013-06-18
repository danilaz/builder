<?php /* Smarty version 2.6.20, created on 2013-01-12 15:06:46
         compiled from aboutus.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<!--主体开始 -->

	<div id="mainbody1" class="topm">

	

		<!--主体左侧开始 -->

		<div class="leftbar_aboutus">

			<div class="title4"><div class="title_left2 L2"><?php echo $this->_tpl_vars['de']['con_title']; ?>
</div></div>

			<div class="content4 overflow">

                <div style="text-align:left;line-height:22px;padding:10px;">

                	<?php echo $this->_tpl_vars['de']['con_desc']; ?>


                    <?php if ($this->_tpl_vars['de']['msg_online'] == 1): ?>

                    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "feedback.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                    <?php endif; ?>

                </div>

			  </div>

		    <div class="bottom4"></div>

             

		</div>

		<!--主体左侧结束 -->

		

		<!--主体右侧开始 -->

		<div class="rightbar">

			<div class="right1">

				<div class="sectitle"  style="background:#366FAA;"><div class="title_left1 L2" style=" color:#FFFFFF;">Наш сервис</div></div>

				 <div class="seccon">

					<ul style="line-height:22px;overflow:hidden;">

                        <?php $_from = $this->_tpl_vars['con_groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>

                        <li style="display:block;">

                        	<b><?php echo $this->_tpl_vars['list']['title']; ?>
</b>

                        	<?php $_from = $this->_tpl_vars['all_web']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['li']):
?>

                            <?php if ($this->_tpl_vars['li']['con_group'] == $this->_tpl_vars['list']['id']): ?><div <?php if ($_GET['type'] == $this->_tpl_vars['li']['con_id']): ?>class='curr_web_con'<?php endif; ?>><a href="<?php echo $this->_tpl_vars['li']['con_linkaddr']; ?>
"><?php echo $this->_tpl_vars['li']['con_title']; ?>
</a></div><?php endif; ?>

                            <?php endforeach; endif; unset($_from); ?>

                        </li>

                        <?php endforeach; endif; unset($_from); ?>

                        <?php $_from = $this->_tpl_vars['all_web']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['li']):
?>

                        <?php if ($this->_tpl_vars['li']['con_group'] < 1): ?>

                        <li><b <?php if ($_GET['type'] == $this->_tpl_vars['li']['con_id']): ?>class='curr_web_con'<?php endif; ?>><a href="<?php echo $this->_tpl_vars['li']['con_linkaddr']; ?>
"><?php echo $this->_tpl_vars['li']['con_title']; ?>
</a></b></li><?php endif; ?>

                        <?php endforeach; endif; unset($_from); ?>

				    </ul>

			    </div>

			  	<div class="bottom5"></div>

				<div class="clear"></div>

				</div>

		</div>		

		<!--主体右侧结束 -->

	</div>

	<!--主体结束 -->	



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>