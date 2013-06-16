<?php /* Smarty version 2.6.20, created on 2013-01-13 16:41:41
         compiled from admin_demand.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'admin_demand.htm', 45, false),array('modifier', 'date_format', 'admin_demand.htm', 347, false),)), $this); ?>
<script src="script/my_lightbox.js" language="javascript"></script>
<script language="javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/Calendar.js"></script>
<script language="javascript">
	var cdr = new Calendar("cdr");
	document.write(cdr);
	cdr.showMoreDay = true;
</script>
<?php if ($this->_tpl_vars['add_attach'] == 1): ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/lib/upload/swfupload/swfupload.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/lib/upload/js/demand_handlers.js"></script>
<script type="text/javascript">
var swfu;	
window.onload = function (){
	swfu = new SWFUpload({
		//Backend Settings
		upload_url: "<?php echo $this->_tpl_vars['config']['weburl']; ?>
/lib/upload/upload.php",
		post_params: {"PHPSESSID": "<?php echo '<?php'; ?>
 echo session_id(); <?php echo '?>'; ?>
",'save_dir':'<?php echo $this->_tpl_vars['upload']['temp_dir']; ?>
','theight':<?php echo $this->_tpl_vars['upload']['theight']; ?>
,'twidth':<?php echo $this->_tpl_vars['upload']['twidth']; ?>
,'file_type':'<?php echo $this->_tpl_vars['upload']['file_type_param']; ?>
'},
		// File Upload Settings
		file_size_limit : "<?php echo $this->_tpl_vars['upload']['size_limit']; ?>
",	//like 2MB
		file_types : "<?php echo $this->_tpl_vars['upload']['file_type']; ?>
",
		file_types_description : "File",
		file_upload_limit : "0",
		file_post_name:'upload_file',
		
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,

		// Button Settings
		button_image_url : "<?php echo $this->_tpl_vars['config']['weburl']; ?>
/lib/upload/images/SmallSpyGlassWithTransperancy_17x18.png",
		button_placeholder_id : "spanButtonPlaceholder",
		button_width: 180,
		button_height: 18,
		button_text : '<span class="button">选择文件<span class="buttonSmall">(2 MB Max)</span></span>',
		button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
		button_text_top_padding: 0,
		button_text_left_padding: 18,
		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,
		<?php if ($this->_tpl_vars['attach'] && count($this->_tpl_vars['attach']) == 3): ?>
		button_disabled:true,
		<?php endif; ?>
		// Flash Settings
		flash_url : "<?php echo $this->_tpl_vars['config']['weburl']; ?>
/lib/upload/swfupload/swfupload.swf",

		custom_settings : {
			upload_target : "divFileProgressContainer"
		},
		
		// Debug Settings
		debug:false
	});
initAttachList();
<?php if (! $this->_tpl_vars['de']): ?>
	$('sscatid').value = '';
	$('scatid').value = '';	
	$('tcatid').value = '';
	$('catid').value = '';
<?php endif; ?>
};
function initAttachList()
{
<?php if ($this->_tpl_vars['attach']): ?>
<?php $_from = $this->_tpl_vars['attach']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
	initEditImg("<?php echo $this->_tpl_vars['list']['thumb_img']; ?>
",<?php echo $this->_tpl_vars['list']['id']; ?>
,'<?php echo $this->_tpl_vars['list']['downname']; ?>
.<?php echo $this->_tpl_vars['list']['pic']; ?>
');
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
	return;
}
</script>
<?php elseif (! $this->_tpl_vars['de']): ?>
<script language="javascript">
	$('sscatid').value = '';
	$('scatid').value = '';	
	$('tcatid').value = '';
	$('catid').value = '';
</script>
<?php endif; ?>
<script>
function toggAddPro()
{
	if($('add_pro_online').checked==true){
		$('add_pro_tb').style.display='';
	}else{
		$('add_pro_tb').style.display='none';
	}
}
</script>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/lib/upload/css/default.css" rel="stylesheet">
<style>
#pic_view{width:100%}
#pic_view li{ float:left; width:55px;}
.admin_table{line-height:20px;}
.add_pro
{
	background:url(../../../../image/default/adding.gif) left center no-repeat;
	padding-left:15px;
	font-size:13px;
}
.dele_pro
{
	background:url(../../../../image/default/decrease.gif) left center no-repeat;
	padding-left:15px;
	font-size:13px;
}
ul,li{
	list-style-type:none;
	list-style:none;
}
#thumbnails ul{
	border-top:1px dashed #DDDDDD;
    padding: 10px;
	padding-bottom:20px;
	overflow:hidden;
}
#thumbnails li{
	width:72px;
	height:100px;
	margin-left:15px;
	text-align:center;
	float:left;
}
#thumbnails li .complete_statu{
	border:#DDDDDD solid 1px;
	width:70px;
	display:block;
	height:70px;
}
#thumbnails li h4{
	padding:0;
	margin:0;
	display:inline-block;
	overflow:visible;
	font-size:11px;
	word-wrap: break-word;
	word-break:break-all;
	line-height:14px;
}
#thumbnails li .complete_statu img{
	width:68px;
	height:68px;
	vertical-align:middle;
	margin:0 auto;
}
</style>
<form method="post" action="" enctype="multipart/form-data">
<div class="admin_right_top"><?php echo $this->_tpl_vars['lang']['product_releases']; ?>
</div>
<table width="100%" border="0" align="center" cellpadding="6" cellspacing="1" bgcolor="#dddddd" class="admin_table">
       <tr>
          <td width="16%" align="left" bgcolor="#EAEFF3"> <?php echo $this->_tpl_vars['lang']['type']; ?>
<a href="#" title="выберите тип продукта: товар или услугу (работу)"><img src="../image/admin/Help Circle.jpg" border="0" ></a></td>
          <td width="84%" bgcolor="#FFFFFF" style="font-weight:normal">
		   <?php $_from = $this->_tpl_vars['infoType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
		   <?php if ($this->_tpl_vars['num'] > 0): ?>
           <input style="border:none; width:20px;" type="radio" <?php if ($this->_tpl_vars['de']['type'] != '0'): ?>onclick="toggAddPro()"<?php endif; ?> name="type" value="<?php echo $this->_tpl_vars['num']; ?>
"
		   <?php if ($this->_tpl_vars['de']['type'] == $this->_tpl_vars['num'] || $this->_tpl_vars['num'] == 1): ?>checked="checked"<?php endif; ?> /><?php echo $this->_tpl_vars['list']; ?>

			<?php endif; ?>
		   <?php endforeach; endif; unset($_from); ?><?php if (! $this->_tpl_vars['de'] && 1 == 2): ?><label><input onclick="toggAddPro()" type="radio" id="add_pro_online"  name="type" value="0" />Онлайн продажа</label><?php endif; ?>
           </td>
        </tr><tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['titles']; ?>
<font color="red"> *</font> <a href="#" title="примеры объявлений: Закупаем березовый пиловочник; Купим козловой кран; Покупаем крупно-рогатый скот у фермеров Псковской области; Требуются услуги по обработке овощей в Ленинградской области; Требуются аудиторские услуги в г. Владивосток; Требуются строительные услуги в г. Калининград"><img src="../image/admin/Help Circle.jpg" border="0" ></a> </td>
              <td bgcolor="#FFFFFF">
			  <input maxlength="100" name="title" type="text" id="title" style="width:420px;" value="<?php echo $this->_tpl_vars['de']['title']; ?>
" /></td>
            </tr>
                         <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['key_words']; ?>
<a href="#" title="это слова по которым потенциальный клиент будет находить именно вас"><img src="../image/admin/Help Circle.jpg" border="0" ></a></td>
              <td bgcolor="#FFFFFF">
			  <input name="keyword" id="key_word" type="text" value="<?php echo $this->_tpl_vars['de']['keyword']; ?>
" style="width:420px;" /><br>
			  <?php echo $this->_tpl_vars['lang']['key_des']; ?>

              </td>
            </tr>
            <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['category']; ?>
<font color="red"> *</font> </td>
              <td bgcolor="#FFFFFF">
              <span id="cate_show"><?php echo $this->_tpl_vars['typenames']; ?>
</span>&nbsp;
              <input type="button" onclick="showCategory();" value="<?php echo $this->_tpl_vars['lang']['select_business_category']; ?>
">
              <input name="catid" id="catid" type="hidden" value="<?php echo $this->_tpl_vars['de']['catid']; ?>
" />
              <input name="tcatid" id="tcatid" type="hidden" value="<?php echo $this->_tpl_vars['de']['tcatid']; ?>
" />
              <input name="scatid" id="scatid" type="hidden" value="<?php echo $this->_tpl_vars['de']['scatid']; ?>
" />
              <input name="sscatid" id="sscatid" type="hidden" value="<?php echo $this->_tpl_vars['de']['sscatid']; ?>
" />
              </td>
            </tr>
                    <tr>
			  <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['cus_cat']; ?>
<a href="#" title="это ваши внутренние категории для более удобного структурирования ваших товаров и услуг"><img src="../image/admin/Help Circle.jpg" border="0" ></a></td>
			  <td bgcolor="#FFFFFF">
              <select name="custom_cat" style="width:400px">
                <option value=""><?php echo $this->_tpl_vars['lang']['no_cat']; ?>
</option>
              <?php $_from = $this->_tpl_vars['custom_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
              	<?php if ($this->_tpl_vars['de']['custom_cat_id'] == $this->_tpl_vars['list']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
<option <?php if ($this->_tpl_vars['de']['custom_cat_id'] == $this->_tpl_vars['list']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
              </select>
              [<a target="_blank" href="main.php?action=m&m=product&s=admin_product_cat&menu=info"><?php echo $this->_tpl_vars['lang']['mag_cat']; ?>
</a>]              </td>
    		</tr>
        <tr>
          <td align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['price']; ?>
 (<?php echo $this->_tpl_vars['config']['money']; ?>
)</td>
          <td bgcolor="#FFFFFF" style="font-weight:normal">
           <input type="text" name="price" id="price" style="width:130px;" value="<?php echo $this->_tpl_vars['de']['price']; ?>
" /> /
           <select name="unit" <?php if (! $this->_tpl_vars['de']): ?>onchange="$('pro_unit_des').innerHTML='('+this.value+')'"<?php endif; ?>>
               <?php $_from = $this->_tpl_vars['unit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
               <option <?php if ($this->_tpl_vars['list'] == $this->_tpl_vars['de']['priceDes']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['list']; ?>
</option>
               <?php endforeach; endif; unset($_from); ?>
               </select>         
           </td>
        </tr>
         <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['specifications']; ?>
</td>
              <td bgcolor="#FFFFFF">
			  <input  type="text" id="gg" name="gg" style="width:170px;" value="<?php echo $this->_tpl_vars['de']['gg']; ?>
" /></td>
            </tr>
			<tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['model']; ?>
</td>
              <td bgcolor="#FFFFFF">
			  <input  type="text" id="model" name="model" style="width:170px;" value="<?php echo $this->_tpl_vars['de']['model']; ?>
" /></td>
            </tr>
            <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['brand']; ?>
</td>
              <td bgcolor="#FFFFFF">
              	<span id="brand"><?php if ($this->_tpl_vars['brand'] == ''): ?><input type="text" value="<?php echo $this->_tpl_vars['de']['pp']; ?>
" style="width:170px;" name="pinpai" maxlength="20"><?php else: ?><?php echo $this->_tpl_vars['brand']; ?>
<?php endif; ?></span>
              </td>
            </tr>
			<tr>
            <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['summary']; ?>
<font color="red"> *</font> </td>
            <td bgcolor="#FFFFFF">
            <textarea maxlength="100" style="width:100%; height:40px;" name="con" id="con"><?php echo $this->_tpl_vars['de']['con']; ?>
</textarea>
            </td>
          </tr>           
            <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['introduction']; ?>
<font color="red"> *</font> </td>
              <td bgcolor="#FFFFFF">
			<?php if ($this->_tpl_vars['de']['detail']): ?>
			<?php echo $this->_tpl_vars['de']['detail']; ?>

			<?php else: ?>
			<script type="text/javascript" src="lib/fckeditor/fckeditor.js"></script>
			<script type="text/javascript">
			var oFCKeditor = new FCKeditor( 'detail' ) ;
			oFCKeditor.Config['ToolbarStartExpanded'] = true ;
			<?php if ($this->_tpl_vars['config']['language'] == 'en'): ?>
				oFCKeditor.Config['DefaultLanguage']='en';
			<?php else: ?>
				oFCKeditor.Config['DefaultLanguage']='zh-cn';
			<?php endif; ?>
			oFCKeditor.BasePath		= 'lib/fckeditor/' ;
			oFCKeditor.ToolbarSet	= 'frant' ;
			oFCKeditor.Width='100%';
			oFCKeditor.Height=400;
			oFCKeditor.Create() ;
			</script>
            <?php endif; ?>
            </td>
            </tr>
            <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['validTime']; ?>
</td>
              <td bgcolor="#FFFFFF" >
              <?php $_from = $this->_tpl_vars['validTime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
			  <input name="validTime" type="radio" value="<?php echo $this->_tpl_vars['num']; ?>
" <?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['de']['valid_time']): ?>checked="checked"<?php endif; ?> />
              <?php echo $this->_tpl_vars['list']; ?>
 
              <?php endforeach; endif; unset($_from); ?>
              </td>
            </tr>
			<tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['picture']; ?>
<font color="red"> *</font> </td>
              <td bgcolor="#FFFFFF">
            <div id="pic_view"></div>
			<div id="overlay"></div>
            <input type="button"  value="<?php echo $this->_tpl_vars['lang']['add_pic']; ?>
" onclick="alertWin('<?php echo $this->_tpl_vars['lang']['add_pic']; ?>
','',550,430,'');" />
            <input name="pic" id="pic" type="hidden" value="" />
            </td>
            </tr>
            <?php if ($this->_tpl_vars['add_attach'] == 1): ?>
            <tr>
                <td bgcolor="#EAEFF3">Загрузка вложений</td>
                <td bgcolor="#FFFFFF">

            <div style="border:solid 1px #7FAAFF; background-color: #C5D9FF; padding:2px; display:inline-block;*display:inline;*margin-top:5px;">
                    <span disabled="disabled" id="spanButtonPlaceholder"></span>
                </div>
            <b id="divFileProgressContainer"></b>
            <div id="thumbnails">
            	<ul>
                	<?php unset($this->_sections['li']);
$this->_sections['li']['name'] = 'li';
$this->_sections['li']['loop'] = is_array($_loop=$this->_tpl_vars['upload']['upload_limit']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['li']['show'] = true;
$this->_sections['li']['max'] = $this->_sections['li']['loop'];
$this->_sections['li']['step'] = 1;
$this->_sections['li']['start'] = $this->_sections['li']['step'] > 0 ? 0 : $this->_sections['li']['loop']-1;
if ($this->_sections['li']['show']) {
    $this->_sections['li']['total'] = $this->_sections['li']['loop'];
    if ($this->_sections['li']['total'] == 0)
        $this->_sections['li']['show'] = false;
} else
    $this->_sections['li']['total'] = 0;
if ($this->_sections['li']['show']):

            for ($this->_sections['li']['index'] = $this->_sections['li']['start'], $this->_sections['li']['iteration'] = 1;
                 $this->_sections['li']['iteration'] <= $this->_sections['li']['total'];
                 $this->_sections['li']['index'] += $this->_sections['li']['step'], $this->_sections['li']['iteration']++):
$this->_sections['li']['rownum'] = $this->_sections['li']['iteration'];
$this->_sections['li']['index_prev'] = $this->_sections['li']['index'] - $this->_sections['li']['step'];
$this->_sections['li']['index_next'] = $this->_sections['li']['index'] + $this->_sections['li']['step'];
$this->_sections['li']['first']      = ($this->_sections['li']['iteration'] == 1);
$this->_sections['li']['last']       = ($this->_sections['li']['iteration'] == $this->_sections['li']['total']);
?>
                	<li uploadstatu='0'>
                    	<div class="complete_statu"></div>
                        <h4></h4>
                    </li>
                	<?php endfor; endif; ?>
                </ul>
            </div>

                </td>
            </tr>
            <?php endif; ?>
            <?php if (! $this->_tpl_vars['de']): ?>
            <tr id="add_pro_tb" style="display:none">
            	<td colspan="2" style="padding:0" bgcolor="#FFFFFF">
            		<table cellspacing="1" cellpadding="6" bgcolor="#DDDDDD" style="width:100%;margin:0; display:table-block" border="0">
            <tr id="fv_list" style="display:<?php if ($this->_tpl_vars['firstvalue']['0'] != ''): ?>table-block<?php else: ?>none<?php endif; ?>;">
              <td  colspan="2" class="smalltitle"><?php echo $this->_tpl_vars['lang']['pro_property']; ?>
</td>
            </tr>
            <tr>
              <td id="fv_box" bgcolor="#FFFFFF" colspan="2" style="padding:0">
               <table width="100%" cellspacing="1" cellpadding="6" bgcolor="#DDDDDD" >
                    <?php $_from = $this->_tpl_vars['firstvalue']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                        <?php echo $this->_tpl_vars['list']; ?>

                    <?php endforeach; endif; unset($_from); ?>
               </table>
               </td>
            </tr>
           <tr>
              <td colspan="2" class="smalltitle"><?php echo $this->_tpl_vars['lang']['o_freight']; ?>
</td>
            </tr>
           <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['addr']; ?>
</td>
              <td bgcolor="#FFFFFF"  width="84%">
            <select  name="province" id="province" onChange="getHTML(this.value)" style="width:150px;" />
            <option value=""><?php echo $this->_tpl_vars['lang']['prov']; ?>
</option>
            <?php echo $this->_tpl_vars['prov']; ?>

            </select>
            <select name="city" id="city" style="width:150px;" />
            <option value=""><?php echo $this->_tpl_vars['lang']['city']; ?>
</option>
            </select>
             </td>
    </tr>
              <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['ship']; ?>
</td>
              <td bgcolor="#FFFFFF">
			 <input onclick="$('wl').style.display='none'" checked="checked" name="freight_type" type="radio" value="1" /><?php echo $this->_tpl_vars['lang']['sell_ship']; ?>
<br />
             <input onclick="$('wl').style.display='block'" <?php if ($this->_tpl_vars['de']['freight_type'] == 2): ?>checked="checked"<?php endif; ?> name="freight_type" type="radio" value="2" /><?php echo $this->_tpl_vars['lang']['buy_ship']; ?>

              <div id="wl" style="background:#F8F8F8; padding:20px; display:none;<?php if ($this->_tpl_vars['de']['freight_type'] == 2): ?>display:block;<?php endif; ?>">
                  <?php echo $this->_tpl_vars['lang']['postal_delivery']; ?>
<input style="width:30px;" value="<?php echo $this->_tpl_vars['de']['freight']['0']; ?>
" name="freight[]" type="text" /> 
                  <?php echo $this->_tpl_vars['lang']['express']; ?>
<input style="width:30px;" value="<?php echo $this->_tpl_vars['de']['freight']['1']; ?>
" name="freight[]" type="text" />　
                  <?php echo $this->_tpl_vars['lang']['ems']; ?>
<input style="width:30px;" value="<?php echo $this->_tpl_vars['de']['freight']['2']; ?>
" name="freight[]" type="text" />
              </div>
               </td>
            </tr>
            <tr>
              <td colspan="2" class="smalltitle"><?php echo $this->_tpl_vars['lang']['o_other_info']; ?>
</td>
            </tr>
            <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['stime']; ?>
</td>
              <td bgcolor="#FFFFFF" >
              <input checked="checked" name="stime_type" type="radio" value="1" /><?php echo $this->_tpl_vars['lang']['now']; ?>
<br />
              <input <?php if ($this->_tpl_vars['de']['stime_type'] == 2): ?>checked="checked"<?php endif; ?> name="stime_type" type="radio" value="2" /><?php echo $this->_tpl_vars['lang']['set_time']; ?>
 
              <input value="<?php echo ((is_array($_tmp=$this->_tpl_vars['de']['stime'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
" onFocus="cdr.show(this);" readonly="readonly" name="stime" type="text" /><br />
              <input <?php if ($this->_tpl_vars['de']['stime_type'] == 3): ?>checked="checked"<?php endif; ?> name="stime_type" type="radio" value="3" /><?php echo $this->_tpl_vars['lang']['add_lib']; ?>

              </td>
            </tr>
            <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['amount']; ?>
</td>
              <td bgcolor="#FFFFFF" >
			   <input maxlength="7" name="amount" type="text" style="width:170px;" value="<?php echo $this->_tpl_vars['de']['amount']; ?>
"/><label id="pro_unit_des"></label>
              </td>
            </tr>
            <tr>
			  <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['protypes']; ?>
<font color="red"> *</font></td>
			  <td bgcolor="#FFFFFF">
			<select name="trade_type" id="trade_type">
				<?php $_from = $this->_tpl_vars['trade_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['prot']):
?>
					<?php if ($this->_tpl_vars['num'] > 0): ?>
					 <?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['de']['trade_type']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['prot']; ?>
<option value="<?php echo $this->_tpl_vars['num']; ?>
" <?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['de']['trade_type']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['prot']; ?>
</option>
					 <?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>  
			</select>
            </td>
			</tr><tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['ptype']; ?>
<font color="red"> *</font> </td>
              <td bgcolor="#FFFFFF">
              <?php $_from = $this->_tpl_vars['ptype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
              	<input name="ptype" type="radio" value="<?php echo $this->_tpl_vars['num']; ?>
" <?php if ($this->_tpl_vars['num'] == $this->_tpl_vars['de']['ptype']): ?>checked="checked"<?php endif; ?> /><?php echo $this->_tpl_vars['list']; ?>

              <?php endforeach; endif; unset($_from); ?>
              </td>
    </tr>
            <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['invoice']; ?>
</td>
              <td bgcolor="#FFFFFF">
			   <input name="invoice" type="radio" value="1" checked="checked" /><?php echo $this->_tpl_vars['lang']['no']; ?>

               <input name="invoice" type="radio" value="2" <?php if ($this->_tpl_vars['de']['invoice'] == 2): ?>checked="checked"<?php endif; ?> /><?php echo $this->_tpl_vars['lang']['have']; ?>

              </td>
            </tr>
           <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['maintenance']; ?>
</td>
              <td bgcolor="#FFFFFF">
			   <input name="maintenance" type="radio" value="1" checked="checked" /><?php echo $this->_tpl_vars['lang']['no']; ?>

               <input name="maintenance" type="radio" value="2" <?php if ($this->_tpl_vars['de']['maintenance'] == 2): ?>checked="checked"<?php endif; ?> /><?php echo $this->_tpl_vars['lang']['have']; ?>

             </td>
    </tr>
            <tr>
              <td bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['rec_pro']; ?>
</td>
              <td bgcolor="#FFFFFF"><input <?php if ($this->_tpl_vars['de']['rec_pro']): ?>checked="checked"<?php endif; ?> name="rec_pro" type="checkbox" value="1" /></td>
            </tr>	
                	</table>
            	</td>
            </tr>
            <?php endif; ?>
            <tr>
              <td bgcolor="#EAEFF3">&nbsp;</td>
              <td bgcolor="#FFFFFF">
			  <input type="submit" value="<?php echo $this->_tpl_vars['lang']['submit']; ?>
" style="width:100px;" onClick="return check_value();"/>
			  <input name="submit" type="hidden" id="submit" value="<?php if ($this->_tpl_vars['de']['id']): ?>edit<?php else: ?>submit<?php endif; ?>" />
			  <input name="editID" type="hidden" id="editID" value="<?php echo $this->_tpl_vars['de']['id']; ?>
" />
              </td>
            </tr>			
</table>
</form>
<script>
function showCategory()
{
	var key= $('key_word').value;
	alertWin('<?php echo $this->_tpl_vars['lang']['product_category']; ?>
','',580,480,'<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?action=m&m=product&s=admin_product&step=1&key_word='+key);
}
function setCategory(catid)
{
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?action=m&m=product&s=admin_product&oper=ajax&call=get_cate';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&catid='+catid;
	var myAjax = new Ajax.Request(
				url,
				{method: 'post', parameters: pars, onComplete: showResponse}
				);
	function showResponse(originalRequest)
	{
		var tempStr = 'var MyMe = ' + originalRequest.responseText; 
		var i=0;var j=0;
		eval(tempStr);
		if(MyMe){
			$('sscatid').value = '';
			$('scatid').value = '';	
			$('tcatid').value = '';
			$('catid').value = '';
			if(catid.length>8)
				$('sscatid').value = catid;
			if(catid.length>6)
				$('scatid').value = catid.substr(0,8);	
			if(catid.length>4)
				$('tcatid').value = catid.substr(0,6);
			$('catid').value = catid.substr(0,4);
			
			$('cate_show').innerHTML= MyMe.cat;
			$('brand').innerHTML= MyMe.brand;
			$('fv_box').innerHTML = '<table width="100%">'+MyMe.firstvalue+'</table>';
			if($('fv_list'))
				$('fv_list').style.display=MyMe.firstvalue!=''?'':'none';
		}			

	 }
	close_win();
}
//--------------------------
var city='<?php echo $this->_tpl_vars['de']['city']; ?>
';
var province='<?php echo $this->_tpl_vars['de']['province']; ?>
';
function getHTML(v)
{	
	var ob="city";
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&prov_id='+v;
	var myAjax = new Ajax.Request(
				url,
				{method: 'post', parameters: pars, onComplete: showResponse}
				);
	function showResponse(originalRequest)
	{
		var tempStr = 'var MyMe = ' + originalRequest.responseText; 
		var i=0;var j=0;
		eval(tempStr);
		for(var s in MyMe)
		{
			++j;
		}
		$(ob).options.length =j+1;
		for(var k in MyMe)
		{
			var cityId=MyMe[k][0];
			var ciytName=MyMe[k][1];
			$(ob).options[k].value = cityId;
			$(ob).options[k].text = ciytName;
			if(city!=''&&city==ciytName)
				$(ob).options[k].selected = true;
	　	}
	 }
　}
<?php if ($this->_tpl_vars['de']['city']): ?>
getHTML('<?php echo $this->_tpl_vars['de']['province']; ?>
');
<?php endif; ?>
//==========================================
function check_value()
{
	if(!$('title').value)
	{
		alert('<?php echo $this->_tpl_vars['lang']['notice_title']; ?>
');
		$('title').focus();
		return false;
	}
	if($('catid').value=='')
	{
		alert('<?php echo $this->_tpl_vars['lang']['product_category']; ?>
');
		return false;
	}
	if($('con').value.length>199) 
	{
		alert("<?php echo $this->_tpl_vars['lang']['sumisbig']; ?>
");
		return false;
	}
	if(!$('con').value) 
	{
		alert("<?php echo $this->_tpl_vars['lang']['notice_con']; ?>
");
		return false;
	} 
    var fck = FCKeditorAPI.GetInstance("detail");
    var content = fck.GetXHTML(true);
    if (content.replace(/<(?!img|input|object)[^>]*>|\s+/ig, "") == "")
	{
	   alert("<?php echo $this->_tpl_vars['lang']['notice_detail']; ?>
");
	   fck.Focus();
	   return false;
    }
	//============
	if($('add_pro_online')&&$('add_pro_online').checked==true){
		if($('price').value)
		{
			var str = $('price').value;
			if(!str.match(/^(:?(:?\d+.\d+)|(:?\d+))$/))
			{
				alert('Неправильно указана цена!');
				$('price').focus();
				return false;
			}
		}
		else
		{
			alert('Пожалуйста, укажите цену продукта!');
			$('price').focus();
			return false;
		}
		if($('amount').value)
		{
			var str = $('amount').value;
			if(!str.match(/^(:?(:?\d+.\d+)|(:?\d+))$/))
			{
				alert('Указано неправильно количество!');
				$('amount').focus();
				return false;
			}
		}
	}
}
//=========================================
var arr = new Array()
function picvalue(str)
{
	var arrs=str.split(',');
	for(i=0;i<arrs.length;i++)
	{
		v=arrs[i]*1;
		if(!arr.inArray(v))
			arr.push(v);
	}
	load_pic();
	close_win();
}
function load_pic()
{
	$('pic_view').innerHTML='';
	for(i=0;i<arr.length;i++)
	{
		v=arr[i]*1;
		if(v>0)
		{
			$('pic_view').innerHTML+='<li><img src="uploadfile/zsimg/size_small/'+v+'.jpg" width="50" height="40"><br>['+
			'<a href="javascript:remove(\''+v+'\')"><?php echo $this->_tpl_vars['lang']['delete']; ?>
</a>]</li>';
		}
	}
	$('pic').value=arr.join();
}
Array.prototype.inArray = function(valeur) 
{
	for(var i in this) 
	{ 
		if (this[i] === valeur) 
			return true; 
	}
	return false;
}
Array.prototype.remove=function(dx)
{
	for(var i=0,n=0;i<this.length;i++)
	{
		if(this[i]!=dx)
		{
			this[n++]=this[i]
		}
	}
	this.length-=1
}
function remove(v)
{
	arr.remove(v);
	load_pic();
}
<?php if ($this->_tpl_vars['de']['pic'] != ''): ?>
	picvalue('<?php echo $this->_tpl_vars['de']['pic']; ?>
');
<?php endif; ?>
</script>