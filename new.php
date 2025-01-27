<?php
include_once("model/Collection.class.php");

$forms = new Collection("app_tb_forms");
$items = new Collection("app_tb_items");

$fieldset = $_POST['txLabel'];
$attrs = $_POST['cbRequired'];

$length = count($fieldset);
if ($length > 0) {
	$form = $forms->addRecord(array("_name"=>"Form"));
	for ($i=0; $i<$length; $i++) {
		if (strlen($fieldset[$i]) > 0) {
			$items->addRecord(array(
				"_text" => $fieldset[$i],
				"_required" => isset($attrs[$i]) ? $attrs[$i] : 0,
				"_form" => $form
			));
		}
	}
}

header("location: admin.php");
?>
