<?php

    

    session_start(); // start the session

    session_unset(); //unset the data and dont destroy the data

    session_destroy(); // destroy the session

    header ('location: index.php');  //get me to the index page

    exit();