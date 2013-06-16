<?php /* Smarty version 2.6.20, created on 2013-01-12 15:02:59
         compiled from offer_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'offer_detail.htm', 15, false),array('modifier', 'strip_tags', 'offer_detail.htm', 17, false),array('modifier', 'date_format', 'offer_detail.htm', 124, false),array('modifier', 'truncate', 'offer_detail.htm', 192, false),array('insert', 'label', 'offer_detail.htm', 62, false),array('function', 'html_image', 'offer_detail.htm', 66, false),array('function', 'geturl', 'offer_detail.htm', 191, false),)), $this); ?>
<script type="text/javascript">
function getfav()
{	
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var myurl='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer%26s=offer_detail%26id=<?php echo $_GET['id']; ?>
';
	var u='<?php echo $_COOKIE['USER']; ?>
';
	if(u=='')
	{
	  alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
	  window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward='+myurl;
	  return false;
	}
	var fu='<?php echo $_GET['id']; ?>
';
 	var typ='2';
	var ttil='<?php echo ((is_array($_tmp=$this->_tpl_vars['de']['title'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", "")); ?>
';
	var mpic='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/<?php echo $this->_tpl_vars['de']['showimg']; ?>
.jpg';
	var des='<?php echo ((is_array($_tmp=$this->_tpl_vars['de']['title'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
';
    var pars = 'user='+u+'&fid='+fu+'&type='+typ+'&title='+ttil+'&url='+myurl+'&des='+des+'&picurl='+mpic;
	var myAjax = new Ajax.Request(url,{method: 'post', parameters: pars, onComplete: showResponse});
	function showResponse(originalRequest)
	{
	    if(originalRequest.responseText>1)
	       alert('<?php echo $this->_tpl_vars['lang']['fav_ok']; ?>
');
		else if (originalRequest.responseText>0)
	       alert('<?php echo $this->_tpl_vars['lang']['fav_isbing']; ?>
');
		else
	       alert('<?php echo $this->_tpl_vars['lang']['error']; ?>
');
	}
}
function seebig(id)
{
    $('imgmove').innerHTML='<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/'+id+'.jpg" target="_blank">'+
	'<img id="img'+id+'" border="0" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/'+id+'.jpg" ></a>';
	if($('img'+id).height>$('img'+id).width)
		$('img'+id).height=275;
	else
		$('img'+id).width=275;
}
var weburl='<?php echo $this->_tpl_vars['config']['weburl']; ?>
';
function copyToClipboard(txt)
{
  try{
	  window.clipboardData.setData("Text",txt);  
	  alert('<?php echo $this->_tpl_vars['lang']['copysuc']; ?>
'); 
  }
  catch(e){alert('<?php echo $this->_tpl_vars['lang']['noace']; ?>
');}
}
</script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/my_lightbox.js" language="javascript"></script>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['home']; ?>
</a> &raquo; <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer">Предложения</a> &raquo; <?php echo $this->_tpl_vars['guide']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>
<div id="mainbody1" class="m1">

<div class="leftbar_detail">
	<div class="title4"><div class="title_left2 L2">Информация о продукте</div></div>    
    <div class="content4" style="padding:5px 20px;">
	<div class="newstitle"><?php echo $this->_tpl_vars['de']['offertype']; ?>
 : <?php echo $this->_tpl_vars['de']['title']; ?>
</div> 
    <div class="newstime">[<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'statics', 'temp' => 'statics_default', 'ctype' => 2, 'id' => $this->_tpl_vars['de']['id'])), $this); ?>
]</div>
			<div class="propic">
			    <div id="imgmove" class="imgmove">       						 
                     <?php $this->assign('img', $this->_tpl_vars['de']['pic']['0']); ?>
                     <?php echo smarty_function_html_image(array('file' => "uploadfile/zsimg/".($this->_tpl_vars['img']).".jpg",'width' => 275,'alt' => $this->_tpl_vars['list']['title']), $this);?>

				 </div>
                 
				 <div id="infopic" class="small_pic">
				  <?php $_from = $this->_tpl_vars['de']['pic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['pic']):
?>
						<?php if ($this->_tpl_vars['pic'] && $this->_tpl_vars['num'] < 4): ?>
						<img onMouseOver="seebig('<?php echo $this->_tpl_vars['pic']; ?>
')" style="cursor:pointer" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/size_small/<?php echo $this->_tpl_vars['pic']; ?>
.jpg" border=0 width="45" height="40">
						<?php endif; ?>
				 <?php endforeach; endif; unset($_from); ?>
				</div>
                <div style="float:left; padding:8px;overflow:hidden;">
                    <a href="javascript:alertWin('<?php echo $this->_tpl_vars['lang']['share']; ?>
','<br><span style=width:80px;><?php echo $this->_tpl_vars['lang']['purl']; ?>
</span><input id=textfield type=text size=45 value=<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_detail&id=<?php echo $this->_tpl_vars['de']['id']; ?>
>
                    <div style=width:340px;padding-left:60px;text-align:left;><br><button onclick=copyToClipboard(\'<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_detail&id=<?php echo $this->_tpl_vars['de']['id']; ?>
\')><?php echo $this->_tpl_vars['lang']['copysend']; ?>
</button></div>',400,100,'');"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/add_to_share.png" /></a>
                    <a href="javascript:getfav();"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/add_to_fav.png" /></a>
                </div>
			</div>
			<div class="proinfo">
			<table width="330" border="0">
            	<tr>
					 <td width="120" class="pro_text"><?php echo $this->_tpl_vars['lang']['price']; ?>
</td>
					 <td width="250" class="pro_text"><span style="color:#FF5500; font-size:24px;"><?php echo $this->_tpl_vars['de']['price']; ?>
</span> <?php echo $this->_tpl_vars['config']['money']; ?>
/<?php echo $this->_tpl_vars['de']['priceDes']; ?>
</td> 
				 </tr>
                 <tr>
					 <td class="pro_text"><?php echo $this->_tpl_vars['lang']['valid_time']; ?>
</td>
					 <td class="pro_text"><?php $_from = $this->_tpl_vars['validTime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?><?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['de']['valid_time']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
				 </tr>
                 <tr>
					 <td class="pro_text"><?php echo $this->_tpl_vars['lang']['pro_city']; ?>
</td>
					 <td class="pro_text">
					 
					 <?php echo $this->_tpl_vars['cominfo']['province']; ?>

					 
					 <?php if ($this->_tpl_vars['cominfo']['city'] != ''): ?> 
					  <?php if ($this->_tpl_vars['cominfo']['province'] != ''): ?>,<?php endif; ?> 
					  <?php echo $this->_tpl_vars['cominfo']['city']; ?>

					  <br/>
					 <?php endif; ?>
					 
					 </td>
				 </tr>
                  <tr>
					<td class="pro_text"><?php echo $this->_tpl_vars['lang']['brand']; ?>
</td>
					<td class="pro_text" width="223"><?php echo $this->_tpl_vars['de']['pp']; ?>
</td>
				 </tr>
				 <tr>
					<td class="pro_text"><?php echo $this->_tpl_vars['lang']['pard']; ?>
</td>
					<td class="pro_text"><?php echo $this->_tpl_vars['de']['gg']; ?>
</td>
				 </tr>
				 <tr>
					<td class="pro_text"><?php echo $this->_tpl_vars['lang']['model']; ?>
</td>
					<td class="pro_text"><?php echo $this->_tpl_vars['de']['model']; ?>
</td>
				 </tr>
                 <tr>
					 <td class="pro_text_"><?php echo $this->_tpl_vars['lang']['ptype']; ?>
</td>
					 <td><?php echo $this->_tpl_vars['de']['ptype']; ?>
</td>
				 </tr>
                 <tr>
					 <td class="pro_text"><?php echo $this->_tpl_vars['lang']['ptime']; ?>
</td>
					 <td class="pro_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
				 </tr>
                <tr>
				 <td colspan="2" class="pro_text_offer_my"><?php echo $this->_tpl_vars['lang']['summary']; ?>
</td>
				 </tr>
				 <tr><td colspan="2"><?php echo $this->_tpl_vars['de']['con']; ?>
<br /><br />
				 
				 <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=anrysys"></script>
<!-- AddThis Button END -->
				 <br />
				 </td></tr>
				 <tr>
				 <td colspan="2">
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['de']['userid']; ?>
&action=mail&tid=<?php echo $this->_tpl_vars['de']['id']; ?>
&contype=2">
                 <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/sendmail.gif" />
                 </a>
                 </td>
				 </tr>
			</table>
			</div>
            <div class="clear"></div>
			<div class="prodetail" id="productdetail">
				<div class="pro_int">Подробное описание</div>
					<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=17&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
					<?php echo $this->_tpl_vars['de']['detail']; ?>
 
				</div>
			<br/>
            <?php if ($this->_tpl_vars['attach']): ?>
            <div>
            	<div class="pro_int"><?php echo $this->_tpl_vars['lang']['attach']; ?>
</div>
                <ul style="margin-top:10px;">
                	<?php $_from = $this->_tpl_vars['attach']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                	<li style="float:left; width:80px;text-align:center; margin-left:10px; margin-right:15px;word-wrap: break-word;word-break:break-all; line-height:14px;">
                		<a title="<?php echo $this->_tpl_vars['list']['downname']; ?>
" href="?m=offer&s=offer_down&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&de=<?php echo $this->_tpl_vars['list']['file_url']; ?>
">
                        <img height="60px;" src="<?php echo $this->_tpl_vars['list']['thumb_img']; ?>
">
                        </a><br />
                        <a style="font-size:11px;" href="?m=offer&s=offer_down&id=<?php echo $this->_tpl_vars['list']['id']; ?>
&de=<?php echo $this->_tpl_vars['list']['file_url']; ?>
"><?php echo $this->_tpl_vars['list']['downname']; ?>
.<?php echo $this->_tpl_vars['list']['pic']; ?>
</a>&nbsp;&nbsp;<h5>(<?php echo $this->_tpl_vars['list']['filesize']; ?>
)</h5>
                	</li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
                <div style="clear:both"></div>
            </div>
            <?php endif; ?>
            <br />
			<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'comment', 'ctype' => 2, 'cid' => $_GET['id'], 'temp' => 'comment_default')), $this); ?>

            </div>
			
			<div class="m1">
			<div class="title4">
            	<h2 style="float:left; margin-left:20px;"><?php echo $this->_tpl_vars['lang']['com_newpro']; ?>
</h2>
                <span style="float:right; margin-right:20px;"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=offer&s=offer_list&id=<?php echo $this->_tpl_vars['de']['catid']; ?>
"><?php echo $this->_tpl_vars['lang']['more']; ?>
</a>&nbsp;</span>
            </div>
			<div class="sameoffer content4" style="padding:5px 20px;">
            <table width="100%" border="0" cellspacing="5" cellpadding="0" style="text-align:left;">
              <tr>
              <?php $_from = $this->_tpl_vars['reloffer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['slist']):
?>
                <td height="22">
                <img src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/offer_<?php echo $this->_tpl_vars['slist']['type']; ?>
.gif' />
                <a href="<?php echo smarty_function_geturl(array('type' => 'offer_detail','user' => $this->_tpl_vars['slist']['user'],'uid' => $this->_tpl_vars['slist']['userid'],'tid' => $this->_tpl_vars['slist']['id'],'m' => 'offer'), $this);?>
">
                <?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 200) : smarty_modifier_truncate($_tmp, 200)); ?>

                </a>
                </td>
                <?php if (( $this->_tpl_vars['num']+1 ) % 2 == 0): ?></tr><tr><?php endif; ?>
              <?php endforeach; endif; unset($_from); ?>
              </tr>
            </table>	
			</div>
			</div>
		</div>




<div class="rightbar">

 <div class="right1">
	<div class="sectitle" ><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['seller_det']; ?>
</div></div>
	 
	<div class="seccon">
<!--
	<?php if ($this->_tpl_vars['de']['view_right'] == false): ?>
		<li><?php echo $this->_tpl_vars['lang']['no_right']; ?>
</li>
	<?php else: ?>
-->
		<div>
			<b><a href="<?php echo smarty_function_geturl(array('type' => '','user' => $this->_tpl_vars['cominfo']['user'],'uid' => $this->_tpl_vars['cominfo']['userid']), $this);?>
"><?php echo $this->_tpl_vars['cominfo']['company']; ?>
</a></b>&nbsp;&nbsp;[<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?menu=user&action=m&m=friend&s=admin_friends&friendid=<?php echo $this->_tpl_vars['cominfo']['userid']; ?>
">В друзья</a>]<br />
<!--
			<?php if ($this->_tpl_vars['cominfo']['business']): ?>
				 <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/check_right.gif" /><?php echo $this->_tpl_vars['lang']['pass_th']; ?>

			 <?php else: ?>
				<img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/no_right.gif" /><?php echo $this->_tpl_vars['lang']['not_pass']; ?>

			 <?php endif; ?>
-->
		</div>

			<b><?php echo $this->_tpl_vars['lang']['user_g']; ?>
:</b> <?php echo $this->_tpl_vars['cominfo']['grouplogo']; ?>
<br />
			<b><?php echo $this->_tpl_vars['lang']['cont']; ?>
:</b><br /><?php echo $this->_tpl_vars['cominfo']['contact']; ?>
<?php if ($this->_tpl_vars['cominfo']['qq'] != ''): ?><br />
			 <a href="tencent://message/?uin=<?php echo $this->_tpl_vars['cominfo']['qq']; ?>
&Site=<?php echo $this->_tpl_vars['config']['weburl']; ?>
&Menu=yes">
			 <img align="absmiddle" border="0" src="http://wpa.qq.com/pa?p=1:<?php echo $this->_tpl_vars['cominfo']['qq']; ?>
:4" /></a>
			 <?php endif; ?>

			<?php if ($this->_tpl_vars['cominfo']['msn'] != ''): ?><br />
			<a href="msnim:chat?contact=<?php echo $this->_tpl_vars['cominfo']['msn']; ?>
">
			<img align="absmiddle" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/ico_msn.gif" width="16" height="16"/></a>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['cominfo']['skype'] != ''): ?><br />
			<a href="skype:<?php echo $this->_tpl_vars['cominfo']['skype']; ?>
?call">
			<img align="absmiddle" border="0" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/skypeonline.png"></a>
			<?php endif; ?>
			<br />
			<b><?php echo $this->_tpl_vars['lang']['tel']; ?>
:</b><br /><?php echo $this->_tpl_vars['cominfo']['tel']; ?>
<br />
			
			<?php if ($this->_tpl_vars['cominfo']['fax'] != ''): ?><b><?php echo $this->_tpl_vars['lang']['fax']; ?>
:</b><br /><?php echo $this->_tpl_vars['cominfo']['fax']; ?>
 <br /><?php else: ?><?php endif; ?>
			<?php if ($this->_tpl_vars['cominfo']['mobile'] != ''): ?><b><?php echo $this->_tpl_vars['lang']['mobile']; ?>
:</b><br /><?php echo $this->_tpl_vars['cominfo']['mobile']; ?>
 <br /><?php else: ?><?php endif; ?>
			<b><?php echo $this->_tpl_vars['lang']['pro_city']; ?>
:</b><br />
			<?php echo $this->_tpl_vars['cominfo']['province']; ?>
<br />
			<?php echo $this->_tpl_vars['cominfo']['city']; ?>
<br />
			<b><?php echo $this->_tpl_vars['lang']['addr']; ?>
:</b><br /><?php echo $this->_tpl_vars['cominfo']['addr']; ?>
<br />
	   <?php endif; ?>
   </div>
	<div class="clear"></div>
</div>
	<div class="right1 m1">
		<div class="sectitle" >
			<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['same_pro']; ?>
</div>
			<div class="more"></div>
		</div>
		 <div class="seccon" id="pro_list">
			<?php $_from = $this->_tpl_vars['sameoffer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
					
					<a href="<?php echo smarty_function_geturl(array('type' => 'offer_detail','user' => $this->_tpl_vars['list']['user'],'uid' => $this->_tpl_vars['list']['userid'],'tid' => $this->_tpl_vars['list']['id'],'m' => 'offer'), $this);?>
">
					<b><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 120, "...", true) : smarty_modifier_truncate($_tmp, 120, "...", true)); ?>
</b>
					</a> 
					<br/>
					  
					 <?php echo $this->_tpl_vars['list']['province']; ?>

					 
					 <?php if ($this->_tpl_vars['list']['city'] != ''): ?> 
					  <?php if ($this->_tpl_vars['list']['province'] != ''): ?>,<?php endif; ?> 
					  <?php echo $this->_tpl_vars['list']['city']; ?>

					  <br/>
					 <?php endif; ?> 
					 
				<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['company'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 120, "...", true) : smarty_modifier_truncate($_tmp, 120, "...", true)); ?>

				<br/>
				<?php echo $this->_tpl_vars['list']['tel']; ?>

				<div style="padding:5px;border:1px dashed #f2f2f2">&nbsp;</div>
			 <?php endforeach; endif; unset($_from); ?>
		</div>
	</div>

</div>		
<!--右边结束-->
</div>