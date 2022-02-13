<?php
    session_start();
    include 'init.php';
?>

<div class="container">

    <h1 class="text-center">
    Shop
</h1>
    <div class="row">
            <?php
            // if (isset($_GET['pageid']) && is_numeric($_GET['pageid'])) {
                $allItems = getAllFrom("*", "shopitems", "", "", "item_id");
                
                foreach ($allItems as $item) {

                    echo '<div class="col-sm-6 col-md-3">';
                    echo '<div class="thumbnail item-box T-shirt">';
                    echo '<img class="shop-item" src="shopitemsphotos/' . $item['item_photo'] . '" alt=""/>';
                    echo '<div class="hover-item">
                    <h1>All sizes avalibale</h1>
                    <span>S</span><span>M</span><span>L</span><span>XL</span><span>XXL</span><span>3XL</span>
                    <h2><a href="https://www.facebook.com/Code-Pioneers-112644434401569" target="_blank">Buy Now</a></h2>
                    </div>';
                    echo '<div class="caption">';
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

