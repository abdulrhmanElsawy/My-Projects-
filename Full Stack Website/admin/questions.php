<?php


    // Items page


    ob_start();

    session_start();

    $pageTitle = 'Questions';

    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET ['do']:'manage';

        if($do == 'manage'){
            // manage Items page 

            
        
        $stmt = $con->prepare("SELECT 
                                * 
                                FROM questions 
        ORDER BY id ASC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $questions = $stmt->fetchAll();
        
            if (! empty($questions)){
        
        ?>

<h1 class="text-center"> Manage questions</h1>
<div class="container">
    <div class="table-responsive">
        <table class="main-table text-center table table-bordered">
            <tr>
                <td>#ID</td>
                <td>question</td>
                <td>answer</td>
            </tr>
            <?php

                        foreach($questions as $question){
                            echo "<tr>";
                                echo "<td>". $question['id'] . "</td>";
                                echo "<td>". $question['question'] . "</td>";
                                echo "<td>". $question['answer'] . "</td>";
                                
                                echo "<td> 
                                <a href='questions.php?do=Edit&id=" . $question['id'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                                <a href='questions.php?do=Delete&id=" . $question['id'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";

                                echo"</td>";
                                echo "</tr>";
                        }

                        ?>

            <tr>
        </table>
    </div>
    <a href="questions.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New question</a>

</div>

<?php }else {
            echo '<div class="container">';
                echo "<div class='nice-message'>There Is No questions To Show</div>";
                echo '<a href="questions.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New question</a>';
            echo '</div>';
        }

        }elseif($do == 'Add'){ ?>
<h1 class="text-center"> Add new question </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Insert" method="POST">

        <!-- Start question filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">question</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="question" class="form-control" required='required' placeholder="question ?" />

            </div>
        </div>
        <!-- End question filed -->

        <!-- Start answer filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">answer</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="answer" required='required' class="form-control" placeholder="answer" />

            </div>
        </div>
        <!-- End answer filed -->



        <!-- Start Add question Button filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Add question" class="btn btn-primary btn-sm" />
            </div>
        </div>
        <!-- End Add question Button filed -->

    </form>
</div>



<?php


        }elseif($do == 'Insert'){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                echo "<h1 class='text-center'>Insert question </h1>";
                echo "<div class='container'>";
    
                    // Get the variables from the form
    
                    $question       = $_POST['question'];
                    $answer       = $_POST['answer'];           
                    
                    // validate the FORM

                    $formERRORS = array();
    
                    if(empty($question)){
                        $formERRORS[] = '<div class="alert alert-danger">question Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($answer)){
                        $formERRORS[] = '<div class="alert alert-danger">Answer Cant be <strong>Empty</strong>  </div>';
    
                    }
                    // loop into errors Array And Echo It
                    foreach($formERRORS as $error){
                        echo $error;
                    }
    
                    // check if there is no error Update the database
    
                    if(empty($formERRORS)){
                        //Insert question Info in data base

    
                        $stmt = $con->prepare("INSERT
                                                    INTO questions
                                                    (question, 
                                                    answer 
                                                    )
                                    VALUES (:zquestion, :zanswer)");
                            $stmt->execute(array(
                                'zquestion'      =>$question,
                                'zanswer'      =>$answer
                            ));
    
                        //echo succes message
    
                        $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Iserted </div>";
    
                        redirectHome($theMsg , 'back');
                        
                    }
    
    
                }else{
    
                    echo '<div class="container">';
    
                    $theMsg =  "<div class ='alert alert-danger'>sorry you cant Browse this page directly</div>";
                    // function wriiten in functions file to redirect my page to the home page if the page got directly from any user
    
                    redirectHome($theMsg, 'back');
    
                    echo '</div>';
                }
                echo '</div>';

        }elseif($do == 'Edit'){
            // edit page 

            // check if get request item is numeric & get the integer value of it

            $id = isset($_GET['id']) && is_numeric($_GET['id'] ) ?intval ($_GET['id']): 0 ;
            // select all data depend on this id 
            $stmt = $con->prepare("SELECT * FROM questions WHERE id = ? ");

            // excure query
            $stmt->execute(array($id));

            // bring the data

            $question = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such id show the form

            if($count > 0) { ?>

<h1 class="text-center"> Edit question </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Update" method="POST">

        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <!-- Start question filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">question</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="question" class="form-control" required='required' placeholder="question "
                    value="<?php echo $question['question'];?>" />

            </div>
        </div>
        <!-- End question filed -->

        <!-- Start answer filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">answer</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="answer" required='required' class="form-control"
                    placeholder="Description OF The Item" value="<?php echo $question['answer'];?>" />

            </div>
        </div>
        <!-- End answer filed -->

        <!-- Start Submit filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Save question" class="btn btn-primary btn-sm" />
            </div>
        </div>
        <!-- End Submit filed -->

    </form>


    <?php 

            // else show error message

            } else { 
                    echo '<div class="container">';

                    $theMsg =  '<div class="alert alert-danger">there is no such ID </div>';

                    redirectHome($theMsg);

                    echo '</ div>';

                    }

        }elseif($do == 'Update'){
            // Update page
            echo "<h1 class='text-center'>Update question </h1>";
            echo "<div class='container'>";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Get the variables from the form

                $id         = $_POST['id'];
                $question   = $_POST['question'];
                $answer     = $_POST['answer'];
            


                            // validate the FORM

                            $formERRORS = array();

                            if(empty($question)){
                                $formERRORS[] = '<div class="alert alert-danger">question Cant be <strong>Empty</strong> </div>';
            
                            }
                            if(empty($answer)){
                                $formERRORS[] = '<div class="alert alert-danger">answer Cant be <strong>Empty</strong>  </div>';
            
                            }
            
                
            
            
                            // loop into errors Array And Echo It
            
                            foreach($formERRORS as $error){
                                echo $error;
                            }

                // check if there is no error Update the database

                if(empty($formERRORS)){

                //Update the database with this info

                $stmt = $con->prepare("UPDATE 
                                            questions 
                                        SET
                                            question   =?, 
                                            answer     =?
                                            


                                        WHERE 
                                            id = ?");
                $stmt->execute(array($question, $answer, $id));

                //echo succes message

                $theMsg =  "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Updated </div>";

                redirectHome($theMsg, 'back');

                }


            }else{

                $theMsg =  "<div class = 'alert alert-danger'>sorry you cant Browse this page directly</div>";

                redirectHome($theMsg);
            }
            echo '</div>';

        }elseif($do == 'Delete'){
                        // Delete question Page
                        echo "<h1 class='text-center'>  Delete question </h1>";
                        echo "<div class='container'>";

                        // check if get request ItemID is numeric & get the integer value of it

                        $id = isset($_GET['id']) && is_numeric($_GET['id'] ) ?intval ($_GET['id']): 0 ;

                        // check if there is an id as sent or not 

                        $check = checkItem('id','questions', $id);

                        // if there is such id show the form

                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM questions WHERE id = :zid");
                        $stmt->bindParam(":zid" , $id);
                        $stmt->execute();

                        $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Deleted </div>";

                        redirectHome($theMsg, 'back');
                    }else{
                        $theMsg = "<div class='alert alert-danger'>This ID is NOT Exist</div>"; 
                        redirectHome($theMsg);
                    }

                    echo '</div>';

        }
        include $tpl . 'footer.php';
    }else{
        header('Location: index.php');
        exit();
    }

    ob_end_flush();

?>