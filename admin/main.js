function showCat(id)
{
	$("catid"+id).style.visibility="visible";
}
function getHTML(v,ob,id,cattype)
{	

	var url = '../ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&pcatid='+v;
	if(cattype=='offer')
		pars += '&cattype=offer';
	if(cattype=='pro')
		pars += '&cattype=pro';
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
		for(var k in MyMe)
		{
			var cityId=MyMe[k][0];
			var ciytName=MyMe[k][1];
			$(ob).options[k].value = cityId;
			$(ob).options[k].text = ciytName;
	　	}
		$("mod"+id).style.visibility="visible";
	 }
　}
function updateCat(type,id,objId)
{	
	var newCatId = null;

	if ($("scatid"+objId).value>0)
	{
		newCatId = $("scatid"+objId).value;
	}else if($("tcatid"+objId).value>0){
		newCatId = $("tcatid"+objId).value;
	}else  if($("catid"+objId).value>0){
		newCatId = $("catid"+objId).value;
	}else{
		return false;
	}
	var url = 'ajax_update.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&type='+type+'&id='+id+'&newCatId='+newCatId;
	var myAjax = new Ajax.Request(
				url,
				{method: 'post', parameters: pars, onComplete: showResponse}
				);
	function showResponse(originalRequest)
	{
		if(originalRequest.responseText && originalRequest.responseText!='0'){

			$("catid"+objId).style.visibility="hidden";
			$("tcatid"+objId).style.visibility="hidden";
			$("scatid"+objId).style.visibility="hidden";
			$("show_cat"+objId).innerHTML="<a  href=\"#\" onclick=\"showCat("+objId+");return false;\">"+originalRequest.responseText+"</a>";
			$("mod"+objId).style.visibility="hidden";
		}
	 }
　}

function updateAblumRec(rec,albumId)
{	
	var url = 'ajax_update.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&type=album&id='+albumId+'&newCatId='+rec;
	var myAjax = new Ajax.Request(
				url,
				{method: 'post', parameters: pars, onComplete: showResponse}
				);
	function showResponse(originalRequest)
	{
		if(originalRequest.responseText){
			if(rec==0){
				$("tj_album"+albumId).innerHTML=cancel;
			}else{
				$("tj_album"+albumId).innerHTML=recommend;
			}
		}
	}
}
function do_select()
{
	 var box_l = document.getElementsByName("de[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("de[]")[j].checked==true)
	  	  document.getElementsByName("de[]")[j].checked = false;
		else
		  document.getElementsByName("de[]")[j].checked = true;
	 }
}
function mouseOver(ob){
	ob.className='mouseover'

}
function mouseOut(ob,className){
	ob.className=className;
}