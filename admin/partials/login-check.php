<?php

if(!isset($_SESSION['user'])){

    $_SESSION['no-login-message']="<div class='error text-center'> Please Log In To Get Access To Admin Panel</div>";

    header('location:'.SITEURL.'admin/login.php');
}

?>
