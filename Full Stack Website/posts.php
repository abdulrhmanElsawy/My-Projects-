<?php
    session_start();
    include 'init.php';
?>
<?php
$allpostsid = getAllFrom("postid", "posts", "", "", "postid");
foreach ($allpostsid as $postsids) {
    $posttid = $postsids['postid'];
}
echo $posttid;
if (isset($_GET['postlike']) && $_GET['postlike'] == "liked" && isset($_GET['postid']) && in_array($posttid, $allpostsid)) {
    if (!isset($_COOKIE["post_like"])) {
        setcookie("post_like", "liked", time() + (86400 * 365), "/"); // 86400 = 1 day
        $sql = "UPDATE posts SET likes = likes + 1 WHERE id = $posttid";
            $conn->query($sql);
            $conn->close();
            echo "success";
    }else{
        echo "filed";
    }
}else{
    echo "filed2";
}

?>


<div class="post">
    <div class="container">
        <?php
    $allposts = getAllFrom("*", "posts", "", "", "postid");
    if (!empty($allposts)) {
        foreach ($allposts as $post) {
            ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <img class="userphoto" src="teamphotos/<?php echo $post['userphoto']; ?>"><span
                        class="username"><?php echo $post['username']; ?></span>
                    <h3 class="usertitle"><?php echo $post['usertitle']; ?></h3>

                    <p class="hidden-for-more" style="direction: <?php echo $post['direction']; ?>;">
                        <?php echo $post['posttext'];
                        echo '<span class="see-Less">See Less</span>';
                        ?>
                    </p>


                    <?php 
                    if (strlen($post['posttext']) > 160) {
                        $post['posttext'] = substr($post['posttext'],0,160);
                    }
                    
                    ?>

                    <hr>
                    <p class="post-text" style="direction: <?php echo $post['direction']; ?>;"> <?php echo $post['posttext'];
                        if(strlen($post['posttext']) > 150){ 
                            echo '<span class="see-more">See more</span>';

                            }
                
                ?>

                    </p>



                    <?php if(($post['video']) != NULL){
                    echo '<iframe width="100%" height="315" src="' . $post['video'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                }else{
                    echo '<img class="postphoto" src="admin/uploads/posts/' .  $post['postphoto'] . '" alt=""  />';
                } ?>
                    <div class="likes">
                        <a href="?postlike=liked&postid=<?php echo $post['postid']; ?>"><i class="fa fa-thumbs-up"
                                aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
        </div>
        <?php
        }
    }else{
        echo "<div style='text-align:center;'  class='container'>
        <h1 style='color:#fff;font-size:50px;'>No Posts Yet </h1>
        </div>";
    } ?>
    </div>
</div>



<?php include  $tpl ."footer.php"; ?>