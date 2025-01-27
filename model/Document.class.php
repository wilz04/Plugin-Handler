<?php
/**
 * @alias Document.class
 * @author WilC <wilz04@gmail.com>
 * @since 2007.
 */
class Document {
	
	var $tpl;
	var $vars;
	var $ents;
	/*
	var $chls;
	var $tabs;
	*/
	function Document($tpl) {
		$this->tpl = $tpl;
		$this->vars = array();
		$this->ents = array();
		/*
		$this->chls = array();
		$this->tabs = array();
		*/
	}
	
	function setVariable($id, $value) {
		$this->vars[$id] = $value;
	}
	
	function setEntity($id, $value) {
		$this->ents[$id] = $value;
	}
	/*
	function setChild($id, $value) {
		$this->chls[$id] = $value;
	}
	
	function setDataTable($id, $values) {
		$this->tabs[$id] = $value;
	}
	*/
	function getInnerHTML() {
		$doc = implode("", file($this->tpl));
		foreach ($this->vars as $id=>$value) {
			$doc = str_replace("(\$".$id.")", $value, $doc);
		}
		foreach ($this->ents as $id=>$value) {
			$doc = str_replace("&".$id.";", $value, $doc);
			
			if ($value == "") {
				$doc = str_replace($id." -->", "", $doc);
				$doc = str_replace("<!-- /no".$id, "", $doc);
			}
		}
		/*
		foreach ($this->chls as $id=>$value) {
			$doc = str_replace("<!-- ".$id." --><!-- /".$id." -->", $value, $doc);
		}
		foreach ($this->tabs as $id=>$values) {
			$doc = str_replace("<!-- ".$id." --><!-- /".$id." -->", $value, $doc);
		}
		*/
		return $doc;
	}
	
}
?>
