<?php

/*************************************************************************
 *   Get All Function v2.0                                               *                          
 *  Function To Get All Records From Any Database Table                 *                                  
**************************************************************************/


function getAllFrom($field, $table, $where = NULL, $and = NULL, $orderfield, $ordering = 'DESC'){

    global $con;

    $getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");

    $getAll->execute();

    $all = $getAll->fetchAll();

    return $all;
}

















/*************************************************************************
 *   Get categories Function v1.0                                        *                          
 *  Function To Get Categories From Database                             *                                  
**************************************************************************/


function getCat(){

    global $con;

    $getCat = $con->prepare("SELECT * FROM categories ORDER BY ID ASC");

    $getCat->execute();

    $cats = $getCat->fetchAll();

    return $cats;
}



/*************************************************************************
 *   Check if user is not activated [v1.0]                               *                          
 *  Function To Check the regstatus of the user                          *                                  
**************************************************************************/


function checkUserStatus($user){
                global $con;

                $stmtx = $con->prepare("SELECT 
                UserName , RegStatus 
                FROM 
                    users 
                WHERE 
                    UserName = ?  
                AND 
                    RegStatus = 0");

            $stmtx->execute(array($user));

            $status = $stmtx->rowCount();

            return $status;
}


    // /**************************************************************************** 
    // * Check items Function [v1.0]                                               *
    // * Function to check item in database                                        *
    // * [Function accept parameters]                                              *
    // * $select = the item to select [example: user, item , category]             *
    // * $from  = the table tp selct from [example : user , items  , categories]   *
    // * $value = the value of the select [example : osama , box , electronics]    *
    // *****************************************************************************/

    // function checkItem($select, $from, $value){
    //     global $con;

    //     $statement = $con->prepare("SELECT $select FROM $from Where $select = ?");

    //     $statement->execute(array($value));

    //     $count = $statement->rowCount();

    //     return $count;
    // }










// -------------------------------------------------------------------------------------------------------------
















    // Title Function v1.0
    
    // title function that echo the page title in cas page has the variable $pagetitle and echo default title for other pages

    function getTitle () {

        global $pageTitle;

        if(isset($pageTitle)){
            echo $pageTitle;
        }else{
            echo 'Default';
        }



    }

    /*************************** 

        Home Redirect Function v2.0
        this function Accept parameters
        $themsg=echo the [Error | Success | Warning]
        $Url = the link you want to be redirected to
        $secconds = Seconds Before Redireceting

    ******************************/




    function redirectHome($theMsg , $url=null , $seconds = 3){

        if($url === null){
            $url ='index.php';
            $link = 'Homepage';
        }else{
            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
                $url = $_SERVER['HTTP_REFERER'];
                $link = 'pervious page';

            }else{
                $url = 'index.php';

                $link = 'Homepage';
            }
            
        }
        

        echo $theMsg;

        echo "<div class='alert alert-danger'>You will be redirected to $link after $seconds Seconds</div>";

        header("refresh:$seconds;url=$url");
        exit();
    
    }

    /**************************************************************************** 
    * Check items Function [v1.0]                                               *
    * Function to check item in database                                        *
    * [Function accept parameters]                                              *
    * $select = the item to select [example: user, item , category]             *
    * $from  = the table tp selct from [example : user , items  , categories]   *
    * $value = the value of the select [example : osama , box , electronics]    *
    *****************************************************************************/

    function checkItem($select, $from, $value){
        global $con;

        $statement = $con->prepare("SELECT $select FROM $from Where $select = ?");

        $statement->execute(array($value));

        $count = $statement->rowCount();

        return $count;
    }



    /******************************************
     * Count number of Items function [v1.0]  *
     * Function to count number of items rows *
     * $item = the item to count              *
     * $table = the table to choose from      *
     * ****************************************/ 

    function countItems($item , $table){

        global $con;

    $stmt2 = $con->prepare("SELECT COUNT($item)FROM $table");

    $stmt2->execute();

    return $stmt2->fetchColumn();

}


/*************************************************************************
 *  get lates Records Function v1.0                                      *                          
 *  Function To Get Latest Items from Database [Users , ITems ,Comments] *                                  
 *  $select =field to select                                             * 
 *  $table = table to choose from                                        *                 
 *  $order = THE desc Ordering                                           *
 *  $limit = Number of the records to get                                *  
**************************************************************************/


    function getLatest($select, $table, $order, $limit = 5){

        global $con;

        $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

        $getStmt->execute();

        $rows = $getStmt->fetchAll();

        return $rows;
    }