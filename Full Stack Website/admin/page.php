<?php
// condition / true :false

$do = isset($_GET['do']) ? $do = $_GET['do'] : "manage" ;

        // if the page is  main page 

        if($do == 'manage' ){

            echo  "welcome you are in manage category page";
            echo "<a href='page.php?do=insert' > add new Category + </a>";
        } elseif ($do == 'add') {

            echo "you are in add category page";

        }elseif ($do == 'insert') {

            echo "you are in insert category page";
        
        }else {

            echo 'ERROR there is no page with this name';
        }
