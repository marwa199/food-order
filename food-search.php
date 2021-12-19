<?php include('partials-front/menu.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
            $search=mysqli_real_escape_string($con,$_POST['search']);
        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR describtion LIKE '%$search%'";

                $res=mysqli_query($con,$sql);

                $count=mysqli_num_rows($res);
                if($count>0){
                    //food available
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $describtion=$row['describtion'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];

                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">

                            <?php
                                if($image_name==""){
                                    //image not avaialble
                                    echo "<div class='error'>No Image Available To Display</div>";
                                }
                                else{
                                    //image avaiable
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo "$".$price.".00"; ?></p>
                                <p class="food-detail">
                                    <?php echo $describtion; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                <?php
                    }
                }
                else{
                    //food Not Available
                    echo "<div class='error'>No Similar Food Available To Display</div>";
                }
                ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
