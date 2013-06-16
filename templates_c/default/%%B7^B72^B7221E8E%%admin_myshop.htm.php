<?php /* Smarty version 2.6.20, created on 2013-01-12 15:35:52
         compiled from admin_myshop.htm */ ?>
<script type="text/javascript" src="script/Validator.js"></script>







<script type="text/javascript">







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







</script>







<?php echo $this->_tpl_vars['slogin']; ?>








	<div class="admin_right_top"><?php echo $this->_tpl_vars['lang']['profile']; ?>
</div>







	<table width="100%" border="0" cellpadding="6" cellspacing="1" bgcolor="#DDDDDD" style="margin-bottom:4px;">







  <tr>







    <td height="45" align="left" valign="middle" bgcolor="#FBFEDE">







	    <div style="font-weight:normal;font-size:12px; width:100%; color:#999999;">







			<!--<?php echo $this->_tpl_vars['lang']['notice']; ?>
-->







	　　	    <?php if ($_GET['info'] == 1): ?><?php echo $this->_tpl_vars['lang']['info1']; ?>
<?php endif; ?>





<?php if ($_GET['info'] == 2): ?><span style="font-weight:normal;color:#cc0000;"><?php echo $this->_tpl_vars['lang']['info2']; ?>
</span><?php endif; ?>







			<?php if ($_GET['info'] == 3): ?><span style="font-weight:normal;color:green;"><?php echo $this->_tpl_vars['lang']['info3']; ?>
</span><?php endif; ?>







			<?php if (! $_GET['info']): ?><span style="font-weight:normal;color:green;"><?php echo $this->_tpl_vars['lang']['info4']; ?>
</span><?php endif; ?>

			







	    </div>







	</td>







  </tr>







</table>







	<table width='100%' border="0" cellpadding="7" cellspacing="1" bgcolor="#DDDDDD" class="admin_table">







	 <form action="" name="form" method="post" enctype="multipart/form-data" onSubmit="return Validator.Validate(this,3)">







	   <tr>







	     <td colspan="2" class="smalltitle"><?php echo $this->_tpl_vars['lang']['company_base']; ?>
</td>







       </tr>







	   <tr> 







	<td width='20%' height="24" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['company']; ?>
* </td>







	<td width='85%' bgcolor="#FFFFFF"><input name='company' type='text' value="<?php echo $this->_tpl_vars['de']['company']; ?>
" dataType="Limit" min=5 msg="<?php echo $this->_tpl_vars['lang']['ar_company']; ?>
" style="width:300px;"></td>







  </tr>















	 <tr> 







		<td width='20%' height="20" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['con_user']; ?>
* </td>







	   <td width='85%' height="20" bgcolor="#FFFFFF">







	   <input name='contact' type='text' id="contact" value="<?php echo $this->_tpl_vars['de']['contact']; ?>
" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['ar_con_user']; ?>
" style="width:300px;">	</td>







	 </tr>







	  <tr> 







		<td width='20%' height="20" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['tel']; ?>
* </td>







		<td width='85%' height="20" bgcolor="#FFFFFF">







		<input name='tel' type='text' value="<?php echo $this->_tpl_vars['de']['tel']; ?>
"  maxlength="200" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['ar_tel']; ?>
" style="width:300px;">







		</td>







	  </tr>







	  <tr> 







		<td width='20%' height="20" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['fax']; ?>
</td>







		<td width='85%' height="20" bgcolor="#FFFFFF"><input name='fax' type='text' value="<?php echo $this->_tpl_vars['de']['fax']; ?>
"  style="width:300px;"></td>







	  </tr>







	    	  <tr> 







		<td width='20%' height="20" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['post_code']; ?>
*</td>







		<td width='85%' height="20" bgcolor="#FFFFFF"><input name='zip' type='text' value="<?php echo $this->_tpl_vars['de']['zip']; ?>
" style="width:300px;"> </td>







	  </tr>







  <tr> 







	<td width='20%' height="24" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['addr']; ?>
* </td>







	<td width='85%' bgcolor="#FFFFFF"><input name='addr' type='text' value="<?php echo $this->_tpl_vars['de']['addr']; ?>
" maxlength="200" dataType="Require" msg="<?php echo $this->_tpl_vars['de']['ar_addr']; ?>
"  style="width:300px;"></td>







  </tr>







  <tr> 







	<td width='20%' height="24" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['url']; ?>
