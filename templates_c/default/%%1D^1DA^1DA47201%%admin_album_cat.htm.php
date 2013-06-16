<?php /* Smarty version 2.6.20, created on 2013-02-02 12:17:06
         compiled from admin_album_cat.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_image', 'admin_album_cat.htm', 18, false),)), $this); ?>
<div class="admin_right_top">
<span style="float:left"><?php echo $this->_tpl_vars['lang']['album_cat_list']; ?>
</span>
</div>
<div>
<?php if (! $_GET['edit'] && $this->_tpl_vars['re']): ?>
<table class="admin_table" border="0" cellspacing="1" bgcolor="#FFFFFF">
	<tr bgcolor="#E8E8E8" style="font-weight:bold" height="22">
	  <td width="10%" align="left"><?php echo $this->_tpl_vars['lang']['album_cat_cover']; ?>
</td>
	  <td width="13%" align="left"><?php echo $this->_tpl_vars['lang']['album_cat_name']; ?>
</td>
	  <td width="*%"  align="left"><?php echo $this->_tpl_vars['lang']['album_cat_des']; ?>
</td>
	  <td width="22%" align="center"><?php echo $this->_tpl_vars['lang']['operation']; ?>
</td>
	</tr>
	<?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
	<tr>
	  <td align="left">
      <a href="?menu=<?php echo $_GET['menu']; ?>
&action=m&m=album&s=admin_album&catid=<?php echo $this->_tpl_vars['list']['id']; ?>
">
      <?php $this->assign('img', $this->_tpl_vars['list']['id']); ?>
      <?php echo smarty_function_html_image(array('file' => "uploadfile/catimg/size_small/".($this->_tpl_vars['img']).".jpg",'width' => 100,'alt' => ($this->_tpl_vars['list']).".name"), $this);?>

      </a>
      </td>
	  <td valign="top"><?php echo $this->_tpl_vars['list']['name']; ?>
<br />(<a href="?menu=<?php echo $_GET['menu']; ?>
&action=m&m=album&s=admin_album&catid=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['count']; ?>
 фото</a>)</td>
	  <td valign="top"><?php echo $this->_tpl_vars['list']['des']; ?>
</td>
	  <td valign="top" align="center">
        <a href="?menu=<?php echo $_GET['menu']; ?>
&action=m&m=album&s=admin_album&catid=<?php echo $this->_tpl_vars['list']['id']; ?>
">
		<img src="/image/default/image_add.png" title="Загрузить фото"></a>
		<a href="?menu=<?php echo $_GET['menu']; ?>
&action=m&m=album&s=admin_album_cat&edit=<?php echo $this->_tpl_vars['list']['id']; ?>
">
		<img src="/image/default/image_edit.png" title="Редактировать альбом"></a>
		<a href="?menu=<?php echo $_GET['menu']; ?>
&action=m&m=album&s=admin_album_cat&deid=<?php echo $this->_tpl_vars['list']['id']; ?>
" onclick="return confirm('<?php echo $this->_tpl_vars['lang']['confirm']; ?>
');">
		<img src="/image/default/image_delete.png " title="Удалить альбом"></a>
        </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
  </table>
	<?php endif; ?>


<form method="post" action="" enctype="multipart/form-data" onsubmit="return check_value();">
<table border="0" cellspacing="1" bgcolor="#FFFFFF" class="admin_table">
	<tr bgcolor="#e8e8e8" style="font-weight:bold" height="22">
	  <td colspan="2"><?php if ($_GET['edit'] && $this->_tpl_vars['re']): ?><?php echo $this->_tpl_vars['lang']['album_cat_edit']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['album_cat_add']; ?>
<?php endif; ?></td>
	</tr>
    <tr bgcolor="#f7f7f7">
      <td align="left"><?php echo $this->_tpl_vars['lang']['sys_cat']; ?>
</td>
      <td>
      		<select name="catid" id="catid" onchange="getHTML(this.value,'tcatid')">
            <option value=""><?php echo $this->_tpl_vars['lang']['select_category']; ?>
</option>
            <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
              <option value="<?php echo $this->_tpl_vars['list']['catid']; ?>
" <?php if ($this->_tpl_vars['list']['catid'] == $this->_tpl_vars['re']['catid']): ?>selected="selected"<?php endif; ?> >
              <?php echo $this->_tpl_vars['list']['cat']; ?>

              </option>
            <?php endforeach; endif; unset($_from); ?>  
            </select>
			<select style="visibility:hidden" name="tcatid" id="tcatid" onchange="getHTML(this.value,'scatid')"></select>
			<select style="visibility:hidden"  name="scatid" id="scatid"></select>
            </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
        <td align="left" width="20%">
            <?php echo $this->_tpl_vars['lang']['album_cat_name']; ?>
<span class="admin_red">*</span>        </td>
      <td width="80%">
          <input name="name" id="name" maxlength="50" type="text" style="width:300px;" value="<?php if ($_GET['edit'] && $this->_tpl_vars['re']): ?><?php echo $this->_tpl_vars['re']['name']; ?>
<?php endif; ?>" />        </td>
    </tr>
    <tr bgcolor="#f7f7f7">
        <td align="left">
            <?php echo $this->_tpl_vars['lang']['album_cat_des']; ?>
<span class="admin_red">*</span>        </td>
        <td>
            <textarea name="des" id="des" maxlength="300" style="width:300px;font-size:12px; height:60px;"><?php if ($_GET['edit'] && $this->_tpl_vars['re']): ?><?php echo $this->_tpl_vars['re']['des']; ?>
<?php endif; ?></textarea>        </td>
    </tr>
    <tr bgcolor="#f7f7f7">
        <td align="left">
            <?php echo $this->_tpl_vars['lang']['album_cat_cover']; ?>
<span class="admin_red">*</span>        </td>
        <td>
            <?php if ($_GET['edit'] && $this->_tpl_vars['re']): ?>
            <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
//uploadfile/catimg/size_small/<?php echo $this->_tpl_vars['re']['id']; ?>
.jpg" /><br />
            <?php endif; ?>
            <input name="pic" id="pic" type="file" />        </td>
    </tr>
    <tr bgcolor="#f7f7f7">
        <td align="left">
            <input name="action" type="hidden" id="submit" value="<?php if ($_GET['edit'] && $this->_tpl_vars['re']): ?>edit<?php else: ?>submit<?php endif; ?>" />        </td>
        <td>
            <input name="editid" type="hidden" value="<?php echo $this->_tpl_vars['re']['id']; ?>
" />
            <input type="submit" style="height: 22px;" value=" <?php if ($_GET['edit'] && $this->_tpl_vars['re']): ?><?php echo $this->_tpl_vars['lang']['album_cat_edit']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['album_cat_add']; ?>
<?php endif; ?>" /></td>
        </tr>
  </table>
  </form>
</div>
<script type="text/javascript">

//==========================================
function check_value()
{
	if(!$('name').value){
		alert('<?php echo $this->_tpl_vars['lang']['name_notice']; ?>
');
		$('name').focus();
		return false;
	}
	if(!$('des').value){
		alert('<?php echo $this->_tpl_vars['lang']['des_notice_req']; ?>
');
		$('des').focus();
		return false;
	}else if($('des').value.lenght>180){
		alert('<?php echo $this->_tpl_vars['lang']['des_notice_max']; ?>
');
		$('des').focus();
		return false;
    }
	<?php if (! $_GET['edit']): ?>
	v=$('pic').value;
	if(!v){
		alert('<?php echo $this->_tpl_vars['lang']['pic_notice']; ?>
');
		$('pic').focus();
		return false;
	}
	else
	{
		Ary = v.split('.');
		filetype=Ary[Ary.length-1];
		if (filetype=='jpg'||filetype=='jpeg'||filetype=='gif'||filetype=='png'||filetype=='JPEG'||filetype=='JPG'||filetype=='GIF'){
			return true;
		}
		else{
			alert ('<?php echo $this->_tpl_vars['lang']['picture_not_correct']; ?>
');
			return false;
		}
	}
	<?php endif; ?>

}


var scatid='<?php echo $this->_tpl_vars['re']['scatid']; ?>
';
var tcatid='<?php echo $this->_tpl_vars['re']['tcatid']; ?>
';
function getHTML(v,ob)
{	
	var url = 'ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&cattype=album&pcatid='+v;
	var myAjax = new Ajax.Request(
				url,
				{method: 'post', parameters: pars, onComplete: showResponse}
				);
	function showResponse(originalRequest)
	{
		var tempStr = 'var MyMe = ' + originalRequest.responseText; 
		var i=1;var j=0;
		eval(tempStr);
		for(var s in MyMe)
		{
			++j;
		}
		if(j>0)
			$(ob).style.visibility="visible";
		else
			$(ob).style.visibility="hidden";
		$(ob).options.length =j+1;
		$(ob).options[0].value = '';
		$(ob).options[0].text = '<?php echo $this->_tpl_vars['lang']['select_sub']; ?>
';
		$(ob).options[0].selected = true;
		//alert(j);
		for(var k in MyMe)
		{
			var cityId=MyMe[k][0];
			var ciytName=MyMe[k][1];
			if(ob=='tcatid'&&i==1)
			{
				if(tcatid!='')
	 				getHTML(tcatid,'scatid');
				else
					getHTML(cityId,'scatid');
			}
			$(ob).options[i].value = cityId;
			$(ob).options[i].text = ciytName;
			if(cityId==scatid||cityId==tcatid)
				$(ob).options[i].selected = true;
			i++;
	　	}
	 }
　}
<?php if ($this->_tpl_vars['re']['catid']): ?>
getHTML('<?php echo $this->_tpl_vars['re']['catid']; ?>
','tcatid');
<?php endif; ?>
</script>