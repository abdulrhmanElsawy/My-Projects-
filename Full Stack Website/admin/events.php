<?php


    // Items page


    ob_start();

    session_start();

    $pageTitle = 'Items';

    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET ['do']:'manage';

        if($do == 'manage'){
            // manage Items page 

            
        
        $stmt = $con->prepare("SELECT 
                                * 
                                FROM events 
        ORDER BY Event_ID ASC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $items = $stmt->fetchAll();
        
            if (! empty($items)){
        
        ?>

<h1 class="text-center"> Manage Events</h1>
<div class="container">
    <div class="table-responsive">
        <table class="main-table text-center table table-bordered">
            <tr>
                <td>#ID</td>
                <td>Name</td>
                <td>Organizer</td>
                <td>Youtube_Vid</td>
                <td>Event Photo</td>
                <td>Adding Date</td>
                <td>Description</td>
                <td>Settings</td>
            </tr>
            <?php

                        foreach($items as $item){
                            echo "<tr>";
                                echo "<td>". $item['Event_ID'] . "</td>";
                                echo "<td>". $item['Name'] . "</td>";
                                echo "<td>". $item['Description'] . "</td>";
                                echo "<td>". $item['Youtube_Vid'] . "</td>";
                                echo "<td>". $item['avatar'] . "</td>";
                                echo "<td>". $item['Add_Date'] . "</td>";
                                echo "<td>". $item['Description'] . "</td>";
                                
                                echo "<td> 
                                <a href='events.php?do=Edit&itemid=" . $item['Event_ID'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                                <a href='events.php?do=Delete&itemid=" . $item['Event_ID'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                                if($item['Status'] == 0){

                                    echo "
                                    <a href='events.php?do=Approve&itemid=" . $item['Event_ID'] . "'
                                    class='btn btn-info activate '><i class='fa fa-check'></i> Approve </a>";
                                }

                                echo"</td>";
                                echo "</tr>";
                        }

                        ?>

            <tr>
        </table>
    </div>
    <a href="events.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New Event</a>

</div>

<?php }else {
            echo '<div class="container">';
                echo "<div class='nice-message'>There Is No Events To Show</div>";
                echo '<a href="events.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New Event</a>';
            echo '</div>';
        }

        }elseif($do == 'Add'){ ?>
<h1 class="text-center"> Add new Event </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
        <!-- Start Name filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="name" class="form-control" required='required'
                    placeholder="Name of the Event" />

            </div>
        </div>
        <!-- End Name filed -->

        <!-- Start Description filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="description" required='required' class="form-control"
                    placeholder="Description OF The Event" />

            </div>
        </div>
        <!-- End Description filed -->

        <!-- Start Organizers filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Organizer</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="organizer" required='required' class="form-control"
                    placeholder="Organizer Name" />

            </div>
        </div>
        <!-- End Organizers filed -->

        <!-- Start Youtube_Vid Link filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">YouTube Link</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="link" class="form-control" placeholder="Copy YouTube Video Link" />

            </div>
        </div>
        <!-- End YouTube_Vid link filed -->

        <!-- Start Event Photo Link filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Event Photo</label>
            <div class="col-sm-10 col-md-4">
                <input type="file" name="avatar" class="form-control" placeholder="Event Photo" />

            </div>
        </div>
        <!-- End Event Photo link filed -->




        <!-- Start Add category Button filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Add Item" class="btn btn-primary btn-sm" />
            </div>
        </div>
        <!-- End Add category Button filed -->

    </form>
</div>



<?php


        }elseif($do == 'Insert'){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                echo "<h1 class='text-center'>Insert Item </h1>";
                echo "<div class='container'>";
    
                    // Get the variables from the form
    
                    $name       = $_POST['name'];
                    $desc       = $_POST['description'];
                    $organizer  = $_POST['organizer'];
                    $link       = $_POST['link'];

                    // $avatar     = $_FILES['avatar'];
                    $avatarName = $_FILES['avatar']['name'];
                    $avatarSize = $_FILES['avatar']['size'];
                    $avatarTmp  = $_FILES['avatar']['tmp_name'];
                    $avatarType = $_FILES['avatar']['type'];
                    

                    // List of allowed files to be uploaded
                $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");

                // Get avatar Extension
                $tmptmp = explode('.', $avatarName);
                $avatarExtension = strtolower(end($tmptmp));
    
                    // validate the FORM

                    $formERRORS = array();
    
                    if(empty($name)){
                        $formERRORS[] = '<div class="alert alert-danger">Name Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($desc)){
                        $formERRORS[] = '<div class="alert alert-danger">Description Cant be <strong>Empty</strong>  </div>';
    
                    }
    
                    if(empty($organizer)){
                        $formERRORS[] = '<div class="alert alert-danger">organizer Name Cant be <strong>Empty</strong> </div>';
                    }


                    if( empty($avatarName)){
                        $formERRORS[] = '<div class="alert alert-danger">Photo Can Not Be  <strong>Empty</strong></div>';
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
                        //Insert User Info in data base

                        $avatar = rand(0,100000) . '_' . $avatarName;
                        move_uploaded_file($avatarTmp, "uploads\avatars\\" . $avatar);
    
                        $stmt = $con->prepare("INSERT
                                                    INTO events
                                                    (Name, 
                                                    Description, 
                                                    Organizer, 
                                                    Youtube_Vid,  
                                                    avatar,
                                                    Add_Date
                                                    )
                                    VALUES (:zname, :zdesc, :zorganizer, :zlink, :zavatar,  now())");
                            $stmt->execute(array(
                                'zname'      =>$name,
                                'zdesc'      =>$desc,
                                'zorganizer' =>$organizer,
                                'zlink'      =>$link,
                                'zavatar'    =>$avatar


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

            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'] ) ?intval ($_GET['itemid']): 0 ;
            // select all data depend on this id 
            $stmt = $con->prepare("SELECT * FROM events WHERE Event_ID = ? ");

            // excure query
            $stmt->execute(array($itemid));

            // bring the data

            $item = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such id show the form

            if($count > 0) { ?>

<h1 class="text-center"> Edit event </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="itemid" value="<?php echo $itemid ?>" />
        <!-- Start Name filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="name" class="form-control" required='required' placeholder="Name of the Item"
                    value="<?php echo $item['Name'];?>" />

            </div>
        </div>
        <!-- End Name filed -->

        <!-- Start Description filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="description" required='required' class="form-control"
                    placeholder="Description OF The Item" value="<?php echo $item['Description'];?>" />

            </div>
        </div>
        <!-- End Description filed -->

        <!-- Start price filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">organizer</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="organizer" required='required' class="form-control"
                    placeholder="organizer Name" value="<?php echo $item['Organizer'];?>" />

            </div>
        </div>
        <!-- End price filed -->

        <!-- Start  Youtube Link filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">YouTube Link</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="link" class="form-control" placeholder="Copy Event Youtube Link"
                    value="<?php echo $item['Youtube_Vid'];?>" />

            </div>
        </div>
        <!-- End Youtube Link filed -->

        <!-- Start   Event Photo filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"> Event Photo</label>
            <div class="col-sm-10 col-md-4">
                <input type="file" name="avatar" required='required' class="form-control" placeholder="Event Photo" />

            </div>
        </div>
        <!-- End  Event Photo filed -->

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

                $id         = $_POST['itemid'];
                $name       = $_POST['name'];
                $organizer  = $_POST['organizer'];
                $link       = $_POST['link'];
                $desc       = $_POST['description'];

                // $avatar     = $_FILES['avatar'];
                $avatarName = $_FILES['avatar']['name'];
                $avatarSize = $_FILES['avatar']['size'];
                $avatarTmp  = $_FILES['avatar']['tmp_name'];
                $avatarType = $_FILES['avatar']['type'];


                // List of allowed files to be uploaded
                $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");

                // Get avatar Extension
                $tmptmp = explode('.', $avatarName);
                $avatarExtension = strtolower(end($tmptmp));



                            // validate the FORM

                            $formERRORS = array();

                            if(empty($name)){
                                $formERRORS[] = '<div class="alert alert-danger">Name Cant be <strong>Empty</strong> </div>';
            
                            }
                            if(empty($desc)){
                                $formERRORS[] = '<div class="alert alert-danger">Description Cant be <strong>Empty</strong>  </div>';
            
                            }
            
                            if(empty($organizer)){
                                $formERRORS[] = '<div class="alert alert-danger">Price Cant be <strong>Empty</strong> </div>';
                            }

                            if( empty($avatarName)){
                                $formERRORS[] = '<div class="alert alert-danger">Photo Can Not Be  <strong>Empty</strong></div>';
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

                    $avatar = rand(0,100000) . '_' . $avatarName;
                    move_uploaded_file($avatarTmp, "uploads\avatars\\" . $avatar);


                //Update the database with this info

                $stmt = $con->prepare("UPDATE 
                                            events 
                                        SET
                                            Name            =?, 
                                            Description     =?, 
                                            Organizer       =?, 
                                            Youtube_Vid     =?,
                                            avatar          =?


                                        WHERE 
                                            Event_ID = ?");
                $stmt->execute(array($name, $desc, $organizer, $link,$avatar, $id));

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
                        echo "<h1 class='text-center'>  Delete Event </h1>";
                        echo "<div class='container'>";

                        // check if get request ItemID is numeric & get the integer value of it

                        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'] ) ?intval ($_GET['itemid']): 0 ;

                        // check if there is an id as sent or not 

                        $check = checkItem('Event_ID','events', $itemid);

                        // if there is such id show the form

                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM events WHERE Event_ID = :zid");
                        $stmt->bindParam(":zid" , $itemid);
                        $stmt->execute();

                        $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Deleted </div>";

                        redirectHome($theMsg, 'back');
                    }else{
                        $theMsg = "<div class='alert alert-danger'>This ID is NOT Exist</div>"; 
                        redirectHome($theMsg);
                    }

                    echo '</div>';

        }elseif($do == 'Approve'){
            echo "<h1 class='text-center'>  Approve Item </h1>";
            echo "<div class='container'>";

            // check if get request ItemID is numeric & get the integer value of it

            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'] ) ?intval ($_GET['itemid']): 0 ;

            // check if there is an id as sent or not 

            $check = checkItem('Event_ID','events', $itemid);

            // if there is such id show the form

        if($check > 0) { 
            $stmt = $con->prepare("UPDATE events SET Status=1 Where Event_ID = ?");

            $stmt->execute(array($itemid));

            $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Activated </div>";

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