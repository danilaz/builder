<?php
class payment
{
	var $db;
	var $tpl;
	var $page;
	function payment()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	function payment_base()
	{
		global $buid,$config;

		$sql = "select cash,unreachable from ".ALLUSER." where userid='$buid'";
		$this->db->query($sql);
		$list = $this->db->fetchRow();
		$sql = "select * from ".ACCOUNTS." where userid='$buid'";
		$this->db->query($sql);
		$re = $this->db->fetchRow();
		if($re['userid']) {
			$list['bank'] = $re['bank'];
			$list['accounts'] = $re['accounts'];
			$list['active'] = $re['active'];
			$list['master'] = $re['master'];
		}
		return $list;
	}
	function payment_bind()
	{
		global $buid,$config;

		if(isset($_POST["action"]) && $_POST["action"]='submit'){
			$sql = "select * from ".ACCOUNTS." where userid='$buid'";
			$this->db->query($sql);
			$re = $this->db->fetchRow();
			if(!$re['userid']){
				$add_time = time();
				$sql = "insert into ".ACCOUNTS." (userid,master,bank,accounts,add_time) values('$buid','$_POST[master]','$_POST[bank]','$_POST[accounts]','$add_time')";
				$this->db->query($sql);
			}
			msg('main.php?action=admin_accounts_base');
		}
		$sql = "select * from ".ACCOUNTS." where userid='$buid'";
		$this->db->query($sql);
		$list = $this->db->fetchRow();
		return $list;
	}
	function payment_pickup()
	{
		global $buid,$config;

		$sql = "select * from ".ACCOUNTS." where userid='$buid'";
		$this->db->query($sql);
		$accounts_bind = $this->db->fetchRow();
		if(!$accounts_bind['userid']){
			header("Location: main.php?action=admin_accounts_bind&bind=1&menu=$_GET[menu]");
		}else if($accounts_bind['active'] == 0){
			header("Location: main.php?action=admin_accounts_bind&active=1&menu=$_GET[menu]");
		}

		if(isset($_POST["action"]) && $_POST["action"]='submit')
		{
			$sql = "select cash, password from ".ALLUSER." where userid='$buid'";
			$this->db->query($sql);
			$re = $this->db->fetchRow();
			if($re['password'] != md5($_POST['pword']))
				msg('main.php?action=admin_accounts_pickup&casherror=2');
			if(!is_numeric($_POST['pickup']) || $_POST['pickup']<=0 || $re['cash']<$_POST['pickup'])
				msg('main.php?action=admin_accounts_pickup&casherror=1');

			$sql = "update ".ALLUSER." set cash=cash-".$_POST['pickup'].", unreachable=unreachable+".$_POST['pickup']." 
					where userid='$buid'";
			$o=$this->db->query($sql);

			$ts=time();
			$sql="insert into ".CASHFLOW." 
			 (`userid`,`amount`,`cashflow_type`,`flowid`,`add_time`,`user_note`,`is_succeed`,`success_time`,`censor`,`check_time`)
			 values 
			 ('$buid','-".$_POST['pickup']."','2','0','$ts','2','3','$ts','','0')";
			$this->db->query($sql);
			$cashflowid=$this->db->lastid();
			$add_time = time();
			$sql = "insert into ".CASHPICKUP."
			(amount,userid,cashflowid,add_time)
			 values
			('$_POST[pickup]','$buid','$cashflowid','$add_time')";
			$this->db->query($sql);
			msg('main.php?action=admin_accounts_base&pickup=1');
		}
		$sql = "select cash from ".ALLUSER." where userid='$buid'";
		$this->db->query($sql);
		$list = $this->db->fetchRow();
		$list['bank'] = $accounts_bind['bank'];
		$list['accounts'] = $accounts_bind['accounts'];
		$list['master'] = $accounts_bind['master'];
		return $list;
	}
	function payment_cashflow()
	{
		global $buid,$config;

		$subsql = NULL;
		if(!empty($_POST['cashflow_type']))
			$subsql .= " and cashflow_type='$_POST[cashflow_type]'";
		if(isset($_POST['tstart']) && !empty($_POST['tstart'])){
			$subsql .= " and add_time>='".strtotime($_POST['tstart'])."'";
		}
		if(isset($_POST['tend']) && !empty($_POST['tend'])){
			$subsql .= " and add_time<='".(strtotime($_POST['tend'])+60*60*24)."'";
		}
		$sql = "select * from ".CASHFLOW." where userid='$buid' $subsql order by id desc";
		//=============================
		include_once("$config[webroot]/includes/page_utf_class.php");
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows'))
		{
			$this->db->query("select count(*) as num from ".CASHFLOW." where userid='$buid' $subsql");
			$num=$this->db->fetchRow();
			$page->totalRows = $num["num"];
		}
        $sql .= "  limit ".$page->firstRow.",20";
		//==================================
		$this->db->query($sql);
		$re["list"]=$this->db->getRows();
		$re["page"]=$page->prompt();
		return $re;
	}
	function payment_pay()
	{
		$sql = "select * from ".PAYMENT." where active=1 order by payment_id";
		$this->db->query($sql);
		$list = $this->db->getRows();
		return $list;
	}
	//=================================
	function buy_point()
	{
		global $buid;
		$t=TIME();
		@include_once("config/point_config.php");
		$jcas=$_POST['points']/$point_config['rmb_point'];
		$sql="update ".USER." set point=point+$_POST[points] where userid=$buid";
		$o=$this->db->query($sql);

		$sql="select cash from ".ALLUSER." where userid=$buid";
		$this->db->query($sql);
		$c=$this->db->fetchRow();
		if($c['cash']<$jcas)
		{
			msg('main.php?action=admin_accounts_base&is_suc=no');
			return false;
		}

		$sql="update ".ALLUSER." set cash=cash-$jcas where userid=$buid";
		$o=$this->db->query($sql);
		if($o)
			$is_s=1;
		else
			$is_s=0;
		$ts=time();
		$sql="insert into ".CASHFLOW." (`userid`,`amount`,`cashflow_type`,`flowid`,`add_time`,`user_note`,`is_succeed`,`success_time`,`censor`,`check_time`) values ('$buid','-$jcas','5','0','$t','8','$is_s','$ts','','0')";
		$s=$this->db->query($sql);
		if($is_s&&$s)
			msg('main.php?action=admin_buy_point&is_suc=yes');
		else
			msg('main.php?action=admin_accounts_base&is_suc=no');		
	}
	function point_ranks()
	{
		global $buid;
		$sql="select a.point,(select count(1)+1 FROM ".USER." b WHERE b.point >a.point) as rank from ".USER." a 
			where a.userid='$buid' order by a.point";
		$this->db->query($sql);
		$r=$this->db->fetchRow();
		return $r;
	}
	function get_group()
	{
		global $buid;
		$sql = "select ifpay from ".USER." where userid='$buid'";
		$this->db->query($sql);
		$r=$this->db->fetchRow();
		return $r;
	}
	//生成在线支付连接，并做好记录
	function online_pay()
	{
		//第一步写入流水记录，状态为处理中。
		global $buid,$config;
		$amount=trim($_POST['amount'])*1; $time=time();
		if($_POST['payment_type']=='alipay') $user_note=10;
		if($_POST['payment_type']=='tenpay') $user_note=11;
#		if($_POST['payment_type']=='webmoney') $user_note=12;//ch
			
		$sql="insert into ".CASHFLOW."
			(`userid`,`amount`,`cashflow_type`,`add_time`,`user_note`,`is_succeed`,`success_time`,`check_time`)
			values
			('$buid','$amount','1','$time','$user_note','3','0','0')";
		$this->db->query($sql); $id=$this->db->lastid();
		if($_POST['payment_type']=='tenpay'&&$id)
		{
			$url=$config['weburl']."/main.php?action=admin_accounts_base&onlinepaytype=tenpay";
			require_once($config['webroot']."/lib/pay/tenpay/classes/PayRequestHandler.class.php");
			$configs=$this->get_pay_config('tenpay');
			$strDate = date("Ymd");$strTime = date("His");$randNum = rand(1000, 9999);//4位随机数。
			$transaction_id = $configs['tenpay_account'] . $strDate . $strTime.$randNum;/* 财付通交易单号*/
			$reqHandler = new PayRequestHandler();
			$reqHandler->init();
			$reqHandler->setKey($configs['tenpay_key']);
			$reqHandler->setParameter("bargainor_id", $configs['tenpay_account']);	//商户号
			$reqHandler->setParameter("sp_billno", $id);						//商户订单号
			$reqHandler->setParameter("transaction_id", $transaction_id);		//财付通交易单号
			$reqHandler->setParameter("total_fee", $amount*100);				//商品总金额,以分为单位
			$reqHandler->setParameter("return_url", $url);						//返回处理地址
			$reqHandler->setParameter("desc", $config['company']);				//商品名称
			//$reqHandler->setParameter("spbill_create_ip", $_SERVER['REMOTE_ADDR']);//用户ip
			$link = $reqHandler->getRequestURL();
			msg($link);

		}
		
		if($_POST['payment_type']=='webmoney'&&$id)//ch
		{
			$configs=$this->get_pay_config('webmoney');
			$configs['comment']=base64_encode('Зачисление средств на счет пользователя '.$_COOKIE['USER']);
			$sql="select * from ".PAYMENT." where payment_type='webmoney'";
			$this->db->query($sql);
			$payment=$this->db->fetchRow();
			$amount1=$amount+($amount/100*$payment['payment_commission']);
			
			$dom  = new domDocument('1.0','Windows-1251');
			if ($dom->load('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d.m.Y'))) {
				$currency = array();
				$valute = $dom->getElementsByTagName('Valute');
				foreach($valute as $val) {
					$v = $val->getElementsByTagName('Value')->item(0)->nodeValue;
					$c = $val->getElementsByTagName('CharCode')->item(0)->nodeValue;
					$currency[$c] = str_replace(',','.',$v);
				}
				$currency['RUR'] = '1';
			}
			
			if(preg_match("/^R[0-9]{12}$/i",$configs['webmoney_purser'])) {
				$select_currency.= '<option value="'.$configs['webmoney_purser'].'">RUR - Российский рубль</option>';
				$js_currency_array.= '"'.$configs['webmoney_purser'].'" : "'.(floor($amount1/$currency['RUR']*100)/100).'",';
			} if(preg_match("/^Z[0-9]{12}$/i",$configs['webmoney_pursez'])) {
				$select_currency.= '<option value="'.$configs['webmoney_pursez'].'">USD - Доллар США</option>';
				$js_currency_array.= '"'.$configs['webmoney_pursez'].'" : "'.(floor($amount1/$currency['USD']*100)/100).'",';
			} if(preg_match("/^E[0-9]{12}$/i",$configs['webmoney_pursee'])) {
				$select_currency.= '<option value="'.$configs['webmoney_pursee'].'">EUR - Евро</option>';
				$js_currency_array.= '"'.$configs['webmoney_pursee'].'" : "'.(floor($amount1/$currency['EUR']*100)/100).'",';
			} if(preg_match("/^U[0-9]{12}$/i",$configs['webmoney_purseu'])) {
				$select_currency.= '<option value="'.$configs['webmoney_purseu'].'">UAH - Украинские гривены</option>';
				$js_currency_array.= '"'.$configs['webmoney_purseu'].'" : "'.(floor($amount1/$currency['UAH']*100)/100).'",';
			}
			
			echo '
			<table width="100%" height="100%" border="0"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td align="center">
			<div style="color:silver"><h2>Выбор валютного кошелька</h2></div>
				<img src="http://chinascript.org/image/payment/webmoney.gif">
				<br/><br/>
				<form id="input_form" action="https://merchant.webmoney.ru/lmi/payment.asp" method="POST">
					<input type="hidden" value="1" name="LMI_PAYMENT_MODE">
					<input type="hidden" value="1" name="LMI_PAYMENT_NO">
					<input type="hidden" value="'.$_COOKIE['USER'].'" name="USER">
					<input type="hidden" value="'.$configs['comment'].'" name="LMI_PAYMENT_DESC_BASE64">
					<select name="LMI_PAYEE_PURSE" id="currency" onchange="document.getElementById(\'amount\').value = js_currency_array[this.value]">'.$select_currency.'</select>
					<br/><br/>
					<div style="width:200px;border-bottom:1px dashed #CCCCCC">К оплате: <input type="text" value="" name="LMI_PAYMENT_AMOUNT" id="amount" readonly="readonly" style="width:80px;border:0;text-align:right;color: #F26C4F; font-weight: 700;">&nbsp;ед.</div>
					<br/><br/>
					<input type="submit" value="Перейти к оплате">
				</form>
			</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table>
			<script>
				js_currency_array = {'.$js_currency_array.'};
				currency = document.getElementById(\'currency\').value;
				document.getElementById(\'amount\').value = js_currency_array[currency];
			</script>';
			exit;
		}//ch
		
		if($_POST['payment_type']=='alipay'&&$id)
		{
			require_once($config['webroot']."/lib/pay/alipay/lib/alipay_service.class.php");
			$configs=$this->get_pay_config('alipay');

			$parameter = array(
				"service"         => "create_direct_pay_by_user",   //交易类型
				"payment_type"    => "1",               			//默认为1,不需要修改
				"partner"         => $configs['partner'], 			//合作商户号
				"_input_charset"  => 'UTF-8',   					//字符集，默认为GBK
				"seller_email"    => $configs['seller_email'],    	//卖家邮箱，必填
				"return_url"      => $configs['return_url'],       	//同步返回
				"notify_url"      => $configs['notify_url'],       	//异步返回
				"out_trade_no"    => $id,     						//商品外部交易号，必填（保证唯一性）
				"subject"         => $config['company'],  			//商品名称，必填
				"body"            => $config['company'],     		//商品描述，必填
				"total_fee"       => $amount,       				//商品单价，必填（价格不能为0）
				"show_url"        => $config['weburl'], 			//商品相关网站
				"paymethod"			=> $paymethod,//默认支付方式，取值见“即时到帐接口”技术文档中的请求参数列表
				"defaultbank"		=> $defaultbank,//默认网银代号，代号列表见“即时到帐接口”技术文档“附录”→“银行列表”
				"anti_phishing_key"	=> $anti_phishing_key,//防钓鱼时间戳
				"exter_invoke_ip"	=> $exter_invoke_ip,//获取客户端的IP地址，建议：编写获取客户端IP地址的程序
				"extra_common_param"=> $extra_common_param,//自定义参数，可存放任何内容（除=、&等特殊字符外），不会显示在页面上
				"royalty_type"		=> $royalty_type,//提成类型，该值为固定值：10，不需要修改
				"royalty_parameters"=> $royalty_parameters//提成类型，该值为固定值：10，不需要修改
			);
			$alipayService = new AlipayService($configs);
			echo $alipayService->create_direct_pay_by_user($parameter);
		}
	}
	//处理在线友付返回结果。
	function apply_result()
	{
		global $config;
		if(empty($_GET['onlinepaytype']))
			return NULL;
		if(!empty($_GET['onlinepaytype'])&&$_GET['onlinepaytype']=='alipay')
		{
			unset($_GET['menu']);unset($_GET['onlinepaytype']);unset($_GET['action']);//删除原有参数，不然会影响他原来的值
			
			$sign=$_GET['sign'];
			$tradeno=$_GET['out_trade_no'];//站内流水ＩＤ
			$payflowid=$_GET['trade_no'];//支付宝交易号
			$suc=$_GET['is_success']=='T'?true:false;
			$total_fee=$_GET['total_fee'];
			
			$configs=$this->get_pay_config('alipay');
			require_once($config['webroot']."/lib/pay/alipay/lib/alipay_notify.class.php");
			$alipayNotify = new AlipayNotify($configs);
			$verify_result = $alipayNotify->verifyReturn();
			$_GET['menu']='trade';//菜单的切换
		}
		if(!empty($_GET['onlinepaytype'])&&$_GET['onlinepaytype']=='tenpay')
		{
			require_once($config['webroot']."/lib/pay/tenpay/classes/PayResponseHandler.class.php");
			$configs=$this->get_pay_config('tenpay');
			$key = $configs['tenpay_key'];/* 密钥 */
			$resHandler = new PayResponseHandler();/* 创建支付应答对象 */
			$resHandler->setKey($key);	//判断签名
			if($resHandler->isTenpaySign())
			{
				$payflowid = $resHandler->getParameter("transaction_id");//交易单号
				$tradeno= $resHandler->getParameter("sp_billno");//站内流水ＩＤ
				$total_fee = $resHandler->getParameter("total_fee")/100;//金额,以分为单位
				$pay_result = $resHandler->getParameter("pay_result");//支付结果
				if( "0" == $pay_result )
				{
					$verify_result=true;
					$suc=true;
				}
				else
					$verify_result=false;
			}
			else 
				$verify_result=false;
		}
		
		$sql="select flowid,userid,is_succeed from ".CASHFLOW." where id='$tradeno'";//验证签名
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		$userid=$re['userid'];
		$is_succeed=$re['is_succeed'];
		if($verify_result&&$is_succeed==3)//如果验证成功,并且流水表中的记录为新提交
		{
			if($suc==true)
			{
				$sql="update ".CASHFLOW." set 
				amount='$total_fee',flowid='$payflowid',is_succeed='1',success_time='$time'
				where id='$tradeno'";
				$this->db->query($sql);
				$sql="update ".ALLUSER." set cash=cash+$total_fee where userid='$userid'";
				$this->db->query($sql);
			}
			else
			{
				$sql="update ".CASHFLOW." set amount='$total_fee',flowid='$tradeno',is_succeed='2',success_time='$time'
				where id='$tradeno'";
				$this->db->query($sql);
			}
		}
		else
			return NULL;
	}
	function get_pay_config($type)
	{
		global $config;
		$sql="select * from ".PAYMENT." where payment_type='$type'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		$re=unserialize($re['payment_config']);
		foreach($re as $v)
		{
			$name=$v['name'];
			$cn[$name]=$v['value'];
		}
		if($type=='alipay')
		{
			$url=$config['weburl']."/main.php?action=admin_accounts_base&onlinepaytype=alipay&menu=trade";
			$cn['sign_type']    = 'MD5';
			$cn['input_charset']= 'utf-8';
			$cn['transport']    = 'http';
			$cn['return_url']   = $url;
			$cn['notify_url']   = $url;
		}
		return $cn;
	}
	function upgrade_group()
	{
		global $buid;
		$st=TIME();
		$et=$st+365*60*60*24*$_POST['years'];
		$v=explode('-',$_POST['gp']);
		$fee=$v[0]*$_POST['years'];
		$sql="select cash from ".ALLUSER." where userid=$buid";
		$this->db->query($sql);
		$c=$this->db->fetchRow();
		if($c['cash']<$fee)
		{
			msg('main.php?action=admin_upgrade_group&is_suc=no');
			return false;
		}
		
		$sql="update ".ALLUSER." set cash=cash-$fee where userid=$buid";
		$this->db->query($sql);
		
		$sql="update ".USER." set stime='$st',etime='$et',ifpay='$v[1]' where userid=$buid";
		$o=$this->db->query($sql);
		
		$sql="update ".PRO." set ifpay='$v[1]' where userid=$buid";
		$o=$this->db->query($sql);
		
		if($o)
			$is_s=1;
		else
			$is_s=0;
		$ts=time();
		$sql="insert into ".CASHFLOW." (`userid`,`amount`,`cashflow_type`,`flowid`,`add_time`,`user_note`,`is_succeed`,`success_time`,`censor`,`check_time`) values ('$buid','-$fee','6','1','$st','9','$is_s','$ts','','0')";
		$s=$this->db->query($sql);
		if($is_s&&$s)
			msg("main.php?action=admin_upgrade_group&is_suc=yes&menu=$_GET[menu]");
		else
			msg("main.php?action=admin_upgrade_group&is_suc=no&menu=$_GET[menu]");	
	}
}
?>
