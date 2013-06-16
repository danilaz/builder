<?php /* Smarty version 2.6.20, created on 2013-01-12 15:44:40
         compiled from admin_personal.htm */ ?>
<script src="script/my_lightbox.js" language="javascript"></script>



<script>



closeimg='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/icon_close.gif';



weburl='<?php echo $this->_tpl_vars['config']['weburl']; ?>
';



</script>



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



			++j;



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



function ref()



{



	window.location='main.php?action=admin_personal&menu=<?php echo $_GET['menu']; ?>
';



	window.location.hash="add";



}



</script>



	<?php echo $this->_tpl_vars['slogin']; ?>




	<div class="admin_right_top"><?php echo $this->_tpl_vars['lang']['profile']; ?>
</div>



	<table border="0" cellpadding="7" cellspacing="1" bgcolor="#DDDDDD" class="admin_table">



	 <form action="" method="post" enctype="multipart/form-data" onSubmit="return Validator.Validate(this,3)"><tr> 



		<td width='20%' height="20" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['userid']; ?>
</td>



	    <td width='85%' height="20" bgcolor="#FFFFFF" style="font-weight:normal"><?php echo $_COOKIE['USER']; ?>
</td>



	 </tr>



	 <tr> 



		<td width='20%' height="20" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['fullname']; ?>
* </td>



	   <td width='85%' height="20" bgcolor="#FFFFFF">



	   <input name='name' type='text' id="name" value="<?php echo $this->_tpl_vars['de']['name']; ?>
" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['ar_con_user']; ?>
" style="width:300px;">	</td>



	 </tr>



	 	 <tr> 



		<td width='20%' height="20" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['position']; ?>
* </td>



	   <td width='85%' height="20" bgcolor="#FFFFFF"> <input name='position' type='text' id="position" value="<?php echo $this->_tpl_vars['de']['position']; ?>
" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['ar_position']; ?>
" style="width:300px;">	</td>



	 </tr>



	  <tr>



		<td height="20" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['xingbie']; ?>
*</td>



		<td height="20" bgcolor="#FFFFFF" style="font-weight:normal">



            <input name="sex" type="radio"  value="1" style="width:20px;border:none;"  <?php if ($this->_tpl_vars['de']['sex'] == 1): ?>checked="checked"<?php endif; ?>/>



            <?php echo $this->_tpl_vars['lang']['boy']; ?>




            <input name="sex" type="radio"  value="2" style="width:20px;border:none;"  <?php if ($this->_tpl_vars['de']['sex'] == 2): ?>checked="checked"<?php endif; ?>/>



            <?php echo $this->_tpl_vars['lang']['gilr']; ?>
        </td>



	  </tr>



	  <tr> 



		<td width='20%' height="20" align="left" bgcolor="#EAEFF3">Email* </td>



		<td width='85%' height="20" bgcolor="#FFFFFF">



		<input name='email' type='text' value="<?php echo $this->_tpl_vars['de']['email']; ?>
" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['ar_email']; ?>
" style="width:300px;"></td>



	  </tr>



	  <tr> 



		<td width='20%' height="20" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['tel']; ?>
* </td>



		<td width='85%' height="20" bgcolor="#FFFFFF"><input name='tel' type='text' value="<?php echo $this->_tpl_vars['de']['tel']; ?>
"  maxlength="200" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['ar_tel']; ?>
" style="width:300px;"></td>



	  </tr>



	  <tr>



	    <td height="20" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['mobile']; ?>
</td>



	    <td height="20" bgcolor="#FFFFFF"><input name="mobile" type="text" id="mobile" value="<?php echo $this->_tpl_vars['de']['mobile']; ?>
" style="width:300px;"></td>



       </tr>



	  <tr>



		<td height="20" align="left" bgcolor="#EAEFF3">ICQ</td>



		<td height="20" bgcolor="#FFFFFF" style="font-weight:normal"><input name="qq" type="text" value="<?php echo $this->_tpl_vars['de']['qq']; ?>
