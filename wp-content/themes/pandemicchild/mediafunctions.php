<?php

/*Determines if the page is one of the date pages from the book*/
function getDateFromPageTitle($page_title){
    return DateTime::createFromFormat('m-d', $page_title);
}

function getFileContents($pageDate, $filename){
    $dirName = "/plugins/zotpull/public/2020/" . $pageDate->format('m/d');
    $filename =  dirname(__DIR__, 2) . $dirName . $filename;
    $theFile = fopen($filename, "r");
    $msg = fread($theFile, filesize($filename));
    fclose($theFile);
    /*	append the text file contents to the end of `the_content` */
    return stripslashes($msg);
}

function getImagesForDate($page_title){
    $page_title = str_replace(" ", "", $page_title);
    $theDate = getDateFromPageTitle($page_title);
    if ($theDate !== FALSE) {
        $imageLinks = getFileContents($theDate, "/images.txt");
        formatImages($imageLinks);
        echo $imageLinks;
    }
}

function formatImages($imageLinks){
    $i = 0;
    $links = explode("\n", $imageLinks);
    foreach($links as $link){
        if($i == 0){
            echo '<img class="d-block w-100" src="' . $link . '" alt="Slide ' .'">
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