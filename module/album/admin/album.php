<?php
//========================
if(isset($_GET["deid"]))
{
	del($_GET['deid']);
}
if(!empty($_POST['submit']))
{
	foreach($_POST['de'] as $v)
		del($v);
}
function del($id)
{
	global $db;
	$db->query("delete from ".ALBUM." where id='".$id."'");
	$db->query("delete from ".CUSTOM_CAT_REL." where custom_cat_type=6 and relating_id='".$id."'");
	if(file_exists("../uploadfile/zsimg/size_small/".$id.".jpg")){
		unlink("../uploadfile/zsimg/size_small/".$id.".jpg");
	}
	if(file_exists("../uploadfile/zsimg/".$id.".jpg")){
		unlink("../uploadfile/zsimg/".$id.".jpg");
	}
}
$_GET['type']=empty($_GET['type'])?NULL:$_GET['type'];
$_GET['keyword']=empty($_GET['keyword'])?NULL:$_GET['keyword'];
$_GET['orderby']=empty($_GET['orderby'])?NULL:$_GET['orderby'];
$stime=empty($_GET['stime'])?NULL:strtotime($_GET['stime']);
$etime=empty($_GET['etime'])?NULL:strtotime($_GET['etime']);
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/Calendar.js"></script>
</HEAD>
<body>
<style>
.dek {    
     width:700px; height:300px;overflow:hidden; position:absolute;Z-INDEX: 100;left:200px; top:50px; display:none;
}
.dek img{height:300px;}
</style>
<script>
function kill()
{
	document.getElementById('dek').style.display='none';
}
function popup(str)
{
	document.getElementById('dek').style.display='block';
	document.getElementById('dek').innerHTML='<img src=\'../uploadfile/zsimg/'+str+'.jpg\' />';
}
function mouseMove(ev){
    ev = ev || window.event;
    var mousePos = mouseCoords(ev);
  	document.getElementById('dek').style.left=mousePos.x+10+'px';
	document.getElementById('dek').style.top=mousePos.y-200+'px';
}

function mouseCoords(ev){
  if(ev.pageX || ev.pageY){
    return {x:ev.pageX, y:ev.pageY};
  }
  return {
    x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,
    y:ev.clientY + document.body.scrollTop - document.body.clientTop
  };
}

document.onmousemove = mouseMove;

function do_select()
{
	 var box_l = document.getElementsByName("de[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("de[]")[j].checked==true)
	  	  document.getElementsByName("de[]")[j].checked = false;
		else
		  document.getElementsByName("de[]")[j].checked = true;
	 }
}
</script>
<DIV class="dek" id="dek"></DIV>
<form method="get" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('image_search');?></div>
	<div class="bigboxbody">&nbsp;
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="11%">Тип</td>
            <td width="89%">
              <select name="type" id="select">
                <option value="1" selected>Название компании</option>
                <option value="2" <?php if($_GET['type']==2) echo 'selected';?> >По пользователю</option>
                <option value="3" <?php if($_GET['type']==3) echo 'selected';?> >По изображению</option>
              </select>            </td>
          </tr>
          <tr>
            <td>Ключевое слово</td>
            <td><input type="text" name="keyword" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword'];?>"></td>
          </tr>
           <tr>
             <td>Дата:</td>
             <td>
          <script language="javascript">
			var cdr = new Calendar("cdr");
			document.write(cdr);
			cdr.showMoreDay = true;
			</script>
		  <input readonly name="stime" type="text" id="stime" size="20" value="<?php if(isset($stime)){echo date("Y-m-d",$stime);}?>" onFocus="cdr.show(this);">
          <input readonly onFocus="cdr.show(this);" name="etime" type="text" id="etime" size="20" value="<?php if(isset($etime)){echo date("Y-m-d",$etime);}?>">
             </td>
           </tr>
           <tr>
            <td>Порядок</td>
            <td>
              <input name="orderby" type="radio" id="radio" value="1" checked>
              Хронология
              <input type="radio" name="orderby" id="radio2" value="2" <?php if($_GET['orderby']==2) echo 'checked';?> >
              Обратная хронология            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
			<input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>">
			<input name="m" type="hidden" value="<?php echo $_GET['m'];?>">
			<input name="s" type="hidden" value="<?php echo $_GET['s'];?>">
			</td>
          </tr>
        </table>
	</div>
