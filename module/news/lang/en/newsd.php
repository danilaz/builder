<?php
if(!isset($newsDetail))
	$newsDetail=array();
if(isset($newsDetail["title"]))
	$lang["title"]=$newsDetail["title"];
if(isset($newsDetail["body"]))
	$lang["description"]=substr(trim(strip_tags($newsDetail["body"])),23,141);
$newsDetail['catid']=isset($newsDetail['catid'])?$newsDetail['catid']:NULL;
$newsDetail['cat']=isset($newsDetail['cat'])?$newsDetail['cat']:NULL;
$newsDetail['title']=isset($newsDetail['title'])?$newsDetail['title']:NULL;

$lang["guide"]="<a href='../?m=news'>Infomation Center</a> &raquo;<a href='../?m=news&s=news_list&id=".$newsDetail['catid']."/'>	".$newsDetail['cat']."</a> &raquo; ".$newsDetail['title'];
$lang['comer'] = 'Source:';
$lang['author'] = 'Author:';
$lang['read_count']='Read Times:';
$lang['noright'] = 'where groups of users authorized to view this content. . . . ';
$lang['tags'] = 'Tags:';
$lang['hottags'] = 'Top Tag';
$lang['recread'] = 'Recommended Reading';
$lang['picnews'] = 'Image information';
$lang['pubtime']='Publish Time:';
$lang['bigfont']='Big Fontsize';
$lang['smallfont']='Small Fontsize';
$lang['fav']='Collect';
$lang['attent']='Concern';
$lang['rewiew']='Comment';
$lang['print']='Print Page';

$lang['survey']='survey';
$lang['closed']='closed';
$lang['voted']='voted';
$lang['vote']='vote';
$lang['view']='View';
?>