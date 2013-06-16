<?php
if(isset($_REQUEST['id'])&&isset($_REQUEST['de'])){
	//=====================================
	include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
	include_once("$config[webroot]/module/demand/lang/".$config['language']."/upload.php");
	include_once("$config[webroot]/module/download/includes/plugin_download_class.php");
	$download = new download();
	$id = trim($_REQUEST['id']);

	if($re = $download->down_detail($id)){
		/*权限判断
		 *{}
		**/
		if( trim( $re['file_url']) == trim($_REQUEST['de']) )
		$file_name = $config['webroot'].'/'.$upload['upload_dir'].'/'.$upload['save_dir'].'/'.$re['file_path'].'/'.$re['file_url'];
		if(file_exists( $file_name )){
			
			header( "Pragma: public" );
			header( "Expires: 0" );
			header( 'Content-Encoding: none' );
			header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
			header( "Cache-Control: public" );
			header( "Content-type: application/octet-stream\n" );
			header( "Content-Description: File Transfer" );
			header( 'Content-Disposition: attachment; filename='.$re['downname'].'.'.$re['pic'] );
			header( "Content-Transfer-Encoding: binary" );
			header( 'Content-Length: '.filesize( $file_name ) );
			readfile ( $file_name );
			exit();
		}
	}
}
echo "404 Not found";
header("HTTP/1.1 404 Not found");
?>