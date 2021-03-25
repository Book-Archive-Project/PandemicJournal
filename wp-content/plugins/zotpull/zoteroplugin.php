<?php
/*
 * Plugin Name: Zotero Plugin
*/
require('src/PageCreator.php');

$pageCreator= new PageCreator();


$pageCreator->addThisPage();
//$zoteroController->getItem('U3PR98R5');



/*register_deactivation_hook( __FILE__, 'zp_deactivate' );



function zp_deactivate() {
    $timestamp = wp_next_scheduled( 'zoteroCronJob');
    wp_unschedule_event( $timestamp, 'zoteroCronJob' );
}*/

