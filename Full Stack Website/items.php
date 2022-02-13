<?php
    ob_start();

    session_start();

    $pageTitle = 'Show Items';

    include 'init.php';

    // check if get request item is numeric & get the integer value of it

    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'] ) ?intval ($_GET['itemid']): 0 ;
    // select all data depend on this id 
    $stmt = $con->prepare("SELECT 
                                items.*, categories.Name AS category_name,
                                users.UserName
                            FROM 
                                items 
                            INNER JOIN  
                                categories
                            ON
                                categories.ID = items.Cat_ID
                            INNER JOIN  
                                users
                            ON
                                users.UserID = items.Member_ID
                            WHERE
                                Item_ID =?
                            AND
                                Approve = 1");
    // excure query
    $stmt->execute(array($itemid));

    $count = $stmt->rowCount();
    if ($count >0){

    // bring the data
    $item = $stmt->fetch();

?>

        <h1 class="text-center"><?php echo $item['Name'] ?></h1>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="img-responsive img-thumbnail center-block" src="img.jpg" alt=""/>
                </div>
                <div class="col-md-9 item-info">
                    <h2><?php echo $item['Name'] ?></h2>
                    <p><?php echo $item['Description'] ?></p>
                    <ul class="list-unstyled">
                    <li>
                        <i class="fa fa-calendar fa-fw"></i>
                        <span>Added Date</span><?php echo $item['Add_Date'] ?>
                    </li>
                    <li>
                        <i class="fa fa-money fa-fw"></i>
                        <span>Lecture Number: </span><?php echo $item['Price'] ?>
                    </li>
                    <li>
                        <i class="fa fa-building fa-fw"></i>
                        <span>Drive Link: </span><a href ="<?php echo $item['Country_Made'] ?>" target="_blank"><?php echo $item['Country_Made'] ?> </a>
                    </li>
                    <li>
                        <i class="fa fa-tags fa-fw"></i>
                        <span>Category </span><a href="categories.php?pageid=<?php echo $item['Cat_ID']?>"><?php echo $item['category_name']; ?></a>
                    </li>
                    <li>
                        <i class="fa fa-user fa-fw"></i>
                        <span>Added By:</span> <a href="#"> <?php echo $item['UserName']; ?></a>
                    </li>
                    <li>
                        <i class="fa fa-user fa-fw"></i>
                        <span>Tags</span>
                        <?php
                        $allTags = explode(",", $item['tags']);
                        foreach($allTags as $tag){
                            
                            $tag = str_replace(' ', '', $tag);
                            $tag = strtolower($tag);
                            if (! empty($tag)) {
                                echo "<a class='tags' href='tags.php?name={$tag}'>" .  $tag . ' </a>  ';
                            }
                            
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="custom-hr">
        <?php if(isset($_SESSION['user'])){?>
        <!-- Start Add Comment SeCTION -->
        <div class="row">
        <div class="col-md-offset-3">
            <div class="add-comment">
            <h3>Add Your Comment</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['Item_ID']?>" method="POST">
                <textarea name="comment" required="required"></textarea>
                <input class="Add-comment-btn btn btn-primary" type="submit" value="Add Comment">
            </form>
            <?php 
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $comment    = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                    $itemid     = $item['Item_ID'];
                    $userid     = $_SESSION['uid'];
                    

                    if(! empty ($comment)){

                        $stmt = $con->prepare("INSERT INTO 
                                                    comments(comment, status, comment_date, item_id,user_id)
                                                VALUES(:zcom, 0, NOW(), :zid, :zuidd)");
                        $stmt -> execute(array(

                            'zcom' => $comment,
                            'zid'  => $itemid,
                            'zuidd'=> $userid
                            
                        ));

                        if($stmt){
                            echo '<div class="alert alert-success">One Comment Added</div>';
                        }
                    }
                }
            ?>
        </div>
        </div>
        </div>
        <!-- End Add Comment SeCTION -->
        <?php } else{
            echo ' <a href="login.php">Login</a> or <a href="login.php">Register</a> To Add Comment';

        }?>
        <hr class="custom-hr">
        <?php

                // select all user except admin

                $stmt = $con->prepare("SELECT 
                comments.*, users.UserName AS Member
                FROM 
                comments
                INNER JOIN 
                users
                ON
                users.UserID = comments.user_id
                WHERE 
                item_id = ?
                AND
                status = 1
                ORDER BY 
                c_id DESC");

                // execute to the statment
                $stmt->execute(array($item['Item_ID']));

                // assign data come to a variable

                $comments = $stmt->fetchAll();

                ?>
        <div class="row">
            <?php 
                foreach($comments as $comment){ ?>
                    <div class="comment-box">
                    <div class="row"> 
                        <div class="col-sm-2 text-center">
                                <img class="img-responsive img-thumbnail img-circle center-block" src="img.jpg" alt=""/>
                                <?php echo $comment['Member']; ?>
                        </div>
                        <div class="col-sm-10">
                            <p class="lead"><?php  echo $comment['comment']; ?></p>
                        </div>
                    </div>
                </div>
                <hr class="custom-hr">

                    <?php } ?>
            
            </div>
        </div>
    
    <?php
    }else{
        echo "<div class='container'>";
            echo "<div class='alert alert-danger'> There Is NO Such ID Or This Item is waiting to be <strong>Approved</strong></div>";
        echo "</div>";

        
    }

    include $tpl . 'footer.php';

    ob_end_flush();

?>