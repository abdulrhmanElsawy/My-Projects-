<?php


    // Items page


    ob_start();

    session_start();

    $pageTitle = 'Ads';

    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET ['do']:'manage';

        if($do == 'manage'){
            // manage Items page 

            
        
        $stmt = $con->prepare("SELECT 
                                * 
                                FROM ads 
        ORDER BY adid ASC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $ads = $stmt->fetchAll();
        
            if (! empty($ads)){
        
        ?>

            <h1 class="text-center"> Manage Ads</h1>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                            <td>#ID</td>
                            <td>Ad Title</td>
                            <td>Ad Photo</td>
                            <td>Ad description</td>
                            <td>Ad Website</td>
                        </tr>
                        <?php

                        foreach($ads as $ad){
                            echo "<tr>";
                                echo "<td>". $ad['adid'] . "</td>";
                                echo "<td>". $ad['adtitle'] . "</td>";
                                echo "<td>". $ad['adphoto'] . "</td>";
                                echo "<td>". $ad['addescription'] . "</td>";
                                echo "<td>". $ad['adwebsite'] . "</td>";
                                echo "<td> 
                                <a href='editad.php?do=Edit&adid=" . $ad['adid'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>";
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
                echo "<div class='nice-message'>There Is No ad To Show</div>";
            echo '</div>';
        }

        }elseif($do == 'Edit'){
            // edit page 

            // check if get request post is numeric & get the integer value of it

            $adid = isset($_GET['adid']) && is_numeric($_GET['adid'] ) ?intval ($_GET['adid']): 0 ;
            // select all data depend on this id 
            $stmt = $con->prepare("SELECT * FROM ads WHERE adid = ? ");

            // excure query
            $stmt->execute(array($adid));

            // bring the data

            $ad = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such id show the form

            if($count > 0) { ?>

                <h1 class="text-center"> Edit Ads </h1>

                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="adid" value="<?php echo $adid ?>" />
                        <!-- Start Ad Title filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Ad Title</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="text" 
                                    name        ="adtitle" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    placeholder ="Ad Title"
                                    value="<?php echo $ad['adtitle'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End Ad Title filed -->

                        <!-- Start Ad Photo filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Ad photo</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="file" 
                                    name        ="adphoto" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    placeholder ="Ad photo"
                                    value="<?php echo $ad['adphoto'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End Ad Photo filed -->

                        <!-- Start Ad Description filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Ad Description</label>
                            <div class="col-sm-10 col-md-4">
                                <textarea
                                    type        ="text" 
                                    name        ="addescription" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    style       ="height:300px;"
                                    placeholder ="Ad Descripotion">

                                    <?php echo $ad['addescription'];?>

                                </textarea> 
                                
                            </div>  
                        </div>
                        <!-- End Ad Description filed -->

                        <!-- Start Ad Website filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Ad Website</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="text" 
                                    name        ="adwebsite" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    placeholder ="Ad Website"
                                    value="<?php echo $ad['adwebsite'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End Ad Website filed -->

                        <!-- Start Submit filed -->
                        <div class="form-group form-group-lg">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="Submit" value="Save ad"  class="btn btn-primary btn-sm" />
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
            echo "<h1 class='text-center'>Update Ad </h1>";
            echo "<div class='container'>";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Get the variables from the form
                $adid           = $_POST['adid'];
                $adtitle        = $_POST['adtitle'];
                $addescription  = $_POST['addescription'];
                $adwebsite      = $_POST['adwebsite'];
                
                    // $avatar     = $_FILES['avatar'];
                    $avatarName = $_FILES['adphoto']['name'];
                    $avatarSize = $_FILES['adphoto']['size'];
                    $avatarTmp  = $_FILES['adphoto']['tmp_name'];
                    $avatarType = $_FILES['adphoto']['type'];
    
                    // List of allowed files to be uploaded
                    $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
    
                    // Get avatar Extension
                    $varrr= explode('.', $avatarName);
                    $avatarExtension = strtolower(end($varrr));




                            // validate the FORM

                            $formERRORS = array();

                            if(empty($adtitle)){
                                $formERRORS[] = '<div class="alert alert-danger">Title Cant be <strong>Empty</strong> </div>';
            
                            }
                            if(empty($adwebsite)){
                                $formERRORS[] = '<div class="alert alert-danger">Website Cant be <strong>Empty</strong> </div>';
            
                            }
                            if(empty($addescription)){
                                $formERRORS[] = '<div class="alert alert-danger">description Text Cant be <strong>Empty</strong> </div>';
            
                            }

                            if(empty($avatarName)){
                                $formERRORS[] = '<div class="alert alert-danger">This ad photo can not be empty</div>';
                            }

                            if(! empty($avatarName) && ! in_Array($avatarExtension, $avatarAllowedExtension)){
                                $formERRORS[] = '<div class="alert alert-danger">This Extension is not <strong>Allowed</strong></div>';
                            }
                            if($avatarSize > 5194304){
                                $formERRORS[] = '<div class="alert alert-danger">Profile photo can not be larger than <strong> 5MB </strong></div>';
                            }

            
                            // loop into errors Array And Echo It
            
                            foreach($formERRORS as $error){
                                echo $error;
                            }

                // check if there is no error Update the database

                if(empty($formERRORS)){

                    if (!empty($avatarName)) {
                        $avatar = rand(0, 100000) . '_' . $avatarName;
                        move_uploaded_file($avatarTmp, "uploads\posts\\" . $avatar);
                    }



                //Update the database with this info

                $stmt = $con->prepare("UPDATE 
                                            ads 
                                        SET
                                            adtitle           =?,
                                            adphoto           =?,
                                            addescription     =?,
                                            adwebsite         =?
                                            

                                        WHERE 
                                            adid = ?");
                $stmt->execute(array($adtitle, $avatar, $addescription, $adwebsite, $adid));


                //echo succes message

                $theMsg =  "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Updated </div>";

                redirectHome($theMsg, 'back');

                }


            }else{

                $theMsg =  "<div class = 'alert alert-danger'>sorry you cant Browse this page directly</div>";

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

