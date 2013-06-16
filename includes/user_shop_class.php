<?php

class shop{

	var $db;

	var $webUrl;

	var $tpl;

	

	function shop()

	{

		global $db,$tpl;

		$this -> db     = & $db;

		$this -> tpl    = & $tpl;

		$this -> view_user_times();

	}

	############################

	function site_spread($uid='')

	{

		global $config;

		include("config/point_config.php");

		$cip=getip();

		$nt=time();

		$gt=$nt-3600;

		$sql="select * from ".SPREAD." where userid='$uid' and fromip='$cip' and ctime>$gt";

		$this->db->query($sql);

		$re=$this->db->fetchRow();

		if(!empty($re['userid']))

		{

			$sql="update ".SPREAD." set access_num=access_num+1,ctime='$nt' where userid='$uid' and fromip='$cip' and ctime>$gt";

			$this->db->query($sql);

		}

		else

		{

			$sql="insert into ".SPREAD." (`userid`,`fromip`,`ctime`) values ('$uid','$cip','$nt')";

			$this->db->query($sql);

			$sql="update ".USER." set point=point+$point_config[promote] where userid='$uid'";

			$this->db->query($sql);

		}

		return true;

	}

	function get_custom_cat_list($type="")

	{

		global $config;

		if($type=='1')

		{

			$str=" and pid='0'";	

		}

		$sql="select * from ".CUSTOM_CAT." where userid='$_GET[uid]' and type='$type' $str order by nums asc";

		$this->db->query($sql);

		$re=$this->db->getRows();

		for($i=0;$i<count($re);$i++)

		{

			if($type=='1')

			{

				$sids="";

				$sql="select id from ".CUSTOM_CAT." where userid='$_GET[uid]' and type='$type' and pid='".$re[$i]['id']."' order by nums asc";

				$this->db->query($sql);

				$res=$this->db->getRows();

				foreach($res as $val)

				{

					$sids=$val['id'].','.$sids;

				}

				$sids=$sids.$re[$i]['id'];

				$sql="select count(*) as custom_cat_count from ".CUSTOM_CAT_REL." where custom_cat_id in ($sids)";

			}

			else

				$sql="select count(*) as custom_cat_count from ".CUSTOM_CAT_REL." where custom_cat_id = ".$re[$i]['id'];	

			$this->db->query($sql);

			$custom_rel_list=$this->db->fetchRow();

			$re[$i]["count"] = $custom_rel_list['custom_cat_count'];

		}

		return $re;

	}

	function user_detail($uid)

	{	

		global $config,$action;

		if(!is_numeric($uid))

			$sql="select * from ".USER." WHERE user='$uid'";

		else

			$sql="select * from ".USER." WHERE userid='$uid'";

		$this ->db ->query($sql);

		$com=$this ->db->fetchRow();

		if($com)

		{	

			//-----------------------------------------

			$_GET["uid"]=$uid;

			$ifpay=empty($com['ifpay'])?2:$com['ifpay'];

			include($config['webroot']."/config/usergroup.php");

			$medallog=empty($group[$ifpay]['logo'])?$config['weburl']."/image/default/nopic.gif":$group[$ifpay]['logo'];

			$com['medal']="<img src=".$medallog." />";

			$com['rank']=$group[$ifpay]['name'];

			$com['jsbook']=$group[$ifpay]['modeu']['jsbook'];

			$com['open_info_type']=$group[$ifpay]['modeu']['open_info_type'];

			$com["time_long"]=date("Y")-substr($com["regtime"],0,4)+1;

			unset($group);

			//----------------------country-------------

			if($config['language']=='cn')

				$sqlo="select cname as countryname from ".COUNTRY." where id='".$com['country']."'";

			else

				$sqlo="select ename as countryname from ".COUNTRY." where id='".$com['country']."'";

			$this ->db ->query($sqlo);

            $com["country"]=$this->db->fetchField('countryname');

			//----------------------COMPANYCAT------------------

			if (!empty($com["catid"]))

			{

				$strcat=explode(",",$com["catid"]);

				$st=implode("','",$strcat);

				$sqlo="select cat  from ".COMPANYCAT." where catid in ('".$st."')";

				$this ->db ->query($sqlo);

				$catn=$this ->db->getRows();

				$com["catname"]='';

				foreach($catn as $vc)

				{

					$com["catname"].=$vc['cat'].'&nbsp;|&nbsp;';

				}

			}

			//----------------------------------------------------

			$sql="select qq,msn,skype,position,name,mobile,tel,email from ".ALLUSER." where userid='$uid'";

			$this->db->query($sql);

			$com=array_merge($this->db->fetchRow(),$com);

			//----------------------------------------------------

			$this ->tpl->assign("com",$com);

			return $com;

		}

		else

			msg($config['weburl'].'/404.php');

	}

		function get_user_detail($uid,$type=1)

	{

		$sql="select intro,logo as img from ".UDETAIL." where userid='$uid' and type=$type";

		$this->db->query($sql);

		return $this->db->fetchRow();

	}



