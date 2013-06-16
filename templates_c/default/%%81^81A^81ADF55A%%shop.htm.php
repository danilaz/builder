<?php /* Smarty version 2.6.20, created on 2013-01-12 15:09:23
         compiled from shop.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "shop_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo $this->_tpl_vars['out']; ?>

<script type="text/javascript">
function showAllCat() {
	try{
		var dles = document.getElementById("all_cate_list").getElementsByTagName("li");
		for (var i=0; i< dles.length; i++) {
			var p_box = dles[i].getElementsByTagName("p");
			if(p_box.length>0){
				dles[i].index = i;
				dles[i].box = p_box;
				dles[i].onmouseover= function() {
					this.className="lion";
					if(this.index>0){
						var box = document.getElementById("all_cate_list").getElementsByTagName("li")[this.index].getElementsByTagName("p");
						var len = box[0].getElementsByTagName("a").length;
						if(1>box[0].style.top&&this.index>0)
							if(this.index+1==dles.length){
								box[0].style.top = (1-len)*22+'px';
							}else{
								box[0].style.top = this.index<parseInt(dles.length/2)?(this.index>len?(-parseInt(len/2))*22+'px':-(this.index-1)*22+'px'):( parseInt(len/2)>dles.length-this.index?((dles.length-this.index)-len)*22+'px':(-parseInt(len/2))*22+'px' );
							}
					}
				}
				dles[i].onmouseout= function() {
					this.className="";
				}
			}
		}
	}catch(e){}
}

showAllCat();
	
function catOptionsInit() {
	try{
		var lies = document.getElementById("catalogListBox").getElementsByTagName("li");
		for (var i=0; i< lies.length; i++) {
			if(lies[i].className!='sub-line'){
				lies[i].onmouseover= function() {
					this.className="hover";
				}
				lies[i].onmouseout= function() {
					this.className="";
				}
				lies[i].onclick= function(){
					cate_drop_show();
					$('search_catid').value=navigator.userAgent.indexOf("MSIE")>0?this.catid:this.getAttribute('catid');
					$('search_type_in').value =this.innerHTML;
				}
			}
		}
	}catch(e){}
}
catOptionsInit();
<?php if ($_GET['s']): ?>
try{
	$('all_cat').onmouseover= function() {
		$('all_cate_list').style.display='block';
	}
	$('all_cat').onmouseout= function() {
		$('all_cate_list').style.display='none';
	}
}catch(e){}
<?php endif; ?>
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>