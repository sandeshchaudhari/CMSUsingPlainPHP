<?php include "includes/admin_header.php"
?>

<?php
if (isset($_SESSION['user_username'])) {
	$user_username = $_SESSION['user_username'];
	$user_first_name = $_SESSION['user_first_name'];
	$user_last_name = $_SESSION['user_last_name'];
	$user_email = $_SESSION['user_email'];
	$user_role = $_SESSION['user_role'];
}
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Author</small>
                        </h1>
                             <form action="" method="post" enctype="multipart/form-data">


              <div class="form-group">
                <label for="user_first_name">FirstName</label>
                <input type="text" class="form-control" id="user_first_name" name="user_first_name" value="<?php echo $user_first_name; ?>" placeholder="Enter your first name">
              </div>

              <div class="form-group">
                <label for="user_last_name">LastName</label>
                <input type="text" class="form-control" id="user_last_name" name="user_last_name" value="<?php echo $user_last_name; ?>" placeholder="Enter your last name">
              </div>
              <div class="form-group">
                <label for="select_role">Select Role</label>
                <select name="user_role" id="user_role">
                <?php
if ($user_role == 'Admin') {
	echo "<option value='Admin'>Admin</option>";
	echo "<option value='Subscriber'>Subscriber</option>";

} else {
	echo "<option value='Subscriber'>Subscriber</option>";
	echo "<option value='Admin'>Admin</option>";
}

?>


                </select>
              </div>


              <div class="form-group">
                <label for="user_username">UserName</label>
                <input type="text" class="form-control" id="user_username" name="user_username" value="<?php echo $user_username; ?>" placeholder="Enter Username">
              </div>
              <div class="form-group">
                <label for="user_email">Email</label>
                <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $user_email ?>" placeholder="Enter your email">
              </div>
              <div class="form-group">
                <label for="post_status">Password</label>
                <input type="password" class="form-control" id="post_status" name="user_password" value="" placeholder="Enter your password">
              </div>
               <div class="form-group">
                <label for="user_image">Image</label>
                <img src="../images/<?php echo $user_image; ?>" class="img-thumbnail" style="width: 20%;" alt="img">
                <input type="file" id="user_image" name="user_image">
              </div>
              <button type="submit" class="btn btn-primary" name="update_user">Update Profile</button>
            </form>
            <?php
//Updating Form Data to Database
if (isset($_SESSION['user_username'])) {
	$user_username = $_SESSION['user_username'];
	//echo $user_username;
	if (isset($_POST['update_user'])) {
		$user_first_name = $_POST['user_first_name'];
		$user_last_name = $_POST['user_last_name'];
		$user_role = $_POST['user_role'];
		$user_username = $_POST['user_username'];
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];
		$user_image = $_FILES['user_image']['name'];
		$user_image_temp = $_FILES['user_image']['tmp_name'];

		move_uploaded_file($user_image_temp, "../images/$user_image");
		$query = "UPDATE users SET user_first_name='$user_first_name',user_last_name='$user_last_name',user_role='$user_role',user_username='$user_username',user_email='$user_email',user_password='$user_password',user_image='$user_image' WHERE user_username='$user_username'";
		$update_query_result = mysqli_query($connection, $query);
		//header("Refresh:0;");
		if (!$update_query_result) {
			die(mysqli_error($connection));
		} else {
			echo "Updated";
		}

	}
}

?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
</div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>









