<?php 
    include('partials/menu.php');
?>

<!-- start content section -->
<div class="main-content">
    <div class="wrapper">
        <h1>manage admin</h1>
        <br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']); 
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['user_not_found'])){
                echo $_SESSION['user_not_found'];
                unset($_SESSION['user_not_found']);
            }

            if(isset($_SESSION['pwd_not_match'])){
                echo $_SESSION['not_match'];
                unset($_SESSION['not_match']);
            }

            if(isset($_SESSION['pwd_change'])){
                echo $_SESSION['pwd_change'];
                unset($_SESSION['pwd_change']);
            }

            if(isset($_SESSION['pwd_not_change'])){
                echo $_SESSION['pwd_not_change'];
                unset($_SESSION['pwd_not_change']);
            }
        ?>

        <!-- button to add admins -->
        <br><br><br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql="SELECT * FROM tbl_admin";
                $res=mysqli_query($con,$sql);

                if($res==true){
                    $count=mysqli_num_rows($res);
                    $sn=1;

                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];
                        
                        ?>
                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $full_name ?></td>
                                <td><?php echo $username ?></td>
                                <td>
                                    <a class="btn-primary" href="<?php echo SITEURL?>admin/update-password.php?id=<?php echo $id; ?>">Update Password</a>   
                                    <a class="btn-secondary" href="<?php echo SITEURL?>admin/update-admin.php?id=<?php echo $id; ?>">Update Admin</a>   
                                    <a class="btn-danger" href="<?php echo SITEURL?>admin/delete-admin.php?id=<?php echo $id; ?>">Delete Admin</a>    
                                </td>
                            </tr>

            <?php       } 
                    }
                }
            ?>

        </table>
    </div>
</div>
<!-- end content section -->

<?php 
    include('partials/footer.php');
?>
