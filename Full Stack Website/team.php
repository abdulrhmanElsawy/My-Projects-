<?php
    ob_start();
    session_start();
    $pageTitle = 'Team';


    include 'init.php';
    
?>

<?php

$dsn = 'mysql:host=localhost;dbname=shop';
$userdbn= 'root';
$pass = '';


$option = array (
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {

$con = new PDO($dsn , $userdbn , $pass , $option);
$con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
echo 'failed to connect' . $e->getMessage();
}

?>

<body>
    <div class="team">
        <div class="container">
            <?php

                $stmt = $con->prepare("SELECT * FROM leader");

                // execute to the statment
                $stmt->execute();

                // assign data come to a variable

                $Leaders = $stmt->fetchAll();

                if (! empty($Leaders)) {
                    foreach ($Leaders as $leader) {
                        ?>

            <div id="leader" class="row">

                <div class="col-md-12">
                    <div data-tilt class="card">
                        <h1>Leader</h1>
                        <img data-tilt data-tilt-glare data-tilt-max-glare="0.8"
                            src="teamphotos/<?php echo $leader['leaderphoto']; ?>" alt="">
                        <h2><?php echo $leader['leadername']; ?></h2>
                    </div>
                </div>
            </div>
            <?php
            }
        } ?>
            <div id="coleader" class="coleader">
                <div class="row">
                    <div class="col-md-12">

                        <?php

                $stmt = $con->prepare("SELECT * FROM coleader");

                // execute to the statment
                $stmt->execute();

                // assign data come to a variable

                $Coleaders = $stmt->fetchAll();

                if (! empty($Coleaders)) {
                    foreach ($Coleaders as $coleader) {
                        ?>



                        <div class="card">
                            <h1>Co - Leader</h1>
                            <img data-tilt data-tilt-glare data-tilt-max-glare="0.8"
                                src="teamphotos/<?php echo $coleader['coleaderphoto']; ?>" alt="">
                            <h2><?php echo $coleader['coleadername']; ?></h2>
                        </div>


                        <?php
            }
        } ?>

                    </div>
                </div>
            </div>

            <div id="member" class="member">
                <div class="row">
                    <div class="col-md-12">

                        <?php

                $stmt = $con->prepare("SELECT * FROM member");

                // execute to the statment
                $stmt->execute();

                // assign data come to a variable

                $Members = $stmt->fetchAll();

                if (! empty($Members)) {
                    foreach ($Members as $member) {
                        ?>



                        <div class="card">
                            <h1>Memeber</h1>
                            <img data-tilt data-tilt-glare data-tilt-max-glare="0.8"
                                src="teamphotos/<?php echo $member['memberphoto']; ?>" alt="">
                            <h2><?php echo $member['membername']; ?></h2>
                        </div>


                        <?php
            }
        } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>













    <?php

include  $tpl ."footer.php";
ob_end_flush();

?>