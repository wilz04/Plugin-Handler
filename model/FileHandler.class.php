<?php
/**
 * @alias FileHandler.class
 * @author WilC <wilz04@gmail.com>
 * @since 2008
 */
class FileHandler {
	
	var $stream;
	var $name;
	var $addr;
	var $mode;
	var $type;
	var $size;
	var $attr;
	
	function FileHandler($name=NULL) {
		$this->stream = NULL;
		$this->isopen = false;
		$this->addr = "";
		$this->name = $name;
		$this->mode = "a+";
		$this->type = "text/plain";
		$this->size = 0;
		$this->attr = array();
	}
	
	function setURL($url) {
		if ($this->name != NULL) {
			return false;
		}
		$this->addr = substr($url, 0, strrpos($url, "/") + 1);
		$this->name = substr($url, strrpos($url, "/") + 1);
		return true;
	}
	
	function setUploadedData($id, $addr="", $name=NULL) {
		if ($this->name != NULL) {
			return false;
		}
		if ($_FILES[$id]['name'] == NULL) {
			return false;
		}
		$this->addr = $addr;
		if ($name == NULL) {
			$name = $_FILES[$id]['name'];
		}
		$this->name = $name;
		$this->type = $_FILES[$id]['type'];
		$this->size = $_FILES[$id]['size'];
		
		$url = $addr.$name;
		if (file_exists($url)) {
			return false;
		}
		
		if ($this->isopen) {
			$this->close();
		}
		move_uploaded_file($_FILES[$id]['tmp_name'], $url);
		if ($this->isopen) {
			$this->open();
		}
		return true;
	}
	
	function setAttribute($name, $value) {
		$this->attr[$name] = $value;
	}
	
	function getAttribute($name) {
		return $this->attr[$name];
	}
	
	function open($mode=NULL) {
		if (!$this->isopen) {
			if ($mode != NULL) {
				$this->mode = $mode;
			}
			$url = $this->addr.$this->name;
			$this->stream = fopen($url, $this->mode);
			$this->isopen = true;
			$this->size = filesize($url);
			return true;
		}
		return false;
	}
	
	function getContent() {
		return fread($this->stream, $this->size);
	}
	
	function delete() {
		if ($this->isopen) {
			$this->close();
		}
		return @unlink($this->addr.$this->name);
	}
	
	function close() {
		@fclose($this->stream);
		$this->isopen = false;
	}
	
};
?>
