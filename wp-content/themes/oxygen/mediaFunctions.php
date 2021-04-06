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

function showTitle($page_title)
{
    $date = explode("-", $page_title);

    if($date[0] == '01'){
        echo 'January, '.$date[1];
    } else if($date[0] == '02'){
        echo 'February, '.$date[1];
    } else if($date[0] == '03'){
        echo 'March, '.$date[1];
    } else if($date[0] == '04'){
        echo 'April, '.$date[1];
    } else if($date[0] == '05'){
        echo 'May, '.$date[1];
    } else if($date[0] == '06'){
        echo 'June, '.$date[1];
    } else if($date[0] == '07'){
        echo 'July, '.$date[1];
    } else if($date[0] == '08'){
        echo 'August, '.$date[1];
    } else if($date[0] == '09'){
        echo 'September, '.$date[1];
    } else if($date[0] == '10'){
        echo 'October, '.$date[1];
    } else if($date[0] == '11'){
        echo 'November, '.$date[1];
    } else if($date[0] == '12'){
        echo 'December, '.$date[1];
    }
}

/**
 * Adds Manuscripts to the usedate page in the correct format
 *
 * @param $manuscriptLinks
 */
function formatManuscripts($manuscriptLinks) {
    $i = 0;
    $links = explode("\n", $manuscriptLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link){
        $sources = explode("~d~", $link);
        if (!empty($link)) {
            $manuscriptText = file_get_contents($sources[0]);
            echo '<div class="row">
               <div class = "col">
            <h3 class = "text-center">' . $sources[1] . ' 
              <br><br>
             <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
               Text
              </a></h3><
           <div class="collapse" id="collapseExample">
              <div class="card card-body">
              ' . $manuscriptText . '
              </div>
            </div>
            </div>
            </div>';
        }
    }
}

function getImageLink($link) : string {
    return get_template_directory_uri().$link;
}
/**
 * Uses the usedate to find the media links for a specific media type
 *
 * @param $page_title
 * @param $media_type
 *
 */
function getMediaForDate($page_title, $media_type)
{
    $page_title = str_replace(" ", "", $page_title);
    $theDate = getDateFromPageTitle($page_title);
    if ($theDate !== FALSE) {
        $mediaLinks = getFileContents($theDate, "/" . $media_type . ".txt");
        if ($mediaLinks == "none") return;
        if ($media_type == "images")
            formatImages($mediaLinks);
        else if ($media_type == "videos")
            formatVideos($mediaLinks);
        else if ($media_type == "snapshots")
            formatSnapshots($mediaLinks);
        else if ($media_type == "gviewdocs")
            formatDocs($mediaLinks);
        else if ($media_type == "audios")
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
function getFileContents($pageDate, $filename): string
{

    $dirName = "/plugins/zotpull/public/2020/" . $pageDate->format('m/d');
    $filename = dirname(__DIR__, 2) . $dirName . $filename;
    if (!file_exists($filename)) return "none";
    $theFile = fopen($filename, "r");
    $msg = fread($theFile, filesize($filename));
    fclose($theFile);
    /*	append the text file contents to the end of `the_content` */
    return stripslashes($msg);
}

/** Adds Snapshots to the usedate page
 *
 * @param $snapshotLinks
 */
function formatSnapshots($snapshotLinks)
{
    $i = 0;
    $links = explode("\n", $snapshotLinks);
    foreach (array_slice($links, 0, count($links) - 1) as $link) {
        $sources = explode("~d~", $link);
        if (!empty($link)) {
            if($i!=0 && $i%2 == 0){
                echo '</div><div class="row snapshotbox form-group">';
            }
            echo '<div class="simthumbnail-container"><a href="' . $sources[0] . '" target=”_blank”> <figcaption>
                            <h3>' . $sources[2] . '</h3>
                        </figcaption><div class="simthumbnail"><iframe sandbox="allow-same-origin allow-scripts allow-popups allow-forms" src="' . $sources[0] . '" frameborder="0" ></iframe></div>
                       </div>';
                    $i++;
        }
    }
    echo '</div>';
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
        $sources = explode("~d~", $link);
        if (!empty($link)) {
            if ($i == 0) {
                echo '<div class="item active">
                        <video class="video-fluid" id="vid1" autoplay loop muted>
                            <source src="' . $sources[0] . '" type="video/mp4" />
                        </video>
                         <div class="text-center">
                         <h4 id="videocaption" > ' . $sources[1] . '</h4>
                         <p></p></div>
                    </div>';
            } else {
                echo '<div class="item">
                        <video class="video-fluid" id="vid1" autoplay loop muted>
                            <source src="' . $sources[0] . '" type="video/mp4" />
                        </video>
                         <div class="text-center">
                         <h4 id="videocaption">' . $sources[1] . '</h4>
                         <p></p></div>
                    </div>';
            }
            $i++;
        }
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
        $sources = explode("~d~", $link);
        echo '<div class="d-flex justify-content-center">
                
                <iframe src="https://docs.google.com/gview?url=' . $sources[0] . '"  width=100% height="600"></iframe>

                </div>';
    }
}

/**
 * Adds Audios to the usedate page in correct format
 *
 * @param $audiosLinks
 */
function formatMusic($audiosLinks)
{
    $i = 0;
    $links = explode("\n", $audiosLinks);
    foreach (array_slice($links, 0, count($links) - 1) as $link) {
        $sources = explode("~d~", $link);
        if (!empty($link)) {
            if($i!=0 && $i%3==0){
                echo '</div><div class="row audiobox">';
            }
            echo '<div class="col-sm-3">
                <h4 class="audio"> ' . $sources[2] . ' </h4>
                <audio controls>
                <source src="' . $sources[0] . '" type="audio/ogg">
                    Your browser does not support the audio tag.
                </audio> 
            </div>';
            $i++;
        }
    }
}


/** Adds Images to the usedate page in the correct format
 *
 * @param $imageLinks
 */
function formatImages($imageLinks)
{
    $i = 0;
    $links = explode("\n", $imageLinks);
    foreach (array_slice($links, 0, count($links) - 1) as $link) {
        $sources = explode("~d~", $link);

        if (!empty($link)) {
            if($i!=0 && $i%4==0){
                echo '</div><div class="row imgbox">';
            }
            echo '<div class="col-sm-3" >
                        <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms" >
                            <div class="folio-image">
                                <img class="img-responsive dateimage" src="' . $sources[0] . '" style="height:300px; width:100%;" alt="">
                            </div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <div class="overlay-text">
                                        <div class="folio-info">
                                            <h3>' . $sources[1] . '</h3>
                                        </div>
                                        <div class="folio-overview">
                                            <span class="folio-expand"><a href="' . $sources[0] . '" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
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
function hasMediaFile($page_title, $filename): bool
{
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


