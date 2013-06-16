<?php
$upload=array(
	'upload_dir'=>'uploadfile',		//（与 {lib/upload/upload.php} 临时上传目录$upload_path相同）
	'temp_dir'=> 'download/temp',	//附件临时保存目录
	'save_dir'=> 'download/attach',	//附件保存目录
	'theight' => 60,
	'twidth' => 60,
	'upload_limit' =>3,		//允许上传文件数
	'size_limit'=>'2MB',	//允许上传文件大小
	'file_type'=>'*.jpg;*.jpeg;*.psd;*.png;*.gif;*.bmp;*.ppt;*.fly;*.wmv;*.zip;*.mp3;*.doc;*.txt;*.rar;*.tar;*.pdf;*.excel;*.csv;*.xls;*.swf;*.mov;*.mp4;*.avi;*.fla;*.wma;*.wav;*.sound;*.cad;*.chm;',	//允许上传文件类型
	'file_type_param'=>'jpg|jpeg|psd|png|gif|bmp|ppt|fly|wmv|zip|mp3|doc|txt|rar|tar|pdf|excel|csv|xls|swf|mov|mp4|avi|fla|wma|wav|sound|cad|chm|',//允许上传文件类型(|)

	);
?>