<?php
class offer
{
	var $db;
	var $tpl;
	var $page;
	function offer()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
		$this -> cTime  = date("Y-m-d H:i:s");
		if(!empty($_POST))
		{
			include_once($config['webroot'].'/includes/filter_class.php');
			$word=new Text_Filter();
			$_POST['con']=$word->wordsFilter($_POST['con'], $matche_row);
			$_POST['detail']=$word->wordsFilter($_POST['detail'], $matche_row);
			$_POST['title']=$word->wordsFilter($_POST['title'], $matche_row);
		}
	}
	
	function add_info()
	{
		if(empty($_POST['catid'])&&empty($_POST['title'])&&empty($_POST['con']))
			return false;
		global $buid,$config;
		//===================================过滤<a
		include($config['webroot']."/config/usergroup.php");
		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
		$my_group=$group[$ifpay]['modeu'];
		if($my_group['replace_outside_link']==1)
		{
			$_POST["con"]=replace_outside_link($_POST["con"]);
			$_POST["detail"]=replace_outside_link($_POST["detail"]);
		}
		//======================================
		if(empty($_POST['con']))
		   $con=substr(strip_tags($_POST["detail"]),0,100);
		else
		   $con=htmlspecialchars($_POST["con"]);
		   
		$type = $_POST["type"]<1?1:$_POST["type"];
		$title=htmlspecialchars($_POST["title"]);
		$catid=$_POST['catid'];
		if(!empty($_POST['tcatid']))
			$catid=$_POST['tcatid'];
		if(!empty($_POST['scatid']))
			$catid=$_POST['scatid'];
		if(!empty($_POST['sscatid']))
			$catid=$_POST['sscatid'];
		$cpc=$this->get_user_pv($buid);
		$sql="insert into ".INFO."
		(userid,catid,title,con,uptime,statu,price,priceDes,type,model,gg,pp,valid_time,pic,user,keywords,country,province,city,company,ifpay)
		values
		('$buid','$catid','$title','$con','$this->cTime','$my_group[infoCheck]','$_POST[price]','$_POST[unit]','$type','$_POST[model]','$_POST[gg]','$_POST[pinpai]','$_POST[validTime]','$_POST[pic]','$_COOKIE[USER]','$_POST[keyword]','$cpc[country]','$cpc[province]','$cpc[city]','$cpc[company]','$ifpay')";
		$this->db->query($sql);
		$id=$this->db->lastid();
		$this->db->query("INSERT INTO ".OFFERDETAIL." (userid,offerid,detail) values ('$buid','$id','$_POST[detail]')");
		
		update_cat_nums($catid,'add','offer');
		//##======================
		if($_POST['custom_cat'])
		{
			$sql="insert into ".CUSTOM_CAT_REL." (custom_cat_id,custom_cat_type,relating_id) values 
			('$_POST[custom_cat]','2','$id')";
			$re=$this->db->query($sql);
		}
		//##======================
		include_once($config['webroot']."/includes/tag_inc.php");
		add_tags($_POST['keyword'],2,$id);
		include($config['webroot']."/config/point_config.php");
		if($point_config['point']=='1'&&$point_config['add_offer']!='0')
			renew_point('',$point_config['add_offer']);
		return $id;
	}
	function edit_info()
	{
		global $buid,$config;
		
		#过滤<a
		include($config['webroot']."/config/usergroup.php");
		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
		$my_group=$group[$ifpay]['modeu'];
		if($my_group['replace_outside_link']==1)
		{
			$_POST["con"]=replace_outside_link($_POST["con"]);
			$_POST["detail"]=replace_outside_link($_POST["detail"]);
		}
		#过滤<a
		$title=htmlspecialchars($_POST["title"]);
		$con=htmlspecialchars($_POST["con"]);
		
		$catid=$_POST['catid'];
		if(!empty($_POST['tcatid']))
			$catid=$_POST['tcatid'];
		if(!empty($_POST['scatid']))
			$catid=$_POST['scatid'];
		if(!empty($_POST['sscatid']))
			$catid=$_POST['sscatid'];			
		$cpc=$this->get_user_pv($buid);
		$sql="update ".INFO." SET 
		catid='$catid',title='$title',con='$con',
	    price='$_POST[price]',priceDes='$_POST[unit]',type='$_POST[type]',model='$_POST[model]',gg='$_POST[gg]',pp='$_POST[pinpai]',valid_time='$_POST[validTime]',pic='$_POST[pic]',keywords='$_POST[keyword]',country='$_POST[country]',province='$cpc[province]',city='$cpc[city]',company='$_POST[company]',ifpay='$ifpay',uptime='".$this -> cTime."' WHERE id='$_POST[editID]' and userid='$buid'";
		$re=$this->db->query($sql);
		if($re)
		{	
			//##==========================
			$sql="delete from  ".CUSTOM_CAT_REL." where relating_id=$_POST[editID] and custom_cat_type=2";//delete
			$this->db->query($sql);		
			if($_POST['custom_cat'])
			{
				$sql="insert into ".CUSTOM_CAT_REL." (custom_cat_id,custom_cat_type,relating_id) values 
				('$_POST[custom_cat]','2','$_POST[editID]')";
				$re=$this->db->query($sql);
			}	
			//##==========================
			$this->db->query("update ".OFFERDETAIL." set detail='$_POST[detail]' where offerid='$_POST[editID]'");
			include_once($config['webroot']."/includes/tag_inc.php");
			edit_tags($_POST['keyword'],2,$_POST['editID']);
		}
		return true;
	}
	function get_user_pv($userid)
	{
		$sql="select country,province,city,company from ".USER." where userid='$userid'";
		$this->db->query($sql);
		return $this->db->fetchRow();
	}
	function info_list()
	{
		global $buid;
		$sql="select id,type,title,uptime,statu from ".INFO." where userid='$buid' order by uptime desc";
		//=============================
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query("select count(id) as num from ".INFO." where userid='$buid'");
			$num=$this->db->fetchRow();
			$page->totalRows = $num["num"];
		}
        $sql .= "  limit ".$page->firstRow.",20";
		//=====================
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
		$re["page"]=$page->prompt();
		return $re;
	}
	function space_offer_list($catid)
	{
		global $config;
		if(!empty($catid))
		{	
			$sql="select * from ".INFO." a, ".CUSTOM_CAT_REL." b 
				 where a.userid='$_GET[uid]' and a.statu>0 and a.id=b.relating_id and b.custom_cat_type=2 and b.custom_cat_id='$catid'
				 order by uptime desc";
		}
		else
		{
			$sql="select id,`type`,title,con,uptime,userid,user,pic from ".INFO." 
			where userid='$_GET[uid]' order by id desc ";
		}
		//--------------------------------------------------
		include_once($config['webroot']."/includes/page_utf_class.php");
		$page = new Page;
		$page->url="shop.php";
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
		$sql .= "  limit ".$page->firstRow.", ".$page->listRows;
		//--------------------------------------------------
		$this ->db ->query($sql);
		$infoList['list']=$this ->db ->getRows();
		$infoList['page']=$page->prompt();
		return $infoList;
	}
	function del_info($id)
	{
		global $buid,$config;

		include($config['webroot']."/config/point_config.php");
		if($point_config['point']=='1'&&$point_config['del_offer']!='0')
			renew_point('',$point_config['del_offer']);
		
		$this->db->query("select catid from ".INFO." where id='$id'");
		$re=$this->db->fetchRow();
		update_cat_nums($re['catid'],'del','offer');

		$this->db->query("delete from  ".INFO." where id='$id' and userid='$buid'");
		$this->db->query("delete from  ".OFFERDETAIL." where offerid='$id'");
		
		include_once($config['webroot']."/includes/tag_inc.php");
		del_tag($id,2);
	}
	function update_info($id)
	{
		global $buid;
		if($id=="all")
		{
			include("config/point_config.php");
			if($point_config['point']=='1'&&$point_config['renew_offer']!='0')
			renew_point('',$point_config['renew_offer']);
			$sql="update ".INFO." SET uptime='$this->cTime' where userid='$buid'";
		}
		else
			$sql="update ".INFO." SET uptime='$this->cTime' where id='$id'";
		$this->db->query($sql);
	}

	function readCatName($id)
	{
		$this->db->query("select * from ".PCAT." where catid=$id");
		$re=$this->db->fetchRow();
		return $re["cat"];
	}
	function info_detail($id)
	{
		if($id)
		{
			global $config,$buid;
			include_once($config['webroot']."/includes/tag_inc.php");
			$sql="select a.*,b.detail from ".INFO." a left join ".OFFERDETAIL." b on a.id=b.offerid where a.id='$id' and b.userid='$buid'";
			$this->db->query($sql);
			$re=$this->db->fetchRow();
			
			if(strlen($re['catid'])>8)
				$re['sscatid']=$re['catid'];
			
			if(strlen($re['catid'])>6)
				$re['scatid']=substr($re['catid'],0,8);
			
			if(strlen($re['catid'])>4)
				$re['tcatid']=substr($re['catid'],0,6);
			
			$re['catid']=substr($re['catid'],0,4);

			$sql="select custom_cat_id from ".CUSTOM_CAT_REL." where relating_id='$id' and custom_cat_type=2";
			$this->db->query($sql);
			$re['custom_cat_id'] =$this->db->fetchField('custom_cat_id');
			//===============================
			$BasePath = "lib/fckeditor/";
			include($config['webroot']."/$BasePath/fckeditor.php");	
			$fck_en = new FCKeditor('detail') ;
			$fck_en->BasePath    = $BasePath ;
			$fck_en->ToolbarSet  = 'frant' ;
			$fck_en->Width='100%';
			$fck_en->Height=500;
			$fck_en->Config['ToolbarStartExpanded'] = true;
			$fck_en->Value = stripslashes($re['detail']);
			$re['detail'] = $fck_en->CreateHtml();
			$re['keyword']=get_tags($id,2);
			//=================================
			return $re;
		}
	}
	//--------------------------------------
	function company_other_offer($uid,$type=NULL,$limit=NULL)
	{
		if(!empty($limit))
			$sub_sql="limit 0,$limit";
		$sql="select title,id,type from ".INFO." where userid='$uid' $sub_sql";
		$this->db->query($sql);
		return $this->db->getRows();
	}
	//========================
	function same_cat_offer($catid)
	{
		if(!empty($_POST['province']))
			$subsql=" and a.province='$_POST[province]'";

		$sql="select * from ".INFO." a left join ".USER." b on a.userid=b.userid
		 		where 
			  	a.catid='$catid' $subsql order by a.statu ,a.rank desc limit 10";		
		$this->db->query($sql);
		$samepro=$this->db->getRows();
		foreach($samepro as $k=>$v)
		{
			$samepro[$k]['pic']=explode(",",$v['pic']);
		}
		return $samepro;
	}

	//===================================================================
	function shop_info_detail($id)
	{
		if(is_numeric($id))
		{
			global $config;
			include("$config[webroot]/lang/$config[language]/company_type_config.php");
			$sql="select a.*,b.detail from ".INFO." a left join ".OFFERDETAIL." b on a.id=b.offerid 
			      where a.id='$_GET[id]'";
			$this->db->query($sql);
			$info=$this->db->fetchRow();
			//##=========================

			//##=========================
			$info['offertype']=$infoType[$info['type']];
			if(!empty($info['pic']))
                $info['pic']=explode(",",$info['pic']);
			return $info;
		}
		else
		{
			header("Location: 404.php");
		    exit();
		}
	}
	
	function add_attach($offer_id)
	{
		global $config,$upload,$buid;
		if(!empty($_POST['attach_file'])){
			include_once("$config[webroot]/module/download/includes/plugin_download_class.php");
			$download = new download();
			$attachs = $_POST['attach_file'];

			$temp_dir = $config['webroot'].'/'.$upload['upload_dir'].'/'.$upload['temp_dir'];
			$ar=explode( '-',date('Y-m-d H:i:s') );
			$user_dir = $ar[0].'/'.$ar[1].'/'.$buid;
			$save_dir = $config['webroot'].'/'.$upload['upload_dir'].'/'.$upload['save_dir'].'/'.$user_dir; //附件目录
			mkdirs( $save_dir );

			$downs = array();
			foreach( $attachs as $key=>$v){
				$file['file_url'] = $attachs[$key]['url'];
				if( rename( $temp_dir.'/'.$file['file_url'],$save_dir.'/'.$file['file_url'] ) ){
					$file['userid'] = $buid;
					$file['offer_id'] = $offer_id;
					$file['downname'] = $attachs[$key]['name'];
					$file['body'] = $file['downname'];
					$file['pic'] =  preg_replace( '/.*\.(.*[^\.].*)*/iU','\\1',$file['file_url'] );
					if( in_array( $file['pic'],array('gif','jpg','jpeg','bmp','png')) ){
						@rename( $temp_dir.'/'.'mid_'.$file['file_url'],$save_dir.'/mid_'.$file['file_url'] );
					}
					$file['file_path'] = $user_dir;
					$file['file_size'] = $attachs[$key]['size'];
					$file['file_size'] = $file['file_size'] <1024?$file['file_size'].'KB':number_format( $file['file_size']/1024, 2, '.', '').'MB';
					$downs[] = $file;
				}
			}	
			if($downs!=null){
				$download->add_down( $downs );
			}
		}
	}
	//##================================================
	
	function offer_merge_user($array)
	{
		$old_uid=$array['old_uid'];
		$new_uid=$array['new_uid'];

		$sql = "update ".INFO." set userid='$new_uid' where userid='$old_uid'";
		$this->db->query($sql);
		$sql = "update ".OFFERDETAIL." set userid='$new_uid' where userid='$old_uid'";
		$this->db->query($sql);
	}
}
?>
