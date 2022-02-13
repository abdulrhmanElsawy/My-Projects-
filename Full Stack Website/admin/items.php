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
                                items.*, categories.Name 
                                AS 
                                category_Name, 
                                users.UserName 
                                FROM items 
        INNER JOIN categories ON categories.ID = items.Cat_ID
        
        INNER JOIN users ON users.UserID = items.Member_ID 
        ORDER BY Item_ID DESC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $items = $stmt->fetchAll();
        
            if (! empty($items)){
        
        ?>

            <h1 class="text-center"> Manage Items</h1>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                            <td>#ID</td>
                            <td>Name</td>
                            <td>Descreption</td>
                            <td>Number</td>
                            <td>Adding Date</td>
                            <td>Drive Link</td>
                            <td>Category</td>
                            <td>UserName</td>
                            <td>photo</td>
                            <td>youtube_Link</td>
                            <td>Control</td>
                        </tr>
                        <?php

                        foreach($items as $item){
                            echo "<tr>";
                                echo "<td>". $item['Item_ID'] . "</td>";
                                echo "<td>". $item['Name'] . "</td>";
                                echo "<td>". $item['Description'] . "</td>";
                                echo "<td>". $item['Price'] . "</td>";
                                echo "<td>". $item['Add_Date'] . "</td>";
                                echo "<td>". $item['Country_Made'] . "</td>";
                                echo "<td>". $item['category_Name'] . "</td>";
                                echo "<td>". $item['UserName'] . "</td>";
                                echo "<td>". $item['avatar'] . "</td>";
                                echo "<td>". $item['youtube_Link'] . "</td>";

                                echo "<td> 
                                <a href='items.php?do=Edit&itemid=" . $item['Item_ID'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                                <a href='items.php?do=Delete&itemid=" . $item['Item_ID'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                                if($item['Approve'] == 0){

                                    echo "
                                    <a href='items.php?do=Approve&itemid=" . $item['Item_ID'] . "'
                                    class='btn btn-info activate '><i class='fa fa-check'></i> Approve </a>";
                                }

                                echo"</td>";
                                echo "</tr>";
                        }

                        ?>

                        <tr>
                </table>
                </div>
                <a href="items.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New Item</a>

            </div>
            
        <?php }else {
            echo '<div class="container">';
                echo "<div class='nice-message'>There Is No items To Show</div>";
                echo '<a href="items.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New Item</a>';
            echo '</div>';
        }

        }elseif($do == 'Add'){ ?>
        <h1 class="text-center"> Add new Summary </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Insert" method="POST">
        <!-- Start Name filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type        ="text" 
                    name        ="name" 
                    class       ="form-control" 
                    required    ='required' 
                    placeholder ="Name of the Item" />
                
            </div>  
        </div>
        <!-- End Name filed -->

        <!-- Start Description filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type="text" 
                    name="description"
                    required    ='required' 
                    class="form-control" 
                    placeholder="Description OF The Item" />
                
            </div>  
        </div>
        <!-- End Description filed -->

         <!-- Start youtube_Link filed -->
         <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">youtube_Link</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type="text" 
                    name="youtube_Link"
                    class="form-control" 
                    placeholder="youtube_Link [iframe]" />
                
            </div>  
        </div>
        <!-- End youtube_Link filed -->

        <!-- Start price filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Number In List</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type="text" 
                    name="price" 
                    required   ='required'
                    class="form-control" 
                    placeholder="price OF The Item" />
                
            </div>  
        </div>
        <!-- End price filed -->

        <!-- Start Country filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Drive Link</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type="text" 
                    name="country" 
                    required  ='required'
                    class="form-control" 
                    placeholder="Country OF Made" />
                
            </div>  
        </div>
        <!-- End Country filed -->

        <!-- Start Status filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Level</label>
            <div class="col-sm-10 col-md-4">
                <select  name="status" required    ='required'>
                        <option value="0">...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
        </select>

                
            </div>  
        </div>
        <!-- End Status filed -->

        <!-- Start Members filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Member</label>
            <div class="col-sm-10 col-md-4">
                <select  name="member" required    ='required'>
                        <option value="0">...</option>
                        <?php
                            $allMembers = getAllFrom("*", "users", "", "", "UserID");
                            foreach($allMembers as $user){
                                echo "<option value='" . $user['UserID'] . "'>" .  $user['UserName'] . "</option>";
                            }


                        ?>
        </select>

                
            </div>  
        </div>
        <!-- End Members filed -->

        <!-- Start Item Photo -->
        <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Item Photo</label>
                                <div class="col-sm-10 col-md-4">
                                    <select class="options" name="avatar">
                                        <option value="">...</option>
                                        <option value="pdf.png">pdf.png</option>
                                        <option value="youtube.png">youtube.jpg</option>
                                        <option value="corsers.jpg">corsers.png</option>
                                        <option value="udemy.png">udemy.jpg</option>
                                    </select>


                                </div>
                            </div>
            <!-- End Item Photo filed -->

        <!-- Start Categories filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10 col-md-4">
                <select  name="category" required    ='required'>
                        <option value="0">...</option>
                        <?php
                            $allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID");
                            foreach($allCats as $cat){
                                echo "<option value='" . $cat['ID'] . "'>" .  $cat['Name'] . "</option>";
                                $childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID");
                                foreach ($childCats as $child){
                                    echo "<option value='" . $child['ID'] . "'>---" .  $child['Name'] . "</option>";
                                }
                            }


                        ?>
        </select>

                
            </div>  
        </div>
        <!-- End Categories filed -->

                <!-- Start Tags filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Tags</label>
            <div class="col-sm-10 col-md-4">
                <input 
                    type="text" 
                    name="tags" 
                    class="form-control" 
                    placeholder="Seprate Tags With Comma(,)" />
                
            </div>  
        </div>
        <!-- End Tags filed -->

        


        <!-- Start Add category Button filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Add Item"  class="btn btn-primary btn-sm" />
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
                    $price      = $_POST['price'];
                    $country    = $_POST['country'];
                    $status     = $_POST['status'];
                    $member     = $_POST['member'];
                    $avatar     = $_POST['avatar'];
                    $cat        = $_POST['category'];
                    $tags       = $_POST['tags'];
                    $youtube_link       = $_POST['youtube_Link'];
                    
    
                    // validate the FORM

                    $formERRORS = array();
    
                    if(empty($name)){
                        $formERRORS[] = '<div class="alert alert-danger">Name Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($desc)){
                        $formERRORS[] = '<div class="alert alert-danger">Description Cant be <strong>Empty</strong>  </div>';
    
                    }
    
                    if(empty($price)){
                        $formERRORS[] = '<div class="alert alert-danger">Price Cant be <strong>Empty</strong> </div>';
                    }
    
                    if(empty($country)){
    
                        $formERRORS[] = '<div class="alert alert-danger">Country Cant be <strong>Empty</strong> </div>';
                    }
    
                    if($status == 0){
    
                        $formERRORS[] = '<div class="alert alert-danger">You must choose the <strong>Status</strong> ';
                    }

                    if($member == 0){
    
                        $formERRORS[] = '<div class="alert alert-danger">You must choose the <strong>The Memeber</strong> ';
                    }

                    if($cat == 0){
    
                        $formERRORS[] = '<div class="alert alert-danger">You must choose the <strong>Category</strong> ';
                    }
                    if(empty($avatar) && empty($youtube_link)){
    
                        $formERRORS[] = '<div class="alert alert-danger">You must choose the <strong>Photo</strong> ';
                    }
                    // loop into errors Array And Echo It
    
                    foreach($formERRORS as $error){
                        echo $error;
                    }
    
                    // check if there is no error Update the database
    
                    if(empty($formERRORS)){
                        //Insert User Info in data base
    
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
                                                    avatar,
                                                    youtube_Link
                                                    
                                                    )
                                    VALUES (:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember, :ztags, :zavatar, :zyoutube_link)");
                            $stmt->execute(array(
                                'zname'     =>$name,
                                'zdesc'     =>$desc,
                                'zprice'    =>$price,
                                'zcountry'  =>$country,
                                'zstatus'   =>$status,
                                'zcat'      =>$cat,
                                'zmember'   =>$member,
                                'ztags'     =>$tags,
                                'zavatar'     =>$avatar,
                                'zyoutube_link'=> $youtube_link    
                                
                                
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
            $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ? ");

            // excure query
            $stmt->execute(array($itemid));

            // bring the data

            $item = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such id show the form

            if($count > 0) { ?>

                <h1 class="text-center"> Edit Summary </h1>

                <div class="container">
                    <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="itemid" value="<?php echo $itemid ?>" />
                        <!-- Start Name filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type        ="text" 
                                    name        ="name" 
                                    class       ="form-control" 
                                    required    ='required' 
                                    placeholder ="Name of the Item"
                                    value="<?php echo $item['Name'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End Name filed -->

                        <!-- Start Description filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type="text" 
                                    name="description"
                                    required    ='required' 
                                    class="form-control" 
                                    placeholder="Description OF The Item"
                                    value="<?php echo $item['Description'];?>"/>
                                
                            </div>  
                        </div>
                        <!-- End Description filed -->

                        <!-- Start price filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Number</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type="text" 
                                    name="price" 
                                    required   ='required'
                                    class="form-control" 
                                    placeholder="price OF The Item"
                                    value="<?php echo $item['Price'];?>"/>
                                
                            </div>  
                        </div>
                        <!-- End price filed -->

                        <!-- Start Country filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Drive Link</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type="text" 
                                    name="country" 
                                    required  ='required'
                                    class="form-control" 
                                    placeholder="Country OF Made"
                                    value="<?php echo $item['Country_Made'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End Country filed -->

                        <!-- Start youtube_Link filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">youtube_Link</label>
                            <div class="col-sm-10 col-md-4">
                                <input 
                                    type="text" 
                                    name="youtube_Link" 
                                    class="form-control" 
                                    placeholder="youtube_Link"
                                    value="<?php echo $item['youtube_Link'];?>" />
                                
                            </div>  
                        </div>
                        <!-- End youtube_Link filed -->

                        <!-- Start Status filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-10 col-md-4">
                                <select  name="status" required    ='required'>
                                        
                                        <option value="1"<?php if($item['Status'] == 1){echo 'selected';} ?>>1</option>
                                        <option value="2" <?php if($item['Status'] == 2){echo 'selected';} ?>>2</option>
                                        <option value="3" <?php if($item['Status'] == 3){echo 'selected';} ?>>3</option>
                                        <option value="4" <?php if($item['Status'] == 4){echo 'selected';} ?>>4</option>
                        </select>

                                
                            </div>  
                        </div>
                        <!-- End Status filed -->

                        <!-- Start Members filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Member</label>
                            <div class="col-sm-10 col-md-4">
                                <select  name="member" required    ='required'>
                                        
                                        <?php
                                            $stmt = $con->prepare("SELECT * FROM users");
                                            $stmt->execute();
                                            $users = $stmt->fetchAll();
                                            foreach($users as $user){
                                                echo "<option value='" . $user['UserID'] . "'"; 
                                                if ($item['Member_ID'] == $user['UserID']){echo 'selected';} 
                                                echo ">"   .  $user['UserName'] . "</option>";
                                            }


                                        ?>
                        </select>

                                
                            </div>  
                        </div>
                        <!-- End Members filed -->



                        <!-- Start Categories filed -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10 col-md-4">
                                <select  name="category" required    ='required'>
                                        
                                        <?php
                                            $stmt2 = $con->prepare("SELECT * FROM Categories");
                                            $stmt2->execute();
                                            $cats = $stmt2->fetchAll();
                                            foreach($cats as $cat){
                                                echo "<option value='" . $cat['ID'] . "'";
                                                if ($item['Cat_ID'] == $cat['ID']){echo 'selected';}
                                                echo">" .  $cat['Name'] . "</option>";
                                            }


                                        ?>
                        </select>

                                
                            </div>  
                        </div>
                        <!-- End Categories filed -->

                        <!-- Start Item Photo -->
                        <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Item Photo</label>
                                <div class="col-sm-10 col-md-4">
                                    <select class="options" name="avatar">
                                        <option value="">...</option>
                                        <option value="pdf.png" <?php if($item['avatar'] == "pdf.png"){echo 'selected';} ?>>pdf.png</option>
                                        <option value="youtube.png"<?php if($item['avatar'] == "youtube.png"){echo 'selected';} ?>>youtube.png</option>
                                        <option value="corsers.jpg"<?php if($item['avatar'] == "corsers.jpg"){echo 'selected';} ?>>corsera.jpg</option>
                                        <option value="udemy.png"<?php if($item['avatar'] == "udemy.png"){echo 'selected';} ?>>udemy.jpg</option>
                                    </select>


                                </div>
                            </div>
                    <!-- End Item Photo filed -->

                        <!-- Start Tags filed -->
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Tags</label>
                                <div class="col-sm-10 col-md-4">
                                    <input 
                                        type="text" 
                                        name="tags" 
                                        class="form-control" 
                                        placeholder="Seprate Tags With Comma(,)" 
                                        value="<?php  echo $item['tags'] ?>"/>
                                    
                                </div>  
                            </div>

                        <!-- Start Submit filed -->
                        <div class="form-group form-group-lg">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="Submit" value="Save Item"  class="btn btn-primary btn-sm" />
                            </div>  
                        </div>
                        <!-- End Submit filed -->

                    </form>

                    <?php
                    // select all user except admin
        
        $stmt = $con->prepare("SELECT 
                                    comments.*,users.UserName AS Member
                                FROM 
                                    comments
                                INNER JOIN 
                                    users
                                ON
                                    users.UserID = comments.user_id
                                WHERE 
                                    item_id = ?");

        // execute to the statment
        $stmt->execute(array($itemid));

        // assign data come to a variable

        $rows = $stmt->fetchAll();

        if(! empty($rows)){
        
        
        
        ?>

            <h1 class="text-center"> Manage  [ <?php echo $item['Name'];?> ] Comments</h1>
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                            <td>Comment</td>
                            <td>User Name</td>
                            <td>Added Date</td>
                            <td>Control</td>
                        </tr>
                        <?php

                        foreach($rows as $row){
                            echo "<tr>";
                                echo "<td>". $row['comment'] . "</td>";
                                echo "<td>". $row['Member'] . "</td>";
                                echo "<td>". $row['comment_date'] . "</td>";
                                echo "<td> 
                                <a href='comments.php?do=edit&comid=" . $row['c_id'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                                <a href='comments.php?do=Delete&comid=" . $row['c_id'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                                if($row['status'] == 0){

                                    echo "
                                    <a href='comments.php?do=Approve&comid=" . 
                                    $row['c_id'] . "'class='btn btn-info activate '>
                                    <i class='fa fa-check'></i> Approve </a>";
                                }
                                echo"</td>";
                                echo "</tr>";
                        }
                        ?>
                        <tr>
                    </table>
                </div>
                <?php } ?>
            </div>


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
            echo "<h1 class='text-center'>Update Item </h1>";
            echo "<div class='container'>";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Get the variables from the form

                $id       = $_POST['itemid'];
                $name     = $_POST['name'];
                $desc     = $_POST['description'];
                $price    = $_POST['price'];
                $country  = $_POST['country'];
                $status   = $_POST['status'];
                $member   = $_POST['member'];
                $cat      = $_POST['category'];
                $tags     = $_POST['tags'];
                $avatar     = $_POST['avatar'];
                $youtube_Link     = $_POST['youtube_Link'];


                            // validate the FORM

                            $formERRORS = array();

                            if(empty($name)){
                                $formERRORS[] = '<div class="alert alert-danger">Name Cant be <strong>Empty</strong> </div>';
            
                            }
                            if(empty($desc)){
                                $formERRORS[] = '<div class="alert alert-danger">Description Cant be <strong>Empty</strong>  </div>';
            
                            }
            
                            if(empty($price)){
                                $formERRORS[] = '<div class="alert alert-danger">Price Cant be <strong>Empty</strong> </div>';
                            }
            
                            if(empty($country)){
            
                                $formERRORS[] = '<div class="alert alert-danger">Country Cant be <strong>Empty</strong> </div>';
                            }
            
                            if($status == 0){
            
                                $formERRORS[] = '<div class="alert alert-danger">You must choose the <strong>Status</strong> ';
                            }
        
                            if($member == 0){
            
                                $formERRORS[] = '<div class="alert alert-danger">You must choose the <strong>The Memeber</strong> ';
                            }
        
                            if($cat == 0){
            
                                $formERRORS[] = '<div class="alert alert-danger">You must choose the <strong>Category</strong> ';
                            }
                            if(empty($avatar) && empty($youtube_Link)){
            
                                $formERRORS[] = '<div class="alert alert-danger">You must choose the <strong>Photo</strong> ';
                            }
                            // loop into errors Array And Echo It
            
                            foreach($formERRORS as $error){
                                echo $error;
                            }

                // check if there is no error Update the database

                if(empty($formERRORS)){


                //Update the database with this info

                $stmt = $con->prepare("UPDATE 
                                            items 
                                        SET
                                            Name        =?, 
                                            Description =?, 
                                            price       = ?, 
                                            Country_Made= ?,
                                            Status      = ?,
                                            Cat_ID      = ?,
                                            Member_ID   = ?,
                                            tags        = ?,
                                            avatar      = ?,
                                            youtube_Link= ?
                                        WHERE 
                                            Item_ID = ?");
                $stmt->execute(array($name, $desc, $price, $country, $status, $cat, $member,$tags,$avatar,$youtube_Link, $id));

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
                        echo "<h1 class='text-center'>  Delete Item </h1>";
                        echo "<div class='container'>";

                        // check if get request ItemID is numeric & get the integer value of it

                        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'] ) ?intval ($_GET['itemid']): 0 ;

                        // check if there is an id as sent or not 

                        $check = checkItem('Item_ID','items', $itemid);

                        // if there is such id show the form

                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zid");
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

            // check if get request itemid is numeric & get the integer value of it

            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'] ) ?intval ($_GET['itemid']): 0 ;

            // check if there is an id as sent or not 

            $check = checkItem('Item_ID','items', $itemid);

            // if there is such id show the form

        if($check > 0) { 
            $stmt = $con->prepare("UPDATE items SET Approve=1 Where Item_ID = ?");

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

