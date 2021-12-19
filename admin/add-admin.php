<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admins</h1>
        <br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']); 
            }
        ?>


        <br><br><br>
        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Full Name: </td>
                    <td><input class="input" type="text" name="full_name" placeholder="Enter Your Name....."></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input class="input" type="text" name="username" placeholder="Enter Your Username....."></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input class="input" type="password" name="password" placeholder="Enter Your password....."></td>
                </tr>
                <tr>
                    <td colspan="2"> <input type="submit" name="submit" value="Add Admin" class="btn-secondary input"></td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
include('partials/footer.php');
?>

<?php
    // process the values from the form to database

    if(isset($_POST['submit'])){
        // echo "button is clicked";
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";
    
        $res=mysqli_query($con,$sql);

        if($res == true){
            $_SESSION['add']="<div class='success'>admin added successfully</div>";
            header("location:".SITEURL."admin/manage-admin.php");
        }
        else{
            $_SESSION['add']="<div class='error'>there is error occured.. failed to add admin</div>";
            header("location:".SITEURL."admin/add-admin.php");
        }
}
    
?>

