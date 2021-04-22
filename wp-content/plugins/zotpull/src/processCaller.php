<?php
require('zoteroProcess.php');

$zoteroController = new ZoteroController('tE4QQTHxBPlDc0qowE4CVhJi', 2491242);
//$zoteroController = new ZoteroController('HfzJ9S7t7NdWpXAf6BjAqHf1', 2725922);
$zoteroController->getAllItems();