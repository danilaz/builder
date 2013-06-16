<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/demand/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/demand/lang/".$config['language']."/upload.php");
include_once("$config[webroot]/module/demand/includes/demand_class.php");
$demand=new demand();
//============================================================
if(!empty($submit)&&empty($_POST['editID']))
{	
	$admin->check_access('demand');
	include_once("$config[webroot]/module/product/includes/plugin_pro_class.php");
	$pro=new pro();
	//##===============
	$pactidlist=!empty($_POST['catid'])?$_POST['catid']:NULL;
	if(!empty($_POST['tcatid']))
		$pactidlist.= ",".$_POST['tcatid'];
	if(!empty($_POST['scatid']))
		$pactidlist.=",".$_POST['scatid'];
	if(!empty($_POST['sscatid']))
		$pactidlist.=",".$_POST['sscatid'];
	$pro->add_user_common_cat($pactidlist); //增加会员常用类别
	//###===============
	$demand_id = $demand->add_info();
	if($demand_id){

		//添加附件
		if(!empty($_POST['attach_file']))
			$demand->add_attach($demand_id);
		
		if( $_POST['type']=='0'&&is_numeric($_POST['price'])&&$_POST['price']>0 )
		{	
			$pro->add_pro();
			msg("main.php?action=m&m=product&s=admin_product_list&menu=info&menu=info");
		}else
			msg("main.php?action=m&m=demand&s=admin_demand_list&menu=info&menu=info");
	}
}

if(isset($_POST['editID']))
{
	$re=$demand->edit_info();
	if(file_exists("$config[webroot]/module/download")){
		//-------------------------------------
		include_once("$config[webroot]/module/download/includes/plugin_download_class.php");
		$download = new download();

		if(isset($_POST['edit_file_id']))
			$downs = $download->demand_down_list( $_POST['editID'],$_POST['edit_file_id'] );
		else
			$downs = $download->demand_down_list( $_POST['editID'] );

		if($downs!=null){
			foreach($downs as $down)
			{
				$ides[] = $down['id'];
				$del_file[] = $upload['upload_dir'].'/'.$upload['save_dir'].'/'.$down['file_path'].'/'.$down['file_url'];
			}
			$download->dele_downs( $ides );
			foreach($del_file as $durl){
				@unlink("$config[webroot]/$durl");
			}
		}

		if(!empty($_POST['attach_file'])){
			$demand->add_attach( $_POST['editID'] );
		}
		//-----------------------------------------

	}
	if($re)
		msg("main.php?action=m&m=demand&s=admin_demand_list&menu=info&menu=info");
}

if(isset($_GET['edit']))
{
	include_once("$config[webroot]/module/product/includes/plugin_pro_class.php");
	include_once("$config[webroot]/module/product/includes/plugin_add_field_class.php");
	$pro=new pro();
	$addfield = new AddField();

	$tpl->assign("de",$de = $demand->info_detail($_GET['edit']));
	//#======================
	$pactidlist=$de['catid'];
	if(!empty($de['tcatid']))
		$pactidlist.=",".$de['tcatid'];
	if(!empty($de['scatid']))
		$pactidlist.=",".$de['scatid'];	
	if(!empty($de['sscatid']))
		$pactidlist.=",".$de['sscatid'];
	$pro->add_user_common_cat($pactidlist);//增加会员常用类别
	$tpl->assign("typenames",$pro->getProTypeName($pactidlist)); 
	$tpl->assign("firstvalue",$addfield->addfieldinput($_GET['edit'],$pactidlist));
	$tpl->assign("brand",$pro->get_brand($pactidlist,$de['pp']));
	//##==============================
	if(file_exists("$config[webroot]/module/download/")){
		include_once("$config[webroot]/module/download/includes/plugin_download_class.php"); 
		$download = new download(); 
		$downs = $download->demand_down_list( $_GET['edit'] ); 
		if($downs!=null){
			foreach($downs as $down)
			{
				if(in_array( $down['pic'],array('gif','jpg','jpeg','bmp','png'))){
					$down['thumb_img'] = $upload['upload_dir'].'/'.$upload['save_dir'].'/'.$down['file_path'].'/mid_'.$down['file_url'];
				}else{
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
	//================================
}

$tpl->assign("cat",$admin->getCatName(OCAT));

include_once("$config[webroot]/lang/".$config['language']."/company_type_config.php");
$tpl->assign("infoType",$infoType);
$admin->check_myshop();
//==================================
$tpl->assign("ptype",$ptype);
$tpl->assign("trade_type",$trade_type);
$tpl->assign("unit",$unit);
$tpl->assign("validTime",$validTime);
$tpl->assign("prov",get_province());
$tpl->assign("custom_cat",$admin->get_custom_cat_list(1,0));

$tpl->assign( "upload",$upload  );
//====================================

$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$tpl->assign( "add_attach",$re=file_exists("$config[webroot]/module/download")?1:0 );
$output=tplfetch("admin_demand.htm");
?>