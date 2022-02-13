<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Pioneers|<?php getTitle(); ?></title>
    <link rel="icon" href="layout/images/mainlogo.png" type="image/icon" />
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>introjs.min.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>jquery.selectBoxIt.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>front.css" />
    <link href="https://unpkg.com/intro.js/themes/introjs-modern.css" />
    <!-- main Template Css File -->
    <link rel="stylesheet" href="layout/css/style.css" />
    <!-- Normalize Css File All Elements -->
    <link rel="stylesheet" href="layout/css/normalize.css" />
    <!-- Font AWesome Library -->
    <link rel="stylesheet" href="layout/css/all.min.css" />
    <!-- Start Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">


        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">

    <!-- End Google Fonts -->
</head>

<body>
    <div class="upper-bar">
        <div class="container">
            <?php
                    
                    // TO Pervent the user to see the login and signup if he already sign in before 
                        if(isset($_SESSION['user'])){?>
            <?php $photoUserID = $_SESSION['uid']; ?>

            <?php
                        $stmt = $con->prepare("SELECT * FROM `users` WHERE RegStatus =1  AND UserID = $photoUserID");

                        // execute to the statment
                        $stmt->execute();

                        // assign data come to a variable

                        $rows = $stmt->fetchAll();
                        $ProfilePhoto;
                        $Status;
                        $GroupId;
                        foreach($rows as $row){

                            $ProfilePhoto = $row['avatar'];
                            $Status       = $row['TrustStatus'];
                            $GroupId     = $row['GroupId'];
                        }
                        
                                    
                        ?>




            <img class=" my-image img-thumbnail img-circle" src="admin/uploads/avatars/<?php
                            if(empty($ProfilePhoto)){
                                echo "img.jpg";
                            }else{
                                echo $ProfilePhoto;
                            }
                            ?>" alt="" />
            <?php 
                            if($Status == 1){
                                echo "<div class='status'>
                                    <img src='VIPnot/trusted.png' />
                                </div>";
                            }
                            if($GroupId == 1){
                                echo "<div class='VIP'>
                                    <img src='VIPnot/VIP.png' />
                                </div>";
                            }
                            ?>
            <div class="btn-group my-info text-right">
                <span class=" User-name  btn dropdown-toggle" data-toggle="dropdown">
                    <?php echo $sessionUser ?>
                    <span class="caret"></span>

                </span>
                <ul class="dropdown-menu">
                    <li><a href="profile.php">My Profile</a>
                    <li>
                    <li><a href="newad.php">New Item</a>
                    <li>
                    <li><a href="newevent.php">New Event</a></li>
                    <li><a href="profile.php#my-ads">My Items</a>
                    <li>
                    <li><a href="Logout.php">Logout</a>
                    <li>
                </ul>

            </div>
            <?php

                            $userStatus = checkUserStatus($sessionUser);

                            if($userStatus == 1){
                                
                                // USER is not active
                            }
                        }else{

                    ?>
            <a href="login.php">
                <span data-title=""
                    data-intro="سجل دخولك الان واصبح واحدا منا وشارك ملخصاتك الدراسية والعديد من الاشياء الاخرى"
                    class="pull-right"><i class="fa fa-power-off" aria-hidden="true"></i> <?php echo lang('login')?> /
                    <?php echo lang('SignUp')?></span>
            </a>
            <?php } ?>

            <?php
                        $stmt = $con->prepare("SELECT * FROM `posts`");

                        // execute to the statment
                        $stmt->execute();

                        // assign data come to a variable

                        $posts = $stmt->fetchAll();
                        $postsnumber = 0;
                        
                        foreach($posts as $post){

                            $postsnumber = $postsnumber + 1;
                        }
                        
                                    
                        ?>

            <?php
                        $stmt = $con->prepare("SELECT * FROM `events`");

                        // execute to the statment
                        $stmt->execute();

                        // assign data come to a variable

                        $posts = $stmt->fetchAll();
                        $eventsnumber = 0;
                        foreach($posts as $post){

                            $eventsnumber = $eventsnumber + 1;
                        }
                        
                                    
                        ?>
        </div>
    </div>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> <i class="rotate-home fa fa-home" aria-hidden="true"></i>
                    <?php echo lang('HomePage')?> </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="app-nav">
                <ul class="main-ul nav navbar-nav navbar-right">


                        <li ddata-title="" data-intro="هنا ستجد اغلب المسارات التعليمية لتعلم العديد من المجالات البرمجية"
                        style="margin-top: -15px;" class="Subjects dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown"
                            href="#">Learning Paths <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="learningPaths.php?path=frontend-dev">Front-End Deveolper</a></li>

                            <li><a href="learningPaths.php?path=PythonWebDeveloper">Python Web Developer</a></li>

                            <li><a href="learningPaths.php?path=Back-EndDeveloper">Back-End Developer</a></li>

                            <li><a href="learningPaths.php?path=FullStackDeveloper">Full Stack Developer</a></li>

                            <li><a href="learningPaths.php?path=JavaScriptDeveloper">JavaScript Developer</a></li>

                            <li><a href="learningPaths.php?path=Flutter">Flutter</a></li>

                            <li><a href="learningPaths.php?path=CyberSecurity">Cyber Security</a></li>

                            

                        </ul>
                    </li>




                    <li><a data-title="" data-intro="هنا ستجد اغلب البرامج التي ستحتاجها" style="padding:0;"
                            class="website-link" href="websites.php"> <?php echo lang('Programs')?>
                        </a></li>

                    <li><a data-title="" data-intro="هنا ستجد العديد من الاسالة مع درجات صعوبة مختلفة"
                            style="padding:0;" class="PS-link" href="problemsolving.php"> PS
                        </a></li>




                    <li data-title=""
                        data-intro="هنا ستجد جميع الملفات التي تخص المواد الدراسية بمختلف مراحلها في جامعة حلوان"
                        style="margin-top: -15px;" class="Subjects dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo lang('Subjects')?> <span
                                class="caret"></span></a>
                        <ul class="stayhere dropdown-menu">
                            <?php
                                    $allcats = getAllFrom("*", "categories", "where parent=0"," AND level = 0 ","ID", "ASC");
                                    
                                        echo '<li class="Leveldropdown">';
                                        echo ' <a> Free Programming Courses <span
                                        class="caret"></span></a>';
                                        echo '<ul data-list="L1List" class="L1List" >';
                                        foreach($allcats as $cat){
                                            echo ' <li> <a href="categories.php?pageid='. $cat['ID'] .'">'. $cat['Name'] .'</a></li> ';
                                    
                                    }

                                    echo '</ul>
                                    </li>';

                                    ?>
                            <?php
                                    $allcatsL1 = getAllFrom("*", "categories", "where parent=0"," AND level = 1 ","ID", "ASC");
                                    
                                        echo '<li class="Leveldropdown">';
                                        echo ' <a> Level 1 <span
                                        class="caret"></span></a>';
                                        echo '<ul data-list="L1List" class="L1List" >';
                                        foreach($allcatsL1 as $catL1){
                                            echo ' <li> <a href="categories.php?pageid='. $catL1['ID'] .'">'. $catL1['Name'] .'</a></li> ';
                                    
                                    }

                                    echo '</ul>
                                    </li>';

                                    ?>

                            <?php
                                    $allcatsL2 = getAllFrom("*", "categories", "where parent=0"," AND level = 2 ","ID", "ASC");
                                    
                                        echo '<li class="Leveldropdown">';
                                        echo ' <a> Level 2 <span
                                        class="caret"></span></a>';
                                        echo '<ul data-list="L1List" class="L1List" >';
                                        foreach($allcatsL2 as $catL2){
                                            echo ' <li> <a href="categories.php?pageid='. $catL2['ID'] .'">'. $catL2['Name'] .'</a></li> ';
                                    
                                    }

                                    echo '</ul>
                                    </li>';

                                    ?>

                            <?php
                                    $allcatsL3 = getAllFrom("*", "categories", "where parent=0"," AND level = 3 ","ID", "ASC");
                                    
                                        echo '<li class="Leveldropdown">';
                                        echo ' <a> Level 3 <span
                                        class="caret"></span></a>';
                                        echo '<ul data-list="L1List" class="L1List" >';
                                        foreach($allcatsL3 as $catL3){
                                            echo ' <li> <a href="categories.php?pageid='. $catL3['ID'] .'">'. $catL3['Name'] .'</a></li> ';
                                    
                                    }

                                    echo '</ul>
                                    </li>';

                                    ?>

                            <?php
                                    $allcatsL4 = getAllFrom("*", "categories", "where parent=0"," AND level = 4 ","ID", "ASC");
                                    
                                        echo '<li class="Leveldropdown">';
                                        echo ' <a> Level 4 <span
                                        class="caret"></span></a>';
                                        echo '<ul data-list="L1List" class="L1List" >';
                                        foreach($allcatsL4 as $catL4){
                                            echo ' <li> <a href="categories.php?pageid='. $catL4['ID'] .'">'. $catL4['Name'] .'</a></li> ';
                                    
                                    }

                                    echo '</ul>
                                    </li>';

                                    ?>
                        </ul>
                    </li>


                    <li data-title=""
                        data-intro="هنا ستجد بعض الاحداث و المنشورات المفيدة وبعضا من المقالات مع المصادر الخاصة بها"
                        style="margin-top: -15px;" class="Subjects dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown"
                            href="#"><?php echo lang('Events')?>&<?php echo lang('Posts')?> <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="events.php"> <?php echo lang('Events')?> <?php  if($eventsnumber > 0){
                                echo '<span class="eventsnumber">' . $eventsnumber  . '</span>';
                            } ?></a></li>

                            <li><a href="posts.php"><?php echo lang('Posts')?> <?php  if($postsnumber > 0){
                                echo '<span class="postsnumber">' . $postsnumber  . '</span>';
                            } ?></a></li>

                            <li><a href="articles.php"><?php echo lang('Articles');?></a></li>

                        </ul>
                    </li>


                    <li data-title=""
                        data-intro=" هنا ستجد الجداول الدراسية مع امكانية تحميلها واماكن المدرجات وبعض المعلومات عن معظم دكاترة حلوان وبعض اسالة الطلبة المنتشرة"
                        style="margin-top: -15px;" class="Subjects dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo lang('Helwan')?> <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="table-link" href="timetables.php">
                                    <?php echo lang('table')?></a>
                            </li>
                            <li><a class="know-link" href="knowyourdoctor.php">
                                    <?php echo lang('knowyourdoctor')?></a>
                            </li>
                            <li><a class="que-link" href="questions.php">
                                    Questions</a>
                            </li>

                        </ul>
                    </li>


                    <li><a style="padding:0;" href="team.php"><i class="fa fa-users"
                                aria-hidden="true"></i></a></li>

                    <li data-title=""
                        data-intro="هنا ستجد اكثر المساهمين بنشر الملخصات او الاحداث المهمة او المقالات ويمكن لاي شخص ان يساهم فقط سجل دخولك وابدا بنشر ما تريد">
                        <a style="padding:0;" href="Rank/index.php"> <i class="fa fa-trophy"
                                aria-hidden="true"></i></a>
                    </li>

                    <li data-title=""
                        data-intro="هنا يوجد المتجر الخاص بنا يمكنك الطلب عن طريق الضغط على المنتج الذي تريد"><a
                            style="padding:0;" class="shop-link" href="shop.php">  <i
                                class="fa fa-cart-arrow-down" aria-hidden="true"></i></a></li>
                    <?php 
                            if(isset($_GET['lang']) && $_GET['lang'] == 'ar'){
                                echo '<li><a href="?lang=en" class="en" style="padding:0;">en <i class="fa fa-globe" aria-hidden="true"></i></a></li>';
                            }else{
                                echo '<li><a href="?lang=ar" class="ar" style="padding:0;">ar <i class="fa fa-globe" aria-hidden="true"></i></a></li>';
                            }
                            ?>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>









    <!-- End Onload Div Section -->