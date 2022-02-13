<?php


    // Items page


    ob_start();

    session_start();

    $pageTitle = 'Articles';

    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $do = isset($_GET['do'])? $_GET ['do']:'manage';

        if($do == 'manage'){
            // manage articles page 

            
        
        $stmt = $con->prepare("SELECT 
                                * 
                                FROM articles 
        ORDER BY id ASC");

        // execute to the statment
        $stmt->execute();

        // assign data come to a variable

        $articles = $stmt->fetchAll();
        
            if (! empty($articles)){
        
        ?>

<h1 class="text-center"> Manage articles</h1>
<div class="container">
    <div class="table-responsive">
        <table class="main-table text-center table table-bordered">
            <tr>
                <td>#ID</td>
                <td>Source</td>
                <td>Writer Name</td>
                <td>Writer image</td>
                <td>Article head</td>
                <td>Article</td>
                <td>direction</td>
                <td>Source Link</td>
            </tr>
            <?php

                        foreach($articles as $article){
                            echo "<tr>";
                                echo "<td>". $article['id'] . "</td>";
                                echo "<td>". $article['source'] . "</td>";
                                echo "<td>". $article['writer'] . "</td>";
                                echo "<td>". $article['image'] . "</td>";
                                echo "<td>". $article['header'] . "</td>";
                                echo "<td>". $article['article'] . "</td>";
                                echo "<td>". $article['direction'] . "</td>";
                                echo "<td>". $article['sourcelink'] . "</td>";
                                echo "<td> 
                                <a href='articles.php?do=Edit&id=" . $article['id'] . "' class=' btn btn-success'><i class='fa fa-edit'></i> Edit </a>
                                <a href='articles.php?do=Delete&id=" . $article['id'] . "' class=' btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
                                echo"</td>";
                                echo "</tr>";
                        }

                        ?>

            <tr>
        </table>
    </div>
    <a href="articles.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New article</a>

</div>

<?php }else {
            echo '<div class="container">';
                echo "<div class='nice-message'>There Is No articles To Show</div>";
                echo '<a href="articles.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New article</a>';
            echo '</div>';
        }

        }elseif($do == 'Add'){ ?>
<h1 class="text-center"> Add new article </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Insert" method="POST">

        <!-- Start source filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">source</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="source" class="form-control" required='required'
                    placeholder="The Article Source Name" />

            </div>
        </div>
        <!-- End source filed -->

        <!-- Start writer filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">writer</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="writer" class="form-control" required='required'
                    placeholder="The Writer Name" />

            </div>
        </div>
        <!-- End writer filed -->


        <!-- Start image filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">image</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="image" class="form-control" required='required'
                    placeholder="The Writer Image" />

            </div>
        </div>
        <!-- End image filed -->

        <!-- Start header filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">header</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="header" class="form-control" required='required'
                    placeholder="The Article header" style="height:300px" ;></textarea>

            </div>
        </div>
        <!-- End header filed -->

        <!-- Start article filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">article</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="article" class="form-control" required='required' placeholder="The Article "
                    style="height:300px" ;></textarea>

            </div>
        </div>
        <!-- End article filed -->

        <!-- Start direction filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Text Direction</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="direction" class="form-control" required='required' placeholder="rtl / ltr" />

            </div>
        </div>
        <!-- End direction filed -->

        <!-- Start Source Link filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Source Link</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="sourcelink" class="form-control" autocomplete="off"
                    placeholder="Source Link" />


            </div>
        </div>
        <!-- End Source Link filed -->




        <!-- Start Add article Button filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Add article" class="btn btn-primary btn-sm" />
            </div>
        </div>
        <!-- End Add article Button filed -->

    </form>
</div>



<?php


        }elseif($do == 'Insert'){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                echo "<h1 class='text-center'>Insert article </h1>";
                echo "<div class='container'>";
    
                    // Get the variables from the form
    
                    $source       = $_POST['source'];
                    $writer       = $_POST['writer'];
                    $image        = $_POST['image'];
                    $header       = $_POST['header'];
                    $article      = $_POST['article'];
                    $direction    = $_POST['direction'];
                    $sourcelink   = $_POST['sourcelink'];

                
                    // validate the FORM

                    $formERRORS = array();
    
                    if(empty($source)){
                        $formERRORS[] = '<div class="alert alert-danger">source Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($writer)){
                        $formERRORS[] = '<div class="alert alert-danger">writer Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($image)){
                        $formERRORS[] = '<div class="alert alert-danger">image Cant be <strong>Empty</strong> </div>';
    
                    }
                    
                    if(empty($header)){
                        $formERRORS[] = '<div class="alert alert-danger">header Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($article)){
                        $formERRORS[] = '<div class="alert alert-danger">article Cant be <strong>Empty</strong> </div>';
    
                    }

                    if(empty($direction)){
                        $formERRORS[] = '<div class="alert alert-danger">Direction Can Not Be <strong>Empty</strong></div>';
                    }
                    if(empty($sourcelink)){
                        $formERRORS[] = '<div class="alert alert-danger">sourcelink Can Not Be <strong> Empty </strong></div>';
                    }

                    // loop into errors Array And Echo It
                    foreach($formERRORS as $error){
                        echo $error;
                    }
    
                    // check if there is no error Update the database
    
                    if(empty($formERRORS)){
                        //Insert User Info in data base

                        $stmt = $con->prepare("INSERT
                                                    INTO articles
                                                    ( source,
                                                    writer,
                                                    image,
                                                    header,
                                                    article,
                                                    direction,
                                                    sourcelink
                                                    )
                                    VALUES (:zsource, :zwriter, :zimage, :zheader, :zarticle, :zdirection, :zsourcelink)");
                            $stmt->execute(array(
                                'zsource'       =>$source,
                                'zwriter'       =>$writer,
                                'zimage'        =>$image,
                                'zheader'       =>$header,
                                'zarticle'      =>$article,
                                'zdirection'    =>$direction,
                                'zsourcelink'   =>$sourcelink

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

            $id = isset($_GET['id']) && is_numeric($_GET['id'] ) ?intval ($_GET['id']): 0 ;
            // select all data depend on this id 
            $stmt = $con->prepare("SELECT * FROM articles WHERE id = ? ");

            // excure query
            $stmt->execute(array($id));

            // bring the data

            $article = $stmt->fetch();

            // The Row count

            $count = $stmt->rowCount();

            // if there is such id show the form

            if($count > 0) { ?>

<h1 class="text-center"> Edit article </h1>

<div class="container">
    <form class="form-horizontal" action="?do=Update" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>" />
        <!-- Start source filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">source</label>
            <div class="col-sm-10 col-md-4">
                <input value="<?php echo $article['source'] ?>" type="text" name="source" class="form-control"
                    required='required' placeholder="The Article Source Name" />

            </div>
        </div>
        <!-- End source filed -->

        <!-- Start writer filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">writer</label>
            <div class="col-sm-10 col-md-4">
                <input value="<?php echo $article['writer'] ?>" type="text" name="writer" class="form-control"
                    required='required' placeholder="The Writer Name" />

            </div>
        </div>
        <!-- End writer filed -->


        <!-- Start image filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">image</label>
            <div class="col-sm-10 col-md-4">
                <input value="<?php echo $article['image'] ?>" type="text" name="image" class="form-control"
                    required='required' placeholder="The Writer Image" />

            </div>
        </div>
        <!-- End image filed -->

        <!-- Start header filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">header</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="header" class="form-control" required='required'
                    placeholder="The Article header" style="height:300px" ;>
                    <?php echo $article['header'] ?>
                </textarea>

            </div>
        </div>
        <!-- End header filed -->

        <!-- Start article filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">article</label>
            <div class="col-sm-10 col-md-4">
                <textarea type="text" name="article" class="form-control" required='required' placeholder="The Article "
                    style="height:300px" ;>
                    <?php echo $article['article'] ?>
                
                </textarea>

            </div>
        </div>
        <!-- End article filed -->

        <!-- Start direction filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Text Direction</label>
            <div class="col-sm-10 col-md-4">
                <input value="<?php echo $article['direction'] ?>" type="text" name="direction" class="form-control"
                    required='required' placeholder="rtl / ltr" />

            </div>
        </div>
        <!-- End direction filed -->

        <!-- Start Source Link filed -->
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Source Link</label>
            <div class="col-sm-10 col-md-4">
                <input value="<?php echo $article['sourcelink'] ?>" type="text" name="sourcelink" class="form-control"
                    autocomplete="off" placeholder="Source Link" />


            </div>
        </div>
        <!-- End Source Link filed -->



        <!-- Start Submit filed -->
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="Submit" value="Save article" class="btn btn-primary btn-sm" />
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
            echo "<h1 class='text-center'>Update article </h1>";
            echo "<div class='container'>";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Get the variables from the form

                    $id           = $_POST['id'];
                    $source       = $_POST['source'];
                    $writer       = $_POST['writer'];
                    $image        = $_POST['image'];
                    $header       = $_POST['header'];
                    $article      = $_POST['article'];
                    $direction    = $_POST['direction'];
                    $sourcelink   = $_POST['sourcelink'];

                
                    // validate the FORM

                    $formERRORS = array();
    
                    if(empty($source)){
                        $formERRORS[] = '<div class="alert alert-danger">source Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($writer)){
                        $formERRORS[] = '<div class="alert alert-danger">writer Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($image)){
                        $formERRORS[] = '<div class="alert alert-danger">image Cant be <strong>Empty</strong> </div>';
    
                    }
                    
                    if(empty($header)){
                        $formERRORS[] = '<div class="alert alert-danger">header Cant be <strong>Empty</strong> </div>';
    
                    }
                    if(empty($article)){
                        $formERRORS[] = '<div class="alert alert-danger">article Cant be <strong>Empty</strong> </div>';
    
                    }

                    if(empty($direction)){
                        $formERRORS[] = '<div class="alert alert-danger">Direction Can Not Be <strong>Empty</strong></div>';
                    }
                    if(empty($sourcelink)){
                        $formERRORS[] = '<div class="alert alert-danger">sourcelink Can Not Be <strong> Empty </strong></div>';
                    }
                            // loop into errors Array And Echo It
            
                            foreach($formERRORS as $error){
                                echo $error;
                            }

                // check if there is no error Update the database

                if(empty($formERRORS)){

                //Update the database with this info

                $stmt = $con->prepare("UPDATE 
                                            articles
                                        SET
                                        source     =?,
                                        writer      =?,
                                        image     =?,
                                        header      =?,
                                        article     =?,
                                        direction     =?,
                                        sourcelink         =?

                                        WHERE 
                                            id = ?");
                $stmt->execute(array($source, $writer, $image, $header, $article, $direction, $sourcelink, $id));


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
                        echo "<h1 class='text-center'>  Delete article </h1>";
                        echo "<div class='container'>";

                        // check if get request ItemID is numeric & get the integer value of it

                        $id = isset($_GET['id']) && is_numeric($_GET['id'] ) ?intval ($_GET['id']): 0 ;

                        // check if there is an id as sent or not 

                        $check = checkItem('id','articles', $id);

                        // if there is such id show the form

                    if($check > 0) { 
                        $stmt = $con->prepare("DELETE FROM articles WHERE id = :zid");
                        $stmt->bindParam(":zid" , $id);
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