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
            <a class="navbar-brand" href="dashboard.php"><?php echo lang('Admin')?> </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="nav navbar-nav">
                <li><a href="categories.php"><?php echo lang('Categories')?> </a></li>
                <li><a href="Items.php"><?php echo lang('items')?> </a></li>
                <li><a href="events.php">Events </a></li>
                <li><a href="website.php">Programs </a></li>
                <li><a href="shop.php">Shop </a></li>
                <li><a href="posts.php">Posts </a></li>
                <li><a href="informations.php"> info</a></li>
                <li><a href="questions.php"> questions</a></li>
                <li><a href="problems.php"> problems</a></li>
                <li><a href="articles.php"> Articles</a></li>

                <li><a href="editad.php">Ads </a></li>
                <li><a href="members.php"><?php echo lang('Members')?> </a></li>
                <li><a href="Comments.php"><?php echo lang('Comments')?> </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"><?php echo $_SESSION['UserName']; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../index.php">Visit Website</a></li>

                        <li><a href="Members.php?do=edit&userid=<?php echo $_SESSION['ID']?>">
                                <?php echo lang('Edit')?></a></li>
                        <li><a href="#"><?php echo lang('Settings')?></a></li>
                        <li><a href="Logout.php"><?php echo lang('LogOut')?></a></li>

                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>