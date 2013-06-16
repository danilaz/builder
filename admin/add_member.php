<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//==================================
if(!empty($_POST["action"])&&$_POST['action']=='submit')
{
	$sql="insert into ".ALLUSER." (user,password,ip) values ('".$_POST['user']."','".md5($_POST['password'])."','127.0.0.1')";
	$db->query($sql);
	if($userid=$db->lastid())
	{
		if($config['openbbs']==2)
		{
			include_once('../uc_client/client.php');
			$uid = uc_user_register($_POST['user'], $_POST['password'], $_POST['email']);
		}
		if(is_uploaded_file($_FILES['pic']['tmp_name']))
		{	
			$save_directory = "../uploadfile/userimg/";
			makethumb($_FILES['pic']['tmp_name'],$save_directory.$userid.".jpg" , 400 , 400);
			$logo=$userid.".jpg";
		}
		else
            $logo='';
		$catid=implode(",",$_POST["discat"]);
		$catid=",".$catid.",";	
	    $time=date("Y-m-d H:i:s");
		$sql="insert into ".USER."
						(company,contact,email,tel,fax,qq,zip,province,addr,city,intro,url,sex,msn,ctype,skype,position,userid,regtime,mobile,catid,logo,ifpay)
						VALUES
						('".$_POST['company']."','".$_POST['contact']."','".$_POST['email']."','".$_POST['tel']."','".$_POST['fax']."','".$_POST['qq']."','".$_POST['zip']."','".$_POST['province1']."','".$_POST['addr']."','".$_POST['city1']."','".$_POST['intro']."','".$_POST['url']."','".$_POST['sex']."','".$_POST['msn']."','".$_POST['ctype']."','".$_POST['skype']."','".$_POST['position']."','".$userid."','".$time."','".$_POST['mobile']."','".$catid."','".$logo."','".$_POST['membergroup']."')";
		$re=$db->query($sql);
		//--------
		if($re)
		{
			msg(" member.php");
			exit();
		}
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<link href="main.css" rel="stylesheet" type="text/css" />
<style>
input,textarea{width:280px;}
</style>
</head>
<body>
<script src="../script/prototype.js" type=text/javascript></script>
<script type="text/javascript">
function check_username(value)
{
	  var letters = "abcdefghijklmnopqrstuvwxyz_0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"
	  var letter =  "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
	  var allword = letters + "~!@#$%^&*()+|/?;:'[{]}`"
	  
	  if($('user').value.length < 1)
	  {
		$('tishi').innerHTML ="<?php echo lang_show('plenusername');?>";
		$('user').focus()
		return false
	  }
	  
	  else if($('user').value.length < 4)
	  {
		$('tishi').innerHTML ="<?php echo lang_show('userlens');?>";
		$('user').focus()
		return false
	  }
	  else
	  {
		 　var l=0;
		   var v=$('user').value;
		   for(i=0;i<v.length;i++)  
		   {
				   var t=v.charCodeAt(i);
				   if(t>255)
				   {
						$('tishi').innerHTML ="<?php echo lang_show('notcnname');?>";
						$('user').value="";
						$('user').focus()
						return false 
				   }
		   }
	  }
		//======================================
		var url = '../ajax_back_end.php';
		var sj = new Date();
		var pars = 'shuiji=' + sj+'&user='+$('user').value; 
		var myAjax = new Ajax.Request(url,{method: 'get', parameters: pars, onComplete:showResponse} )			
		function showResponse(originalRequest)
		{
					if(originalRequest.responseText>0)
					{	
						$('tishi').innerHTML ="<?php echo lang_show('isreged');?>";
						$('user').value="";	
						$('user').focus()
					}
					else
					{
						if($('user').value!="")
							$('tishi').innerHTML ="<img src=../image/default/icon_right_19x19.gif>";
						else
						{
							$('tishi').innerHTML ="<?php echo lang_show('plenusername');?>";
							$('user').focus();
						}
					}
		}

}

function getHTML(v,type)
{	
	if(type==1)
		var ob="city";
	else
		var ob="subcat";
	var url = '../ajax_back_end.php';
	var sj = new Date();
	if(type==1)
		var pars = 'shuiji=' + sj+'&prov_id='+v;
	if(type==2)
		var pars = 'shuiji=' + sj+'&catid='+v;
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
		$(ob).options.length =j;
		if(ob=="subcat")
		{
			if(j==0)
				$(ob).style.display="none";
			else
				$(ob).style.display="block";
		}
		for(var k in MyMe)
		{
			var cityId=MyMe[k][0];
			var ciytName=MyMe[k][1];
			$(ob).options[i].value = cityId;
			$(ob).options[i].text = ciytName;
			//if(subcat==cityId||i==0)
			//	$(ob).options[i].selected = true;
			i++;
	　	}
			
	 }
　}
</script>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('mem_modify_info');?></div>
	<div class="bigboxbody">
        <table width='98%' border="0" cellpadding="7" cellspacing="1" bgcolor="#A9BAD3" class="admin_table">
	 <form action="" method="post" enctype="multipart/form-data"><tr> 
		<td width='15%' height="20" align="left"><?php echo lang_show('userid');?></td>
	   <td width='85%' height="20"  style="font-weight:normal">
	   <input name='user' type='text' id="user" onChange="check_username();"/><span id="tishi"></span></td>
	 </tr>
	   <tr>
	     <td height="20" align="left"><?php echo lang_show('userpassword');?></td>
	     <td height="20" ><span style="font-weight:normal">
	       <input name="password" type="password">
	     </span></td>
        </tr>
	   <tr> 
		<td width='15%' height="20" align="left"><?php echo lang_show('contact');?><span class="admin_red">*</span> </td>
	   <td width='85%' height="20" > <input name='contact' type='text' id="contact">	</td>
	 </tr>
	 	 <tr> 
		<td width='15%' height="20" align="left"><?php echo lang_show('position');?><span class="admin_red">*</span> </td>
	   <td width='85%' height="20" > <input name='position' type='text' id="position">	</td>
	 </tr>
	  <tr>
		<td height="20" align="left"><?php echo lang_show('sex');?></td>
		<td height="20"  style="font-weight:normal">
		<input name="sex" type="radio"  value="1" style="width:20px;border:none;"/><?php echo lang_show('mr');?>
		<input name="sex" type="radio"  value="2" style="width:20px;border:none;"/><?php echo lang_show('miss');?>	</td>
	  </tr>
	  <tr> 
		<td width='15%' height="20" align="left">Email<span class="admin_red">*</span> </td>
		<td width='85%' height="20" ><input name='email' type='text'></td>
	  </tr>
	  <tr> 
		<td width='15%' height="20" align="left"><?php echo lang_show('tel');?><span class="admin_red">*</span> </td>
		<td width='85%' height="20" ><input name='tel' type='text'></td>
	  </tr>
	  <tr>
	    <td height="20" align="left"><?php echo lang_show('mobile');?></td>
	    <td height="20" ><input name="mobile" type="text" id="mobile"></td>
	    </tr>
	  <tr> 
		<td width='15%' height="20" align="left"><?php echo lang_show('fax');?></td>
		<td width='85%' height="20" ><input name='fax' type='text'></td>
	  </tr>
	  <tr>
		<td height="20" align="left">Q Q</td>
		<td height="20"  style="font-weight:normal"><input name="qq" type="text" size="10" /></td>
	  </tr>
	  <tr>
		<td width='15%' height="20" align="left">MSN</td>
		<td height="20" ><input name="msn" type="text"/></td>
	  </tr>  
	  <tr>
		<td height="24" align="left">Skype</td>
		<td ><input name="skype" type="text"/></td>
	  </tr>

	  

	  <tr> 
		<td width="15%" height="24" align="left"><?php echo lang_show('province');?><span class="admin_red">*</span> </td>
		<td  width="85%">  
		<select  name="province1" id="province" onChange="getHTML(this.value,1)" style="width:300px;">
		<option value=""><?php echo lang_show('selectprovince');?></option>
		<?php
		echo get_province($de['province']);
		?>
		</select>		</td>
	  </tr>
	  <tr> 
		<td width='15%' height="24" align="left"><?php echo lang_show('city');?><span class="admin_red">*</span> </td>
	<td width='85%' >
		<select name="city1" id="city" style="width:300px;">
		<option value=""><?php echo lang_show('selectcity');?></option>
    	</select>		</td>
    </tr>
	
	
	
	    <tr> 
	<td width='15%' height="24" align="left"><?php echo lang_show('belongcat');?><span class="admin_red">*</span> </td>
	<td width='85%' >  
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4%">
	    <select id="com_cat" name="com_cat" size="5" onChange="getHTML(this.value,2)">
		<?php
		$db->query("select catid,cat from ".COMPANYCAT." where catid<9999");
		$re=$db->getRows();
		foreach($re as $v)
		{
			echo "<option value='$v[catid]'>$v[cat]</option>"; 
		}
		?>
	    </select></td>
    <td><select name="subcat" size="5" id="subcat" style="display:none";>
		</select></td>
	<td width="3%">
	  <input style="width:100px;" onClick="fdiscat();" name="" type="button" value="=>" /><br> <br>
	  <input style="width:100px;" onClick="remove();" name="" type="button" value="<=" />	</td>
    <td width="89%">
	    <select name="discat[]" size="5" multiple="multiple" id="discat" style="width:200px;">
		</select>
		<script>
		var len=0;
		function fdiscat()
		{	
			var subcatT='';
			var isadd=true;
			var index1=$('com_cat').selectedIndex;
			var catT=$('com_cat').options[index1].text;
			var catV=$('com_cat').options[index1].value;
			if($('subcat').length>0)
			{
				var index2=$('subcat').selectedIndex;
				var subcatT=$('subcat').options[index2].text;
				var subcatV=$('subcat').options[index2].value;
				catT+="/"+subcatT;
				catV=subcatV;
			}
			for(i=0;i<$('discat').length;i++)
			{
				if($('discat').options[i].text==catT)
					isadd=false;
			}
			if(isadd)
			{
				$('discat').length=len+1;
				//$('discat').options[0].value = 1;
				$('discat').options[len].text = catT;
				$('discat').options[len].value = catV;
				len=len+1;
			}
		}
		
		function remove()
		{	
			var index=$('discat').selectedIndex;
			$('discat').options[index] = null;
			len=len-1;
			$('discat').length=len;
		}
		function do_select()
		{
			for(i=0;i<$('discat').length;i++)
			{
				$('discat').options[i].selected = true;
			}
		}
		</script>		</td>
  </tr>
</table>	  </td>
  </tr>
  <tr> 
	<td width='15%' height="24" align="left"><?php echo lang_show('comptype');?><span class="admin_red">*</span> </td>
	<td width='85%' >  
<select name="ctype">
<?php
include_once("../lang/" . $config['language'] . "/company_type_config.php");
foreach($companyType as $v)
{
?>
<option><?php echo $v;?></option>
<?php
}
?>
</select></td>
  </tr>
  <tr>
    <td height="24" align="left"><?php echo lang_show('usergroup');?></td>
    <td >
      <select name="membergroup" id="membergroup">
       <?php
            $sql="select * from ".USERGROUP;
            $db->query($sql);
            $re=$db->getRows();
            foreach($re as $v)
	          {
       ?>
        <option value="<?php echo $v['group_id']; ?>"><?php echo $v['name']; ?></option>
        <?php
        }
        ?>
      </select>
   </td>
  </tr>
  <tr> 
	<td width='15%' height="24" align="left"><?php echo lang_show('compname');?><span class="admin_red">*</span> </td>
	<td width='85%' ><input name='company' type='text'></td>
  </tr>
  	  <tr> 
		<td width='15%' height="20" align="left"><?php echo lang_show('zip');?><span class="admin_red">*</span></td>
		<td width='85%' height="20" ><input name='zip' type='text'> </td>
	  </tr>
  <tr> 
	<td width='15%' height="24" align="left"><?php echo lang_show('addr');?><span class="admin_red">*</span> </td>
	<td width='85%' ><input name='addr' type='text'  ></td>
  </tr>
  <tr> 
	<td width='15%' height="24" align="left"><?php echo lang_show('url');?></td>
	<td width='85%'  style="font-weight:normal"><input name='url' type='text'></td>
  </tr>
  <tr> 
	<td width='15%' height="24" align="left"><?php echo lang_show('intro');?><span class="admin_red">*</span> </td>
	<td width='85%' ><textarea name='intro' rows="12"></textarea></td>
  </tr>
  <tr> 
	<td width="15%" align="left"><?php echo lang_show('complogo');?></td>
	<td width="85%"  style="font-weight:normal">
	<input name="pic" type="file" id="pic">	</td>
  </tr>
  <tr> 
	<td width='15%' height="24" align="right"> </td>
	<td width='85%' >
	  <input  onClick="do_select();" type='submit' name='Submit' value='<?php echo lang_show('sure');?>' style="width:100px;">
	  <input name="action" type="hidden" id="action" value="submit" />	  </td>
  </tr>
  </form>
</table>
	</div>
</div>
</body>
</html>