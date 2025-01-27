<?php
/**
 * @alias Settings.class
 * @see Database.class
 * @author WilC <wilz04@gmail.com>
 * @since 2007
 */
include_once("Database.class.php");

define("DB_HOST", "localhost");
define("DB_SCHEMA", "app");
define("DB_USR", "root");
define("DB_PWD", "");

class Settings {
	
	static $connection;
	
	static function getConnection() {
		if (!Settings::$connection) {
			Settings::$connection = new Database(DB_HOST, DB_SCHEMA, DB_USR, DB_PWD);
		}
		return Settings::$connection;
	}
	
	static function getTableHeaders($table) {
		$cx = Settings::getConnection();
		$rs = $cx->executeQuery("show columns from ".$table);
		$cols = array();
		foreach ($rs as $key=>$value) {
			$cols[$key] = $value['Field'];
		}
		return $cols;
	}
	
}
?>
