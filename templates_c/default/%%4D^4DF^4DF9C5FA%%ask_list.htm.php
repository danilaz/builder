<?php /* Smarty version 2.6.20, created on 2013-01-12 18:48:01
         compiled from ask_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'ask_list.htm', 137, false),array('modifier', 'date_format', 'ask_list.htm', 157, false),)), $this); ?>
<script src="script/my_lightbox.js" language="javascript"></script>

<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/ask/templates/default/ask.css" rel="stylesheet" type="text/css" />

<div class="menu_bottom L1">				

    <div class="headtop_L">

        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask">Решение вопросов</a> &raquo; <?php echo $this->_tpl_vars['lang']['qlist']; ?>


    </div>

    <div class="headtop_R"></div>		

</div>



<div id="askright" class="askright">

			<div class="sectitle"><h2><?php echo $this->_tpl_vars['lang']['resq']; ?>
</h2></div>

			<div class="myleftaskbarbody">

			<form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
" name="asksearch" id='asksearch' method="GET">	

			<input maxlength="50" name="key" tabindex=1 type="text" id="key" style="font-size:11px;width:150px;margin-left:5px;color:#CCCCCC"  value="<?php if ($_GET['key']): ?><?php echo $_GET['key']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['pens']; ?>
<?php endif; ?>" onclick="this.value='';this.style.color='#FF0000';"/>

			<input name="m" type="hidden" value="ask" />

			<input name="s" type="hidden" value="ask_list" />

			<input style="font-size:11px;" type="submit" id="earch_btn" tabindex=2 value="<?php echo $this->_tpl_vars['lang']['asearch']; ?>
">

		

			<input  style="font-size:11px;padding:10px;margin:5px;" type="button" id="ask_btn" tabindex=3 value="<?php echo $this->_tpl_vars['lang']['iask']; ?>
" <?php if ($_COOKIE['USER']): ?> onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=add_question&catid=<?php echo $this->_tpl_vars['quest']['catid']; ?>
'" <?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php'" <?php endif; ?>>



			</form>

			<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=41&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>

			</div>



	</div>



<div class="askmain">

	<div class="myaskcenter">

			<div class="myasktitle">

				<ul class="center">

					<span class="normaltitle"><?php echo $this->_tpl_vars['lang']['qlist']; ?>
</span>

				</ul>

			</div>

            <div class="mynewaskd ask_link" style="padding:10px;">

				<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=40&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>

				<table  border="0" cellspacing="3" width="100%" style="font-size:12px;">

					<tr>

						<td colspan="4" align="center">

						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list"><?php echo $this->_tpl_vars['lang']['allq']; ?>
</a> | 

						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&cat=1">Требуют решения</a> | 

						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&cat=reward"><?php echo $this->_tpl_vars['lang']['req']; ?>
</a> | 

						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&cat=2"><?php echo $this->_tpl_vars['lang']['hres']; ?>
</a> | 

						<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&cat=3">Истекшие</a>

						</td>

					 </tr>

					 <?php if ($this->_tpl_vars['subc']): ?>

						<tr>

							<td colspan="4"  style="height:auto;line-height:30px;">

								<?php $_from = $this->_tpl_vars['subc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gcat']):
?>

								<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&id=<?php echo $this->_tpl_vars['gcat']['catid']; ?>
"><?php echo $this->_tpl_vars['gcat']['cat']; ?>
</a>

								<?php endforeach; endif; unset($_from); ?>

							</td>

						</tr>

					　<?php endif; ?>

				</table>

				<div>

					<table border="0" cellspacing="0" width="100%" style="font-size:12px;">

						<tr>

						 <td width="52%" style="border-bottom:1px #cfcfcf solid;"> <?php echo $this->_tpl_vars['lang']['qt']; ?>
</td>

						 <td width="10%" style="border-bottom:1px #cfcfcf solid;"><?php echo $this->_tpl_vars['lang']['anss']; ?>
</td>

						 <td width="8%" style="border-bottom:1px #cfcfcf solid;"><?php echo $this->_tpl_vars['lang']['qsta']; ?>
</td>

						 <td width="15%" style="border-bottom:1px #cfcfcf solid;"> <?php echo $this->_tpl_vars['lang']['qtime']; ?>
</td>

					  </tr>

						 <?php $_from = $this->_tpl_vars['quest']['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['alist']):
?>

						<tr height="29">

							<td>

							<?php if ($this->_tpl_vars['alist']['reward'] > 0): ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/mon.gif" /><?php echo $this->_tpl_vars['alist']['reward']; ?>
<?php endif; ?>

							 <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=question&id=<?php echo $this->_tpl_vars['alist']['id']; ?>
">

							 <?php echo ((is_array($_tmp=$this->_tpl_vars['alist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...", true) : smarty_modifier_truncate($_tmp, 50, "...", true)); ?>


							 </a>[<?php echo $this->_tpl_vars['alist']['cat']; ?>
]

						  </td>

							<td><?php echo $this->_tpl_vars['alist']['answer_nums']; ?>
</td>

							<td>

							<?php if ($this->_tpl_vars['alist']['statu'] == '1'): ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/nask.gif"/>

							<?php elseif ($this->_tpl_vars['alist']['statu'] == '2'): ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/answer.gif"/>

							<?php elseif ($this->_tpl_vars['alist']['statu'] == '3'): ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/expired.gif"/>

							<?php endif; ?>

							</td>

							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['alist']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>

						</tr>

						<?php endforeach; endif; unset($_from); ?>

				  </table>

				  <div class="pages"><?php echo $this->_tpl_vars['quest']['pages']; ?>
</div>

			  </div>				

		   </div> 

	</div>

</div>