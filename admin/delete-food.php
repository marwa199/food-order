<?php
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //proccess to delete
        //1.get id and image name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //2.remove image if available
        if($image_name != ""){
            //we have image that should be deleted
            $path="../images/food/".$image_name;

            $remove=unlink($path);
            if($remove == false){
                //failed to remove image
                $_SESSION['remove']="<div class='error'>Failed To Delete Image</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        //3.delete food and redirect to manage food page
        $sql="DELETE FROM tbl_food WHERE id=$id";

        $res=mysqli_query($con,$sql);
        if($res == true){
            $_SESSION['delete']="<div class='success'>Food Deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            $_SESSION['delete']="<div class='error'>Failed To Delete Food</div>";
            header('location:'.SITEURL.'admin/manage-food.php'); 
        }

    }
    else{
        //redirect to manage food page
        $_SESSION['food_not_exist']="<div class='error'>Food Is Not Exist</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }


?>