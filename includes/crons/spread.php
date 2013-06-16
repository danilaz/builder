<?php
$nt=time()-2592000;
$sql="delete from ".SPREAD." where ctime<$nt";
$db->query($sql);
?>