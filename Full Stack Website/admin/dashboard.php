<?php

    ob_start();  //out put buffering start

    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle = 'Dashboard';

        include 'init.php';
        // start dashboard page
        $numUsers = 5;
        $latestUsers = getLatest("*", "users", "UserID" , $numUsers);

        $numItems =5; //number of latest items
        $latestItems = getLatest("*", 'items' , 'Item_ID', $numItems);  // Latest Item Array

            $numComments = 5; //Number Of Comments

        ?>
<div class="container home-stats text-center">
    <h1> Dashboard </h1>
    <div class="row">
        <div class="col-md-3">
            <div class="stat st-members">
                <i class="fa fa-users"></i>
                <div class="info">
                    Total Members
                    <span>
                        <a href="members.php"><?php echo countItems('UserID' ,'users');  ?></a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat st-pending">
                <i class="fa fa-user-plus"></i>
                <div class="info">
                    pending Members
                    <span><a href="members.php?do=manage&page=Pending">
                            <?php echo checkItem("RegStatus", "users", 0); ?>
                        </a></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat st-items">
                <i class="fa fa-tag"></i>
                <div class="info">
                    Total items
                    <span><a href="items.php"><?php echo countItems('Item_ID' ,'items');  ?></a></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat st-comments">
                <i class="fa fa-comments"></i>
                <div class="info">
                    Total Comments
                    <span>
                        <a href="comments.php"><?php echo countItems('c_id' ,'comments');  ?></a></span>
                </div>
            </div>
        </div>

    </div>



</div>

<div class="container latest">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-users"></i>Latest <?php echo $numUsers ?> Registerd Users
                    <span class=" toggle-info pull-right">
                        <i class="fa fa-minus fa-lg"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled latest-users">
                        <?php     
                        if(! empty($latestUsers)){
                        
                        foreach($latestUsers as $user){

                            echo '<li>'; 
                                echo $user['UserName'] ; 
                                echo '<a href="members.php?do=edit&userid='. $user ['UserID'] . '">';
                                    echo '<span class="btn btn-success pull-right">'; 
                                        echo '<i class="fa fa-edit"></i> Edit '; 
                                        if($user['RegStatus'] == 0){

                                        echo "<a href='members.php?do=Activate&userid=" . $user['UserID'] . "'class='btn btn-info pull-right  activate '><i class='fa fa-check'></i> Activate </a>";
                                        }
                                    echo '</span>';
                                echo '</a>';
                            echo '</li>';
                        }
                    }else{
                        echo "There Is NO users to show";
                    }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-tag"></i>Latest <?php echo $numItems ?> Items
                    <span class=" toggle-info pull-right">
                        <i class="fa fa-minus fa-lg"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled latest-users">
                        <?php
                    
                        if(! empty($latestItems)){

                        
                        foreach($latestItems as $item){

                            echo '<li>'; 
                                echo $item['Name'] ; 
                                echo '<a href="items.php?do=Edit&itemid='. $item ['Item_ID'] . '">';
                                    echo '<span class="btn btn-success pull-right">'; 
                                        echo '<i class="fa fa-edit"></i> Edit '; 
                                        if($item['Approve'] == 0){

                                        echo "<a href='items.php?do=Approve&itemid=" . $item['Item_ID'] . "'class='btn btn-info pull-right  activate '><i class='fa fa-check'></i> Approve </a>";
                                        }
                                    echo '</span>';
                                echo '</a>';
                            echo '</li>';
                        }
                    }else{
                        echo ' There is No Items to show';
                    }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Latest Comments -->
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-comments-o"></i>
                    Latest <?php echo $numComments ?> Comments
                    <span class=" toggle-info pull-right">
                        <i class="fa fa-minus fa-lg"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <?php

                                    $stmt = $con->prepare("SELECT 
                                                                comments.*,users.UserName AS Member
                                                            FROM 
                                                                comments
                                                        INNER JOIN 
                                                                users
                                                        ON
                                                            users.UserID = comments.user_id
                                                        ORDER BY
                                                            c_id DESC
                                                        LIMIT $numComments");

                                    // execute to the statment
                                    $stmt->execute();
                                    $comments = $stmt->fetchAll();
                                    if(! empty($comments)){

                                    foreach($comments as $comment){
                                        echo '<div class="comment-box">';
                                            echo '<span class="member-n">' .  $comment['Member'] . '</span>';
                                            echo '<p class="member-c">' .  $comment['comment'] . '</span>';
                                        echo"</div>";
                                    }
                                }else{
                                    echo 'There Is No Comments To Show';
                                }
                            ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Latest Comments -->
</div>
</div>

<div class="container">
    <h1>Push Notifactions</h1>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2">
            <div class="summary btn btn-primary">new Summary</div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2">
            <button class="program btn btn-primary">new program</button>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2">
            <button class="post btn btn-primary">new Post</button>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2">
            <button class="event btn btn-primary">new Event</button>
        </div>
    </div>
</div>
<br>

<?php



        // end dashboard page

        include  $tpl ."footer.php";

}else{
    header ('location: index.php');
    exit();
}

ob_end_flush();
?>