<?php
/**
 * @alias Database.class
 * @author WilC <wilz04@gmail.com>
 * @since 2007
 */
class Database {
	
	var $connection;
	var $name;
	
	function Database($dns, $name, $user, $pwd) {
		$this->connection = mysql_connect($dns, $user, $pwd);
		$this->name = $name;
		if (!$this->connection) {
			die("DataBase ".mysql_error());
		}
	}
	
	function execute($command) {
		//insert, update, delete
		mysql_select_db($this->name, $this->connection);
		return mysql_query($command, $this->connection);
	}
	
	function executeQuery($query) {
		//select
		$resultset = $this->execute($query);
		if (!$resultset) {
			die("DataBase.executeQuery: ".mysql_error());
		}
		$recordset = array();
		while ($row = mysql_fetch_array($resultset)) {
			$recordset[] = $row;
		}
		return $recordset;
	}
	
	function getObject($query) {
		$recordset = $this->executeQuery($query);
		if (!empty($recordset)) {
			return $recordset[0][0];
		}
		return NULL;
	}
	
	function getLastID() {
		return mysql_insert_id($this->connection);
	}
	
	function close() {
		@mysql_close($this->connection);
	}
	
}
?>
