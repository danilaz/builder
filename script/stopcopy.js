document.body.oncontextmenu=function(){return false;};
document.body.ondragstart=function(){return false;};
document.body.onselectstart=function(){return false;};
document.body.onbeforecopy=function(){return false;};
document.body.onselect=function(){document.selection.empty();};
document.body.oncopy=function(){document.selection.empty();};