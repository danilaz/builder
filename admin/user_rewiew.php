<?php
include_once("../includes/global.php");
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("auth.php");
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
//=======================
if(!empty($_GET['delall'])&&is_array($_GET['de']))
{
	$id=implode(",",$_GET['de']);
	if($id)
	{
		$sql="delete from ".COMMENT. " where id in ($id)";
		$db->query($sql);
	}
}
if(!empty($_GET['action'])&&$_GET['action']=='del'&&!empty($_GET['id']))
{
	$sql="delete from ".COMMENT. " where id=".$_GET['id'];
    $db->query($sql);
}
$subsql='';
if (!empty($_POST['username']))
{
    $sqlc="select userid from ".ALLUSER." where user='".$_POST['username']."'";
	$db->query($sqlc);
	$us=$db->fetchRow();
	$subsql.=" and fromuid='".$us['userid']."'";
}
if (!empty($_POST['rewtype']))
{
	$subsql.=" and ctype='".$_POST['rewtype']."'";
}
if (!empty($_POST['usergroup']))
{
   $sqlu="select userid from ".USER." where ifpay='".$_POST['usergroup']."'";
   $db->query($sqlu);
   $uus=$db->getRows();
   $mys=array();
            foreach($uus as $uk)
	          {
              $mys[]=$uk['userid'];
			  }
   $ut=implode(",", $mys);
   if (empty($ut))
	   $ut=0;
	$subsql.=" and fromuid  in (".$ut.")";
}
if (!empty($_POST['conid']))
{
	$subsql.=" and conid='".$_POST['conid']."'";
}
$sqlall="select count(*) as num from ".COMMENT." where 1=1 $subsql  order by id desc";
$db->query($sqlall);
$renum=$db->fetchRow();

$psql='';
if(!empty($_SESSION["province"]))
	$psql.=" and b.province='$_SESSION[province]'";
if(!empty($_SESSION["city"]))
	$psql.=" and b.city='$_SESSION[city]'";
		
$sql="select * from ".COMMENT." where 1=1 $subsql  order by id desc";
//=============================
$page = new Page;
$page->listRows=10;
if (!$page->__get('totalRows')){
	$db->query($sql);
	$page->totalRows = $db->num_rows();
}
$sql .= "  limit ".$page->firstRow.",20";
$pages = $page->prompt();
//=============================
$db->query($sql);
$re=$db->getRows();
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('urewiew');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
<script language="javascript">
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
</HEAD>
<body>
<form method="post" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('urewiew');?></div>
	<div class="bigboxbody"> 
	  <p  style="font-size:12px; padding-left:20px;"><?php echo lang_show('uname');?>  
	    <input type="text" name="username" id="username" value="<?php if(!empty($_POST['username'])) echo $_POST['username'];?>"><?php echo lang_show('rtype');?> 
	    <select name="rewtype" id="ordertype"> 		    
	      <option value="" selected><?php echo lang_show('typeall');?></option> 		    
	      <option value="1" <?php if(!empty($_POST['rewtype'])&&$_POST['rewtype']==1) echo 'selected';?>><?php echo lang_show('news');?></option> 		    
	      <option value="2" <?php if(!empty($_POST['rewtype'])&&$_POST['rewtype']==2) echo 'selected';?>><?php echo lang_show('info');?></option> 
		  <option value="3" <?php if(!empty($_POST['rewtype'])&&$_POST['rewtype']==3) echo 'selected';?>><?php echo lang_show('pro');?></option> 
		  <option value="4" <?php if(!empty($_POST['rewtype'])&&$_POST['rewtype']==4) echo 'selected';?>><?php echo lang_show('exh');?></option> 
        </select>                
&nbsp;<?php echo lang_show('ugroup');?>
<select name="usergroup" id="usergroup">              
  <option value="" selected><?php echo lang_show('allgroup');?></option>            
  <?php
            $sql="select * from ".USERGROUP;
            $db->query($sql);
            $usr=$db->getRows();
            foreach($usr as $u)
	          {
           ?>           
  <option value="<?php echo $u['group_id']; ?>" <?php if(!empty($_POST["usergroup"])&&$_POST["usergroup"]==$u['group_id']) echo "selected"; ?>><?php echo $u['name']; ?></option>              
  <?php
              }
           ?>                
</select>
<?php echo lang_show('reid');?><input type="text" name="conid" id="conid" value="<?php if(!empty($_POST['conid'])) echo $_POST['conid'];?>">
<input class="btn" type="submit" name="Submit" value="<?php echo lang_show('submit');?>">                     
	    </p>
        </pre>
      </p>
    </div></div>
    <div style="float:left; height:20px; width:80%;">&nbsp;</div>
