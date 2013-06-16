<?php /* Smarty version 2.6.20, created on 2013-03-12 08:58:46
         compiled from space_demand_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'space_demand_detail.htm', 18, false),array('modifier', 'truncate', 'space_demand_detail.htm', 18, false),array('modifier', 'escape', 'space_demand_detail.htm', 18, false),array('modifier', 'date_format', 'space_demand_detail.htm', 71, false),array('insert', 'label', 'space_demand_detail.htm', 83, false),)), $this); ?>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/prototype.js" type=text/javascript></script>
<script type="text/javascript">
function getfav()
{	
	var url = 'ajax_back_end.php';
	var myurl=document.location.href;
	var u='<?php echo $_COOKIE['USER']; ?>
';
	if (u=='')
	{
	  alert('<?php echo $this->_tpl_vars['lang']['nologo']; ?>
');
	   window.location.href='login.php';
	  return false;
	}
	var fu='<?php echo $this->_tpl_vars['info']['id']; ?>
';
 	var typ='2';
	var ttil='<?php echo $this->_tpl_vars['info']['title']; ?>
';
	var mpic='/uploadfile/zsimg/<?php echo $this->_tpl_vars['info']['pic']['0']; ?>
.jpg';
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
function seebig(id)
{
    $('imgmove').innerHTML='<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/'+id+'.jpg" target="_blank"><img border="0" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/'+id+'.jpg" width="200"></a>';
}
</script>
<div class="common_box">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="guide_ba" colspan="3"><span style=" float:left;padding-left:10px;"><strong><?php echo $this->_tpl_vars['lang']['demands']; ?>
</strong></span></td>
    </tr>
  <tr>
    <td width="28%" rowspan="8" align="left" valign="top" >
    <div id="imgmove" style="border:1px solid #E4F3FA;margin:0px; height:170px;overflow:hidden;">
    	<?php if ($this->_tpl_vars['info']['pic']['0'] != '' && $this->_tpl_vars['info']['pic']['0'] != 0): ?>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/<?php echo $this->_tpl_vars['info']['pic']['0']; ?>
.jpg" target="_blank" >
                <img border="0" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/<?php echo $this->_tpl_vars['info']['pic']['0']; ?>
.jpg" height="200" width="250">            </a>
        <?php else: ?>
        	<img src="image/default/nopic.gif"  alt="&lt;{$info.pname}&gt;" height="230" width="230"/>
        <?php endif; ?>    </div>
    <div id="infopic" style="overflow:hidden;width:250;text-align:center;margin-top:0px;">
    <?php $_from = $this->_tpl_vars['info']['pic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pic']):
?>
        <?php if ($this->_tpl_vars['pic']): ?>
            <li style="float:left;padding-left:5px;padding-top:5px;">
            <img onMouseOver="seebig('<?php echo $this->_tpl_vars['pic']; ?>
')" style="cursor:pointer" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/size_small/<?php echo $this->_tpl_vars['pic']; ?>
.jpg" border=0 width="45" height="40">            </li>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>    </div>    </td>
    <td width="15%" height="32" class="borderC"><?php echo $this->_tpl_vars['lang']['demand_type']; ?>
</td>
    <td width="57%" height="32" class="borderC">
	<img border="0" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/demand_<?php echo $this->_tpl_vars['info']['type']; ?>
.gif"/></td>
  </tr>
  <tr>
    <td height="25" class="borderC"><?php echo $this->_tpl_vars['lang']['title']; ?>
</td>
    <td class="borderC"><?php echo $this->_tpl_vars['info']['title']; ?>
</td>
  </tr>
  <tr>
    <td height="25" class="borderC"><?php echo $this->_tpl_vars['lang']['price']; ?>
</td>
    <td class="borderC"><?php echo $this->_tpl_vars['info']['price']; ?>
/<?php echo $this->_tpl_vars['info']['priceDes']; ?>
</td>
 </tr>
    <tr>
      <td height="25" class="borderC"><?php echo $this->_tpl_vars['lang']['time']; ?>
</td>
      <td class="borderC"><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
    </tr>
  <tr>
    <td height="25" class="borderC"><?php echo $this->_tpl_vars['lang']['valid']; ?>
</td>
    <td class="borderC"><?php echo $this->_tpl_vars['info']['valid_time']; ?>
</td>
  </tr>
  <tr>
    <td height="25" class="borderC"><?php echo $this->_tpl_vars['lang']['trad_type']; ?>
</td>
    <td class="borderC"><?php echo $this->_tpl_vars['info']['demand_type']; ?>
</td>
  </tr>
    <tr>
    
    <td colspan=2 class="borderC"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'statics', 'temp' => 'statics_default', 'ctype' => 2, 'id' => $this->_tpl_vars['info']['id'])), $this); ?>
	</td>
  </tr>
    <tr>
    <td colspan="2" class="borderC"><img src="http://b2bbuilder66.chinascript.ru/image/default/icon_mail.gif">&nbsp; 
	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['info']['userid']; ?>
&action=mail&tid=<?php echo $this->_tpl_vars['info']['id']; ?>
&contype=2">Связаться</a> | 
	<a href="#" onClick="getfav();">В избранное</a>	</td>
    </tr>
  <tr>
    <td  height="100%" colspan="3" align="left" valign="top" style="height:100%;">
	<div style="margin-top:40px;"><?php echo $this->_tpl_vars['info']['detail']; ?>
</div>  </td>
    </tr>
</table>
<br />
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td width="780" height="40">
		<strong><?php echo $this->_tpl_vars['lang']['myview']; ?>
</strong><br />
		<textarea id="reviewcon" name="reviewcon" cols="90" rows="4" style="font-size:12px;"></textarea>
		<br />
		<?php echo $this->_tpl_vars['lang']['encode']; ?>

		<input name="myrands" type="text" id="myrands" size="10" maxlength="5">
		<img style="padding-top:3px;" src='includes/rand_func.php'/>
		<input type="button" name="rewiews" value="<?php echo $this->_tpl_vars['lang']['subm']; ?>
" onClick="rewiew()"/>
	  </td>
    </tr>
  </table>
</div>