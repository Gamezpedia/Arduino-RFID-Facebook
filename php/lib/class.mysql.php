<?php
class MySQL 
{	
	private $conn;
	
	function __construct($host, $user, $pass, $db = false)
	{	
		$this->conn = mysql_connect($host, $user, $pass);
		mysql_select_db($db, $this->conn);
		return $this->conn;
	}	
	
	public function query($query)
	{
		$result = mysql_query($query);
		if (mysql_error()) {
			echo "<pre>" . $query . "</pre>";
			die (mysql_errno() . ":" . mysql_error());
		} else {		
			return $result;
		}
	}
	
	public function affected_rows()
	{
		return mysql_affected_rows($this->conn);
	}
	
	public function fetch_object($result)
	{
		$data = mysql_fetch_object($result);
		return $data;
	}
	
	
	public function last_id($result) {
		return mysql_insert_id($this->conn);
	}
	
	function __destruct()
	{
		if ($this->conn) {
			mysql_close($this->conn);
		}
	}
}
?>