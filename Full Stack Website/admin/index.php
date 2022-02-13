<?php

    session_start();
    $noNavbar ='';
    $pageTitle = 'login';



    if(isset($_SESSION['UserName'])){
        header('location: dashboard.php'); //rediredt to the dashboard if iam already loged in before
    }
    include 'init.php';
    include  $tpl .  'header.php';

    // check if the user coming from https post Request

    if($_SERVER ['REQUEST_METHOD'] =='POST'){

        $UserName = $_POST['user'];
        $password = $_POST['pass'];
        // make the passwords invisble
        $hashedPass = sha1($password);

        // check if the user in database or not

        $stmt = $con->prepare("SELECT 
                                    UserID, UserName , password 
                                    FROM 
                                        users 
                                    WHERE 
                                        UserName = ?  
                                    AND 
                                        password = ? 
                                    AND 
                                        GroupID=1 
                                    LIMIT 1");

        $stmt->execute(array($UserName , $hashedPass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        //check if count >0 this mean the database contain record about this username

        if($count > 0){

            $_SESSION ['UserName'] = $UserName; //register sessoon name
            $_SESSION['ID'] = $row['UserID']; //register session ID
            header('Location: dashboard.php'); // redirect to dashboard page
            exit();
        }

    }
?>



<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h4 class="text-center"> Admin Login</h4>
    <input class="form-control input-lg" type="text" name = "user" placeholder="UserName" autocomplete="off"/>
    <input class="form-control input-lg" type="password" name="pass" placeholder="password" autocomplete="new-password"/>
    <input class="btn btn-primary btn-block" type="submit" value="login"/>
</form>

<?php include  $tpl ."footer.php";?>