<?php
include_once("../includes/tag_inc.php");
//========================
if(isset($_POST["action"]))
{
  if(empty($_POST['rank']))
	$_POST['rank']=0;
  $sql="update ".PRO." set 
  	pname='$_POST[pname]',con='$_POST[con]',gg='$_POST[gg]',
   	pp='$_POST[pp]',price='$_POST[jj]',unit='$_POST[unit]',con='$_POST[con]',trade_type='$_POST[trade_type]',rank='$_POST[rank]'
   where id='$_POST[id]'";
   $db->query($sql);
   
   $sql="UPDATE ".PRODETAIL."  set detail='$_POST[prodetail]' WHERE proid=$_POST[id]";
   $db->query($sql);
   
   edit_tags($_POST['keyword'],1,$_POST['id']);
   
   unset($_GET['id']);
   $_GET['s']='prolist.php';
   msg("module.php?".implode('&',convert($_GET)));
}
//===================
$db->query("select * from ".PRO." where id='$_GET[id]' ");
while($db->next_record())
{
	$id=$db->f('id');
	$userid=$db->f('userid');
	$pname=$db->f('pname');
	$con=$db->f('con');
	$gg=$db->f('gg');
	$units=$db->f('unit');
	$pp=$db->f('pp');
	$jj=$db->f('price');
	$statu=$db->f('statu');
	$rank=$db->f('rank');
	$keyword=get_tags($id,1);
	$types=$db->f('trade_type');
}
$db->query("select * from ".PRODETAIL." where proid='$_GET[id]' ");
$re=$db->fetchRow();
$detail=$re['detail'];
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('product_mod');?></div>
	<div class="bigboxbody">
        <form name="form1" method="post" action="" enctype="multipart/form-data">
          <table width="100%" border="0" cellpadding="4" cellspacing="0">
            <tr> 
              <td width="147" align="right"><?php echo lang_show('product_name');?></td>
              <td> 
                <input name="pname" type="text" id="goods" value="<?php echo "$pname";?>" size="30">
                <input name="id" type="hidden" id="id" value="<?php echo "$id";?>">                </td>
            </tr>
			          <tr  class="menu"> 
              <td align="right" ><?php echo lang_show('brand');?></td>
              <td width="823"> 
                <input name="pp" type="text" value="<?php echo "$pp"; ?>" size="30">              </td>
            </tr>
            <tr  class="menu"> 
              <td align="right"><?php echo lang_show('specifications');?></td>
              <td width="823"> 
              <input name="gg" type="text" value="<?php echo "$gg"; ?>" size="30">              </td>
            </tr>
			<?php include_once("../lang/".$config['language']."/company_type_config.php");?>
            <tr  class="menu">
              <td align="right"><?php echo lang_show('protypes');?></td>
              <td><select name="trade_type" id="trade_type">
			   <?php 
				foreach($trade_type as $key=>$v)
				{
				?>
                <option value="<?php echo $key;?>"<?php if($types==$key) echo 'selected';?>><?php echo $v;?></option>
				<?php
				}
				?>
              </select>              </td>
            </tr>
            <tr  class="menu"> 
              <td align="right"><?php echo lang_show('price');?></td>
             <td width="823"> 
              <input type="text" name="jj" size="15" value="<?php echo "$jj"; ?>"></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('unit');?></td>
              <td>
              <?php
			  include_once("../lang/" . $config['language'] . "/company_type_config.php");
			  ?>
              <select name="unit">
              	<?php foreach($unit as $v){ ?>
              	<option <?php if($v==$units) echo 'selected';?> ><?php echo $v;?></option>
                <?php } ?>
              </select>
              </td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('keywords');?></td>
              <td><input name="keyword" type="text" value="<?php echo $keyword?>" size="30"></td>
            </tr>
			<tr>
              <td align="right"><?php echo lang_show('prosum');?></td>
              <td><textarea style="width520px; height80px;" name="con" id="con" cols="45" rows="5"><?php echo strip_tags($con);?></textarea></td>
            </tr>
            <tr>  
              <td align="right"> <?php echo lang_show('prodetail');?></td>
              <td>
			<?php
				$BasePath = "../lib/fckeditor/";
				include($BasePath."fckeditor.php");	
				$fck_en = new FCKeditor('prodetail') ;
				if($config['language']=='cn')
					$fck_en->Config['DefaultLanguage']='zh-cn';
				else
					$fck_en->Config['DefaultLanguage']='en';				
				$fck_en->BasePath    = $BasePath ;
				$fck_en->ToolbarSet  = 'Basic' ;
				$fck_en->Width='100%';
				$fck_en->Height=500;
				$fck_en->Config['ToolbarStartExpanded'] = true;
				$fck_en->Value = stripslashes($detail);
				echo $fck_en->CreateHtml();
			?>            </td>
            </tr>
            <tr  class="menu"> 
              <td align="right"><?php echo lang_show('product_image');?></td>
              <td width="823">
			  <?php
			  	   if(file_exists("../uploadfile/comimg/small/".$id.".jpg"))
					   echo "<img width=100 height=100 src='../uploadfile/comimg/small/".$id.".jpg' >";
			  ?></td>
      		</tr>
           
            <tr >
              <td height="20" align="right"><strong><?php echo lang_show('competitive_ranking');?></strong></td>
            <td height="20" align="left"><label>
                <input name="rank" type="text" id="rank" value="<?php echo $rank?>" size="30">
              </label></td>
            </tr>
            <tr > 
              <td height="20" align="center">&nbsp;</td>
              <td height="20" align="left">
                <input name="cc1" class="btn" type="submit" id="cc1" value=" <?php echo lang_show('modify');?> ">
                <input name="action" type="hidden" id="action" value="submit"></td>
            </tr>
          </table>
      </form>
</div>
</div>

</body>
</html>