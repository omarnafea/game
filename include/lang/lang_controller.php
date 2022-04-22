<?php



$__page_url =  $_SERVER['REQUEST_URI'];


$params_en =  $params_ar = $_GET;
$params_en['lang'] = 'en';
$params_ar['lang']= 'ar';
$query_en = http_build_query($params_en);
$query_ar = http_build_query($params_ar);

$pageLink = 'http://localhost' . explode('?',$__page_url  )[0];


if(isset($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang'];
}

if(!isset($_SESSION['lang'])){
    $_SESSION['lang'] = "ar";
}

$langLink = $pageLink. '?'.$query_ar;
$langText = "العربية";

if($_SESSION['lang'] == 'ar'){

    $langLink = $pageLink. '?'.$query_en;
    $langText = "English";
    include(__DIR__ . '/lang_ar.php');
}else{
    include(__DIR__ . '/lang_en.php');
}