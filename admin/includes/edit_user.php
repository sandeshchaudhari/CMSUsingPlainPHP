
<?php

if (isset($_GET['user_id'])) {
	$user_id = $_GET['user_id'];
	$query = "SELECT * FROM users WHERE user_id=$user_id";
	$edit_user_query = mysqli_query($connection, $query);
	if (!$edit_user_query) {
		die(mysql_error($connection));
	} else {
		while ($row = mysqli_fetch_assoc($edit_user_query)) {
			$user_first_name = $row['user_first_name'];
			$user_last_name = $row['user_last_name'];
			$user_role = $row['user_role'];
			$user_username = $row['user_username'];
			$user_image = $row['user_image'];
			//$user_image = $_FILES['user_image']['name'];
			//$user_image_temp = $_FILES['user_image']['tmp_name'];
			$user_email = $row['user_email'];
			$user_password = $row['user_password'];
			//move_uploaded_file($user_image_temp, "../images/$user_image");

		}
	}

}

?>


<div class="container">
	<div class="row">
		<div class="col_md-12">
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
			  <button type="submit" class="btn btn-primary" name="update_user">Update User</button>
			</form>
		</div>
	</div>
</div>


<?php
//Updating Form Data to Database
if (isset($_GET['user_id'])) {
	$post_id = $_GET['user_id'];
	if (isset($_POST['update_user'])) {
		$user_first_name = $_POST['user_first_name'];
		$user_last_name = $_POST['user_last_name'];
		$user_role = $_POST['user_role'];
		$user_username = $_POST['user_username'];
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];
		//Encrypting password
		//Fetching randsalt from database
		$query = "SELECT rand_salt FROM users";
		$select_rand_salt_query = mysqli_query($connection, $query);
		if (!$select_rand_salt_query) {
			die(mysqli_error($connection));
		}
		while ($row = mysqli_fetch_assoc($select_rand_salt_query)) {
			$rand_salt = $row['rand_salt'];
			//echo $rand_salt;

		}
		$user_password = crypt($user_password, $rand_salt);

		$user_image = $_FILES['user_image']['name'];
		$user_image_temp = $_FILES['user_image']['tmp_name'];

		move_uploaded_file($user_image_temp, "../images/$user_image");
		$query = "UPDATE users SET user_first_name='$user_first_name',user_last_name='$user_last_name',user_role='$user_role',user_username='$user_username',user_email='$user_email',user_password='$user_password',user_image='$user_image' WHERE user_id=$user_id";
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

