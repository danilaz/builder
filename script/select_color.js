var ColorHex=new Array('00','33','66','99','CC','FF')
var SpColorHex=new Array('FF0000','00FF00','0000FF','FFFF00','00FFFF','FF00FF')
var current=null
function initcolor(evt)
{
var colorTable=''
for (i=0;i<2;i++)
{
for (j=0;j<6;j++)
{
colorTable=colorTable+'<tr height="10">'
colorTable=colorTable+'<td style="background-color:#000000;height:15px;width:15px;padding:0px;">'
if (i==0){
colorTable=colorTable+'<td style="height:15px;width:15px;padding:0px;cursor:pointer;background-color:#'+ColorHex[j]+ColorHex[j]+ColorHex[j]+'" onclick="doclick(this.style.backgroundColor)">'}
else
{
	colorTable=colorTable+'<td style="height:15px;width:15px;padding:0px;cursor:pointer;background-color:#'+SpColorHex[j]+'" onclick="doclick(this.style.backgroundColor)">'}
colorTable=colorTable+'<td style="height:15px;width:15px;padding:0px;background-color:#000000">'
for (k=0;k<3;k++)
{
	for (l=0;l<6;l++)
	{
	colorTable=colorTable+'<td style="height:15px;width:15px;padding:0px;cursor:pointer;background-color:#'+ColorHex[k+i*3]+ColorHex[l]+ColorHex[j]+'" onclick="doclick(this.style.backgroundColor)">'
	}
}
}
}
colorTable=
'<table border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;" bordercolor="000000" style="cursor:pointer;">'+colorTable+'<tr><td bordercolor="#FFFFFF" colspan="21" align="center"><span style="cursor:pointer;" onclick="colorclose();">Cancel<span></td></tr></table>';
document.getElementById("colorpane").innerHTML=colorTable;
var current_x = document.getElementById("color").offsetLeft;
var current_y = document.getElementById("color").offsetTop;
//alert(current_x + "-" + current_y)
document.getElementById("colorpane").style.offsetLeft = current_x + "px";
document.getElementById("colorpane").style.offsetTop = current_y + "px";
}
function doclick(obj)
{
	document.getElementById("color").value=obj;
	document.getElementById("color").style.backgroundColor=obj;
	colorclose();
}
function colorclose()
{
	document.getElementById("colorpane").style.display = "none";
}
function coloropen()
{
	document.getElementById("colorpane").style.display = "";
}
window.onload = initcolor;