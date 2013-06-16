<?php
/*
 * Auther:Brad zhang
 * Powered by:B2Bbuilder
 * Copright:http://www.b2b-builder.com
 * Des:database class
 */
class dba {
	
	var $Link_ID;
	var $Query_ID;
	var $Record;
	var $Row;
	var $Auto_free   = 0;
	
	function dba($h,$u,$p,$db)
	{
		 $this->Link_ID=mysql_connect("localhost","ekolobok","admin") or die("Can not connect mysql server..."); 
		 if($this->version() > '4.1')
		 {
			$serverset = "character_set_connection='utf8', character_set_results='utf8', character_set_client=binary";
			$serverset .= $this->version() > '5.0.1' ? ((empty($serverset) ? '' : ',').'sql_mode=\'\'') : '';
			$serverset && mysql_query("SET $serverset", $this->Link_ID);
			mysql_query("SET NAMES 'utf8'");
		 }
		 mysql_select_db($db,$this->Link_ID) or die("Can not select database");
	}
	
	function query($sql)
	{
		$this->Query_ID=mysql_query($sql) or die($sql.mysql_error()) ;
		return $this->Query_ID;
	}
	
	function next_record()
	{
		$this->Record = @mysql_fetch_array($this->Query_ID,MYSQL_ASSOC);
		$this->Row += 1;
		$stat = is_array($this->Record);
		if (!$stat && $this->Auto_free)
		{
		   mysql_free_result($this->Query_ID);
		   $this->Query_ID = 0;
		}
		return $stat;
	}
	
	function getRows()
	{ 
		$k=array();
		if($this->Query_ID!="")
		{
			while($re=mysql_fetch_array($this->Query_ID,MYSQL_ASSOC))
			{
				$k[]=$re;
			}
		}
		return $k;
	}
	
	function fetchRow()
	{ 	
		$re=@mysql_fetch_array($this->Query_ID,MYSQL_ASSOC);
		return $re;
	}
	
	function fetchField($name)
	{
		if($this->Query_ID!="")
		{
			$re=mysql_fetch_array($this->Query_ID,MYSQL_ASSOC);
			return $re["$name"];
		}
		else
			return NULL;
	}
	
	function num_rows()
	{
		if($this->Query_ID!="")
			return mysql_num_rows($this->Query_ID);
	}
	
	function f($Name)
	{
		return $this->Record[$Name];
	}
	
	function lastid()
	{
		return ($id = mysql_insert_id($this->Link_ID)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}
	
	function version()
	{
		if(empty($this->version))
		{
			$this->version = mysql_get_server_info($this->Link_ID);
			return $this->version;
		}
		
	}
	function insert($tbname, $row)
	{
		$sqlfield=NULL;
		$sqlvalue=NULL;
		foreach ($row as $key=>$value)
		{
			$sqlfield .='`'.$key."`,";
			$sqlvalue .= $value.",";
		}
		$sql = "INSERT INTO `".$tbname."`(".substr($sqlfield, 0, -1).") VALUES (".substr($sqlvalue, 0, -1).")";   
		return $this->query($sql);
	}
	function row_update($tbname, $row, $where)
	{
		$sqlud='';
		foreach ($row as $key=>$value) {
			$sqlud .= "`".$key."`= $value,";
		}
		$sql = "UPDATE `".$tbname."` SET ".substr($sqlud, 0, -1)." WHERE ".$where;
		return $this->query($sql);
	}
	function num_fields()
	{
		if($this->Query_ID!="")
			return mysql_num_fields($this->Query_ID);
	}
	function fetch_row()
	{
		if($this->Query_ID!="")
			return mysql_fetch_row($this->Query_ID);
	}
	function close()
	{
		mysql_close($this->Link_ID);
	}

}
?>