<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['uploadd']);
            }
        ?>

        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-50">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input class="input" type="text" name="title" placeholder="Category title.....">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input class="input" type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>                
                </tr>
                <tr>
                    <td colspan="2"> <input type="submit" name="submit" value="Add Category" class="btn-secondary input"></td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                
                $title=$_POST['title'];

                if(isset($_FILES['image']['name'])){
                    //get the details of selected image
                    $image_name=$_FILES['image']['name'];
    
                    //check if image is selected or not and upload image if selected
                    if($image_name != ""){
                        //image is selected
                        //a.rename the image name
                        $ext=end(explode('.',$image_name));
    
                        //create the new name
                        $image_name="category_name_".rand(0000,9999).".".$ext;
    
                        //b.upload the image
                        //get the source path and destination path
                        $source_path=$_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$image_name;
    
                        $upload = move_uploaded_file($source_path,$destination_path);
    
                        if($upload == false){
                            //failed to upload image
                            //redirect to add food page wth error message
                            $_SESSION['upload']="<div class='error'>Failed To Upload The Image</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();
                        }
                    }
    
                }
                else{
                    //set default value as blank
                    $image_name="";
                }
    

                if(isset($_POST['featured'])){
                    $featured=$_POST['featured'];
                }
                else{
                    $featured="No";
                }

                if(isset($_POST['active'])){
                    $active=$_POST['active'];
                }
                else{
                    $active="No";
                }

                $sql="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'";

                $res=mysqli_query($con,$sql);

                if($res==true){
                    $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-categories.php');
                }
                else{
                    $_SESSION['add']="<div class='error'>Failed To Add Category</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }

            }

        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>