" maxlength="10" style="width:300px;"></td>



	  </tr>



	  <tr>



		<td width='20%' height="20" align="left" bgcolor="#EAEFF3">vk_id</td>



		<td height="20" bgcolor="#FFFFFF"><input name="msn" type="text" value="<?php echo $this->_tpl_vars['de']['msn']; ?>
" maxlength="30" style="width:300px;"></td>



	  </tr>  



	  <tr>



		<td height="24" align="left" bgcolor="#EAEFF3">skype</td>



		<td bgcolor="#FFFFFF"><input name="skype" type="text" value="<?php echo $this->_tpl_vars['de']['skype']; ?>
"  style="width:300px;"></td>



	  </tr>







	  <tr> 



		<td width="20%" height="24" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['province']; ?>
/<?php echo $this->_tpl_vars['lang']['city']; ?>
* </td>



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



	<td width="20%" align="left" bgcolor="#EAEFF3"><?php echo $this->_tpl_vars['lang']['picture']; ?>
</td>



	<td width="85%" bgcolor="#FFFFFF" style="font-weight:normal">



		<input style="width:300px;" name="logo" type="text" id="logo" value="<?php echo $this->_tpl_vars['de']['logo']; ?>
">



		[<a href="javascript:uploadfile('Загрузить логотип','logo',300,300)">Загрузить</a>] 



		[<a href="javascript:preview('logo');">Предпросмотр</a>]



		[<a onclick="javascript:$('logo').value='';" href="#">Удалить</a>]



	</td>



  </tr>



  <tr> 



	<td width='20%' height="24" align="right" bgcolor="#EAEFF3"> </td>



	<td width='85%' bgcolor="#FFFFFF">



	  <input  type='submit' name='Submit' value='<?php echo $this->_tpl_vars['lang']['submit']; ?>
' style="width:100px;">



	  <input name="action" type="hidden" id="action" value="update" />



	  </td>



  </tr>



  </form>



</table>











<?php if ($this->_tpl_vars['de']['pid'] == ''): ?>



	<br /><a name="add"></a>



	<div class="admin_right_top">Добавление нескольких контактов</div>



	<script src="script/my_lightbox.js" language="javascript"></script>



	<table width="100%" border="0" cellpadding="7" cellspacing="1" bgcolor="#DDDDDD" class="admin_table">



	  <tr>



		<td width="15%" bgcolor="#EAEFF3">ID пользователя</td>



		<td width="18%" bgcolor="#EAEFF3">Имя пользователя</td>



		<td width="22%" bgcolor="#EAEFF3">Должность</td>



		<td width="17%" bgcolor="#EAEFF3">Мобильный</td>



		<td width="15%" bgcolor="#EAEFF3">Email</td>



		<td width="13%" bgcolor="#EAEFF3">Действие</td>



	  </tr>



	  <?php $_from = $this->_tpl_vars['plist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>



	  <tr>



		<td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['list']['user']; ?>
</td>



		<td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>



		<td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['list']['position']; ?>
</td>



		<td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['list']['mobile']; ?>
</td>



		<td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['list']['email']; ?>
</td>



		<td bgcolor="#FFFFFF">



		<a href="javascript:alertWin('Добавить контакт','sss',600,400,'main.php?menu=user&action=admin_personal&adduser=true&editid=<?php echo $this->_tpl_vars['list']['userid']; ?>
');">Просмотр и редактирование</a> | 



		<a href="main.php?action=admin_personal&deid=<?php echo $this->_tpl_vars['list']['userid']; ?>
&menu=<?php echo $_GET['menu']; ?>
#add"><?php echo $this->_tpl_vars['lang']['delete']; ?>
</a></td>



	  </tr>



	  <?php endforeach; endif; unset($_from); ?>



	</table>



	<div style="padding:5px;">



	<input value="+Добавить" onclick="alertWin('Добавить контакт','sss',600,400,'main.php?menu=user&action=admin_personal&adduser=true');" type="button" />



	</div>



<?php endif; ?>