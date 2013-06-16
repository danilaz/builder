<?php
define("LINK",$config['table_pre']."web_link");
define("CONFIG",$config['table_pre']."web_config");//网站配置表
define("USERGROUP",$config['table_pre']."user_group");//前台用户分组表
define("USERMODULES",$config['table_pre']."user_modules");//前台用户权限表
define("RESERVE_USERNAME",$config['table_pre']."reserve_username");//系统保护用户名表
define("IPLOCK",$config['table_pre']."stop_ip");//IP地址锁定表
define("FEEDBACK",$config['table_pre']."feedback");
define("ALLUSER",$config['table_pre']."user_all");//用户登录信息表，多版本共用
define("USER",$config['table_pre']."user");//用户信息表
define("COMPANYCAT",$config['table_pre']."user_cat");//公司类别表
define("FEED",$config['table_pre']."feed");
define("FCAT",$config['table_pre']."fav_cat");
define("FLIST",$config['table_pre']."fav_list");
define("PV",$config['table_pre']."page_view");//管理员后台统计表
define("ADMIN",$config['table_pre']."admin");//网站管理员
define("ADVS",$config['table_pre']."advs");//站内广告位表
define("ADVSCON",$config['table_pre']."advs_con");//站内广告位内容表
define("COUNTRY",$config['table_pre']."country");//国家列表
define("PROVINCE",$config['table_pre']."province");//省份
define("CITY",$config['table_pre']."city");//城市列表
define("GROUP",$config['table_pre']."admin_group");//会员权限组
define("MODULES",$config['table_pre']."modules");//管理员权限模块登记组
define("ULINK",$config['table_pre']."user_link");//会员友情链接
define("DOMAIN",$config['table_pre']."sub_domain");//会员友情链接
define("WEBCON",$config['table_pre']."web_con");//网站初始化内容设置
define("WEBCONGROUP",$config['table_pre']."web_con_group");//网站初始化内容分组
define("CTYPE",$config['table_pre']."comments_type");//评分类别表
define("CDES",$config['table_pre']."comments_desc");//评分描述表
define("CREC",$config['table_pre']."comments_rec");//评分记录表
define("TAGS",$config['table_pre']."tags");//标签表
define("CTAGS",$config['table_pre']."contags");//标签内容关连表
define("MENU",$config['table_pre']."nav_menu");
define("MAILMOD",$config['table_pre']."mail_mod");//邮件模板
define("MAILREC",$config['table_pre']."mail_record");//邮件群发日志
define("READREC",$config['table_pre']."user_read_rec");//用户阅读记录表
define("REGVERFCODE",$config['table_pre']."reg_vercode");//注册随机问题表
define("PAGEREC",$config['table_pre']."page_rec");//网站历史流量记录表
define("FAVORITE",$config['table_pre']."myfavorite");//会员收藏夹
define("UDOMIN",$config['table_pre']."user_domin");//会员绑定域名
define("COMMENT",$config['table_pre']."comment");//评价记录表
define("CUSTOM_CAT",$config['table_pre']."custom_cat");//自定义类别表
define("CUSTOM_CAT_REL",$config['table_pre']."custom_cat_relating");//自定义类别关联表
define("BUSINESS",$config['table_pre']."business_info");//工商信息表
define("CRON",$config['table_pre']."cron");//计划任务表
define("SUBSCRIBE",$config['table_pre']."subscribe");//订阅信息表
define("ACCOUNTS",$config['table_pre']."user_accounts"); //银行帐号信息
define("CASHFLOW",$config['table_pre']."cashflow"); //流水帐表
define("CASHPICKUP",$config['table_pre']."cashpickup"); //提现申请
define("PAYMENT",$config['table_pre']."payment"); //支付方式表
define("OPLOG",$config['table_pre']."admin_operation_log"); //后台管理员操作日志
define("POINTCONFIG",$config['table_pre']."point_config"); //积分配置表
define("SHOPSETTING",$config['table_pre']."shop_setting"); //商铺内容设置
define("EXPRESS",$config['table_pre']."express_interface"); //物流配置接口
define("EXTENDFILE",$config['table_pre'].'extend_file');//	管理员自定义字段表
define("SPREAD",$config['table_pre']."site_spread"); //站点推广表
define("MLAY",$config['table_pre']."modules_layout"); //布局与模块关连表
define("PROEXTEND",$config['table_pre']."pro_extend"); //产品扩展信息表
define("UDETAIL",$config['table_pre']."user_detail");//用户详情描述表
define("SWORD",$config['table_pre']."search_word");//热门搜索关键词
define("AUDIT",$config['table_pre']."auditing");//审核
define("FILTER",$config['table_pre']."filter_keyword");//过滤关键词
define("USERTEMP",$config['table_pre']."user_template");//用户模板表
//======================================加载模块表配置。
$dir=$config['webroot'].'/module/';
$handle = opendir($dir); 
while ($filename = readdir($handle))
{ 
	if($filename!="."&&$filename!="..")
	{
	  if(file_exists($dir.$filename.'/table_config.php'))
	  { 
		 include("$dir/$filename/table_config.php");
	  }
   }
}
?>