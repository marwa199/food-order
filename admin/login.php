<?php include('../config/constants.php') ?>

<html>
<head>
    <title>Login - Food Order Website</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="log-in">
        <h1 class="text-center">log In</h1>
        <br><br>

        <?php
            if(isset($_SESSION['login_fail'])){
                echo $_SESSION['login_fail'];
                unset($_SESSION['login_fail']);
            }

            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
            <br><br>

        <!-- login form -->
        <form action="" method="POST" class="text-center">
            Username: <br><br>
            <input class="input" type="text" name="username" placeholder="Enter Username ....."><br><br>
            
            Password :  <br>
            <input class="input" type="password" name="password" placeholder="Enter Password ....."><br><br>
<br><br><br>
            <input type="submit" value="login" class="btn-danger input" name="submit">

        </form>
        <br><br><br>

        <p class="text-center">Created By <a href="#">Marwa Yousef</a></p>
    </div>

</body>
</html>    

<?php

if(isset($_POST['submit'])){

    $username =mysqli_real_escape_string($con,$_POST['username']) ;
    $password =mysqli_real_escape_string($con,md5($_POST['password'])) ;

    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res=mysqli_query($con,$sql);

    $count=mysqli_num_rows($res);

    if($count==1){

        $_SESSION['login']="<div class='success'>Login successed..Welcome ".$username."</div>";
        $_SESSION['user']=$username;

        header('location:'.SITEURL.'admin/');

    }
    else{

        $_SESSION['login_fail']="<div class='error'>Login Failed....user or password is not matched</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

}

?>