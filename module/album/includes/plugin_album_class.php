<?php
class album
{
	var $db;
	var $tpl;
	var $page;
	function album()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	function add_album_cat()
	{
		global $buid,$config;
		$catid=$_POST['catid'];
		if(!empty($_POST['tcatid']))
			$catid=$_POST['tcatid'];
		if(!empty($_POST['scatid']))
			$catid=$_POST['scatid'];
		if(empty($catid))
			$catid=0;
		$sql="insert into ".CUSTOM_CAT." (userid,sys_cat,name,type,des) 
				values ('$buid','$catid','$_POST[name]','6','$_POST[des]')";
		$re=$this->db->query($sql);
		if(is_uploaded_file($_FILES['pic']['tmp_name']))
		{	
			$id=$this->db->lastid();
			$save_directory = $config['webroot']."/uploadfile/catimg/";
			makethumb($_FILES['pic']['tmp_name'] , $save_directory.$id.".jpg" , 500 , 500);
			makethumb($_FILES['pic']['tmp_name'] , $save_directory."size_small/".$id.".jpg" , 150 , 150);
			@unlink($save_directory.$id.".jpg");
		}
		msg("main.php?action=m&m=album&s=admin_album_cat&menu=info");
	}
	function get_album_cat_list($type="", $single="")
	{
		global $config,$buid;
		if ($single>0)
		{
			$sql="select * from ".CUSTOM_CAT." where id=$single and type='$type' order by nums asc";
			$this->db->query($sql);
			$re=$this->db->fetchRow();
		}
		else
		{
			$sql="select * from ".CUSTOM_CAT." where userid='$buid' and type='$type' order by nums asc";
			$this->db->query($sql);
			$re=$this->db->getRows();
			for($i=0;$i<count($re);$i++)
			{
				$sql="select count(*) as custom_cat_count from ".CUSTOM_CAT_REL." where custom_cat_id=".$re[$i]['id'];
				$this->db->query($sql);
				$custom_rel_list=$this->db->fetchRow();
				$re[$i]["count"] = $custom_rel_list['custom_cat_count'];
			}
		}
		return $re;
	}
	
	function edit_album_cat($type="",$editid="")
	{
		global $config,$buid;
		$catid=empty($_POST['catid'])?0:$_POST['catid'];
		if(!empty($_POST['tcatid']))
			$catid=$_POST['tcatid'];
		if(!empty($_POST['scatid']))
			$catid=$_POST['scatid'];

		$sql="update ".CUSTOM_CAT." set name='$_POST[name]',sys_cat='$catid',des='$_POST[des]' where id='$editid' and userid='$buid'";
		$re=$this->db->query($sql);
		if(is_uploaded_file($_FILES['pic']['tmp_name']))
		{	
			$save_directory = $config['webroot']."/uploadfile/catimg/";
			makethumb($_FILES['pic']['tmp_name'] , $save_directory.$editid.".jpg" , 500 , 500);
			makethumb($_FILES['pic']['tmp_name'] , $save_directory."size_small/".$editid.".jpg" , 150 , 150);
			@unlink($save_directory.$editid.".jpg");
		}
		msg("main.php?action=m&m=album&s=admin_album_cat&menu=info");

	}
	function del_album_cat($type="",$deid="")
	{
		global $config,$buid;

		$sql="delete from ".CUSTOM_CAT." where id='$deid' and userid='$buid'";
		$re=$this->db->query($sql);

		$sql="select relating_id from ".CUSTOM_CAT_REL." where custom_cat_id='$deid'";
		$this->db->query($sql);
		$arrid=$this->db->getRows();
		foreach($arrid as $v)
		{
			$id=$v['relating_id'];
			$this->db->query("delete from ".ALBUM." where id='$id'");
			@unlink($config['webroot']."/uploadfile/zsimg/size_small/$id.jpg");
			@unlink($config['webroot']."/uploadfile/zsimg/$id.jpg");
		}
		@unlink($config['webroot']."/uploadfile/catimg/size_small/$deid.jpg");
		$sql="delete from ".CUSTOM_CAT_REL." where custom_cat_id='$deid'";
		$this->db->query($sql);
		msg("main.php?action=m&m=album&s=admin_album_cat&menu=info");
	}
	function add_album()
	{
		global $config,$buid;
		$_POST['con']=empty($_POST['con'])?NULL:$_POST['con'];
		$sql="insert into ".ALBUM." (userid,user,zname,con,`time`) values
		 ('$buid','$_COOKIE[USER]','$_POST[name]','$_POST[con]','".time()."')";
		$re=$this->db->query($sql);
		$id=$this->db->lastid();

		if(!empty($_POST['album_custom_cat']))
		{
			$sql="insert into ".CUSTOM_CAT_REL." (custom_cat_id,custom_cat_type,relating_id)
			 values 
			('$_POST[album_custom_cat]','6','$id')";
			$re=$this->db->query($sql);
		}
		if(is_uploaded_file($_FILES['pic']['tmp_name']))
		{	
			$save_directory = $config['webroot']."/uploadfile/zsimg/";
			makethumb($_FILES['pic']['tmp_name'] , $save_directory.$id.".jpg" , 500 , 500);
			makethumb($_FILES['pic']['tmp_name'] , $save_directory."size_small/".$id.".jpg" , 150 , 150);
		}
		if($re)
			msg("main.php?action=admin_album&info=1");
	}

