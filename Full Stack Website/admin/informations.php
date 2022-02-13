<?php


    // Items page


    ob_start();

    session_start();

    $pageTitle = 'Informations';

    if(isset($_SESSION['UserName']) && $_SESSION['UserName'] == "Elsawy"){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET ['do']:'manage';

        if($do == 'manage'){
            // manage Items page 

            
        
        $stmt = $con->prepare("SELECT 
                                * 
                                FROM informations
        ORDER BY id ASC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $informations = $stmt->fetchAll();
        
            if (! empty($informations)){
        
        ?>

<h1 class="text-center"> Manage informations</h1>
<div class="container">
    <div class="table-responsive">
        <table class="main-table text-center table table-bordered">
            <tr>
                <td>ID</td>
                <td>Browser</td>
                <td>IP</td>
                <td>Date</td>
                <td>Pagelooked</td>
                <td>Time</td>
            </tr>
            <?php

                        foreach($informations as $information){
                            echo "<tr>";
                                echo "<td>". $information['id'] . "</td>";
                                echo "<td>". $information['userbrowser'] . "</td>";
                                echo "<td>". $information['userip'] . "</td>";
                                echo "<td>". $information['pagelook'] . "</td>";
                                echo "<td>". $information['date'] . "</td>";
                                echo "<td>". $information['timeget'] . "</td>";
                                echo "<td> 
                                <a href='informations.php?do=Delete&id=" . $information['id'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                                echo"</td>";
                                echo "</tr>";
                        }

                        ?>

            <tr>
        </table>
    </div>

</div>

<?php }else {
            echo '<div class="container">';
                echo "<div class='nice-message'>There Is No informations To Show</div>";
            echo '</div>';
        }

        }elseif($do == 'Delete'){
                        // Delete Item Page
                        echo "<h1 class='text-center'>  Delete item </h1>";
                        echo "<div class='container'>";

                        // check if get request ItemID is numeric & get the integer value of it

                        $id = isset($_GET['id']) && is_numeric($_GET['id'] ) ?intval ($_GET['id']): 0 ;

                        // check if there is an id as sent or not 

                        $check = checkItem('id','informations', $id);

                        // if there is such id show the form

                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM informations WHERE id = :zid");
                        $stmt->bindParam(":zid" , $id);
                        $stmt->execute();

                        $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Deleted </div>";

                        redirectHome($theMsg, 'back');
                    }else{
                        $theMsg = "<div class='alert alert-danger'>This ID is NOT Exist</div>"; 
                        redirectHome($theMsg);
                    }

                    echo '</div>';

        echo '</div>';


        }
        include $tpl . 'footer.php';
    }else{
        header('Location: index.php');
        exit();
    }

    ob_end_flush();

?>