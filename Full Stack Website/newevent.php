<?php

    session_start();

    $pageTitle = 'Create New Event';

    include 'init.php';

    if(isset($_SESSION['user'])){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $formErrors=array();

            $name        = filter_var( $_POST['name'], FILTER_SANITIZE_STRING);
            $desc        = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $organizer   = filter_var($_POST['organizer'],FILTER_SANITIZE_STRING);
            $Youtube_Vid = filter_var($_POST['link'],FILTER_SANITIZE_STRING);
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

            if(strlen($name) < 3){

                $formErrors[] = 'Item Title Must Be At least 4 Characters';
            }

            if(strlen($desc) < 10){

                $formErrors[] = 'Item Description Must Be At least 10 Characters';
            }

            if(strlen($organizer) < 1){

                $formErrors[] = 'Organizer Name Can Not be One Character Or less';
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

            


            // check if there is no error Update the database
    
            if(empty($formErrors)){
                $avatar = rand(0,100000) . '_' . $avatarName;
                move_uploaded_file($avatarTmp, "admin\uploads\avatars\\" . $avatar);

                $stmt = $con->prepare("INSERT
                                            INTO events
                                            (Name, 
                                            Organizer, 
                                            Youtube_Vid, 
                                            Add_Date,
                                            Description,
                                            avatar
                                            )
                            VALUES (:zname, :zorg, :zyou, now(), :zdesc, :zavatar)");
                    $stmt->execute(array(
                        'zname'     =>$name,
                        'zorg'      =>$organizer,
                        'zyou'      =>$Youtube_Vid,
                        'zdesc'     =>$desc,
                        ':zavatar'  =>$avatar
                    ));

                //echo succes message

                if($stmt){

                    $succesMsg = "Item Added <strong>Successfully</strong>";
                }
                
            }
            
        }

    ?>

        <h1 class="text-center"><?php echo $pageTitle ?> </h1>

    <div class="create-ad block">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading create-new-ad">
                    <?php echo $pageTitle ?>
                </div>
                <div class="panel-body create-new-ad">
                    <div class="row">
                        <div class="col-md-8">
                                        <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <!-- Start Name filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-10 col-md-9">
                                <input 
                                    pattern     =".{3,}"
                                    title       ="This Filed Must Have more than 4 Characters"
                                    type        ="text" 
                                    name        ="name" 
                                    class       ="form-control live" 
                                    required    ='required' 
                                    placeholder ="Enter The Event Name"
                                    data-class=".live-title"
                                    required="required" />
                                
                            </div>  
                        </div>
                        <!-- End Name filed -->

                        <!-- Start Description filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-10 col-md-9">
                                <input 
                                    pattern     =".{10,}"
                                    title       ="Description Must Have more than 10 Characters"
                                    type="text" 
                                    name="description"
                                    required    ='required' 
                                    class="form-control live" 
                                    placeholder="Must Include the Place And The Date"
                                    data-class=".live-desc"
                                    required="required"/>
                                
                            </div>  
                        </div>
                        <!-- End Description filed -->

                        <!-- Start price filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label">organizer(s)</label>
                            <div class="col-sm-10 col-md-9">
                                <input 
                                    type="text" 
                                    name="organizer" 
                                    required   ='required'
                                    class="form-control live" 
                                    placeholder="Write The Organizer(s) name(s)"
                                    data-class=".live-price"
                                    required="required" />
                                
                            </div>  
                        </div>
                        <!-- End price filed -->

                        <!-- Start YouTube Link filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label">YouTube Link</label>
                            <div class="col-sm-10 col-md-9">
                                <input 
                                    type="text" 
                                    name="link" 
                                    class="form-control" 
                                    placeholder="Copy Your YouTube Video Link Here"
                                    />
                                
                            </div>  
                        </div>
                        <!-- End Youtube Link filed -->

                        <!-- Start Event photo filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label">Event Photo</label>
                            <div class="col-sm-10 col-md-9">
                                <input 
                                    type="file" 
                                    name="avatar" 
                                    required  ='required'
                                    class="form-control" 
                                    placeholder="Event Photo"
                                    />
                                
                            </div>  
                        </div>
                        <!-- End Event photo filed -->



                        <!-- Start Add category Button filed -->
                        <div class="form-group form-group-lg">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="Submit" value="Add Item"  class="btn btn-primary create-new-ad btn-sm" />
                            </div>  
                        </div>
                        <!-- End Add category Button filed -->

                    </form>
                        </div>
                        <div class="col-md-4">
                                    <div class="thumbnail item-box live-preview create-new-ad">
                                        <span class="price-tag">
                                            <span class="live-price">0</span>  
                                        </span>
                                        <img class="img-responsive" src="layout/gif/comingevent.gif" alt=""/>
                                        <div class="caption">
                                            <h3 class="live-title create-new-ad">Title</h3>
                                            <p class="live-desc create-new-ad">Description</p>
                                        </div>
                                    </div>
                        </div>
                    </div>
                    <!-- Start Looping Through Errors -->
                        <?php
                            if(! empty ($formErrors)){
                                foreach($formErrors as $error){
                                    echo '<div class="alert alert-danger">' . $error . '</div>';
                                }
                            }
                            if(isset($succesMsg)){
                                echo '<div class="alert alert-success">' . $succesMsg . '</div>';
                            }
                        ?>
                    <!-- End Looping Through Errors -->
                </div>
            </div>
        </div>
    </div>

    <?php

    }else{
        header('Location: login.php');
        exit();
    }
    include $tpl . 'footer.php';

?>