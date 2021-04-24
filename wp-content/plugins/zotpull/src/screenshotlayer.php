<?php
function screenshotlayer($url) {
    $auth = '40296-345f490d6e48e49e3a813c60aabd9a6b';
    $imgurl = 'https://image.thum.io/get/auth/' . $auth . '/width/360/crop/750/noanimate/' . $url ;

    return $imgurl;
}




