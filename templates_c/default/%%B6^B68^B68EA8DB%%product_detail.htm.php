<?php /* Smarty version 2.6.20, created on 2013-01-17 21:54:53
         compiled from product_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'regex_replace', 'product_detail.htm', 21, false),array('modifier', 'strip_tags', 'product_detail.htm', 23, false),array('modifier', 'number_format', 'product_detail.htm', 108, false),array('modifier', 'date_format', 'product_detail.htm', 147, false),array('modifier', 'truncate', 'product_detail.htm', 283, false),array('insert', 'label', 'product_detail.htm', 81, false),array('function', 'html_image', 'product_detail.htm', 86, false),array('function', 'geturl', 'product_detail.htm', 280, false),)), $this); ?>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/<?php echo $this->_tpl_vars['config']['temp']; ?>
/pro.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.content4 li{
	height:190px;
}
</style>
<script type="text/javascript">
function getfav()
{	
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var myurl='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product%26s=product_detail%26id=<?php echo $_GET['id']; ?>
';
	var u='<?php echo $_COOKIE['USER']; ?>
';
	if(u=='')
	{
		alert('<?php echo $this->_tpl_vars['lang']['no_logo']; ?>
');
		window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward=?m=product&s=product_detail&id=<?php echo $_GET['id']; ?>
';
		return false;
	}
	var fu='<?php echo $_GET['id']; ?>
';
	var typ='3';
	var ttil="<?php echo ((is_array($_tmp=$this->_tpl_vars['prod']['pname'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", "") : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", "")); ?>
";
	var mpic='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/<?php echo $this->_tpl_vars['prod']['showimg']; ?>
.jpg';
	var des="<?php echo ((is_array($_tmp=$this->_tpl_vars['prod']['pname'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
";
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
function get_same_pro(prov)
{	
	var myurl = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var sj = new Date();
    var pars = 'sj='+sj+'&province='+prov+'&catid='+<?php echo $this->_tpl_vars['prod']['catid']; ?>
+'&gettype=sameoffer';
	var myAjax = new Ajax.Request(myurl,{method: 'post', parameters: pars, onComplete: showResponse});
	function showResponse(originalRequest)
	{
	    if(originalRequest.responseText!='')
	       $('pro_list').innerHTML=originalRequest.responseText;
	}
}
function seebig(id)
{
    $('imgmove').innerHTML='<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/'+id+'.jpg" target="_blank">'+
	'<img id="img'+id+'" border="0" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/uploadfile/zsimg/'+id+'.jpg" ></a>';
	if($('img'+id).height>$('img'+id).width)
		$('img'+id).height=280;
	else
		$('img'+id).width=280;
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
/?m=product"><?php echo $this->_tpl_vars['lang']['shop']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['guide']; ?>

    </div>
    <div class="headtop_R"></div>		
</div>

<div id="mainbody1" class="m1">
<div class="leftbar_detail">
	<div class="title4"><div class="title_left2 L2">Продробнее о продукте</div></div>
    <div class="content4" style="padding:5px 20px;">
	<div class="newstitle"><?php echo $this->_tpl_vars['prod']['pname']; ?>
</div> 
    <div class="newstime">
    [<?php echo $this->_tpl_vars['lang']['read_num']; ?>
: <?php echo $this->_tpl_vars['prod']['read_nums']; ?>
 <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'statics', 'temp' => 'statics_default', 'ctype' => 3, 'id' => $this->_tpl_vars['prod']['id'])), $this); ?>
]
    </div>
			<div class="propic">
			    <div id="imgmove" class="imgmove">       						 
                     <?php $this->assign('img', $this->_tpl_vars['prod']['id']); ?>
                     <?php echo smarty_function_html_image(array('file' => "uploadfile/comimg/big/".($this->_tpl_vars['img']).".jpg",'width' => 280,'alt' => $this->_tpl_vars['list']['pname']), $this);?>

				 </div>
                 
				 <div id="infopic" class="small_pic">
				  <?php $_from = $this->_tpl_vars['prod']['pic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
                <div style="padding:8px;overflow:hidden;">
                    <a href="javascript:alertWin('<?php echo $this->_tpl_vars['lang']['share']; ?>
','<br><span style=width:80px;><?php echo $this->_tpl_vars['lang']['purl']; ?>
</span><input id=textfield type=text size=45 value=<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['prod']['id']; ?>
>
                    <div style=width:340px;padding-left:60px;text-align:left;><br><button onclick=copyToClipboard(\'<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=product_detail&id=<?php echo $this->_tpl_vars['prod']['id']; ?>
\')><?php echo $this->_tpl_vars['lang']['copysend']; ?>
</button></div>',400,120,'');"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/add_to_share.png" /></a>
                    <a href="javascript:getfav();"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/add_to_fav.png" /></a>
                </div>
			</div>
			<div class="proinfo">
            <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
" method="get">
			<table width="330" border="0">
				<?php if ($this->_tpl_vars['prod']['price'] > 0): ?>
            	<tr>
					 <td class="pro_text"><?php echo $this->_tpl_vars['lang']['price']; ?>
</td>
					 <td class="pro_text"> <span style="color:#FF5500; font-size:24px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['prod']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</span> <?php echo $this->_tpl_vars['config']['money']; ?>
/<?php echo $this->_tpl_vars['prod']['unit']; ?>
</td>
				 </tr>
				 <?php endif; ?>
                 <tr>
					<td width="120" class="pro_text"><?php echo $this->_tpl_vars['lang']['freight']; ?>
</td>
					<td width="250" class="pro_text">
                    <?php if ($this->_tpl_vars['prod']['freight_type'] == 1): ?>
                    	<?php echo $this->_tpl_vars['lang']['sell_freight']; ?>

                    <?php else: ?>
                    	<?php echo $this->_tpl_vars['lang']['sent_by_post']; ?>
<?php echo $this->_tpl_vars['prod']['freight']['0']; ?>
 <?php echo $this->_tpl_vars['lang']['exp']; ?>
<?php echo $this->_tpl_vars['prod']['freight']['1']; ?>
 <?php echo $this->_tpl_vars['lang']['ems']; ?>
<?php echo $this->_tpl_vars['prod']['freight']['2']; ?>

                    <?php endif; ?>
                    </td>
				 </tr>
                <tr>
					<td width="120" class="pro_text"><?php echo $this->_tpl_vars['lang']['have_sell']; ?>
</td>
					<td width="250" class="pro_text"><?php echo $this->_tpl_vars['prod']['sell_amount']; ?>
 <?php echo $this->_tpl_vars['prod']['unit']; ?>
</td>
				 </tr>
				 <tr>
					<td width="120" class="pro_text"><?php echo $this->_tpl_vars['lang']['brand']; ?>
</td>
					<td width="250" class="pro_text"><?php echo $this->_tpl_vars['prod']['pp']; ?>
</td>
				 </tr>
				 <tr>
					<td class="pro_text"><?php echo $this->_tpl_vars['lang']['pard']; ?>
</td>
					<td class="pro_text"><?php echo $this->_tpl_vars['prod']['gg']; ?>
</td>
				 </tr>
				 <tr>
					<td class="pro_text"><?php echo $this->_tpl_vars['lang']['model']; ?>
</td>
					<td class="pro_text"><?php echo $this->_tpl_vars['prod']['model']; ?>
</td>
				 </tr>
                 <tr>
					 <td class="pro_text"><?php echo $this->_tpl_vars['lang']['ptype']; ?>
</td>
					 <td class="pro_text"><?php echo $this->_tpl_vars['prod']['ptype']; ?>
</td>
				 </tr>
                 <tr>
					 <td class="pro_text"><?php echo $this->_tpl_vars['lang']['pro_city']; ?>
</td>
					 <td class="pro_text"><?php echo $this->_tpl_vars['prod']['province']; ?>
 <?php echo $this->_tpl_vars['prod']['city']; ?>
</td>
				 </tr>
                 <tr>
					 <td class="pro_text"><?php echo $this->_tpl_vars['lang']['ptime']; ?>
</td>
					 <td class="pro_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['prod']['uptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
				 </tr>
				<tr>
				 <td class="pro_text"><?php echo $this->_tpl_vars['lang']['trd_type']; ?>
</td>
				 <td class="pro_text"><?php echo $this->_tpl_vars['prod']['trade_type']; ?>
</td>
				 </tr>
                 <tr><td colspan="2"><br />
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
<!-- AddThis Button END --><br />
				 </td></tr>
				 <tr>
				 <td colspan="2">
                <?php if ($this->_tpl_vars['isbuy'] == 0 && $this->_tpl_vars['prod']['price']*1>0 && $this->_tpl_vars['prod']['have_time'] > 0): ?>
                 <div style="background-color:#FFF3D9; border:1px solid #FEE2A1; padding:5px; line-height:25px;">
					 <?php if ($this->_tpl_vars['prod']['have_time'] != 6): ?>
					 <?php echo $this->_tpl_vars['lang']['time_left']; ?>
: <span id="endtime"><?php echo $this->_tpl_vars['prod']['have_time']; ?>
</span><br />
					 <?php endif; ?>
                 <?php echo $this->_tpl_vars['lang']['nums']; ?>

                 <input onkeyup="check_nums();" size="5" name="nums" id="nums" type="text" value="1" /> <?php echo $this->_tpl_vars['prod']['unit']; ?>
(<?php echo $this->_tpl_vars['lang']['stock']; ?>
<?php echo $this->_tpl_vars['prod']['amount']; ?>
<?php echo $this->_tpl_vars['prod']['unit']; ?>
)
                 <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['prod']['id']; ?>
" />
				 <input name="m" type="hidden" value="product" />
				 <input name="s" type="hidden" value="order" />
                 <br />

                 <input type="image" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/buy.gif" />
                 <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['prod']['userid']; ?>
&action=mail&tid=<?php echo $this->_tpl_vars['prod']['id']; ?>
&contype=1&title=<?php echo $this->_tpl_vars['prod']['pname']; ?>
">
                 <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/sendmail.gif" />
                 </a>
                 </div>
				<script>
				var CID = "endtime";
				if(window.CID != null)
				{
					var iTime = document.getElementById(CID).innerHTML;
					var Account;
					RemainTime();
				}
				function RemainTime()
				{
					var iDay,iHour,iMinute,iSecond;
					var sDay="",sHour="",sMinute="",sSecond="",sTime="";
					if (iTime >= 0)
					{
						iDay = parseInt(iTime/24/3600);
						if (iDay > 0)
							sDay = iDay + "<?php echo $this->_tpl_vars['lang']['day']; ?>
";
						iHour = parseInt((iTime/3600)%24);
						if (iHour > 0)
							sHour = iHour + "<?php echo $this->_tpl_vars['lang']['hour']; ?>
";
						iMinute = parseInt((iTime/60)%60);
						if (iMinute > 0)
							sMinute = iMinute + "<?php echo $this->_tpl_vars['lang']['minute']; ?>
";
						iSecond = parseInt(iTime%60);
						if (iSecond >= 0)
							sSecond = iSecond + "<?php echo $this->_tpl_vars['lang']['second']; ?>
";
						
						if ((sDay=="")&&(sHour==""))
							sTime="<span style='color:darkorange'>" + sMinute+sSecond + "</font>";
						else
							sTime=sDay+sHour+sMinute+sSecond;
						if(iTime==0)
						{
							clearTimeout(Account);
							sTime="<span style='color:green'><?php echo $this->_tpl_vars['lang']['timeisend']; ?>
</span>";
						}
						else
							Account = setTimeout("RemainTime()",1000);
						iTime=iTime-1;
					}
					else
						sTime="<span style='color:red'><?php echo $this->_tpl_vars['lang']['countdownisend']; ?>
</span>";
					document.getElementById(CID).innerHTML = sTime;
				}
				 function check_nums()
				 {
				 	var v=$('nums').value*1;
				 	if(!v)
						$('nums').value=1;
					if(v><?php echo $this->_tpl_vars['prod']['amount']; ?>
*1)
					{
						$('nums').value=<?php echo $this->_tpl_vars['prod']['amount']; ?>
*1;
						return false;
					}
				 }
				 </script>
                 <?php else: ?>
                 <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['prod']['userid']; ?>
&action=mail&tid=<?php echo $this->_tpl_vars['prod']['id']; ?>
&contype=1&title=<?php echo $this->_tpl_vars['prod']['pname']; ?>
">
                 <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/<?php echo $this->_tpl_vars['config']['temp']; ?>
/sendmail.gif" />
                 </a>
                 <?php endif; ?>
                 </td>
				 </tr>
			</table>
            </form>
			</div>
            <div class="clear"></div>
 			<div class="prodetail" id="productdetail">
            <div class="pro_int"><?php echo $this->_tpl_vars['lang']['pro_det']; ?>
</div>
				<script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=12&catid=<?php echo $_GET['id']; ?>
&sname=<?php echo $this->_tpl_vars['sname']; ?>
'></script>
                <?php if ($this->_tpl_vars['addfieldlist']): ?>
                     <?php $_from = $this->_tpl_vars['addfieldlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fieldlist']):
?>
                        <div>
                        <span class="pro_text" style="width:100px;"><?php echo $this->_tpl_vars['fieldlist']['catInfo']; ?>
:</span> 
                        <?php echo $this->_tpl_vars['fieldlist']['fieldvalue']; ?>

                        </div> 
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
                <?php echo $this->_tpl_vars['prod']['detail']; ?>
  
			</div>
			<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'comment', 'ctype' => 3, 'cid' => $_GET['id'], 'temp' => 'comment_default')), $this); ?>

            </div>
            <div class="bottom4"></div>
			
			<div class="m1">
				<div class="title4">
					<h2><?php echo $this->_tpl_vars['lang']['com_newpro']; ?>
</h2>
                    <span class="titlemore" style="padding-left:20px;">
                    	[<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['prod']['userid']; ?>
&action=prolist"><?php echo $this->_tpl_vars['lang']['more']; ?>
</a>]
                    </span>
				</div>
				<div class="samepro content4">
                	<ul>
					<?php $_from = $this->_tpl_vars['relpro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
					<li>
					<a href="<?php echo smarty_function_geturl(array('type' => 'prod','user' => $this->_tpl_vars['slist']['user'],'uid' => $this->_tpl_vars['slist']['userid'],'tid' => $this->_tpl_vars['slist']['id']), $this);?>
">
					<?php $this->assign('img', $this->_tpl_vars['slist']['id']); ?>
					<?php echo smarty_function_html_image(array('file' => "uploadfile/comimg/big/".($this->_tpl_vars['img']).".jpg",'width' => 115,'alt' => $this->_tpl_vars['list']['pname']), $this);?>
<br />
					<?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['pname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 120) : smarty_modifier_truncate($_tmp, 120)); ?>
<span class="bmoney"><br />
					 <?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
 <?php echo $this->_tpl_vars['config']['money']; ?>
</span>
					</a>
					</li>
					<?php endforeach; endif; unset($_from); ?>
                    </ul>
                    <div class="clear"></div>
				</div>
			</div>
</div>
<!--Правая колонка-->	

<div class="rightbar">
	 <div class="right1">
		<div class="sectitle" ><div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['seller_det']; ?>
</div></div>
		 
		<div class="seccon">
		<div>
			<b><a href="<?php echo smarty_function_geturl(array('type' => '','user' => $this->_tpl_vars['cominfo']['user'],'uid' => $this->_tpl_vars['cominfo']['userid']), $this);?>
"><?php echo $this->_tpl_vars['cominfo']['company']; ?>
</a></b>&nbsp;&nbsp;[<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?menu=user&action=m&m=friend&s=admin_friends&friendid=<?php echo $this->_tpl_vars['cominfo']['userid']; ?>
">В друзья</a>]<br />
			<?php if ($this->_tpl_vars['cominfo']['business']): ?>
				 <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/check_right.gif" /> <?php echo $this->_tpl_vars['lang']['pass_th']; ?>

			 <?php else: ?>
				<img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/no_right.gif" /> <?php echo $this->_tpl_vars['lang']['not_pass']; ?>

			 <?php endif; ?>
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
	   
   </div>
		
		<div class="bottom5"></div>
		<div class="clear"></div>
	</div>
	
	

		
		
		
	<div class="right1 m1">
		<div class="sectitle" >
			<div class="title_left1 L2"><?php echo $this->_tpl_vars['lang']['same_pro']; ?>
</div>
			<div class="more" style="margin-top:3px;padding-top:10px;padding-bottom:10px;"></div>
		</div>
		 <div class="seccon" id="pro_list">
			<?php $_from = $this->_tpl_vars['samepro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
					
					<a href="<?php echo smarty_function_geturl(array('type' => 'offer_detail','user' => $this->_tpl_vars['list']['user'],'uid' => $this->_tpl_vars['list']['userid'],'tid' => $this->_tpl_vars['list']['id'],'m' => 'offer'), $this);?>
">
					<b><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['pname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 120, "...", true) : smarty_modifier_truncate($_tmp, 120, "...", true)); ?>
</b>
					</a> [<?php echo $this->_tpl_vars['list']['province']; ?>
]
				<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['company'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 120, "...", true) : smarty_modifier_truncate($_tmp, 120, "...", true)); ?>
 | <?php echo $this->_tpl_vars['list']['tel']; ?>

				<div style="padding:5px;border:1px dashed #f2f2f2"><span class="more" style="margin-top:3px;padding-top:10px;padding-bottom:10px;">
				  <select onchange="get_same_pro(this.value)" name="province" style="font-size:12px; width:100%;">
				    <option value="0" style="font-size:12px;"><?php echo $this->_tpl_vars['lang']['allcity']; ?>
</option>
				    <?php echo $this->_tpl_vars['province']; ?>

			    </select>
			  </span>&nbsp;</div>
			 <?php endforeach; endif; unset($_from); ?>
		</div>
	</div>
		

</div>		
<!--右边结束-->
</div>