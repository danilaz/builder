<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
//=========================================
if(!$tpl->is_cached("member_services.htm"))
{
	include_once("config/usergroup.php");
	include_once("lang/".$config['language']."/front/member_services.php");
	include_once("lang/".$config['language']."/company_type_config.php");
	$tpl->assign("gs",$group);
	foreach($group as $key=>$v)
	{
		if($key>1&&$v['statu']==1)//普通会员以及并且是开启状态
		{
			foreach($v['modeu'] as $s=>$va)
			{
				if($s!='edit')
				{
					$g[$s][0]=$msg[$s];
						if(($va<1||$va=='')&&$s!='shoptemp'&&$s!='infotype')
							$g[$s][$key]='<img src="/image/default/no.gif">';
						elseif($va==1&&$s!='shoptemp'&&$s!='infotype')
							$g[$s][$key]='<img src="/image/default/yes.gif">';
						elseif($s=='shoptemp')
						{	
							include_once("includes/plugin_temp_class.php");
							$temp=new temp();
							$g[$s][$key]=$temp->get_nums_for_group($key);
						}
						elseif($s=='infotype')
						{
							$z=explode(',',$va);
							if(!empty($z))
							{
								$str=NULL;
								foreach($z as $zp)
								{
									if(!empty($infoType[$zp]))
										$str.=$infoType[$zp].'<br/>';
									else
										$str='×';
								}
								$g[$s][$key]=$str;
								unset($str);
							}
						}
						else
							$g[$s][$key]=$va;
				}
			}
		}
	}

	foreach($g as $kk=>$v)
	{
		if($kk=='groupfee')
		{
			$k=$g[$kk];
			unset($g[$kk]);
		}
	}
	array_unshift($g,$k);
	$tpl->assign("gp",$g);
	$tpl->assign("msg",$gpmsg);
	unset($g,$gpmsg,$k);
	include("footer.php");
}
$tpl->display("member_services.htm");
?>