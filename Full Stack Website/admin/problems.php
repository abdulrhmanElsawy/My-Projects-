<?php


    // problems page


    ob_start();

    session_start();

    $pageTitle = 'problems';

    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET ['do']:'manage';

        if($do == 'manage'){
            // manage Items page 

            
        
        $stmt = $con->prepare("SELECT 
                                * 
                                FROM problems 
        ORDER BY id ASC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $problems = $stmt->fetchAll();
        
            if (! empty($problems)){
        
        ?>

<h1 class="text-center"> Manage problems</h1>
<div class="container">
    <div class="table-responsive">
        <table class="main-table text-center table table-bordered">
            <tr>
                <td>#ID</td>
                <td>Description</td>
                <td>Input description</td>
                <td>Output description</td>
                <td>input Example</td>
                <td>OutPut Example</td>
                <td>difficulty</td>
                <td>solutions</td>
                <td>Settings</td>
            </tr>
            <?php

                        foreach($problems as $problem){
                            echo "<tr>";
                                echo "<td>". $problem['id'] . "</td>";
                                echo "<td>". $problem['description'] . "</td>";
                                echo "<td>". $problem['inputdescription'] . "</td>";
                                echo "<td>". $problem['outputdescription'] . "</td>";
                                echo "<td>". $problem['inputexample'] . "</td>";
                                echo "<td>". $problem['outputexample'] . "</td>";
                                echo "<td>". $problem['difficulty'] . "</td>";
                                echo "<td>". $problem['solutions'] . "</td>";
                                
                                echo "<td> 
                                <a href='problems.php?do=Edit&id=" . $problem['id'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                                <a href='problems.php?do=Delete&id=" . $problem['id'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";

                                echo"</td>";
                                echo "</tr>";
                        }

                        ?>

            <tr>
        </table>
    </div>
    <a href="problems.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New problem</a>

</div>

<?php }else {
            echo '<div class="container">';
                echo "<div class='nice-message'>There Is No problems To Show</div>";
                echo '<a href="problems.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New problem</a>';
            echo '</div>';
        }

        }elseif($do == 'Add'){ ?>
<h1 class="text-center"> Add new problem </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Insert" method="POST">
        <!-- Start Description filed -->

        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="description" class="form-control" required='required'></textarea>

            </div>
        </div>

        <!-- End description filed -->

        <!-- Start inputdescription filed -->

        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Input Description</label>

            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="inputdescription" required='required' class="form-control"></textarea>

            </div>
        </div>

        <!-- End inputdescription filed -->


        <!-- Start outputdescription filed -->

        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Output Description</label>

            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="outputdescription" required='required' class="form-control"></textarea>

            </div>
        </div>

        <!-- End outputdescription filed -->



        <!-- Start inputexample  filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Input example</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="inputexample" class="form-control"></textarea>

            </div>
        </div>
        <!-- End inputexample  filed -->

        <!-- Start outputexample  filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Output example</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="outputexample" class="form-control"></textarea>

            </div>
        </div>
        <!-- End outputexample  filed -->

        <!-- Start difficulty  filed -->

        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Difficulty</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="difficulty" class="form-control" placeholder="800 ~" />

            </div>
        </div>

        <!-- End difficulty  filed -->


        !-- Start Solutions filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Solutions</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="solutions" class="form-control"></textarea>

            </div>
        </div>
        <!-- End Solutions  filed -->




        <!-- Start Add problem Button filed -->

        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Add problem" class="btn btn-primary btn-sm" />
            </div>
        </div>

        <!-- End Add problem Button filed -->

    </form>
</div>



<?php


        }elseif($do == 'Insert'){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                echo "<h1 class='text-center'>Insert problem </h1>";
                echo "<div class='container'>";
    
                    // Get the variables from the form
    
                    $description            = $_POST['description'];
                    $inputdescription       = $_POST['inputdescription'];
                    $outputdescription      = $_POST['outputdescription'];
                    $inputexample           = $_POST['inputexample'];
                    $outputexample          = $_POST['outputexample'];
                    $difficulty             = $_POST['difficulty'];
                    $solutions              = $_POST['solutions'];


                    // validate the FORM

                    $formERRORS = array();
    
                    if(empty($description)){
                        $formERRORS[] = '<div class="alert alert-danger">description Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($inputdescription)){
                        $formERRORS[] = '<div class="alert alert-danger">input description Cant be <strong>Empty</strong>  </div>';
    
                    }
    
                    if(empty($outputdescription)){
                        $formERRORS[] = '<div class="alert alert-danger">output description  Cant be <strong>Empty</strong> </div>';
                    }


                    if( empty($inputexample)){
                        $formERRORS[] = '<div class="alert alert-danger">input example Can Not Be  <strong>Empty</strong></div>';
                    }
        
                    if( empty($outputexample)){
                        $formERRORS[] = '<div class="alert alert-danger">Output example Can Not Be  <strong>Empty</strong></div>';
                    }
                    if( empty($difficulty)){
                        $formERRORS[] = '<div class="alert alert-danger">difficulty example Can Not Be  <strong>Empty</strong></div>';
                    }
        

                    // loop into errors Array And Echo It
                    foreach($formERRORS as $error){
                        echo $error;
                    }
    
                    // check if there is no error Update the database
    
                    if(empty($formERRORS)){
                        //Insert problem Info in data base

                        
    
                        $stmt = $con->prepare("INSERT
                                                    INTO problems
                                                    (description, 
                                                    inputdescription, 
                                                    outputdescription, 
                                                    inputexample,  
                                                    outputexample,
                                                    difficulty,
                                                    solutions
                                                    )
                                    VALUES (:zdescription, :zinputdescription, :zoutputdescription, :zinputexample, :zoutputexample, :zdifficulty, :zsolutions)");
                            $stmt->execute(array(
                                'zdescription'          =>$description,
                                'zinputdescription'     =>$inputdescription,
                                'zoutputdescription'    =>$outputdescription,
                                'zinputexample'         =>$inputexample,
                                'zoutputexample'        =>$outputexample,
                                'zdifficulty'           =>$difficulty,
                                'zsolutions'            =>$solutions

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

            $stmt = $con->prepare("SELECT * FROM problems WHERE id = ? ");

            // excure query
            $stmt->execute(array($id));

            // bring the data

            $problem = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such id show the form

            if($count > 0) { ?>

<h1 class="text-center"> Edit problem </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Update" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>" />

        <!-- Start Description filed -->

        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="description" class="form-control" required='required'>
                <?php echo $problem['description'];?>
                </textarea>

            </div>
        </div>

        <!-- End description filed -->

        <!-- Start inputdescription filed -->

        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Input Description</label>

            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="inputdescription" required='required' class="form-control">
                <?php echo $problem['inputdescription'];?>
                </textarea>

            </div>
        </div>

        <!-- End inputdescription filed -->


        <!-- Start outputdescription filed -->

        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Output Description</label>

            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="outputdescription" required='required' class="form-control">
                <?php echo $problem['outputdescription'];?>
                </textarea>

            </div>
        </div>

        <!-- End outputdescription filed -->



        <!-- Start inputexample  filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Input example</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="inputexample" class="form-control">
                <?php echo $problem['inputexample'];?>
                </textarea>

            </div>
        </div>
        <!-- End inputexample  filed -->

        <!-- Start outputexample  filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Output example</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="outputexample" class="form-control">
                <?php echo $problem['outputexample'];?>
                </textarea>

            </div>
        </div>
        <!-- End outputexample  filed -->

        <!-- Start difficulty  filed -->

        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Difficulty</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" value="<?php echo $problem['difficulty'];?>" name="difficulty" class="form-control"
                    placeholder="800 ~" />

            </div>
        </div>

        <!-- End difficulty  filed -->

        <!-- Start solutions  filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Solutions</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="solutions" class="form-control">
                <?php echo $problem['solutions'];?>
                </textarea>

            </div>
        </div>
        <!-- End solutions  filed -->


        <!-- Start Submit filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Save Item" class="btn btn-primary btn-sm" />
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
            echo "<h1 class='text-center'>Update Event </h1>";
            echo "<div class='container'>";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Get the variables from the form
                    $id                     = $_POST['id'];
                    $description            = $_POST['description'];
                    $inputdescription       = $_POST['inputdescription'];
                    $outputdescription      = $_POST['outputdescription'];
                    $inputexample           = $_POST['inputexample'];
                    $outputexample          = $_POST['outputexample'];
                    $difficulty             = $_POST['difficulty'];
                    $solutions             = $_POST['solutions'];


                    // validate the FORM

                    $formERRORS = array();
    
                    if(empty($description)){
                        $formERRORS[] = '<div class="alert alert-danger">description Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($inputdescription)){
                        $formERRORS[] = '<div class="alert alert-danger">input description Cant be <strong>Empty</strong>  </div>';
    
                    }
    
                    if(empty($outputdescription)){
                        $formERRORS[] = '<div class="alert alert-danger">output description  Cant be <strong>Empty</strong> </div>';
                    }


                    if( empty($inputexample)){
                        $formERRORS[] = '<div class="alert alert-danger">input example Can Not Be  <strong>Empty</strong></div>';
                    }
        
                    if(empty($outputexample)){
                        $formERRORS[] = '<div class="alert alert-danger">Output example Can Not Be  <strong>Empty</strong></div>';
                    }
                    if(empty($difficulty)){
                        $formERRORS[] = '<div class="alert alert-danger">difficulty example Can Not Be  <strong>Empty</strong></div>';
                    }
                
            
            
                            // loop into errors Array And Echo It
            
                            foreach($formERRORS as $error){
                                echo $error;
                            }

                // check if there is no error Update the database

                if(empty($formERRORS)){

                //Update the database with this info

                $stmt = $con->prepare("UPDATE 
                                            problems 
                                        SET
                                            description             =?, 
                                            inputdescription        =?, 
                                            outputdescription       =?, 
                                            inputexample            =?,
                                            outputexample           =?,
                                            difficulty              =?,
                                            solutions               =?

                                        WHERE 
                                            id = ?");
                $stmt->execute(array($description, $inputdescription, $outputdescription, $inputexample,$outputexample,$difficulty,$solutions, $id));

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
                        // Delete Item Page
                        echo "<h1 class='text-center'>  Delete problem </h1>";
                        echo "<div class='container'>";

                        // check if get request ItemID is numeric & get the integer value of it

                        $id = isset($_GET['id']) && is_numeric($_GET['id'] ) ?intval ($_GET['id']): 0 ;

                        // check if there is an id as sent or not 

                        $check = checkItem('id','problems', $id);

                        // if there is such id show the form

                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM problems WHERE id = :zid");
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