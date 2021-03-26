<?php

/**
 * Determines if the page is one of the date pages from the book
 * and returns the date
 *
 * @param $page_title
 * @return DateTime
 */
function getDateFromPageTitle($page_title): DateTime {
    return DateTime::createFromFormat('m-d', $page_title);
}

/**
 * Uses the usedate to find the media links for a specific media type
 *
 * @param $page_title
 * @param $media_type
 *
 */
function getMediaForDate($page_title, $media_type){
    $page_title = str_replace(" ", "", $page_title);
    $theDate = getDateFromPageTitle($page_title);
    if ($theDate !== FALSE) {
        $mediaLinks = getFileContents($theDate, "/". $media_type . ".txt");
        if($mediaLinks == "none") return;
        if($media_type == "images")
            formatImages($mediaLinks);
        else if($media_type == "videos")
            formatVideos($mediaLinks);
        else if($media_type == "snapshots")
            formatSnapshots($mediaLinks);
        else if($media_type == "gviewdocs")
            formatDocs($mediaLinks);
        else if($media_type == "audios")
            formatMusic($mediaLinks);
    }
}

/**
 * Returns all of the media links at pageDate path as a string
 *
 * @param $pageDate
 * @param $filename
 * @return string
 */
function getFileContents($pageDate, $filename): string {

    $dirName = "/plugins/zotpull/public/2020/" . $pageDate->format('m/d');
    $filename =  dirname(__DIR__, 2) . $dirName . $filename;
    if(!file_exists($filename)) return "none";
    $theFile = fopen($filename, "r");
    $msg = fread($theFile, filesize($filename));
    fclose($theFile);
    /*	append the text file contents to the end of `the_content` */
    return stripslashes($msg);
}

/**
 * Adds Snapshots to the usedate page in the correct format
 *
 * @param $snapshotLinks
 */
function formatSnapshots($snapshotLinks){

    $links = explode("\n", $snapshotLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link){
        $sources = explode("~bib~", $link);
        echo '<div class="d-flex justify-content-center">
                 <iframe id = "iframe" sandbox="allow-same-origin allow-scripts allow-popups allow-forms" src="' . $sources[0] . '" height="200" width = 100% ></iframe>
                       
          </div>';
    }
}

/**
 * Adds Docs to the usedate page in the correct format
 *
 * @param $docLinks
 */
function formatDocs($docLinks){

    $links = explode("\n", $docLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link){
        $sources = explode("~bib~", $link);
        echo '<div class="d-flex justify-content-center">
                
                <iframe src="https://docs.google.com/gview?url=' . $sources[0] . '"  width=100% height="600"></iframe>

                </div>';
    }
}

/**
 * Adds Videos to the usedate page in the correct format
 *
 * @param $videoLinks
 */
function formatVideos($videoLinks) {
    $i = 0;
    $links = explode("\n", $videoLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link){
        $sources = explode("~bib~", $link);
        if($i == 0) {
            echo ' 
                <div class="carousel-item active">
                  <!--Mask color-->
                  <div class="view">
                    <!--Video source-->
                    <video class="video-fluid" autoplay loop muted>
                      <source src="' . $sources[0] . '" type="video/mp4" />
                    </video>
                  </div>
                </div>';
        } else {
            echo ' 
                <div class="carousel-item">
                  <!--Mask color-->
                  <div class="view">
                    <!--Video source-->
                    <video class="video-fluid" autoplay loop muted>
                      <source src="' . $sources[0] . '" type="video/mp4" />
                    </video>
                  </div>
                </div>';
        }
        $i++;
    }
}

/**
 * Adds Audios to the usedate page in correct format
 *
 * @param $audiosLinks
 */
function formatMusic($audiosLinks) {
    $i = 0;
    $links = explode("\n", $audiosLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link) {
        $sources = explode("~bib~", $link);
        echo'
        <audio controls>
          <source src="' . $sources[0] . '" type="audio/ogg">
            Your browser does not support the audio tag.
        </audio>';
    }
}

/**
 * Adds Images to the usedate page in the correct format
 *
 * @param $imageLinks
 */
function formatImages($imageLinks){
    $i = 0;
    $links = explode("\n", $imageLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link){
        $sources = explode("~bib~", $link);
        if (!empty($link)) {

        if($i == 0){
            echo '<div class="carousel-item active" > 
                        <img class="d-block w-100" src="' . $sources[0] . '" alt="Slide ' .'" title="' . $sources[1] .'"> 
                  </div>';
        }
        else{
            echo '<div class="carousel-item">
            <img class="d-block w-100" src="' . $sources[0] . '" title="'. $sources[1] . '">
        </div>';
            }
            $i++;
        }
    }
}

/**
 * Checks if a use date has a specific media type,
 * and if it doesn't don't display that category
 *
 * @param $page_title
 * @param $filename
 * @return bool
 */
function hasMediaFile($page_title, $filename) : bool {
    $page_title = str_replace(" ", "", $page_title);
    $theDate = getDateFromPageTitle($page_title);
    if ($theDate !== FALSE) {
        $dirName = "/plugins/zotpull/public/2020/" . $theDate->format('m/d');
        $filename = dirname(__DIR__, 2) . $dirName . '/' . $filename;
        if (!file_exists($filename)) return false;
        return true;
    }
    return false;
}

?>
