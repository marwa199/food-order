<?php
include('../config/constants.php'); 
    
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        if($image_name !=""){

            $path="../images/category/".$image_name;

            $remove=unlink($path);

            if($remove == false){

                $_SESSION['remove']="<div class='error'>Failed To Remove Category Image</div>";

                header('location:'.SITEURL.'admin/manage-categories.php');

                die();
            }

            $sql="DELETE FROM tbl_category WHERE id=$id ";

            $res=mysqli_query($con,$sql);

            if($res == true){

                $_SESSION['delete']="<div class='success'>Category Deleted successfully</div>";

                header('location:'.SITEURL.'admin/manage-categories.php');
            }
            else{

                $_SESSION['delete']="<div class='error'>Failed To Delete Category</div>";

                header('location:'.SITEURL.'admin/manage-categories.php');
            }


        }
        else{

            $sql="DELETE FROM tbl_category WHERE id=$id ";

            $res=mysqli_query($con,$sql);

            if($res == true){

                $_SESSION['delete']="<div class='success'>Category Deleted successfully</div>";

                header('location:'.SITEURL.'admin/manage-categories.php');
            }
            else{

                $_SESSION['delete']="<div class='error'>Failed To Delete Category</div>";

                header('location:'.SITEURL.'admin/manage-categories.php');
            }

        }

    }
    else{
        header('location:'.SITEURL.'admin/manage-category.php');
    }
 
 
 ?>