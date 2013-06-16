win_obj=document.getElementById('winpop');
function hid_pop()
{
	document.getElementById("winpop").style.display="none"; 
}
function moveMailPOP()
{
	var scrollPos;
	if (typeof window.pageYOffset != 'undefined') {
	   scrollPos = window.pageYOffset;
	}
	else if (typeof document.compatMode != 'undefined' &&
		 document.compatMode != 'BackCompat') {
	   scrollPos = document.documentElement.scrollTop;
	}
	else if (typeof document.body != 'undefined') {
	   scrollPos = document.body.scrollTop;
	} 
	h=document.body.clientHeight;
	document.getElementById("winpop").style.top=scrollPos+h-500;
}
window.onscroll=moveMailPOP;