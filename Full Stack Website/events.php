<?php
    session_start();
    include 'init.php';
?>

<div class="container">

    <h1 class="text-center">
    Events
</h1>
    <div class="row">
            <?php
            // if (isset($_GET['pageid']) && is_numeric($_GET['pageid'])) {
                $allItems = getAllFrom("*", "events", "where Status = 1", "", "Event_ID");
                
                foreach ($allItems as $item) {

                    echo '<div class="col-sm-6 col-md-3">';
                    echo '<div class="thumbnail item-box download">';
                    echo ' <a href="' ;
                    if(!empty($item['Youtube_Vid'])){
                        echo $item['Youtube_Vid'];
                    }else{
                        echo "event.php?itemid=" . $item['Event_ID'] . "";
                    }
                    echo '"target="_blank"><img class="img-responsive" src="admin/uploads/avatars/' . $item['avatar'] . '" alt=""/></a>';
                    echo '<div class="caption">';
                    echo '<h3> <a href="event.php?itemid=' . $item['Event_ID'] . '">' . $item['Name']  . '</a></h3>';
                    echo '<p>' . $item['Description']  . '</p>';
                    echo '<div class="date">' . $item['Add_Date']  . '</div>';
                    echo'</div>';
                    echo '</div>';
                    echo '</div>';
                }
            // }else{
            //     echo '<span style="color:red">You Did Not Choose A correct Page Id</span>';
            // }
        ?>
    </div>
</div>




<?php include  $tpl ."footer.php"; ?>

