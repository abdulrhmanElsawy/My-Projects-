<?php
    ob_start();

    session_start();

    $pageTitle = 'Show Items';

    include 'init.php';

    // check if get request item is numeric & get the integer value of it

    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'] ) ?intval ($_GET['itemid']): 0 ;
    // select all data depend on this id 
    $stmt = $con->prepare("SELECT 
                                *
                            FROM 
                                events 

                            WHERE
                                Event_ID = {$_GET['itemid']}
                            AND
                                Status = 1");
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
                        <span>Status </span><?php if($item['Status'] == 1){
                            echo "Coming";
                        }else{
                            echo "Finished";
                        } ?>
                    </li>
                    <li>
                        <i class="fa fa-building fa-fw"></i>
                        <span>YouTube Link </span><a href ="<?php echo $item['Youtube_Vid'] ?>" target="_blank"><?php echo $item['Youtube_Vid'] ?> </a>
                    </li>

                    <li>
                        <i class="fa fa-user fa-fw"></i>
                        <span>Added By:</span> <a href="#"> <?php echo $item['Organizer']; ?></a>
                    </li>
                
                </ul>
            </div>
        </div>
        <hr class="custom-hr">
        

    <?php
    }else{
        echo "<div class='container'>";
            echo "<div class='alert alert-danger'> There Is NO Such ID Or This Item is waiting to be <strong>Approved</strong></div>";
        echo "</div>";

        
    }

    include $tpl . 'footer.php';

    ob_end_flush();

?>