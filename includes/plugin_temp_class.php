<?php
class temp
{
	var $db;
	var $tpl;
	var $page;
	function temp()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	
	function temp_list()
	{
		global $config;
		//--------------------------------------------------
		include($config['webroot']."/config/usergroup.php");
		if(empty($_SESSION["IFPAY"])||!isset($_SESSION["IFPAY"]))
			$_SESSION["IFPAY"]=2;
		$ifpay=$_SESSION["IFPAY"];
		$my_group=$group[$ifpay]['modeu'];
		//----------------------------------------------------
		$utemps=explode(",",$my_group['shoptemp']);
		
		$handle = opendir($config['webroot']."/templates"); 
		while ($filename = readdir($handle))
		{ 
			if($filename!="."&&$filename!="..")
			{
			  if(is_dir($config['webroot']."/templates/".$filename)&&substr($filename,0,5)=="user_")
			  {
			  	$temp['temp']=$filename;
				if(in_array($filename,$utemps))
					$temp['right']=1;
				else
					$temp['right']=0;
				$dir[]=$temp;
			  }
		   }
	    }
		$default['temp']='default';
		$default['right']='1';
		$dir[]=$default;
		return $dir;
	}
	
	function update_user_tem($temp)
	{	
		global $buid;
		if($_POST['tem']=='default')
		{
			$sql="UPDATE ".USER." SET template='default' WHERE userid='$buid'";
			$this->db->query($sql);
			msg("main.php?menu=usershop&action=template");
			die;
		}
		$sql="select id,group_id,temp_file,point from ".USERTEMP." where id='$temp' and statu=1";
		$this->db->query($sql);
		$temp=$this->db->fetchRow();

		if($temp['point']>0)
		{	
			$sql="select point from ".USER." where userid='$buid'";
			$this->db->query($sql);
			$upoint=$this->db->fetchField("point");
			if($upoint<$temp['point'])
				msg("main.php?menu=usershop&action=template&nopoint=1");
			else
				renew_point('tpl',0-$temp['point']);
		}
		$sql="UPDATE ".USER." SET template='$temp[temp_file]' WHERE userid='$buid'";
		$this->db->query($sql);
		$sql="UPDATE ".USERTEMP." SET amount=amount+1 WHERE id='$temp'";
		$this->db->query($sql);
		msg("main.php?menu=usershop&action=template");
		die;
	}
	function get_nums_for_group($ifpay)
	{
		$fsql.=" AND  FIND_IN_SET($ifpay,group_id)>0 ";
		$sql="select count(*) as num from ".USERTEMP." where statu=1 $fsql";
		$this->db->query($sql);
		return $this->db->fetchField('num');
	}
	function user_temp_list()
	{	
		global $config,$buid;
		include($config['webroot']."/config/usergroup.php");
		if(empty($_SESSION["IFPAY"])||!isset($_SESSION["IFPAY"]))
			$_SESSION["IFPAY"]=2;
		$ifpay=$_SESSION["IFPAY"];
		//================================

		$fsql=NULL;
		if(!empty($_GET['cat'])&&is_numeric($_GET['cat']))
			$fsql.=" AND ccatid='$_GET[cat]' ";
		if(!empty($_GET['group_id'])&&is_numeric($_GET['group_id']))
			$fsql.=" AND  FIND_IN_SET($_GET[group_id],group_id)>0 ";
		//--------------------------------
		$min=0;$max=0;
		if(is_numeric($_GET['min_point'])&&is_numeric($_GET['max_point']))
		{	
			$min=intval($_GET['min_point']);
			$max=intval($_GET['max_point']);
			if($min<$max)
				$fsql.=" AND point BETWEEN $min AND $max ";
			else if($min==$max)
				$fsql.=" AND point=$min ";
		}

		$sql="select id,tname,group_id,temp_file,point,sort_order from ".USERTEMP." where statu=1 $fsql order by sort_order ASC";

		//----------------------------------------
		include_once("includes/page_utf_class.php");
		$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$this->db->query("select count(*) as num from ".USERTEMP."  where statu=1 $fsql");
			$page->totalRows=$this->db->fetchField('num');
		}
		$sql .= "  limit ".$page->firstRow.",20";
		//-----------------------------------------

		$this->db->query($sql);
		$de=$this->db->getRows();
		$templist=array();
		foreach($de as $t)
		{	
			$group_id=explode(',',$t['group_id']);
			if(in_array($ifpay,$group_id))
				$t['right']=1;
			else
				$t['right']=0;
			$templist['list'][]=$t;
		}	
		//---------------------------------
		if(empty($_GET['group_id'])&&empty($_GET['cat'])&&$min==0)
		{	
			$default['id']='0';
			$default['tname']='По умолчанию';
			$default['temp_file']='default';
			$default['right']='1';
			$templist['list'][]=$default;
		}

