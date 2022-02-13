<?php
    session_start();
    include 'init.php';
?>



<?php $allarticles = getAllFrom("*", "articles","", "","id"); 
if(!empty($allarticles)){
    echo '<h1 style="text-align:center;letter-spacing:10px;"> Articles </h1>';
    foreach($allarticles as $article){


?>

<div class="article">
    <div class="container">
        <div class="article-header">
            <span class="source">Source : <a
                    href="<?php echo $article['sourcelink'] ?>"><?php echo $article['source'] ?></a></span><span
                class="writer-name">Writer : <?php echo $article['writer'] ?>
            </span><img style="width:50px;" class="writer-image" src="Writers/<?php echo $article['image'] ?>">
        </div>
        <div style="direction: <?php echo $article['direction'] ?>;" class="article-body">
            <p>
                <?php echo $article['article'] ?>

            </p>
        </div>
        <div class="article-name">
            <h1><?php echo $article['header'] ?> <i class="fa fa-chevron-down" aria-hidden="true"></i></h1>
        </div>


    </div>

</div>

<?php

}
}else{
    echo '<h1 style="text-align:center;letter-spacing:10px;"> No Articles Yet</h1>';

} ?>










<?php include  $tpl ."footer.php"; ?>