	function get_user_link()

	{

		if(isset($_GET['uid']))

		{

			$sql="select * from ".ULINK." WHERE userid='$_GET[uid]'";

			$this->db->query($sql);

			return $this->db->getRows();

		}

	}

	function view_user_times()

	{

		$sql="update ".USER." SET view_times=view_times+1 WHERE userid='$_GET[uid]'";

		$this ->db ->query($sql);

	}

	function comments_user()

	{

		$sql="select user from ".ALLUSER." where userid='$_GET[uid]'";

		$this->db->query($sql);

		$re=$this->db->fetchRow();

		return $re;

	}

	 function comments()

	 {

	 	global $config;

		$sql="SELECT a.uid,a.con, a.time, b.user FROM ".CDES." a RIGHT JOIN ".ALLUSER." b 

			 ON (a.uid = b.userid) where a.touid=$_GET[uid] order by a.time desc";

        //*--------------------分页开始

			include_once($config['webroot']."/includes/page_utf_class.php");

			$page = new Page;

			$page->listRows=10;

			$page->url= $config["weburl"]."/shop.php";

			if (!$page->__get('totalRows'))

			{

				$this->db->query($sql);

				$page->totalRows = $this->db->num_rows();

			}

			$sql .= "  limit ".$page->firstRow.", ".$page->listRows;

			$this->db->query($sql);

			$rsdes= $this->db->getRows();

			$pagersdes['list']=$rsdes;

			$pagersdes['page']=$page->prompt();

			$this->tpl->assign("des",$pagersdes);

        //------------分页结束*/

        $sql="select id,name from ".CTYPE." where company_type=(select ctype from ".USER." where userid=".$_GET['uid'].")";

        $this->db->query($sql);

        $re= $this->db->getRows();

        foreach($re as $key=>$v)

        {    

              $sql="select avg(point) as onepot from ".CREC." where touid='$_GET[uid]' and catid=".$v['id'];

		      $this->db->query($sql);

              $yilb=$this->db->fetchRow();

			  $v['point']=$yilb['onepot'];

              $sid=$v['id']."00";

              $bid=$v['id']."99";

              $sql="select id,name from ".CTYPE." where id>='$sid' and id<='$bid'";

              $this->db->query($sql);

			  $m=$this->db->getRows();

			  foreach($m as $mykey=>$s)

			  {

                 $sql="select avg(point) as pot from ".CREC." where touid='$_GET[uid]' and catid=".$s['id'];

			     $this->db->query($sql);

                 $k= $this->db->fetchRow();

                 $s['point']=$k['pot'];

				 $m[$mykey]=$s;

			  }  

             $v['subcat']=$m;

             $re[$key]=$v; 

        }

		return $re;

	 }

	function comments_submit()

	{ 

		if(!empty($_POST["submit"])&&!empty($_POST['touid']))

		{	

			global $buid,$config;

            $sql="select time from ".CREC." where touid=".$_POST['touid']." and uid=$buid order by time desc limit 1";

		    $this->db->query($sql);

		    $timers=$this->db->fetchRow();

			if (empty($timers['time'])) 

				$oldctime='0';

			else

                $oldctime=$timers['time'];

			$nowtime=time();

		    if (($nowtime-$oldctime)>3600*24)

		    {

				if (!empty($_POST['description']))

				{

					$msql="insert into ".CDES." (uid,touid,con,time) value ('$buid','$_POST[touid]','$_POST[description]','$nowtime')";

					$this->db->query($msql);

				}

				if (is_array($_POST['point']))

				{

					foreach($_POST['point'] as $key=>$v)

					{

						$msql="insert into ".CREC." (uid,touid,catid,point,time) value ('$buid','$_POST[touid]','$key','$v','$nowtime')";

						$this->db->query($msql); 

					}

				}

			}

			else

            { 

				header("Location:".$config["weburl"]."/shop.php?uid=".$_GET['uid']."&action=comments&type=1");

				exit();

		    }

		}

	}

	//  lolololo

	function get_total_rows_by_userid($table="")

	{

		$sql="select count(*) as totalrows from ".$table." where userid='$_GET[uid]'";

		$this->db->query($sql);

		$re=$this->db->fetchRow();

		return $re['totalrows'];

	}



	function get_business_validate()

	{

		$sql="select statu from ".BUSINESS." where userid='$_GET[uid]'";

		$this->db->query($sql);

		$re=$this->db->fetchRow();

		return isset($re['statu']) ? $re['statu'] : 0;

	}

	function business_info_detail()

	{

		$sql="select * from ".BUSINESS." where userid='$_GET[uid]'";

		$this->db->query($sql);

		$ks=$this->db->fetchRow();

		if($ks['com_reg_id_protect']==1){

			$ks['com_reg_id'] = substr($ks['com_reg_id'],0,strlen($ks['com_reg_id'])-4);

			$ks['com_reg_id'] .= '****';

		}

		return $ks;

	}

}

?>

