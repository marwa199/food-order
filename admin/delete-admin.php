<?php
include('../config/constants.php');

//get the admin id to be deleted
echo $id=$_GET['id'];

//creste sql query to delete id
$sql="DELETE FROM tbl_admin WHERE id=$id";


//execute the query
$res=mysqli_query($con,$sql);

//check whethere the query executed successfully
if($res==true){
    //echo "admin deleted";
    //create session variable to diplay a massage
    $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
    //redirect to manage admin
    header('location:'.SITEURL."admin/manage-admin.php");
}
else{
    //echo "failed to delete admin";
    $_SESSION['delete']="<div class='error'>Failed To Delete Admin, Try Again Later</div>";
    //redirect to manage admin
    header('location:'.SITEURL."admin/manage-admin.php");
}

?>