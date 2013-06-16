<?php
if(!empty($_GET['tuikuan'])&&!empty($_GET['oid']))
{
	include_once($config['webroot']."/module/product/includes/plugin_order_class.php");
	$order=new order();
	$order->set_order_statu($_GET['oid'],6);
}
if(!empty($_GET['action'])&&$_GET['action']=='cancel'&&!empty($_GET['oid'])&&is_numeric($_GET['oid']))
{
	$sqla="select * from ".ORDER." where id='".$_GET['oid']."'";
	$db->query($sqla);
    $oc=$db->fetchRow();
	if($oc['status']==6)
	{
		$sqlc="select * from ".CASHFLOW." where flowid='".$_GET['oid']."'";
		$db->query($sqlc);
        $f=$db->fetchRow();
		if($f['userid']==$oc['buid'])
		{
		   $cql="update ".ORDER." set status=0 where id='".$_GET['oid']."'";
		   $db->query($cql);
		   $zj=$oc['nums']*$oc['price'];
		   $cql="update ".ALLUSER." set cash=cash+$zj  where userid='".$oc['buid']."'";
		   $db->query($cql);
		   $t=time();
		   $sql="insert into ".CASHFLOW." (`userid`,`amount`,`cashflow_type`,`flowid`,`add_time`,`user_note`,`is_succeed`,`success_time`) values ('$oc[buid]','$zj','order','$_GET[oid]','$t','Order end cash back','1','$t')";
		    $db->query($sql);
		}
	}
}
 $sqld="select * from ".ORDER." where id=".$_GET['oid'];
 $db->query($sqld);
 $od=$db->fetchRow();
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('odetail');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"> <?php echo lang_show('odetail');?></div>
	<div class="bigboxbody">
	  <table width="100%"  border="0" cellspacing="1" cellpadding="6" align="center">
        <tr>
          <td width="114" height="191" ><p><?php echo lang_show('odetail');?></p></td>
          <td width="1165" align="left" valign="top" ><table width="100%" border="0"cellspacing="1" cellpadding="6" bgcolor="#EAEAEA">
              <tr>
                <td width="35%" height="31"><?php echo lang_show('oid');?><?php echo $od['id'];?></td>
                <td width="65%">
				Статус заказа:
                <?php
				include("../lang/$config[language]/company_type_config.php");
				$sta=$od['status'];
				echo $order_status[$sta];
				if($sta==5)
				{
					echo "　<a href='?tuikuan=true&oid=$od[id]'>Подтверждение возврата</a>";
				}
				?>                </td>
              </tr>
              <tr>
                <td height="21" ><?php echo lang_show('otime');?><?php echo date("Y-m-d H:m",$od['ordertime']);?></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td height="21" ><?php echo lang_show('buyername');?><?php echo $od['buyername'];?></td>
                <td ><?php echo lang_show('buyeraddr');?><?php echo $od['buyeraddr'];?></td>
              </tr>
              <tr>
                <td height="25" ><?php echo lang_show('buyertel');?><?php echo $od['buyertel'];?></td>
                <td ><?php echo lang_show('buyerzip');?><?php echo $od['buyerzip'];?></td>
              </tr>
              <tr>
                <td height="46" colspan="2" ><?php echo lang_show('buyerinfo');?><br><?php echo $od['des'];?>
                </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="128" ><?php echo lang_show('pdetail');?></td>
          <td align="left" valign="top" >
          <?php
		 $pd=unserialize($od['product']);
		 echo "Название: <a href='../?m=product&s=product_detail&id=$pd[proid]' target='_blank'>".$pd['pname']."</a><br>";
		 echo "Цена: ".$pd['pprice']."<br>";
		 echo "Количество: ".$pd['nums'];
		  ?>
          </td>
        </tr>
        <tr>
          <td height="152" ><?php echo lang_show('buyinfo');?></td>
          <?php
         $sqlu="select * from ".USER." a left join ".ALLUSER." b on a.userid=b.userid where a.userid=".$od['buid'];
         $db->query($sqlu);
         $oud=$db->fetchRow();
         ?>
          <td align="left" valign="top" ><table width="100%" border="0" cellspacing="0" bgcolor="#EAEAEA">
              <tr>
                <td width="237" height="31">
				<?php echo lang_show('cname');?>
				<a href="<?php echo $config['weburl'];?>/shop.php?uid=<?php echo $oud['userid'];?>" target="_blank" ><?php echo $oud['company'];?></a>
				</td>
                <td width="221"><?php echo lang_show('contact');?><?php echo $oud['contact'];?></td>
                <td width="240"><?php echo lang_show('positon');?><?php echo $oud['position'];?></td>
                <td width="285"><?php echo lang_show('addr');?><?php echo $oud['addr'];?></td>
              </tr>
              <tr>
                <td height="23" ><?php echo lang_show('tel');?><?php echo $oud['tel'];?></td>
                <td ><?php echo lang_show('fax');?><?php echo $oud['fax'];?></td>
                <td ><?php echo lang_show('mobile');?><?php echo $oud['mobile'];?></td>
                <td ><?php echo lang_show('zip');?><?php echo $oud['zip'];?></td>
              </tr>
              <tr>
                <td height="24" ><?php echo lang_show('province');?><?php echo $oud['province'];?></td>
                <td ><?php echo lang_show('city');?><?php echo $oud['city'];?></td>
                <td ><?php echo lang_show('ctype');?><?php echo $oud['ctype'];?></td>
				 <?php
				 $sqlu="select name from ".USERGROUP." where group_id='".$oud['ifpay']."'";
				 $db->query($sqlu);
				 $ouu=$db->fetchRow();
				 ?>
                <td ><?php echo lang_show('ugroup');?><?php echo $ouu['name'];?></td>
              </tr>
              <tr>
                <td height="24" ><?php echo lang_show('curl');?><?php echo $oud['url'];?></td>
                <td >QQ:<?php echo $oud['qq'];?></td>
                <td >MSN:<?php echo $oud['msn'];?></td>
                <td >Skype:<?php echo $oud['skype'];?></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="138" ><?php echo lang_show('sellinfo');?></td>
         <?php
		 $sqlu="select * from ".USER." a left join ".ALLUSER." b on a.userid=b.userid where a.userid=".$od['suid'];
         $db->query($sqlu);
         $oud=$db->fetchRow();
         ?>
          <td align="left" valign="top" ><table width="100%" border="0" cellspacing="0" bgcolor="#EAEAEA">
              <tr>
                <td width="237" height="31"><?php echo lang_show('cname');?><a href="<?php echo $config['weburl'];?>/shop.php?uid=<?php echo $oud['userid'];?>" target="_blank" ><?php echo $oud['company'];?></a></td>
                <td width="221"><?php echo lang_show('contact');?><?php echo $oud['contact'];?></td>
                <td width="240"><?php echo lang_show('positon');?><?php echo $oud['position'];?></td>
                <td width="285"><?php echo lang_show('addr');?><?php echo $oud['addr'];?></td>
              </tr>
              <tr>
                <td height="23" ><?php echo lang_show('tel');?><?php echo $oud['tel'];?></td>
                <td ><?php echo lang_show('fax');?><?php echo $oud['fax'];?></td>
                <td ><?php echo lang_show('mobile');?><?php echo $oud['mobile'];?></td>
                <td ><?php echo lang_show('zip');?><?php echo $oud['zip'];?></td>
              </tr>
              <tr>
                <td height="24" ><?php echo lang_show('province');?><?php echo $oud['province'];?></td>
                <td ><?php echo lang_show('city');?><?php echo $oud['city'];?></td>
                <td ><?php echo lang_show('ctype');?><?php echo $oud['ctype'];?></td>
                <?php
        $sqluu="select name from ".USERGROUP." where group_id='".$oud['ifpay']."'";
         $db->query($sqluu);
         $ouuu=$db->fetchRow();
         ?>
                <td ><?php echo lang_show('ugroup');?><?php echo $ouuu['name'];?></td>
              </tr>
              <tr>
                <td height="24" ><?php echo lang_show('curl');?><?php echo $oud['url'];?></td>
                <td >QQ:<?php echo $oud['qq'];?></td>
                <td >MSN:<?php echo $oud['msn'];?></td>
                <td >Skype:<?php echo $oud['skype'];?></td>
              </tr>
          </table></td>
        </tr>
	</table>
  </div>
</div>
</body>
</html>