</div>
<div style="float:left; height:50px; width:50%;">&nbsp;</div>
</form>
<form action="" method="post">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('album_menager');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr> 
      <td ><label>
        <input onClick="do_select()" name="" type="checkbox">
      </label></td>
      <td ><?php echo lang_show('image');?></td>
      <td ><?php echo lang_show('image_name');?></td>
      <td >Размещено</td>
      <td ><?php echo lang_show('poster');?></td>
      <td >Пользователь ID</td>
      <td align="center" ><?php echo lang_show('manager');?></td>
      </tr>
    <?php
	$sql=NULL;
	if(!empty($_GET["catid"])) {
		$sql = "SELECT 
				b.id,b.zname,c.company FROM ".CUSTOM_CAT_REL." a,".ALBUM." b, ".USER." c
			  WHERE a.relating_id=b.id and b.userid=c.userid and a.custom_cat_id='$_GET[catid]' $sql ORDER BY b.id desc ";
	}
	else
	{
		if(!empty($_GET["keyword"])&&$_GET['type']==1)
			$sql=" and b.company like '%$_GET[keyword]%' ";
		if(!empty($_GET["keyword"])&&$_GET['type']==2)
			$sql=" and b.user like '%$_GET[keyword]%' ";
		if(!empty($_GET["keyword"])&&$_GET['type']==3)
			$sql=" and a.zname like '%$_GET[keyword]%' ";
		if(!empty($stime))
			$sql=" and a.time>= '$stime' ";
		if(!empty($etime))
			$sql=" and a.time<= '$etime' ";
				
		if($_SESSION["province"])
			$sql.=" and b.province='$_SESSION[province]'";
		if($_SESSION["city"])
			$sql.=" and b.city='$_SESSION[city]'";
		if($_GET['orderby']==1)
			$sql.="ORDER BY ID asc";
		if($_GET['orderby']==2)
			$sql.="ORDER BY ID desc";
		$sql="SELECT a.*,b.company FROM ".ALBUM." a,".USER." b  WHERE a.userid=b.userid $sql ";
	}
		//=============================
		include_once("../includes/page_utf_class.php");
	  	$page = new Page;
		$page->listRows=10;
		if (!$page->__get('totalRows')){
			$db->query($sql);
			$page->totalRows = $db->num_rows();
		}
        $sql .= "  limit ".$page->firstRow.",20";
		$pages = $page->prompt();
		//==================================
	$db->query($sql);
	$re=$db->getRows();
	$count_num=count($re);
	for($i=0;$i<$count_num;$i++)
	{
	?> 
         <tr> 
         <td width="36" ><label>
           <input name="de[]" id="de" type="checkbox" value="<?php echo $re[$i]['id'];?>">
         </label></td>
         <td width="242" ><img src="<?php echo $config["weburl"]; ?>/uploadfile/zsimg/size_small/<?php echo $re[$i]['id'];?>.jpg " width="70" height="50" onMouseOver="popup('<?php echo $re[$i]['id'];?>');" onMouseOut="kill();"></td>
         <td width="132" ><?php echo $re[$i]["zname"];?>&nbsp;</td>
         <td width="131" ><?php echo dateformat($re[$i]["time"]);?></td>
         <td width="167" align="left"> <?php echo $re[$i]["company"]; ?></td>
         <td width="166" align="left"><?php echo $re[$i]["user"]; ?></td>
         <td width="107" align="center"> 
		 <a href="album.php?deid=<?php echo $re[$i]["id"]; ?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"><?php echo lang_show('delete');?></a>		 </td>
        </tr>
    <?php 
    }
	?>
         <tr >
           <td colspan="2" ><input class="btn" type="submit" name="submit" id="button" value="删除"></td>
           <td colspan="5" align="right" ><div class="page"><?php echo $pages?></div></td>
         </tr>
  </table>
  </div>
  </div>
</form>


</body>
</html>
