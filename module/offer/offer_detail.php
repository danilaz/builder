<?php
include_once("$config[webroot]/lang/".$config['language']."/company_type_config.php");
include_once("$config[webroot]/module/offer/includes/offer_class.php");
include_once("includes/plugin_user_class.php");
include_once("config/usergroup.php");
//===================================================
session_start();
if(!empty($_GET["id"])&&is_numeric($_GET["id"]))
	$id=$_GET["id"];
else
	msg($config['weburl'].'/404.php');
//----------------------------------------------------
$offer=new offer();
$de=$offer->shop_info_detail($id);
 foreach($de['pic'] as $k => $v)
    if($v!=0)
      $pics[] = $v;
  $de['pic'] = $pics; 
//print_r($de);
$tpl->assign("reloffer",$offer->company_other_offer($de['userid'],20));
$tpl->assign("sameoffer",$offer->same_cat_offer($de['catid']));
//print_r( $offer->same_cat_offer($de['catid'])); 
//----------------------------------------------------
$ifpay=isset($_SESSION["IFPAY"])?$_SESSION['IFPAY']:2;
if(!empty($group[$ifpay]['modeu']['infotype'])&&in_array($de['type'],explode(",",$group[$ifpay]['modeu']['infotype'])))
	$de['view_right']=true;
else
	$de['view_right']=false;
$tpl->assign("de",$de);
//----------------------------------------------------
$user=new user();
$tpl->assign("cominfo",$user->get_cominfo($de['userid']));
//================导航，keyword，description=================
$guide=$ks=NULL;
$parcat=substr($de['catid'],0,4);
$sql="select catid,cat from ".OCAT." where catid='$parcat'";
$db->query($sql);
$ocats=$db->fetchRow();
$tpl->assign("pcat",$ocats);

if(!empty($ocats['cat']))
{
	$ks.=$ocats['cat'];
	$guide.=" <a href='$config[weburl]/?m=offer&s=offer_list&id=$parcat'>".$ocats['cat']."</a> &raquo; ";
}
$parcat=substr($de['catid'],0,6);
if(strlen($parcat)==6)
{
	$sql="select catid,cat from ".OCAT." where catid='$parcat'";
	$db->query($sql);
	$ocats=$db->fetchRow();
	if(!empty($ocats['cat']))
	{
		$ks.=','.$ocats['cat'];
		$guide.=" <a href='$config[weburl]/?m=offer&s=offer_list&id=$parcat'>".$ocats['cat']."</a> &raquo; ";
	}
}
$parcat=substr($de['catid'],0,8);
if(strlen($parcat)==8)
{
	$sql="select catid,cat from ".OCAT." where catid='$parcat'";
	$db->query($sql);
	$ocats=$db->fetchRow();
	if(!empty($ocats['cat']))
	{
		$ks.=','.$ocats['cat'];
		$guide.=" <a href='$config[weburl]/?m=offer&s=offer_list&id=$de[catid]'>".$ocats['cat']."</a> &raquo; ";
	}
}

$tpl->assign("guide",$guide.$de['title']);
$tpl->assign("province",get_province());
$config['title']=$de['offertype'].' '.$de['title'].'-'.$config['title'];
$config['description']=strip_tags($de['con']);
$config['keyword']=$de['offertype'].$de['title'].','.$de['keywords'].','.$ks;
unset($de);
//-------------------------------------
if(file_exists("$config[webroot]/module/download"))
{
	include_once("$config[webroot]/module/download/includes/plugin_download_class.php");
	$download = new download();
	$downs = $download->offer_down_list($id);
	if($downs!=null)
	{
		include_once("$config[webroot]/module/offer/lang/".$config['language']."/upload.php");
		foreach($downs as $down)
		{
			if(in_array( $down['pic'],array('gif','jpg','jpeg','bmp','png')))
			{
				$down['thumb_img'] = $upload['upload_dir'].'/'.$upload['save_dir'].'/'.$down['file_path'].'/mid_'.$down['file_url'];
			}
			else
			{
				if( is_file($config['webroot'].'/image/default/file_icon/'.$down['pic'].'.png'))
					$down['thumb_img'] = 'image/default/file_icon/'.$down['pic'].'.png';
				else
					$down['thumb_img'] = "image/default/file_icon/file.png";
			}
			$down_list[] = $down;
		}
		$tpl->assign( "attach",$down_list );
	}
}
//---------------------------------------
$tpl->assign("validTime",$validTime);
$tpl->assign("current","offer");
include_once("footer.php");
//======================================
$out=tplfetch("offer_detail.htm");
?>