<?php
    session_start();
    include 'init.php';
?>

<?php
$questions = getAllFrom("*","questions","","","id");
if (!empty($questions)) {
    foreach ($questions as $question) {
        ?>

<div class="search-bar">
    <div class="search-container">
        <form action="" method="GET">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<div class="questions">
    <div class="container">
        <div class="question">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1><?php echo $question['question'] ?></h1>
                </div>
            </div>
        </div>
        <div class="answer">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p><?php echo $question['answer'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }
}else{
    echo "<h1 style='text-align:center;'>No Questions Yet</h1>";
} ?>



<?php include  $tpl ."footer.php"; ?>