<?php /* Smarty version 2.6.20, created on 2013-01-15 09:10:43
         compiled from ask_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'ask_index.htm', 78, false),array('function', 'html_image', 'ask_index.htm', 123, false),)), $this); ?>
<script src="script/my_lightbox.js" language="javascript"></script>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/ask/templates/default/ask.css" rel="stylesheet" type="text/css" />
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; Решение вопросов</a>
    </div>
    <div class="headtop_R"></div>		
</div>
<!-- 左侧 -->
<div id="askright">   
		<div class="asktitle">
			<ul class="center2">
				<span class="normaltitle"><?php echo $this->_tpl_vars['lang']['qcat']; ?>
</span>
				<span class="askmore"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list"><?php echo $this->_tpl_vars['lang']['qm']; ?>
</a></span>
			</ul>
		</div>
		<div class="askcatcon">
			<div class="askcon1">
				<span ><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&cat=1"><?php echo $this->_tpl_vars['lang']['unresol']; ?>
<?php echo $this->_tpl_vars['newq']; ?>
</a></span><br/>
				<span ><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?ask_list&cat=2"><?php echo $this->_tpl_vars['lang']['resol']; ?>
<?php echo $this->_tpl_vars['resq']; ?>
</a> </span><br/>
				<span><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?ask_list&cat=reward"><?php echo $this->_tpl_vars['lang']['rewar']; ?>
<?php echo $this->_tpl_vars['rewq']; ?>
</a> </span>
			</div>
        <div id="askcat">
            <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['cList']):
?>
		    <ul>
                <li>
                    <p><a class="btitle" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&id=<?php echo $this->_tpl_vars['cList']['catid']; ?>
" title="<?php echo $this->_tpl_vars['cList']['cat']; ?>
"><?php echo $this->_tpl_vars['cList']['cat']; ?>
</a></p>
					<?php if ($this->_tpl_vars['cList']['sub']): ?>
					<?php $_from = $this->_tpl_vars['cList']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nums'] => $this->_tpl_vars['sublist']):
?>
					<?php if ($this->_tpl_vars['nums'] < 5): ?>
                    <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&id=<?php echo $this->_tpl_vars['sublist']['catid']; ?>
" title="<?php echo $this->_tpl_vars['sublist']['cat']; ?>
"><?php echo $this->_tpl_vars['sublist']['cat']; ?>
</a> |
					<?php endif; ?>
                   <?php endforeach; endif; unset($_from); ?>
				   <?php endif; ?>
                </li>			
			</ul>
		  <?php endforeach; endif; unset($_from); ?>
		  </div>
	</div>
</div>
<!-- 中间 -->
<div class="askmain">
<div class="centerask">
		<div class="askcenter">
		<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=38&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
			<div class="newaskd">
				<div class="newask">
				<form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
" name="asksearch" id='asksearch' method="GET">
					<table  border="0" cellspacing="0" width="100%">
						<tr valign="center">
						 <td width="40%">
						 <input maxlength="50" name="key" tabindex=1 type="text" id="key" style="width:310px;margin-left:5px;color:#CCCCCC"  value="<?php echo $this->_tpl_vars['lang']['enresearch']; ?>
" onclick="this.value='';this.style.color='#FF0000';"/>
						 </td>
						 <td width="6%"><input  type="submit" id="earch_btn" tabindex=2 value="<?php echo $this->_tpl_vars['lang']['searc']; ?>
"></td>
						 <td width="4%">
						 <input  type="button" id="ask_btn" tabindex=3 value="<?php echo $this->_tpl_vars['lang']['iask']; ?>
"  <?php if ($_COOKIE['USER']): ?>onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=add_question&catid=<?php echo $this->_tpl_vars['quest']['catid']; ?>
'" <?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php'" <?php endif; ?>>
						 <input name="m" type="hidden" value="ask" />
						<input name="s" type="hidden" value="ask_list" />
						 </td>
					</table>
				</form>
				</div>
			</div>	
	  </div>

	<div class="askcenter">
			<div class="asktitle center">
				<ul>
					<span class="normaltitle"><?php echo $this->_tpl_vars['lang']['toberes']; ?>
</span>
					<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&cat=1"><span class="askmore"><?php echo $this->_tpl_vars['lang']['qm']; ?>
</span></a>
				</ul>
			</div>
			<div class="newaskd">
				<div class="newask">
					<table  border="0" cellspacing="0" width="100%" style="font-size:12px;padding:5px;">
						 <?php $_from = $this->_tpl_vars['nask']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['alist']):
?>
						<tr>
							<td width="60%"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=question&id=<?php echo $this->_tpl_vars['alist']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['alist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...", true) : smarty_modifier_truncate($_tmp, 50, "...", true)); ?>
</a> [<?php echo $this->_tpl_vars['alist']['cat']; ?>
]</td>
							<td><?php echo $this->_tpl_vars['lang']['anss']; ?>
: <?php echo $this->_tpl_vars['alist']['answer_nums']; ?>
</td>
							<td><img src="<?php echo $this->_tpl_vars['alist']['img']; ?>
" /></td>
							<td><?php echo $this->_tpl_vars['alist']['btime']; ?>
</td>
						</tr>
						<?php endforeach; endif; unset($_from); ?>
					</table>
			  </div>
			</div>
	
	</div>
	<div class="askcenter">
			<div class="asktitle">
				<ul class="center">
					<span class="normaltitle"><?php echo $this->_tpl_vars['lang']['qrewar']; ?>
</span>
					<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=ask_list&cat=2"><span class="askmore"><?php echo $this->_tpl_vars['lang']['qm']; ?>
</span></a>
				</ul>
			</div>
			<div class="newaskd">
				<div class="newask">
					<table  border="0" cellspacing="0" width="100%" style="font-size:12px;padding:5px;">
						 <?php $_from = $this->_tpl_vars['reward']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['rlist']):
?>
						<tr>
							<td width="60%"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/mon.gif"/> <?php echo $this->_tpl_vars['rlist']['reward']; ?>
&nbsp;<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=question&id=<?php echo $this->_tpl_vars['rlist']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['rlist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...", true) : smarty_modifier_truncate($_tmp, 50, "...", true)); ?>
</a> [<?php echo $this->_tpl_vars['rlist']['cat']; ?>
]</td>
							<td><?php echo $this->_tpl_vars['lang']['anss']; ?>
: <?php echo $this->_tpl_vars['rlist']['answer_nums']; ?>
</td>
							<td><img src="<?php echo $this->_tpl_vars['rlist']['img']; ?>
" /></td>
							<td><?php echo $this->_tpl_vars['rlist']['btime']; ?>
</td>
						</tr>
						<?php endforeach; endif; unset($_from); ?>
					</table>
			  </div>
			</div>
	</div>

</div>

<div id="leftask">
	<div class="leftaskbartop"><span class="bartitle"><?php echo $this->_tpl_vars['lang']['knowev']; ?>
</span></div>
	<div id="leftaskbarbody">		 
		<ul>
			<?php $_from = $this->_tpl_vars['knowall']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['klist']):
?>
				<li>
					<span>
					<a href="http://<?php echo $this->_tpl_vars['klist']['user']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['cList']['cat']; ?>
">
					<?php $this->assign('img', $this->_tpl_vars['klist']['userid']); ?>
					<?php echo smarty_function_html_image(array('file' => "uploadfile/user_portrait/".($this->_tpl_vars['img']).".jpg",'width' => 80), $this);?>

					</a>
					</span>
					  <span><a href="http://<?php echo $this->_tpl_vars['klist']['user']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['cList']['cat']; ?>
"><strong><?php echo $this->_tpl_vars['klist']['user']; ?>
</strong></a><br><?php echo $this->_tpl_vars['lang']['point']; ?>
<?php echo $this->_tpl_vars['klist']['point']; ?>
<br/><?php echo $this->_tpl_vars['lang']['bestan']; ?>
<?php echo $this->_tpl_vars['klist']['resn']; ?>
</span>
				</li>
			<?php endforeach; endif; unset($_from); ?>
			<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=39&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
		</ul>
        <div class="clear"></div>
	</div>
</div>
</div>