<?php
$de['citys']=$de['city'];
if(!empty($_SESSION["province"]))
{
	$de['province']=$_SESSION["province"];
}
if(!empty($_SESSION["city"]))
{
	$de['citys']=$_SESSION["city"];
}
?>
<script src="../script/prototype.js" type=text/javascript></script>
<script type="text/javascript">
function getHTML(v)
{
	var url = '../ajax_back_end.php';
	var sj = new Date();
	var pars = 'shuiji=' + sj+'&prov_id='+v;
	var myAjax = new Ajax.Request(
				url,
				{method: 'post', parameters: pars, onComplete: showResponse}
				);
	function showResponse(originalRequest)
	{
		var ob="city";
		var tempStr = 'var MyMe = ' + originalRequest.responseText; 
		var i=0;var j=0;
		eval(tempStr);
		for(var s in MyMe)
		{
			++j;
		}
		$(ob).options.length =j+1;
		for(var k in MyMe)
		{
			var cityId=MyMe[k][0];
			var ciytName=MyMe[k][1];
			i++;
			$(ob).options[i].value = cityId;
			$(ob).options[i].text = ciytName;
			if('<?php echo $de['citys'];?>'==cityId)
				$(ob).options[i].selected = true;
	　	}
			
	 }

}
<?php
if(!empty($de['province']))
	echo "getHTML('".$de['province']."')";
?>
</script>
<select name="provinces" <?php if(!empty($_SESSION["province"])) echo 'disabled="disabled"';?> id="province" onChange="getHTML(this.value)" style="width:200px;">
		<option value="" ><?php echo lang_show('all_prov');?></option>
		<?php
		echo get_province($de['province']);
		?>
</select>

<select name="citys" id="city" <?php if(!empty($_SESSION["city"])) echo 'disabled="disabled"';?> style="width:200px;">
<?php if(!empty($_SESSION["city"])){?>
<option value="<?php echo $_SESSION["city"]; ?>"><?php echo $_SESSION["city"]; ?></option>
<?php }else{?>
<option value=""><?php echo lang_show('allcity');?></option>
<?php } ?>
</select>