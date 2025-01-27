<?php
include_once("model/Document.class.php");
include_once("model/DataGrid.class.php");
include_once("model/Collection.class.php");

$doc = new Document("view/admin.htm");
$catalog = new Collection("app_vw_plugins");

$body = array();
$plugins = $catalog->getPage();
$rbEnable = "<input type=\"radio\" id=\"rbEnable_%d\" name=\"rbEnable\" value=\"%d\" %s />";
foreach ($plugins as $key=>$plugin) {
	$checked = $plugin['_enabled'] == 1 ? "checked=\"checked\"" : "";
	$body[] = array(
		array(
			'innerHTML' => sprintf($rbEnable, $plugin['_id'], $plugin['_id'], $checked),
			'width' => "10%"
		),
		array('innerHTML'=>$plugin['_url'])
	);
}

$footer = array(
	array(
		'innerHTML'=>"<input type=\"submit\" id=\"btEnable\" name=\"btEnable\" value=\"Habilitar\" />",
		'colspan'=>"2",
		'align'=>"center"
	)
);

$dgPlugins = new DataGrid("dgPlugins", array(), $body, $footer);
$dgPlugins->setAttribute("border", "0");
$dgPlugins->setAttribute("cellpadding", "2");
$dgPlugins->setAttribute("cellspacing", "2");
$dgPlugins->setAttribute("width", "100%");

$doc->setEntity("plugins", $dgPlugins->toHTML());

echo $doc->getInnerHTML();
?>
