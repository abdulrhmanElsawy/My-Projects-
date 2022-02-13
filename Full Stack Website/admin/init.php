<?php

include 'connect.php';


// Routes

$tpl = "includes/templates/";  //Template Directory

$css =  "layout/css/";  // css directory

$func = "includes/functions/";  // functions directory

$js =  "layout/js/";  // js directory

$lang = 'includes/languages/';


// include the important files 
include $func . "functions.php";
include  $lang . 'english.php';
include $tpl . 'header.php';

// include nav bar in all pages expect the one no nav bar

if(!isset($noNavbar)) {
    include $tpl . 'navbar.php';

}



