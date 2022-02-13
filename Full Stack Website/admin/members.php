<?php

    // Manage members page 
    // you can add | Edit | Delete Members From Here

    session_start();

    $pageTitle = 'members';

    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET['do']:'manage';

        // Start Manage Page

        if($do == 'manage'){ // manage Members page 

            $query = '';

            if(isset($_GET['page']) && $_GET['page'] == 'Pending'){

                $query ='AND RegStatus = 0';
            }

            
            // select all user except admin
        
        $stmt = $con->prepare("SELECT * FROM users WHERE GroupID !=1 $query ORDER BY UserID DESC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $rows = $stmt->fetchAll();

        if(! empty ($rows)){
        
        
        ?>

<h1 class="text-center"> Manage Members</h1>
<div class="container">
    <div class="table-responsive">
        <table class="main-table manage-members text-center table table-bordered">
            <tr>
                <td>#ID</td>
                <td>Avatar</td>
                <td>UserName</td>
                <td>Email</td>
                <td>Full Name</td>
                <td>Registerd Date</td>
                <td>Control</td>
            </tr>
            <?php

                        foreach($rows as $row){
                            
                            echo "<tr>";
                                echo "<td>". $row['UserID'] . "</td>";
                                echo "<td>"; 
                                if(empty($row['avatar'])){
                                    echo "No Photo";
                                }else{
                                    echo "<img src='uploads/avatars/". $row['avatar'] . "' alt = '' />";
                                }
                                
                                echo "</td>";
                                echo "<td>". $row['UserName'] . "</td>";
                                echo "<td>". $row['Email'] . "</td>";
                                echo "<td>". $row['FullName'] . "</td>";
                                echo "<td>". $row['Date'] . "</td>";
                                echo "<td> 
                                <a href='Members.php?do=edit&userid=" . $row['UserID'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                                <a href='Members.php?do=Delete&userid=" . $row['UserID'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                                if($row['RegStatus'] == 0){

                                    echo "<a href='members.php?do=Activate&userid=" . $row['UserID'] . "'class='btn btn-info activate '><i class='fa fa-check'></i> Activate </a>";
                                }

                                echo"</td>";
                                echo "</tr>";
                        }

                        ?>

            <tr>
        </table>
    </div>
    <a href="members.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i> New member </a>

</div>


<?php }else{
                echo '<div class="container">';
                echo '<div class="nice-message"> There Is No Members To Show</div>';
                echo ' <a href="members.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i> New member </a>';
                echo '</div>';
            }?>






<?php } elseif ($do == 'add'){?>
<!--  Add members page -->

<h1 class="text-center"> <?php echo lang('Add_new_member')?> </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
        <!-- Start Username filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"><?php echo lang('UserName')?></label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="UserName" class="form-control" autocomplete="off" required='required'
                    placeholder="username to login to shop" />

            </div>
        </div>
        <!-- End Username filed -->

        <!-- Start password filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"><?php echo lang('password')?></label>
            <div class="col-sm-10 col-md-4">
                <input type="password" name="password" class="password form-control" autocomplete="new-password"
                    placeholder="password must be hard and complex" required="required" />
                <i class="show-pass fa fa-eye fa-2x"></i>
            </div>
        </div>
        <!-- End password filed -->

        <!-- Start fullName filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"><?php echo lang('FullName')?></label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="fullname" class="form-control" required='required' autocomplete="off"
                    placeholder=" Fullname appear in your login page" />


            </div>
        </div>
        <!-- End full name filed -->

        <!-- Start Profile Image filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Profile Photo</label>
            <div class="col-sm-10 col-md-4">
                <input type="file" name="avatar" class="form-control" required='required' autocomplete="off" />


            </div>
        </div>
        <!-- End Profile Image filed -->

        <!-- Start Email filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"><?php echo lang('Email')?></label>
            <div class="col-sm-10 col-md-4">
                <input type="email" name="email" required='required' class="form-control"
                    placeholder="Email Must be valid " />
            </div>
        </div>
        <!-- End Email filed -->

        <!-- Start Save Button filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="<?php echo lang('Add_member')?>" class="btn btn-primary btn-lg" />
            </div>
        </div>
        <!-- End Save Button filed -->

    </form>
</div>



<?php 

        }elseif ($do == 'Insert'){

            // Insert member page

            

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

            echo "<h1 class='text-center'>Add Member </h1>";
            echo "<div class='container'>";

                // Upload Variables 

                // $avatar     = $_FILES['avatar'];
                $avatarName = $_FILES['avatar']['name'];
                $avatarSize = $_FILES['avatar']['size'];
                $avatarTmp  = $_FILES['avatar']['tmp_name'];
                $avatarType = $_FILES['avatar']['type'];

                // List of allowed files to be uploaded
                $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");

                // Get avatar Extension
                $varrr= explode('.', $avatarName);
                $avatarExtension = strtolower(end($varrr));



                // Get the variables from the form

                $user = $_POST['UserName'];
                $pass = $_POST['password'];
                $name =$_POST['fullname'];
                $email = $_POST['email'];
                $hashPass = sha1($_POST['password']);

                // validate the FORM
                $formERRORS = array();

                if(strlen($user) < 4){
                    $formERRORS[] = '<div class="alert alert-danger">Username Cant be less than <strong> 4 characters </strong> </div>';

                }
                if(strlen($user) > 20){
                    $formERRORS[] = '<div class="alert alert-danger">Username Cant be more than <strong> 20 characters </strong> </div>';

                }

                if(empty($user)){
                    $formERRORS[] = '<div class="alert alert-danger">Username cant be EMpty</div>';
                }

                if(empty($name)){

                    $formERRORS[] = '<div class="alert alert-danger">FullName cant be EMpty</div>';
                }

                if(empty($pass)){

                    $formERRORS[] = '<div class="alert alert-danger">password cant be EMpty</div>';
                }

                if(empty($email)){

                    $formERRORS[] = '<div class="alert alert-danger">Email cant be EMpty</div>';
                }
                if(empty($avatarName)){
                    $formERRORS[] = '<div class="alert alert-danger">You <strong>Must</strong> Upload a Profile Photo</div>';
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

                // check if user exist in database or not 
                $check = checkItem("UserName","users", $user);

                if ($check ==1){

                    $theMsg = "<div class='alert alert-danger'> sorry this User is exist </div> ";
                    redirectHome($theMsg , 'back');
                }

                else{



                    //Insert User Info in data base

                    $stmt = $con->prepare("INSERT INTO users(UserName, Password ,email ,FullName, RegStatus, Date, avatar)
                                VALUES (:zuser, :zpass, :zmail, :zname, 1, now(), :zavatar)");
                        $stmt->execute(array(
                            'zuser'     =>$user,
                            'zpass'     =>$hashPass,
                            'zmail'     =>$email,
                            'zname'     =>$name,
                            'zavatar'   => $avatar 
                        ));

                    //echo succes message

                    $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Iserted </div>";

                    redirectHome($theMsg , 'back');
                    }
            }


            }else{

                echo '<div class="container">';

                $theMsg =  "<div class ='alert alert-danger'>sorry you cant Browse this page directly</div>";
                // function wriiten in functions file to redirect my page to the home page if the page got directly from any user

                redirectHome($theMsg);

                echo '</div>';
            }
            echo '</div>';

        
        
    
    }elseif ($do == 'edit') { // edit page 

            // check if get request userid is numeric & get the integer value of it

            $userid = isset($_GET['userid']) && is_numeric($_GET['userid'] ) ?intval ($_GET['userid']): 0 ;
            // select all data depend on this id 
            $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?  LIMIT 1");

            // excure query
            $stmt->execute(array($userid));

            // bring the data

            $row = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such id show the form

            if($count > 0) { ?>

<h1 class="text-center"> <?php echo lang('EditMember')?> </h1>

<div class="container">
    <form class="form-horizontal" action="?do=update" method="POST">

        <input type="hidden" name="userid" value="<?php echo $userid; ?>" />

        <!-- Start Username filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"><?php echo lang('UserName')?></label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="UserName" class="form-control" value="<?php echo $row ['UserName'] ?>"
                    autocomplete="off" required='required' />

            </div>
        </div>
        <!-- End Username filed -->

        <!-- Start password filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"><?php echo lang('password')?></label>
            <div class="col-sm-10 col-md-4">
                <input type="hidden" name="oldpassword" value="<?php echo $row['Password']?>" />
                <input type="password" name="newpassword" class="form-control" autocomplete="new-password"
                    placeholder="Leave Blank if you don't want to change" />
            </div>
        </div>
        <!-- End password filed -->

        <!-- Start fullName filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"><?php echo lang('FullName')?></label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="fullname" value="<?php echo $row ['FullName'] ?>" class="form-control"
                    required='required' />
            </div>
        </div>
        <!-- End full name filed -->

        <!-- Start Email filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"><?php echo lang('Email')?></label>
            <div class="col-sm-10 col-md-4">
                <input type="email" name="email" value="<?php echo $row ['Email'] ?>" class="form-control"
                    required='required' />
            </div>
        </div>
        <!-- End Email filed -->

        <!-- Start Save Button filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="<?php echo lang('Save')?>" class="btn btn-primary btn-lg" />
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
            echo "<h1 class='text-center'>Update Member </h1>";
            echo "<div class='container'>";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Get the variables from the form

                $id = $_POST['userid'];
                $user = $_POST['UserName'];
                $name =$_POST['fullname'];
                $email = $_POST['email'];

                // password Trick

                // condition ? true : false;
                $pass = empty($_POST['newpassword']) ?  $_POST['oldpassword'] : sha1($_POST['newpassword']);

                // validate the FORM
                $formERRORS = array();

                if(strlen($user) < 4){
                    $formERRORS[] = '<div class="alert alert-danger">Username Cant be less than <strong> 4 characters </strong> </div>';

                }
                if(strlen($user) > 20){
                    $formERRORS[] = '<div class="alert alert-danger">Username Cant be more than <strong> 20 characters </strong> </div>';

                }

                if(empty($user)){
                    $formERRORS[] = '<div class="alert alert-danger">Username cant be EMpty</div>';
                }

                if(empty($name)){

                    $formERRORS[] = '<div class="alert alert-danger">FullName cant be EMpty</div>';
                }

                if(empty($email)){

                    $formERRORS[] = '<div class="alert alert-danger">Email cant be EMpty</div>';
                }

                // loop into errors Array And Echo It

                foreach($formERRORS as $error){
                    echo $error;
                }

                // check if there is no error Update the database

                if(empty($formERRORS)){

                    $stmt2 = $con->prepare("SELECT 
                                                * 
                                            FROM 
                                                users 
                                            WHERE 
                                                UserName= ? 
                                            AND 
                                                UserID != ?");
                    $stmt2->execute(array($user, $id));

                    $count = $stmt2->rowCount();

                    if($count == 1){
                    $theMsg = "<div class=\"alert alert-danger\">Sorry This User IS Exist</div>";

                        redirectHome($theMsg, 'back');
                    }else{
                //Update the database with this info

                $stmt = $con->prepare("UPDATE users SET UserName=?, email=?, fullname= ?, Password= ?  WHERE UserID = ?");
                $stmt->execute(array($user, $email, $name, $pass, $id));

                //echo succes message

                $theMsg =  "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Updated </div>";

                redirectHome($theMsg, 'back');

                }
            }


            }else{

                $theMsg =  "<div class = 'alert alert-danger'>sorry you cant Browse this page directly</div>";

                redirectHome($theMsg);
            }
            echo '</div>';


        }elseif($do == 'Delete'){ // Delete Member Page
                        echo "<h1 class='text-center'>  Delete Member </h1>";
                        echo "<div class='container'>";

                        // check if get request userid is numeric & get the integer value of it

                        $userid = isset($_GET['userid']) && is_numeric($_GET['userid'] ) ?intval ($_GET['userid']): 0 ;
                        // select all data depend on this id 
                        $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?  LIMIT 1");

                        // check if there is an id as sent or not 

                        $check = checkItem('userid','users', $userid);
            
                        // if there is such id show the form
            
                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
                        $stmt->bindParam(":zuser" , $userid);
                        $stmt->execute();

                        $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Deleted </div>";

                        redirectHome($theMsg,'back');
                    }else{
                        $theMsg = "<div class='alert alert-danger'>This ID is NOT Exist</div>"; 
                        redirectHome($theMsg);
                    }

                    echo '</div>';
        } elseif($do == 'Activate'){

            echo "<h1 class='text-center'>  Activate Member </h1>";
            echo "<div class='container'>";

            // check if get request userid is numeric & get the integer value of it

            $userid = isset($_GET['userid']) && is_numeric($_GET['userid'] ) ?intval ($_GET['userid']): 0 ;

            // select all data depend on this id 

            $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?  LIMIT 1");

            // check if there is an id as sent or not 

            $check = checkItem('userid','users', $userid);

            // if there is such id show the form

        if($check > 0) { 
            $stmt = $con->prepare("UPDATE users SET RegStatus=1 Where UserID = ?");

            $stmt->execute(array($userid));

            $theMsg = "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Activated </div>";

            redirectHome($theMsg);
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