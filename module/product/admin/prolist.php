<?php
//==========================================
if(isset($_GET["step"])&&$_GET["step"]=="del")
{
	$db->query("select catid from ".PRO." where id='$_GET[deid]'");
	$re=$db->fetchRow();
	update_cat_nums($re['catid'],'del','pro');

	$db->query("delete from ".PRO." where id='$_GET[deid]'");
	$db->query("delete from ".PRODETAIL." where proid='$_GET[deid]'");

	$imgfile="../uploadfile/comimg/big/".$_GET['deid'].".jpg";
	$imgfile2="../uploadfile/comimg/small/".$_GET['deid'].".jpg";
	@unlink($imgfile);
	@unlink($imgfile2);
}
if(!empty($_GET["submit"])&&$_GET["submit"]==lang_show('delete'))
{
	if(isset($_GET["de"]) && is_array($_GET["de"]))
	{

		foreach($_GET['de'] as $v)
		{
			$db->query("select catid from ".PRO." where id='$v'");
			$re=$db->fetchRow();
			update_cat_nums($re['catid'],'del','pro');
		}
		$id=implode(",",$_GET["de"]);
		$sql="delete from ".PRO." where id in ($id)";
		$db->query($sql);
		$db->query("delete from ".PRODETAIL." where proid in($id)");
		for($i=0;$i<count($_GET["de"]);$i++)
		{
			$imgBig="../uploadfile/comimg/big/".$_GET["de"][$i].".jpg";
			$imgSmall="../uploadfile/comimg/small/".$_GET["de"][$i].".jpg";
			@unlink($imgBig);
			@unlink($imgSmall);
		}
	}
}

$sql="select *from ".PCAT." where catid<9999 order by nums asc";
$db->query($sql);
$proCatList=$db->getRows();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script src="../script/my_lightbox.js" language="javascript"></script>
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
</script>
<script type="text/javascript" src="../script/prototype.js"></script>
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('product_manager');?>
</div>
<form method="get" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('search_product');?></div>
	<div class="bigboxbody">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td><?php echo lang_show('is_join_rank');?></td>
               <td><input name="order_price" type="checkbox" id="order_price" value="1" <?php if(isset($_GET["order_price"])) echo 'checked="checked"';?>></td>
             </tr>
              <tr>
               <td><?php echo lang_show('recommend');?></td>
               <td>
               <?php
				  $status=array(	  	  
					  '0'=>lang_show('notpass'),
					  '1'=>lang_show('auditpass'),
					  '2'=>lang_show('recom'),
					  '3'=>lang_show('first_recom'),
				  );
			  ?> 
                <select name="statu">
                <option value=""><?php echo lang_show('all');?></option>
                <?php
				foreach($status as $key=>$v)
				{
				?>
                  <option value="<?php echo $key;?>" <?php if(!empty($_GET['statu'])&&$_GET['statu']==$key)echo "selected";?>>
				  	<?php echo $v;?>                  </option>
                <?php
				 } 
				?>
                </select>
				</td>
            </tr>
             <tr>
               <td width="13%"><?php echo lang_show('key_word');?></td>
               <td width="87%">
			     <?php
                      $type=array(
                          '1'=>lang_show('product_name'),
                          '2'=>lang_show('con'),
						  '3'=>lang_show('key_word'),
                          '4'=>lang_show('supplier')
                      );
                  ?>
			   <select name="type">
                 <?php
				foreach($type as $key=>$v)
				{
				?>
                 <option value="<?php echo $key;?>" <?php if(!empty($_GET['type'])&&$_GET['type']==$key)echo "selected";?>> <?php echo $v;?> </option>
                 <?php
				 } 
				?>
               </select>
			   <input name="key" type="text" value="<?php if(isset($_GET["key"]))echo $_GET["key"];?>" size="35">
			   	<input name="m" type="hidden" value="product">
				<input name="s" type="hidden" value="prolist.php">
			   </td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td><input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>"></td>
             </tr>
           </table>
	</div>
