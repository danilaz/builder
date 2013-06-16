<?php
class friend
{
	var $db;
	var $tpl;
	var $page;
	function friend()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	function get_friend_info($uid='')
	{	
		if(is_numeric($uid))
			$sql="a.userid='$uid'";
		else
			$sql="a.user='$uid'";
		$sql="select a.*,b.ename as country from ".USER." a left join ".COUNTRY." b 
		on a.country=b.id left join ".ALLUSER." c on c.userid=a.userid 
		where $sql ";
		$this->db->query($sql);
		$rs=$this->db->fetchRow();
		return $rs;
	}
	function edit_friend_info($id='')
	{	
			$sql="select * from ".FRIENDS." where id='$id'";
			$this->db->query($sql);
			$rs=$this->db->fetchRow();
			return $rs;
	}
	function del_friend_info($id='')
	{	
			$sql="delete from ".FRIENDS." where id='$id'";
			$this->db->query($sql);
	}
	function update_friend_info($id='')
	{	
		global $buid;
		$t=time();
		if(empty($id))
		{
			$sql="select id from ".FRIENDS." where username='$_POST[username]' and uid=$buid";
			$this->db->query($sql);
			$c=$this->db->fetchRow();
			if(!empty($c['id']))
			{
				msg("main.php?action=m&m=friend&s=admin_friends&isexist=1&menu=$_GET[menu]");
				die;
			}
			if(!empty($_POST['name'])&&(!empty($_POST['username'])||!empty($_POST['email'])))
			{
				$_POST['fuid']=empty($_POST['fuid'])?0:$_POST['fuid'];
				$sql="INSERT INTO ".FRIENDS." 
				(uid,fuid,username,country,province,city,company,name,position,tel,fax,mobile,addr,email,msn,skype,qq,des,uptime) VALUES ($buid,'$_POST[fuid]','$_POST[username]','$_POST[country]','$_POST[province]','$_POST[city]','$_POST[company]','$_POST[name]','$_POST[position]', '$_POST[tel]','$_POST[fax]','$_POST[mobile]','$_POST[addr]','$_POST[email]','$_POST[msn]','$_POST[skype]','$_POST[qq]','$_POST[des]','$t')";}
			else
			{
				msg("main.php?action=m&m=friend&s=admin_friends&infomsg=isnull&menu=$_GET[menu]");
				die;
			}
		}
		else
		{
			if(!empty($_POST['name']))
				$sql="update ".FRIENDS." set country='$_POST[country]',province='$_POST[province]',city='$_POST[city]',company='$_POST[company]',name='$_POST[name]',position='$_POST[position]', tel='$_POST[tel]',fax='$_POST[fax]',mobile='$_POST[mobile]',addr='$_POST[addr]',email='$_POST[email]',msn='$_POST[msn]',skype='$_POST[skype]',qq='$_POST[qq]',des='$_POST[des]',uptime='$t' where id='$id' and uid=$buid";
			else
				die("Empty contents");
		}
		$this->db->query($sql);
		msg("main.php?action=m&m=friend&s=admin_friends_list&menu=$_GET[menu]");
	}
	function friends_list()
	{	
			global $buid;
			$sub_sql='';
			if(!empty($_GET['qtype'])&&!empty($_GET['keycon']))
			{
				if($_GET['qtype']=='1')
						$sub_sql.=" and username='".$_GET['keycon']."'";
				if($_GET['qtype']=='2')
						$sub_sql.=" and name like '%".$_GET['keycon']."%'";
				if($_GET['qtype']=='3')
						$sub_sql.=" and tel='".$_GET['keycon']."'";
				if($_GET['qtype']=='4')
						$sub_sql.=" and fax='".$_GET['keycon']."'";
				if($_GET['qtype']=='5')
						$sub_sql.=" and addr like '%".$_GET['keycon']."%'";
				if($_GET['qtype']=='6')
						$sub_sql.=" and company like '%".$_GET['keycon']."%'";
			}
			if(!empty($_GET['stime']))
					$sub_sql.=" and uptime >'".strtotime($_GET["stime"])."'";
			if(!empty($_GET['etime']))
					$sub_sql.=" and uptime <'".strtotime($_GET["etime"])."'";
						
			$sql="select * from ".FRIENDS." where uid='".$buid."' $sub_sql order by id desc";
			//=============================
			$page = new Page;
			$page->listRows=20;
			if (!$page->__get('totalRows'))
			{
				$this->db->query("select count(id) as num from ".FRIENDS." where uid='".$buid."'");
				$num=$this->db->fetchRow();
				$page->totalRows = $num['num'];
			}
			$sql .= "  limit ".$page->firstRow.",20";
			$this->db->query($sql);
			$re["list"]=$this->db->getRows();
			$re["page"]=$page->prompt();
			return $re;
	}
	function get_batch_friend_info()
	{	
			if(!empty($_POST['uern']))
			{
				$sql="select id,uid,username,name,email from ".FRIENDS." where id in (".$_POST['uern'].")";
				$this->db->query($sql);
				$re=$this->db->getRows();
				return $re;
			}	
	}
}
?>
