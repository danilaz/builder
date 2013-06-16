<?php

class admin{



	var $cTime;

	var $db;

	var $tpl;

	var $page;

	function admin()

	{

		global $db;

		global $config;

		global $tpl;

		

		$this -> cTime  = date("Y-m-d H:i:s");

		$this -> db     = & $db;

		$this -> tpl    = & $tpl;

	} 

	############################

	function is_login($action)

	{

		global $buid,$config;

		if(!$buid||!isset($_COOKIE["USER"]))

		{

			header("Location: $config[weburl]/login.php");

			exit();

		}

		if(empty($_SESSION["IFPAY"]))

		{

			$this->db->query("select ifpay from ".USER." WHERE userid='$buid'");

			$re=$this->db->fetchRow();

			$_SESSION["IFPAY"]=$re['ifpay'];

			if(empty($_SESSION["IFPAY"]))

				$_SESSION["IFPAY"]=2;

		}

		

		if($_SESSION["IFPAY"]<=-1&&$_GET['type']!='access_dine'&&$action!='logout')

		{

			header("Location: $config[weburl]/main.php?action=msg&type=access_dine");

			exit();

		}

		if(!empty($_SESSION["IFPAY"])&&$_SESSION["IFPAY"]==1&&$action!="myshop"&&$action!="msg"&&$action!="logout"&&$action!="admin_personal")

		{

			header("Location: $config[weburl]/main.php?action=msg&type=active");

			exit();

		}

	}

	function who_view_myshop($uid)

	{

		$sql="select a.time,b.user,b.logo,b.userid from ".READREC." a , ".ALLUSER." b 

		where a.userid=b.userid and a.tid='$uid' and a.type='3'";

		$this->db->query($sql);

		$re=$this->db->getRows();

		return $re;

	}

	function check_access($type,$ext=NULL)

	{

		global $config,$buid;

		include($config['webroot']."/config/usergroup.php");

		$ifpay=$_SESSION["IFPAY"];

		$my_group=$group[$ifpay]['modeu'];

		

		if($type=="pro")

			$sql="select count(id) as num from ".PRO." WHERE userid='$buid'";

		if($type=="offer" or $type=="demand" )

			$sql="select count(id) as num from ".INFO." WHERE userid='$buid'";
 
   //if( $type=="demand" )

		//	$sql="select count(id) as num from ".INFO." WHERE userid='$buid'";
			 
		if($type=="news")

			$sql="select count(nid) as num from ".NEWSD." WHERE uid='$buid'";

		if($type=="album")

			$sql="select count(id) as num from ".ALBUM." WHERE userid='$buid'";

		if($type=="video")

			$sql="select count(video_id) as num from ".VIDEO." WHERE userid='$buid'";

		if($type=="link")

			$sql="select count(link_id) as num from ".ULINK." WHERE userid='$buid'";

		if($type=="hr")

			$sql="select count(id) as num from ".ZP." WHERE userid='$buid'";

		if($type=="album_cat")

			$sql="select count(id) as num from ".CUSTOM_CAT." WHERE userid='$buid' and type=6";

		if($type=="pro_cat")

			$sql="select count(id) as num from ".CUSTOM_CAT." WHERE userid='$buid' and type=1 and pid=0";

		if($type=="project")

			$sql="select count(id) as num from ".PROJECT." WHERE userid='$buid'";

		if($type=="subscribe")

			$sql="select count(id) as num from ".SUBSCRIBE." WHERE userid='$buid'";


		if(!empty($sql))

		{

			$this->db->query($sql);

			$re=$this->db->fetchRow();

			if($re['num']>=$my_group[$type])

			{
				msg("main.php?action=msg&type=access_dine".$ext);

				return false;

			}

		}

		/*如 temp,refresh.....*/

		elseif(!$my_group[$type])

		{

			msg("main.php?action=msg&type=access_dine".$ext);

			return false;

		}



	}

	function clear_user_shop_cache()

	{

		global $config,$buid;

		$dir=$config['webroot'].'/cache/shop/'.get_userdir($buid).'/';

		$handle = opendir($dir); 

		while ($filename = readdir($handle))

		{

			if(!is_dir($dir.$filename))

				@unlink($dir.$filename);

		}

	}

	function set_user_ifpay()

	{

		global $buid;

		$sql="update ".USER." SET ifpay='1' where userid='$buid'";

		$this->db->query($sql);

	}

