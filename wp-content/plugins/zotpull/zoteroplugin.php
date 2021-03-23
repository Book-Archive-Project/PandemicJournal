<?php
/*
 * Plugin Name: Zotero Plugin
*/
require('src/ZoteroController.php');
require('src/WordpressController.php');

set_time_limit(500);

$zoteroController = new ZoteroController('HfzJ9S7t7NdWpXAf6BjAqHf1',2725922);
$wordpressController = new WordpressController($zoteroController);

//$zoteroController->getAllItems();
$zoteroController->getItem('5ZQQ6YET');
$zoteroController->getItem('5XCI8EBM');
$zoteroController->getItem('8RQUMF5A');


/*register_deactivation_hook( __FILE__, 'zp_deactivate' );



function zp_deactivate() {
    $timestamp = wp_next_scheduled( 'zoteroCronJob');
    wp_unschedule_event( $timestamp, 'zoteroCronJob' );
}*/

