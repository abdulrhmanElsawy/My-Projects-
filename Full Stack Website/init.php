<?php


// Error Reporting

ini_set('display_errors', 'On');

error_reporting(E_ALL);


include 'admin/connect.php';

$sessionUser = '';

if(isset($_SESSION['user'])){
    $sessionUser =$_SESSION['user'];
    
}

;
$UserPhoto   = '';
if(isset($_SESSION['avatar'])){
    $UserPhoto = $_SESSION['avatar'];
}


// Routes

$tpl = "includes/templates/";  //Template Directory

$css =  "layout/css/";  // css directory

$func = "includes/functions/";  // functions directory

$js =  "layout/js/";  // js directory

$lang = 'includes/languages/';

$language = 'english';
if (isset($_GET['lang']) && $_GET['lang']=='ar') {
    $language = 'Arabic';
}
if (isset($_GET['lang']) && $_GET['lang']=='en') {
    $language = 'english';
}


// include the important files 
include $func . "functions.php";
include  $lang . $language .'.php';
include $tpl . 'header.php';




