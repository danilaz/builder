function get_index_cat(str,type)
{
	for(i=65;i<=90;i++)
	{
		var chars=String.fromCharCode(i);
		$(chars).className='index_cat_li_off';
	}

	$(str).className='index_cat_li_on';
	var url = cityurl;
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&get_index_cat='+str+type; 
	var myAjax = new Ajax.Request(url,{method: 'get', parameters: pars, onComplete:						  						 
		function (originalRequest)
		{
			if(originalRequest.responseText!='')
			{
				$('ajax_cat').style.display='block';
				$('ajax_cat').innerHTML =originalRequest.responseText;
				
			}
			else
			{
				$('ajax_cat').style.display='none';
			}
		} 
	
	} )	
}