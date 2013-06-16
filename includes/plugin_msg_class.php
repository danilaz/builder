<?php

class msg

{

	var $db;

	var $tpl;

	var $page;

	function msg()

	{

		global $db;

		global $config;

		global $tpl;		

		$this -> db     = & $db;

		$this -> tpl    = & $tpl;

	}

	

	//取得用户的邮件总数,返回二维数组，$re[0][0]为未读邮件，$re[1][0]为已经读邮件

	function getMailNum()

	{

		global $db,$buid;

		$sql="SELECT count(*) as num,iflook  FROM ".FEEDBACK." where touserid='$buid' and (msgtype='1' or msgtype='3') group by iflook order by iflook desc";

		$db->query($sql);

		$re=$db->getRows();

		foreach($re as $v)

		{

			if(!$v['iflook'])

				$type='new';

			if($v['iflook']=='1')

				$type='read';

			if($v['iflook']=='2')

				$type='del';

			if($v['iflook']=='3')

				$type='del';

			$ms[$type]=$v['num'];

		}

		if(empty($ms['new']))

			$ms['new']=0;

		if(empty($ms['read']))

			$ms['read']=0;

		return $ms;

	}

	//iflook 0=new,1=look,2=del,3=save

	//contype 1=pro,2=info,3=compamy

	function mail_list($type='inbox')

	{

		global $buid;;

		if($type=='inbox')

			$sql="SELECT * FROM ".FEEDBACK." WHERE touserid='$buid' and (msgtype=1 or msgtype=3) and (iflook is null or iflook='1') ORDER BY date DESC";

		if($type=='outbox')

			$sql="SELECT * FROM ".FEEDBACK." WHERE fromuserid='$buid' and msgtype=2 and (iflook is null or iflook='1') ORDER BY date DESC";

		if($type=='savebox')

			$sql="SELECT * FROM ".FEEDBACK." WHERE touserid='$buid' and iflook='3' ORDER BY date DESC";

		if($type=='delbox')

			$sql="SELECT * FROM ".FEEDBACK." WHERE touserid='$buid' and iflook='2' ORDER BY date DESC";

		//=====================

	  	$page = new Page;

		$page->listRows=20;

		if (!$page->__get('totalRows')){

			$this->db->query($sql);

			$page->totalRows = $this->db->num_rows();

		}

        $sql .= "  limit ".$page->firstRow.",20";

		//=====================

		$this->db->query($sql);

		$list=$this->db->getRows();

		foreach($list as $key=>$v)

		{    

		   if($v["fromuserid"]==$buid&&!empty($v['touserid']))

		   {	

			   $sql="select contact,user from ".USER." where userid=".$v['touserid'];

			   $this->db->query($sql);

			   $fc=$this->db->fetchRow();

			   $v["fromname"]=$fc['user']."[$fc[contact]]";

		   }

		   if($v["fromuserid"]!=$buid&&!empty($v['fromuserid']))

		   {

			   $sql="select contact,user from ".USER." where userid=".$v['fromuserid'];

			   $this->db->query($sql);

			   $fc=$this->db->fetchRow();

			   $v["fromname"]=$fc['user']."[$fc[contact]]";

		   }

		   $list[$key]=$v;

		}

		$re["page"]=$page->prompt();

		$re["list"]=$list;

		return $re;

	}

	function remove_mail()

	{	

		global $buid;

		if(isset($_POST["deid"])&&!empty($_POST['remove']))

		{

			for($i=0;$i<count($_POST["deid"]);$i++)

			{

				$id=$_POST["deid"][$i];

				$sql="delete from ".FEEDBACK." where id='$id' and (touserid='$buid' or fromuserid='$buid')";

				$this->db->query($sql);

			}

		}

	}

	//恢复邮件

	function recover_mail()

	{

		if(isset($_POST["deid"])&&!empty($_POST['recover']))

		{

			for($i=0;$i<count($_POST["deid"]);$i++)

			{

				$id=$_POST["deid"][$i];

				$sql="update  ".FEEDBACK." set iflook=1 where id=$id";

				$this->db->query($sql);

				unset($sql);

			}

		}

	}

	//删除邮件功能

	function del_mail()

	{

		if(isset($_POST["deid"])&&!empty($_POST['del']))

		{

			for($i=0;$i<count($_POST["deid"]);$i++)

			{

				$id=$_POST["deid"][$i];

				$sql="update  ".FEEDBACK." set iflook=2 where id=$id";

				$this->db->query($sql);

				unset($sql);

			}

		}

	}

	//保存邮件功能

	function save_mail()

