<?php
class news
{
	var $db;
	var $tpl;
	var $page;
	function news()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
		$this -> cTime	= date("Y-m-d");
	}
	
	function get_newsclass()
	{
		$sql="select catid,cat from ".NEWSCAT." where openpost=1 and ishome=1 order by nums DESC";	
		$re=$this->db->query($sql);
		$re=$this->db->getRows();
		return $re;
	}
	
	function fun_news($type)
	{
		global $config,$buid;
		if(!empty($_FILES['img_url'])&&is_uploaded_file($_FILES['img_url']['tmp_name']))
		{
			if(!empty($_POST['pic']))
			{
				$file=$config['webroot']."/uploadfile/news/".$_POST['pic'];
				@unlink($file);
				$file=$config['webroot']."/uploadfile/news/big/".$_POST['pic'];	
				@unlink($file);
			}
			$pname=time().".jpg";
			$savefile=$config['webroot']."/uploadfile/news/".$pname;
			$bsavefile=$config['webroot']."/uploadfile/news/big/".$pname;
			makethumb($_FILES['img_url']['tmp_name'],$savefile,140,125);
			makethumb($_FILES['img_url']['tmp_name'],$bsavefile,275,200);
		}
		if(!empty($_POST['pic']) and empty($pname))
		{
			$pname=$_POST['pic'];
		}
		
		if(empty($pname))
		{
			$ispic=0;
		}
		else
		{
			$ispic=1;
		}
		
		if(empty($_POST['smalltext']))
		{
			$con=$_POST['body'];
			$str = explode('<p>',$con);
			foreach($str as $i=>$k)
			{
				$val=trim(strip_tags($k));
				if(!empty($val))
				{
					$_POST['smalltext']=$val;
					break;
				}
			}
		}
	    #过滤<a
		include($config['webroot']."/config/usergroup.php");
		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
		$my_group=$group[$ifpay]['modeu'];
		if($my_group['replace_outside_link']==1)
				$_POST['body']=replace_outside_link($_POST['body']);
		#过滤结束
		
		if($type=="add")
		{
			$sql="select company from ".USER." where userid=$buid";
			$re=$this->db->query($sql);
			$writer=$this->db->fetchField('company');
			
			$sql="INSERT ".NEWSD."(classid,title,ftitle,keyboard,ispass,titlefont,uid,uptime,smalltext,writer,titlepic,ispic,lastedittime,imgs_url,videos_url,ispl,userfen,newstempid,source) VALUES ('$_POST[classid]','$_POST[title]','$_POST[ftitle]','$_POST[key]','$my_group[user_news_fb]','','$buid','".time()."','$_POST[smalltext]','$writer','$pname','$ispic','".time()."','','','0','0','0','')";
			$re=$this->db->query($sql);
			$id=$this->db->lastid();
			
			$sql="INSERT INTO ".NEWSDATA." (nid,con) values ('$id','$_POST[body]')";
			$re=$this->db->query($sql);
			
			include("config/point_config.php");
			if($point_config['point']=='1'&&$point_config['add_news']!='0')
				renew_point('',$point_config['add_news']);
		}
		if($type=="edit")
		{
			$sql="update ".NEWSD." set title='$_POST[title]',classid='$_POST[classid]',ftitle='$_POST[ftitle]',keyboard='$_POST[key]',ispass='$my_group[user_news_fb]',onclick='$_POST[onclick]',smalltext='$_POST[smalltext]',titlepic='$pname',ispic='$ispic',lastedittime='".time()."' where nid= $_GET[newsid]";   
		   $re=$this->db->query($sql);
		   $sql="update ".NEWSDATA." set con='$_POST[body]' where nid= $_GET[newsid]";  
		   $re=$this->db->query($sql);
		}
		msg("main.php?action=m&m=$_GET[m]&s=admin_news_list&menu=$_GET[menu]");
		
	}
	
	
   function get_news()
   {
	    global $buid;
		$sql="select nid,classid,ftitle,isrec,istop,ispass,onclick,uptime from ".NEWSD." where uid=$buid  order by nid desc";
	  	$page = new Page;
		$page->listRows=26;
		if (!$page->__get('totalRows'))
		{
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",26";
		//=====================
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
		$re["page"]=$page->prompt();
		return $re;
	  
   }
   
   function del_news($id)
   {
		$this->db->query("delete from ".NEWSD." where nid='$id'");
		$this->db->query("delete from ".NEWSDATA." where nid='$id'");
		include("config/point_config.php");
		if($point_config['point']=='1'&&$point_config['del_news']!='0')
			renew_point('',$point_config['del_news']);
	    msg("main.php?action=m&m=$_GET[m]&s=admin_news_list");
  }
  
  function news_detail($id)
  {
	    global $config;
		$sql="select a.nid,title,ftitle,con,keyboard,smalltext,classid,titlepic,ispic from ".NEWSD." a left join ".NEWSDATA." b on a.nid=b.nid where a.nid='$id'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		#################################
		$BasePath = "lib/fckeditor/";
		include($BasePath."fckeditor.php");	
		$fck_en = new FCKeditor('body') ;
		$fck_en->BasePath    = $BasePath ;
		$fck_en->ToolbarSet  = 'frant' ;
		$fck_en->Width='100%';
		$fck_en->Height=500;
		$fck_en->Config['ToolbarStartExpanded'] = true;
		$fck_en->Value = stripslashes($re["con"]);
		$re["body"] = $fck_en->CreateHtml();
		#####################
		return $re;  
  }	
  
  function space_news_list()
	{
		global $config;
		$sql="SELECT nid,title,ftitle,smalltext,uptime FROM ".NEWSD." WHERE ispass=1 and uid=$_GET[uid] ORDER BY uptime DESC";
		//---------------
		include_once($config['webroot']."/includes/page_utf_class.php");
		$page = new Page;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
		$sql .= "  limit ".$page->firstRow.", ".$page->listRows;
		//---------------
		$this->db->query($sql);
		$infoList['list']=$this->db->getRows();
		$infoList['page']=$page->prompt();
		$this->tpl->assign("news",$infoList);
	}
	
	function space_news_detail()
	{
		$sql="SELECT a.title,a.uptime,a.ispl,b.con FROM ".NEWSD." a left join ".NEWSDATA." b on a.nid=b.nid WHERE a.nid='$_GET[id]'";
		$this->db->query($sql);
		$info=$this->db->fetchRow();
		return $info;
	}
}
?>