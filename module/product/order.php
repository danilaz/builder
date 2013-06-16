<?php
if(!empty($_POST['obutton']))
{
	if(!empty($_POST['suid'])&&$_POST['price']*1>0&&!empty($_POST['proid'])&&!empty($_POST['nums'])&&!empty($_POST['buyername'])&&!empty($_POST['buyertel'])&&!empty($_POST['buyeraddr'])&&!empty($_POST['buyerzip']))
	{
		$tm=time();
		$_POST['freight_type']=empty($_POST['freight_type'])?0:$_POST['freight_type'];
		$product['proid']=$_POST['proid'];
		$product['pname']=$_POST['pname'];
		$product['pprice']=$_POST['pprice'];
		$product['nums']=$_POST['nums'];
		$product=serialize($product);
		$_POST['buyerzip']*=1;
		$_POST['freight_type']*=1;
		$_POST['price']*=1;
		$_POST[freight_price]*=1;
		
	   $sql="insert into ".ORDER." (buid,suid,product,price,ordertime,status,buyername,buyertel,buyeraddr,buyerzip,des,freight_type,freight_price,uptime) 
	   VALUES 
	   ('$buid','$_POST[suid]','$product','$_POST[price]','$tm',1,'$_POST[buyername]','$_POST[buyertel]','$_POST[buyeraddr]','$_POST[buyerzip]','$_POST[des]','$_POST[freight_type]','$_POST[freight_price]',$tm)"; 
	   $db->query($sql);
	   $id=$db->lastid();
	   
		//--------------------send sort mail---
		$date=date("Y-m-d H:i");
		$sql="insert into ".FEEDBACK." (touserid,fromuserid,fromInfo,sub,con,date)
				VALUES
				('$_POST[suid]','$buid','','New order','New order','$date')";
		$db->query($sql);
		//-------------------------------------
		msg('main.php?action=m&m=product&s=admin_orderdetail&type=buy&menu=trade&id='.$id);//成功，转到详情页
	}
	else
		msg($config['weburl'].'/?m=product&s=order&id='.$_GET['id'].'&nums='.$_GET['nums'].'&erroy=2');//参数不完整
}
//==============================================
if(empty($_GET['erroy']))
{
	if(!is_numeric($_GET['id'])||!is_numeric($_GET['nums']))
		die('Invalid URL !');//参数错误
	if(empty($buid))
		msg("login.php?forward=".urlencode("index.php?m=product&s=product_detail&id=$_GET[id]"));//没有登录
	else
	{
		$db->query("select *  from ".USER." where userid='$buid'");
		$buyinfo=$db->fetchRow();
		$tpl->assign("buyinfo",$buyinfo);
	}
	$sql="select * from ".PRO." a,".USER." b where a.userid=b.userid and a.id='$_GET[id]'";
	$db->query($sql);
	$info=$db->fetchRow();
	if(!empty($info['id']))
	{
		$info['freight']=explode(",",$info['freight']);	
		$tpl->assign("orderd",$info);
	}
	else
		msg('404.php');//产品不存在
}
$tpl->assign("current","product");
include_once("footer.php");
$out=tplfetch("order.htm");

$tpl->assign("out",$out);
$sql="SELECT * FROM ".PCAT." WHERE catid<9999 ORDER BY nums asc,char_index";
$db->query($sql);
$re=$db->getRows();
foreach($re as $key=>$v)
{
	 $re[$key]["sub"] = readsubcat($v["catid"]);
}
$tpl->assign("cat",$re);
tplfetch("shop.htm",null,true);
?>