<?php function screenshotlayer($url) {
// set optional parameters (leave blank if unused)
$params['fullpage']  = '';
$params['width'] = '360';
$params['viewport']  = '1440x900';
$params['format'] = '';
$params['css_url'] = '';
$params['delay'] = '';
$params['ttl'] = '';
$params['force']     = '';
$params['placeholder'] = '';
$params['user_agent'] = '';
$params['accept_lang'] = '';
$params['export'] = '';

// set access key
    $access_key = "02d39e9c95260ef6f217488685cdb055";

// set secret keyword (defined in account dashboard)
    $secret_keyword = "boopboopbeepbeep";

// encode target URL
$params['url'] = urlencode($url);

// create the query string based on the options
foreach($params as $key => $value) { $parts[] = "$key=$value"; }

// compile query string
$query = implode("&", $parts);

// generate secret key from target URL and secret keyword
$secret_key = md5($url . $secret_keyword);

return "https://api.screenshotlayer.com/api/capture?access_key=$access_key&secret_key=$secret_key&$query";

}


