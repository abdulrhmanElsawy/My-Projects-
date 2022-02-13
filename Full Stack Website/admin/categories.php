<?php


    // Category page


    ob_start();

    session_start();

    $pageTitle = 'categories';

    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET ['do']:'manage';

        if($do == 'manage'){

            $sort = 'ASC';
            
            $sort_array = array('ASC' , 'DESC');

            if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){

                $sort = $_GET['sort'];
            }

            $stmt2 = $con->prepare("SELECT * FROM categories WHERE parent=0 ORDER BY Ordering $sort");

            $stmt2->execute();

            $cats = $stmt2->fetchAll();?>

            <h1 class="text-center">Manage categories</h1>
            <div class="container categories">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-edit"></i>Manage Categories
                        <div class="Option pull-right">
                            <i class="fa fa-sort"></i> Ordering:[
                            <a class="<?php if($sort == 'ASC'){echo 'active';}?>" href="?sort=ASC">Asc</a>
                            |
                            <a class="<?php if($sort == 'DESC'){echo 'active';}?>" href="?sort=DESC">Desc</a>]
                            <i class="fa fa-eye"></i>View: [
                            <span class="active" data-view="full">Full</span>
                            |
                            <span data-view="classic">Classic</span>]
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                            foreach ($cats as $cat) {
                                echo "<div class='cat'>";
                                echo "<div class='hidden-buttons'>";
                                echo "<a href='categories.php?do=Edit&catid=" . $cat['ID'] . "' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i>Edit</a>";
                                echo "<a href='categories.php?do=Delete&catid=" . $cat['ID'] . "' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i>Delete</a>";
                                echo '</div>';
                                echo "<h3>" . $cat['Name'] . "</h3>";
                                echo "<div class='full-view'>";
                                echo "<p>" ;
                                if ($cat['Description']=="") {
                                    echo"There is no description";
                                } else {
                                    echo $cat['Description'];
                                }
                                echo "</p>";
                                if ($cat['Visibility']== 1) {
                                    echo '<span class="visibility"><i class="fa fa-eye"></i>Hidden</span>';
                                }
                                if ($cat['Allow_Comment']== 1) {
                                    echo '<span class="commenting"><i class="fa fa-close"></i>comment disabled</span>';
                                }
                                if ($cat['Allow_Ads']== 1) {
                                    echo '<span class="advertises"><i class="fa fa-close"></i>Ads disabled</span>';
                                }
                                // Get Child Categories
                                $CildCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID", "ASC");
                                if (! empty($CildCats)) {
                                    echo "<h4 class='child-head'> Child Categories </h4>";
                                
                                    echo "<ul class='list-unstyled child-cats'>";
                                    foreach ($CildCats as $c) {
                                        echo "<li class='child-link'>
                                            <a href='categories.php?do=Edit&catid=" . $c['ID'] . "'>" . $c['Name'] . "</a>
                                            <a href='categories.php?do=Delete&catid=" . $cat['ID'] . "' class='show-delete confirm'>Delete</a>
                                        </li>"  ;
                                    }
                                    echo "</ul>";
                                }
                                echo "</div>";

                                
                                echo "</div>";
                                

                                echo "<hr>";
                            }
                        ?>
                    </div>
                </div>
                <a class=" add_category btn btn-primary" href="categories.php?do=Add"><i class="fa fa-plus"></i> Add New Category </a>
            </div>



            <?php
        }elseif($do == 'Add'){?>

                <h1 class="text-center"> Add new Category </h1>

                <div class="container">
                    <form class="form-horizontal" action="?do=Insert" method="POST">
                        <!-- Start Name filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="name" class="form-control"  autocomplete="off" required='required' placeholder="Name of the category" />
                                
                            </div>  
                        </div>
                        <!-- End Name filed -->

                        <!-- Start Description filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="description" class="form-control" placeholder = "Descripe the category" />
                                
                            </div>  
                        </div>
                        <!-- End Description filed -->

                        <!-- Start Category Type-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Parent?</label>
                            <div class="col-sm-10 col-md-4">
                                <select name="parent">
                                    <option value="0">None</option>
                                    <?php 
                                    $allcats = getAllFrom("*", "categories", "where parent = 0", "","ID" , "ASC");
                                    foreach($allcats as $cat){
                                        echo "<option value=" . $cat['ID']. ">" . $cat['Name'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>  
                        </div>

                        <!-- end Category Type-->

                        <!-- Start Ordering filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Ordering</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="ordering" class="form-control" placeholder=" Number to arrange the categories " />
                                

                            </div>  
                        </div>
                        <!-- End Ordering filed -->

                        <!-- Start visibility filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Visible</label>
                            <div class="col-sm-10 col-md-4">
                                <div>
                                    <input id="vis-yes" type="radio" name="visibility" value="0" checked />
                                    <label for="vis-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="vis-no" type="radio" name="visibility" value="1"  />
                                    <label for="vis-no">No</label>
                                </div>
                            </div>  
                        </div>
                        <!-- End visibility filed -->

                    <!-- Start Commenting filed -->
                    <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Allow Comments</label>
                            <div class="col-sm-10 col-md-4">
                                <div>
                                    <input id="com-yes" type="radio" name="comment" value="0" checked />
                                    <label for="com-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="com-no" type="radio" name="comment" value="1"  />
                                    <label for="com-no">No</label>
                                </div>
                            </div>  
                        </div>
                        <!-- End Commenting filed -->

                        <!-- Start Ads filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Allow summeries</label>
                            <div class="col-sm-10 col-md-4">
                                <div>
                                    <input id="Ads-yes" type="radio" name="ads" value="0" checked />
                                    <label for="Ads-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="Ads-no" type="radio" name="ads" value="1"  />
                                    <label for="Ads-no">No</label>
                                </div>
                            </div>  
                        </div>
                        <!-- End Ads filed -->

                        

                        <!-- Start Add category Button filed -->
                        <div class="form-group form-group-lg">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="Submit" value="Add Category"  class="btn btn-primary btn-lg" />
                            </div>  
                        </div>
                        <!-- End Add category Button filed -->

                    </form>
                </div>



            <?php

        }elseif($do == 'Insert'){

            // Insert Category page

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                echo "<h1 class='text-center'> Insert Category </h1>";
                echo "<div class='container'>";
    
                    // Get the variables from the form
    
                    $name = $_POST['name'];
                    $desc = $_POST['description'];
                    $parent = $_POST['parent'];
                    $order =$_POST['ordering'];
                    $visible = $_POST['visibility'];
                    $comment = $_POST['comment'];
                    $ads = $_POST['ads'];
    
                    // validate the FORM

                // check if Category exist in database or not 
                $check = checkItem("Name","categories", $user);

                if ($check ==1){

                    $theMsg = "<div class='alert alert-danger'> sorry this Category is exist </div> ";
                    redirectHome($theMsg , 'back');
                }

                else{



                    //Insert Category Info in data base

                    $stmt = $con->prepare("INSERT INTO categories(Name, Description, parent ,Ordering ,Visibility, Allow_Comment, Allow_Ads)
                                VALUES (:zname, :zdesc, :zparent, :zorder, :zvisible, :zcomment, :zads)");
                        $stmt->execute(array(
                            'zname'     =>$name,
                            'zdesc'     =>$desc,
                            'zparent'   =>$parent,
                            'zorder'    =>$order,
                            'zvisible'  =>$visible,
                            'zcomment'  =>$comment,
                            'zads'      =>$ads
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

            // check if get request catid is numeric & get the integer value of it

            $catid = isset($_GET['catid']) && is_numeric($_GET['catid'] ) ?intval ($_GET['catid']): 0 ;
            // select all data depend on this id 
            $stmt = $con->prepare("SELECT * FROM categories WHERE ID = ? ");

            // excure query
            $stmt->execute(array($catid));

            // bring the data

            $cat = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such ID show the form

            if($count > 0) { ?>

                <h1 class="text-center"> Edit Category </h1>

                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="catid" value="<?php echo $catid ?>"/>
                        <!-- Start Name filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="name" class="form-control"  required='required' placeholder="Name of the category" value = "<?php echo $cat['Name']; ?>"/>
                                
                            </div>  
                        </div>
                        <!-- End Name filed -->

                        <!-- Start Description filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="description" class="form-control" placeholder = "Descripe the category" value = "<?php echo $cat['Description']; ?>" />
                                
                            </div>  
                        </div>
                        <!-- End Description filed -->

                        <!-- Start Ordering filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Ordering</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="ordering" class="form-control" placeholder=" Number to arrange the categories " value = "<?php echo $cat['Ordering']; ?>"/>
                                

                            </div>  
                        </div>
                        <!-- End Ordering filed -->

                        <!-- Start Category Type-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Parent?</label>
                            <div class="col-sm-10 col-md-4">
                                <select name="parent">
                                    <option value="0">None</option>
                                    <?php 
                                    $allcats = getAllFrom("*", "categories", "where parent = 0", "","ID" , "ASC");
                                    foreach($allcats as $c){
                                        echo "<option value='" . $c['ID'] . "'";
                                        if($cat['parent'] == $c['ID']){
                                            echo  'selected';
                                        }
                                        echo ">" . $c['Name'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>  
                        </div>

                        <!-- end Category Type-->

                        <!-- Start visibility filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Visible</label>
                            <div class="col-sm-10 col-md-4">
                                <div>
                                    <input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['Visibility'] == 0){echo 'checked';} ?>  />
                                    <label for="vis-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="vis-no" type="radio" name="visibility" value="1" <?php if($cat['Visibility'] == 1){echo 'checked';} ?>  />
                                    <label for="vis-no">No</label>
                                </div>
                            </div>  
                        </div>
                        <!-- End visibility filed -->

                    <!-- Start Commenting filed -->
                    <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Allow Comments</label>
                            <div class="col-sm-10 col-md-4">
                                <div>
                                    <input id="com-yes" type="radio" name="comment" value="0" <?php if($cat['Allow_Comment'] == 0){echo 'checked';} ?>  />
                                    <label for="com-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="com-no" type="radio" name="comment" value="1" <?php if($cat['Allow_Comment'] == 1){echo 'checked';} ?>   />
                                    <label for="com-no">No</label>
                                </div>
                            </div>  
                        </div>
                        <!-- End Commenting filed -->

                        <!-- Start Ads filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Allow Summeries</label>
                            <div class="col-sm-10 col-md-4">
                                <div>
                                    <input id="Ads-yes" type="radio" name="ads" value="0" <?php if($cat['Allow_Ads'] == 0){echo 'checked';} ?>   />
                                    <label for="Ads-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="Ads-no" type="radio" name="ads" value="1" <?php if($cat['Allow_Ads'] == 1){echo 'checked';} ?>  />
                                    <label for="Ads-no">No</label>
                                </div>
                            </div>  
                        </div>
                        <!-- End Ads filed -->

                        

                        <!-- Start Add category Button filed -->
                        <div class="form-group form-group-lg">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="Submit" value="Save"  class="btn btn-primary btn-lg" />
                            </div>  
                        </div>
                        <!-- End Add category Button filed -->

                    </form>
                </div>





            <?php 

            // else show error message

            } else { 
                    echo '<div class="container">';

                    $theMsg =  '<div class="alert alert-danger">there is NO such ID </div>';

                    redirectHome($theMsg);

                    echo '</ div>';

                    }

        }elseif($do == 'Update'){

            // Update page
            echo "<h1 class='text-center'>Update Category </h1>";
            echo "<div class='container'>";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Get the variables from the form

                $id         = $_POST['catid'];
                $name       = $_POST['name'];
                $desc       = $_POST['description'];
                $order      = $_POST['ordering'];
                $parent      = $_POST['parent'];
                $visible    = $_POST['visibility'];
                $comment    = $_POST['comment'];
                $ads        = $_POST['ads'];


                //Update the database with this info
                $stmt = $con->prepare("UPDATE 
                                    categories 
                                    SET 
                                        Name            =?, 
                                        Description     =?, 
                                        Ordering        =?, 
                                        parent          =?,
                                        Visibility      =?, 
                                        Allow_Comment   =?,
                                        Allow_Ads       =?

                                    WHERE 
                                        ID = ?");
                $stmt->execute(array($name, $desc, $order, $parent, $visible, $comment, $ads, $id));

                //echo succes message

                $theMsg =  "<div class='alert alert-success'>"  . $stmt->rowCount(). "Record Updated </div>";

                redirectHome($theMsg, 'back');



            }else{

                $theMsg =  "<div class = 'alert alert-danger'>sorry you cant Browse this page directly</div>";

                redirectHome($theMsg);
            }
            echo '</div>';

        }elseif($do == 'Delete'){
                        // Delete Category Page
                        echo "<h1 class='text-center'>  Delete Category </h1>";
                        echo "<div class='container'>";

                        // check if get request catid is numeric & get the integer value of it

                        $catid = isset($_GET['catid']) && is_numeric($_GET['catid'] ) ?intval ($_GET['catid']): 0 ;
                        // select all data depend on this id 
                        $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?  LIMIT 1");

                        // check if there is an id as sent or not 

                        $check = checkItem('ID','categories', $catid);

                        // if there is such id show the form

                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");
                        $stmt->bindParam(":zid" , $catid);
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


        include $tpl . 'footer.php';
    }else{
        header('Location: index.php');
        exit();
    }

    ob_end_flush();

?>

