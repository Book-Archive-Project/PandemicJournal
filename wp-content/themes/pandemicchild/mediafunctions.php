<?php

/*Determines if the page is one of the date pages from the book*/
function getDateFromPageTitle($page_title){
    return DateTime::createFromFormat('m-d', $page_title);
}

function getFileContents($pageDate, $filename){

    $dirName = "/plugins/zotpull/public/2020/" . $pageDate->format('m/d');
    $filename =  dirname(__DIR__, 2) . $dirName . $filename;
    if(!file_exists($filename)) return "none";
    $theFile = fopen($filename, "r");
    $msg = fread($theFile, filesize($filename));
    fclose($theFile);
    /*	append the text file contents to the end of `the_content` */
    return stripslashes($msg);
}

function hasMediaFile($page_title, $filename){
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
    }
}
function formatSnapshots($snapshotLinks){

    $links = explode("\n", $snapshotLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link){
        echo '<div class="d-flex justify-content-center">
                
                 <iframe sandbox="allow-same-origin allow-scripts allow-popups allow-forms" src="' . $link . '" height="600" width = 100% ></iframe>
              
                </div>';
    }
}

function formatDocs($snapshotLinks){

    $links = explode("\n", $snapshotLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link){
        echo '<div class="d-flex justify-content-center">
                
                <iframe src="https://docs.google.com/gview?url=' . $link . '"  width=100% height="600"></iframe>

                </div>';
    }
}

function formatVideos($videoLinks) {
    $i = 0;
    $links = explode("\n", $videoLinks);
    foreach(array_slice($links, 0, count($links) -1) as $link){
        if($i == 0) {
            echo ' 
                <div class="carousel-item active">
                  <!--Mask color-->
                  <div class="view">
                    <!--Video source-->
                    <video class="video-fluid" autoplay loop muted>
                      <source src="' . $link . '" type="video/mp4" />
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
                      <source src="' . $link . '" type="video/mp4" />
                    </video>
                  </div>
                </div>';
        }
        $i++;
    }
}

function formatImages($imageLinks){
    $i = 0;
    $links = explode("\n", $imageLinks);
    foreach($links as $link){
        if($i == 0){
            echo '<div class="carousel-item active"> 
                        <img class="d-block w-100" src="' . $link . '" alt="Slide ' .'"> 
                  </div>';
        }
        else{
            echo '<div class="carousel-item">
            <img class="d-block w-100" src="' . $link . '" alt="Slide ' .'">
        </div>';
        }
        $i++;
    }
    /*<img class="d-block w-100" src="http://www.personal.psu.edu/kbl5192/jpg.jpg" alt="First slide">
    </div>

    <div class="carousel-item active">
      <img class="d-block w-100" src="http://www.personal.psu.edu/kbl5192/jpg.jpg" alt="Third slide">
    </div>
    echo */

}


?>