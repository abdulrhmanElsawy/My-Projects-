<?php
    session_start();
    
if (isset($_GET['search'])) {
        if ($_GET['search'] == "doctor1" || $_GET['search'] == "doctor 1" || $_GET['search'] == "doc1" || $_GET['search'] == "doc 1" || $_GET['search'] == "doctor one") {
            header("refresh:1;url=knowyourdoctor.php#doc_1");
        } 
        else{
            header("refresh:1;url=notfound.php");
        }
    }
    
include 'init.php';
?>















<h1 class="doc-head">Know Your Doctor</h1>

<!-- Start Services Section -->
<div class="search-bar">
    <div class="search-container">
        <form action="" method="GET">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="know-doctor">


    <div id="doc_1" class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img class="doctor-image" src="doctorsphotos/1.jpg">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                <h1 class="doctor-name">Doctor Name</h1>
                <p class="doctor-description">
                    To describe an expression about what the self indicates the meaning of the intended meaning is the
                    meaning of the intended meaning. The description and the attribute are two sources, such as the
                    promise and the kit, and the theologians differentiated between them,<b>See More</b> </p>
                <h2><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</h2>
                <h2><i class="fab fa-instagram" aria-hidden="true"></i> Instagram</h2>
                <h2><i class="fab fa-twitter-square" aria-hidden="true"></i> Twitter</h2>


            </div>
        </div>

    </div>

</div>


<div class="know-doctor">


    <div id="doc_2" class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img class="doctor-image" src="doctorsphotos/1.jpg">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                <h1 class="doctor-name">Doctor Name</h1>
                <p class="doctor-description">
                    To describe an expression about what the self indicates the meaning of the intended meaning is the
                    meaning of the intended meaning. The description and the attribute are two sources, such as the
                    promise and the kit, and the theologians differentiated between them, </p>
                <h2><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</h2>
                <h2><i class="fab fa-instagram" aria-hidden="true"></i> Instagram</h2>
                <h2><i class="fab fa-twitter-square" aria-hidden="true"></i> Twitter</h2>


            </div>
        </div>

    </div>

</div>



<div class="know-doctor">


    <div id="doc_3" class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img class="doctor-image" src="doctorsphotos/1.jpg">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                <h1 class="doctor-name">Doctor Name</h1>
                <p class="doctor-description">
                    To describe an expression about what the self indicates the meaning of the intended meaning is the
                    meaning of the intended meaning. The description and the attribute are two sources, such as the
                    promise and the kit, and the theologians differentiated between them, </p>
                <h2><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</h2>
                <h2><i class="fab fa-instagram" aria-hidden="true"></i> Instagram</h2>
                <h2><i class="fab fa-twitter-square" aria-hidden="true"></i> Twitter</h2>


            </div>
        </div>

    </div>

</div>



<?php include  $tpl ."footer.php"; ?>