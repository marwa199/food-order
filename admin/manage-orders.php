<?php 
    include('partials/menu.php');
?>

<!-- start content section -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage orders</h1>

        <br><br>
        <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

         <!-- button to add orders -->
         <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql="SELECT * FROM tbl_order ORDER BY id DESC";

                $res= mysqli_query($con,$sql);

                $sn=1;
                $count=mysqli_num_rows($res);
                if($count>0){
                    //orders are available
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $food=$row['food'];
                        $price=$row['price'];
                        $qty=$row['qty'];
                        $total=$row['total'];
                        $order_date=$row['order_date'];
                        $status=$row['status'];
                        $customer_name=$row['customer_name'];
                        $customer_contact=$row['customer_contact'];
                        $customer_email=$row['customer_email'];
                        $customer_address=$row['customer_address'];

                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo '$'.$price.'.00'; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo '$'.$total.'.00'; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td>
                                    <?php
                                     if($status=="ordered"){
                                        echo "<label>$status</label>";
                                     } 
                                     elseif($status=="waiting"){
                                        echo "<label style='color:orange'>$status</label>";
                                    }
                                    elseif($status=="delivered"){
                                        echo "<label style='color:green'>$status</label>";
                                    }
                                    elseif($status=="cancelled"){
                                        echo "<label style='color:red'>$status</label>";
                                    }
                                     ?>
                                </td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <a class="btn-secondary input" href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>">Update Order</a>   
                                </td>
                            </tr>
                        <?php
                    }
                }
                else{
                    //orders not available
                    echo "<tr><td colspan='12' class='error'>No Orders Available To Display</td></tr>";
                }
            ?>
            
        </table>

    </div>
</div>
<!-- end content section -->

<?php 
    include('partials/footer.php');
?>