	{

		if(isset($_POST["deid"])&&!empty($_POST['save']))

		{

			for($i=0;$i<count($_POST["deid"]);$i++)

			{

				$id=$_POST["deid"][$i];

				$sql="update  ".FEEDBACK." set iflook=3 where id=$id";

				$this->db->query($sql);

				unset($sql);

			}

		}

	}

	//邮件详情

	function mail_det($id)

	{

		global $buid;

		$sql="select *,NULL as about from ".FEEDBACK." where id='$id'";

		$this->db->query($sql);

		$re=$this->db->fetchRow();

		if($re['iflook']<1)

		{

			$sql="update ".FEEDBACK." SET iflook=1  WHERE id='$id'";

			$this->db->query($sql);

		}

		

		if($re["fromuserid"]&&$re['msgtype']==1)

		{//收件箱

			$sql="select * from ".USER." where userid='".$re['fromuserid']."'";

			$this->db->query($sql);

			$re["fromInfo"]=$this->db->fetchRow();

		}

		if($re["touserid"]&&$re['msgtype']==2)

		{//发件箱

			$sql="select * from ".USER." where userid='".$re['touserid']."'";

			$this->db->query($sql);

			$re["fromInfo"]=$this->db->fetchRow();

		}

		if($re['contype']==1&&$re['tid'])

		{

			if(substr($re['tid'],strlen($re['tid'])-1,1)==',')

				$re['tid']=$re['tid']."0";

			$sql="select * from ".PRO." where id in ( $re[tid] ) and userid='$buid'";

			$this->db->query($sql);

			$pro=$this->db->getRows();

			foreach($pro as $v)

			{

				$re["about"].="<a href='?m=product&s=product_detail&id=$v[id]' target='_blank'>

				<img width=50 height=40 src='uploadfile/comimg/small/$v[id].jpg'><br>$v[pname]</a>";

			}

		}

		if($re['contype']==2&&$re['tid'])

		{

			$sql="select * from ".INFO." where id='$re[tid]' and userid='$buid'";

			$this->db->query($sql);

			$pro=$this->db->fetchRow();

			$re["about"]="<a href='?m=offer&s=offer_detail&id=$pro[id]' target='_blank'>$pro[title]</a>";

		}

		if($re['fromuserid'])

		{

			$sql="select id from ".FRIENDS." where fuid=$re[fromuserid]";

			$this->db->query($sql);

			$re["is_myfriend"]=$this->db->fetchField('id');

		}

		return $re;

	}

	//回复邮件

	function repliy_mail()

