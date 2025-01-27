<?php
include_once("model/Collection.class.php");

$rbEnable = $_POST['rbEnable'];

$plugins = new Collection("app_tb_settings");
$plugins->setRecordAttributes("_key", "home", array('_value'=>$rbEnable));

header("location: admin.php");
?>
