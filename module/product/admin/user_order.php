<?php
include_once("../includes/page_utf_class.php");
//=======================
$subsql=NULL;
if (!empty($_GET['username']))
{
    $sqlc="select userid from ".ALLUSER." where user='".$_GET['username']."'";
	$db->query($sqlc);
	$us=$db->fetchRow();
    if(!empty($_GET['ordertype'])&&$_GET['ordertype']=='b')
       $subsql.=" and buid='".$us['userid']."'";
	elseif (!empty($_GET['ordertype'])&&$_GET['ordertype']=='s')
	   $subsql.=" and suid='".$us['userid']."'";
	else
       $subsql.=" and ( buid='".$us['userid']."' or suid='".$us['userid']."')";
}
if (!empty($_GET['orderstatus']))
{
	$subsql.=" and status='".$_GET['orderstatus']."'";
}
if (!empty($_GET['usergroup']))
{
   $sqlu="select userid from ".USER." where ifpay='".$_GET['usergroup']."'";
   $db->query($sqlu);
   $uus=$db->getRows();
   $mys=array();
            foreach($uus as $uk)
	          {
              $mys[]=$uk['userid'];
			  }
   $ut=implode(",", $mys);
   if (empty($ut))
	   $ut=0;
   if(!empty($_GET['ordertype'])&&$_GET['ordertype']=='b')
       $subsql.=" and buid in (".$ut.")";
	elseif (!empty($_GET['ordertype'])&&$_GET['ordertype']=='s')
	   $subsql.=" and suid  in (".$ut.")";
	else
       $subsql.=" and ( buid  in (".$ut.") or suid in (".$ut.") )";
}   
$sql="select * from ".ORDER." where 1=1 $subsql  order by id desc";
//=============================
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$db->query($sql);
			$page->totalRows = $db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",20";
		$pages = $page->prompt();
	//=====================
$db->query($sql);
$re=$db->getRows();
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('orderm');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<form method="get" action="" style="margin-top:0px;">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('osearch');?></div>
	<div class="bigboxbody"> 
	  <p style="font-size:12px; padding-left:20px;"><?php echo lang_show('ouname');?>    
	    <input type="text" name="username" id="username" value="<?php echo $_GET['username'];?> "><?php echo lang_show('otype');?> 
	    <select name="ordertype" id="ordertype"> 		    
	      <option value="" selected><?php echo lang_show('otypeall');?></option> 		    
	      <option value="s" <?php if (!empty($_GET['ordertype'])&&$_GET['ordertype']=='s') echo "selected";?>><?php echo lang_show('osell');?></option> 		    
	      <option value="b" <?php if (!empty($_GET['ordertype'])&&$_GET['ordertype']=='b') echo "selected";?>><?php echo lang_show('obuy');?></option> 	      
        </select>                
	    <?php echo lang_show('ostatus');?>     
	    <select name="orderstatus" id="orderstatus">             
	      <option value="" selected><?php echo lang_show('otypeall');?></option> 
		 <?php
		 include("../lang/$config[language]/company_type_config.php");
		 foreach($order_status as $key=>$v)
		 {
		 ?>
          <option value="<?php echo $key;?>" <?php if (!empty($_GET['orderstatus'])&&$_GET['orderstatus']==$key) echo "selected";?>>
		  <?php echo $v;?>
          </option> 
	      <?php } ?>
          
        </select>
<?php echo lang_show('ougroup');?>
<select name="usergroup" id="usergroup">              
  <option value="" selected><?php echo lang_show('otypeall');?></option>            
	<?php
	$sql="select * from ".USERGROUP." order by group_id asc";
	$db->query($sql);
	$usr=$db->getRows();
	foreach($usr as $u)
	  {
   ?>           
  <option value="<?php echo $u['group_id']; ?>" <?php if(!empty($_GET["usergroup"])&&$_GET["usergroup"]==$u['group_id']) echo "selected"; ?>><?php echo $u['name']; ?></option>              
  <?php
              }
           ?>                
</select>
<input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>">                     
<input name="m" type="hidden" value="product">
<input name="s" type="hidden" value="user_order.php">
		</p>
        </pre>
      </p>
    </div></div>
</form>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('oum');?>
</div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="2" cellspacing="0">   
      <tr> 
      <td width="7%" align="center"  ><?php echo lang_show('oid');?></td>
	  <td width="21%"  ><?php echo lang_show('ostatus');?></td>
      <td width="20%" ><?php echo lang_show('obuyer');?></td>
      <td width="32%" ><?php echo lang_show('opname');?></td>
      <td width="11%" align="left" ><?php echo lang_show('otime');?></td>
      <td width="9%" align="center" ><?php echo lang_show('oaction');?></td>
      </tr>
    <?php
	      foreach ($re as $v)
          {
			  $sqls="select a.user,b.company from ".ALLUSER." a, ".USER." b where a.userid=b.userid and b.userid='".$v['buid']."'";
              $db->query($sqls);
		      $b=$db->fetchRow();
	?> 
         <tr> 
         <td width="7%" align="center" ><span ><?php echo $v['id']; ?></span></td>
		 <td width="21%" ><?php echo $order_status[$v['status']]?></td>
         <td ><?php echo $b['company'].$b['user'];?></td>
         <td width="32%" >
         <?php
		 $pd=unserialize($v['product']);
		 echo "Название: ".$pd['pname']."<br>";
		 echo "Цена: ".$pd['pprice'];
		 echo "Количество: ".$pd['nums'];
		 ?>         </td>
         <td width="11%" align="left"><span ><?php echo date("Y-m-d H:i",$v['ordertime']); ?></span></td>
         <td width="9%" align="center"><span ><a href="?m=product&s=order_detail.php&oid=<?php echo $v['id'];?>"><?php echo lang_show('odetail');?></a><br><a href="sendmail.php?userid=<?php echo $v['suid']; ?>">Отправить на email</a>
		</span></td>
      </tr>
    <?php 
    }
	?>
	<td colspan="6" align="right"><div class="page"><?php echo $pages?></div></td>
  </table>
  <div align="right"></div>
  </div>
</div>
</body>
</html>