	{

		if(!empty($_POST["id"]))

		{

			global $config,$buid;

			$date=date("Y-m-d H:i");

			

			include($config['webroot']."/config/usergroup.php");

			$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];

			$my_group=$group[$ifpay]['modeu'];

		

			$sql="insert into ".FEEDBACK." (touserid,fromuserid,sub,con,date,msgtype) VALUES

			('$_POST[touserid]','$buid','$_POST[sub]','$_POST[con]','$date','1')";

			$this->db->query($sql);

			

			$sql="insert into ".FEEDBACK." (touserid,fromuserid,sub,con,date,msgtype) VALUES

			('$_POST[touserid]','$buid','$_POST[sub]','$_POST[con]','$date','2')";//发件箱

			$this->db->query($sql);

			

			$this->db->query("UPDATE ".FEEDBACK." set ifback='1' where id='$_POST[id]'");

			if($my_group['openmesmail'])

			{

				send_mail($_POST["toemail"],$_POST["sub"],$_POST["sub"],$_POST["con"]);

			}

			msg("main.php?action=admin_mail_list");

		}

	}

	

	//商铺中留言邮件发送功能

	function send_email()

	{

		if(!empty($_POST["submit"]))

		{	

			//===========================================================================

			global $config,$buid;$fromInfo=NULL;$date=date("Y-m-d H:i");

			$_POST['contype']=empty($_POST['contype'])?0:$_POST['contype'];

			$_POST['tid']=empty($_POST['tid'])?0:$_POST['tid'];

			$touserid=is_array($_POST['toid'])?$_POST['toid']:array('0'=>$_POST['toid']);

			$rt=$rb=$attachments=NULL;

			if(empty($buid))

			{

				$fromInfo="";

				if(!empty($_POST['name']))

					$fromInfo.="Name:$_POST[name]<br>";

				if(!empty($_POST['company']))

					$fromInfo.="Company:$_POST[company]<br>";

				if(!empty($_POST['country']))

					$fromInfo.="Country:$_POST[country]<br>";

				if(!empty($_POST['province']))

					$fromInfo.="Province:$_POST[province]<br>";

				if(!empty($_POST['city']))

					$fromInfo.="City:$_POST[city]<br>";

				if(!empty($_POST['addr']))

					$fromInfo.="Address:$_POST[addr]<br>";

				if(!empty($_POST['post']))

					$fromInfo.="Post:$_POST[post]<br>";

				if(!empty($_POST['fax']))

					$fromInfo.="FAX:$_POST[fax]<br>";

				if(!empty($_POST['tell']))

					$fromInfo.="tel:$_POST[tell]<br>";

				if(!empty($_POST['mobile']))

					$fromInfo.="Mobile:$_POST[mobile]<br>";

				if(!empty($_POST['email']))

					$fromInfo.="Email:$_POST[email]<br>";

				if(!empty($_POST['url']))

					$fromInfo.="Website:$_POST[url]<br>";

				$buid=0;

			}

			if(!empty($_POST['receive_type']))

				$rt=implode("<br>",$_POST['receive_type']);

			if(!empty($_POST['ask_reply']))

				$rb=strtotime($_POST['Date_Year'].'-'.$_POST['Date_Month'].'-'.$_POST['Date_Day']);

			else

				$rb=time()+3600*7;

			foreach($touserid as $revid)

			{

				$sql="insert into ".FEEDBACK."

					(touserid,fromuserid,fromInfo,sub,con,date,contype,tid,msgtype,receive_type,reply_by,attachments)

					VALUES

					('$revid','$buid','$fromInfo','$_POST[sub]','$_POST[con]','$date','$_POST[contype]','$_POST[tid]','1','$rt','$rb','$attachments')";

				$res=$this->db->query($sql);

				

				if($buid)

				{

					$sql="insert into ".FEEDBACK."

						(touserid,fromuserid,fromInfo,sub,con,date,contype,tid,msgtype)

						VALUES

						('$revid','$buid','$fromInfo','$_POST[sub]','$_POST[con]','$date','$_POST[contype]','$_POST[tid]','2')";

					$res=$this->db->query($sql);

				}

				

				$this->send_email_for_inquery($ar=array('toid'=>$revid,'sub'=>$_POST['sub'],'con'=>$_POST['con']));

			}

			#########################

			return $res;

		}

	}

	//发送电子邮件给客户

	function send_email_for_inquery($ar=array())

	{	

		global $config;

		include($config['webroot']."/config/usergroup.php");

		$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];

		$my_group=$group[$ifpay]['modeu'];

		if($my_group['openmesmail']&&!empty($ar))

		{

			$sql="select user,email from ".ALLUSER." where userid='$ar[toid]'";

			$this->db->query($sql);

			$user=$this->db->fetchRow();

			if(!empty($user['email']))

			{

				$mail_temp=get_mail_template('sendmsg');

				$con=$mail_temp['message'];

				$subject=$mail_temp['subject'];

				$con=str_replace("[username]",$user["user"],$con);

				$con=str_replace("[content]",$ar["con"],$con);

				send_mail($user["email"],$user["user"],$ar["sub"],$con);

				unset($con);

			}

		}

	}

	//-------------会员中心发邮件---------------------------

	function friend_msg_batch_send()

	{	

		global $buid;

		if(!empty($_POST['sendid'])&&!empty($_POST['msgcon']))

		{

			$date=date("Y-m-d H:i:s");

			$sql="select a.name,a.email,b.userid from ".FRIENDS." a, ".ALLUSER." b where a.username=b.user and a.id in (".trim($_POST['sendid'])."0)";

			$this->db->query($sql);

			$re=$this->db->getRows();

			foreach($re as $v)

			{

				$sql="insert into ".FEEDBACK." (touserid,fromuserid,fromInfo,sub,con,date,msgtype) VALUES 

				('$v[userid]','$buid','Business Friends Message','$_POST[msgtitle]','$_POST[msgcon]','$date','1')";

				$this->db->query($sql);

				

				$sql="insert into ".FEEDBACK." (touserid,fromuserid,fromInfo,sub,con,date,msgtype) VALUES 

				('$v[userid]','$buid','Business Friends Message','$_POST[msgtitle]','$_POST[msgcon]','$date','2')";

				$this->db->query($sql);

				

				if(!empty($_POST['semail'])&&$v["email"])

				{

					send_mail($v["email"],$v["name"],$_POST['msgtitle'],$_POST['msgcon']);

				}

			}

			msg("main.php?action=m&m=friend&s=admin_friends_list&msgsend=ok");

		}

		else

			msg("main.php?action=m&m=friend&s=admin_friends_list&msgsend=error");

	}



}

?>

