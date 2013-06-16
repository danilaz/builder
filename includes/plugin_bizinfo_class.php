<?php
class bizinfo
{
	var $db;
	var $tpl;
	var $page;
	function bizinfo()
	{
		global $db;
		global $config;
		global $tpl;		
		$this -> db     = & $db;
		$this -> tpl    = & $tpl;
	}
	
	function update_business_info()
	{
		global $buid;
		if(isset($_POST["action"]) && $_POST["action"]='submit')
		{	
			if(isset($_POST["type"]) && $_POST["type"]='update_protect'){
					$sql = "update ".BUSINESS." set com_reg_id_protect='$_POST[com_reg_id_protect]',com_reg_add_protect='$_POST[com_reg_add_protect]',com_deputy_protect='$_POST[com_deputy_protect]',com_reg_capital_protect='$_POST[com_reg_capital_protect]' where userid='$buid'";
			}else{
				$uptime=date("Y-m-d H:i:s");
				$sql="select id from ".BUSINESS." where userid='$buid'";
				$this->db->query($sql);
				$re=$this->db->fetchRow();
				if($re['id'])
				{
					$sql = "update ".BUSINESS." set
					person_name='$_POST[person_name]',	job='$_POST[job]',com_reg_name='$_POST[com_reg_name]',com_reg_id='$_POST[com_reg_id]',com_reg_add='$_POST[com_reg_add]',com_deputy='$_POST[com_deputy]',com_reg_capital='$_POST[com_reg_capital]',com_reg_type='$_POST[com_reg_type]',com_reg_time='$_POST[com_reg_time]',com_reg_time_ex='$_POST[com_reg_time_ex]',com_reg_area='$_POST[com_reg_area]',com_reg_unit='$_POST[com_reg_unit]',com_check='$_POST[com_check]',com_reg_id_protect='$_POST[com_reg_id_protect]',com_reg_add_protect='$_POST[com_reg_add_protect]',com_deputy_protect='$_POST[com_deputy_protect]',com_reg_capital_protect='$_POST[com_reg_capital_protect]',uptime='$uptime',statu='0',pic='$_POST[pic]' where userid='$buid'";
				}
				else
				{
					$sql="insert into ".BUSINESS."(person_name,job,com_reg_name,com_reg_id,com_reg_add,com_deputy,com_reg_capital,com_reg_type,com_reg_time,com_reg_time_ex,com_reg_area,com_reg_unit,com_check,com_reg_id_protect,com_reg_add_protect,com_deputy_protect,com_reg_capital_protect,uptime,userid,pic) values('$_POST[person_name]','$_POST[job]','$_POST[com_reg_name]','$_POST[com_reg_id]','$_POST[com_reg_add]','$_POST[com_deputy]','$_POST[com_reg_capital]','$_POST[com_reg_type]','$_POST[com_reg_time]','$_POST[com_reg_time_ex]','$_POST[com_reg_area]','$_POST[com_reg_unit]','$_POST[com_check]','$_POST[com_reg_id_protect]','$_POST[com_reg_add_protect]','$_POST[com_deputy_protect]','$_POST[com_reg_capital_protect]','$uptime','$buid','$_POST[pic]')";
				}
			}
			$this->db->query($sql);
		}
		$sql="select * from ".BUSINESS." where userid='$buid'";
		$this->db->query($sql);
		$re=$this->db->fetchRow();
		return $re;
	}
}
?>
