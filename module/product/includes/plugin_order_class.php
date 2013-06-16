<?php
//$ostatu[0]='新订单,等待卖家受理';
//$ostatu[1]='新订单,等待卖家受理';
//$ostatu[2]='卖家已受理，等待买家付款';
//$ostatu[3]='买家已付款，等待卖家发货';
//$ostatu[4]='卖家已发货，等待买家确认收货';
//$ostatu[5]='买家确认收货，订单完成';
class order
{
	var $db;
	var $tpl;
	var $page;
	function order()
	{
		global $db;
		
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}

	function buyorder($status='')
	{
		global $buid;
		if(is_numeric($status))
		    $sql="select * from ".ORDER." where buid=".$buid." and status=".$status." order by id desc";
		else
            $sql="select * from ".ORDER." where buid=".$buid." order by id desc";
        //=============================
	  	$page = new Page;
		$page->listRows=8;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",8";
		//=====================
		$this->db->query($sql);
		while($k=$this->db->fetchRow())
		{
			$k['product']=unserialize($k['product']);
			$k['next_action']=$this->get_next_action('buy',$k['status'],$k['id']);
			$k['statu_text']=$this->get_order_statu($k['status']);
			$re["list"][]=$k;
		}
		$re["page"]=$page->prompt();
		$re["process"]=$this->get_order_statu();
		return $re;
	}
	function sellorder($status='')
	{
		global $buid;
		if(is_numeric($status))
		   $sql="select * from ".ORDER." where suid=".$buid." and status=".$status." order by id desc";
		else
           $sql="select * from ".ORDER." where suid=".$buid." order by id desc";
        //=============================
	  	$page = new Page;
		$page->listRows=8;
		if (!$page->__get('totalRows')){
			$this->db->query($sql);
			$page->totalRows = $this->db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",8";
		//=============================
		$this->db->query($sql);
		while($k=$this->db->fetchRow())
		{
			$k['product']=unserialize($k['product']);
			$k['next_action']=$this->get_next_action('sell',$k['status'],$k['id']);
			$k['statu_text']=$this->get_order_statu($k['status']);
			$re["list"][]=$k;
		}
		$re["page"]=$page->prompt();
		$re["process"]=$this->get_order_statu();
		return $re;
	}
	
	function orderdetail($id,$type='buy')
	{
		global $buid;
		$sql="select * from ".ORDER." where id='$id'";
		$this->db->query($sql);
        $re=$this->db->fetchRow();
		$re['product']=unserialize($re['product']);
		$re['remainder']=$re['uptime']+10*24*60*60-time();
		$re['statu_text']=$this->get_order_statu($re['status']);
		$process=$this->get_order_statu();unset($process[0]);unset($process[5]);unset($process[6]);
		$re['process']=implode('&nbsp;<img src="image/default/more.gif" width="36" height="13" border="0" />&nbsp;',$process);
		if($re['suid']||$re['buid'])
		{
			if($type=='buy')
				$sql="select * from ".USER." where userid='$re[suid]'";
			else
				$sql="select * from ".USER." where userid='$re[buid]'";
			$this->db->query($sql);
			$re['sellinfo']=$this->db->fetchRow();
		}
		$re['next_action']=$this->get_next_action($type,$re['status'],$id);
		return $re;
		
	}
	function get_order_statu($statu=NULL)
	{	
		global $config;
		include($config['webroot']."/lang/".$config['language']."/company_type_config.php");
		if($statu!='')
			return $order_status[$statu];
		else
			return $order_status;
	}

	function get_next_action($type,$statu,$oid)
	{
		// $order_action=array('取消','现在付款','发货','确认收货');
		if($statu<5&&$statu>0)
		{
			global $config; 
			if($type=='buy')
			{
				if($statu==1)
					$index=1;//付宽
				if($statu==3)
					$index=3;//收货
				$action='admin_buyorder';
			}
			else
			{
				if($statu==2)
					$index=2;//'发货'
				$action='admin_sellorder';
			}
			if(!empty($index))
			{
				if($index>0)
					$flag=$index+1;
				else
					$flag=$index;
				include($config['webroot']."/lang/".$config['language']."/company_type_config.php");
				
				
				$str="<a class='buttons' href='main.php?action=m&m=product&s=$action&menu=$_GET[menu]&flag=$flag&id=$oid'>$order_action[$index]</a>";
				if($index==1)
				{
					$str="<a class='buttons' href='main.php?action=m&m=product&s=admin_orderpay&menu=$_GET[menu]&id=$oid'>$order_action[$index]</a>";
					$str.="<a class='buttons' href='main.php?action=m&m=product&s=$action&menu=$_GET[menu]&flag=0&id=$oid'>$order_action[0]</a>";
				}
				return $str;
				
			}
		}
	}
	function update_price($price,$oid)
	{
		if(!empty($price))
		{
			$sql="update ".ORDER." set price=price+'$price' where id='$oid'";
			$this->db->query($sql);
		}
	}
	
	function orderoption($oid="",$status="",$role="")
	{
		 if($this->order_authentiy($oid,$status,$role))
			$this->set_order_statu($oid,$status);
	}
	function order_authentiy($oid="",$status="",$role="")
	{
		global $config,$buid;
		$sql="select * from ".ORDER." where id='".$oid."'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		if(($role==0&&$re['buid']==$buid)||($role==1&&$re['suid']==$buid))
		{
			if($re['status']!=$status)
			{
				if($status==0)
				{
					if($re['status']==1||$re['status']==2)
						return true;
					else 
						return false;
				}
				if(($status-$re['status'])==1)
						return true;
				else 
						return false;
			}
			else
				return false;
		}
		else
			return false;
	}
	function set_order_statu($oid="",$status="")
	{
		$sql="update ".ORDER." set status='$status',uptime=".time()." where id='$oid'";
		$this->db->query($sql);
		//====================购买产品付费
		if($status==2)
		{	
			$od=$this->orderdetail($oid,'sell');
			$cash=$od['price'];
			$buid=$od['buid'];
						
			$sql="update ".ALLUSER." set cash=cash-$cash where userid=$buid";
			$re=$this->db->query($sql);

			$t=time();
			$sql="insert into ".CASHFLOW." 
			(`userid`,`amount`,`cashflow_type`,`flowid`,`add_time`,`user_note`,`is_succeed`,`success_time`) 
			values 
			('$buid','-$cash','3','$oid','$t','4','1','$t')";
			$re=$this->db->query($sql);
		}
		//==================给卖家账户加钱。
		if($status==4)
		{
			$od=$this->orderdetail($oid,'sell');
			$cash=$od['price'];
			$suid=$od['suid'];
			
			$sql="update ".ALLUSER." set cash=cash+$cash where userid=$suid";
			$re=$this->db->query($sql);
			
			$sql="insert into ".CASHFLOW." 
			(`userid`,`amount`,`cashflow_type`,`flowid`,`add_time`,`user_note`,`is_succeed`,`success_time`) 
			values 
			('$suid','$cash','3','$oid','".time()."','5','1','".time()."')";
			$re=$this->db->query($sql);
		}
		if($status==6)//退款
		{
			$od=$this->orderdetail($oid,'buy');
			$cash=$od['price'];
			$buid=$od['buid'];
			
			$sql="update ".ALLUSER." set cash=cash+$cash where userid=$buid";
			$re=$this->db->query($sql);
			
			$sql="insert into ".CASHFLOW." 
			(`userid`,`amount`,`cashflow_type`,`flowid`,`add_time`,`user_note`,`is_succeed`,`success_time`) 
			values 
			('$buid','$cash','3','$oid','".time()."','6','1','".time()."')";
			$re=$this->db->query($sql);
		}
		return $re;
	}
	function orderendapply($oid="")
	{
		global $buid,$config;
		if(empty($oid))
		{
			$c='Order Terminte Apply<br/>
			Order ID:'.$_POST['orderid'].'<br/>
			Company Name:'.$_POST['company'].'<br/>
			Contact:'.$_POST['contact'].'<br/>
			Tel:'.$_POST['tel'].'<br/>
			Apply reasone:<br/>'.$_POST['endreasone'];
			
			$sql="insert into ".FEED." 
			(userid,company,contact,email,mes,iflook)
			values
			('$buid','$_POST[company]','$_POST[contact]','$_POST[email]','$c','0')";
			$this->db->query($sql);
		
			$sql="update ".ORDER." set status='5',uptime=".time()." where id='$_POST[orderid]'";
			$re=$this->db->query($sql);
			
			/*
			include("$config[webroot]/config/point_config.php");
			if($point_config['point']=='1'&&$point_config['end_order']!='0')
				renew_point('',$point_config['end_order']);
			*/
			return $re;
		}
		else
			$sql="select a.*,b.company,b.contact,b.tel from ".ORDER." a,".USER." b where
			 a.id='$oid' and b.userid='$buid'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		return $re;
	}
	function orderpay($oid)
	{
		global $buid,$config;
		$sql="select * from ".ORDER." where id='$oid' and buid='$buid' and status=1";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		if(!empty($re['id']))
		{
			$re['product']=unserialize($re['product']);
			$sql="select cash from ".ALLUSER." where userid='$buid'";
			$this->db->query($sql);
			$re['cash']=$this->db->fetchField('cash');
			return $re;
		}
	}
	function orderpayupdate()
	{
		 global $buid,$config;
		 if(!empty($_POST['payid'])&&is_numeric($_POST['payid']))
		 {
			$sql="select * from ".ORDER." where id='$_POST[payid]' and buid=$buid and status=1";
			$this->db->query($sql);
			$re=$this->db->fetchRow();
			if($this->db->num_rows()==1)
			{
				$tp=$re['price']*1;
				$sql="select cash from ".ALLUSER." where userid='$buid'";
				$this->db->query($sql);
				$rc=$this->db->fetchRow();
				if($rc['cash']>=$tp)
				{
					$re=$this->set_order_statu($_POST['payid'],2);
				}
				return $re;
			}
		 }
	}

}
?>