	function get_personal_detail($id)

	{

		global $buid;

		if(empty($id))

			$id=$buid;

		$sql="select * from ".ALLUSER." WHERE userid='$id'";

		$this->db->query($sql);

		$re=$this->db->fetchRow();

		return $re;

	}

	function delete_personal($id)

	{

		global $buid;

		$sql="delete from ".ALLUSER." WHERE pid='$buid' and userid='$id'";

		$this->db->query($sql);

	}

	function get_personal_list($id)

	{

		$sql="select * from ".ALLUSER." WHERE pid='$id' order by userid desc";

		$this->db->query($sql);

		$re=$this->db->getRows();

		return $re;

	}

	function add_personal()

	{

		global $config,$buid;

		$p=$_POST;

		$p['pas']=md5($p['pass']);

		$time=time();

		$ip=getip();

		

		$sql="select user from ".ALLUSER." where user='$p[user]'";

		$this->db->query($sql);

		$user=$this->db->fetchField('user');

		if(empty($user))

		{

			$sql="insert into ".ALLUSER." 

			(pid,user,password,name,email,tel,qq,province,city,sex,msn,skype,position,mobile,lastLoginTime,ip)

			value

			('$buid','$p[user]','$p[pas]','$p[name]','$p[email]','$p[tel]','$p[qq]','$p[province]','$p[city]',

			'$p[sex]','$p[msn]','$p[skype]','$p[position]','$p[mobile]','$time','$ip')";

			$re=$this->db->query($sql);

			return $re;

		}

	}

	

	function update_personal($uid)

	{

		global $config,$buid;$logo=NULL;$ssql=NULL;

		if(empty($uid))

			$uid=$buid;

		$sql="UPDATE ".ALLUSER." SET

		name='$_POST[name]',email='$_POST[email]',tel='$_POST[tel]',qq='$_POST[qq]',province='$_POST[province]',city='$_POST[city]',sex='$_POST[sex]',

		msn='$_POST[msn]',skype='$_POST[skype]',position='$_POST[position]',mobile='$_POST[mobile]',logo='$_POST[logo]'

		WHERE userid='$uid'";

		

		$re=$this->db->query($sql);

		return $re;

	}



	function add_domin($uid=NULL)

	{

		$sql="select userid from ".UDOMIN." where userid='$uid'";

		$this->db->query($sql);	 

		if ($this->db->num_rows()<=0)

		  $sql="insert into ".UDOMIN." (`domin`,`userid`,`time`) values ('".trim($_POST['domain'])."','$uid',".time().")";

		else

		  $sql="update ".UDOMIN." set domin='".trim($_POST['domain'])."',time=".time()." where userid='$uid'";

		$this->db->query($sql);

	}

	function get_myshop_domin($uid=NULL)

	{

		$sql="select domin from ".UDOMIN." where userid='$uid'";

		$this->db->query($sql);

		return $this->db->fetchField('domin');

	}



	function resetpass($buid)

	{

		$sql="SELECT password FROM ".ALLUSER." WHERE userid='$buid'";

		$this->db->query($sql);

		$re=$this->db->fetchRow();

		if($re['password']!=md5($_POST["oldpass"]))

			msg("main.php?action=setpassword&info=1&menu=user");

		elseif($_POST["newpass"]!=$_POST["renewpass"])

			msg("main.php?action=setpassword&info=2&menu=user");

		else

		{

			$sql="UPDATE ".ALLUSER." SET password='".md5($_POST['newpass'])."' WHERE userid='$buid'";

			$re=$this->db->query($sql);

			if($re)

				msg("main.php?action=setpassword&info=3&menu=user");

		}

	}

	function check_myshop()

	{

		global $buid;

		$sql="SELECT * FROM ".USER." WHERE userid='$buid'";

		$this->db->query($sql);

		$re=$this->db->fetchRow();

		

		if(!$re["company"]||!$re["contact"]||!$re["tel"]

		||!$re["province"]||!$re["addr"]||!$re["ctype"]||!$re["zip"])

		msg("main.php?action=myshop&info=2");	

	}

	function getComCat()

