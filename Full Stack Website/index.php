<?php
    setcookie("page_view", "viwed", time() + (86400 * 30), "/"); // 86400 = 1 day
    
    ob_start();
    session_start();
    $pageTitle = 'HomePage';



    include 'init.php';
    $allViews = getAllFrom("*", "views", "", "", "id");

?>

<div class="containersss">


    <!-- Start Onload Div Section -->
    <div style="display:none;" class="onload">
        <div class="animation-wrapper">
            <div class="sphere-animation">
                <svg class="sphere" viewBox="0 0 440 440" stroke="rgba(80,80,80,.35)">
                    <defs>
                        <linearGradient id="sphereGradient" x1="5%" x2="5%" y1="0%" y2="15%">
                            <stop stop-color="#373734" offset="0%" />
                            <stop stop-color="#242423" offset="50%" />
                            <stop stop-color="#0D0D0C" offset="100%" />
                        </linearGradient>
                    </defs>
                    <path
                        d="M361.604 361.238c-24.407 24.408-51.119 37.27-59.662 28.727-8.542-8.543 4.319-35.255 28.726-59.663 24.408-24.407 51.12-37.269 59.663-28.726 8.542 8.543-4.319 35.255-28.727 59.662z" />
                    <path
                        d="M360.72 360.354c-35.879 35.88-75.254 54.677-87.946 41.985-12.692-12.692 6.105-52.067 41.985-87.947 35.879-35.879 75.254-54.676 87.946-41.984 12.692 12.692-6.105 52.067-41.984 87.946z" />
                    <path
                        d="M357.185 356.819c-44.91 44.91-94.376 68.258-110.485 52.149-16.11-16.11 7.238-65.575 52.149-110.485 44.91-44.91 94.376-68.259 110.485-52.15 16.11 16.11-7.239 65.576-52.149 110.486z" />
                    <path
                        d="M350.998 350.632c-53.21 53.209-111.579 81.107-130.373 62.313-18.794-18.793 9.105-77.163 62.314-130.372 53.209-53.21 111.579-81.108 130.373-62.314 18.794 18.794-9.105 77.164-62.314 130.373z" />
                    <path
                        d="M343.043 342.677c-59.8 59.799-125.292 91.26-146.283 70.268-20.99-20.99 10.47-86.483 70.269-146.282 59.799-59.8 125.292-91.26 146.283-70.269 20.99 20.99-10.47 86.484-70.27 146.283z" />
                    <path
                        d="M334.646 334.28c-65.169 65.169-136.697 99.3-159.762 76.235-23.065-23.066 11.066-94.593 76.235-159.762s136.697-99.3 159.762-76.235c23.065 23.065-11.066 94.593-76.235 159.762z" />
                    <path
                        d="M324.923 324.557c-69.806 69.806-146.38 106.411-171.031 81.76-24.652-24.652 11.953-101.226 81.759-171.032 69.806-69.806 146.38-106.411 171.031-81.76 24.652 24.653-11.953 101.226-81.759 171.032z" />
                    <path
                        d="M312.99 312.625c-73.222 73.223-153.555 111.609-179.428 85.736-25.872-25.872 12.514-106.205 85.737-179.428s153.556-111.609 179.429-85.737c25.872 25.873-12.514 106.205-85.737 179.429z" />
                    <path
                        d="M300.175 299.808c-75.909 75.909-159.11 115.778-185.837 89.052-26.726-26.727 13.143-109.929 89.051-185.837 75.908-75.908 159.11-115.778 185.837-89.051 26.726 26.726-13.143 109.928-89.051 185.836z" />
                    <path
                        d="M284.707 284.34c-77.617 77.617-162.303 118.773-189.152 91.924-26.848-26.848 14.308-111.534 91.924-189.15C265.096 109.496 349.782 68.34 376.63 95.188c26.849 26.849-14.307 111.535-91.923 189.151z" />
                    <path
                        d="M269.239 267.989c-78.105 78.104-163.187 119.656-190.035 92.807-26.849-26.848 14.703-111.93 92.807-190.035 78.105-78.104 163.187-119.656 190.035-92.807 26.849 26.848-14.703 111.93-92.807 190.035z" />
                    <path
                        d="M252.887 252.52C175.27 330.138 90.584 371.294 63.736 344.446 36.887 317.596 78.043 232.91 155.66 155.293 233.276 77.677 317.962 36.521 344.81 63.37c26.85 26.848-14.307 111.534-91.923 189.15z" />
                    <path
                        d="M236.977 236.61C161.069 312.52 77.867 352.389 51.14 325.663c-26.726-26.727 13.143-109.928 89.052-185.837 75.908-75.908 159.11-115.777 185.836-89.05 26.727 26.726-13.143 109.928-89.051 185.836z" />
                    <path
                        d="M221.067 220.7C147.844 293.925 67.51 332.31 41.639 306.439c-25.873-25.873 12.513-106.206 85.736-179.429C200.6 53.786 280.931 15.4 306.804 41.272c25.872 25.873-12.514 106.206-85.737 179.429z" />
                    <path
                        d="M205.157 204.79c-69.806 69.807-146.38 106.412-171.031 81.76-24.652-24.652 11.953-101.225 81.759-171.031 69.806-69.807 146.38-106.411 171.031-81.76 24.652 24.652-11.953 101.226-81.759 171.032z" />
                    <path
                        d="M189.247 188.881c-65.169 65.169-136.696 99.3-159.762 76.235-23.065-23.065 11.066-94.593 76.235-159.762s136.697-99.3 159.762-76.235c23.065 23.065-11.066 94.593-76.235 159.762z" />
                    <path
                        d="M173.337 172.971c-59.799 59.8-125.292 91.26-146.282 70.269-20.991-20.99 10.47-86.484 70.268-146.283 59.8-59.799 125.292-91.26 146.283-70.269 20.99 20.991-10.47 86.484-70.269 146.283z" />
                    <path
                        d="M157.427 157.061c-53.209 53.21-111.578 81.108-130.372 62.314-18.794-18.794 9.104-77.164 62.313-130.373 53.21-53.209 111.58-81.108 130.373-62.314 18.794 18.794-9.105 77.164-62.314 130.373z" />
                    <path
                        d="M141.517 141.151c-44.91 44.91-94.376 68.259-110.485 52.15-16.11-16.11 7.239-65.576 52.15-110.486 44.91-44.91 94.375-68.258 110.485-52.15 16.109 16.11-7.24 65.576-52.15 110.486z" />
                    <path
                        d="M125.608 125.241c-35.88 35.88-75.255 54.677-87.947 41.985-12.692-12.692 6.105-52.067 41.985-87.947C115.525 43.4 154.9 24.603 167.592 37.295c12.692 12.692-6.105 52.067-41.984 87.946z" />
                    <path
                        d="M109.698 109.332c-24.408 24.407-51.12 37.268-59.663 28.726-8.542-8.543 4.319-35.255 28.727-59.662 24.407-24.408 51.12-37.27 59.662-28.727 8.543 8.543-4.319 35.255-28.726 59.663z" />
                </svg>
            </div>
        </div>
    </div>







    <!-- End Onload Div Section -->

    <!-- Start landing section -->

    <div class="landing">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h1>The Future Of Education</h1class>
                        <h3>It’s Not Too Late to Learn Everything You Wish You Learned in School</h3>

                        <p>Traditional Education has Become Irrelevant. Learn the Subjects that Truly Matter.
                        </p>
                        <a href="login.php" class="btn btn-primary">Become A Member Now</a>
                </div>
            </div>
        </div>
    </div>





    <!-- End Landing Section -->

    <div class="contact_Us">
        <a class="call-icon" href="contactForm/index.php" target="_blank"> <i class="fa fa-phone fa-lg"
                aria-hidden="true"></i></a>
    </div>
    <?php 
    
    if (isset($_GET['search'])) {
        if ($_GET['search'] == "Data Structure" || $_GET['search'] == "Data structure" || $_GET['search'] == "data structure" || $_GET['search'] == "dat structure" || $_GET['search'] == "dta structure" || $_GET['search'] == "data strucure") {
            header("refresh:1;url=categories.php?pageid=9");
        } elseif ($_GET['search'] == "Rank" || $_GET['search'] == "rank" || $_GET['search'] == "ranc") {
            header("refresh:1;url=Rank/index.php");
        } elseif ($_GET['search'] == "Programes" || $_GET['search'] == "rank" || $_GET['search'] == "ranc") {
            header("refresh:1;url=Rank/index.php");
        } elseif ($_GET['search'] == "visual studio" ||$_GET['search'] == "Visual" || $_GET['search'] == "Visual Studio" || $_GET['search'] == "Studio" || $_GET['search'] == "VS"|| $_GET['search'] == "vs") {
            header("refresh:1;url=websites.php#P_5");
        } elseif ($_GET['search'] == "Code Blocks" ||$_GET['search'] == "code blocks" || $_GET['search'] == "Blocks") {
            header("refresh:1;url=websites.php#P_6");
        } elseif ($_GET['search'] == "GPA" ||$_GET['search'] == "gpa"|| $_GET['search'] == "gpa collector" || $_GET['search'] == "GPA collector") {
            header("refresh:1;url=websites.php#P_7");
        } elseif ($_GET['search'] == "Net Beans" ||$_GET['search'] == "net beans"|| $_GET['search'] == "Beans" || $_GET['search'] == "Net") {
            header("refresh:1;url=websites.php#P_8");
        } elseif ($_GET['search'] == "Pycharm" ||$_GET['search'] == "pycharm"|| $_GET['search'] == "Python" || $_GET['search'] == "python") {
            header("refresh:1;url=websites.php#P_9");
        } elseif ($_GET['search'] == "Xampp" ||$_GET['search'] == "xampp"|| $_GET['search'] == "Apache" || $_GET['search'] == "Server") {
            header("refresh:1;url=websites.php#P_10");
        } elseif ($_GET['search'] == "Oracel" ||$_GET['search'] == "Vm"|| $_GET['search'] == "Virtual Box" || $_GET['search'] == "Oracle virtual box" || $_GET['search'] == "oracle") {
            header("refresh:1;url=websites.php#P_11");
        } elseif ($_GET['search'] == "Kali" ||$_GET['search'] == "kali"|| $_GET['search'] == "Kali linux" || $_GET['search'] == "Linux" || $_GET['search'] == "linux") {
            header("refresh:1;url=websites.php#P_13");
        } elseif ($_GET['search'] == "Cmder" ||$_GET['search'] == "cmder") {
            header("refresh:1;url=websites.php#P_14");
        } elseif ($_GET['search'] == "Adobe" ||$_GET['search'] == "adobe"|| $_GET['search'] == "Adobe photoshop" || $_GET['search'] == "photoshop" || $_GET['search'] == "Photoshop") {
            header("refresh:1;url=websites.php#P_15");
        } elseif ($_GET['search'] == "RataType" ||$_GET['search'] == "ratatype"|| $_GET['search'] == "Rata" || $_GET['search'] == "Type" || $_GET['search'] == "type") {
            header("refresh:1;url=websites.php#P_16");
        } elseif ($_GET['search'] == "Pexels" ||$_GET['search'] == "pexels"|| $_GET['search'] == "pixeles") {
            header("refresh:1;url=websites.php#P_17");
        } elseif ($_GET['search'] == "Windows" ||$_GET['search'] == "windows"|| $_GET['search'] == "windows 10" || $_GET['search'] == "windows install" || $_GET['search'] == "Windows setup") {
            header("refresh:1;url=websites.php#P_18");
        } elseif ($_GET['search'] == "Free courses" || $_GET['search'] == "Free course" || $_GET['search'] == "free courses" || $_GET['search'] == "free Courses" || $_GET['search'] == "Free cource" || $_GET['search'] == "Free corc") {
            header("refresh:1;url=categories.php?pageid=23");
        }elseif ($_GET['search'] == "CS111" || $_GET['search'] == "Cs111" || $_GET['search'] == "CS1" || $_GET['search'] == "Cs1" || $_GET['search'] == "computer science" || $_GET['search'] == "Computer Science" || $_GET['search'] == "Introduction to computer Science" || $_GET['search'] == "Introduction to cs") {
            header("refresh:1;url=categories.php?pageid=24");
        }
        elseif ($_GET['search'] == "Electronics" || $_GET['search'] == "electronics" || $_GET['search'] == "Electro" || $_GET['search'] == "electro" || $_GET['search'] == "Elec" || $_GET['search'] == "elec") {
            header("refresh:1;url=categories.php?pageid=25");
        }
        elseif ($_GET['search'] == "English 1" || $_GET['search'] == "english 1" || $_GET['search'] == "English1" || $_GET['search'] == "english1" ) {
            header("refresh:1;url=categories.php?pageid=26");
        }
        elseif ($_GET['search'] == "Is" || $_GET['search'] == "IS" || $_GET['search'] == "is" || $_GET['iS'] == "Cs1" || $_GET['search'] == "Information system" || $_GET['search'] == "information system") {
            header("refresh:1;url=categories.php?pageid=27");
        }
        elseif ($_GET['search'] == "Math1" || $_GET['search'] == "math1" || $_GET['search'] == "Math 1" || $_GET['iS'] == "math 1") {
            header("refresh:1;url=categories.php?pageid=28");
        }
        elseif ($_GET['search'] == "Physics" || $_GET['search'] == "physics") {
            header("refresh:1;url=categories.php?pageid=29");
        }
        elseif ($_GET['search'] == "English2" || $_GET['search'] == "english2" || $_GET['search'] == "english 2" || $_GET['search'] == "English2") {
            header("refresh:1;url=categories.php?pageid=31");
        }
        elseif ($_GET['search'] == "Posts" || $_GET['search'] == "posts" || $_GET['search'] == "Post" || $_GET['search'] == "post") {
            header("refresh:1;url=posts.php");
        }
        elseif ($_GET['search'] == "Shop" || $_GET['search'] == "shop") {
            header("refresh:1;url=shop.php");
        }
        elseif ($_GET['search'] == "Ourteam" || $_GET['search'] == "ourteam"  || $_GET['search'] == "Our team"  || $_GET['search'] == "our team") {
            header("refresh:1;url=team.php");
        }
        elseif ($_GET['search'] == "Events" || $_GET['search'] == "event"  || $_GET['search'] == "Event"  || $_GET['search'] == "events") {
            header("refresh:1;url=events.php");
        }
        elseif ($_GET['search'] == "180 daraga" || $_GET['search'] == "180daraga"  || $_GET['search'] == "180"  || $_GET['search'] == "daraga") {
            header("refresh:1;url=event.php?itemid=23");
        }
        elseif ($_GET['search'] == "ICT" || $_GET['search'] == "ict"  || $_GET['search'] == "Cairo ict"  || $_GET['search'] == "Cairo ICT") {
            header("refresh:1;url=event.php?itemid=20");
        }
        elseif ($_GET['search'] == "Leader" || $_GET['search'] == "leader"  || $_GET['search'] == "Elsawy"  ) {
            header("refresh:1;url=team.php#leader");
        }
        elseif ($_GET['search'] == "coleader" || $_GET['search'] == "Coleader"  || $_GET['search'] == "Bakr"  ) {
            header("refresh:1;url=team.php#coleader");
        }
        elseif ($_GET['search'] == "Member" || $_GET['search'] == "member"  || $_GET['search'] == "Nada" || $_GET['search'] == "Rawan" ) {
            header("refresh:1;url=team.php#member");
        }
        else{
            header("refresh:1;url=notfound.php");
        }
    }
        
    
    
    ?>



    <!-- End Landing Section -->

    <!-- Start PopUp -->
    <div class="popUp">
        <div class="inner">
            <span class="line-1"></span>
            <span class="line-2"></span>
            <?php 
            $allads = getAllFrom("*", "ads", "", "", "adid");
            foreach ($allads as $ad) {
                ?>
            <h2><?php echo $ad['adtitle'] ?></h2>
            <img class="LogoImage" src="admin/uploads/posts/<?php echo $ad['adphoto'] ?>">
            <h5 class="discreption"><?php echo $ad['addescription'] ?></h5>
            <h4>Website </h4>
            <p><a href="#"><?php echo $ad['adwebsite'] ?></a></p>
            <button class="closebtn">close</button>
            <?php
            } ?>
        </div>
    </div>


    <!-- End PopUp -->




    <!-- Start Services Section -->
    <div class="search-bar">
        <div class="search-container">
            <form action="" method="GET">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>

    <div class="services" id="services">
        <div class="container">
            <h2 class="special-heading"><?php echo lang('Services')?></h2>
            <p><?php echo lang('Special_head_1')?></p>
            <div class="services-content">
                <div class="col">
                    <!-- Start Service -->
                    <div class=" srv">

                        <div class="Courses text">
                            <h3><?php echo lang('Courses')?></h3>
                            <p>
                                <?php echo lang('Courses_desc')?>
                            </p>
                        </div>
                    </div>
                    <!-- Second Box -->
                    <div class="srv">

                        <div class="Events text">
                            <h3><?php echo lang('Lectures')?></h3>
                            <p>
                                <?php echo lang('Lectures_desc')?>

                            </p>
                        </div>
                    </div>

                    <!-- End Service -->
                </div>
                <div class="col">
                    <!-- Start Service -->
                    <div class="srv">

                        <div class="Lectures text">
                            <h3><?php echo lang('Events')?></h3>
                            <p>
                                <?php echo lang('Events_desc')?>

                            </p>
                        </div>
                    </div>
                    <!-- Second Box -->
                    <div class="srv">

                        <div class="Paths text">
                            <h3><?php echo lang('Educational_paths')?></h3>
                            <p>
                                <?php echo lang('Educational_paths_desc')?>
                            </p>
                        </div>
                    </div>

                    <!-- End Service -->
                </div>
                <div class="col">
                    <div class="image image-column Robot-main">
                        <h1 class="message">Hey Code Pioneer Nice To Meet You</h1>
                        <img class="robot" src="layout/images/Ropot.png" alt="" />
                    </div>
                </div>
                <div class="Robot-Side">
                    <img src="layout/images/RobotSide.png" alt="" />
                </div>




            </div>
        </div>
    </div>



    <!-- End Services Section -->


    <!-- Start UdemyCourses Section -->

    <div class="udemycourses">
        <div class="container">
        <h1 class="special-heading">Udemy Free Courses</h1>
        <p style="margin-top:5px;">All Courses are Uploaded On Google Drive So You Can Download Them Any Time</p> 
        <h2>All Categories</h2>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/javatutorials.png" >
                    <h1><a href="udemycourses.php?toturialID=1" target="_blank" > Java Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/Adobe Audiation CC.jpg" >
                    <h1><a href="udemycourses.php?toturialID=2" target="_blank" > Adobe Audiation CC Tutoriels</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/Adobe Illustrator.jpg" >
                    <h1><a href="udemycourses.php?toturialID=3" target="_blank" > Adobe Illustrator Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/bootstrap.jpg" >
                    <h1><a href="udemycourses.php?toturialID=4" target="_blank" > bootstrap Tutorials</a></h1>
                </div>
            </div>
        </div>


        <!-- Second Row -->

        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/AdobeAfterEffects.jpg" >
                    <h1><a href="udemycourses.php?tutorials=toturialID=5" target="_blank" >Adobe After Effects Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/AdobeInDesign.png" >
                    <h1><a href="udemycourses.php?tutorials=toturialID=6" target="_blank" > Adobe InDesign Tutoriels</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/.NET.png" >
                    <h1><a href="udemycourses.php?toturialID=7" target="_blank" > .NET Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/adobe - premiere.png" >
                    <h1><a href="udemycourses.php?toturialID=8" target="_blank" >adobe-premiere Tutorials</a></h1>
                </div>
            </div>
        </div>

        <!-- Third Row -->

        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/AffiliateMarketingTutorials.jpg" >
                    <h1><a href="udemycourses.php?toturialID=9" target="_blank" >Affiliate Marketing  Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/Android Studio.jpg" >
                    <h1><a href="udemycourses.php?toturialID=10" target="_blank" > Android Studio <br>Tutoriels</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/AJAX.png" >
                    <h1><a href="udemycourses.php?toturialID=11" target="_blank" > AJAX Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/CHash.jpg" >
                    <h1><a href="udemycourses.php?toturialID=12" target="_blank" >C# Tutorials</a></h1>
                </div>
            </div>
        </div>


        <!-- fourth Row -->

        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/CSS3.jpg" >
                    <h1><a href="udemycourses.php?toturialID=13" target="_blank" >CSS3 Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/CyberSecurity.jpg" >
                    <h1><a href="udemycourses.php?toturialID=14" target="_blank" > Cyber Security <br> Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/Digital marketing.png" >
                    <h1><a href="udemycourses.php?toturialID=15" target="_blank" > Digital marketing Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/Ethical Hacking.jpg" >
                    <h1><a href="udemycourses.php?toturialID=16" target="_blank" >Ethical Hacking Tutorials</a></h1>
                </div>
            </div>
        </div>


        <!-- fifth Row -->

        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/Machine Learning.jpg" >
                    <h1><a href="udemycourses.php?toturialID=17" target="_blank" >Machine Learning Tutorials</a></h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/ux-and-ui.jpg" >
                    <h1><a href="udemycourses.php?toturialID=18" target="_blank" >ux-and-ui  Tutorials</a></h1>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="card">
                    <img class="tutorial-image" src="tutorielsimages/LinuxServer.jpg" >
                    <h1><a href="udemycourses.php?toturialID=19" target="_blank" >Linux Server  Tutorials</a></h1>
                </div>
            </div>
            
        </div>

        </div>
    </div>


    <!-- End UdemyCourses Section -->





    <!-- start data section -->
    <div class="data">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div data-tilt data-tilt-glare data-tilt-max-glare="0.8" class="card">
                        <div class="views">
                            <i class="view-icon fa fa-eye" aria-hidden="true"></i>
                            <h3><?php echo lang('Views')?></h3>
                            <?php foreach ($allViews as $view) { ?>
                            <input readonly="readonly" class="views-number" value="<?php echo $view['number'];  ?>" />
                            <?php 
            if (!isset($_COOKIE["page_view"])) {
                $newview = ($view['number'] + 1);
            }else{
                $newview = $view['number'];
            }
            }
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shop";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE views SET number = $newview WHERE id=1";
            $conn->query($sql);
            $conn->close();
            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div data-tilt data-tilt-glare data-tilt-max-glare="0.8" class="card">
                        <div class="members">
                            <i class="view-icon fa fa-users" aria-hidden="true"></i>
                            <h3><?php echo lang('Members')?></h3>
                            <?php
                            $allmembers = getAllFrom("*", "users", "WHERE Groupid = 0", "AND RegStatus = 1", "UserID");
                            $numbermember = 0;

                                foreach($allmembers as $member){
                                    
                                    $numbermember = $numbermember + 1; 
                                }?>
                            <input readonly="readonly" class="members-number" value="<?php echo $numbermember;  ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div data-tilt data-tilt-glare data-tilt-max-glare="0.8" class="card">
                        <div class="summeries">
                            <i class="view-icon fa fa-book" aria-hidden="true"></i>
                            <h3><?php echo lang('Summeries')?></h3>
                            <?php
                            $allSummeries = getAllFrom("*", "items", "", "", "Item_ID");
                            $numberSummeries = 0;

                                foreach($allSummeries as $Summery){
                                    
                                    $numberSummeries = $numberSummeries + 1; 
                                } ?> <input readonly="readonly" class="summeries-number"
                                value="<?php echo $numberSummeries;  ?>" />
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div data-tilt data-tilt-glare data-tilt-max-glare="0.8" class="card">
                        <div class="admins">
                            <i class="view-icon fa fa-user" aria-hidden="true"></i>
                            <h3><?php echo lang('Admins')?></h3>
                            <?php
                            $allmembers = getAllFrom("*", "users", "WHERE Groupid = 1", "AND RegStatus = 1", "UserID");
                            $numbermember = 0;

                                foreach($allmembers as $member){
                                    
                                    $numbermember = $numbermember + 1; 
                                }?>
                            <input readonly="readonly" class="admins-number" value="<?php  echo $numbermember; ?>" />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end data section -->


    <!-- Start Slider Section -->
    <div class="slider">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



                    <div class="slider-container">
                        <div id="slide-number" class="slide-number"></div>
                        <div class="people-talk">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <img class="people-talk-image" src="layout/DoctorsPhotos/Doc1.jpg" alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h1>
                                        "The best thing to happen to me in the most uncertain time of my life!"
                                    </h1>
                                    <h2>Lean Marville</h2>
                                    <h3>Attorney, Miss Barbados 2009</h3>
                                </div>
                            </div>
                        </div>
                        <div class="people-talk">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <img class="people-talk-image" src="layout/DoctorsPhotos/Doc2.jpg" alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h1>
                                        "Mindvalley online programs are truly invaluable learning experience for me"
                                    </h1>
                                    <h2>Biance Loana</h2>
                                    <h3>Romanian Women's World Karate Chapion</h3>
                                </div>
                            </div>
                        </div>
                        <div class="people-talk">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <img class="people-talk-image" src="layout/DoctorsPhotos/Doc3.jpg" alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h1>
                                        "I practice The 6 Phase Meditation"
                                    </h1>
                                    <h2>Tony Gonzales</h2>
                                    <h3>Attorney, Host, NFL Hall of Fame</h3>
                                </div>
                            </div>
                        </div>
                        <div class="people-talk">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <img class="people-talk-image" src="layout/DoctorsPhotos/Doc4.jpg" alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h1>
                                        "One year ahead now , more than 70 % of the employees claimed loving this
                                        platform..."
                                    </h1>
                                    <h2>Daniel Sierra</h2>
                                    <h3>General Manager, Duracell Mexico</h3>
                                </div>
                            </div>
                        </div>
                        <div class="people-talk">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <img class="people-talk-image" src="layout/DoctorsPhotos/Doc5.jpg" alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h1>
                                        "Mindvalley is building the next harvard or stanford of our time..."
                                    </h1>
                                    <h2>Lean Marville</h2>
                                    <h3>Attorney, Miss Barbados 2009</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-controls">
                        <span id="prev" class="prev"></span>
                        <span id="indicator" class="indicator">

                        </span>
                        <span id="next" class="next"></span>
                    </div>


                </div>
            </div>
        </div>
    </div>





    <!-- End Slider Section -->


    <!-- Start About -->

    <div class="about" id="About">
        <div class="container">
            <h2 class="special-heading"><?php echo lang('About')?></h2>
            <p><?php echo lang('About_Special')?></p>
            <div class="about-content">
                <div class="image">
                    <img class="ElsawyImage" src="layout/images/1230.jpg" alt="">
                </div>
                <div class="text">
                    <p>
                        <?php echo lang('About_desc_1')?>
                    </p>
                    <hr>
                    <p>
                        <?php echo lang('About_desc_2')?>
                    </p>
                </div>

            </div>
        </div>
    </div>


    <!-- End About -->

    <!-- Start Contact -->

    <div class="contact" id="contact">

        <div class="container">

            <h2 class="special-heading"><?php echo lang('Contact')?></h2>
            <p><?php echo lang('Contact_Special')?> </p>
            <div class="info">
                <a href="mailto:codepinoeer.cp@gmail.com?subject=Contact" class="link">codepinoeer.cp@gmail.com</a>
                <div class="social">
                    <?php echo lang('Find_US')?>
                    <a href="https://www.youtube.com/channel/UCkj2vzpJS0N0AICmaAMekRg" target="_blank"><i
                            class="fab fa-youtube"></i></a>
                    <a href="https://www.facebook.com/Code-Pioneers-112644434401569" target="_blank"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://chat.whatsapp.com/DVe8ANYV0hd465xrn5DwWD" target="_blank"><i
                            class="fab fa-whatsapp" aria-hidden="true"></i></a>

                </div>
                <div class="social">
                    &copy; 2021 Code Pioneers. All Rights Reserved
                </div>
                <div class="social">
                    Made By Code Pioneers Team
                    <a href="https://www.behance.net/abdelrhman_Elsawy" target="_blank"><i class="fab fa-behance"
                            aria-hidden="true"></i></a>

                </div>
            </div>

        </div>

    </div>

</div>


<canvas class="background"></canvas>
<canvas class="background"></canvas>




<!-- End Contact -->


<?php

    include  $tpl ."footer.php";
    ob_end_flush();

?>