	function add_multi_album()
	{
		global $config,$buid,$admin;
		
		$str_id=NULL;
		for($i=1;$i<6;$i++)
		{
			if(!empty($_FILES['pic'.$i])&&is_uploaded_file($_FILES['pic'.$i]['tmp_name']))
			{
				
				if(isset($_POST['con'.$i]))
					$admin->check_access('album');
				else
					$admin->check_access('album','&nohead=1');
				$con = !empty($_POST['con'.$i])?$_POST['con'.$i]:NULL;
				$name = !empty($_POST['name'.$i])?$_POST['name'.$i]:NULL;
				$sql="insert into ".ALBUM." (userid,user,zname,con,`time`) values 
				('$buid','$_COOKIE[USER]','$name','$con','".time()."')";
				
				$re=$this->db->query($sql);
				$id=$this->db->lastid();
				$save_directory = $config['webroot']."/uploadfile/zsimg/";
				makethumb($_FILES['pic'.$i]['tmp_name'] , $save_directory.$id.".jpg" , 500 , 500);
				makethumb($_FILES['pic'.$i]['tmp_name'] , $save_directory."size_small/".$id.".jpg" , 150 , 150);
				if(!empty($_POST['album_custom_cat']))
					$album_catid=$_POST['album_custom_cat']*1;
				else
					$album_catid=$this->get_the_first_albumid();
				$sql="insert into ".CUSTOM_CAT_REL." (custom_cat_id,custom_cat_type,relating_id) values
				 ('$album_catid','6','$id')";
				$re=$this->db->query($sql);
				$str_id.=$id.",";
			}
		}
		return $str_id;
	}
	function get_the_first_albumid()
	{
		global $buid;
		$sql="select * from ".CUSTOM_CAT." where userid='$buid' and type=6";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		if(!empty($re['id']))
			return $re['id'];
		else
		{
			$sql="insert into ".CUSTOM_CAT." (userid,sys_cat,name,type,des) 
			values ('$buid','0','default','6','default')";
			$re=$this->db->query($sql);
			$id=$this->db->lastid();
			return $id;
		}
	}
	function edit_album()
	{
		//$type 1产品，2产品,3资讯,4展会,5视频,6相册
		global $config,$buid;
		$sql="update ".ALBUM." set zname='$_POST[name1]',con='$_POST[con1]' where id='$_GET[editid]' and userid='$buid'";
		$re=$this->db->query($sql);
		if($re)
		{ //更新成功
			$sql="select custom_cat_id from ".CUSTOM_CAT_REL." where relating_id='$_GET[editid]' and custom_cat_type=6"; //先看之前是否分过组
			$this->db->query($sql);
			$re=$this->db->fetchRow();
			if($_POST['album_custom_cat'])
			{ //此次提交是否需要进行分组
				if($re['custom_cat_id'])
				{ // 已经分过组做更新
					$sql="update ".CUSTOM_CAT_REL." set custom_cat_id='$_POST[album_custom_cat]' where relating_id='$_GET[editid]' and custom_cat_type=6";
				} else { //未分过组做增加分组
					$sql="insert into ".CUSTOM_CAT_REL." (custom_cat_id,custom_cat_type,relating_id) values ('$_POST[album_custom_cat]','6','$_GET[editid]')";
				}
				$this->db->query($sql);
			}
			else
			{ //不分组
				if ($re['custom_cat_id'])
				{ //之前如果有分组则做删除
					$sql="delete from  ".CUSTOM_CAT_REL." where relating_id='$_GET[editid]' and custom_cat_type=6";
				}
				$this->db->query($sql);
			}
		}
	}
	function del_album($id)
	{
		if($id)
		{
			global $config, $buid;
			// lololo
			$sql="select id from ".ALBUM." where id='$id' and userid='$buid'";
			$this->db->query($sql);
			$re=$this->db->fetchRow();
			if(!$re['id']){
				return;
			}
			$sql="delete from ".ALBUM." where id='$id'";
			$re=$this->db->query($sql);
			if ($re) {
				$sql="delete from ".CUSTOM_CAT_REL." where relating_id='$id' and custom_cat_type=6";
				$this->db->query($sql);
			}
			@unlink("uploadfile/zsimg/size_small/$id.jpg");
			@unlink("uploadfile/zsimg/$id.jpg");
		}
	}

