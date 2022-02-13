<?php
    ob_start();
    session_start();
    $pageTitle = 'login';

    if(isset($_SESSION['user'])){
        header('location: index.php'); //rediredt to the indesx Page
    }
    include 'init.php'; 

    // check if the user coming from https post Request

    if($_SERVER ['REQUEST_METHOD'] =='POST'){
        if(isset($_POST['login'])){
        $user = $_POST['username']; // user variable i made & username coming from form
        $pass = $_POST['password'];
        // make the passwords invisble
        $hashedPass = sha1($pass);

        // check if the user in database or not

        $stmt = $con->prepare("SELECT 
                                    UserID, UserName , password , RegStatus
                                    FROM 
                                        users 
                                    WHERE 
                                        UserName = ?  
                                    AND 
                                        password = ?");

        $stmt->execute(array($user, $hashedPass));
        
        $get = $stmt->fetch();
        
        $count = $stmt->rowCount();

        //check if count >0 this mean the database contain record about this username

        if($count > 0){

            if ($get['RegStatus'] === 1) {
                echo "<h2 style='color:red'>Wait For Activation</h2>";
            

                $_SESSION ['user'] = $user; //register session name

                $_SESSION ['uid'] = $get['UserID']; //register User ID in Session

                header('Location:index.php'); // redirect to dashboard page

                exit();
            }else{
                
                    echo "<h2 style='color: green;
                    FONT-SIZE: 20PX;
                    MARGIN-LEFT: 14px;'>Wait For Activation</h2>";
                
            }
        }else{
            echo "<h2 style='color: red;
            FONT-SIZE: 20PX;
            MARGIN-LEFT: 14px;'>Sorry username or password is not correct</h2>";
        }

        

    }else{
        $formERRORS = array();

        $username   =  $_POST['username'];
        $password   =  $_POST['password'];
        $password2  = $_POST['password2'];
        $email      =  $_POST['email'];
        // $avatar     = $_FILES['avatar'];
        $avatarName = $_FILES['avatar']['name'];
        $avatarSize = $_FILES['avatar']['size'];
        $avatarTmp  = $_FILES['avatar']['tmp_name'];
        $avatarType = $_FILES['avatar']['type'];

        // List of allowed files to be uploaded
        $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");

        // Get avatar Extension
        $varrr= explode('.', $avatarName);
        $avatarExtension = strtolower(end($varrr));

        if(isset($username)){
            $filterdUser = filter_var($username, FILTER_SANITIZE_STRING);

            if(strlen($filterdUser) < 4){
                $formERRORS[]= ' <div style="color:red;">UserName Must Be more than 4 Characters</div> ';
            }
        }

        if(isset($password) && isset($password2)){

            if(empty($password)){
                $formERRORS[] = '<div style="color:red;">Sorry Password Can Not Be <strong>Empty</strong></div> ';
            }

            if(sha1($password)!== sha1($password2)){
                $formERRORS[]= '<div style="color:red;"> Sorry Password Does Not <strong>Match</strong></div> ';
            }
        }

        if(isset($avatarName)){

            if(! empty($avatarName) && ! in_Array($avatarExtension, $avatarAllowedExtension)){
                $formERRORS[] = '<div class="alert alert-danger">This Extension is not <strong>Allowed</strong></div>';
            }
            if($avatarSize > 5194304){
                $formERRORS[] = '<div class="alert alert-danger">Profile photo can not be larger than <strong> 5MB </strong></div>';
            }

        }

        if(isset($email)){
            $filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

            if(filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) !=true){
                $formERRORS[] = '<div style="color:red;"> This Email IS Not Valid</div>'; 
            }
        }

        // check if there is no error proceed The USER ADD

        if(empty($formERRORS)){

            if (!empty($avatarName)) {
                $avatar = rand(0, 100000) . '_' . $avatarName;
                move_uploaded_file($avatarTmp, "admin\uploads\avatars\\" . $avatar);
            }

            // check if user exist in database or not 
            $check = checkItem("UserName","users", $username);

            if ($check ==1){
                $formERRORS[] = "<div class='alert alert-danger'> Sorry This User is <strong>Exist</strong> </div> ";
            }

            else{



                //Insert User Info in data base

                $stmt = $con->prepare("INSERT INTO users(UserName, Password ,email ,RegStatus,avatar, Date)
                            VALUES (:zuser, :zpass, :zmail, 0,:zavatar, now())");
                    $stmt->execute(array(
                        'zuser'=>$username,
                        'zpass'=>sha1($password),
                        'zmail' =>$email,
                        'zavatar' => $avatar
                    ));

                //Echo succes message

                $succesMsg = 'Congrats You Are Now Registerd user';

                }
        }
    }

    }
?>

<div class="container login-page">
    <h1 class="text-center">
        <span class="selected" data-class="login">Login</span> | <span data-class="signup">Signup</span>
    </h1>
    <!-- Start Login Form -->
    <form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

        <input class="form-control" type="text" name="username" autocomplete="off"
            placeholder="Please Enter Your Username" />
        <input class="form-control" type="password" name="password" autocomplete="new-password"
            placeholder="Please Enter A password" />
        <input class="btn btn-success btn-block" type="submit" name="login" value="Login" />
        <span class="logo-circle-login"></span>
    </form>

    <!-- End Login Form -->

    <!-- Start SignUp Form -->

    <form class="signup" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
        <div class="input-container">
            <input class="form-control" type="text" name="username" autocomplete="off"
                placeholder="Please Enter Your Username" required="required" pattern=".{4,}"
                title="Username Must Be More 4 Char or More" />
        </div>
        <div class="input-container">
            <input class="form-control" type="password" name="password" autocomplete="new-password"
                placeholder="Please Enter A password" required="required" minlength="4" />
        </div>
        <div class="input-container">
            <input class="form-control" type="password" name="password2" autocomplete="new-password"
                placeholder="Please Enter The Password Again" minlength="4" required="required" />
        </div>
        <div class="input-container">
            <input class="form-control" type="email" name="email" placeholder="Please Enter A valid Email"
                required="required" />
        </div>
        <div class="input-container">
            <input class="form-control" type="file" name="avatar" placeholder="Please Enter A valid Photo"
                required="required" />
        </div>
        <input class="btn btn-primary btn-block" type="submit" name="signup" value="SignUp" />
    </form>

    <!-- End Signup Form -->

    <div class="the-errors text-center">
        <?php
            if(! empty ($formERRORS)){
                foreach($formERRORS as $error){
                    echo '<div clas="msg error" >' . $error . '</div>';
                }
            }
                if(isset($succesMsg)){
                    echo '<div clas="msg Success" >' . $succesMsg . '</div>';
                }

        ?>

    </div>

    

    <?php include $tpl . 'footer.php';
        ob_end_flush();
?>