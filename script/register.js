// JavaScript Document
function check()
{
	var letters = "abcdefghijklmnopqrstuvwxyz_0123456789" +
				 "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
	var letter =  "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
	var allword = letters + "~!@#$%^&*()+|/?;:'[{]}`"
		  
	if(!$('yzm').value)
	{
		alert(allnotblank)
		$('yzm').focus()
		return false
	}
	if(!$('user').value)
	{
		alert(allnotblank)
		$('user').focus()
		return false
	}
	if(!$('password').value)
	{
		alert(allnotblank)
		$('password').focus()
		return false
	}
	if(!$('re_password').value)
	{
		alert(allnotblank)
		$('re_password').focus()
		return false
	}
	if(!$('email').value)
	{
		alert(allnotblank)
		$('email').focus()
		return false
	}
	
	if($('password').value.length < 4)
	{
		alert(passlength)
		$('password').focus()
		return false
	}
	if($('password').value.length > 20)
	{
		alert(passistooleng)
		$('password').focus()
		return false
	}
	if($('password').value != $('re_password').value)
	{
		alert(passnotsame)
		$('re_password').focus()
		return false
	}	
	if($('email').value.indexOf("@") == -1)
	{
		alert(emailerror)
		$('email').focus()
		return false
	}
}
function show_yzm()
{
	$('yzm_pic').innerHTML="<img onclick='get_randfunc(this);' src='includes/rand_func.php'/>";
}
function show_yzwt()
{
	var url = 'ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&wtyz=1'; 
	var myAjax = new Ajax.Request(url,{method: 'post', parameters: pars, onComplete:						  						 
		function (originalRequest)
		{
			if(originalRequest.responseText)
				$('yzwt').innerHTML =originalRequest.responseText;
			$('tishi8').innerHTML ="";
		} 
	
	} )	
}
function check_yzwt()
{
	var url = 'ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&ckyzwt='+$('ckyzwt').value; 
	var myAjax = new Ajax.Request(url,{method: 'post', parameters: pars, onComplete:showResponse} )	
	function showResponse(originalRequest)
	{
		if(originalRequest.responseText=='true')
		{	
			$('tishi8').innerHTML ="<img src=image/default/icon_right_19x19.gif>";
		}
		else
		{
			$('tishi8').innerHTML =randcodeerror;
			$('ckyzwt').value="";	
			$('ckyzwt').focus()
		}
	}
}
function check_yzm()
{
	if(!$('yzm').value)
	{
		$('tishi2').innerHTML =randcodeisemp;
		$('yzm').focus()
		return false
	}
	var url = 'ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&yzm='+$('yzm').value; 
	var myAjax = new Ajax.Request(url,{method: 'get', parameters: pars, onComplete:showResponse} )	
	function showResponse(originalRequest)
	{
		if(originalRequest.responseText>0)
		{	
			$('tishi2').innerHTML =rcodeiserror;
			$('yzm').value="";	
			$('yzm').focus()
		}
		else
		{
			$('tishi2').innerHTML ="<img src=image/default/icon_right_19x19.gif>";
		}
	}
}

function check_user()
{
	  var letters = "abcdefghijklmnopqrstuvwxyz_0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"
	  var letter =  "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
	  var allword = letters + "~!@#$%^&*()+|/?;:'[{]}`"
	  
	  if($('user').value.length < 1)
	  {
		$('tishi').innerHTML =enterusername;
		$('user').focus()
		return false
	  }
	  else if($('user').value.length < 4)
	  {
		$('tishi').innerHTML =unameisfour;
		$('user').focus()
		return false
	  }
	  else if($('user').value.indexOf(" ")!=-1)
	  {
		$('tishi').innerHTML =have_blank;
		$('user').focus()
		return false
	  }
	  else
	  {
		  $('tishi').innerHTML ="";
		 　var l=0;
		   var v=$('user').value;
		   for(i=0;i<v.length;i++)  
		   {
				   var t=v.charCodeAt(i);
				   if(t>255)
				   {
						$('tishi').innerHTML =unameisen;
						$('user').value="";
						$('user').focus()
						return false 
				   }
		   }
		   	
			var url = 'ajax_back_end.php';
			var sj = new Date();
			var pars = 'shuiji=' + sj+'&user='+$('user').value; 
			var myAjax = new Ajax.Request(url,{method: 'get', parameters: pars, onComplete:
				function (originalRequest)
				{
					if(originalRequest.responseText!='')
					{	
						if(originalRequest.responseText>0)
						{
							$('tishi').innerHTML =usernameprotect;
							$('user').value="";	
							$('user').focus()
						}
						else
						{
							$('tishi').innerHTML ="<img src=image/default/icon_right_19x19.gif>";
						}
					}
				}						  
			} )	
			
		   
	  }

}