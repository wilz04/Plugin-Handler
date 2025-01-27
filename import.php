<?php
include_once("model/FileHandler.class.php");
include_once("model/Collection.class.php");

$plugin = new FileHandler();
$plugin->setUploadedData("flPlugin", "plugins/");

$plugins = new Collection("app_tb_plugins");
$plugins->addRecord(array('_url'=>$plugin->name));

header("location: admin.php");
?>
