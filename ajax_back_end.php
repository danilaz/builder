<?php
@set_time_limit(0);
if(!empty($_POST['search_flag'])&&!empty($_POST['key']))
{	
	include_once("includes/global.php");
	$sql="select * from ".SWORD." where keyword like '$_POST[key]%' or char_index like '$_POST[key]%' order by nums desc limit 0,10";
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $v)
	{
		echo "<a onclick=\"select_word('$v[keyword]')\" href='#'>$v[keyword]</a>";
	}
	die;
}
if(!empty($_POST['add_inquery']))
{
	include_once("includes/global.php");
	if($_POST['type']=='com')
	{
		if(!isset($_COOKIE['com_inquery']))
			setcookie("com_inquery",'0'.$_POST['tid']);
		else
			setcookie("com_inquery",$_COOKIE['com_inquery'].=$_POST['tid']);
	}
		
	if($_POST['type']=='pro')
	{
		if(!isset($_COOKIE['pro_inquery']))
			setcookie("pro_inquery",'0'.$_POST['tid']);
		else
			setcookie("pro_inquery",$_COOKIE['pro_inquery'].=$_POST['tid']);
	}	
	if($_POST['type']=='info')
	{
		if(!isset($_COOKIE['info_inquery']))
			setcookie("info_inquery",'0'.$_POST['tid']);
		else
			setcookie("info_inquery",$_COOKIE['info_inquery'].=$_POST['tid']);
	}
	echo $config['language'];die;
}
if(!empty($_POST['catid'])&&$_POST['gettype']='samepro')
{
	include_once("includes/global.php");
	include_once("module/product/includes/plugin_pro_class.php");
	$prodetail=new pro();
	$de=$prodetail->same_cat_product($_POST['catid']);
	$table=NULL;
	foreach($de as $v)
	{
		$url=geturl('prod',$v['userid'],$v['user'],$v['id']);
		$table.='<tr>
				<td>
					<a href="'.$url.'"><b>'.csubstr($v['pname'],0,20).'</b></a>
				</td>
				<td width="50">['.$v['province'].']</td>
			  </tr>
			   <tr>
				<td colspan="2" class="line">
				'.csubstr($v['company'],0,24).'<br>'.$v['tel'].'
				</td>
			  </tr>
			  ';
	}
	echo $table='<table width="100%" border="0" cellspacing="0" cellpadding="0">'.$table.'</table>';
	die;
}
//=======================================
if(isset($_FILES["Filedata"])&&is_uploaded_file($_FILES["Filedata"]["tmp_name"])&&$_FILES["Filedata"]["error"] == 0)
{
	$ar=explode('.',$_FILES["Filedata"]["name"]); 
	$num=count($ar)-1;
	if($ar[$num]=='swf')
		$name='temp_'.time().".swf";
	else
		$name='temp_'.time().".flv";
	@copy($_FILES['Filedata']['tmp_name'],"uploadfile/video/".$name);
	echo $name;
	die;
}
//==========================================add fav
if(!empty($_POST['user'])&&!empty($_POST['type'])&&!empty($_POST['url'])&&!empty($_POST['title'])&&!empty($_POST['fid']))
{
	include_once("includes/global.php");
	$csql="select userid from ".ALLUSER." where user='".$_POST['user']."'";
    $db->query($csql);
	$rs=$db->fetchRow();
	$uid=$rs['userid'];
	$csql="select id from ".FAVORITE." where userid=".$uid." and type='".$_POST['type']."' and url='".$_POST['url']."'";
    $db->query($csql);
    if($db->num_rows()<=0)
	{
		$mtp=$_POST['type'];
		$murl=$_POST['url'];
		$mt=$_POST['title'];
		$fid=$_POST['fid'];
		if (!empty($_POST['picurl']))
		   $picu=$_POST['picurl'];
		else
		   $picu='';
		if (!empty($_POST['des']))
		   $mdes=$_POST['des'];
		else
		   $mdes='';
		$tm=time();
		$sql="insert into ".FAVORITE." (userid,fromid,type,url,title,picurl,des,uptime) VALUES ('$uid','$fid','$mtp','$murl','$mt','$picu','$mdes','$tm')"; 
		$db->query($sql);
		die('2');
	}
	else
		die('1');
}

