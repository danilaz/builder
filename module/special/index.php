<?php
/**
 * Copright :http://www.b2b-buildr.com
 * Powered by :B2Bbuilder
 */
include_once("includes/global.php");
include_once("includes/smarty_config.php");
       //����ר��
       $sql="select * from ".SPE." order by add_time desc";
	   $db->query($sql);
	   $re=$db->getRows();
	   $tpl->assign("zuixin",$re);
	   //�Ƽ�ר��
	   $sql="select * from ".SPE." order by `order` desc";
	   $db->query($sql);
	   $re=$db->getRows();
	   $tpl->assign("tj",$re);
	   //����ר��
	   $sql="select * from ".SPE." order by readcount desc";
	   $db->query($sql);
	   $re=$db->getRows();
	   $tpl->assign("rm",$re);
$out=tplfetch("index.htm");
?>