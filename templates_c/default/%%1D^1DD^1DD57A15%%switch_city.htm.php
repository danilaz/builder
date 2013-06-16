<?php /* Smarty version 2.6.20, created on 2013-03-07 08:24:52
         compiled from switch_city.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style type="text/css">
.swcity {
 width:160px;float:left;
 font-weight:bold;
 padding-left:25px;
}
.subcity{
 width:140px; float:left;
 padding-left:4px; border:solid 1px; 
 border-color:#5D81AD;margin-left:8px;
 display:none;position:absolute;z-index:2;background:#EAEFF3; line-height:22px; font-weight:normal
}
.subci{width:200; float:left; padding:10px;}
.city_msg{font-size:14px; font-weight:bold; text-align:left; padding:10px;border: 1px solid #A9BAD3;}
.city_body{border: 1px solid #A9BAD3; margin-top:5px; height:400px; padding:10px;}
</style>

<div id="mainbody1" class="topm">
<script>
var prid=0;
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
</script>
<div class="city_msg"><?php echo $this->_tpl_vars['lang']['citymsg']; ?>
 <a href="switch_city.php?all=true"><?php echo $this->_tpl_vars['lang']['gotoall']; ?>
</a></div>

<div class="city_body">
    <?php $_from = $this->_tpl_vars['city']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        <div class="swcity">
             <div class="subci">
                     <span id="<?php echo $this->_tpl_vars['list']['province_id']; ?>
a" onclick="xian('<?php echo $this->_tpl_vars['list']['province_id']; ?>
');" >
                     <img src='image/default/adding.gif' border=0>
                     </span>
                     &nbsp;<a href="switch_city.php?pid=<?php echo $this->_tpl_vars['list']['province']; ?>
"><?php echo $this->_tpl_vars['list']['province']; ?>
</a>
                     <div class="subcity" id="<?php echo $this->_tpl_vars['list']['province_id']; ?>
">
                        <?php $_from = $this->_tpl_vars['list']['city']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sublist']):
?>
                        <a href="switch_city.php?cid=<?php echo $this->_tpl_vars['sublist']['city']; ?>
" > &raquo;<?php echo $this->_tpl_vars['sublist']['city']; ?>
</a><br />
                        <?php endforeach; endif; unset($_from); ?>
                     </div>
              </div>
        </div>
    <?php endforeach; endif; unset($_from); ?>
    
</div>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>