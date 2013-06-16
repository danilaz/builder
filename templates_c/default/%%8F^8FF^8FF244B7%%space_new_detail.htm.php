<?php /* Smarty version 2.6.20, created on 2013-03-08 15:53:20
         compiled from space_new_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'space_new_detail.htm', 21, false),array('modifier', 'truncate', 'space_new_detail.htm', 21, false),array('modifier', 'escape', 'space_new_detail.htm', 21, false),array('modifier', 'date_format', 'space_new_detail.htm', 85, false),array('insert', 'label', 'space_new_detail.htm', 86, false),)), $this); ?>
<script src="script/prototype.js" type=text/javascript></script>
<script type="text/javascript">
function showreview()
{
    document.getElementById("reviewt").style.display='block'; 
} 
function getfav()
{	
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var myurl=document.location.href;
	var u='<?php echo $_COOKIE['USER']; ?>
';
	if(u=='')
	{
	  alert('<?php echo $this->_tpl_vars['lang']['nologo']; ?>
');
	  return false;
	}
	var fu='<?php echo $_GET['id']; ?>
';
 	var typ='1';
	var ttil='<?php echo $this->_tpl_vars['info']['title']; ?>
';
	var mpic='';
	var des='<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['info']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100, "...", true) : smarty_modifier_truncate($_tmp, 100, "...", true)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
    var pars = 'user='+u+'&fid='+fu+'&type='+typ+'&title='+ttil+'&url='+myurl+'&des='+des+'&picurl='+mpic;
	var myAjax = new Ajax.Request(url,{method: 'post', parameters: pars, onComplete: showResponse});
	function showResponse(originalRequest)
	{
	    if(originalRequest.responseText>1)
	       alert('<?php echo $this->_tpl_vars['lang']['favok']; ?>
');
		else if (originalRequest.responseText>0)
	       alert('<?php echo $this->_tpl_vars['lang']['favisbe']; ?>
');
		else
	       alert('<?php echo $this->_tpl_vars['lang']['faverror']; ?>
');
	}
}
function rewiew()
{
    var myurl = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var conid='<?php echo $_GET['id']; ?>
';
	var fu='<?php echo $_COOKIE['USER']; ?>
';
	if(fu=='')
	{
	  alert('<?php echo $this->_tpl_vars['lang']['nologo']; ?>
');
	  return false;
	}
	var typ='1';
	var cons=$('reviewcon').value;
	if (cons.length<10 || cons.length>100)
	{
        alert('<?php echo $this->_tpl_vars['lang']['vwmsg']; ?>
');
		return false;
	}
	var rand=$('myrands').value;
    if (rand=='')
	{
        alert('<?php echo $this->_tpl_vars['lang']['encode']; ?>
');
		return false;
	}
    var pars = 'cid='+conid+'&ctype='+typ+'&con='+cons+'&user='+fu+'&crands='+rand;
	var myAjax = new Ajax.Request(myurl,{method: 'post', parameters: pars, onComplete: showResponse});
	function showResponse(originalRequest)
	{
	    if(originalRequest.responseText>2)
	        alert('<?php echo $this->_tpl_vars['lang']['codeerror']; ?>
');
		else if (originalRequest.responseText>1)
	        alert('<?php echo $this->_tpl_vars['lang']['thanksvw']; ?>
');
		else if (originalRequest.responseText>0)
		    alert('<?php echo $this->_tpl_vars['lang']['vmisbe']; ?>
');
		else
	        alert('<?php echo $this->_tpl_vars['lang']['faverror']; ?>
');
	}
}

</script>

<div class="common_box">	
	<form name="infod" id="infod" method="POST">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="left">
    <td height="30" class="guide_ba"><strong><?php echo $this->_tpl_vars['lang']['news_detail']; ?>
</strong></td>
  </tr>
  <tr>
    <td align="left" valign="top" style="height:auto">
			<div style="padding-left:20px; font-size:16px; font-weight:bold"><?php echo $this->_tpl_vars['info']['title']; ?>
</div>
		
		<div style="padding-left:20px;">
			<?php echo $this->_tpl_vars['lang']['upt']; ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['info']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

			<!-- <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'statics', 'temp' => 'statics_default', 'ctype' => 1, 'id' => $this->_tpl_vars['info']['nid'])), $this); ?>
 -->
		</div>
		<div style="padding-left:20px; border-bottom:1px dashed #CCCCCC">&nbsp;</div>
		<div class="news_conaa" style="padding:20px;">
			<?php echo $this->_tpl_vars['info']['con']; ?>

		</div>
        
    </td>
  </tr>
</table>
</form>
</div>