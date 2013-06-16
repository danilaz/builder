<?php /* Smarty version 2.6.20, created on 2013-01-12 18:48:04
         compiled from question.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'question.htm', 17, false),array('modifier', 'strip_tags', 'question.htm', 19, false),array('modifier', 'truncate', 'question.htm', 108, false),array('modifier', 'date_format', 'question.htm', 132, false),)), $this); ?>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/ask/templates/default/ask.css" rel="stylesheet" type="text/css" />
<script src="script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript">
function getfav()
{	
	var url = 'ajax_back_end.php';
	var myurl=document.location.href;
	var u='<?php echo $_COOKIE['USER']; ?>
';
	if (u=='')
	{
	  alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
	  window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php';
	  return false;
	}
	var fu='<?php echo $_GET['id']; ?>
';
 	var typ='6';
	var ttil='<?php echo ((is_array($_tmp=$this->_tpl_vars['quest']['title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", "")); ?>
';
	var mpic='';
	var des='<?php echo ((is_array($_tmp=$this->_tpl_vars['quest']['title'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
';
    var pars = 'user='+u+'&fid='+fu+'&type='+typ+'&title='+ttil+'&url='+myurl+'&des='+des+'&picurl='+mpic;
	var myAjax = new Ajax.Request(url,{method: 'post', parameters: pars, onComplete: showResponse});
	function showResponse(originalRequest)
	{
	    if(originalRequest.responseText>1)
		{
	       alert('<?php echo $this->_tpl_vars['lang']['fav_ok']; ?>
');
		}
		else if (originalRequest.responseText>0)
		{
	       alert('<?php echo $this->_tpl_vars['lang']['fav_isbing']; ?>
');
		}
		else
		{
	       alert('<?php echo $this->_tpl_vars['lang']['error']; ?>
');
		}
	}
}
function getmsg()
{
	var tar=document.getElementById('myanswer');
	var rad=document.getElementById('myrands');
	var islogo='<?php echo $_COOKIE['USER']; ?>
';
	var s=trim(tar.value);
	var len=10000-s.length;
	if(len>=0&&islogo!='')
	{
		document.getElementById('answermsg').innerHTML='<?php echo $this->_tpl_vars['lang']['yce']; ?>
'+len+'<?php echo $this->_tpl_vars['lang']['acs']; ?>
';
		if(s.length<1||rad.value.length<4)
			document.getElementById('myanswer_btn').disabled=true;
		else
			document.getElementById('myanswer_btn').disabled=false;
	}
	else
	{
		if(islogo!='')
			document.getElementById('answermsg').innerHTML='<?php echo $this->_tpl_vars['lang']['aisl']; ?>
';
		else
			document.getElementById('answermsg').innerHTML='<font color="red"><?php echo $this->_tpl_vars['lang']['nolog']; ?>
</font>';
		document.getElementById('myanswer_btn').disabled=true;
		return false;
	}
}
function trim(str)
{    
   return str.replace(/\s/g,'');    
}    
</script>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/ask.css" rel="stylesheet" type="text/css" />
<div class="menu_bottom L1">				
    <div class="headtop_L">
             <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['ihome']; ?>
</a> &raquo; <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask"><?php echo $this->_tpl_vars['lang']['askq']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['guide']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>







<div id="askright" class="askright">
	<div class="sectitle"><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['sa']; ?>
</div></div>
	<div class="seccon">
	<form action="" name="asksearch" id='asksearch' method="get">
		<table  border="0" cellspacing="0" width="100%">
			<tr valign="center">
			<td>
            <input maxlength="50" name="key" tabindex=1 type="text" id="key" style="width:180px;margin-left:5px;color:#CCCCCC"  value="<?php echo $this->_tpl_vars['lang']['plen']; ?>
" onclick="this.value='';this.style.color='#FF0000';"/>
            </td>
			</tr>
			<tr>
			<td align="center">
			<input name="m" type="hidden" value="ask" />
			<input name="s" type="hidden" value="ask_list" />
            <input  type="submit" id="earch_btn" tabindex=2 value="<?php echo $this->_tpl_vars['lang']['sa']; ?>
">
            <input  type="button" id="ask_btn" tabindex=3 value="<?php echo $this->_tpl_vars['lang']['iask']; ?>
" <?php if ($_COOKIE['USER']): ?> onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=add_question&catid=<?php echo $this->_tpl_vars['quest']['catid']; ?>
'" <?php else: ?>onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php'" <?php endif; ?>>
            </td>
			</tr>
		</table>
	</form>
	</div>

	<div class="sectitle m1"><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['relq']; ?>
</div></div>
	<div class="seccon">		 
		<?php $_from = $this->_tpl_vars['relquest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rlist']):
?>
        <li>
          <span><?php if ($this->_tpl_vars['rlist']['reward']): ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/mon.gif "><?php echo $this->_tpl_vars['rlist']['reward']; ?>
<?php else: ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/nask.gif"><?php endif; ?>&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=ask&s=question&id=<?php echo $this->_tpl_vars['rlist']['id']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['rlist']['title']; ?>
"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['rlist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</strong></a></span>
        </li>
		<?php endforeach; endif; unset($_from); ?>
	</div>
</div>








<div class="askmain">
			<div class="myasktitle">
				<ul class="center">
					<span class="normaltitle"><?php if ($this->_tpl_vars['quest']['statu'] == 1): ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/nask.gif" height="15"/>&nbsp;&nbsp;<?php echo $this->_tpl_vars['lang']['wq']; ?>
<?php elseif ($this->_tpl_vars['quest']['statu'] == 2): ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/answer.gif" height="15"/>&nbsp;&nbsp;<?php echo $this->_tpl_vars['lang']['hres']; ?>
<?php elseif ($this->_tpl_vars['quest']['statu'] == 3): ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/expired.gif" height="15"/>&nbsp;&nbsp;<?php echo $this->_tpl_vars['lang']['expir']; ?>

					<?php endif; ?></span>
					<span style="float:right;margin-top:5px;margin-right:5px;"><a href="#" onclick="getfav()"><?php echo $this->_tpl_vars['lang']['favit']; ?>
</a></span>
			</ul>
			</div>
			<div class="mynewaskd">
				<div style="margin-top:0px;width:100%;height:100%;">
					<span style="font-weight:bold; color:#005AA6;margin-left:10px;"><?php echo $this->_tpl_vars['quest']['title']; ?>
</span><br>
					<span style="color:#003366;margin-left:10px;margin-top:5px;"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/mon.gif "><?php echo $this->_tpl_vars['lang']['rewards']; ?>
<?php echo $this->_tpl_vars['quest']['reward']; ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['lang']['qtime']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['quest']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span><br>
					<span style="margin-left:10px;margin-top:10px;">
						<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=42&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
						<?php echo $this->_tpl_vars['quest']['content']; ?>

					</span>
					<?php if ($this->_tpl_vars['quest']['des']): ?>
					<span style="font-weight:bold; color:#005AA6;comargin-left:10px;margin-top:10px;"><?php echo $this->_tpl_vars['lang']['qappend']; ?>
</span><br>
					<span style="margin-left:10px;margin-top:10px;"><?php echo $this->_tpl_vars['quest']['des']; ?>
</span>
					<?php endif; ?>
					<br>
					<span style="margin-left:10px;margin-right:10px;margin-top:10px;text-align:right;">
					<?php echo $this->_tpl_vars['lang']['asks']; ?>
<a href="http://<?php echo $this->_tpl_vars['uname']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
"><?php echo $this->_tpl_vars['uname']; ?>
</a>&nbsp;&nbsp;
					<?php if ($this->_tpl_vars['uname'] == $_COOKIE['USER'] && $this->_tpl_vars['quest']['statu'] != 2): ?>
					<a href="?m=ask&s=question&id=<?php echo $_GET['id']; ?>
&thanks=haveanswer"><?php echo $this->_tpl_vars['lang']['ihsel']; ?>
</a>
					<?php endif; ?>
					</span>
				</div>				
				<?php if ($this->_tpl_vars['quest']['statu'] == 1): ?>
					<div class="myanswer">
					<form action="" name="thismyanswer" id='thismyanswer' method="POST">
					<span><?php echo $this->_tpl_vars['lang']['msg1']; ?>
</span><?php if ($_GET['sameday'] == '1'): ?>&nbsp;&nbsp;<span><font color="#FF0000"><?php echo $this->_tpl_vars['lang']['msg2']; ?>
</font></span><?php endif; ?><?php if ($_GET['answerok'] == '1'): ?>&nbsp;&nbsp;<span><font color="#FF0000"><?php echo $this->_tpl_vars['lang']['ansok']; ?>
</font></span><?php endif; ?><br>
					<input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>
" />
					<input name="anuserid" type="hidden" id="anuserid" value="<?php echo $this->_tpl_vars['anuid']; ?>
" />
					<textarea style="width:665px; height:150px;color:#000000" name="myanswer" id="myanswer" cols="40" rows="5" tabindex=1 onkeyup="getmsg();" onclick="getmsg();" ></textarea>
					<span style="float:left;"><?php echo $this->_tpl_vars['lang']['randcode']; ?>
<input name="myrands" type="text" id="myrands" size="5" maxlength="5" onkeyup="getmsg();">
					<img onclick="get_randfunc(this);" style="padding-top:3px; cursor:pointer;" src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/includes/rand_func.php'/></span><?php if ($_GET['errorcode'] == '1'): ?><span><font color="#FF0000"><?php echo $this->_tpl_vars['lang']['codeerr']; ?>
</font></span><?php endif; ?><span id="answermsg" style="float:right;color:#000000;margin-right:5px;"></span><input  type="submit" name="myanswer_btn" id="myanswer_btn" tabindex=2 value="<?php if ($_COOKIE['USER'] && $_COOKIE['USER'] != $this->_tpl_vars['uname']): ?><?php echo $this->_tpl_vars['lang']['submyan']; ?>
<?php elseif ($_COOKIE['USER'] == $this->_tpl_vars['uname']): ?><?php echo $this->_tpl_vars['lang']['iappen']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['nologo']; ?>
<?php endif; ?>" onclick="getmsg();" disabled>
					</form>
					</div>
				<?php endif; ?>
				<div class="clear"></div>
		   </div> 
		   <!-- 其他回复 -->
		  <?php if ($this->_tpl_vars['allnums'] > 0): ?>
           <div class="myasktitle" style="margin-top:10px;">
				<ul class="center">
					<span class="normaltitle"><?php echo $this->_tpl_vars['lang']['alla']; ?>
</span>&nbsp;&nbsp;[<?php echo $this->_tpl_vars['lang']['dot']; ?>
: <?php echo $this->_tpl_vars['allnums']; ?>
]
				</ul>
			</div>
			<div class="mynewaskd">
		        <div class="allanswer">
				<?php $_from = $this->_tpl_vars['answer']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['anlist']):
?>	
				<li style="width:660px;height:auto;">
				 <?php if ($this->_tpl_vars['anlist']['best_answer'] == '1'): ?>	 
				 <span style="float:left;height:100%;line-height:30px;background:#f7fcff;border:1px #FF0000 solid;width:665px;margin:0 auto;padding:2px;word-break:break-all;">
				 <span style="color:#ff0000;width:660px;"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/besta.jpg"><?php echo $this->_tpl_vars['lang']['besta']; ?>
</span><br>
				 <?php else: ?><span style="float:left;height:100%;line-height:30px;border-bottom:1px #9fc1e7 dashed;margin-top:10px;width:660px;word-break:break-all;"><?php endif; ?><?php echo $this->_tpl_vars['anlist']['answer_con']; ?>
</span>
				 <span style="float:right;margin-top:20px;margin-bottom:10px;"><?php if ($this->_tpl_vars['uname'] == $_COOKIE['USER'] && $this->_tpl_vars['anlist']['best_answer'] != 1 && $this->_tpl_vars['quest']['statu'] != 2): ?><a href="question.php?id=<?php echo $_GET['id']; ?>
&bestanswerid=<?php echo $this->_tpl_vars['anlist']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/number1.jpg"></a>&nbsp;&nbsp;&nbsp;<?php endif; ?><?php echo $this->_tpl_vars['lang']['answerp']; ?>
<a href="http://<?php echo $this->_tpl_vars['anlist']['user']; ?>
.<?php echo $this->_tpl_vars['config']['baseurl']; ?>
"><?php echo $this->_tpl_vars['anlist']['user']; ?>
</a>&nbsp;&nbsp;<?php echo $this->_tpl_vars['lang']['atime']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['anlist']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span></span>
				 </li>
				<?php endforeach; endif; unset($_from); ?>
				<li class="page"><?php echo $this->_tpl_vars['answer']['pages']; ?>
</li>
				</div>
				<div class="clear"></div>
			</div>	
            <?php endif; ?>
 
</div>