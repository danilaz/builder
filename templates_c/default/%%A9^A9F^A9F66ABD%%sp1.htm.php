<?php /* Smarty version 2.6.20, created on 2013-01-21 18:00:26
         compiled from sp1.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['detail']['name']; ?>
</title>
</head>
<style>
a{color:#FFFFFF;text-decoration:none;}
body{background-color:#000000; font-size:12px; font-family:Arial,Helvetica,"",sans-serif; color:#FFFFFF;}
li{list-style:none; display:inherit; padding:0px;}

.menu{ border-bottom:solid 2px #FFFFFF; float:left; text-align:left; padding:0px; padding-left:-20px;}
.menu ul{margin:0px; padding-left:0px; margin-left:-15px;}
.menu li{float:left; color:#FFFFFF; font-size:16px; display:block; margin-left:20px; font-weight:bold; 
margin-top:0px;
padding-left:15px;
background-repeat:no-repeat;
background-position:left;
background-image:url(<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/special_template/images/point.jpg);

}
.left{border-right:dashed 2px #262626; height:700px;}

.new_box{float:left; margin-top:10px;}
.new_box ul{margin:0px; padding:0px;}
.new_box_title{color:#FFFFFF; font-weight:bold}
.new_title{color:#FFFFFF; float:left; width:200px; overflow:hidden; height:22px;}
.new_time{float:right; width:70px; overflow:hidden}
.new_con{padding:0px;}

.pro_box{float:left; margin-top:10px; padding:0px;}
.pro_con{margin:0px; padding:0px}
.pro_box_title{color:#FFFFFF; font-weight:bold}
.pro_title{color:#FFFFFF; float:left; overflow:hidden; height:22px;}
.pro_time{float:right; width:70px; overflow:hidden}
</style>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_exp.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table width="960" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="87" colspan="3"><?php echo $this->_tpl_vars['top']; ?>
</td>
  </tr>
  <tr>
    <td width="50%" height="226" valign="top">
    <div class="left">
   <div class="new_box">
	<div class="new_box_title">Рекомендуем</div>
	<div class="new_con">
            <ul>
                <?php echo $this->_tpl_vars['detail']['con']; ?>

            </ul>
      </div>
    </div>    
    <?php echo $this->_tpl_vars['left']; ?>

    </div>
    </td>
    <td width="20%" colspan="2" valign="top" style="padding:5px;"><?php echo $this->_tpl_vars['chenter']; ?>
</td>
  </tr>
  <tr>
    <td height="114" colspan="3" align="center"><?php echo $this->_tpl_vars['footer']; ?>
</td>
  </tr>
</table>
</body>
</html>