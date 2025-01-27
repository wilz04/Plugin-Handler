<?php
/**
 * @alias Collection.class
 * @author WilC <wilz04@gmail.com>
 * @since 2008
 */
include_once("Settings.class.php");

class Collection {
	
	var $name;
	var $headers;
	var $pagelenght;
	var $connection;
	
	function Collection($name, $pagelenght=NULL) {
		$this->name = $name;
		$this->pagelenght = $pagelenght;
		$this->connection = Settings::getConnection();
		$this->headers = Settings::getTableHeaders($name);
		// $this->load();
	}
	
	function getPage($page=1, $sorter=NULL) {
		$query = "select ".implode(", ", $this->headers)." from ".$this->name." ";
		
		if ($this->pagelenght != NULL) {
			$sublim = ($this->pagelenght*($page - 1)) + 1;
			$query.= "limit ".$sublim.", ".$this->pagelenght." ";
		}
		if ($sorter != NULL) {
			$query.= "order by ".$sorter;
		}
		return $this->connection->executeQuery($query);
	}
	
	function addRecord($element) {
		$query = "insert into ".$this->name." (";
		$query.= implode(", ", array_keys($element));
		$query.= ") values (";
		$query.= "'".implode("', '", $element)."'";
		$query.= ")";
		$result = $this->connection->execute($query);
		// $this->load();
		if ($result) {
			return $this->connection->getLastID();
		}
		return $result;
	}
	
	function getRecordByAttribute($key, $val) {
		$query = "select ".implode(", ", $this->headers)." from ".$this->name." ";
		$query.= "where ".$key." = '".$val."'";
		$result = $this->connection->executeQuery($query);
		return $result[0];
	}
	
	function getRecordsByAttribute($key, $val) {
		$query = "select ".implode(", ", $this->headers)." from ".$this->name." ";
		$query.= "where ".$key." = '".$val."'";
		return $this->connection->executeQuery($query);
	}
	
	function setRecordAttributes($idkey, $idval, $attributes) {
		$sets = array();
		foreach ($attributes as $key=>$val) {
			$sets[] = "$key = '$val'";
		}
		$query = "update ".$this->name." set ";
		$query.= implode(", ", $sets)." ";
		$query.= "where $idkey = '$idval'";
		return $this->connection->execute($query);
	}
	
	function getCount() {
		// return count($this->records);
		$query = "select count(".$this->headers[0].") from ".$this->name;
		return $this->connection->getObject($query);
	}
	
	function getPageCount() {
		return ceil($this->getCount()/$this->pagelenght);
	}
	
	function removeRecordsByAttribute($key, $val) {
		$query = "delete from ".$this->name." ";
		$query.= "where ".$key." = '".$val."'";
		return $this->connection->execute($query);
	}
	
	function execute($command) {
		return $this->connection->execute($command);
	}
	
	function executeQuery($query) {
		return $this->connection->executeQuery($query);
	}
	
	function truncateText($text, $limit) {
		if ($text != NULL) {
			$oldmsg = explode(" ", $text);
			$newmsg = array();
			$len = 0;
			foreach ($oldmsg as $key=>$val) {
				$len += strlen($val) + 1;
				if ($len+3 >= $limit) {
					$newmsg[count($newmsg)-1].= "...";
					break;
				} else {
					$newmsg[] = $val;
				}
			}
			return implode(" ", $newmsg);
		}
		return NULL;
	}
	
}
?>
