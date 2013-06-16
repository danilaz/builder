// JavaScript Document
	function $(id)
 	{
		return document.getElementById(id);
	}
	var bgObj="";
	//==============================
	function sAlert()
	{
		bgObj=document.createElement("div");
		bgObj.setAttribute('id','bgDiv');
		bgObj.style.position="absolute";
		bgObj.style.top="0";
		bgObj.style.background="#777";
		bgObj.style.filter="progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75)";
		bgObj.style.opacity="0.6";
		bgObj.style.left="0";
		bgObj.style.width=screen.width + "px";
		bgObj.style.height=screen.height + "px";
		bgObj.style.zIndex = "10000";
		bgObj.onclick=function(){
			document.body.removeChild(bgObj);
			$('neirong').style.display="none";
		}
		document.body.appendChild(bgObj);
		msgObj=document.getElementById('neirong');
		msgObj.style.display="block";
		msgObj.style.left = "25%";
		msgObj.style.top = "160px";

		
	}
	
	function getCat(stre)
	{
		Ary = stre.split('|');
		var catName="";
		for(i=0;i<Ary.length;i++)
		{
			var mb     = Ary[i];
			var subAry = mb.split(',');
			if(i==0)
			{
				$('catid').value=subAry[0];
				catName=subAry[1];
				$('pid').value='';
			}
			else
			{
				$('pid').value=subAry[0];
				catName=catName+" &raquo; "+subAry[1];
			}
		}
		$('showCat').innerHTML=catName;
		document.body.removeChild(bgObj);
		$('neirong').style.display="none";
	}
	
	var prid;
	function xian(id)
	{
		if(prid)
		{ 
		  document.getElementById(prid).style.display="none";
		  document.getElementById(prid+"a").innerHTML="<img src='image/default/adding.gif' border=0>";
		}
		if(prid!=id)
		{
		 document.getElementById(id).style.display="block";
		 document.getElementById(id+"a").innerHTML="<img src='image/default/decrease.gif' border=0>";
		 prid=id;
		}
		else
		  prid="";
	}