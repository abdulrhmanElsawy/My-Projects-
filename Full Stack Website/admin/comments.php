<?php

    // Manage Comments page 
    // you can  | Edit | Delete|Approve Comments From Here

    session_start();

    $pageTitle = 'Comments';

    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET['do']:'manage';

        // Start Manage Page



        if($do == 'manage'){ // manage Members page 

            $query = '';



            
            // select all user except admin
        
        $stmt = $con->prepare("SELECT 
                                    comments.*,items.Name AS Item_Name, users.UserName AS Member
                                FROM 
                                    comments
                                INNER JOIN 
                                    items
                                ON
                                    items.Item_ID = comments.item_id
                                INNER JOIN 
                                    users
                                ON
                                    users.UserID = comments.user_id
                                    ORDER BY 
                                        c_id DESC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $comments = $stmt->fetchAll();
        
        if(! empty($comments)){
        
        ?>

            <h1 class="text-center"> Manage Comments</h1>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                            <td>ID</td>
                            <td>Comment</td>
                            <td>item Name</td>
                            <td>User Name</td>
                            <td>Added Date</td>
                            <td>Control</td>
                        </tr>
                        <?php

                        foreach($comments as $comment){
                            echo "<tr>";
                                echo "<td>". $comment['c_id'] . "</td>";
                                echo "<td>". $comment['comment'] . "</td>";
                                echo "<td>". $comment['Item_Name'] . "</td>";
                                echo "<td>". $comment['Member'] . "</td>";
                                echo "<td>". $comment['comment_date'] . "</td>";
                                echo "<td> 
                                <a href='comments.php?do=edit&comid=" . $comment['c_id'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                                <a href='comments.php?do=Delete&comid=" . $comment['c_id'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                                if($comment['status'] == 0){

                                    echo "
                                    <a href='comments.php?do=Approve&comid=" . 
                                    $comment['c_id'] . "'class='btn btn-info activate '>
                                    <i class='fa fa-check'></i> Approve </a>";
                                }

                                echo"</td>";
                                echo "</tr>";
                        }

                        ?>

                        <tr>
                </table>
                </div>
            </div>

            <?php }else{
                echo '<div class="container">';
                    echo '<div class="nice-message"> There Is No Commnets To Show';
                echo '</div>';
            } ?>
            
        <?php 


        
        
    
    }elseif ($do == 'edit') { // edit page 

            // check if get request userid is numeric & get the integer value of it

            $comid = isset($_GET['comid']) && is_numeric($_GET['comid'] ) ?intval ($_GET['comid']): 0 ;
            // select all data depend on this id 
            $stmt = $con->prepare("SELECT * FROM comments WHERE c_id = ? ");

            // excure query
            $stmt->execute(array($comid));

            // bring the data

            $row = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such id show the form

            if($count > 0) { ?>

            <h1 class="text-center"> Edit Comment </h1>

            <div class="container">
                <form class="form-horizontal" action="?do=update" method="POST">

                <input type = "hidden" name="comid"  value="<?php echo $comid; ?>" />

                    <!-- Start Comment filed -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Comment</label>
                        <div class="col-sm-10 col-md-4">
                            <textarea class="form-control" name="comment"><?php echo $row['comment']; ?></textarea>
                            
                        </div>  
                    </div>
                    <!-- End Comment filed -->


                    <!-- Start Save Button filed -->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="Submit" value="<?php echo lang('Save')?>"  class="btn btn-primary btn-md" />
                        </div>  
                    </div>
                    <!-- End Save Button filed -->

                </form>
            </div>

            <?php 

            // else show error message

            } else { 
                    echo '<div class="container">';

                    $theMsg =  '<div class="alert alert-danger">there is no such ID </div>';

                    redirectHome($theMsg);

                    echo '</ div>';

                    }


            } elseif($do == 'update') { // Update page
            echo "<h1 class='text-center'>Update Comment </h1>";
            echo "<div class='container'>";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Get the variables from the form

                $comid     = $_POST['comid'];
                $comment   = $_POST['comment'];

                //Update the database with this info

                $stmt = $con->prepare("UPDATE comments SET comment=? WHERE c_id = ?");
                $stmt->execute(array($comment, $comid,));

                //echo succes message

                $theMsg =  "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Updated </div>";

                redirectHome($theMsg, 'back');

            }else{

                $theMsg =  "<div class = 'alert alert-danger'>sorry you cant Browse this page directly</div>";

                redirectHome($theMsg);
            }
            echo '</div>';


        }elseif($do == 'Delete'){ // Delete Member Page
                        echo "<h1 class='text-center'>  Delete Comment </h1>";
                        echo "<div class='container'>";

                        // check if get request comid is numeric & get the integer value of it

                        $comid = isset($_GET['comid']) && is_numeric($_GET['comid'] ) ?intval ($_GET['comid']): 0 ;

                        // check if there is an id as sent or not 

                        $check = checkItem('c_id','comments', $comid);
            
                        // if there is such id show the form
            
                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM comments WHERE c_id = :zid");
                        $stmt->bindParam(":zid" , $comid);
                        $stmt->execute();

                        $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Deleted </div>";

                        redirectHome($theMsg, 'back');
                    }else{
                        $theMsg = "<div class='alert alert-danger'>This ID is NOT Exist</div>"; 
                        redirectHome($theMsg);
                    }

                    echo '</div>';
        } elseif($do == 'Approve'){

            echo "<h1 class='text-center'>  Approve Comments </h1>";
            echo "<div class='container'>";

            // check if get request comid is numeric & get the integer value of it

            $comid = isset($_GET['comid']) && is_numeric($_GET['comid'] ) ?intval ($_GET['comid']): 0 ;

            // check if there is an id as sent or not 

            $check = checkItem('c_id','comments', $comid);

            // if there is such id show the form

        if($check > 0) { 
            $stmt = $con->prepare("UPDATE comments SET status = 1 WHERE c_id = ?");

            $stmt->execute(array($comid));

            $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Approved </div>";

            redirectHome($theMsg,'back');
        }else{
            $theMsg = "<div class='alert alert-danger'>This ID is NOT Exist</div>"; 
            redirectHome($theMsg);
        }

        echo '</div>';

        


        }

        include $tpl."footer.php";
    }else{
        header('location:index.php');
        exit();
    }