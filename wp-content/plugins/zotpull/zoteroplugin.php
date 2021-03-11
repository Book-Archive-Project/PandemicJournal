<?php
/*
 * Plugin Name: Zotero Plugin
*/
require('src/ZoteroController.php');
require('src/WordpressController.php');

$zoteroController = new ZoteroController('HfzJ9S7t7NdWpXAf6BjAqHf1',2725922);
$wordpressController = new WordpressController();

$wordpressController->init($zoteroController);


$zoteroController->getAllItems();
//$zoteroController->getItem('4Q8L3Y8V');
