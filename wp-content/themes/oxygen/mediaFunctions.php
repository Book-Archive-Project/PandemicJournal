<?php

/**
 * Determines if the page is one of the date pages from the book
 * and returns the date
 *
 * @param $page_title
 * @return DateTime
 */
function getDateFromPageTitle($page_title): DateTime {
    //return false;
    return DateTime::createFromFormat('Y-m-d', $page_title);
}

function showTitle($page_title)
{
    $date = explode("-", $page_title);

    //$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    //echo $months[(int)$date[0]-1].' '.$date[2] . ' ' . $date[0];

    if($date[1] == '01'){
        echo 'January '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '02'){
        echo 'February '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '03'){
        echo 'March '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '04'){
        echo 'April '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '05'){
        echo 'May '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '06'){
        echo 'June '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '07'){
        echo 'July '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '08'){
        echo 'August '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '09'){
        echo 'September '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '10'){
        echo 'October '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '11'){
        echo 'November '.$date[2] . ' ' . $date[0];
    } else if($date[1] == '12'){
        echo 'December '.$date[2] . ' ' . $date[0];
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
            $manuscriptText =  mb_convert_encoding(file_get_contents($sources[0]), 'UTF-8', 'auto');
            echo '

            <div class="row">
            <div class = "col">
            <h2 class ="text-center">' . $sources[2] . ' </h2>
           <div>
              <div class="card card-body">
              <div class="outermanuscript">
                 <div class="manuscriptcontent">

              ' . $manuscriptText . '
              </div>
                </div>
              </div>
            </div>
            <h3 class = "text-center">' . $sources[1] . ' </h3>
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
        else if ($media_type == "manuscripts")
            formatManuscripts($mediaLinks);
        else if ($media_type == "links")
            formatLinks($mediaLinks);
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

    $dirName = "/plugins/zotpull/public/" . $pageDate->format('Y/m/d');
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
            if($i!=0 && $i%3 == 0){
                echo '</div><div class="row snapshotbox">';
            }
            echo '
                  <div class="simthumbnail-container">
                        <a href="' . $sources[0] . '" target=”_blank”> <figcaption>
                            <h8>' . $sources[1] . '</h8>   
                        </figcaption>
                        <h6>' . $sources[2] . '</h6>
                        <div class="simthumbnail">
                            <iframe sandbox="allow-same-origin allow-scripts allow-popups allow-forms" src="' . $sources[0] . '" frameborder="0" >           
                            </iframe>
                        </div>
                        </a>         
            </div>';
                    $i++;
        }
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
        $sources = explode("~d~", $link);
        if (!empty($link)) {
            if ($i == 0) {
                echo '

                    <div class="item active">
                         <h2 class="videocaption"> '. $sources[2] .' </h2>
                    <!--The width and height can/need to be adjusted for your site parameters-->
                         <video style=" border = 0; outline:none;" class="video" width="1140px" height="480px"  muted controls>
                            <source src ="'.$sources[0].'"   type="video/mp4" />
                         </video>
                         <h6 class="videocaption"> '. $sources[1] .' </h6>
                    </div>';
            } else {
                echo '<div class="item">
                        <h2 class="videocaption"> '. $sources[2] .' </h2>
                        <video style=" border = 0; outline:none;" class="video" width="1140px" height="480px"  muted controls>
                            <source src ="'.$sources[0].'"   type="video/mp4" />
                         </video>
                        <h6 class="videocaption"> '. $sources[1] .' </h6>
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
    $i = 0;
    $links = explode("\n", $docLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link){
        $sources = explode("~d~", $link);
        if (!empty($link)) {
            if($i!=0 && $i%3 == 0) {
                echo '</div><div class="row snapshotbox">';
            }
                echo '<div class="doccontainer">
       
                <iframe class ="dociframe" src="https://docs.google.com/gview?url=' . $sources[0] . '" frameborder="0"></iframe>
                <h6>' . $sources[2] . '</h6>
                </div>';
            }
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
            echo '<div class="col-sm-3"><div class ="audiodiv">
                <h4 class="audio"> ' . $sources[2] . ' </h4>
                  <div class="break"></div> <!-- break -->
                <audio controls>
                <source src="' . $sources[0] . '" type="audio/ogg">
                    Your browser does not support the audio tag.
                </audio> 
                <h6 class="audio"> ' . $sources[1] . '</h6>
            </div></div>';
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
            if($i!=0 && $i%3==0){
                echo '</div><div class="row imgbox">';
            }
            echo '<div class="col-xs-12 col-sm-3" >
                        <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms" >
                            <div class="folio-image">
                                <img class="img-responsive" src="' . $sources[0] . '"  alt="">
                            </div>
                            <div class="overlay">
                                <div class="overlay-content">
                                    <div class="overlay-text">
                                        <div class="folio-info">
                                            <h2>' . $sources[2] . '</h2>
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

function formatLinks($liveLinks)
{
    $links = explode("\n", $liveLinks);
    foreach (array_slice($links, 0, count($links) - 1) as $link) {
        $sources = explode("~d~", $link);
        if (!empty($link)) {
            echo '
            <div class="live-link" style="padding:0 15px 15px 15px;">
                <a style="word-wrap: break-word" href="' . $sources[0] . '">' . $sources[1] . '</a>
            </div>
            ';
        }
    }
}

function addDropdown($pages)
{
    $months = array(
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July ',
        'August',
        'September',
        'October',
        'November',
        'December',
    );


    for($i = 0; $i <= 11; $i++) {
        // echo '<a class="dropdown-item" href="#"> ' . $page->post_title . ' </a>';
        echo '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ' . $months[$i] . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <ul>
                    ';  foreach ($pages as $page) {
                            if (preg_match("~^\d{4}-\d{2}-\d{2}$~", $page->post_title)) {
                                $cur = explode("-", $page->post_title);
                                if ($cur[1] == $i + 1)
                                    echo '<li><a class="dropdown-item" href="http://localhost/pandemicjournal/'. $page->post_title .'">' . $cur[1] . '-' . $cur[2] . '</a></li>';
                            }
                    }echo '
                        </ul> 
                      </div>
                    </div>';
        }
}


