<?php
class AddField
{
	var $db;
	var $tpl;
	var $page;
	function AddField()
	{
		global $db;
		global $config;
		global $point_config;
		$this -> db     = & $db;
	}
	//得到已经添加的新字段列表
	function GetFieldList()
	{	
		global $config,$buid;
		$sql="select id,catName,catInfo,defaultValue,fieldPro,displayType,catItem from ".EXTENDFILE." where IsDisplay=1";
		$this->db->query($sql);
		$list=array();
		while($k=$this->db->fetchRow())
		{
			$s=array();
			$s["id"]=$k["id"];
			$s["catName"]=$k["catName"];
			$s["catInfo"]=$k["catInfo"];
			$s["defaultValue"]=$k["defaultValue"];
			$s["fieldPro"]=$k["fieldPro"];
			$s["displayType"]=$k["displayType"];
			$s["catItem"]=$k["catItem"];
			$list[]=$s;
		}
		$arr = json_encode($list);
		return $arr;
	}
	function GetEditFieldList($proid)
	{
		global $config,$build;
		$sql ="select protypeid,productid,fieldid,fieldvalue from ".PROEXTEND." where productid=".$proid;
		$this->db->query($sql);
		$list=array();
		
		while($v=$this->db->fetchRow())
		{
			$s=array();
			$s["protypeid"]=$v["protypeid"];
			$s["productid"]=$v["productid"];
			$s["fieldid"]=$v["fieldid"];
			$s["fieldvalue"]=str_replace("\r\n","",$v["fieldvalue"]);
			$list[]=$s;
		}
		$arr = json_encode($list);
		return $arr;
	}
	//产品显示  添加的字段显示
	function GetViewFieldList($prod){
		global $config,$build;
		$sql ="select pro.fieldvalue,ext.catInfo,ext.displayType,ext.catItem from ".PROEXTEND." pro,".EXTENDFILE." ext where pro.productid=".$prod." and pro.fieldid=ext.id";
		$this->db->query($sql);
		$list=array();
		
		while($v=$this->db->fetchRow()){
			$s=array();
			$getvalue = $v["fieldvalue"];
			if($v["displayType"]=="3" || $v["displayType"]=="4" || $v["displayType"]=="5"){
				//下拉框
				//单选框
				//多选框
				$tem = explode(",",$v["catItem"]);
				$tt="";
				if(count($tem)>0){
					foreach($tem as $vs){
						$ttem = explode("|",$vs);
						if($this->strIndexOf($getvalue,$ttem[0])){
							$tt.=$ttem[1].",";
						}
					}
					$getvalue=trim($tt,",");
				}
			}
			$s["catInfo"]=$v["catInfo"];
			$s["fieldvalue"]=$getvalue;
			$list[]=$s;
		}
		return $list;
	}

	
	function strIndexOf($str,$sel){
		  $c=explode($sel,$str);   
		  if(count($c)>1){   
			return true;   
		  }
		 return false;
	}
	//$id:要编辑的ID（为0时表示增加）,$prod:产品类别ID列表
	function addfieldinput($id,$prod)
	{
		$list = array();
		if($id=="0"){
			//添加
			$sql = "select cat_add_field from ".PCAT." where catid in($prod)";
			$this->db->query($sql);
			$fieldlist="";
			while($v=$this->db->fetchRow()){
				if($v["cat_add_field"]!="")
				$fieldlist.=$v["cat_add_field"].",";
			}
			if(strlen(trim($fieldlist))>=1){
				$sql = "select id,catName,catInfo,defaultValue,displayType,catItem from ".EXTENDFILE." where id in(".trim($fieldlist,",").")";
				$this->db->query($sql);
				while($v=$this->db->fetchRow()){
					$t=array();					
					$t["isupdate"]="no";
					$t["value"]="";//字段值
					$t["catName"]=$v["catName"];//字段名称
					$t["catInfo"]=$v["catInfo"];//字段描述
					$t["defaultValue"]=$v["defaultValue"];//默认值
					$t["displayType"]=$v["displayType"];//显示类型
					$t["catItem"]=$v["catItem"];//列表值
					$list[]=$this->addtabletr($t);
				}
			}
		}else{
			//更新
			////data.catName+"|"+data.displayType+"|"+pro.proid+"|"+data.id;
			$sql ="select pro.fieldvalue,pro.protypeid,pro.fieldid,pro.productid,ext.catName,ext.catInfo,ext.defaultValue,ext.displayType,";
			$sql .= " ext.catItem from ".PROEXTEND." pro,".EXTENDFILE." ext where pro.productid=".$id." and pro.protypeid in(".$prod.") and pro.fieldid=ext.id";
			$this->db->query($sql);
			//echo $sql;
			$editlist="";
			while($v=$this->db->fetchRow()){
				$t=array();
				$editlist.=$v["catName"]."|".$v["displayType"]."|".$v["protypeid"]."|".$v["fieldid"].",";
				$t["isupdate"]="yes";
					$t["value"]=$v["fieldvalue"];//字段值
					$t["protypeid"]=$v["protypeid"];
					$t["productid"]=$v["productid"];
					$t["fieldid"]=$v["fieldid"];
					
					$t["catName"]=$v["catName"];//字段名称
					$t["catInfo"]=$v["catInfo"];//字段描述
					$t["defaultValue"]=$v["defaultValue"];//默认值
					$t["displayType"]=$v["displayType"];//显示类型
					$t["catItem"]=$v["catItem"];//列表值
					$list[]=$this->addtabletr($t);
			}
			/*
			            <tr id=\"addprofield\" style=\"display:none;\"><td  align=\"left\" bgcolor=\"#EAEFF3\"></td><td  bgcolor=\"#FFFFFF\"> <input type=\"hidden\" name=\"addfieldhid\" id=\"addfieldhid\" /></td></tr>
			*/
			if(count($t)>0)
				$list[] = "<tr id=\"addprofield\" style=\"display:none;\"><td  align=\"left\" bgcolor=\"#EAEFF3\"></td><td  bgcolor=\"#FFFFFF\"> <input type=\"hidden\" name=\"addfieldhid\" id=\"addfieldhid\" value=\"".$editlist."\" /></td></tr>";
			else
				return $this->addfieldinput(0,$prod);
		}
		return $list;
	}
	
