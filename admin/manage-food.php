<?php 
    include('partials/menu.php');
?>

<!-- start content section -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['food_not_exist'])){
                echo $_SESSION['food_not_exist'];
                unset($_SESSION['food_not_exist']);
            }

            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['remove_failed'])){
                echo $_SESSION['remove_failed'];
                unset($_SESSION['remove_failed']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <!-- button to add foods -->
        <br><br>
        <a href="<?php echo SITEURL; ?>/admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //create a sql query to get all the food
            $sql="SELECT * FROM tbl_food";

            //excute the query
            $res=mysqli_query($con,$sql);

            $count=mysqli_num_rows($res);

            $sn=1;
            if($count>0){
                //there is a food in database to display
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo "$".$price; ?></td>
                        <td>
                            <?php 
                            if($image_name!=""){
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="" width="150px" height="80px">
                                <?php
                            }
                            else{
                                echo "<div class='error'>No Image To Display</div>";
                            }
                        
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a class="btn-secondary" href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>">Update Food</a>   
                            <a class="btn-danger" href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>">Delete Food</a>    
                        </td>
                    </tr>

                    <?php
                }

            }
            else{
                //no food added
                echo "<tr><td colspan='7' class='error'>No Food To Display</td></tr>";
            }
        ?>


        </table>

    </div>
</div>
<!-- end content section -->

<?php 
    include('partials/footer.php');
?>
