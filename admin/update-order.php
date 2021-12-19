<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>

        <?php
            if(isset($_GET['id'])){
                //get the order details
                $id=$_GET['id'];

                $sql="SELECT * FROM tbl_order WHERE id=$id";

                $res=mysqli_query($con,$sql);

                $count=mysqli_num_rows($res);

                if($count==1){

                    $row=mysqli_fetch_assoc($res);

                    $food=$row['food'];
                    $price=$row['price'];
                    $qty=$row['qty'];
                    $status=$row['status'];
                    $customer_name=$row['customer_name'];
                    $customer_contact=$row['customer_contact'];
                    $customer_email=$row['customer_email'];
                    $customer_address=$row['customer_address'];
                }
                else{
                    header('location:'.SITEURL.'admin/manage-orders.php');
                }
            }
            else{
                //redirect to mange order page
                header('location:'.SITEURL.'admin/manage-orders.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Food Name: </td>
                    <td>
                        <b><?php echo $food; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <b>$ <?php echo $price; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Qty: </td>
                    <td>
                        <input type="number" name="qty" class="input" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select class="input" name="status">
                            <option <?php if($status=="ordered"){echo "selected";} ?> value="ordered">Ordered</option>
                            <option <?php if($status=="waiting"){echo "selected";} ?> value="waiting">Waiting</option>
                            <option <?php if($status=="delivered"){echo "selected";} ?> value="delivered">Delivered</option>
                            <option <?php if($status=="cancelled"){echo "selected";} ?> value="cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" class="input" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" class="input" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" class="input" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" class="input text-area" cols="20" rows="3"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update" class="input btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

            <?php

            if(isset($_POST['submit'])){
                //get values from form
                $id=$_POST['id'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty;
                $status=$_POST['status'];
                $customer_name=$_POST['customer_name'];
                $customer_contact=$_POST['customer_contact'];
                $customer_email=$_POST['customer_email'];
                $customer_address=$_POST['customer_address'];

                $sql2="UPDATE tbl_order SET
                    qty='$qty',
                    total='$total',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    WHERE id=$id
                    ";

                //execute the query
                $res2=mysqli_query($con,$sql2);

                if($res2==true){
                    //data updated successfully
                    $_SESSION['update']="<div class='success'>Order Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-orders.php');
                }
                else{
                    //failed to update data
                    $_SESSION['update']="<div class='error'>Failed To Update Order</div>";
                    header('location:'.SITEURL.'admin/manage-orders.php');
                }

            }

            ?>

    </div>
</div>

<?php include('partials/footer.php') ?>