</td>







	<td width='85%' bgcolor="#FFFFFF" style="font-weight:normal">







	<input name='url' type='text' value="<?php if ($this->_tpl_vars['de']['url'] != ''): ?><?php echo $this->_tpl_vars['de']['url']; ?>
<?php else: ?>http://<?php endif; ?>" maxlength="50" style="width:300px;">







	</td>







  </tr>







	  <tr> 







		<td width="20%" height="24" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['province']; ?>
/<?php echo $this->_tpl_vars['lang']['city']; ?>
 </td>







		<td bgcolor="#FFFFFF" width="85%">



        



<select  name="province" id="province" onChange="getHTML(this.value)" style="width:150px;" />







		  <option value=""><?php echo $this->_tpl_vars['lang']['ar_province']; ?>
</option>







			<?php echo $this->_tpl_vars['prov']; ?>








			</select>



       



        <input style="width:146px;" id="city" name="city" type="text" value="<?php echo $this->_tpl_vars['de']['city']; ?>
"/>







 







			















       	</td>







	  </tr>







      <tr>







        <td colspan="2" class="smalltitle"><?php echo $this->_tpl_vars['lang']['company_biz']; ?>
</td>







       </tr>







      <tr> 







	<td width='20%' height="24" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['company_type']; ?>
* </td>







	<td width='85%' bgcolor="#FFFFFF">







	<?php $_from = $this->_tpl_vars['companyType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>







	<label><input <?php if ($this->_tpl_vars['de']['ctype'] == $this->_tpl_vars['list']): ?>checked="checked"<?php endif; ?> name="ctype" type="radio" value="<?php echo $this->_tpl_vars['list']; ?>
" /><?php echo $this->_tpl_vars['list']; ?>
</label>







	<?php endforeach; endif; unset($_from); ?>







	</td>







  </tr>







<?php if ($this->_tpl_vars['com_cat']['0']['catid']): ?>







    <tr> 







	<td width='20%' height="24" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['company_cat']; ?>
* </td>







	<td width='85%' bgcolor="#FFFFFF">







	







<p style="padding:5px 0;">







<select  onChange="getHTMLs(this.value,'tcatid')"  name="catid" id="catid"  size="8" style="width: 300px;vertical-align:top;font-size:11px;">







<?php $_from = $this->_tpl_vars['com_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>







<option value="<?php echo $this->_tpl_vars['list']['catid']; ?>
" ><?php echo $this->_tpl_vars['list']['cat']; ?>
</option>







<?php endforeach; endif; unset($_from); ?>







</select>







<select  name="tcatid" id="tcatid" onChange="getHTMLs(this.value,'scatid')"  size="8" style="width: 300px;vertical-align:top;visibility:hidden;font-size:11px;"></select>







<select  name="scatid" id="scatid" onChange="getHTMLs(this.value,'fcatid')"  size="8" style="width: 300px;vertical-align:top;visibility:hidden;font-size:11px;"></select>







<select  name="fcatid" id="fcatid"  size="8" style="width: 235px;vertical-align:top; visibility:hidden;"></select>







</p>







<br/><p style="padding:5px 0;"><?php echo $this->_tpl_vars['lang']['select_category']; ?>
<br/>







<input name="Submitadd" type="button"  value="<?php echo $this->_tpl_vars['lang']['add_category']; ?>
" style="padding:3px;" onclick="doSubmit1('select')" /> 







<input name="Submitdel" type="button"  value="<?php echo $this->_tpl_vars['lang']['remove_category']; ?>
" style="padding:3px;" onclick="doSubmit1('deselect')"/>







</p>















<select name="right_category_id[]"  size="8" multiple="multiple" id="right_category_id" style="width: 500px; vertical-align:top">







	<?php $_from = $this->_tpl_vars['de']['catinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>







		<?php if ($this->_tpl_vars['list']['cat'] != ''): ?>







			<option value="<?php echo $this->_tpl_vars['list']['catid']; ?>
"><?php echo $this->_tpl_vars['list']['cat']; ?>
</option>







		<?php endif; ?>







	<?php endforeach; endif; unset($_from); ?>







</select>     	 







</td>







  </tr>







<?php endif; ?>







  







    <tr>







      <td height="24" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['main_pro']; ?>
*</td>







      <td bgcolor="#FFFFFF"><input name='main_pro' type='text' value="<?php echo $this->_tpl_vars['de']['main_pro']; ?>
" dataType="Limit" min=5 msg="<?php echo $this->_tpl_vars['lang']['main_pro']; ?>
" style="width:300px;"><?php echo $this->_tpl_vars['lang']['main_product_des']; ?>
</td>







    </tr>







      <tr> 







	<td width='20%' height="24" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['employees']; ?>
*</td>







	<td width='85%' bgcolor="#FFFFFF"><input name='staff_num' type='text' value="<?php echo $this->_tpl_vars['de']['staff_num']; ?>
" dataType="Number" msg="<?php echo $this->_tpl_vars['lang']['pls_num']; ?>
" style="width:300px;"></td>







  </tr>



  <tr> 







	<td width="20%" align="left" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['lang']['company_logo']; ?>
</td>







	<td width="85%" bgcolor="#FFFFFF" style="font-weight:normal">







	<?php if ($this->_tpl_vars['de']['logo']): ?><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
//uploadfile/userimg/<?php echo $this->_tpl_vars['de']['logo']; ?>
" width=150 ><br /><?php endif; ?>







	<input name="pic" type="file" id="pic" style="width:300px;">	</td>







  </tr>







  <tr> 







	<td width='20%' height="24" align="right" bgcolor="#FFFFFF"> </td>







	<td width='85%' bgcolor="#FFFFFF">







	  <input onclick="select_all();"  type='submit' name='Submit' value='<?php echo $this->_tpl_vars['lang']['submit']; ?>
' style="width:100px;">







	  <input name="action" type="hidden" id="action" value="submit" />







	  </td>







  </tr>







  </form>







</table>







<script>







function removeOptions(src, dst)







{







	for(var i = 0; i < src.length; i++)







	{







		if(src[i].selected) src[i] =null;







	}







}







function getHTMLs(v,ob)







{	







	if(ob=='tcatid')







	{







		$('tcatid').options.selected =false;







		$('tcatid').options.length =0;







		$('scatid').options.length =0;







		$('fcatid').options.length =0;







		$('tcatid').style.visibility="hidden";







		$('scatid').style.visibility="hidden";







		$('fcatid').style.visibility="hidden";







	}







	else if(ob=='scatid')







	{







		$('scatid').options.selected =false;







		$('scatid').options.length =0;







		$('fcatid').options.length =0;







		







		$('scatid').style.visibility="hidden";







		$('fcatid').style.visibility="hidden";







	}







	else if(ob=='fcatid')







	{







		$('fcatid').options.length =0;







	}







	var url = 'ajax_back_end.php';







	var sj = new Date();







	var pars = 'shuiji=' + sj+'&cattype=com&pcatid='+v;







	var myAjax = new Ajax.Request(







				url,







				{method: 'post', parameters: pars, onComplete: showResponse}







				);







	function showResponse(originalRequest)







	{







		var tempStr = 'var MyMe = ' + originalRequest.responseText; 







		if(originalRequest.responseText!='{};')







		{







			var i=0;var j=0;







			eval(tempStr);







			for(var s in MyMe)







			{







				++j;







			}







			if(j>0)







				$(ob).style.visibility="visible";







			else







				$(ob).style.visibility="hidden";







			$(ob).options.length =j;







			for(var k in MyMe)







			{







					var cateId=MyMe[k][0];







					var cateName=MyMe[k][1];







					$(ob).options[i].value = cateId;







					$(ob).options[i].text = cateName;







					i++;







		　	}







		}







	 }







　}















 function doSubmit1(button_clicked)







 {







		var tmpform = document.form;







		var selected_categories = tmpform.right_category_id.options;







		var len = selected_categories.length;







		if( button_clicked !='select'&& button_clicked !='deselect')







		{







			if(testColum())







			{







				var selected_categories = tmpform.right_category_id.options;







				var len = selected_categories.length;







				if ( (len == 0 || len > 6)  )







				{







					alert("Выберите от 1－6 категорий!");







					companyError('Выберите сферу деятельности!');







					return false;







				}







				return true;







			}







			else







				return false;







		}







		if(button_clicked &&(button_clicked == "deselect"||button_clicked == "select"))







		{







		   var fCategories = tmpform.fcatid.options;







		   var sCategories = tmpform.scatid.options;







		   var tCategories = tmpform.tcatid.options;







		   var Categories  = tmpform.catid.options;







		   if(button_clicked == 'select')







		   {







				if(fCategories.length==0)







				{ 







					if(sCategories.length==0)







					{







						if(tCategories.length==0)







							addOptions(Categories, selected_categories,fCategories,sCategories,tCategories,Categories);







						else







							addOptions(tCategories, selected_categories,fCategories,sCategories,tCategories,Categories);







					}







					else 







						addOptions(sCategories, selected_categories,fCategories,sCategories,tCategories,Categories);







		       }







			   else







			  	  addOptions(fCategories, selected_categories,fCategories,sCategories,tCategories,Categories);







		   }







		   else







		   {







				if(button_clicked == 'deselect')







				{   // Remove from right pane







					removeOptions(selected_categories, fCategories);







				}







				button_clicked = '';







				return false;







         }







       }







	}







 function addOptions(src, dst,fCategories,sCategories,tCategories,Categories)







 {







    var selected_value = [];







    var selected_text = [];







	var fV = fCategories;







  	var sV = sCategories;







	var tV = tCategories;







   	var V  = Categories;







	var Flag = false;







  	var tFlag = false;







   	var sFlag = false;







   	var fFlag = false;







	var sValue = '';







	







	for(var i = 0;i<fCategories.length;i++)







	{







		if(fCategories[i].selected)







		{







			fV= fCategories[i].text;







			fFlag = true;







			fValue = fCategories[i].value;







			break;







		}







	}







	for(var i = 0;i<sCategories.length;i++)







	{







		if(sCategories[i].selected)







		{







			sV= sCategories[i].text;







			sFlag = true;







			sValue = sCategories[i].value;







			break;







		}







	}







	for(var i = 0;i<tCategories.length;i++)







	{







		if(tCategories[i].selected)







		{







			tV= tCategories[i].text;







			tFlag = true;







			tValue = tCategories[i].value;







			break;







		}







	}







	for(var i = 0;i<Categories.length;i++)







	{







		if(Categories[i].selected)







		{







			V= Categories[i].text;







			Flag = true;







			break;







		}







	}







    // Get items from dst







    for(var i = 0; i < dst.length; i++)







	{







		selected_value[selected_value.length] = dst[i].value;







		selected_text[selected_text.length] = dst[i].text;







    }







	var len = selected_value.length;







	if( len >= 6 )







	{







		alert('Вы можете выбрать не более шести направлений бизнеса!');







		return ;







	}







    // Get items from src







	for(var i = 0; i < src.length; i++)







	{







		if(src[i].selected)







		{







			var exists = 0;







			fFlag  = true;







			for(var j = 0; j < dst.length; j++)







			{







				if(dst[j].value == src[i].value)







				{







					exists = 1;







					break;







				}







			}







			if(exists&&exists==1)







			{







				alert('Вы превысили лимит направлений!');







				return;







			}







			if(!exists)







			{







				selected_value[selected_value.length] = src[i].value;







				if(fV==src[i].text)







					selected_text[selected_text.length] = V+"/"+tV+"/"+sV+"/"+fV;







				else if(sV==src[i].text)







					selected_text[selected_text.length] = V+"/"+tV+"/"+sV;







				else if(tV==src[i].text)







					selected_text[selected_text.length] = V+"/"+tV;







				else







				{







					selected_text[selected_text.length] = V;







				}







			}







		}







	}















	if(Flag ==false && tFlag==false&& sFlag==false&& fFlag==false)







	{







		alert("Вы не выбрали категорий!");







		return ;







	}







	else







	{







		if(tFlag ==false&&$('tcatid').style.visibility=="visible")







		{







			alert("Вы не выбрали конечную категорию для Вашего бизнеса!")







			return;







		}







		else if(sFlag ==false&&$('scatid').style.visibility=="visible")







		{







			alert("Вы не выбрали конечную категорию для Вашего бизнеса!")







			return;







		}







		else if(fFlag ==false&&$('fcatid').style.visibility=="visible")







		{







			alert("Вы не выбрали конечную категорию для Вашего бизнеса!")







			return;







		}







	}







	







	while(dst.length > 1) dst[1] = null;







	







	for(var j = 0; j < selected_value.length; j++)







	{







	  dst[j] = new Option(selected_text[j], selected_value[j]);







	}







  }







  







  function select_all()







  {







  		for(i=0;i<$('right_category_id').options.length;i++)







		{







			$('right_category_id').options[i].selected = true;







		}







  }







</script>