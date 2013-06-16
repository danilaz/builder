<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
include_once("../config/usergroup.php");
//====================================
if(!isset($_GET['keyword']))
	$_GET['keyword']=NULL;
	
if(!empty($_POST['de'])&&empty($_POST['passall']))
{
	del_user($_POST['de']);
}

if(!empty($_POST['passall']))
{//审核所有会员
	$sql="update ".USER." set ifpay=2 where ifpay=1 or ifpay='' or ifpay is null";
	$db->query($sql);
	$sql="update ".PRO." set ifpay=2 where ifpay=1 or ifpay='' or ifpay is null";
	$db->query($sql);
	unset($sql);
}

if(!empty($_POST['delall']))
{//删除待审核会员
	$db->query("delete from ".ALLUSER." where userid in ( select userid from ".USER." where ifpay=1)");
	$db->query("delete from ".USER." where ifpay=1");
}


function del_user($ar)
{
	global $db,$config;
	foreach($ar as $v)
	{	
		$userid=$v;

		$db->query("select catid from ".USER." where userid='$userid'");
		$re=$db->fetchRow();
		$catid=explode(",",$re['catid']);
		foreach($catid as $vc)
		{
			update_cat_nums($vc,'del','com');
		}
		$db->query("delete from ".INFO." where userid='$userid'");
		$db->query("delete from ".FEED." where userid='$userid'");
		$db->query("delete from ".FEEDBACK." where touserid='$userid' or fromuserid='$userid'");
		$db->query("delete from ".ZP." where userid='$userid'");
		$db->query("delete from ".CUSTOM_CAT." where userid='$userid' and type=6");
		$db->query("delete from ".UDOMIN." where userid='$userid'");
		$db->query("delete from ".BUSINESS." where userid='$userid'");
		$db->query("delete from ".ALLUSER." where userid='$userid'");

		
		//-----------------
		$db->query("select id from ".PRO." where userid='$userid'");
		while($db->next_record())
		{
			$id=$db->f('id');
			@unlink("../uploadfile/comimg/big/$id.jpg");
			@unlink("../uploadfile/comimg/small/$id.jpg");	
		}
		$db->query("delete from ".PRO." where userid='$userid'");
		
		//-----------------lolololo
		$db->query("select id from ".ALBUM." where userid='$userid'");
		$rec = $db->getRows();
		for($i=0;$i<count($rec);$i++)
		{
			$id=$rec[$i]['id'];
			$db->query("delete from ".CUSTOM_CAT_REL." where relating_id='$id' and custom_cat_type=6");
		}

		//-----------------lolololo
	   $db->query("select id from ".CUSTOM_CAT." where userid='$userid'");
		while($db->next_record())
		{
			$id=$db->f('id');
			@unlink("../uploadfile/catimg/size_small/$id.jpg");	
		}
		$db->query("delete from ".CUSTOM_CAT." where userid='$userid'");
		
		//-----------------lolololo
		$db->query("delete from ".BUSINESS." where userid='$userid'");
		$db->query("delete from ".ACCOUNTS." where userid='$userid'");
		$db->query("delete from ".CASHFLOW." where userid='$userid'");
		$db->query("delete from ".CASHPICKUP." where userid='$userid'");

		//------------
		$db->query("select id from ".ALBUM." where userid='$userid'");
		while($db->next_record()){
			$id=$db->f('id');
			@unlink("../uploadfile/zlimg/size_small/$id.jpg");
			@unlink("../uploadfile/zlimg/$id.jpg");	
		}
		$db->query("delete from ".ALBUM." where userid='$userid'");

		//------------
		$db->query("select logo from ".USER." where userid='$userid'");
		$logo=$db->fetchField('logo');
		@unlink("../uploadfile/userimg/$logo.jpg");
		@unlink("../uploadfile/userimg/size_small/$logo.jpg");
		
		$db->query("delete from ".USER." where userid='$userid'");
		$db->query("delete from ".UDETAIL." where userid='$userid'");
        $db->query("delete from ".COMMENT." where fromuid='$userid'");
		$db->query("delete from ".FAVORITE." where userid='$userid'");
		$db->query("delete from ".READREC." where userid='$userid'");
		$db->query("delete from ".SUBSCRIBE." where userid='$userid'");
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
<title><?php echo lang_show('admin_system');?></title>
</head>
<body>

<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('query');?></div>
	<div class="bigboxbody">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
	$categorys['company']=lang_show('company_name');
	$categorys['user']=lang_show('user_id');
	$categorys['contact']=lang_show('contact');
	$categorys['ctype']=lang_show('company_type');
	$categorys['tel']=lang_show('company_tel');
	$categorys['ip']='IP';
	$categorys['email']='E-mail';
	
	if(!isset($_GET['category']))
		$_GET['category']=NULL;
	if(!isset($_GET['ctype']))
		$_GET['ctype']=NULL;
	if(!isset($_GET['only']))
		$_GET['only']=NULL;
	if(!isset($_GET['order']))
		$_GET['order']=NULL;
?>
<form name="frmuser" method="get" action="member.php">
<tr > 
      <td width="60%" height="22">
       Ключевые слова: 
		<select name="category">
        	<?php foreach($categorys as $keys=>$v){ ?>
		    <option value="<?php echo $keys;?>" <?php if($_GET['category']==$keys ) echo "selected";?> ><?php echo $v; ?></option>
            <?php } ?>
		</select>
		<input name="keyword" type="text" value="<?php echo $_GET['keyword'];?>" size="40">
		</td>
  </tr>
  <tr>
      <td width="13%" height="22">
	  <?php echo lang_show('company_type');?>: 
	  <select name="ctype">
		<option value=""><?php echo lang_show('all_company_type');?></option>
		<?php
		include_once("../lang/" . $config['language'] . "/company_type_config.php");
		foreach($companyType as $v)
		{
		?>
			<option value="<?php echo $v?>" <?php if($v==$_GET['ctype']) echo "selected"; ?>><?php echo $v?></option>
		<?php
		}
		?>
	   </select>
	  <?php echo lang_show('belong_industry');?>:
	  <select  name="catid">
		<option value=""><?php echo lang_show('all_industry');?></option>
		<?php
		$db->query("select catid,cat from ".COMPANYCAT." where catid<9999");
		while($db->next_record()){
		$datacatid=$db->f("catid");
		$datacat=$db->f("cat");
		if($datacatid==$_GET['catid']) echo "<option value=$datacatid selected>-- $datacat</option>"; else echo "<option value=$datacatid>-- $datacat</option>";
		}
		?> 
	  </select>		  </td>
  </tr>
  
	<tr>
      <td width="13%" height="22"> 
        <?php echo lang_show('member_type');?>:
        <select name="only" id="only">
             <option value="" selected><?php echo lang_show('all_member');?></option>
           <?php
            $sql="select * from ".USERGROUP." order by group_id asc";
            $db->query($sql);
            $re=$db->getRows();
            foreach($re as $v)
	          {
           ?>
          <option value="<?php echo $v['group_id']; ?>" <?php if($_GET['only']==$v['group_id']) echo "selected"; ?>><?php echo $v['name']; ?></option>  
           <?php
              }
           ?>     
          </select>
        Пользователь:
        <select name="identity" id="identity">
		　<option value="">Все</option>
          <option <?php if (!empty($_GET['identity'])&&$_GET['identity']=='1') echo "selected";?> value="1">Покупатель</option>
          <option <?php if (!empty($_GET['identity'])&&$_GET['identity']=='2') echo "selected";?> value="2">Продавец</option>
          <option <?php if (!empty($_GET['identity'])&&$_GET['identity']=='3') echo "selected";?> value="3">И то и другое</option>
        </select>        </td>
  </tr>
	<tr>
      <td width="13%" height="22"> 
        Режим отображения:
        <select name="ordrby">
          <option <?php if (!empty($_GET['ordrby'])&&$_GET['ordrby']=='regtime') echo "selected";?> value="regtime"><?php echo lang_show('from_reg_time');?></option>
		  <option <?php if (!empty($_GET['ordrby'])&&$_GET['ordrby']=='point') echo "selected";?> value="point">Бальная система</option>
		  <option <?php if (!empty($_GET['ordrby'])&&$_GET['ordrby']=='rank') echo "selected";?> value="rank">По рейтингу</option>
		  <option <?php if (!empty($_GET['ordrby'])&&$_GET['ordrby']=='tj') echo "selected";?> value="tj">По рекомендациям</option>
        </select>
		<input type="radio" name="order" value="" <?php echo $_GET['order']==""?"checked":""?>> <?php echo lang_show('desc');?>
		<INPUT TYPE="radio" NAME="order" value="desc" <?php echo $_GET['order']=="desc"?"checked":""?>> <?php echo lang_show('asc');?>		</td>
  </tr>
  	<!-- tr>
  	  <td height="22"><?php echo lang_show('bylastlogotime');?>
  	    <label>
  	    <select name="lastlogotime" id="lastlogotime">
          <option value=""><?php echo lang_show('alllogotime');?></option>
          <option value="1" <?php if (!empty($_GET['lastlogotime'])&&$_GET['lastlogotime']=='1') echo "selected";?>><?php echo lang_show('oneh');?></option>
          <option value="2" <?php if (!empty($_GET['lastlogotime'])&&$_GET['lastlogotime']=='2') echo "selected";?>><?php echo lang_show('twoh');?></option>
          <option value="12" <?php if (!empty($_GET['lastlogotime'])&&$_GET['lastlogotime']=='12') echo "selected";?>><?php echo lang_show('halfd');?></option>
          <option value="24" <?php if (!empty($_GET['lastlogotime'])&&$_GET['lastlogotime']=='24') echo "selected";?>><?php echo lang_show('oneday');?></option>
  	      <option value="48" <?php if (!empty($_GET['lastlogotime'])&&$_GET['lastlogotime']=='48') echo "selected";?>><?php echo lang_show('twoday');?></option>
  	      <option value="72" <?php if (!empty($_GET['lastlogotime'])&&$_GET['lastlogotime']=='72') echo "selected";?>><?php echo lang_show('threeday');?></option>
  	      <option value="168" <?php if (!empty($_GET['lastlogotime'])&&$_GET['lastlogotime']=='168') echo "selected";?>><?php echo lang_show('oneweek');?></option>
  	      <option value="336" <?php if (!empty($_GET['lastlogotime'])&&$_GET['lastlogotime']=='336') echo "selected";?>><?php echo lang_show('twoweek');?></option>
  	      <option value="720" <?php if (!empty($_GET['lastlogotime'])&&$_GET['lastlogotime']=='720') echo "selected";?>><?php echo lang_show('onemonth');?></option>
	      </select>
  	    </label></td>
	  </tr -->
  	<tr>
      <td height="22"> 
		<input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>">      </td>
  </tr>
</form>
</table>
  </div>
</div>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>
<form method="post">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('member_list');?></div>
	<div class="bigboxbody">
<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center" class="menu">
  <tr height="25" style="font-weight:bold;"> 
  	<td width="30"  align="center" >
  <input name="checkbox" type="checkbox" onClick="do_select()" value="checkbox"></td>
    <td width="40"  align="left" ><?php echo lang_show('member_id');?></td>
    <td  align="left" ><?php echo lang_show('company_name');?></td>
    <td align="left" ><?php echo lang_show('reg_time');?></td>
    <td width="66" align="left" >Баллы</td>
    <td width="55" height="40" align="left" ><?php echo lang_show('rank');?></td>
    <td width="171" align="center" ><?php echo lang_show('manager');?></td>
  </tr>
  <?php
  	unset($_GET['userid']);
  	$getstr=implode('&',convert($_GET));$scl=NULL;
  	
	if(!empty($_GET['ordrby']))
		$ordrby=$_GET['ordrby'];
	else
		$ordrby='regtime';
		
	if(!empty($_GET['keyword']))
	{
		if($_GET['category']=='ip')
			$scl.=" and userid in (select userid from ".ALLUSER." where ip='$_GET[keyword]')";
		if($_GET['category']=='email')
			$scl.=" and userid in (select userid from ".ALLUSER." where email='$_GET[keyword]')";
		else
			$scl.=" and ($_GET[category] regexp '$_GET[keyword]')  ";
	}
	if(!empty($_GET['only']))
		$scl.=" and ifpay='".$_GET['only']."'";
	if($_SESSION['province'])
		$scl.=" and province='$_SESSION[province]'";
	if($_SESSION['city'])
		$scl.=" and city='$_SESSION[city]'";
	if(!empty($_GET['ctype']))
		$scl.=" and ctype='".$_GET['ctype']."'";
	if(!empty($_GET['catid']))
		$scl.=" and catid like '%,$_GET[catid]%'";
	if(!empty($_GET['identity']))
		$scl.=" and identity='$_GET[identity]'";

$sql="SELECT  user,company,contact,city,regtime,userid as buid,ifpay,regtime,addr,zip,tel,tj,etime,rank,userid,point 
 from ".USER." WHERE 1 $scl";
	if($_GET['order']) 
	   $sql.=" order by $ordrby asc";  
	else 
	   $sql.=" order by $ordrby desc ";
	//=============================
	$page = new Page;
	$page->listRows=20;
	if (!$page->__get('totalRows')){
		$db->query($sql);
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  limit ".$page->firstRow.",20";
	$pages = $page->prompt();
	//=====================
	$db->query($sql);
	$i=0;
	foreach($db->getRows() as $v)
	{
		$ifpay=$v['ifpay'];
		if(!empty($group[$ifpay]['minilogo'])&&$ifpay!=1)
			$ifpay="<img src='".$group[$ifpay]['minilogo']."' alt='".$group[$ifpay]['name']."' >";
		else
			$ifpay=NULL;
?> 
  <tr onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')"> 
    <td width="30" align="center">
	<input name="de[]" type="checkbox" id="de<?php echo $i++?>" value="<?php echo !empty($v['userid'])?$v['userid']:$v['buid']; ?>">
	</td>
	<td width="40" align="left">
	<?php
	if($v['etime'])
	{
		if($v['etime']-time()<=3600*24*7&&$v['etime']>0)
			echo "<font color='red'>*</font>";
	}
	echo $v['user'];
	?>
	</td>
    <td align="left">
	<?php if($v['tj']>0) echo '<img src="../image/default/'.$v['tj'].'.jpg">'; ?>
	<a href="<?php echo $config['weburl']; ?>/shop.php?uid=<?php echo !empty($v['userid'])?$v['userid']:$v['buid']; ?>" target="_blank">
	<?php echo $ifpay.htmlspecialchars($v['company']); ?>
	</a>
	<br>
      <?php echo $v['contact']; if(!empty($v['tel'])){ echo '&nbsp;'.lang_show('tel').':'. $v['tel']; }?>
	  </td>
    <td align="left"><?php echo $v['regtime']; ?></td>
    <td align="left">&nbsp;<?php echo $v['point']; ?></td>
    <td align="left"><?php echo $v['rank']; ?></td>
      <td align="center"><a href="sendmail.php?userid=<?php echo !empty($v['userid'])?$v['userid']:$v['buid']; ?>"><?php echo lang_show('send_mail');?></a>|<a href="membermod.php?userid=<?php echo (!empty($v['userid'])?$v['userid']:$v['buid']).'&'.$getstr; ?>"><?php echo lang_show('edit');?></a><br><a href="user_domin.php?userid=<?php echo !empty($v['userid'])?$v['userid']:$v['buid']; ?>"><?php echo lang_show('bdomin');?></a>|<a href="to_login.php?action=submit&user=<?php echo $v['user']; ?>" target="_blank"><?php echo lang_show('enteroffice');?></a></td>
  </tr>
	<?php
	}
	?> 
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="45%" height="24"><input class="btn" type="submit" name="Submit2" value="<?php echo lang_show('delete');?>" onClick='return confirm("<?php echo lang_show('are_you_sure');?>");'>
      <input class="btn" type="submit" name="passall" value="<?php echo lang_show('passunreg');?>" id="passall">
	  <input class="btn" type="submit" name="delall" value="<?php echo lang_show('delunpass');?>" id="dellall">	  </td>
    <td width="65%" align="right"><div class="page"><?php echo $pages?></div></td>
  </tr>
</table>
	</div>
</div>

</form>
</body>
</html>