if(!empty($_GET['get_index_cat']))
{
	$_GET['get_index_cat']=basename($_GET['get_index_cat']);
	if(file_exists("config/index_cat/".$_GET['get_index_cat']))
	{
		include_once("includes/global.php");
		include_once("config/index_cat/".$_GET['get_index_cat']);
		foreach($cats as $v)
		{
			echo "<li onmouseover=\"$('ajax_cat').style.display='block';\">
			<a href='$config[weburl]/?m=offer&s=offer_list&id=$v[catid]'> $v[cat] </a> </li>";
		}
	}
	die();
}

if(isset($_POST["wtyz"])&&$_POST["wtyz"]=='1')
{	
	session_start();
	include_once("includes/global.php");
	$sql="select * from ".REGVERFCODE." order by rand() limit 0,1";
	$db->query($sql);
	$re=$db->fetchRow();
	echo $re['question'];
	$_SESSION['YZWT']=$re['answer'];
}

if(isset($_POST["ckyzwt"]))
{	
	session_start();
	if($_POST["ckyzwt"]==$_SESSION['YZWT'])
		echo "true";
	else
		echo "false";
}

if(isset($_POST["prov_id"]))
{	
	include_once("includes/global.php");
	$sql="select city_id,city from ".CITY." a, ".PROVINCE." b where a.province_id=b.province_id and b.province='$_POST[prov_id]' order by a.city";
	$db->query($sql);
	$num=$db->num_rows();
	$str="{";
	$i=0;
	while($k=$db->fetchRow())
	{
		$i++;
		$city_id=$k["city"];
		//$city=$k["city"];
		if($i<$num)
			$str.="'$i':{'0':'$city_id','1':'$city_id'},";
		else
			$str.="'$i':{'0':'$city_id','1':'$city_id'}";
	}
	//------------------------------------------------------------
	$str.="};";
	echo $str;
}
if(isset($_POST["country_id"]))
{	
	include_once("includes/global.php");
	$sql="select a.province_id,a.province from ".PROVINCE." a, ".COUNTRY." b where a.country_id=b.id and b.id='$_POST[country_id]' ORDER BY a.province";
	$db->query($sql);
	$num=$db->num_rows();
	$str="{";
	$i=0;
	while($k=$db->fetchRow())
	{
		$i++;
		$province_id=$k["province_id"];
		$province_name=$k["province"];
		//$city=$k["city"];
		if($i<$num)
			$str.="\"$i\":{\"0\":\"$province_id\",\"1\":\"$province_name\"},";
		else
			$str.="\"$i\":{\"0\":\"$province_id\",\"1\":\"$province_name\"}";
	}
	//------------------------------------------------------------
	$str.="};";
	echo $str;
}
if(isset($_POST["catid"]))
{
	include_once("includes/global.php");
	$i=0;
	$s=$_POST["catid"]."00";
	$b=$_POST["catid"]."99";
	$db->query("SELECT * FROM ".COMPANYCAT." WHERE catid>=$s and catid<=$b ORDER BY nums ASC");
	$num=$db->num_rows();
	$str="{";
	while($k=$db->fetchRow())
	{
		$i++;
		$catid=$k["catid"];
		$cat=$k["cat"];
		if($i<$num)
			$str.="\"$i\":{\"0\":\"$catid\",\"1\":\"$cat\"},";
		else
			$str.="\"$i\":{\"0\":\"$catid\",\"1\":\"$cat\"}";
	}
	//------------------------------------------------------------
	$str.="};";
	echo $str;
}
if(!empty($_POST["pcatid"]))
{
	include_once("includes/global.php");
	if(!empty($_POST['cattype'])&&$_POST['cattype']=='hr')
		$db->query("select catname as cat,id as catid from ".HRCAT." where pid='$_POST[pcatid]' order by posid");
	if(!empty($_POST['cattype'])&&$_POST['cattype']=='quoted_price')
		$db->query("select catname as cat,id as catid from ".QPCAT." where pid='$_POST[pcatid]' order by posid");
		
	$s=$_POST["pcatid"]."00";$b=$_POST["pcatid"]."99";
	if(!empty($_POST['cattype'])&&$_POST['cattype']=='offer')
		$db->query("SELECT * FROM ".OCAT." WHERE catid>'$s' and catid<'$b' ORDER BY nums ASC");
	if(!empty($_POST['cattype'])&&$_POST['cattype']=='pro')
		$db->query("SELECT * FROM ".PCAT." WHERE catid>'$s' and catid<'$b' ORDER BY nums ASC");
	if(!empty($_POST['cattype'])&&$_POST['cattype']=='album')
		$db->query("SELECT * FROM ".ALBUMCAT." WHERE catid>'$s' and catid<'$b' ORDER BY nums ASC");
	if(!empty($_POST['cattype'])&&$_POST['cattype']=='com')
		$db->query("SELECT * FROM ".COMPANYCAT." WHERE catid>'$s' and catid<'$b' ORDER BY nums ASC");
	if(!empty($_POST['cattype'])&&$_POST['cattype']=='proj')
		$db->query("SELECT * FROM ".PRCAT." WHERE catid>'$s' and catid<'$b' ORDER BY nums ASC");
	$num=$db->num_rows();
	$str="{";
	$i=0;
	while($k=$db->fetchRow())
	{
		$i++;
		$city_id=$k["catid"];
		$cat=str_replace("\r",'',$k['cat']);
		if($i<$num)
			$str.="\"$i\":{\"0\":\"$city_id\",\"1\":\"$cat\"},";
		else
			$str.="\"$i\":{\"0\":\"$city_id\",\"1\":\"$cat\"}";
	}
	$str.="};";
	echo $str;
}
//-------ask-----------------
if(!empty($_POST["asktype"]))
{
	include_once("includes/global.php");
	$s=$_POST["asktype"]."00";
	$b=$_POST["asktype"]."99";
	$db->query("SELECT * FROM ".PCAT." WHERE catid>'$s' and catid<'$b' ORDER BY nums ASC");
	$num=$db->num_rows();
	$str="{";
	$i=0;
	while($k=$db->fetchRow())
	{
		$i++;
		$city_id=$k["catid"];
		$cat=$k["cat"];
		if($i<$num)
			$str.="\"$i\":{\"0\":\"$city_id\",\"1\":\"$cat\"},";
		else
			$str.="\"$i\":{\"0\":\"$city_id\",\"1\":\"$cat\"}";
	}
	$str.="};";
	echo $str;
}
if(isset($_GET["yzm"]))
{
	session_start();
	if(strtolower($_GET["yzm"])!=strtolower($_SESSION["auth"]))
	{
		echo 1;
	}
}

if(isset($_GET['user']))
{
	include_once("includes/global.php");
	include_once("config/reg_config.php");
	$config = array_merge($config,$reg_config);
	$un=trim($_GET['user']);
	$sql="select * from ".RESERVE_USERNAME." where username='$un'"; 
	$db->query($sql);
	if($db->num_rows()>0)
	{
		echo 1;
	}
	else
	{
	    if(!empty($config['openbbs'])&&$config['openbbs']==2)
	    {
			$sql="select * from ".ALLUSER." where user='$un'";
		    $db->query($sql);
		    $bbnum=$db->num_rows();
			
			include_once('uc_client/client.php');
		    if(uc_user_checkname($un)==1&&!$bbnum)
			    echo 0;//成功
		    else
			    echo 1;//失败
	    }
	    else
	    {
		    $sql="select * from ".ALLUSER." where user='$un'";
		    $db->query($sql);
		    if($db->num_rows()>0)
			   echo 1;//失败
		    else
			   echo 0;//成功
	    }
	}
}
?>