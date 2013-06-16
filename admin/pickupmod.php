<?php
include_once("../includes/global.php");
include_once("../includes/tag_inc.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//========================
if(isset($_POST["action"])&&!empty($_POST['id']))
{
	if(isset($_POST["result"]))
	{
		$add_time = time();
		if($_POST["result"]==1)//成功
		{	
			$sql = "update ".CASHPICKUP." set 
				is_succeed=1,bankflow='$_POST[bankflow]',con='$_POST[con]',
				check_time='$add_time', censor='$_SESSION[ADMIN_USER]' 
				where id='$_POST[id]'";
			$db->query($sql);//更新提现记录，增加备注一栏，记录处理的流水号等。
			
			$sql = "update ".ALLUSER." set unreachable=unreachable-".$_POST['amount']." where userid=$_POST[userid]";
			$db->query($sql);//更新不可用资金
			
			if(empty($_POST['cashflowid']))
			{
				$sql = "insert into ".CASHFLOW." 
				(userid,amount,cashflow_type,add_time,is_succeed,success_time,censor,check_time,user_note) 
				values
				('$_POST[userid]','-$_POST[amount]','9','$add_time',1,$add_time,'$_SESSION[ADMIN_USER]',$add_time,'3')";
			}
			else
			{
				$sql="update ".CASHFLOW." set 
					is_succeed='1',flowid='$_POST[bankflow]',cashflow_type='9',
					censor='$_SESSION[ADMIN_USER]',check_time='$add_time'
					where id='$_POST[cashflowid]'";
			}
			$db->query($sql);//处理流水记录。有则更新，没有新建，将流水号填进去。
			
		}
		else if($_POST["result"]==2)//失败
		{
			$sql = "update ".CASHPICKUP." set 
			is_succeed=2, check_time='$add_time', censor='$_SESSION[ADMIN_USER]',bankflow='$_POST[bankflow]',con='$_POST[con]'
			where id=$_POST[id]";
			$db->query($sql);//更新提现记录
			
			$sql = "update ".ALLUSER." set unreachable=unreachable-".$_POST['amount']." where userid=$_POST[userid]";
			$db->query($sql);//处理不可以用资金
			
			$sql = "update ".ALLUSER." set cash=cash+".$_POST['amount']." where userid=$_POST[userid]";
			$db->query($sql);//增加可用资金
			if(empty($_POST['cashflowid']))
			{
				$sql = "insert into ".CASHFLOW." 
				(userid,amount,cashflow_type,add_time,is_succeed,success_time,censor,check_time,user_note) 
				values
				('$_POST[userid]','-$_POST[amount]','9','$add_time',1,$add_time,'$_SESSION[ADMIN_USER]',$add_time,'3')";
			}
			else
			{
				$sql="update ".CASHFLOW." set 
					  is_succeed='2',censor='$_SESSION[ADMIN_USER]',check_time='$add_time'
					  where id='$_POST[cashflowid]'";
			}
			$db->query($sql);//处理流水记录
		}
	}
	msg("pickuplist.php");
}
//===================
$sql = "select a.*,b.* from ".ACCOUNTS." a, ".CASHPICKUP." b where a.userid=b.userid and b.id='$_GET[id]'";
$db->query($sql);
while($db->next_record())
{
	$id=$db->f('id');
	$bank=$db->f('bank');
	$accounts=$db->f('accounts');
	$master=$db->f('master');
	$amount=$db->f('amount');
	$add_time=$db->f('add_time');
	$userid=$db->f('userid');
	$is_succeed=$db->f('is_succeed');
	$censor=$db->f('censor');
	$check_time=$db->f('check_time');
	$bankflow=$db->f('bankflow');
	$con=$db->f('con');
	$cashflowid=$db->f('cashflowid');
}
$db->query("select company from ".USER." where userid='$userid'");
$re = $db->fetchRow();
$company = $re['company'];
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('pickupm_a');?></div>
	<div class="bigboxbody">
        <form name="form1" method="post" action="">
          <table width="100%" border="0" cellpadding="4" cellspacing="0">
            <tr>
			  <input name="id" type="hidden" id="id" value="<?php echo $id;?>">
			  <input name="amount" type="hidden" id="amount" value="<?php echo $amount;?>">
			  <input name="userid" type="hidden" id="userid" value="<?php echo $userid;?>">
              <td width="99" align="right"><?php echo lang_show('pickupm_b');?></td>
              <td><?php echo $company; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('pickupm_c');?></td>
              <td><?php echo $bank; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('pickupm_d');?></td>
              <td><?php echo $master; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('pickupm_e');?></td>
              <td><?php echo $accounts; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('pickupm_f');?></td>
              <td><?php echo $amount; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('pickupm_g');?></td>
              <td>
			  <?php
				if($is_succeed==0)
				{
			  ?>
			  <input type="radio" name="result" value="0" id="r0" <?php
			  if($is_succeed==0) echo "checked"; ?>><label for="r0"><?php echo lang_show('pickupm_h');?></label>
			  <input type="radio" name="result" value="1" id="r1" <?php
			  if($is_succeed==1) echo "checked"; ?>><label for="r1"><?php echo lang_show('pickupm_i');?></label>
			  <input type="radio" name="result" value="2" id="r2" <?php
			  if($is_succeed==2) echo "checked"; ?>><label for="r2"><?php echo lang_show('pickupm_j');?></label>
			  <?php
				}
				else
				{
			  ?>
			  <?php if($is_succeed==1) echo lang_show('pickupm_i'); else if($is_succeed==2) echo lang_show('pickupm_j'); ?>
			 <?php
				}
			 ?>
			 </td>
            </tr>
			  <?php
				if($is_succeed==0){
					?>
              <tr >
                <td height="20" align="right">Номер</td>
                <td height="20" align="left">
                  <input type="text" name="bankflow" id="bankflow">
                </td>
              </tr>
              <tr >
                <td height="20" align="right">Примечания</td>
                <td height="20" align="left">
                  <textarea name="con" id="con" cols="45" rows="5"></textarea>
                </td>
              </tr>
            <tr > 
              <td height="20" align="center">&nbsp;</td>
              <td height="20" align="left">
                <input name="cc1" class="btn" type="submit" id="cc1" value=" <?php echo lang_show('modify');?> ">
                <input name="action" type="hidden" id="action" value="submit">
                <input type="hidden" name="cashflowid" value="<?php if(!empty($cashflowid)) echo $cashflowid;?>">
              </td>
            </tr>
			  <?php
				} else {
			  ?>
            <tr>
              <td align="right"><?php echo lang_show('pickupm_k');?></td>
              <td><?php echo $censor; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('pickupm_l');?></td>
              <td><?php echo dateformat($check_time); ?></td>
            </tr>
              <tr>
                <td align="right">Номер</td>
                <td><?php echo $bankflow; ?>&nbsp;</td>
              </tr>
              <tr>
                <td align="right">Примечания</td>
                <td><?php echo $con; ?>&nbsp;</td>
              </tr>
			<?php
			}
			?>
          </table>
      </form>
</div>
</div>

</body>
</html>