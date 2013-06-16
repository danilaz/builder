<?php /* Smarty version 2.6.20, created on 2013-01-12 20:01:26
         compiled from exhibition_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'exhibition_detail.htm', 31, false),array('modifier', 'truncate', 'exhibition_detail.htm', 31, false),array('modifier', 'escape', 'exhibition_detail.htm', 31, false),array('modifier', 'date_format', 'exhibition_detail.htm', 97, false),array('insert', 'label', 'exhibition_detail.htm', 83, false),)), $this); ?>
<script type="text/javascript">
function showreview()
{
    var fu='<?php echo $_COOKIE['USER']; ?>
';
	if (fu=='')
	{
	  alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
	   window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php';
	  return false;
	}
	else
	{
	document.getElementById("reviewt").style.display='block';
	}
} 
function getfav()
{	
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
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
	var fu='<?php echo $this->_tpl_vars['de']['id']; ?>
';
 	var typ='4';
	var ttil='<?php echo $this->_tpl_vars['de']['title']; ?>
';
	var mpic='<?php echo $this->_tpl_vars['de']['imgurl']; ?>
';
	var des='<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['de']['con'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100, "...", true) : smarty_modifier_truncate($_tmp, 100, "...", true)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
    var pars = 'user='+u+'&fid='+fu+'&type='+typ+'&title='+ttil+'&url='+myurl+'&des='+des+'&picurl='+mpic;
	var myAjax = new Ajax.Request(url,{method: 'post', parameters: pars, onComplete: showResponse});
	function showResponse(originalRequest)
	{
	    if(originalRequest.responseText>1)
	            alert('<?php echo $this->_tpl_vars['lang']['fav_ok']; ?>
');
		else if (originalRequest.responseText>0)
	            alert('<?php echo $this->_tpl_vars['lang']['fav_isbeing']; ?>
');
		else
	            alert('<?php echo $this->_tpl_vars['lang']['error']; ?>
');
	}
}
function printcontent()
{
	var printw = window.open('','','');
	printw.opener = null;
	printw.document.write('<div style="width:700px;">'+document.getElementById('newscon').innerHTML+'</div>');
	printw.window.print();
}
function picwidth(pid, img)
{
	var img = img ? img : 710;
	var wid= pid.width;
	if(wid < img)
	{
		return;
	} 
	else 
	{
		var hei = pid.height;
		pid.title = 'View big photo';
		pid.onclick=function (e){window.open(pid.src);}
		pid.height = parseInt(hei*img/wid);
		pid.width =img;
	}
}
</script>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/exhibition.css" rel="stylesheet" type="text/css" />
<div class="menu_bottom L1">				
    <div class="headtop_L">
       <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=exhibition"><?php echo $this->_tpl_vars['lang']['exh']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['de']['title']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>

<div id="mainbody1" class="m1">
<!--left-->
<div class="newsbodyleft">
<div class="newstitle"><?php echo $this->_tpl_vars['de']['title']; ?>
</div>

<div style="border-bottom:1px solid #cfcfcf; width:98%; border-top:1px solid #cfcfcf; margin-bottom:10px; margin-top:10px; text-align:center; margin-left:5px;">
Дата: <?php echo $this->_tpl_vars['de']['addTime']; ?>
 <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'statics', 'temp' => 'statics_default', 'ctype' => 4, 'id' => $this->_tpl_vars['de']['id'])), $this); ?>

<a href="#" onClick="getfav();"><?php echo $this->_tpl_vars['lang']['fav']; ?>
</a> <a href="#" onClick="printcontent();"><?php echo $this->_tpl_vars['lang']['print']; ?>
</a>
</div>
<table align="left" width="98%" border="0" cellpadding="3" cellspacing="1" bgcolor="#cfcfcf" class="exhibition">
  <tr>
    <td width="19%" align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_country']; ?>
</strong></td>
    <td width="81%" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['de']['country']; ?>
</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_cat']; ?>
</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['de']['cat']; ?>
</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_time']; ?>
</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['stime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<?php echo $this->_tpl_vars['lang']['timeto']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['de']['etime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_city']; ?>
</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['de']['city']; ?>
</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_addr']; ?>
</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['de']['addr']; ?>
</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_room']; ?>
</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['de']['showroom']; ?>
</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_org']; ?>
</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['de']['organizers']; ?>
</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_contractors']; ?>
</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['de']['contractors']; ?>
</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_contact']; ?>
</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['de']['contact']; ?>
</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#efefef"><strong><?php echo $this->_tpl_vars['lang']['exh_tel']; ?>
</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['de']['tel']; ?>
</td>
  </tr>
  <tr><td bgcolor="#efefef">Закладки</td><td bgcolor="#FFFFFF">
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=anrysys"></script>
<!-- AddThis Button END -->
  </td></tr>
</table>

<div class="newscon" id="newscon" style="padding-top:320px;">
<?php if ($this->_tpl_vars['de']['pic'] != ''): ?>
	<img style="float:left;margin-right:20px;" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/exhibitimg/<?php echo $this->_tpl_vars['de']['pic']; ?>
.jpg"  alt="<?php echo $this->_tpl_vars['de']['title']; ?>
" />
<?php endif; ?>
<?php echo $this->_tpl_vars['de']['con']; ?>


</div>
<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'comment', 'ctype' => 4, 'cid' => $_GET['id'], 'temp' => 'comment_default')), $this); ?>

</div>
<script type="text/javascript">
window.onload = function(){
	var pics = document.getElementById('newscon').getElementsByTagName("img");
	for(var i=0;i<pics.length;i++)	{
		picwidth(pics[i], 710);
	}
}
</script>

<!--right-->
<div class="rightbar">
	<div class="right1">
		<div class="sectitle" ><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['rec_exh']; ?>
</div></div>
		<div class="seccon" >
			<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'exhibition', 'temp' => 'rexhibition_list_rec', 'rec' => '1', 'limit' => 8)), $this); ?>

		</div>
		<div class="clear"></div>
	</div>
</div>	
<!--main end-->
</div>