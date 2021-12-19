<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">

    <h1>Add Food</h1>
    <br><br>

    <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

    ?>

    <br><br>

    <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-50">

            <tr>
                <td>Title: </td>
                <td>
                    <input class="input" type="text" name="title" placeholder="Food Title ....">
                </td>
            </tr>
            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="describtion" placeholder="Food Description ....." cols="48" rows="3"></textarea>
                </td>
            </tr>
            <tr>
                <td>Price: </td>
                <td>
                    <input class="input" type="number" name="price">
                </td>
            </tr>
            <tr>
                <td>Select Image: </td>
                <td>
                    <input class="input" type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Category: </td>
                <td>
                    <select class="input" name="category">

                        <?php

                            $sql="SELECT * FROM tbl_category WHERE active='yes'";

                            $res=mysqli_query($con,$sql);

                            $count=mysqli_num_rows($res);

                            if($count>0){
                                // have categories
                                while($row=mysqli_fetch_assoc($res)){

                                    $id=$row['id'];
                                    $title=$row['title'];

                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>


                                    <?php

                                }
                            }
                            else{
                                //dont have categories
                                ?>
                                    <option value="0">No Categories To Display</option>
                                <?php

                            }

                        ?>
                    </select>
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
                <td colspan="2">
                    <input class="btn-secondary input" name="submit" type="submit" value="Add Food">
                </td>
            </tr>

        </table>
    </form>

    <?php

        //check wether the button is clicked or not
        if(isset($_POST['submit'])){

            //add the food in database
            //1.get data from the form
            $title=$_POST['title'];
            $describtion=$_POST['describtion'];
            $price=$_POST['price'];
            $category=$_POST['category'];

            if(isset($_POST['featured'])){
                $featured=$_POST['featured'];
            }
            else{
                $featured="No"; //set the default value
            }

            if(isset($_POST['active'])){
                $active=$_POST['active'];
            }
            else{
                $active="No"; //set the default value
            }

            //2.upload image if selected
            if(isset($_FILES['image']['name'])){
                //get the details of selected image
                $image_name=$_FILES['image']['name'];

                //check if image is selected or not and upload image if selected
                if($image_name != ""){
                    //image is selected
                    //a.rename the image name
                    $ext=end(explode('.',$image_name));

                    //create the new name
                    $image_name="food_name_".rand(0000,9999).".".$ext;

                    //b.upload the image
                    //get the source path and destination path
                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path="../images/food/".$image_name;

                    $upload = move_uploaded_file($source_path,$destination_path);

                    if($upload == false){
                        //failed to upload image
                        //redirect to add food page wth error message
                        $_SESSION['upload']="<div class='error'>Failed To Upload The Image</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        //stop the process
                        die();
                    }
                }

            }
            else{
                //set default value as blank
                $image_name="";
            }

            //3.insert data into database
            $sql2="INSERT INTO tbl_food SET
                   title='$title',
                   describtion='$describtion',
                   price=$price,
                   image_name='$image_name',
                   category_id='$category',
                   featured='$featured',
                   active='$active'
            ";

            //excute the query
            $res2=mysqli_query($con,$sql2);

            //check whether data inserted or not
            if($res2 == true){
                //data inserted successfully and redirect to manage-food page
                $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                //failed to insert data and redirect to manage food page
                $_SESSION['add']="<div class='error'>Failed To Add Food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        }
    ?>


    </div>
</div>

<?php include("partials/footer.php"); ?>
