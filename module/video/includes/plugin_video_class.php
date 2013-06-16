<?php
class video
{
	var $db;
	var $tpl;
	var $page;
	function video()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	
	function add_video()
	{
		global $config,$buid;
		include("$config[webroot]/includes/tag_inc.php");
		//--------------------------------
		include($config['webroot']."/config/usergroup.php");
		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
		$my_group=$group[$ifpay]['modeu'];
		if($my_group['replace_outside_link']==1)
			$_POST["desc"]=replace_outside_link($_POST["desc"]);
		//--------------------------------
		if(strlen($_POST['video_url'])==19)
		{
			$vname=str_replace('temp_','',$_POST['video_url']);
			rename($config['webroot'].'/uploadfile/video/temp_'.$vname,$config['webroot'].'/uploadfile/video/'.$vname);
			$_POST['video_url']=$vname;
		}
		if(empty($_POST['cat_one']))
			$_POST['cat_one']=0;
			
		if(!empty($_POST['catid']))
			$_POST['cat_one']=$_POST['catid'];
			
		$sql="insert into ".VIDEO." 
		(userid,catid,name,video_url,img_url,`desc`,`fb`,`time`) 
		 VALUES
		('$buid','$_POST[cat_one]','$_POST[name]','$_POST[video_url]','$_POST[img_url]','$_POST[desc]','$my_group[user_video_fb]',".time().")";
		$re=$this->db->query($sql);
		$id=$this->db->lastid();
		add_tags($_POST['keyword'],5,$id);
		$this->db->query("update ".USER." set video=1 where userid='$buid'");
		include("config/point_config.php");
		if($point_config['point']=='1'&&$point_config['pub_vidio']!='0')
			renew_point('',$point_config['pub_vidio']);
		return $re;
	}
	function select_cat()   //一级类别
	{
	   $sql="select * from ".VCAT." where pid=0 ";
	   $this->db->query($sql);
	    $re=$this->db->getRows();
		return $re; 
	}
	function edit_video($id)
	{
		global $buid,$config;
		include_once("$config[webroot]/includes/tag_inc.php");
		if(empty($_POST['cat_one']))
			$_POST['cat_one']=0;
		if(!empty($_POST['catid']))
			$_POST['cat_one']=$_POST['catid'];
			
		$sql="update ".VIDEO." SET 
		name='$_POST[name]',`desc`='$_POST[desc]',video_url='$_POST[video_url]',img_url='$_POST[img_url]',user='$_COOKIE[USER]',catid='$_POST[cat_one]' 
		where video_id='$id'";
		$this->db->query($sql);
		edit_tags($_POST['keyword'],5,$id);
	}
	function update_video_state()
	{
		global $config,$buid;

		$video_id = isset($_GET['user_tj']) ? $_GET['user_tj'] : $_GET['cancel_tj'];
		$sql="select video_id from ".VIDEO." where video_id='$video_id' and userid='$buid'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		if(!$re['video_id']){
			return;
		}
		if(isset($_GET['user_tj'])){ // only recommend single video
			$this->db->query("update ".VIDEO." set user_tj=0 where userid='$buid'");
			$this->db->query("update ".VIDEO." set user_tj=1 where userid='$buid' and video_id='$_GET[user_tj]'");
		}else if (isset($_GET['cancel_tj'])){ // cancel recommend
			$this->db->query("update ".VIDEO." set user_tj=0 where  video_id='$_GET[cancel_tj]'");
		}
	}
	
	function video_list($uid=NULL)
	{
		global $buid;
		if(!empty($uid))
			$userid=$uid;
		else
			$userid=$buid;
		$sql="SELECT * FROM ".VIDEO." WHERE userid='$userid' order by video_id desc";
		$this->db->query($sql);
		return $this->db->getRows();
	}
	
	function front_video_list($catid=NULL)
	{
	    if(!empty($catid))
		   $sql=" and catid=".$catid;
		$sql="SELECT * FROM ".VIDEO." WHERE 1 $sql order by video_id desc";
		//========================================
		include_once("includes/page_utf_class.php");
		$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
		 $sql .= "  limit ".$page->firstRow.",20";
		//========================================
		$this->db->query($sql);
		$rs["lists"]=$this->db->getRows();
		$rs["pages"]=$page->prompt();
		return $rs;
	}
	
	function video_detail($id)
	{
		if($id)
		{	global $config;
			include_once("$config[webroot]/includes/tag_inc.php");
			$sql="select * from ".VIDEO." where video_id='$id'";
			$this->db->query($sql);
			$re=$this->db->fetchRow();
			
			if($re['catid'])
			{
				$sql="select pid from ".VCAT." where id=".$re['catid'];
				$this->db->query($sql);
				$re['fcatid']=$this->db->fetchField('pid');
  			}
			
			$re['keyword']=get_tags($id,5);
			return $re;
		}
	}
	function del_video($id,$userid=NULL)
	{
		global $buid,$config;

		$sql="select video_url,userid from ".VIDEO." where video_id='$id'";
		$this->db->query($sql);
		$userid=$this->db->fetchField('userid');

		$sql="delete from ".VIDEO." WHERE video_id='$id'";
		$this->db->query($sql);
		//-----------------------------------------------
		include_once("$config[webroot]/includes/tag_inc.php");
		del_tag($id,5);
		//-----------------------------------------------
		if(strlen($sre['video_url'])==14)
			@unlink($config['webroot'].'/uploadfile/video/'.$sre['video_url']);
		//-----------------------------------------------
		if(!empty($userid))
		{
			$this->db->query("select count(video_id) as video_count from ".VIDEO." WHERE userid='$userid'");
			$re = $this->db->fetchRow();
			if($re['video_count']==0)
			{
				$this->db->query("update ".USER." set video=0 where userid='$buid'");
			}
		}


	}
	
	function video_merge_user($array)
	{
		$old_uid=$array['old_uid'];
		$new_uid=$array['new_uid'];
		$new_user=$array['new_user'];

		$sql = "update ".VIDEO." set userid='$new_uid',user='$new_user' where userid='$old_uid'";
		$this->db->query($sql);
	}
}
?>
