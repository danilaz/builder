<?php
include_once("../includes/tag_inc.php");
include_once("../lang/" . $config['language'] . "/company_type_config.php");
//=======================
if(!empty($_POST["cc"])&&$_POST["cc"]==lang_show('modify'))
{
	if (empty($_POST['rank']))
		$mrank=0;
	else
		$mrank=$_POST["rank"];
		
	$sql="update ".INFO." set 
	type='$_POST[type]', title='$_POST[title]', con='$_POST[con]', statu='$_POST[statu]', rank='$mrank', valid_time='$_POST[valid_time]' where id='$_GET[id]'";
	$db->query($sql);
	$db->query("update ".OFFERDETAIL." set detail='$_POST[detail]' where offerid='$_GET[id]'");
	edit_tags($_POST['keyword'],2,$_GET['id']);
	
	unset($_GET['id']);unset($_GET['s']);
	$getstr=implode('&',convert($_GET));
	msg("module.php?s=offerlist.php&$getstr");
}
$sql="select a.*,b.detail from ".INFO." a left join ".OFFERDETAIL." b on a.id=b.offerid where a.id='$_GET[id]'";
$db->query($sql);
if($db->next_record())
{
	$id=$db->f('id');
	$type=$db->f('type');
	$userid=$db->f('userid');
	$title=$db->f('title');
	$con=$db->f('con');
	$detail=$db->f('detail');
	$statu=$db->f('statu');
	$rank=$db->f('rank');
	$valid_time=$db->f('valid_time');
	$offer_type=$db->f('offer_type');
	$keyword=get_tags($id,2);
}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('editinfo');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
      <td>
        <form name="form1" method="post" action="" enctype="multipart/form-data">
          <table width="100%" border="0" cellpadding="4" cellspacing="0" >
            <tr> 
              <td width="84"><?php echo lang_show('info_name');?>:              </td>
              <td width="587"> 
              <input name="title" type="text" id="goods" value="<?php echo "$title";?>" size="30">              </td>
            </tr>
            <tr> 
              <td height="32" width="84"><?php echo lang_show('parent_type');?>:</td>
              <td height="32"> 
                <select name="type">
				<?php
					foreach ($infoType as $key=>$value)
					{
						if($key>0)
						{
							if($key==$type) 
								 echo "<option value='$key' selected >$value</option>"; 
							else
								 echo "<option value='$key'>$value</option>";
						}
					}
				?>
                </select>                </td>
            </tr>
            <tr>
              <td><?php echo lang_show('validtime');?></td>
              <td>
			   <select name="valid_time">
				<?php
					foreach ($validTime as $key=>$value)
					{
						if($key==$valid_time) 
							 echo "<option value='$key' selected >$value</option>"; 
						else
							 echo "<option value='$key'>$value</option>";
					}
				?>
                </select>              </td>
            </tr>
            <tr>
              <td><?php echo lang_show('kword');?></td>
              <td><input name="keyword" type="text" id="keyword" value="<?php echo $keyword;?>"></td>
            </tr>
            <tr>
              <td><?php echo lang_show('summary');?></td>
              <td>
                <textarea name="con" id="con" cols="45" rows="5"><?php echo $con;?></textarea>
              </td>
            </tr>
            <tr> 
              <td width="84"><?php echo lang_show('detail');?>:</td>
              <td>
			<?php
				$BasePath = "../lib/fckeditor/";
				include($BasePath."fckeditor.php");	
				$fck_en = new FCKeditor('detail') ;
				if($config['language']=='cn')
					$fck_en->Config['DefaultLanguage']='zh-cn';
				else
					$fck_en->Config['DefaultLanguage']='en';
				$fck_en->BasePath    = $BasePath ;
				$fck_en->ToolbarSet  = 'Default' ;
				$fck_en->Width='100%';
				$fck_en->Height=500;
				$fck_en->Config['ToolbarStartExpanded'] = true;
				$fck_en->Value = stripslashes($detail);
				echo $fck_en->CreateHtml();
			?>*</td>
            </tr>
            <tr> 
              <td width="84"><?php echo lang_show('is_recommend');?>:</td>
              <td>
              <?php
			  $status=array('0'=>lang_show('notpass'),'1'=>lang_show('auditpass'),'2'=>lang_show('recom'));
			  ?> 
                <select name="statu">
                <?php 
				foreach($status as $key=>$v)
				{
				?>
                  <option value="<?php echo $key;?>" <?php if($statu==$key)echo "selected";?>>
				  	<?php echo $v;?>                  </option>
                <?php
				 } 
				?>
                </select>*              </td>
            </tr>
			 <tr>
              <td height="22"><?php echo lang_show('rank');?>:              </td>
              <td height="22">
                <input name="rank" type="text" id="rank" value="<?php echo $rank?>">              </td>
            </tr>
            <tr > 
              <td height="20" align="center">&nbsp;</td>
              <td height="20" align="left"><input name="cc" class="btn" type="submit" id="cc" value="<?php echo lang_show('modify');?>"></td>
            </tr>
          </table>
        </form>
        </td>
    </tr>
  </table>
  </div>
  </div>
</body>
</html>