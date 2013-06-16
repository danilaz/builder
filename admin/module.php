<?php
include_once("../includes/global.php");
$sctiptName=$_GET['s'];
include_once("../lang/" . $config['language'] . "/admin/global.php");
@include_once("../module/".$_GET['m']."/lang/" . $config['language'] . "/" . $sctiptName);
include_once("auth.php");
//===============================================
include("../module/$_GET[m]/admin/$_GET[s]");
?>