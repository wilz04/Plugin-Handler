<?php
/**
 * @alias DataGrid.class
 * @author WilC <wilz04@gmail.com>
 * @since 2008
 */
class DataGrid {
	
	var $header;
	var $body;
	var $footer;
	var $colors;
	var $attributes;
	var $collength;
	var $pagelength;
	
	function DataGrid($id, $header=array(), $body=array(), $footer=array()) {
		$this->header = $header;
		$this->body = $body;
		$this->footer = $footer;
		$this->colors = array("#E2E2E2", "#F9F9F9");
		$this->attributes = array('id'=>$id);
		$this->pagelength = 0;
	}
	
	function getId() {
		return $this->attributes['id'];
	}
	
	function setAttribute($name, $value) {
		$this->attributes[$name] = $value;
	}
	
	function setPageLength($length) {
		$this->pagelength = $length;
	}
	
	function toHTML() {
		$table = "<table%s>\n%s</table>\n";
		$thead = "\t<thead>\n%s</thead>\n";
		$tbody = "\t<tbody>\n%s</tbody>\n";
		$tfoot = "\t<tfoot>\n%s</tfoot>\n";
		$tr = "\t\t<tr>\n%s</tr>\n";
		$th = "\t\t\t<th%s>%s</th>\n";
		$td = "\t\t\t<td%s>%s</td>\n";
		$link = "\t\t\t\t<a href=\"%s\" target=\"_self\">%s</a>\n";
		
		$table_attrs = "";
		foreach ($this->attributes as $key=>$val) {
			$table_attrs.= " ".$key."=\"".$val."\"";
		}
		
		if (count($this->header) > 0) {
			$cells = "";
			foreach ($this->header as $cell) {
				$cell_attrs = "";
				foreach ($cell as $key=>$val) {
					if ($key != 'innerHTML') {
						$cell_attrs.= " ".$key."=\"".$val."\"";
					}
				}
				$cells.= sprintf($th, $cell_attrs, $cell['innerHTML']);
			}
			$thead = sprintf($thead, sprintf($tr, $cells));
		} else {
			$thead = "";
		}
		
		if (count($this->body) > 0) {
			$rows = "";
			$i = 0;
			$j = count($this->colors);
			foreach ($this->body as $row) {
				$this->collength = count($row);
				$cells = "";
				foreach ($row as $cell) {
					$cell_attrs = "";
					foreach ($cell as $key=>$val) {
						if ($key != 'innerHTML') {
							$cell_attrs.= " ".$key."=\"".$val."\"";
						}
					}
					$cell_attrs.= " bgcolor=\"".$this->colors[$i%$j]."\"";
					$cells.= sprintf($td, $cell_attrs, $cell['innerHTML']);
				}
				$i++;
				$rows.= sprintf($tr, $cells);
			}
			$tbody = sprintf($tbody, $rows);
		} else {
			$tbody = "";
		}
		
		$cells = "";
		foreach ($this->footer as $cell) {
			$cell_attrs = "";
			foreach ($cell as $key=>$val) {
				if ($key != 'innerHTML') {
					$cell_attrs.= " ".$key."=\"".$val."\"";
				}
			}
			$cells.= sprintf($td, $cell_attrs, $cell['innerHTML']);
		}
		
		$links = "";
		for ($i=1; $i<=$this->pagelength; $i++) {
			$links.= sprintf($link, "?p=".$i, $i);
		}
		
		$rows = "";
		if (count($this->footer) > 0) {
			$rows = sprintf($tr, $cells);
		}
		if ($this->pagelength > 0) {
			$rows.= sprintf($tr, sprintf($td, "colspan=\"".$this->collength."\"", $links));
		}
		if ($rows != "") {
			$tfoot = sprintf($tfoot, $rows);
		} else {
			$tfoot = "";
		}
		
		$rows = $thead.$tbody.$tfoot;
		if ($rows != "") {
			return sprintf($table, $table_attrs, $rows);
		} else {
			return "";
		}
		
	}
	
}
?>
