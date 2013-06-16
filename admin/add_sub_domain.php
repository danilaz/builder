<?php
/*
 *Coupright B2Bbuilder
 *Powered by http://www.b2b-builder.com
 *Auter:Brad zhang
 *Des: company cat
 *Date:2008-11-14
 */
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=======================================
$add_type=empty($_GET['add_type'])?1:$_GET['add_type'];
if(!empty($_POST["Submit"])&&empty($_GET["edit"])&&$add_type==2)
{
	$p=$_POST;
	include('../lib/allchar.php');
	
	if(!empty($p['province']))
	{
		$sql="select a.city_id,a.city from ".CITY." a,".PROVINCE." b WHERE a.province_id=b.province_id and b.province='$p[province]'";
		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $v)
		{
			$v['web_title']=str_replace('keyword',$v['city'],$p['web_title']);
			$v['web_keyword']=str_replace('keyword',$v['city'],$p['web_keyword']);
			$v['web_des']=str_replace('keyword',$v['city'],$p['web_des']);
			$v['copyright']=str_replace('keyword',$v['city'],$p['copyright']);
			$v['des']=str_replace('keyword',$v['city'],$p['des']);
			$domain=c($v['city']);
			
			$sql="insert into ".DOMAIN." 
			(`dtype`,`domain`,`con`,`con2`,`des`,web_title,web_keyword,web_des,copyright,template) 
			values 
			('1','$domain','$p[province]','$v[city]','$v[des]','$v[web_title]','$v[web_keyword]','$v[web_des]','$v[copyright]','$p[template]')";
			$re=$db->query($sql);
		}
	}
	else
	{
		$pc=getCity();
		foreach($pc as $v)
		{
			$v['web_title']=str_replace('keyword',$v['province'],$p['web_title']);
			$v['web_keyword']=str_replace('keyword',$v['province'],$p['web_keyword']);
			$v['web_des']=str_replace('keyword',$v['province'],$p['web_des']);
			$v['copyright']=str_replace('keyword',$v['province'],$p['copyright']);
			$v['des']=str_replace('keyword',$v['province'],$p['des']);
			$domain=c($v['province']);
			
			$sql="insert into ".DOMAIN." 
			(`dtype`,`domain`,`con`,`des`,web_title,web_keyword,web_des,copyright,template) 
			values 
			('1','$domain','$v[province]','$v[des]','$v[web_title]','$v[web_keyword]','$v[web_des]','$v[copyright]','$p[template]')";
			$re=$db->query($sql);
			
			foreach($v['city'] as $sv)
			{
				$sv['web_title']=str_replace('keyword',$sv['city'],$p['web_title']);
				$sv['web_keyword']=str_replace('keyword',$sv['city'],$p['web_keyword']);
				$sv['web_des']=str_replace('keyword',$sv['city'],$p['web_des']);
				$sv['copyright']=str_replace('keyword',$sv['city'],$p['copyright']);
				$sv['des']=str_replace('keyword',$sv['city'],$p['des']);
				$domain=c($sv['city']);
				
				$sql="insert into ".DOMAIN." 
				(`dtype`,`domain`,`con`,`con2`,`des`,web_title,web_keyword,web_des,copyright,template) 
				values 
				('1','$domain','$v[province]','$sv[city]','$sv[des]','$sv[web_title]','$sv[web_keyword]','$sv[web_des]','$sv[copyright]','$p[template]')";
				$re=$db->query($sql);
			}
		}
	}
	

	if($re)
		msg("sub_domain_list.php");
}
if(!empty($_POST["Submit"])&&empty($_GET["edit"])&&$add_type==1)
{
	$p=$_POST;
	$sql="insert into ".DOMAIN." 
	(`dtype`,`domain`,`con`,`con2`,`des`,logo,web_title,web_keyword,web_des,copyright,template) 
	values 
	('1','$p[domain]','$p[province]','$p[city]','$p[des]','$p[logo]','$p[web_title]','$p[web_keyword]','$p[web_des]','$p[copyright]','$p[template]')";
	$re=$db->query($sql);
	if($re)
		msg("sub_domain_list.php");
}
if(!empty($_POST["Submit"])&&!empty($_GET["edit"]))
{
	$p=$_POST;
	$p["isopen"]=$p["isopen"]?1:0;
	$sql="update ".DOMAIN." set `domain`='$p[domain]',`con`='$p[province]',`con2`='$p[city]',`des`='$p[des]',`isopen`='$p[isopen]',web_title='$p[web_title]',web_keyword='$p[web_keyword]',web_des='$p[web_des]',copyright='$p[copyright]',template='$p[template]',logo='$p[logo]' where id='$_GET[edit]'";
	$re=$db->query($sql);
	if($re)
		msg("sub_domain_list.php");
}
if(!empty($_GET["edit"]))
{
	$sql="select * from ".DOMAIN." where id='$_GET[edit]'";
	$db->query($sql);
	$de=$db->fetchRow();
}
//=========================================
function read_dir($dir)
{
	$i=0;
	$handle = opendir($dir); 
	$rdir=array();
	while ($filename = readdir($handle))
	{ 
		if($filename!="."&&$filename!="..")
		{
		  if(is_dir($dir.$filename))
		  { 
		  	 if(substr($filename,0,5)!='user_'&&substr($filename,0,8)!='special_'&&substr($filename,0,5)!='email')
		   	 	$rdir[]=$filename;
		  }
	   }
	}
	return $rdir;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
weburl='<?php echo $config['weburl'];?>';
</script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript" src="../script/prototype.js"></script>
<script type="text/javascript">
function getHTML(v,type)
{	
	var url = '../ajax_back_end.php';
	var sj = new Date();
	if(type==1)
		var pars = 'shuiji=' + sj+'&prov_id='+v;
	if(type==2)
		var pars = 'shuiji=' + sj+'&catid='+v;
	var myAjax = new Ajax.Request(
				url,
				{method: 'post', parameters: pars, onComplete: showResponse}
				);
	function showResponse(originalRequest)
	{
		if(type==1)
			var ob="city";
		else
			var ob="subcat";
		var tempStr = 'var MyMe = ' + originalRequest.responseText; 
		var i=0;var j=0;
		eval(tempStr);
		for(var s in MyMe)
		{
			++j;
		}
		$(ob).options.length =j+1;
		for(var k in MyMe)
		{
			var cityId=MyMe[k][0];
			var ciytName=MyMe[k][1];
			i++;
			$(ob).options[i].value = cityId;
			$(ob).options[i].text = ciytName;
			//if(subcat==cityId)
				//$(ob).options[i].selected = true;
	　	}	
	 }
　}
</script>
<div class="bigbox">
	<div class="bigboxhead"> <?php echo lang_show('add_type');?></div>
	<div class="bigboxbody">
<form method="post" action="" style="margin-top:0px;">
<?php if(!empty($config['baseurl'])){?>
<table width="100%" align="center" cellpadding="4" cellspacing="0" >
  <?php if(empty($_GET['editid'])){ ?>
  <tr>
    <td align="right" >&nbsp;</td>
    <td>
	<label><input onClick="window.location='add_sub_domain.php?add_type=1';" checked="checked" type="radio" name="add_type" value="1">Один субдомен</label>　
    <label><input onClick="window.location='add_sub_domain.php?add_type=2';" <?php if($_GET['add_type']==2) echo 'checked="checked"';?> type="radio" name="add_type" value="2">Массовое добавление</label>	</td>
    <td>&nbsp;</td>
  </tr>
  <?php } ?>
  <?php if($_GET['add_type']!=2){ ?>
  <tr>
    <td align="right" ><?php echo lang_show('dtype');?></td>
    <td>
        <select name="select" style="width:300px;">
          <option value="1"><?php echo lang_show('acity');?></option>
		  <option value="1"><?php echo lang_show('acat');?></option>
        </select></td>
    <td><span style="color:#666666"><?php echo lang_show('dtype_des');?></span></td>
  </tr>
  <?php } ?>
  <tr>
      <td width="13%" align="right" ><?php echo lang_show('prov');?></td>
      <td width="32%" ><label>
        <select name="province" id="province" onChange="getHTML(this.value,1)" style="width:300px;">
		<option value="">Все области</option>
		<?php
		echo get_province($de['con']);
		?>
        </select>
      </label></td>
      <td width="55%" ><span style="color:#666666"><?php echo lang_show('prov_des');?></span></td>
  </tr>
  <?php if($_GET['add_type']!=2){ ?>
  <tr>
    <td align="right" ><?php echo lang_show('city');?></td>
    <td>
      <select name="city" id="city" style="width:300px;">
      <option value=""><?php echo lang_show('all_city');?></option>
      <?php
	  if(!empty($de["con2"]))
	  {
	  ?>
		<option value="<?php echo $de["con2"];?>" selected="selected"><?php echo $de["con2"];?></option>
      <?php } ?> 
      </select></td>
    <td><span style="color:#666666"><?php echo lang_show('city_des');?></span></td>
  </tr>
  <?php }?>
    <tr>
      <td align="right" ><?php echo lang_show('temp');?></td>
      <td>
      <select name="template" id="template" style="width:300px;">
          <?php
		  $dir=read_dir('../templates/');
		  foreach($dir as $v)
		  {
		  	if(substr($v,0,1)!='.')
			{
				if($v==$de['template'])
					$sl="selected";
				else
					$sl=NULL;
				echo "<option value='$v' $sl>$v</option>";
			}
		  }
		  ?></select>		  </td>
      <td>&nbsp;</td>
    </tr>
	<?php if($_GET['add_type']!=2){ ?>
      <tr>
    <td align="right"  ><?php echo lang_show('sub_domain');?></td>
    <td>
      http://<input value="<?php echo $de['domain'];?>" name="domain" type="text" id="domain" size="20" maxlength="20">.<?php echo $config['baseurl'];?></td>
    <td><span style="color:#666666"><?php echo lang_show('domain_des');?></span></td>
      </tr>
	 
      <tr>
        <td align="right">LOGO</td>
        <td><input style="width:300px;" value="<?php echo $de['logo'];?>" id="logo" name="logo" type="text"></td>
        <td style="color:#666666">
		 [<a href="javascript:uploadfile('Загрузка логотипа','logo',180,60)">Загрузить</a>] 
		 [<a href="javascript:preview('logo');">Предпросмотр</a>]
		 [<a onclick="javascript:$('logo').value='';" href="#">Удалить</a>]</td>
      </tr> 
	  <?php } ?>
      <tr>
      <td align="right"><?php echo lang_show('substationtitle');?></td>
      <td><input value="<?php echo $de['web_title'];?>" style="width:300px;" type="text" name="web_title" id="web_title">     </td>
      <td style="color:#666666"><?php if($_GET['add_type']==2){?>
        Название страницы (title) для областей и городов, где основная часть названия города будет сгенерированна для title.         <?php } ?></td>
    </tr>
    <tr>
      <td align="right" ><?php echo lang_show('substationkey');?></td>
      <td><input value="<?php echo $de['web_keyword'];?>" style="width:300px;" type="text" name="web_keyword" id="web_keyword"></td>
      <td style="color:#666666"><?php if($_GET['add_type']==2){?>
        Ключевые слова (keywords) для областей и городов, где основная часть названия города будет сгенерированна для keywords.
          <?php } ?></td>
    </tr>
    <tr>
      <td align="right" ><?php echo lang_show('substationdes');?></td>
      <td><input value="<?php echo $de['web_des'];?>" style="width:300px;" type="text" name="web_des" id="web_des"></td>
      <td style="color:#666666"><?php if($_GET['add_type']==2){?>
        Описание (description) для областей и городов, где основная часть названия города будет сгенерированна для description.
          <?php } ?></td>
    </tr>
      <tr>
    <td align="right" ><?php echo lang_show('des');?></td>
    <td style="color:#666666" colspan="2" >
      <textarea name="des" style="width:350px;height:100px;"><?php echo $de['des'];?></textarea>
      <?php if($_GET['add_type']==2){?>
      Общее описание для областей и городов.
      <?php } ?></td>
  </tr>
      <tr>
        <td align="right" >Copyright</td>
        <td style="color:#666666" colspan="2" ><textarea name="copyright" style="width:350px;height:100px;"><?php echo $de['copyright'];?></textarea>
          <?php if($_GET['add_type']==2){?>
          Авторские права для региональных субдоменов.
          <?php } ?></td>
      </tr>
  <?php if(!empty($_GET['edit'])){ ?>
   <tr>
    <td align="right" ><?php echo lang_show('is_open');?></td>
    <td colspan="2"><input name="isopen" type="checkbox" id="isopen" value="1" <?php if($de['isopen'])echo "checked";?>></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" >
      <input class="btn" type="submit" name="Submit" value="<?php echo lang_show('submit');?>">   </td>
  </tr>
</table>
</form>
<?php
}
else
{
	admin_msg('system_config.php','Укажите в системных настройках правильный путь к сайту и базе данных!');
}
?>
</div>
</div>

</BODY>
</HTML>