	function addtabletr($ob)
	{
		$type = $ob["displayType"];
		$htmlstr="";
		$returnstr ="<tr><td width=\"16%\" align=\"left\" bgColor=\"#eaeff3\">".$ob["catInfo"]."</td><td width=\"84%\" bgColor=\"#ffffff\">";
		$value="";
		if($ob["isupdate"]=="yes"){
			$value=$ob["value"];
		}else{
			$value=$ob["defaultValue"];
		}
		switch($type){
		case "1"://单行文本(text)
			if($ob["isupdate"]=="yes"){
				$htmlstr="<input type=\"text\" name=\"".$ob["catName"]."\" id=\"".$ob["catName"]."\" value=\"".$ob["value"]."\" >";
			}else
			{
				$htmlstr="<input type=\"text\" name=\"".$ob["catName"]."\" id=\"".$ob["catName"]."\"  value=\"".$ob["defaultValue"]."\" >";
			}			
		break;
		case "2"://
			if($ob["isupdate"]=="yes"){
			$htmlstr="<textarea name=\"".$ob["catName"]."\" id=\"".$ob["catName"]."\" cols=\"70\" rows=\"15\">".$ob["value"]."</textarea>";
			}else{
				$htmlstr="<textarea name=\"".$ob["catName"]."\" id=\"".$ob["catName"]."\" cols=\"70\" rows=\"15\">".$ob["defaultValue"]."</textarea>";
			}
		break;
		case "3"://下拉框
			$selectnum = "<select name=\"".$ob["catName"]."\">";
			$numarray = explode(",",$ob["catItem"]);
			for($ii=0;$ii<count($numarray);$ii++){
				$itemvalue = explode("|",$numarray[$ii]);//.split('|');
				if($itemvalue[0]==$value){
					$selectnum .="<option value=\"".$itemvalue[0]."\" selected>".$itemvalue[1]."</option>";
				}
				else{
					$selectnum.="<option value=\"".$itemvalue[0]."\">".$itemvalue[1]."</option>";
				}
			}
				$selectnum .= "</select>";
				$htmlstr=$selectnum;				
		break;
		case "4"://单选框
			$selectnum = "";
			$numarray = explode(",",$ob["catItem"]);//value.split(',');
			for($ii=0;$ii<count($numarray);$ii++){
				$itemvalue = explode("|",$numarray[$ii]);//.split('|');
				if($itemvalue[0]==$value){
					$selectnum.="<input type=\"radio\" name=\"".$ob["catName"]."\" id=\"".$ob["catName"]."\" value=\"".$itemvalue[0]."\" checked>".$itemvalue[1];
				}
				else{
					$selectnum.="<input type=\"radio\" name=\"".$ob["catName"]."\" id=\"".$ob["catName"]."\" value=\"".$itemvalue[0]."\" >".$itemvalue[1];
				}
			}
			$htmlstr=$selectnum;
		break;
		case "5"://多选框 <input name="asd2" type="checkbox" id="asd2" checked>
			$selectnum = "";
			$numarray = explode(",",$ob["catItem"]);//value.split(',');
			for($ii=0;$ii<count($numarray);$ii++){
				$itemvalue = explode("|",$numarray[$ii]);//.split('|');				
					if($this->strIndexOf($value,$itemvalue[0])){
						$selectnum .="<input type=\"checkbox\" name=\"".$ob["catName"]."[]\" id=\"".$ob["catName"]."[]\" value=\"".$itemvalue[0]."\" checked>".$itemvalue[1];
					}
					else{
						$selectnum.="<input type=\"checkbox\" name=\"".$ob["catName"]."[]\" id=\"".$ob["catName"]."[]\" value=\"".$itemvalue[0]."\" >".$itemvalue[1];
					}
			}
			$htmlstr=$selectnum;
		break;
	}
	return $returnstr.$htmlstr."</td></tr>";
	}
}
?>
