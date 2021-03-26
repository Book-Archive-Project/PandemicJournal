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
                    'page_template' => 'exampletemplate.php', //Sets the template for the page.
                    'post_title' => $str2, //The title of your post.
                    'post_status' => 'publish',
                    'post_type' => 'page'
                );

                $page_exists = get_page_by_title($page['post_title']);

                if ($page_exists == null) {
                    // Page doesn't exist, so lets add it
                    $insert = wp_insert_post($page);
                }
            }
        }
    }
}