	{

		$this->db->query("SELECT catid,cat FROM ".COMPANYCAT." WHERE catid<=9999 order by nums asc");

		$re=$this->db->getRows();

		foreach($re as $key=>$v)

		{

			$s=$v["catid"]."00";

			$b=$v["catid"]."99";

			$this->db->query("SELECT * FROM ".COMPANYCAT." WHERE catid>=$s and catid<=$b ORDER BY nums ASC");

			$re[$key]['sub']=$this->db->getRows();

		}

		return $re;

	}

	/**

	 * $type 1产品，2产品,3资讯,4展会,5视频,6相册

	 */

	//======Brad=======================

	function update_custom_cat($type='')

	{

		global $buid;

		foreach($_POST['name'] as $key=>$v)

		{//print_r($_POST);die;

			if(!empty($_POST['cid'][$key]))

			{

				$sql="update ".CUSTOM_CAT." set name='$v',nums='".$_POST['nums'][$key]."' where

				id='".$_POST['cid'][$key]."'";

				$re=$this->db->query($sql);

			}

			elseif(!empty($v))

			{

				$this->check_access('pro_cat');

				$sql="insert into ".CUSTOM_CAT." (userid,name,type,nums) values 

				('$buid','$v','$type','".$_POST['nums'][$key]."')";

				$re=$this->db->query($sql);

			}

		}

		if(is_array($_POST['sname']))

		{

			foreach($_POST['sname'] as $key=>$v)

			{

				if(!empty($_POST['scid'][$key])&&!empty($_POST['sname'][$key]))

				{

					$sql="update ".CUSTOM_CAT." set name='".$_POST['sname'][$key]."',nums='".$_POST['snums'][$key]."' where

					id='".$_POST['scid'][$key]."'";

					$re=$this->db->query($sql);

				}

			}

		}

		if(is_array($_POST['pid']))

		{

			foreach($_POST['pid'] as $key=>$v)

			{

				if(!empty($v)&&!empty($_POST['addsname'][$key]))

				{

					$sql="insert into ".CUSTOM_CAT." (userid,pid,name,type,nums) values 

					('$buid','".$_POST['pid'][$key]."','".$_POST['addsname'][$key]."','$type','".$_POST['addsnums'][$key]."')";

					$re=$this->db->query($sql);

				}

			}

		}

	}

	

	function add_custom_cat($type="")

	{

		global $config,$buid;

		$sql="insert into ".CUSTOM_CAT." (userid,name,type) values ('$buid','$_POST[name]','$type')";

		$re=$this->db->query($sql);

		msg("main.php?action=m&m=product&s=admin_product_cat");

	}

	function get_custom_cat_list($type="", $single="")

	{

		global $config,$buid;

		if($single>0)

		{

			$sql="select * from ".CUSTOM_CAT." where id='$single' and type='$type' order by nums asc";

			$this->db->query($sql);

			$re=$this->db->fetchRow();

		}

		else

		{

			$sql="select * from ".CUSTOM_CAT." where userid='$buid' and type='$type' and pid=0 order by nums asc";

			$this->db->query($sql);

			$re=$this->db->getRows();

			for($i=0;$i<count($re);$i++)

			{

				$sql="select count(*) as custom_cat_count from ".CUSTOM_CAT_REL." where custom_cat_id=".$re[$i]['id'];

				$this->db->query($sql);

				$custom_rel_list=$this->db->fetchRow();

				$re[$i]["count"] = $custom_rel_list['custom_cat_count'];

				

				$sql="select * from ".CUSTOM_CAT." where pid='".$re[$i]['id']."' and pid!=0 order by nums asc";

				$this->db->query($sql);

				$re[$i]['subcat']=$this->db->getRows();

			}

		}

		return $re;

	}



	function edit_custom_cat($type="",$editid="")

	{

		global $config,$buid;

		$sql="update ".CUSTOM_CAT." set name='$_POST[name]' where id='$editid' and userid='$buid'";

		$re=$this->db->query($sql);

		msg("main.php?action=m&m=product&s=admin_product_cat");

	}



	function del_custom_cat($deid="")

	{

		global $config,$buid;

		$sql="delete from ".CUSTOM_CAT." where id='$deid' and userid='$buid'";

		$re=$this->db->query($sql);

		$sql="delete from ".CUSTOM_CAT_REL." where custom_cat_id='$deid'";

		$this->db->query($sql);

	}

	

	function getCatName($table)

	{

		$sql="select * from $table where catid<9999 order by nums asc";

		$this->db->query($sql);

		$re=$this->db->getRows();

		return $re;

	}

}

?>