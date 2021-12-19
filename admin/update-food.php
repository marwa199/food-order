<?php include('partials/menu.php'); ?>

<?php
    if(isset($_GET['id'])){
        //get all data
        $id=$_GET['id'];

        $sql2="SELECT * FROM tbl_food WHERE id=$id";

        $res2=mysqli_query($con,$sql2);

        $row2=mysqli_fetch_assoc($res2);
            $title=$row2['title'];
            $describtion=$row2['describtion'];
            $price=$row2['price'];
            $current_image=$row2['image_name'];
            $current_category=$row2['category_id'];
            $featured=$row2['featured'];
            $active=$row2['active'];
    }
    else{
        //redirect to mange food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-50">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" class="input" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="describtion" class="input" cols="30" rows="5"><?php echo $describtion; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input class="input" type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != ""){
                                //image is available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="200px" height="100px" alt="<?php echo $title; ?>">
                                <?php
                            }
                            else{
                                //image is not available
                                
                                echo "<div class='error'>No image to display</div>";

                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image" class="input">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" class="input">
                            <?php
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                $res=mysqli_query($con,$sql);

                                $count=mysqli_num_rows($res);

                                if($count>0){
                                    //category available
                                    while($row=mysqli_fetch_assoc($res)){
                                        $category_title=$row['title'];
                                        $category_id=$row['id'];

                                        ?>
                                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }
                                else{
                                    //category isnot available
                                    echo "<option value='0'>No Categories To display</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "yes"){echo "checked";} ?> type="radio" name="featured" value="yes"> Yes
                        <input <?php if($featured == "no"){echo "checked";} ?> type="radio" name="featured" value="no"> No
                   </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "yes"){echo "checked";} ?> type="radio" name="active" value="yes"> Yes
                        <input <?php if($active == "no"){echo "checked";} ?> type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" value="Update Food" name="submit" class="input btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            if(isset($_POST['submit'])){

                //1.get all details from the form
                $id=$_POST['id'];
                $title=$_POST['title'];
                $describtion=$_POST['describtion'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //2.upload image if selected
                if(isset($_FILES['image']['name'])){

                    $image_name=$_FILES['image']['name']; //new image name

                    if($image_name != ""){

                        //$ext = substr( strrchr($file_name, '.'), 1); where strrchr extracts the string after the last . and substr cuts off the .
                        $exp = explode('.',$image_name);
                        $ext = end($exp);
                        $image_name = "food_name_".rand(0000,9999).".".$ext;

                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src_path,$dest_path);

                        if($upload == false){
                            $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }

                       //3.delete the image if new one is selected
                        if($current_image != ""){

                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            if($remove==false){
                                $_SESSION['remove_failed'] = "<div class='error'>Failed To Remove Current Image</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }
                    }
                    else{

                        $image_name=$current_image; //old image name
                    }

                }
                else{

                    $image_name=$current_image; //old image name
                }


                //4.update food in database
                $sql3="UPDATE tbl_food SET
                    title = '$title',
                    describtion = '$describtion',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id='$id' ";

                $res3 = mysqli_query($con,$sql3);

               //5.redirect to manage food page
                if($res3 == true){
                    //data updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    //failed to update
                    $_SESSION['update'] = "<div class='success'>Failed To Update Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }

        ?>

    </div>
</div>



<?php include('partials/footer.php'); ?>