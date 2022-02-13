<?php
    session_start();
    include 'init.php';
?>

<div class="container">

    <h1 class="text-center">

    Tutorials
</h1>
    <div class="row">
            <?php
            if (isset($_GET['toturialID']) && is_numeric($_GET['toturialID'])) {
                $allItems = getAllFrom("*", "udemycourses", "where toturial_ID = {$_GET['toturialID']}", "", "course_ID", "ASC");
                foreach ($allItems as $item) {
                    
                    echo '<div class="col-sm-6 col-md-3">';
                    echo '<div class="thumbnail item-box download">';

                    echo ' <a href="' . $item['Drive_Link'] . '"target="_blank"><img class="img-responsive" src="tutorielsimages/coursesimages/' ; 
                    echo $item['avatar'];
                    echo  '" alt=""/></a>';
                        
                    
                    echo '<div class="caption">';
                    echo '<h3> <a href="' . $item['Drive_Link'] . '">' . $item['Name']  . '</a></h3>';

                    echo'</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }else{
                echo '<span style="color:red">You Did Not Choose A correct Page Id</span>';
            }
        ?>
    </div>
</div>




<?php include  $tpl ."footer.php"; ?>

