<?php
if(!empty($info))
{
	$lang["title"]=$info["pname"].'-Product order';
	$lang["description"]=strip_tags($info["con"]);
	$lang['keyword']=$info["pname"].'-Product order';
}
$lang['guide']='Product order';
$lang['orderisset']='This product already exists in your order list but its order procedure has not been finished yet!';
$lang['cantorder']='This product spec is not completed. It cannot be ordered. Please contact the seller. It can be ordered after its infomation is completed.';
$lang['pronameid']='Product';
$lang['uprice']='Unit price';
$lang['beiz']='Remark';
$lang['buyerdetail']='Buyer detail';
$lang['comname']=' Company name';
$lang['comaddr']='Company address';
$lang['comlx']='contact';

$lang['contaddr']='Contact person address';
$lang['conttel']='Phone number';
$lang['contzip']='Post code';
$lang['buyername']='Receiver name';
$lang['buyertel']='Receiver phone number';
$lang['buyeraddr']='Receiver address';
$lang['buyerzip']='Receiver post code';
$lang['sellerdetail']='Seller detail';

$lang['nums']='Amount';
$lang['allprice']='Total price';
$lang['orderit']='Make an order ';
$lang['ordercancel']='Cancel';
$lang['backto']='Back';
$lang['print']='Print';

$lang['sent_by_post']='Ordinary post:';
$lang['exp']='Express:';
$lang['ems']='EMS:';
?>