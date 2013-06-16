<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("config/usergroup.php");
include_once("lang/".$config['language']."/company_type_config.php");
//===================================================================
$firstRow=!empty($_GET["firstRow"])?$_GET["firstRow"]:NULL;
$totalRows=!empty($_GET["totalRows"])?$_GET["totalRows"]:NULL;
if($_GET['m'] == 'demand') $m = 'demand';
else $m = 'offer';

$_GET['kwords'] = strtolower($_GET['kwords']);
//echo $_GET['kwords'] ;
//$config['table_pre'].$m

if(!empty($_GET['searchtype'])&&is_numeric($_GET['searchtype']))
     $stype=$_GET['searchtype'];
else
     header("Location: search.php");
//==================================================================
    if($stype==1)
    {
	   $sub_sql='';
	   if(!empty($_GET['catid']))
				$sub_sql=" and left(b.catid,4)='".$_GET['catid']."'";
	   if(!empty($_GET['tcatid']))
				$sub_sql=" and left(b.catid,6)='".$_GET['tcatid']."'";
	   if(!empty($_GET['scatid']))
				$sub_sql=" and b.catid='".$_GET['scatid']."'";
	   //==================================
	   if(!empty($_GET['kwords']))
				$sub_sql.=" and lower(b.title) like '%".$_GET['kwords']."%'";
	   //======================================
	   if(!empty($_GET['country']))
				$ssql="and country='".$_GET['country']."'";
	   if(!empty($_GET['province1']))
				$ssql="and province='".$_GET['province1']."'";
	   if(!empty($_GET['city1']))
				$ssql="and city='".$_GET['city1']."'";
	   if(!empty($_GET['province']))
				$ssql="and province='".$_GET['province']."'";
	   if(!empty($_GET['city1']))
				$ssql="and city='".$_GET['city']."'";
	   if(empty($ssql))
				$ssql='';
	   $sql="select distinct userid from ".USER." where 1 $ssql";
	   $db->query($sql);
	   $re=$db->getRows();
		$usid='';
	   foreach($re as $v)
	   {
		   $usid.=$v['userid'].',';
	    }
	   if(!empty($usid))
			$sub_sql.=' and b.userid in ('.$usid.'0)';
	   //======================================
		if(!empty($_GET['stime']))
				$sub_sql.=" and  UNIX_TIMESTAMP(b.uptime)>".strtotime($_GET['stime']);
		if(!empty($_GET['etime']))
				$sub_sql.=" and  UNIX_TIMESTAMP(b.uptime)<".strtotime($_GET['etime']);
		//=======================================
       if(!empty($_GET['infotype']))
				$sub_sql.=" and  b.type='".$_GET['infotype']."'";
	   //============================
	   if(!empty($_GET['usergroup']))
	  {
			$ssql="select distinct userid from ".USER." where ifpay=".$_GET['usergroup'];
			$db->query($ssql);
			$re=$db->getRows();
			$gusid='';
			foreach($re as $v)
			{
				$gusid.=$v['userid'].',';
			}
			if(!empty($gusid))
				$sub_sql.=' and b.userid in ('.$gusid.'0)';
	  }
	   //============================
      if(!empty($_GET['pic']))
	  {
		       if($_GET['pic']==1)
					$sub_sql.=" and  b.pic!='' ";
	           else
					$sub_sql.=" and  b.pic='' ";
	  }
      //============================
       if(!empty($_GET['minprice']))
				$sub_sql.=" and b.price>=".$_GET['minprice'];
	   if(!empty($_GET['maxprice']))
				$sub_sql.=" and b.price<=".$_GET['maxprice'];
	   //==============================
        if(!empty($_GET['ordertype']))
	   {
				if($_GET['ordertype']==1)
						$o_sql=" order by b.price desc";
				if($_GET['ordertype']==2)
						$o_sql=" order by b.price";
				if($_GET['ordertype']==3)
						$o_sql=" order by a.ifpay desc";
				if($_GET['ordertype']==4)
						$o_sql=" order by a.ifpay";
				if($_GET['ordertype']==5)
						$o_sql=" order by b.rank desc";
				if($_GET['ordertype']==6)
						$o_sql=" order by b.rank";
				if(!empty($o_sql))
					$sub_sql.=$o_sql;
	   }

			include_once("includes/page_utf_class.php");
			$page = new Page;
			$page->listRows=10;
	   if (!$page->__get('totalRows'))
		{
				$db->query("select b.id from ". $config['table_pre'].$m ." b left join ".USER." a on b.userid=a.userid where b.statu>0 $sub_sql");
				$page->totalRows =$db->num_rows();
		}
		$sql="select b.*,a.ifpay,a.company,b.province,b.city from ". $config['table_pre'].$m ." b left join ".USER." a on b.userid=a.userid where b.statu>0 $sub_sql";
	    $sql.=" limit ".$page->firstRow.", ".$page->listRows;
	   	$db->query($sql);
	    while($pl=$db->fetchRow())
	    {
		   $ifpay=!empty($pl['ifpay'])?$pl['ifpay']:1;
		   if(!empty($group[$ifpay]['minilogo']))
			    $pl['user_type']="<img height=20 src='".$group[$ifpay]['minilogo']."' >";
		    $infolist['list'][]=$pl;
	     }
	     $infolist['page']=$page->prompt();
	     $tpl->assign("info",$infolist);
	     $tpl->assign("infotype",$infoType);
	   //=====
	   $tpl->assign("current",$m);
    }
    if($stype==2)
    {
	   	   $sub_sql='';
	   if(!empty($_GET['catid']))
				$sub_sql=" and left(b.catid,4)='".$_GET['catid']."'";
	   if(!empty($_GET['tcatid']))
				$sub_sql=" and left(b.catid,6)='".$_GET['tcatid']."'";
	   if(!empty($_GET['scatid']))
				$sub_sql=" and b.catid='".$_GET['scatid']."'";
	   //==================================
	   if(!empty($_GET['kwords']))
				$sub_sql.=" and lower(b.pname) like '%".$_GET['kwords']."%'";
	   //==================================
	   if(!empty($_GET['country']))
				$ssql="and country='".$_GET['country']."'";
	   if(!empty($_GET['province1']))
				$ssql="and province='".$_GET['province1']."'";
	   if(!empty($_GET['city1']))
				$ssql="and city='".$_GET['city1']."'";
	   if(!empty($_GET['province']))
				$ssql="and province='".$_GET['province']."'";
	   if(!empty($_GET['city1']))
				$ssql="and city='".$_GET['city']."'";
	   if(empty($ssql))
				$ssql='';
				
     $sql="select distinct userid from ".USER." where 1 $ssql";
	   /*$sql="select distinct u.userid, c.flag from ".USER." u
       left join ".COUNTRY." c on u.country=c.id 
       where 1 $ssql";*/
       
	   $db->query($sql);
	   $re=$db->getRows();
		$usid='';
	   foreach($re as $v)
	   {
		   $usid.=$v['userid'].',';
	    }
	   if(!empty($usid))
			$sub_sql.=' and b.userid in ('.$usid.'0)';
	   //======================================
		if(!empty($_GET['stime']))
				$sub_sql.=" and  UNIX_TIMESTAMP(b.uptime)>".strtotime($_GET['stime']);
		if(!empty($_GET['etime']))
				$sub_sql.=" and  UNIX_TIMESTAMP(b.uptime)<".strtotime($_GET['etime']);
		//=======================================
       if(!empty($_GET['infotype']))
				$sub_sql.=" and  b.trade_type='".$_GET['infotype']."'";
	   //============================
	   if(!empty($_GET['usergroup']))
	  {
				$ssql="select distinct userid from ".USER." where ifpay=".$_GET['usergroup'];
				$db->query($ssql);
				$re=$db->getRows();
				$gusid='';
				foreach($re as $v)
				{
					$gusid.=$v['userid'].',';
				}
				if(!empty($gusid))
					$sub_sql.=' and b.userid in ('.$gusid.'0)';
	  }
	   //============================
      if(!empty($_GET['pic']))
	  {
		       if($_GET['pic']==1)
					$sub_sql.=" and  b.pic!='' ";
	           else
					$sub_sql.=" and  b.pic='' ";
	  }
      //============================
       if(!empty($_GET['minprice']))
				$sub_sql.=" and b.price>=".$_GET['minprice'];
	   if(!empty($_GET['maxprice']))
				$sub_sql.=" and b.price<=".$_GET['maxprice'];
	   //==============================
        if(!empty($_GET['ordertype']))
	   {
				if($_GET['ordertype']==1)
						$o_sql=" order by b.price desc";
				if($_GET['ordertype']==2)
						$o_sql=" order by b.price";
				if($_GET['ordertype']==3)
						$o_sql=" order by a.ifpay desc";
				if($_GET['ordertype']==4)
						$o_sql=" order by a.ifpay";
				if($_GET['ordertype']==5)
						$o_sql=" order by b.rank desc";
				if($_GET['ordertype']==6)
						$o_sql=" order by b.rank";
				if(!empty($o_sql))
					$sub_sql.=$o_sql;
	   }

			include_once("includes/page_utf_class.php");
			$page = new Page;
	   $page->listRows=10;
	   if (!$page->__get('totalRows'))
		{
				$db->query("select b.id from ".PRO." b left join ".USER." a on b.userid=a.userid where b.statu>0 $sub_sql");
				$page->totalRows =$db->num_rows();
		}
		$sql="select b.*,a.ifpay,a.company,b.province,b.city from ".PRO." b left join ".USER." a on b.userid=a.userid where b.statu>0 $sub_sql";
	    $sql.=" limit ".$page->firstRow.", ".$page->listRows;
	   	$db->query($sql);
	    while($pl=$db->fetchRow())
	    {
		   $ifpay=!empty($pl['ifpay'])?$pl['ifpay']:1;
		   if(!empty($group[$ifpay]['minilogo']))
			    $pl['user_type']="<img height=20 src='".$group[$ifpay]['minilogo']."' >";
			$pl['img']="uploadfile/comimg/small/$pl[id].jpg";
		    $infolist['list'][]=$pl;
	     }
	     $infolist['page']=$page->prompt();
	     $tpl->assign("info",$infolist);
	   //=====
	   $tpl->assign("current","product");
   }
   if($stype==3)
   {
	   $sub_sql='';
	   if(!empty($_GET['catid']))
				$sub_sql=" and b.catid like '%".$_GET['catid']."%'";
	   if(!empty($_GET['tcatid']))
				$sub_sql=" and b.catid,6 like '%".$_GET['tcatid']."%'";
	   if(!empty($_GET['scatid']))
				$sub_sql=" and b.catid like '%".$_GET['scatid']."%'";
	   //==================================
	   if(!empty($_GET['kwords']))
				$sub_sql.=" and lower(b.company) like '%".$_GET['kwords']."%'";
	   //==================================
	   if(!empty($_GET['country']))
				$sub_sql.="and b.country='".$_GET['country']."'";
	   if(!empty($_GET['province1']))
				$sub_sql.="and b.province='".$_GET['province1']."'";
	   if(!empty($_GET['city1']))
				$sub_sql.="and b.city='".$_GET['city1']."'";
	   if(!empty($_GET['province']))
				$sub_sql.="and b.province='".$_GET['province']."'";
	   if(!empty($_GET['city1']))
				$sub_sql.="and b.city='".$_GET['city']."'";
	   if(empty($ssql))
				$ssql='';
		//=======================================
       if(!empty($_GET['infotype']))
				$sub_sql.=" and b.ctype='".$_GET['infotype']."'";
	   //============================
	   if(!empty($_GET['usergroup']))
				$sub_sql.=" and b.ifpay='".$_GET['usergroup']."'";
	   //============================
        if(!empty($_GET['ordertype']))
	   {
				if($_GET['ordertype']==1)
						$o_sql=" order by b.ifpay desc";
				if($_GET['ordertype']==2)
						$o_sql=" order by b.ifpay";
				if($_GET['ordertype']==3)
						$o_sql=" order by b.rank desc";
				if($_GET['ordertype']==4)
						$o_sql=" order by b.rank";
				if($_GET['ordertype']==5)
						$o_sql=" order by a.point desc";
				if($_GET['ordertype']==6)
						$o_sql=" order by a.point";
				if(!empty($o_sql))
					$sub_sql.=$o_sql;
	   }
		include_once("includes/page_utf_class.php");
		$page = new Page;
	   $page->listRows=10;
	   if (!$page->__get('totalRows'))
		{
				$db->query("select * from ".ALLUSER." a,".USER." b  where a.userid=b.userid  $sub_sql");
				$page->totalRows =$db->num_rows();
		}
		
		$sql="select *,c.flag as 'country' from ".ALLUSER." a , ".USER." b 
		 left join ".COUNTRY." c on b.country=c.id 
		 where  b.userid=a.userid  $sub_sql";
		//$sql="select * from ".ALLUSER." a , ".USER." b  where  b.userid=a.userid  $sub_sql";
	  /*$sql="
		 select *, c.flag
		 from ".ALLUSER." a , ".USER." b  
		 left join ".COUNTRY." c on b.country=c.id 
		 where  b.userid=a.userid  $sub_sql"; 
	    */
	    $sql.=" limit ".$page->firstRow.", ".$page->listRows;
	   	$db->query($sql);
	    while($pl=$db->fetchRow())
	    {
		   $ifpay=$pl['ifpay'];
		   if(!empty($group[$ifpay]['minilogo']))
			  $pl['user_type']="<img height=20 src='".$group[$ifpay]['minilogo']."' >";
		   $infolist['list'][]=$pl;
	     }
	     $infolist['page']=$page->prompt();
	     $tpl->assign("info",$infolist);
	   //=====
	   $tpl->assign("current","company");
   }
   
//============================================================================================
if($stype==1)
{
	include_once("module/".$m."/lang/".$config['language']."/".$m."_list.php");
	$page="search_".$m."_list.htm";
}
elseif($stype==3)
{
	include_once("module/company/lang/".$config['language']."/company_list.php");
	$page="search_company_list.htm";
}
else
{
	include_once("module/product/lang/".$config['language']."/product_list.php");
	$page="search_product_list.htm";
}
include_once("footer.php");
$tpl->display($page);
?>