	function album_list($catid='')
	{
		global $buid;

		if (!empty($catid))
		    $sql="select a.*,b.custom_cat_id from ".ALBUM." a left join ".CUSTOM_CAT_REL." b on a.id=b.relating_id  where 
			a.userid='$buid' and b.custom_cat_id='$catid'";
		else
            $sql="select * from ".ALBUM." where userid='$buid'";

		//=============================
	  	$page = new Page;
		$page->listRows=18;
		if (!$page->__get('totalRows'))
		{
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",18";
		//=====================
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
		
		for($i=0;$i<count($re["list"]);$i++)
		{
			$sql="select a.name,b.custom_cat_id from ".CUSTOM_CAT." a, ".CUSTOM_CAT_REL." b where a.id=b.custom_cat_id and 
			b.custom_cat_type=6 and b.relating_id=".$re["list"][$i]['id'];
			$this->db->query($sql);
			$custom_list=$this->db->fetchRow();
			$re["list"][$i]["album_custom_name"] = $custom_list['name'];
			$re["list"][$i]["custom_cat_id"] = $custom_list['custom_cat_id'];
		}

		$re["page"]=$page->prompt();
		return $re;
	}
	function album_detail($id)
	{
		if(empty($id))
			return NULL;
			
		$sql="select * from ".ALBUM." where id='$id'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		
		$sql="select custom_cat_id from ".CUSTOM_CAT_REL." where relating_id='$id' and custom_cat_type=6";
		$this->db->query($sql);
		$custom_cat_list=$this->db->fetchRow();

		$re['custom_cat_id'] = $custom_cat_list['custom_cat_id'];
		return $re;
	}
	function shop_album_detail()
	{
		//相册详情
		$sql = "select a.* from ".CUSTOM_CAT." a, ".USER." d where id='$_GET[id]'";
		$this->db->query($sql);
		$albumd=$this->db->fetchRow();
		//所有图片列表
		$sql="select
				a.* from ".ALBUM." a , ".CUSTOM_CAT_REL." b
			  where
		         a.id=b.relating_id and b.custom_cat_id='$_GET[id]' order by a.id desc ";
		$this->db->query($sql);
		$re['pic_list']=$this->db->getRows();
		$re['album_detail']=$albumd;
		return $re;
	}
	
	function shop_album_list()
	{
		global $config;
		$sql="select * from ".CUSTOM_CAT." where userid='$_GET[uid]' and type='6' order by id desc";
		//-----------------------------------
		include_once($config['webroot']."/includes/page_utf_class.php");
		$page = new Page;
		$page->listRows=16;
		if (!$page->__get('totalRows'))
		{
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",$page->listRows";
		//-----------------------------------
		$this->db->query($sql);
		$sre=$this->db->getRows();
		for($i=0;$i<count($sre);$i++){
			$sql="select count(*) as custom_cat_count from ".CUSTOM_CAT_REL." where custom_cat_id=".$sre[$i]['id'];
			$this->db->query($sql);
			$custom_rel_list=$this->db->fetchRow();
			$sre[$i]["count"] = $custom_rel_list['custom_cat_count'];
		}
		$re['list']=$sre;
		$re['page']=$page->prompt();
		return $re;
	}

	//===============================================
	function album_merge_user($array)
	{
		$old_uid=$array['old_uid'];
		$new_uid=$array['new_uid'];
		$new_user=$array['new_user'];

		$sql = "update ".ALBUM." set userid='$new_uid',user='$new_user' where userid='$old_uid'";
		$this->db->query($sql);
	}
}
?>
