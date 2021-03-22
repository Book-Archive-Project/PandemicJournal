<?php

/*Determines if the page is one of the date pages from the book*/
function getDateFromPageTitle($page_title){
    return DateTime::createFromFormat('m-d', $page_title);
}

function getMediaForDate($page_title){
    $page_title = wp_title($sep = '', $display = false, $seplocation = '');
    $page_title = str_replace(" ", "", $page_title);

    $theDate = getDateFromPageTitle($page_title);
    if ($theDate !== FALSE) {
        // $temp = "The page title is " . $page_title . ". We are on a date page <br>";
        $temp = getDatePageContent($theDate);
        return $temp;
    }
    return "";
}

function getDatePageContent($pageDate){
    $dirName = "/plugins/zotpull/public/2020/" . $pageDate->format('m/d');
    $filename =  dirname(__DIR__, 2) . $dirName . "/media.txt";
    $theFile = fopen($filename, "r");
    $msg = fread($theFile, filesize($filename));
    fclose($theFile);

    /*	append the text file contents to the end of `the_content` */
    return stripslashes($msg);
}


?>