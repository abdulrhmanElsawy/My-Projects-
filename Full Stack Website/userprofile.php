<?php    
    ob_start();
    session_start();
    $pageTitle = 'Profile';
    include 'init.php';
?>

<div class="userprofile">
    <div class="container">
        <div style="background-image: url('usersProfileImages/1.jpg');" class="profile-images">
            <div class="profile-user-image">
                <img src="usersProfileImages/download.jpg">
            </div>
            <h3 class="vip-account">VIP Account</h3>
        </div>

        <div class="user-data">
            <h1 class="user-name">Abdelrhman Elsawy</h1>
            <h2 class="user-title">Founder of Code Pioneers</h2>
        </div>

        <div class="user-social-media">
            <h1>Social Media Accounts</h1>
            <div class="social-Accounts">
                <ul>
                    <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                    <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i> Instagram</a></li>
                    <li><a href="#"><i class="fab fa-linkedin-square" aria-hidden="true"></i> linked In</a></li>
                    <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
                    <li><a href="#"><i class="fab fa-behance-square" aria-hidden="true"></i> Behance</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>

<?php

    if(isset($_SESSION['user'])){

        $getUser= $con->prepare('SELECT * FROM users WHERE UserName = ?');

        $getUser->execute(array($sessionUser));

        $info = $getUser->fetch();

        $userid = $info['UserID'];


    ?>


<div class="information block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                MY Information
            </div>
            <div class="panel-body">
                <ul class="list-unstyled profile-custom-style">
                    <li>
                        <i class="fa fa-unlock-alt fa-fw"></i>
                        <span>Login Name</span>: <?php echo $info['UserName']; ?>
                    </li>
                    <li>
                        <i class="fa fa-envelope-o fa-fw"></i>
                        <span>Email</span>: <?php echo $info['Email']; ?>
                    </li>
                    <li>
                        <i class="fa fa-user fa-fw"></i>
                        <span>Full Name</span>: <?php echo $info['FullName']; ?>
                    </li>
                    <li>
                        <i class="fa fa-calender fa-fw"></i>
                        <span>Register Date</span>: <?php echo $info['Date']; ?>
                    </li>
                    <li>
                        <i class="fa fa-tags fa-fw"></i>
                        <span>Favorite Category</span>:
                    </li>
                    <li>

                        <span>Edit
                            profile</span>:<span><?php  echo "<a href='userprofile.php?do=edit&userid=" . $_SESSION['uid'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>";?></span>

                    </li>

                </ul>

            </div>
        </div>
    </div>
</div>

<div id="my-ads" class="my-ads block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                My Added Subject Summerises
            </div>
            <div class="panel-body">
                <div class="row">

                    <?php
                
                $myItems = getAllFrom("*", "items", "where Member_ID = $userid", "", "Item_ID");
                if(! empty($myItems)){
                    echo'<div class="row">';
                foreach($myItems as $item){
                echo '<div class="col-sm-6 col-md-3">';
                    echo '<div class="thumbnail item-box">';
                    if($item ['Approve'] == 0){echo '<div class="approve-status">Not Approved Yet</div>';}
                    echo ' <span class="price-tag">$ ' . $item['Price']  .  ' </span> ';
                        echo ' <img class="img-responsive" src="img.jpg" alt=""/>';
                        echo '<div class="caption">';
                            echo '<h3><a href="items.php?itemid=' . $item['Item_ID'] . '">' . $item['Name']  . '</a></h3>';
                            echo '<p>' . $item['Description']  . '</p>';
                            echo '<div class="date">' . $item['Add_Date']  . '</div>';
                        echo'</div>';
                    echo '</div>';
                echo '</div>';
                }
                echo '</div>';
            } else{
                echo '  Sorry There is No <strong>Events or summaries</strong> To Show , Create <a href="newad.php"> New Item </a>';
            }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-comments block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Latest Comments
            </div>
            <div class="panel-body">
                <?php
                $myComments = getAllFrom("comment", "comments", "where user_id = $userid", "", "c_id");

                if(! empty($myComments)){

                    foreach ($myComments as $comment) {
                        echo '<p>' . $comment['comment'] . '</p>';
                    }


                }else{
                    echo ' There Is No Comments To Show';
                }


                ?>
            </div>
        </div>
    </div>
</div>

<div class="edit-your-profile">
    <div class="edit-your-profile-inforamtion">

        <?php



    $do = isset($_GET['do'])? $_GET['do']:'';

    if ($do == 'edit') { // edit page 

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

    if($count > 0 && $_SESSION['uid'] == $userid) { ?>

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

                <!-- Start Email filed -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label"><?php echo lang('Email')?></label>
                    <div class="col-sm-10 col-md-4">
                        <input type="email" name="email" value="<?php echo $row ['Email'] ?>" class="form-control"
                            required='required' />
                    </div>
                </div>
                <!-- End Email filed -->

                <!-- Start Email filed -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label"><?php echo lang('Email')?></label>
                    <div class="col-sm-10 col-md-4">
                        <input type="email" name="email" value="<?php echo $row ['Email'] ?>" class="form-control"
                            required='required' />
                    </div>
                </div>
                <!-- End Email filed -->
                <!-- Start Email filed -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label"><?php echo lang('Email')?></label>
                    <div class="col-sm-10 col-md-4">
                        <input type="email" name="email" value="<?php echo $row ['Email'] ?>" class="form-control"
                            required='required' />
                    </div>
                </div>
                <!-- End Email filed -->

                <!-- Start Email filed -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label"><?php echo lang('Email')?></label>
                    <div class="col-sm-10 col-md-4">
                        <input type="email" name="email" value="<?php echo $row ['Email'] ?>" class="form-control"
                            required='required' />
                    </div>
                </div>
                <!-- End Email filed -->
                <!-- Start Email filed -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label"><?php echo lang('Email')?></label>
                    <div class="col-sm-10 col-md-4">
                        <input type="email" name="email" value="<?php echo $row ['Email'] ?>" class="form-control"
                            required='required' />
                    </div>
                </div>
                <!-- End Email filed -->
                <!-- Start Email filed -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label"><?php echo lang('Email')?></label>
                    <div class="col-sm-10 col-md-4">
                        <input type="email" name="email" value="<?php echo $row ['Email'] ?>" class="form-control"
                            required='required' />
                    </div>
                </div>
                <!-- End Email filed -->

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


}



?>

    </div>
</div>






<?php

}else{
    header('Location: login.php');
    exit();
}


include  $tpl ."footer.php"; 
ob_end_flush();
?>