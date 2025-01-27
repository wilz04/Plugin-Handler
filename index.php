<?php
include_once("model/Document.class.php");
include_once("model/Collection.class.php");

$catalog = new Collection("app_vw_plugins");
$plugin = $catalog->getRecordByAttribute("_enabled", "1");

$doc = new Document("plugins/".$plugin['_url']);
echo $doc->getInnerHTML();
?>
