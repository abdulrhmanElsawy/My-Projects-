<?php
    session_start();
    include 'init.php';
?>

<div class="container">

    <h1 class="text-center">

    <?php $CatNameCat = getAllFrom("Name", "categories" , "where ID = {$_GET['pageid']} ", "", "ID" );
    foreach ($CatNameCat as $Cat){
        echo $Cat['0'];
    }
    ?>
</h1>
    <div class="row">
            <?php
            if (isset($_GET['pageid']) && is_numeric($_GET['pageid'])) {
                $allItems = getAllFrom("*", "items", "where Cat_ID = {$_GET['pageid']}", "AND Approve = 1", "Item_ID", "ASC");
                foreach ($allItems as $item) {
                    
                    echo '<div class="col-sm-6 col-md-3">';
                    echo '<div class="thumbnail item-box download">';
                    echo ' <span class="price-tag"> ' . $item['Price']  .  ' </span> ';
                    if(empty ($item['youtube_Link'])){
                        
                    echo ' <a href="' . $item['Country_Made'] . '"target="_blank"><img class="img-responsive" src="admin/uploads/avatars/' ; 
                    echo $item['avatar'];
                    echo  '" alt=""/></a>';
                        }else{
                            echo '<iframe class="img-responsive" width="100%" height="100%" src="https://www.youtube.com/embed/'. $item['youtube_Link'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        }
                    
                    echo '<div class="caption">';
                    echo '<h3> <a href="items.php?itemid=' . $item['Item_ID'] . '">' . $item['Name']  . '</a></h3>';
                    echo '<p>' . $item['Description']  . '</p>';
                    echo '<div class="date">' . $item['Add_Date']  . '</div>';
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

