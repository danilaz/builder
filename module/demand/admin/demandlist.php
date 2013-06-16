<?php
include_once("../includes/page_utf_class.php");
//==========================================
if(!empty($_GET["submit"])&&$_GET["submit"]==lang_show('delete'))
{
	if(isset($_GET["de"]) && is_array($_GET["de"]))	{

		foreach($_GET['de'] as $v)
		{
			$db->query("select catid from ".$config['table_pre']."demand"." where id='$v'");
			$re=$db->fetchRow();
			update_cat_nums($re['catid'],'del','demand');
		}

		$id=implode(",",$_GET["de"]);
		$db->query("delete from ".$config['table_pre']."demand"." where id in ($id)");
		$db->query("delete from  ".DEMANDDETAIL." where demandid in ($id)");
		
	}
}
if(!empty($_GET["submit"])&&$_GET["submit"]==lang_show('auditpass')){
	if(isset($_GET["de"]) && is_array($_GET["de"])){
		$id=implode(",",$_GET["de"]);
		$sql="update ".$config['table_pre']."demand"." set statu=1 where id in ($id)";
		$db->query($sql);
	}
}
if(!empty($_GET["submit"])&&$_GET["submit"]==lang_show('rc')){
	if(isset($_GET["de"]) && is_array($_GET["de"])){
		$id=implode(",",$_GET["de"]);
		$sql="update ".$config['table_pre']."demand"." set statu=2 where id in ($id)";
		$db->query($sql);
	}
}
if(!empty($_GET["submit"])&&$_GET["submit"]==lang_show('notpass')){
	if(isset($_GET["de"]) && is_array($_GET["de"])){
		$id=implode(",",$_GET["de"]);
		$sql="update ".$config['table_pre']."demand"." set statu=0 where id in ($id)";
		$db->query($sql);
	}
}
if(!empty($_GET["submit"])&&$_GET["submit"]==lang_show('unrc')){
	if(isset($_GET["de"]) && is_array($_GET["de"])){
		$id=implode(",",$_GET["de"]);
		$sql="update ".$config['table_pre']."demand"." set statu=1 where id in ($id) and statu>1";
		$db->query($sql);
	}
}
if(!empty($_GET["submit"])&&$_GET["submit"]==lang_show('okeyalli')){
	$sql="update ".$config['table_pre']."demand"." set statu=1 where statu=0";
	$db->query($sql);
}
$sql="select *from ".OCAT." where catid<9999 order by nums asc";
$db->query($sql);
$infoCatList=$db->getRows();
$i = 0;

if(!isset($_GET['statu']))
	$_GET['statu']=4;
if(empty($_GET['statu']))
{
	if($_GET['statu']!=0)
		$_GET['statu']=4;
}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/prototype.js"></script>
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>

<form method="get" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('business_query');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12%" height="20"><?php echo lang_show('range');?>:</td>
    <td width="88%" height="20">
      <select name="type">
		<?php
			include_once("../lang/" . $config['language'] . "/company_type_config.php");
			foreach ($infoType as $key=>$value)
			{
				if($key==$_GET["type"]) 
					 echo "<option value='$key' selected >$value</option>"; 
				else
					 echo "<option value='$key'>$value</option>";
			}
		?>
      </select>
	  </td>
  </tr>
        <tr>
       <td><?php echo lang_show('recommend');?>:</td>
       <td>
       <?php
          $status=array(
              '4'=>lang_show('all'),
              '0'=>lang_show('notpass'),
              '1'=>lang_show('auditpass'),
              '2'=>lang_show('recom'),
          );
      ?> 
        <select name="statu">
        <?php
        foreach($status as $key=>$v)
        {
        ?>
          <option value="<?php echo $key;?>" <?php if($_GET['statu']==$key)echo "selected";?>>
            <?php echo $v;?>
          </option>
        <?php
         } 
        ?>
        </select>
       </td>
     </tr>
    <tr>
    <td height="20"><?php echo lang_show('key_word');?>:</td>
    <td height="20">
    <input name="key" type="text" value="<?php if(!empty($_GET['key'])) echo $_GET['key'];?>" size="35">
				  <?php
                      $title=array(
                          '1'=>lang_show('title'),
                          '2'=>lang_show('introduce'),
						  '3'=>lang_show('key_word'),
                          '4'=>lang_show('supplier')
                      );
                  ?> 
                <select name="title">
                <?php
				foreach($title as $key=>$v)
				{
				?>
                  <option value="<?php echo $key;?>" <?php if(!empty($_GET['title'])&&$_GET['title']==$key)echo "selected";?>>
				  	<?php echo $v;?>
                  </option>
                <?php
				 } 
				?>
                </select>
    </td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td height="20"><input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>">
	<input name="m" type="hidden" value="demand">
	<input name="s" type="hidden" value="demandlist.php">
	</td>
  </tr>
</table>

    </div>
