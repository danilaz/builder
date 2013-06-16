<?php
include_once("lang/".$config['language']."/user_admin/global.php");
include("module/ask/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/".$_GET['m']."/includes/plugin_question_class.php");
//====================================================================
$question=new question();
include_once("includes/page_utf_class.php");
$tpl->assign("rs",$question->ask_list());
//====================================================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_question.htm");
?>