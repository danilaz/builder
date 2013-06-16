<?php /* Smarty version 2.6.20, created on 2013-01-12 17:27:28
         compiled from search.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="menu_bottom L1">				
    <div class="headtop_L">
        <strong><a href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/'><?php echo $this->_tpl_vars['lang']['indexpage']; ?>
</a> &raquo; <?php echo $this->_tpl_vars['lang']['advsearch']; ?>
</strong>
    </div>
    <div class="headtop_R"></div>		
</div>
<script type="text/javascript" src="script/Validator.js"></script>
<script language="javascript" src="script/Calendar.js"></script>
<script language="javascript">
var cdr = new Calendar("cdr");
document.write(cdr);
cdr.showMoreDay = true;
var scatid='';
var tcatid='';
<?php if ($_GET['stype'] == 1): ?>
var st='&cattype=offer&pcatid=';
<?php endif; ?>
<?php if ($_GET['stype'] == 2 || $_GET['stype'] == ''): ?>
var st='&cattype=pro&pcatid=';
<?php endif; ?>
<?php if ($_GET['stype'] == 3): ?>
var st='&cattype=com&pcatid=';
<?php endif; ?>
function getinfocat(v,ob)
{	
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+st+v;
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
		$(ob).options[0].text = '<?php echo $this->_tpl_vars['lang']['allcat']; ?>
';
		$(ob).options[0].selected = true;
		for(var k in MyMe)
		{
			var cityId=MyMe[k][0];
			var ciytName=MyMe[k][1];
			if(ob=='tcatid'&&i==1)
			{
				if(tcatid!='')
	 				getinfocat(tcatid,'scatid');
				else
					getinfocat(cityId,'scatid');
			}
			$(ob).options[i].value = cityId;
			$(ob).options[i].text = ciytName;
			if(cityId==scatid||cityId==tcatid)
				$(ob).options[i].selected = true;
			i++;
	　	}
	 }
　}
var province='';
var city='';
function getcity(v)
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
<?php if ($this->_tpl_vars['co']['country'] >= 0): ?>
getprovince('');
<?php endif; ?>
<?php if ($this->_tpl_vars['co']['city']): ?>
getcity('');
<?php endif; ?>
function getprovince(v)
{
	var ob="province";
	var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&country_id='+v;
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
        if(j==0){
		    $('pc1').style.display='';
		    $('pc2').style.display='none';
		    $('city').value='';
		    $('province').value='';
		    $('city').value='';
		    $('province').value='';
            return;
        }else{
		    $('pc2').style.display='';
		    $('pc1').style.display='none';
		    $('city1').value='';
		    $('province1').value='';
        }
		$(ob).options.length =j+1;
		for(var k in MyMe)
		{
			var provinceId=MyMe[k][1];
			var provinceName=MyMe[k][1];
			$(ob).options[k].value = provinceId;
			$(ob).options[k].text = provinceName;
			if(province!=''&&province==provinceName)
				$(ob).options[k].selected = true;
	　	}
	 }
}
</script>
<div id="mainbody1" class="topm reg">
<?php if ($_GET['stype'] == 1): ?>
<div class="asearch" id="offer">
<form action="search_result.php" method="GET" id="fsearch">
<input type="hidden" name="searchtype" id="searchtype" value="1"/>
<input type="hidden" name="m" value="<?php echo $this->_tpl_vars['m']; ?>
"/> 
<table cellpadding="3" cellspacing="3" width="100%">
<tr>
<td width="137" height="34" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['seatype']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <input name="stype" type="radio"  value="1" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=1&m=offer'" <?php if ($this->_tpl_vars['stype'] == 1 && $this->_tpl_vars['m'] == 'offer'): ?>checked<?php endif; ?>/><?php echo $this->_tpl_vars['lang']['offer']; ?>

  <input name="stype" type="radio"  value="1" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=1&m=demand'" <?php if ($this->_tpl_vars['stype'] == 1 && $this->_tpl_vars['m'] == 'demand'): ?>checked<?php endif; ?>/>Спрос
<!--
<input name="stype" type="radio"  value="2" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=2'" <?php if ($this->_tpl_vars['stype'] == 2): ?>checked<?php endif; ?> /><?php echo $this->_tpl_vars['lang']['pro']; ?>
 
-->
  <input name="stype" type="radio"  value="3" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=3'" <?php if ($this->_tpl_vars['stype'] == 3): ?>checked<?php endif; ?> /><?php echo $this->_tpl_vars['lang']['com']; ?>
 
</tr>
<tr>
<td width="137" height="34" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['keyword']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;"><input name="kwords" id="kwords" type="text"  value="" size="60" maxlength="30"/></td>
</tr>
<tr>
  <td height="35" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['incat']; ?>
</td>
  <td colspan="3" align="left" style="border-bottom: 1px dotted #999999;"><select name="catid" id="catid" onchange="getinfocat(this.value,'tcatid')">
 <option value=""><?php echo $this->_tpl_vars['lang']['inallcat']; ?>
</option>
    <?php $_from = $this->_tpl_vars['infocat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['infolist']):
?>
        <option value="<?php echo $this->_tpl_vars['infolist']['catid']; ?>
">
              <?php echo $this->_tpl_vars['infolist']['cat']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?>  
 </select>
<select style="visibility:hidden" name="tcatid" id="tcatid" onchange="getinfocat(this.value,'scatid')"></select>
<select style="visibility:hidden"  name="scatid" id="scatid"></select>&nbsp;</td>
  </tr>
<tr>
  <td height="33" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['inadd']; ?>
</td>
  <td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <div style="float:left;">
  <div id="mpc" style="float:left;width:120px;">
  <select onchange="getprovince(this.value);" name="country" id="country" style="width:120px;">
    <option value=""><?php echo $this->_tpl_vars['lang']['allcountry']; ?>
</option>
	<?php $_from = $this->_tpl_vars['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['clist']):
?>
			<option value="<?php echo $this->_tpl_vars['clist']['id']; ?>
"><?php echo $this->_tpl_vars['clist']['name']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
</select>	
</div>
<div id="pc1" style="display:none;float:left;width:300px;">
       &nbsp;&nbsp; <input style="width:120px;" id="province1" name="province1" type="text" />
        &nbsp;&nbsp;<input style="width:120px;" id="city1" name="city1" type="text"/>
</div>
<div id="pc2" style="display:none;float:left;width:410px;margin-left:20px;">
		<select  name="province" id="province" onChange="getcity(this.value)" style="width:100px;" />
		<option value=""><?php echo $this->_tpl_vars['lang']['allprovince']; ?>
</option>
		</select>
        
        <select name="city" id="city" style="width:100px;" />
		<option value=""><?php echo $this->_tpl_vars['lang']['allcity']; ?>
</option>
    	</select>
</div> 
</div></td>
  </tr>
<tr>
<td height="33" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['alldate']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">с <input name="stime" type="text" id="stime" size="22"  onFocus="cdr.show(this);">
  по 
<input onFocus="cdr.show(this);" name="etime" type="text" id="etime" size="22"> </td>
</tr>
<tr>
<td height="34" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['infotype']; ?>
</td>
<td width="487" align="left" style="border-bottom: 1px dotted #999999;">			
<select name="infotype" >
 <?php $_from = $this->_tpl_vars['infotype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['ilist']):
?>
        <option value="<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['ilist']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?> 
</select>&nbsp;</td>
<td width="137" align="left" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['usergroup']; ?>
</td>
<td width="307" align="left" style="border-bottom: 1px dotted #999999;"><select name="usergroup" >
  <option value="" ><?php echo $this->_tpl_vars['lang']['alluser']; ?>
</option>
  <?php $_from = $this->_tpl_vars['usergroup']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ulist']):
?>
  <option value="<?php echo $this->_tpl_vars['ulist']['group_id']; ?>
"><?php echo $this->_tpl_vars['ulist']['name']; ?>
</option>
  <?php endforeach; endif; unset($_from); ?>
</select></td>
</tr>
<tr>
  <td height="36" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['pic']; ?>
</td>
  <td align="left" style="border-bottom: 1px dotted #999999;"><input type="radio" name="pic" id="pic" value="1">
    <?php echo $this->_tpl_vars['lang']['thereispic']; ?>

    <input type="radio" name="pic" id="pic2" value="0">
    <?php echo $this->_tpl_vars['lang']['nopic']; ?>

  <input type="radio" name="pic" id="pic3" value="" checked>
    <?php echo $this->_tpl_vars['lang']['allpic']; ?>
</td>
  <td align="left" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['pricefw']; ?>
</td>
  <td align="left" style="border-bottom: 1px dotted #999999;"><input name="minprice" type="text" value="" size="10" maxlength="10"/>
    ~
    <input name="maxprice" type="text" value="" size="10" maxlength="10"/></td>
</tr>
<tr>
<td height="31" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['ordertype']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <select name="ordertype" >
    <option value="" selected=selected><?php echo $this->_tpl_vars['lang']['noorder']; ?>
</option><option value="1"><?php echo $this->_tpl_vars['lang']['priceorder']; ?>
</option><option value="2"><?php echo $this->_tpl_vars['lang']['pricedg']; ?>
</option><option value="3"><?php echo $this->_tpl_vars['lang']['usergo']; ?>
</option><option value="4"><?php echo $this->_tpl_vars['lang']['userdg']; ?>
</option><option value="5"><?php echo $this->_tpl_vars['lang']['offergd']; ?>
</option><option value="6"><?php echo $this->_tpl_vars['lang']['offerdg']; ?>
</option>
  </select></td>
</tr>
</tr>
<tr>
<td colspan="4" align="center">
<input type="submit" value="<?php echo $this->_tpl_vars['lang']['adsearch']; ?>
"/></td>
</tr>
</table>
</form>
</div>
<?php endif; ?>


<!-- ================================================== -->

<?php if ($_GET['stype'] == 2 || $_GET['stype'] == ''): ?>
<div class="asearch" id="product">
<form action="search_result.php" method="GET" id="fsearch">
<input type="hidden" name="searchtype" id="searchtype" value="2"/>
<table cellpadding="3" cellspacing="3" width="100%">
<tr>
<td width="110" height="34" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['seatype']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <input name="stype" type="radio"  value="1" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=1&m=offer'" <?php if ($this->_tpl_vars['stype'] == 1 && $this->_tpl_vars['m'] == 'offer'): ?>checked<?php endif; ?>/><?php echo $this->_tpl_vars['lang']['offer']; ?>

  <input name="stype" type="radio"  value="1" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=1&m=demand'" <?php if ($this->_tpl_vars['stype'] == 1 && $this->_tpl_vars['m'] == 'demand'): ?>checked<?php endif; ?>/>Спрос
<!--
  <input name="stype" type="radio"  value="2" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=2'" <?php if ($this->_tpl_vars['stype'] == 2): ?>checked<?php endif; ?> /><?php echo $this->_tpl_vars['lang']['pro']; ?>

-->
  <input name="stype" type="radio"  value="3" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=3'" <?php if ($this->_tpl_vars['stype'] == 3): ?>checked<?php endif; ?> /><?php echo $this->_tpl_vars['lang']['com']; ?>

</td>
</tr>
<tr>
<td width="110" height="34" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['keyword']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <input name="kwords" id="kwords" type="text"  value="" size="60" maxlength="30"/></td>
</tr>
<tr>
  <td height="35" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['incat']; ?>
</td>
  <td colspan="3" align="left" style="border-bottom: 1px dotted #999999;"><select name="catid" id="catid" onchange="getinfocat(this.value,'tcatid')">
 <option value=""><?php echo $this->_tpl_vars['lang']['inallcat']; ?>
</option>
    <?php $_from = $this->_tpl_vars['procat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plist']):
?>
        <option value="<?php echo $this->_tpl_vars['plist']['catid']; ?>
">
              <?php echo $this->_tpl_vars['plist']['cat']; ?>
 
	     </option>
    <?php endforeach; endif; unset($_from); ?>  
 </select>
<select style="visibility:hidden" name="tcatid" id="tcatid" onchange="getinfocat(this.value,'scatid')"></select>
<select style="visibility:hidden"  name="scatid" id="scatid"></select>&nbsp;</td>
  </tr>
<tr>
  <td height="33" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['inadd']; ?>
</td>
  <td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <div style="float:left;">
  <div id="mpc" style="float:left;width:120px;">
  <select onchange="getprovince(this.value);" name="country" id="country" style="width:120px;">
    <option value=""><?php echo $this->_tpl_vars['lang']['allcountry']; ?>
</option>
	<?php $_from = $this->_tpl_vars['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['clist']):
?>
			<option value="<?php echo $this->_tpl_vars['clist']['id']; ?>
"><?php echo $this->_tpl_vars['clist']['name']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>	
</div>
<div id="pc1" style="display:none;float:left;width:300px;">
        &nbsp;&nbsp;<input style="width:120px;" id="province1" name="province1" type="text" />
        &nbsp;&nbsp;<input style="width:120px;" id="city1" name="city1" type="text"/>
</div>
<div id="pc2" style="display:none;float:left;width:410px;margin-left:20px;">
		<select  name="province" id="province" onChange="getcity(this.value)" style="width:100px;" />
		<option value=""><?php echo $this->_tpl_vars['lang']['allprovince']; ?>
</option>
		</select>
        
        <select name="city" id="city" style="width:100px;" />
		<option value=""><?php echo $this->_tpl_vars['lang']['allcity']; ?>
</option>
    	</select>
</div> 
</div></td>
  </tr>
<tr>
<td height="33" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['alldate']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;"><input name="stime" type="text" id="stime" size="22"  onFocus="cdr.show(this);">
   <?php echo $this->_tpl_vars['lang']['to']; ?>

<input onFocus="cdr.show(this);" name="etime" type="text" id="etime" size="22"> </td>
</tr>
<tr>
<td height="34" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['infotype']; ?>
</td>
<td width="364" align="left" style="border-bottom: 1px dotted #999999;">			
<select name="infotype" >

 <?php $_from = $this->_tpl_vars['trade_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['plist']):
?>
        <option value="<?php echo $this->_tpl_vars['num']; ?>
">
              <?php echo $this->_tpl_vars['plist']; ?>
 
       </option>
    <?php endforeach; endif; unset($_from); ?> 
</select>&nbsp;</td>
<td width="113" align="left" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['usergroup']; ?>
</td>
<td width="330" align="left" style="border-bottom: 1px dotted #999999;"><select name="usergroup" >
  <option value="" ><?php echo $this->_tpl_vars['lang']['alluser']; ?>
</option>
  <?php $_from = $this->_tpl_vars['usergroup']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ulist']):
?>
  <option value="<?php echo $this->_tpl_vars['ulist']['group_id']; ?>
"><?php echo $this->_tpl_vars['ulist']['name']; ?>
</option>
  <?php endforeach; endif; unset($_from); ?>
</select></td>
</tr>
<tr>
  <td height="36" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['pic']; ?>
</td>
  <td align="left" style="border-bottom: 1px dotted #999999;"><input type="radio" name="pic" id="pic" value="1">
    <?php echo $this->_tpl_vars['lang']['thereispic']; ?>

    <input type="radio" name="pic" id="pic2" value="0">
    <?php echo $this->_tpl_vars['lang']['nopic']; ?>

  <input type="radio" name="pic" id="pic3" value="" checked>
    <?php echo $this->_tpl_vars['lang']['allpic']; ?>
</td>
  <td align="left" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['pricefw']; ?>
</td>
  <td align="left" style="border-bottom: 1px dotted #999999;"><input name="minprice" type="text" value="" size="10" maxlength="10"/>
    ~
    <input name="maxprice" type="text" value="" size="10" maxlength="10"/></td>
</tr>
<tr>
<td height="31" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['ordertype']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <select name="order" >
    <option value="0" selected=selected><?php echo $this->_tpl_vars['lang']['noorder']; ?>
</option><option value="1"><?php echo $this->_tpl_vars['lang']['priceorder']; ?>
</option><option value="2"><?php echo $this->_tpl_vars['lang']['pricedg']; ?>
</option><option value="3"><?php echo $this->_tpl_vars['lang']['usergo']; ?>
</option><option value="4"><?php echo $this->_tpl_vars['lang']['userdg']; ?>
</option><option value="5"><?php echo $this->_tpl_vars['lang']['upointgd']; ?>
</option><option value="6"><?php echo $this->_tpl_vars['lang']['upointdg']; ?>
</option>
  </select></td>
</tr>
</tr>
<tr>
<td colspan="4" align="center">
<input type="submit" value="<?php echo $this->_tpl_vars['lang']['adsearch']; ?>
"/></td>
</tr>
</table>
</form>
</div>
<?php endif; ?>

<!-- ============================================= -->

<?php if ($_GET['stype'] == 3): ?>
<div class="asearch" id="company">
<form action="search_result.php" method="GET" id="fsearch">
<input type="hidden" name="searchtype" id="searchtype" value="3"/>
<table cellpadding="3" cellspacing="3" width="100%">
<tr>
<td width="127" height="34" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['seatype']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <input name="stype" type="radio"  value="1" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=1&m=offer'" <?php if ($this->_tpl_vars['stype'] == 1 && $this->_tpl_vars['m'] == 'offer'): ?>checked<?php endif; ?>/><?php echo $this->_tpl_vars['lang']['offer']; ?>

  <input name="stype" type="radio"  value="1" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=1&m=demand'" <?php if ($this->_tpl_vars['stype'] == 1 && $this->_tpl_vars['m'] == 'demand'): ?>checked<?php endif; ?>/>Спрос
  <!--
  <input name="stype" type="radio"  value="2" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=2'" <?php if ($this->_tpl_vars['stype'] == 2): ?>checked<?php endif; ?> /><?php echo $this->_tpl_vars['lang']['pro']; ?>

  -->
  <input name="stype" type="radio"  value="3" onclick="location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/search.php?stype=3'" <?php if ($this->_tpl_vars['stype'] == 3): ?>checked<?php endif; ?> /><?php echo $this->_tpl_vars['lang']['com']; ?>
 
</td>
</tr>
<tr>
<td height="34" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['keyword']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;"><input name="kwords" id="kwords" type="text"  value="" size="60" maxlength="30"/></td>
</tr>
<tr>
  <td height="35" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['incat']; ?>
</td>
  <td colspan="3" align="left" style="border-bottom: 1px dotted #999999;"><select name="catid" id="catid" onchange="getinfocat(this.value,'tcatid')">
 <option value=""><?php echo $this->_tpl_vars['lang']['inallcat']; ?>
</option>
    <?php $_from = $this->_tpl_vars['comcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['infolist']):
?>
        <option value="<?php echo $this->_tpl_vars['infolist']['catid']; ?>
">
              <?php echo $this->_tpl_vars['infolist']['cat']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?>  
 </select>
<select style="visibility:hidden" name="tcatid" id="tcatid" onchange="getinfocat(this.value,'scatid')"></select>
<select style="visibility:hidden"  name="scatid" id="scatid"></select>&nbsp;</td>
  </tr>
<tr>
  <td height="33" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['inadd']; ?>
</td>
  <td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <div style="float:left;">
  <div id="mpc" style="float:left;width:120px;">
  <select onchange="getprovince(this.value);" name="country" id="country" style="width:120px;">
  <option value=""><?php echo $this->_tpl_vars['lang']['allcountry']; ?>
</option>
	<?php $_from = $this->_tpl_vars['country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['clist']):
?>
			<option value="<?php echo $this->_tpl_vars['clist']['id']; ?>
"><?php echo $this->_tpl_vars['clist']['name']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
</select>	
</div>
<div id="pc1" style="display:none;float:left;width:300px;">
        &nbsp;&nbsp;<input style="width:120px;" id="province1" name="province1" type="text" />
        &nbsp;&nbsp;<input style="width:120px;" id="city1" name="city1" type="text"/>
</div>
<div id="pc2" style="display:none;float:left;width:410px;margin-left:20px;">
		<select  name="province" id="province" onChange="getcity(this.value)" style="width:100px;" />
		<option value=""><?php echo $this->_tpl_vars['lang']['allprovince']; ?>
</option>
		</select>
        
        <select name="city" id="city" style="width:100px;" />
		<option value=""><?php echo $this->_tpl_vars['lang']['allcity']; ?>
</option>
    	</select>
</div> </div></td>
  </tr>

<tr>
<td height="34" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['usertype']; ?>
</td>
<td width="254" align="left" style="border-bottom: 1px dotted #999999;">			
<select name="infotype" >

 <?php $_from = $this->_tpl_vars['comtype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['clist']):
?>
        <option value="<?php echo $this->_tpl_vars['clist']; ?>
"><?php echo $this->_tpl_vars['clist']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?> 
</select>&nbsp;</td>
<td width="101" align="left" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['usergroup']; ?>
</td>
<td width="452" align="left" style="border-bottom: 1px dotted #999999;"><select name="usergroup" >
  <option value="" ><?php echo $this->_tpl_vars['lang']['alluser']; ?>
</option>
  <?php $_from = $this->_tpl_vars['usergroup']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ulist']):
?>
  <option value="<?php echo $this->_tpl_vars['ulist']['group_id']; ?>
"><?php echo $this->_tpl_vars['ulist']['name']; ?>
</option>
  <?php endforeach; endif; unset($_from); ?>
</select></td>
</tr>

<tr>
<td height="31" align="right" style="border-bottom: 1px dotted #999999;"><?php echo $this->_tpl_vars['lang']['ordertype']; ?>
</td>
<td colspan="3" align="left" style="border-bottom: 1px dotted #999999;">
  <select name="order" >
    <option value="0" selected=selected><?php echo $this->_tpl_vars['lang']['noorder']; ?>
</option><option value="1"><?php echo $this->_tpl_vars['lang']['priceorder']; ?>
</option><option value="2"><?php echo $this->_tpl_vars['lang']['pricedg']; ?>
</option><option value="3"><?php echo $this->_tpl_vars['lang']['rankgd']; ?>
</option><option value="4"><?php echo $this->_tpl_vars['lang']['rankdg']; ?>
</option><option value="5"><?php echo $this->_tpl_vars['lang']['upointgd']; ?>
</option><option value="6"><?php echo $this->_tpl_vars['lang']['upointdg']; ?>
</option>
  </select></td>
</tr>
</tr>
<tr>
<td colspan="4" align="center">
<input type="submit" value="<?php echo $this->_tpl_vars['lang']['adsearch']; ?>
"/></td>
</tr>
</table>
</form>
</div>
<?php endif; ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>