</form>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('allrewiew');?>
</div>
	<div class="bigboxbody">
  <form action="" method="get">
  <table width="100%" border="0" cellpadding="2" cellspacing="0">
  	  <?php if(!empty($pages)){ ?>
	  <tr>
	  <td colspan="3" align="left">&nbsp;</td>
	  <td colspan="3" align="right"><div class="page"><?php echo $pages;?></div></td>
	  </tr>
	  <?php } ?>
      <tr> 
        <td width="101" ><input type="checkbox" name="checkbox2" id="checkbox2" onClick="do_select();">
          <?php echo lang_show('reuser');?></td>
        <td ><?php echo lang_show('retype');?></td>
      <td ><?php echo lang_show('rtitle');?></td>
      <td ><?php echo lang_show('recon');?></td>
      <td ><?php echo lang_show('rtime');?></td>
      <td align="center" ><?php echo lang_show('react');?></td>
      </tr>
    <?php
		  $i=0;
	      foreach ($re as $v)
          {
	?> 
         <tr  onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')"> 
         <td >
		   <input type="checkbox" name="de[]" value="<?php echo $v['id'];?>">
		   <?php
		$sql="select company from ".USER." where userid=".$v['fromuid'];
        $db->query($sql);
		 $un=$db->fetchRow();
		 if(empty($un['company']))
			 echo lang_show('noname');
		 else
			echo '<a href="'.$config['weburl'].'/shop.php?uid='.$v['fromuid'].'">'.$un['company'].'</a>';
			?>		 </td>
		 <td width="115" >
		 <?php 
		if ($v['ctype']==1)
		    echo lang_show('news');
	    elseif($v['ctype']==2)
            echo lang_show('info');
		elseif($v['ctype']==3)
            echo lang_show('pro');
		else
            echo lang_show('exh');
	    ?></td>
         <td width="218" >
		 <?php 
            if ($v['ctype']==1)
			  {
				$sql="select ftitle,uid from ".NEWSD." where nid=".$v['conid'];
				$db->query($sql);
				$ct=$db->fetchRow();
				if(empty($ct['userid']))
				   echo '<a href="'.$config['weburl'].'/news_detail.php?id='.$v['conid'].'">'.$ct['title'].'</a>';
				else
					echo '<a href="'.$config['weburl'].'/shop.php?uid='.$ct['userid'].'&action=newsd&id='.$v['conid'].'" target="_blank">'.$ct['title'].'</a>';
			  }
		  elseif($v['ctype']==2)
			  {
				$sql="select  title,userid  from ".INFO." where id=".$v['conid'];
				$db->query($sql);
				$ct=$db->fetchRow();
				echo '<a href="'.$config['weburl'].'/?m=offer&s=offer_detail&id='.$v['conid'].'" target="_blank" >'.$ct['title'].'</a>';
			  }
		  elseif($v['ctype']==3)
			  {
			  $sql="select pname,userid from ".PRO." where id=".$v['conid'];
			  $db->query($sql);
				$ct=$db->fetchRow();
				echo '<a href="'.$config['weburl'].'/?m=product&s=product_detail&id='.$v['conid'].'" target="_blank">'.$ct['pname'].'</a>';
			  }
		  else
			  {
              $sql="select title  from ".EXHIBIT." where id=".$v['conid'];
			  $db->query($sql);
			  $ct=$db->fetchRow();
			 echo '<a href="'.$config['weburl'].'/?m=exhibition&s=exhibition_detail&id='.$v['conid'].'" target="_blank">'.$ct['title'].'</a>';
			  }

			?></td>
         <td width="329" ></a>
           <textarea name="content" type="text" id="content"  style="width:300px;height:60px;"><?php echo $v['content']; ?></textarea></td>
         <td width="120" ><?php echo date("Y-m-d H:m",$v['uptime']); ?></td>
         <td width="71" align="center"><span ><a href="user_rewiew.php?action=del&id=<?php echo $v['id'];?>"><?php echo lang_show('redel');?></a></span></td>
      </tr>
    <?php 
		$i++;
    }
	?>
	<tr>
	  <td colspan="3" align="left"><input  class="btn" type="submit" name="delall" id="button" value="<?php echo lang_show('redel');?>"></td>
	  <td colspan="3" align="right"><div class="page"><?php echo $pages;?></div></td>
	  </tr>
	</table>
  </form>
  </div>
</div>
</body>
</html>