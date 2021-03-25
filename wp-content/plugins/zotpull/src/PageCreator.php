<?php

require 'vendor/autoload.php';

if( !class_exists("PageCreator")) {
    class PageCreator
    {
        public function __construct()
        {
            /*add_action( 'zoteroCronJob', 'getAllItems' );
            if ( ! wp_next_scheduled( 'zoteroCronJob' ) ) {
                wp_schedule_event( time(), 'daily', 'zoteroCronJob' );
            }*/
            //add_action('init', array($this, 'AddThisPage'));
        }

        public function AddThisPage()
        {
            $page = array(
                'page_template' => 'exampletemplate.php', //Sets the template for the page.
                'post_title' => '03-17', //The title of your post.
                'post_status' => 'publish',
                'post_type' => 'page'
            );

            $page_exists = get_page_by_title($page['post_title']);
            //echo $page_exists->ID;
            if ($page_exists == null) {
                // Page doesn't exist, so lets add it
                $insert = wp_insert_post($page);
                if ($insert) {
                    // Page was inserted ($insert = new page's ID)
                }
            } else {
                // Page already exists
            }
        }
    }
}