</div>
</form>
<div style="float:left; height:50px; width:50%;">&nbsp;</div>
  <form action="" method="get">
  	<input name="m" type="hidden" value="demand">
	<input name="s" type="hidden" value="demandlist.php">
  <div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('business_list');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="2" cellspacing="0" >
    <tr > 
      <td width="20" height="24" ><input onClick="do_select()" type="checkbox" name="checkbox" value="checkbox"></td>
      <td width="316" ><?php echo lang_show('info_title');?></td>
      <td width="263" ><?php echo lang_show('tcatid');?></td>
      <td width="98" align="left"  ><?php echo lang_show('update_date');?></td>
      <td width="68" align="left" ><?php echo lang_show('recommend');?></td>
      <td width="74" align="left" ><?php echo lang_show('rank');?></td>
      <td width="52" align="left" ><?php echo lang_show('manager');?></td>
    </tr>
    <?php
	$scl=NULL;
	if(!empty($_GET["key"]))
	{
		if($_GET['title']==1)
			$scl=" and a.title like '%$_GET[key]%' ";
		elseif($_GET['title']==2)
			$scl=" and a.con like '%$_GET[key]%' ";
		elseif($_GET['title']==3)
			$scl=" and a.keyword='$_GET[key]' ";
		else
			$scl=" AND b.company like '%$_GET[key]%' ";
	}
	if($_GET["statu"]<4)
		$scl.=" AND a.statu=$_GET[statu] ";
	if(!empty($_GET['type']))
		$scl.=" and a.type='$_GET[type]' ";
	if($_SESSION["province"])
		$scl.=" and b.province='$_SESSION[province]'";
	if($_SESSION["city"])
		$scl.=" and b.city='$_SESSION[city]'";
		
	$sql="select a.id,a.title,a.catid,a.uptime,a.rank,a.id,b.company,b.ifpay,a.statu,a.pic,a.userid
	from ".$config['table_pre']."demand"." as a left join ".USER." as b on a.userid=b.userid  where 1 $scl order by id desc ";
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
	$re=$db->getRows();
	
	unset($_GET['s']);
	$getstr=implode('&',convert($_GET));
	//--------------------------------
	foreach($re as $v)
	{
	?> 
      <tr  onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')"> 
        <td width="20"><input name="de[]" type="checkbox" id="de" value="<?php echo $v['id']; ?>"></td>
        <td width="316">
		<?php if(!empty($v['pic'])){?><img src="../image/default/image_s.gif"><?php }?>
		<?php echo $v['title']; ?><br>
		 <a target="_blank" href="../shop.php?uid=<?php echo $v['userid'];?>">
		<?php echo lang_show('supplier');?> [<?php echo $v['company']; ?>]
		</a>
		</td>
        <td align="left">
		<?php 
			$db->query("select cat from ".OCAT." where catid= $v[catid]");
			$re = $db->fetchRow();
	?>
		<span id="show_cat<?php echo $i?>">
			<a onClick="showCat('<?php echo $i?>');return false;" href="#"><?php echo $re['cat']; ?></a>
		
		<select  style="visibility:hidden" name="catid<?php echo $i?>" id="catid<?php echo $i?>" onChange="getHTML(this.value,'tcatid<?php echo $i?>',<?php echo $i?>,'demand')">
			<option value=""><?php echo lang_show('select_category');?></option>
	<?php			foreach($infoCatList as $option){
		?> 
			<option value="<?php echo $option['catid']; ?>"><?php echo $option['cat']; ?></option>
	<?php		}
		?> 
		</select>
		<select style="visibility:hidden" name="tcatid<?php echo $i?>" id="tcatid<?php echo $i?>" onChange="getHTML(this.value,'scatid<?php echo $i?>',<?php echo $i?>,'demand')">
			<option value=""><?php echo lang_show('select_sub');?></option>
		</select>
		<select style="visibility:hidden"  name="scatid<?php echo $i?>" id="scatid<?php echo $i?>">
			<option value=""><?php echo lang_show('select_sub');?></option>
		</select>
		<span id="mod<?php echo $i?>" style="visibility:hidden"><input type="button" value="<?php echo lang_show('mod');?>" onClick="updateCat('demand',<?php echo $v['id']; ?>,<?php echo $i?>);">	  </td>
        <td width="98" align="left"><?php echo $v["uptime"];?></td>
        <td width="68" align="left">
			<?php  
			$status=array('0'=>lang_show('notpass'),'1'=>lang_show('auditpass'),'2'=>lang_show('recom')); 
			$key=$v['statu'];echo $status[$key]; 
			?>        </td>
        <td width="74" align="left">&nbsp;<?php echo $v['rank']; ?></td>
        <td width="52" align="left"> 
        <a href="module.php?m=demand&s=demandmod.php&id=<?php echo $v['id']."&$getstr"; ?>"><?php echo lang_show('manager');?></a>		</td>
      </tr>
    <?php 
		$i++;
    }
	?> 
  </table>
  <table width="100%" height="20" border="0" cellpadding="4" cellspacing="0" bgcolor="#EEEEEE">
    <tr>
      <td width="45%">
	  <input class="btn" type="submit" name="submit" value="<?php echo lang_show('okeyalli');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
	  <input class="btn" type="submit" name="submit" value="<?php echo lang_show('delete');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
      <input class="btn" type="submit" name="submit" value="<?php echo lang_show('auditpass');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
	  <input class="btn" type="submit" name="submit" value="<?php echo lang_show('notpass');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
	  <input class="btn" type="submit" name="submit" value="<?php echo lang_show('rc');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
	  <input class="btn" type="submit" name="submit" value="<?php echo lang_show('unrc');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">      </td>
      <td width="65%" align="right"><div class="page"><?php echo $pages?></div></td>
    </tr>
  </table>
  </div>
</div>
  </form>
</body>
</html>
