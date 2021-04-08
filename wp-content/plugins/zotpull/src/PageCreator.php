<?php

require 'vendor/autoload.php';

if( !class_exists("PageCreator")) {
    class PageCreator
    {

        public function __construct()
        {
            add_action('init', array($this, 'AddThisPage'));
        }

        public function AddThisPage()
        {
            $dirName = "/zotpull/resources/temp/";
            $filename =  dirname(__DIR__, 2) . $dirName . "useData.txt";
            $theFile = fopen($filename, "r");
            $msg = fread($theFile, filesize($filename));
            fclose($theFile);

            $links = explode("\n", $msg);
            foreach( array_slice($links, 0, count($links) -1) as $item ) {

                $item = str_replace("/","-",$item);
                $str2 = substr($item, 5);


                $page = array(
                    'page_template' => 'datePage.php', //Sets the template for the page.
                    'post_title' => $str2, //The title of your post.
                    'post_status' => 'publish',
                    'post_type' => 'page'
                );

                if ( ! function_exists( 'post_exists' ) ) {
                    require_once( ABSPATH . 'wp-admin/includes/post.php' );
                }
                $page_exists = post_exists($page['post_title']);

                if ($page_exists == 0) {
                    $insert = wp_insert_post($page);
                    $my_post = array(
                        'ID'           => $insert,
                        'post_title'   => $str2
                    );

                    wp_update_post( $my_post );
                }
            }
        }
    }
}


