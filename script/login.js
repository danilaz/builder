function do_login()
{
	if($('user').value.length < 1)
	{
		alert(nousername);
		$('user').focus();
		return false;
	}
	if($('password').value.length < 1)
	{
		alert(nouserpass);
		$('password').focus();
		return false;
	}
	if($('randcode').value.length < 1)
	{
		alert(norandcode);
		$('randcode').focus();
		return false;
	}
}