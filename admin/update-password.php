<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>

        <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        ?>
        
         <br><br>
       <form action="" method="POST">
           <table class="tbl-50">
               <tr>
                   <td>Current Password: </td>
                   <td><input class="input" type="password" name="current_password" placeholder="current password"></td>
               </tr>
               <tr>
                   <td>New Password: </td>
                   <td><input class="input" type="password" name="new_password" placeholder="new password"></td>
               </tr>
               <tr>
                   <td>Confirm Password: </td>
                   <td><input class="input" type="password" name="confirm_password" placeholder="confirm password"></td>
               </tr>
               <tr>
                   <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Save New Password" class="btn-secondary input">
                   </td>
               </tr>
           </table>
       </form>

    </div>
</div>

    </div>
</div>

<?php
    if(isset($_POST['submit'])){

        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);

        $sql="SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";

        $res=mysqli_query($con,$sql);

        if($res==true){
            $count=mysqli_num_rows($res);

            if($count==1){
                if($new_password==$confirm_password){

                    $sql2="UPDATE tbl_Admin SET
                    password='$new_password'
                    where id=$id";

                    $res2=mysqli_query($con,$sql2);

                    if($res2==true){

                        $_SESSION['pwd_change']="<div class='success'>Password Changed Successfully</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');   
                    
                    }
                    else{

                        $_SESSION['pwd_not_change']="<div class='error'>Password Can't Be Changed Now, Try Again Later</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }
                }
                else{
                    $_SESSION['pwd_not_match']="<div class='error'>Password Is Not Matched</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            } 
            else{
                $_SESSION['user_not_found']="<div class='error'>User Not Found</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
        }
    }


?>



<?php include('partials/footer.php'); ?>

