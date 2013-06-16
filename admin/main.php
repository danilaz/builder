<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("../lang/" . $config['language'] . "/admin/script_name.php");
include_once("auth.php");
include_once("menu_config.php");
//====================================
if(empty($_SESSION["ADMIN_USER"]))
	msg("index.php");

function list_sub($sv,$sub=NULL,$last=NULL)
{
	global $perm,$sn,$bnums,$j;
	$u_v=explode(",",$sv);
	if($u_v[1]==1&&(in_array(md5($u_v[0]),$perm)||$_SESSION["ADMIN_USER"]=='admin'))
	{
		$str.='<tr height=17>';
		if(!empty($sub))
		{
			$str.='<td width="3" valign="middle" class="subtd">';
			$str.='</td>';
		}
		else
			$co="colspan=2";
		if(count($u_v)>=3)
			$str.='<td '.$co.' class="subtd"><a href="module.php?m='.$u_v[2].'&s='.$u_v[0].'" onClick="javascript:document.all.main.src=\'module.php?m='.
			$u_v[2].'&s='.$u_v[0].'\';return false;">';
		else
			$str.="<td $co class='subtd'><img src='../image/admin/jiantou.jpg'><a href='$u_v[0]' onClick=\"javascript:document.all.main.src='".$u_v[0]."';return false;\">";
		
		$scrp_name=substr($u_v[0],0,-4);
		if(!empty($u_v[3]))
			$str.=$u_v[3];
		else
			$str.=$sn[$scrp_name];
		$str.='</a></td></tr>';
	}
	return $str;
}
?>
<html>
<head>
<title><?php echo lang_show('business_manager_system');?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/my_lightbox.js"></script>
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
</script>
</head>
<body class="nbg">
<table width="98%" border="0" cellspacing="0" cellpadding="0" height="99%" >
  <tr>
    <td height="42" colspan="2" align="left" valign="bottom" style="padding-top:10px; padding-left:15px;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<img src="../image/admin/logo.png" width="225" height="42" align="bottom">
	<span style="font-family:'arial,helvetica,verdana,sans-serif'; font-size:14px;">Панель управления сервисом</span>
	</td>
    <td valign="bottom">    <span style="float:right; margin-right:20px;">
                       Приветствуем Вас, <?php echo $_SESSION["ADMIN_USER"];?>! 
                       [ <a href="index.php?action=logout" target="_top">
                       <font color="#FF0000"><?php echo lang_show('log_out');?>
                       </font>
                       </a> ]
                        <?php echo lang_show('mangr');?>
                        <?php
                         if($_SESSION["province"]=="")
                            echo lang_show('mgall');
                         else
                            echo $_SESSION["province"].$_SESSION["city"];
                         ?>
                         <a target="_blank" href="<?php echo $config['weburl'];?>">
						 <font color="#FF0000">
						 <?php echo lang_show('siteindex');?>
                         </font>
                         </a>
       </span></td>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td  colspan="2"  valign="middle">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50"><img src="../image/admin/navz.jpg"></td>
    <td width="861" class="dhbj">
    	<ul class="nav">
        <?php
			if(empty($perm))
				$perm=array();
			foreach($mem as $key=>$v)
			{
			 if(in_array(md5($key),$perm)||$_SESSION["ADMIN_USER"]=='admin')
			 {
			 	if(is_array($v[1][0]))
				{
					$i==0;
					if($i==0)
					{
						$curren_key=$key;
						$i=1;
					}
			   		$to_url=@explode(",",$v[1][0]);
				}
			?>
			<li><a id="navKB<?php echo $key;?>" onClick="expandIt('KB<?php echo $key;?>','<?php echo $to_url[0];?>'); return false" href="#"><?php echo $v[0];?></a> </li>
			  <?php
			}}
		?>      
        </ul>
  </td>
  <td background="../image/admin/navkz.jpg">&nbsp;</td>
    <td width="17"><img src="../image/admin/navr.jpg" width="17" height="47"></td>
  </tr>
</table>

	  
	  
	  
    </td>
  </tr>
   <tr>
    <td width="220" align="left" valign="top" style="padding-top:11px;">
    <div class="menu_list">
      <table width="198" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="9"><img src="../image/admin/left_t.jpg"></td>
        </tr>
        <tr>
          <td class="neirong"><?php
foreach($mem as $key=>$v)
{
?>
            <div class="sub" id="KB<?php echo $key;?>" <?php if(!$key){echo 'style="display:block"';}?>>
              <table width="150px"  border="0" cellspacing="0" cellpadding="0" >
                <?php
	//$j=1;
	//print_r($v[1][5]);
	//$t6 = $v[1][6]; 
	//$v[1][6] = $v[1][8];
	//$v[1][8] = $v[1][7];
	//$v[1][7] = $t6;
	foreach($v[1] as $sv)
	{//print_r($sv);
		$bnums=count($v[1]);
		if(is_array($sv))
		{	
			$nums=0;
			foreach($sv[1] as $nvv)
			{
				$u_v=explode(",",$nvv);
				if($u_v[1]==1)
					$nums++;
			}
		//	print_r($sv);
			$i=1;
			echo '<tr><td class="first_menu" colspan=2><img src="../image/admin/icon.jpg" />'.$sv[0].'</td></tr>';			
			foreach($sv[1] as $sub_sv)
			{//print_r($sub_sv);
				if($i==$nums)
					echo list_sub($sub_sv,'sub','last');
				else
					echo list_sub($sub_sv,'sub');
				$i++;
			}
		}
		else
		{
			echo list_sub($sv);
		}
		$j++;
	}
	?>
              </table>
            </div>
            <?php
}
?></td>
        </tr>
        <tr>
          <td height="11"><img src="../image/admin/left_b.jpg"></td>
        </tr>
      </table>
    </div>
   </td>
   
   
   
   
   
   
   
    <td  width="85%" rowspan="2" align="left" valign="top">
   <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td width="5">&nbsp;</td>
    <td height="5" style="background-image:url(../image/admin/ifc.jpg); background-position:0px 5px!important; background-position:0px 5px; background-repeat:repeat-x;">&nbsp;</td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
    
    <table height="95%" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11" style="background-image:url(../image/admin/ifl.jpg); background-position:bottom; background-repeat:no-repeat;">&nbsp;</td>
    <td valign="top" class="nr"><iframe id="main" name="main" width="100%" frameborder="0" height="97%"></iframe>&nbsp;</td>
    <td width="11" style="background-image:url(../image/admin/ifr.jpg); background-position:bottom; background-repeat:no-repeat;">&nbsp;</td>
  </tr>
</table>

    
    
    
    
</td>







  </tr>
</table>
<!-- <script src="<?php echo "http://www.b2b-builder.cn/get_vesion.php?w=$_SERVER[HTTP_HOST]&t=".time();?>"></script> -->
<script>
document.getElementById('main').src='main_index.php';
function expandIt(id,to)
{
	for(i=0;i<8;i++)
	{
		ob="KB"+i;
		var obj=document.getElementById(ob);
		if(obj!="null")
			obj.style.display="none";
		var navd='navKB'+i;
		if(document.getElementById(navd))
		{
			document.getElementById(navd).className='aaa';
			document.getElementById(navd).style.color="#000000";
		}
	}
	document.getElementById(id).style.display="block";
	
	var nd='nav'+id;
	document.getElementById(nd).className='nva_current';
	document.getElementById(nd).style.color="#FFFFFF";
}
expandIt('KB<?php echo $curren_key;?>','');
</script>
</body>
</html>