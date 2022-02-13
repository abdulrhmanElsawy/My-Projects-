<?php


    // Items page


    ob_start();

    session_start();

    $pageTitle = 'Posts';

    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET ['do']:'manage';

        if($do == 'manage'){
            // manage Items page 

            
        
        $stmt = $con->prepare("SELECT 
                                * 
                                FROM posts 
        ORDER BY postid ASC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $posts = $stmt->fetchAll();
        
            if (! empty($posts)){
        
        ?>

            <h1 class="text-center"> Manage posts</h1>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                            <td>#ID</td>
                            <td>userphoto</td>
                            <td>username</td>
                            <td>usertitle</td>
                            <td>posttext</td>
                            <td>postphoto</td>
                            <td>Video</td>
                        </tr>
                        <?php

                        foreach($posts as $post){
                            echo "<tr>";
                                echo "<td>". $post['postid'] . "</td>";
                                echo "<td>". $post['userphoto'] . "</td>";
                                echo "<td>". $post['username'] . "</td>";
                                echo "<td>". $post['usertitle'] . "</td>";
                                echo "<td>". $post['posttext'] . "</td>";
                                echo "<td>". $post['postphoto'] . "</td>";
                                echo "<td>". $post['video'] . "</td>";
                                echo "<td> 
                                <a href='posts.php?do=Edit&postid=" . $post['postid'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                                <a href='posts.php?do=Delete&postid=" . $post['postid'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                                echo"</td>";
                                echo "</tr>";
                        }

                        ?>

                        <tr>
                </table>
                </div>
                <a href="posts.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New post</a>

            </div>
            
        <?php }else {
            echo '<div class="container">';
                echo "<div class='nice-message'>There Is No posts To Show</div>";
                echo '<a href="posts.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New post</a>';
            echo '</div>';
        }

        }elseif($do == 'Add'){ ?>
        <h1 class="text-center"> Add new post </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
        <!-- Start userphoto filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">userphoto</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type        ="text" 
                    name        ="userphoto" 
                    class       ="form-control" 
                    required    ='required' 
                    placeholder ="The User Photo" />
                
            </div>  
        </div>
        <!-- End userphoto filed -->

        <!-- Start username filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">username</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type        ="text" 
                    name        ="username" 
                    class       ="form-control" 
                    required    ='required' 
                    placeholder ="The User name" />
                
            </div>  
        </div>
        <!-- End username filed -->


        <!-- Start usertitle filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">usertitle</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type        ="text" 
                    name        ="usertitle" 
                    class       ="form-control" 
                    required    ='required' 
                    placeholder ="The User titel" />
                
            </div>  
        </div>
        <!-- End usertitle filed -->

        <!-- Start posttext filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">post text</label>
            <div class="col-sm-10 col-md-4">
                <textarea 
                    type        ="text" 
                    name        ="posttext" 
                    class       ="form-control" 
                    required    ='required' 
                    placeholder ="The Post Text" 
                    style = "height:300px";
                    ></textarea>
                
            </div>  
        </div>
        <!-- End posttext filed -->

        <!-- Start direction filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Text Direction</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type        ="text" 
                    name        ="direction" 
                    class       ="form-control" 
                    required    ='required' 
                    placeholder ="rtl / ltr" />
                
            </div>  
        </div>
        <!-- End direction filed -->

        <!-- Start Post Photo filed -->
        <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Post Photo</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="file" name="avatar" class="form-control" autocomplete="off"/>
                            

                        </div>  
                    </div>
                    <!-- End Post photo filed -->

        <!-- Start  video filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Video Link</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type        ="text" 
                    name        ="video" 
                    class       ="form-control" 
                    
                    placeholder ="www.youtube.com" />
                
            </div>  
        </div>
        <!-- End Video filed -->


        <!-- Start Add category Button filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Add post"  class="btn btn-primary btn-sm" />
            </div>  
        </div>
        <!-- End Add category Button filed -->

    </form>
</div>



<?php


        }elseif($do == 'Insert'){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                echo "<h1 class='text-center'>Insert post </h1>";
                echo "<div class='container'>";
    
                    // Get the variables from the form
    
                    $userphoto      = $_POST['userphoto'];
                    $username       = $_POST['username'];
                    $usertitle      = $_POST['usertitle'];
                    $posttext       = $_POST['posttext'];
                    $direction      = $_POST['direction'];
                    $video          = $_POST['video'];

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
                    
    
                    // validate the FORM

                    $formERRORS = array();
    
                    if(empty($userphoto)){
                        $formERRORS[] = '<div class="alert alert-danger">photo Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($username)){
                        $formERRORS[] = '<div class="alert alert-danger">Name Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($usertitle)){
                        $formERRORS[] = '<div class="alert alert-danger">title Cant be <strong>Empty</strong> </div>';
    
                    }
                    
                    if(empty($posttext)){
                        $formERRORS[] = '<div class="alert alert-danger">post text Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($direction)){
                        $formERRORS[] = '<div class="alert alert-danger"> Text Direction Cant be <strong>Empty</strong> </div>';
    
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

                        if (!empty($avatarName)) {
                            $avatar = rand(0, 100000) . '_' . $avatarName;
                            move_uploaded_file($avatarTmp, "uploads\posts\\" . $avatar);
                        }
    
                        $stmt = $con->prepare("INSERT
                                                    INTO posts
                                                    ( userphoto,
                                                    username,
                                                    usertitle,
                                                    posttext,
                                                    direction,
                                                    postphoto,
                                                    video
                                                    )
                                    VALUES (:zuserphoto, :zusername, :zusertitle, :zposttext, :zdirection, :zavatar, :zvideo)");
                            $stmt->execute(array(
                                'zuserphoto'      =>$userphoto,
                                'zusername'       =>$username,
                                'zusertitle'      =>$usertitle,
                                'zposttext'       =>$posttext,
                                'zdirection'      =>$direction,
                                'zavatar'         =>$avatar,
                                'zvideo'          =>$video

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

            // check if get request post is numeric & get the integer value of it

            $postid = isset($_GET['postid']) && is_numeric($_GET['postid'] ) ?intval ($_GET['postid']): 0 ;
            // select all data depend on this id 
            $stmt = $con->prepare("SELECT * FROM posts WHERE postid = ? ");

            // excure query
            $stmt->execute(array($postid));

            // bring the data

            $post = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such id show the form

            if($count > 0) { ?>

                <h1 class="text-center"> Edit post </h1>

                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="postid" value="<?php echo $postid ?>" />
                        <!-- Start userphoto filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">User photo</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="text" 
                                    name        ="userphoto" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    placeholder ="user photo"
                                    value="<?php echo $post['userphoto'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End userphoto filed -->

                        <!-- Start username filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">User Name</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="text" 
                                    name        ="username" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    placeholder ="user photo"
                                    value="<?php echo $post['username'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End username filed -->

                        <!-- Start usertitle filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">User Title</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="text" 
                                    name        ="usertitle" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    placeholder ="user photo"
                                    value="<?php echo $post['usertitle'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End usertitle filed -->

                        <!-- Start posttext filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Post Text</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="text" 
                                    name        ="posttext" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    placeholder ="user photo"
                                    value="<?php echo $post['posttext'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End posttext filed -->

                        <!-- Start Direction filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Text Direction</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="text" 
                                    name        ="direction" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    placeholder ="rtl / ltr"
                                    value="<?php echo $post['direction'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End Direction filed -->

                        



                        <!-- Start Profile Image filed -->
        <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Post Photo</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="file" name="avatar" value="<?php echo $post['postphoto']; ?>" class="form-control" />
                            

                        </div>  
                    </div>
                    <!-- End Profile Image filed -->


                            <!-- Start Video filed -->
                            <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Video</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="text" 
                                    name        ="video" 
                                    class       ="form-control" 
                                    
                                    placeholder ="www.youtube.com"
                                    value="<?php echo $post['video'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End Video filed -->



                        <!-- Start Submit filed -->
                        <div class="form-group form-group-lg">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="Submit" value="Save post"  class="btn btn-primary btn-sm" />
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
            echo "<h1 class='text-center'>Update post </h1>";
            echo "<div class='container'>";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Get the variables from the form

                $postid    = $_POST['postid'];
                $userphoto = $_POST['userphoto'];
                $username  = $_POST['username'];
                $usertitle = $_POST['usertitle'];
                $posttext  = $_POST['posttext'];
                $direction  = $_POST['direction'];
                $video      = $_POST['video'];

                
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




                            // validate the FORM

                            $formERRORS = array();

                            if(empty($userphoto)){
                                $formERRORS[] = '<div class="alert alert-danger">Photo Cant be <strong>Empty</strong> </div>';
            
                            }
                            if(empty($username)){
                                $formERRORS[] = '<div class="alert alert-danger">Name Cant be <strong>Empty</strong> </div>';
            
                            }
                            if(empty($usertitle)){
                                $formERRORS[] = '<div class="alert alert-danger">Title Cant be <strong>Empty</strong> </div>';
            
                            }
                            if(empty($posttext)){
                                $formERRORS[] = '<div class="alert alert-danger">Post Text Cant be <strong>Empty</strong> </div>';
            
                            }

                            if(empty($direction)){
                                $formERRORS[] = '<div class="alert alert-danger"> Text direction Cant be <strong>Empty</strong> </div>';
            
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
                                            posts 
                                        SET
                                            userphoto     =?,
                                            username      =?,
                                            usertitle     =?,
                                            posttext      =?,
                                            direction     =?,
                                            postphoto     =?,
                                            video         =?

                                        WHERE 
                                            postid = ?");
                $stmt->execute(array($userphoto, $username, $usertitle, $posttext, $direction, $avatar, $video, $postid));


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
                        echo "<h1 class='text-center'>  Delete post </h1>";
                        echo "<div class='container'>";

                        // check if get request ItemID is numeric & get the integer value of it

                        $postid = isset($_GET['postid']) && is_numeric($_GET['postid'] ) ?intval ($_GET['postid']): 0 ;

                        // check if there is an id as sent or not 

                        $check = checkItem('postid','posts', $postid);

                        // if there is such id show the form

                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM posts WHERE postid = :zid");
                        $stmt->bindParam(":zid" , $postid);
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

