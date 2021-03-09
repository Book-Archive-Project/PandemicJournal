<?php

require(dirname(__DIR__,1) . '/resources/simplehtmldom_1_9_1/simple_html_dom.php');
require('ZoteroController.php');

if( !class_exists("WordpressController")) {
    class WordpressController
    {

        public $zoteroController;

        public function init($theZoteroController)
        {
            $this->zoteroController = $theZoteroController;

            /*Add the processPage function in this class as a filter hook for Wordpress */
            add_filter('the_content', array($this, 'processPage'));
        }

        /*This function is unused right now, but I've included it because we may need to use this DOM parser to go through attachment pages and
        find elements to display*/
        function htmlDomParserExample($pathToPage)
        {
            $html = file_get_html($pathToPage);
            // Find all images
            foreach ($html->find('img') as $element)
                echo $element->src . '<br>';

            // Find all links
            foreach ($html->find('a') as $element)
                echo $element->href . '<br>';
        }

        /*Determines if the page is one of the date pages from the book*/
        function getDateFromPageTitle($page_title){
            return DateTime::createFromFormat('m-d', $page_title);
        }

        /*Function for determining what page we are on and determining what to do.*/
        function processPage($content)
        {
            /*Get page title and remove whitespace(for dates)*/
            $page_title = wp_title($sep = '', $display = false, $seplocation = '');
            $page_title = str_replace(" ", "", $page_title);

            /* if we are on a page that has a title in date format mm-dd, print a message and call
            the hedii controller to ensure we can */
            $theDate = $this->getDateFromPageTitle($page_title);
            if (is_page() &&  $theDate !== FALSE) {
                // $temp = "The page title is " . $page_title . ". We are on a date page <br>";
                $temp = $this->getDatePageContent($theDate);
                return $temp . $content;
            } else {
                return $content;
            }
        }

        function getDatePageContent($pageDate){
            $dirName = "/public/2020/" . $pageDate->format('m/d');
            $fileName =  dirname(__DIR__, 1) . $dirName . "/media.txt";
            $theFile = fopen($fileName, "r");
            $msg = fread($theFile, filesize($fileName));
            fclose($theFile);

            /*	append the text file contents to the end of `the_content` */
            return stripslashes($msg);
        }

        /*Just moving that code that put the Simpsons gif onto Wordpress */
        function gifInsert()
        {

            /* This code was just sample code to insert gif and text */
            if (!function_exists("bottom_of_every_post")) {
                function bottom_of_every_post($content)
                {

                    /*	there is a text file in the same directory as this script */
                    $fileName = $fileName = dirname(__DIR__, 1) . "/resources/text.txt";

                    /*	we want to change `the_content` of posts, not pages
                        and the text file must exist for this to work */

                    if (!is_page() && file_exists($fileName)) {

                        /*	open the text file and read its contents */

                        $theFile = fopen($fileName, "r");
                        $msg = fread($theFile, filesize($fileName));
                        fclose($theFile);


                        /*	append the text file contents to the end of `the_content` */
                        return $content . stripslashes($msg);

                    } else {

                        /*	if `the_content` belongs to a page or our file is missing
                            the result of this filter is no change to `the_content` */

                        return $content;
                    }
                }

                /*	add our filter function to the hook */

                add_filter('the_content', 'bottom_of_every_post');
            }

        }
    }
}