		$templist['pages']=$page->prompt();
		return $templist;
	}

	function update_shop_setting()
	{	
			global $config,$buid;
			$c=array();
			$shopconfig=array();
			foreach($_POST['menu_order'] as $key=>$v)
			{
				$c[$key]['menu_show']=$_POST['menu_show'][$key];
				$c[$key]['menu_order']=$v;
				$c[$key]['menu_name']=$_POST['menu_name'][$key];
				$c[$key]['menu_link']=$_POST['menu_link'][$key];
				$c[$key]['module']=$_POST['module'][$key];
			}
			foreach($c as $k=>$val) 
			{  
				$name[$k] = $val['menu_order'];
			}
			
			array_multisort($name,SORT_ASC,$c);
			$shopconfig['menu']=$c;
			foreach($_POST as $ks=>$v)
			{
				if(substr($ks,0,4)!='menu'&&$ks!='sconfig')
				{
					$shopconfig[$ks]=$v;
				}
			}
			if(is_uploaded_file($_FILES['headimage']['tmp_name']))
			{
				$save_directory = $config['webroot']."/uploadfile/comimg/big/";
				makethumb($_FILES['headimage']['tmp_name'] , $save_directory."shop_head_image_".$buid.".jpg" ,960 , 960);
				$shopconfig['headimage']=$config['weburl']."/uploadfile/comimg/big/"."shop_head_image_".$buid.".jpg";
			}
			if(!empty($_POST['home_del_headimage'])&&$_POST['home_del_headimage']==1)
		    {
				@unlink($config['webroot']."/uploadfile/comimg/big/"."shop_head_image_".$buid.".jpg");
				$shopconfig['headimage']=NULL;
		    }
			else
		   {
				if(@file($config['webroot']."/uploadfile/comimg/big/"."shop_head_image_".$buid.".jpg"))
					$shopconfig['headimage']=$config['weburl']."/uploadfile/comimg/big/"."shop_head_image_".$buid.".jpg";
				else
					$shopconfig['headimage']=NULL;
		   }
			if(is_uploaded_file($_FILES['styleimg']['tmp_name']))
			{
				$save_directory = $config['webroot']."/uploadfile/comimg/big/";
				makethumb($_FILES['styleimg']['tmp_name'] , $save_directory."shop_background_image_".$buid.".jpg" ,960 , 960);
				$shopconfig['styleimg']=$config['weburl']."/uploadfile/comimg/big/"."shop_background_image_".$buid.".jpg";
			}
			if(!empty($_POST['home_del_styleimg'])&&$_POST['home_del_styleimg']==1)
		    {
				@unlink($config['webroot']."/uploadfile/comimg/big/"."shop_background_image_".$buid.".jpg");
				$shopconfig['styleimg']=NULL;
			}
			else
		   {
				if(@file($config['webroot']."/uploadfile/comimg/big/"."shop_background_image_".$buid.".jpg"))
					$shopconfig['styleimg']=$config['weburl']."/uploadfile/comimg/big/"."shop_background_image_".$buid.".jpg";
				else
					$shopconfig['styleimg']=NULL;
		   }
			$shop_config_array=$shopconfig;
			$shop_config_str=serialize($shop_config_array);	
			//写入数据库
			$sql="select userid from ".SHOPSETTING." where userid='".$buid."'";
			$this->db->query($sql);
			$rs=$this->db->fetchRow();
			if(empty($rs['userid']))
				$sql="insert into ".SHOPSETTING." (`userid`,`config_con`,rec_pro,common_cat) values ('".$buid."','".$shop_config_str."','','')";
			else
				$sql="update  ".SHOPSETTING." set `config_con`='".$shop_config_str."' where userid=$buid";
			$this->db->query($sql);
			//生成配置文件
			$shop_config_str='<?php $shopconfig=unserialize(\''.$shop_config_str.'\');?>';
			$fp=fopen($config['webroot'].'/config/shop_config/shop_config_'.$buid.'.php','w');
			fwrite($fp,$shop_config_str,strlen($shop_config_str));
			fclose($fp);			
			return true;
	}
	function get_shop_setting()
	{	
			global $buid;
			$sql="select config_con from ".SHOPSETTING." where userid='".$buid."'";
			$this->db->query($sql);
			$rs=$this->db->fetchRow();
			if(!empty($rs['config_con']))
				$cf=unserialize($rs['config_con']);
			else
				return false;
			return $cf;
	}
}
?>