</div>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>
</form>
<form action="" method="get">
<input name="m" type="hidden" value="product">
<input name="s" type="hidden" value="prolist.php">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('product_list');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr style="font-weight:bold;">
          <td width="49" height="24" >
            <?php
			if(!empty($_GET['firstRow']))
			{
			?>
			<input name="firstRow" type="hidden" value="<?php echo $_GET['firstRow'];?>">
			<?php
			}
			if(!empty($_GET['firstRow']))
			{
			?>
			<input name="totalRows" type="hidden" value="<?php echo $_GET['totalRows'];?>">
			<?php } ?>
          <input onClick="do_select()" type="checkbox" name="checkbox" value="checkbox">          </td>
          <td width="*" ><?php echo lang_show('product_name');?> </td>
          <td width="150" ><span ><?php echo lang_show('tcatid');?></span></td>
          <td width="100" style="padding:0px;">Цена на ведение бизнеса</td>
          <td width="153" style="padding:0px;" ><?php echo lang_show('supplier');?> </td>
          <td width="89" style="padding:0px;" align="center"><?php echo lang_show('update_date');?></td>
          <td width="81" style="padding:0px;" align="center"><?php echo lang_show('jingjia_ranking');?></td>
          <td width="78" style="padding:0px;" align="center"><?php echo lang_show('recommend');?></td>
          <td width="66" style="padding:0px;" align="center" ><?php echo lang_show('manager');?></td>
        </tr>
    <?php
	$psql=NULL;
	if(!empty($_GET["key"]))
	{
		$_GET["key"]=trim($_GET["key"]);
		if($_GET['type']==1)
			$psql=" and a.pname like '%$_GET[key]%' ";
		elseif($_GET['type']==2)
			$psql=" and a.con like '%$_GET[key]%' ";
		elseif($_GET['type']==3)
			$psql=" and b.keywords='$_GET[key]' ";
		else
			$psql=" AND b.company like '%$_GET[key]%' ";
	}
	if(isset($_GET['statu'])&&$_GET['statu']!='')
		$psql.=" AND a.statu=$_GET[statu] ";
	if(isset($_GET["order_price"]))
		$psql.=" AND a.rank>0";
	
	if(!empty($_SESSION["province"]))
		$psql.=" and b.province='$_SESSION[province]'";
	if(!empty($_SESSION["city"]))
		$psql.=" and b.city='$_SESSION[city]'";
	
	$sql="SELECT  a.*,b.company
	 	FROM 
			".PRO." a  left join ".USER." b on a.userid=b.userid
		WHERE
	  		1 $psql order by a.uptime desc";
	//================================
	  	include_once("../includes/page_utf_class.php");
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
	$coun_num=$db->num_rows();
	for($i=0;$i<$coun_num;$i++)
	{ 
	?>
        <tr onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')">
          <td><input name="de[]" type="checkbox" id="de" value="<?php echo $re[$i]['id']; ?>"></td>
          <td>
		  <?php
			if(file_exists("../uploadfile/comimg/small/".$re[$i]['id'].".jpg"))
				echo "<img height=50 src='../uploadfile/comimg/small/".$re[$i]['id'].".jpg' ><br>";
		  ?>
              <a href="<?php echo $config['weburl'];?>/?m=product&s=product_detail&id=<?php echo $re[$i]['id'];?>" target="_blank"><?php echo $re[$i]["pname"];?></a> </td>
          <td align="left">
		   <?php
		   	$sql="select cat from ".PCAT." where catid='".$re[$i]['catid']."'";
			$db->query($sql);
			$proCat = $db->fetchRow();
			?>
              <span id="show_cat<?php echo $i?>">
              <a onClick="showCat('<?php echo $i?>');return false;" href="#">
              <?php if(empty($proCat['cat'])) echo 'Измененить категорию';else echo $proCat['cat']; ?>
              </a>             </span>
              <select  style="visibility:hidden" name="catid<?php echo $i?>" id="catid<?php echo $i?>" onChange="getHTML(this.value,'tcatid<?php echo $i?>',<?php echo $i?>,'pro')">
                <option value=""><?php echo lang_show('select_category');?></option>
                <?php
				foreach($proCatList as $option){
				?>
                <option value="<?php echo $option['catid']; ?>">
                <?php echo $option['cat']; ?>
                </option>
                <?php }?>
              </select>
              <select style="visibility:hidden" name="tcatid<?php echo $i?>" id="tcatid<?php echo $i?>" onChange="getHTML(this.value,'scatid<?php echo $i?>',<?php echo $i?>,'pro')">
                <option value=""><?php echo lang_show('select_sub');?></option>
              </select>
              <select style="visibility:hidden"  name="scatid<?php echo $i?>" id="scatid<?php echo $i?>">
                <option value=""><?php echo lang_show('select_sub');?></option>
              </select>
              <span id="mod<?php echo $i?>" style="visibility:hidden">
              <input type="button" value="<?php echo lang_show('mod');?>" onClick="updateCat('pro',<?php echo $re[$i]["id"]; ?>,<?php echo $i?>);">
          </span> </td>
          <td style="padding:0px;"><?php echo $config['money'].$re[$i]["price"]; ?></td>
          <td style="padding:0px;"><?php echo $re[$i]["company"]; ?></td>
          <td align="center" style="padding:0px;"><?php echo str_replace(' ','<br>',$re[$i]["uptime"]); ?></td>
          <td align="center" style="padding:0px;"><?php echo $re[$i]["rank"]; ?></td>
          <td align="center" style="padding:0px;">
			<?php 
                if(readauditing($re[$i]['id'],'p'))
				{
			?>
                    <img onmouseover="$('note<? echo $re[$i]['id']; ?>').style.display='block'" onmouseout="$('note<? echo $re[$i]['id']; ?>').style.display='none'" src="../image/admin/note.gif" align="absmiddle" />
                    <div class="note" id="note<? echo $re[$i]['id']; ?>" style="display:none">
                        <?php echo readauditing($re[$i]['id'],'p'); ?>
                    </div>
            <?php 
           		 } 
            ?>
            <a href="javascript:alertWin('<?php echo lang_show('pass');?>','',355,232,'<?php echo $config['weburl']?>/admin/auditing.php?t=p&id=<?php echo $re[$i]['id']; ?>&statu=<?php echo $re[$i]['statu']; ?>');">
            <?php $status=array('-1'=>lang_show('npass'),'0'=>lang_show('wpass'),'1'=>lang_show('pass'),'2'=>lang_show('rc')); $key=$re[$i]['statu'];echo $status[$key]; ?>
            </a>       
		  </td>
          <td align="center" style="padding:0px;" >
        <a href="?id=<?php echo $re[$i]["id"]."&".implode('&',convert($_GET)).'&m=product&s=cpmod.php'; ?>" title="<?php echo lang_show('edit');?>">
       	 	<img src="../image/admin/edit.gif" />
        </a> 
        <a href="?step=del&deid=<?php echo $re[$i]["id"];?>&m=product&s=prolist.php" title="<?php echo lang_show('delete');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>')">
        	<img src="../image/admin/del.gif" />
        </a> 
           </td>
          <?php 
    	}
		?>
        </tr>
        <tr bgcolor="#EEEEEE">
          <td height="24" colspan="9" align="right" >
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="42%" style="border-bottom:none; border-top:none; text-align:left;">
			<input class="btn" type="submit" name="submit" value="<?php echo lang_show('delete');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
            <input class="btn" type="button" name="submit" value="<?php echo lang_show('audit');?>" onClick="alertWin('<?php echo lang_show('audit');?>','',355,232,'<?php echo $config['weburl']?>/admin/auditing.php?t=p&id=&statu=<?php echo "&".implode('&',convert($_GET)); ?>');">
                </td>
                <td width="58%" align="right" style="border-bottom:none; border-top:none;"><div class="page"><?php echo $pages?></div></td>
              </tr>
          </table></td>
        </tr>
      </table>
	</div>
</div>
</form>
</body>
</html>
