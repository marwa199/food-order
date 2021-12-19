<?php 
    include('partials/menu.php');
?>

<!-- start content section -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>

        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
            <br><br>

        <div class="col-4 text-center">

            <?php

                $sql="SELECT * FROM tbl_category";
                $res=mysqli_query($con,$sql);
                $count=mysqli_num_rows($res);

            ?>

            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div> 

        <div class="col-4 text-center">

            <?php

                $sql2="SELECT * FROM tbl_food";
                $res2=mysqli_query($con,$sql2);
                $count2=mysqli_num_rows($res2);

            ?>

            <h1><?php echo $count2; ?></h1>
            <br>
            Food
        </div> 

        <div class="col-4 text-center">

        <?php

            $sql3="SELECT * FROM tbl_order";
            $res3=mysqli_query($con,$sql3);
            $count3=mysqli_num_rows($res3);

        ?>
            <h1><?php echo $count3; ?></h1>
            <br>
            Orders
        </div> 

        <div class="col-4 text-center">

            <?php
                $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='delivered'";

                $res4=mysqli_query($con,$sql4);

                $row=mysqli_fetch_assoc($res4);

                $total_revenue=$row['Total'];
            ?>

            <h1><?php echo '$'.$total_revenue.'.00'; ?></h1>
            <br>
            Revenue Generated
        </div> 
        
        <div class="clear-fix"></div>
    </div>
</div>
<!-- end content section -->

<?php 
    include('partials/footer.php');
?>
