<?php
    ob_start ();
    session_start();

    $pageTitle = 'Create New Summary';

    include 'init.php';

    if(isset($_SESSION['user'])){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $formErrors=array();

            $name       = filter_var( $_POST['name'], FILTER_SANITIZE_STRING);
            $desc       = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $price      = filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
            $country    = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
            $status     = filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
            $category   = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
            $tags       = filter_var($_POST['tags'],FILTER_SANITIZE_STRING);
            $avatarName = filter_var($_POST['avatar'],FILTER_SANITIZE_STRING);

            if(strlen($name) < 4){

                $formErrors[] = 'Item Title Must Be At least 4 Characters';
            }

            if(strlen($desc) < 10){

                $formErrors[] = 'Item Description Must Be At least 10 Characters';
            }
            if(strlen($country) < 2){

                $formErrors[] = 'Item Country Must Be At least 2 Characters';
            }

            if(strlen($price) < 1){

                $formErrors[] = 'Item Price Can Not Be Empty Or Less Than Zero';
            }

            if(empty($status)){

                $formErrors[] = 'Item Status Can not Be Empty';
            }

            if(empty($category)){

                $formErrors[] = 'Item Category Can not Be Empty';
            }
            if(empty($avatarName)){
                $formERRORS[] = '<div class="alert alert-danger">You <strong>Must</strong> Upload a Profile Photo</div>';
            }

            // check if there is no error Update the database
    
            if(empty($formErrors)){
                $avatar = $avatarName;

                $stmt = $con->prepare("INSERT
                                            INTO items
                                            (Name, 
                                            Description, 
                                            Price, 
                                            Country_Made, 
                                            Status, 
                                            Add_Date,
                                            cat_ID,
                                            Member_ID,
                                            tags,
                                            avatar)
                            VALUES (:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember, :ztags, :zavatar)");
                    $stmt->execute(array(
                        'zname'     =>$name,
                        'zdesc'     =>$desc,
                        'zprice'    =>$price,
                        'zcountry'  =>$country,
                        'zstatus'   =>$status,
                        'zcat'      =>$category,
                        'zmember'   =>$_SESSION['uid'],
                        'ztags'     =>$tags,
                        'zavatar'   => $avatar 
                        
                    
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
                        <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'] ?>"
                            method="POST" enctype="multipart/form-data">
                            <!-- Start Name filed -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">Subject Name</label>
                                <div class="col-sm-10 col-md-9">
                                    <input pattern=".{4,}" title="This Filed Must Have more than 4 Characters"
                                        type="text" name="name" class="form-control live" required='required'
                                        placeholder="Doctor Name" data-class=".live-title" required="required" />

                                </div>
                            </div>
                            <!-- End Name filed -->

                            <!-- Start Description filed -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-10 col-md-9">
                                    <input pattern=".{5,}" title="Description Must Have more than 10 Characters"
                                        type="text" name="description" required='required' class="form-control live"
                                        placeholder="Write The Full Name Of the Subject" data-class=".live-desc"
                                        required="required" />

                                </div>
                            </div>
                            <!-- End Description filed -->

                            <!-- Start price filed -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">Lecture Number</label>
                                <div class="col-sm-10 col-md-9">
                                    <input type="text" name="price" required='required' class="form-control live"
                                        placeholder="Number of the lecture" data-class=".live-price"
                                        required="required" />

                                </div>
                            </div>
                            <!-- End price filed -->

                            <!-- Start Drive Link filed -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">Drive Link</label>
                                <div class="col-sm-10 col-md-9">
                                    <input type="text" name="country" required='required' class="form-control"
                                        placeholder="Copy Your Pdf Drive Link Here" required="required" />

                                </div>
                            </div>
                            <!-- End Drive Link filed -->

                            <!-- Start Item Photo -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">Item Photo</label>
                                <div class="col-sm-10 col-md-9">
                                    <select class="options" name="avatar" required="required">
                                        <option value="">...</option>
                                        <option value="pdf.png">pdf.png</option>
                                        <option value="youtube.png">youtube.jpg</option>
                                        <option value="corsers.jpg">corsers.png</option>
                                        <option value="udemy.png">udemy.jpg</option>
                                    </select>


                                </div>
                            </div>
                            <!-- End Item Photo filed -->

                            <!-- Start Status filed -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">The Level</label>
                                <div class="col-sm-10 col-md-9">
                                    <select class="options" name="status" required="required">
                                        <option value="">...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>


                                </div>
                            </div>
                            <!-- End Status filed -->

                            <!-- Start Categories filed -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">Subject Name</label>
                                <div class="col-sm-10 col-md-9">
                                    <select class="options" name="category" required="required">
                                        <option value="">...</option>
                                        <?php
                                            $cats = getAllFrom('*', 'categories', '','', 'ID');
                                            foreach($cats as $cat){
                                                echo "<option value='" . $cat['ID'] . "'>" .  $cat['Name'] . "</option>";
                                            }


                                        ?>
                                    </select>


                                </div>
                            </div>
                            <!-- End Categories filed -->

                            <!-- Start Tags filed -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">Tags</label>
                                <div class="col-sm-10 col-md-9">
                                    <input type="text" name="tags" class="form-control"
                                        placeholder="Seprate Tags With Comma(,)" />

                                </div>
                            </div>
                            <!-- End Tags filed -->


                            <!-- Start Add category Button filed -->
                            <div class="form-group form-group-lg">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="Submit" value="Add Item"
                                        class="btn btn-primary create-new-ad btn-sm" />
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
                            <img class="img-responsive" src="img.jpg" alt="" />
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