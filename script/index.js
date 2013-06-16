	function add_inquery(type,url,id)
	{
		//type=pro,info,com
		if(id)
			pid=','+id;
		else
		{
			var pid='';
			var boxes = document.getElementsByName("inquery");
			for (var i = 0; i < boxes.length; i++)  
			{  
				if(boxes[i].checked)  
				{  
					pid+=','+boxes[i].value;  
				} 
			}
		}
		//--------------------------------------------------
		var url = url+'/ajax_back_end.php';
		var sj = new Date();
		var pars = 'shuiji=' + sj+'&add_inquery=1&tid='+pid+'&type='+type; 
		var myAjax = new Ajax.Request(url,{method: 'post', parameters: pars, onComplete:						  						
			function (originalRequest)
			{//alert(originalRequest.responseText);
				if(originalRequest.responseText=='en')
					alert('Успешно добавлено в рассылку!');
				if(originalRequest.responseText=='cn')
					alert('Успешно добавлено в рассылку!');
			}
		} )	
	}
	//------------------------------
	var yi; 
	function show(id)
	{
		for(i=1;i<9;i++)
		{
			var yid="a"+i;
			if(document.getElementById(yid).style.backgroundImage=="url(image/default/bg_menu_on.gif)")
			{	 
				yi=yid; 
			}
			document.getElementById(yid).style.backgroundImage="";
		}
		document.getElementById(id).style.backgroundImage="url(image/default/bg_menu_on.gif)";
	}
	
	function hid(id)
	{
		document.getElementById(id).style.backgroundImage="";
		if(yi)
			document.getElementById(yi).style.backgroundImage="url(image/default/bg_menu_on.gif)";

	}
	function hiid()
	{
		if(yi)
			document.getElementById(yi).style.backgroundImage="";
	}
function select_form(i,url)
{
	$('sear').action=url+'/index.php';
	$('m').value=i;
	$('s').value=i+'_list';
}
function tabChang(i,url)
{
	ta='tag'+i;
	for(j=0;j<5;j++)
	{
		$('tag'+j).className='';
	}
	$(ta).className='current';
	
	if(i==2)
	{
		$('sear').action=url+'/index.php';
		$('m').value='company';
		$('s').value='company_list';
	}
	if(i==0)
	{
		$('sear').action=url+'/index.php';
		$('m').value='product';
		$('s').value='product_list';
	}
	if(i==1)
	{
		$('sear').action=url+'/index.php';
		$('m').value='offer';
		$('s').value='offer_list';
	}
	if(i==3)
	{
		$('sear').action=url+'/index.php';
		$('m').value='news';
		$('s').value='news_list';
	}
	if(i==4)
	{
		$('sear').action=url+'/index.php';
		$('m').value='exhibition';
		$('s').value='exhibition_list';
	}
}
function setHomepage(url)
{
	if (document.all)
	{
		document.body.style.behavior='url(#default#homepage)';
		document.body.setHomePage(url);
	}
    else if (window.sidebar)
    {
    	if(window.netscape)
		{
			 try
			 {
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			 }
			 catch(e)
			 {
				alert("Ваш браузер не поддерживает этой функции");
			 }
		}
		var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);
		prefs.setCharPref('browser.startup.homepage',url);
 	}
}
	
function myAddPanel(url,title)
{
	var desc=title;
	if ((typeof window.sidebar == 'object') && (typeof window.sidebar.addPanel == 'function'))
	{
		window.sidebar.addPanel(title,url,desc);
	}
	else
	{
		window.external.AddFavorite(url,title);
	}
}

function setTab(name,cursel,n)
{
	for(i=1;i<=n;i++)
	{
		var menu=document.getElementById(name+i);
		if(menu)
		{
			var con=document.getElementById("con_"+name+"_"+i);
			menu.className=i==cursel?"hover":"";
			con.style.display=i==cursel?"block":"none";
		}
	}
}
function get_randfunc(obj)
{
	var sj = new Date();
	obj.src=obj.src+'?'+sj;
}
function view_big_img(o, i)
{
	if(i!=''&&i.indexOf('nopic.gif') == -1)
	{	
		var s = i.replace('small','big'); 
		var aTag = o;
		var leftpos = toppos = 0;
		do {aTag = aTag.offsetParent; leftpos	+= aTag.offsetLeft; toppos += aTag.offsetTop;
		} while(aTag.offsetParent != null);
		var X = o.offsetLeft + leftpos + 100;
		var Y = o.offsetTop + toppos - 20;
		$('big_img_div').style.left = X + 'px';
		$('big_img_div').style.top = Y + 'px';
		$('big_img_div').style.display = 'block';
		$('big_img_div').innerHTML='<img src="'+s+'" onload="if(this.width<200) {$(\'big_img_div\').style.display = \'none\');}else if(this.width>300){this.width=300;}$(\'big_img_div\').style.width=this.width+\'px\';"/>'
	} else {
		$('big_img_div').style.display = 'none';
	}
}