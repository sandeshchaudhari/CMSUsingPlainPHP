<?php
if (isset($_POST['add_user'])) {
	$user_first_name = $_POST['user_first_name'];
	$user_last_name = $_POST['user_last_name'];
	$user_role = $_POST['user_role'];
	$user_username = $_POST['user_username'];
	$user_image = $_FILES['user_image']['name'];
	$user_image_temp = $_FILES['user_image']['tmp_name'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];
	//$post_date = date('d-m-y');
	//$post_comment_count = 0;
	move_uploaded_file($user_image_temp, "../images/$user_image");
	$query = "INSERT INTO users(user_first_name,user_last_name,user_role,user_username,user_email,user_password,user_image,rand_salt) VALUES('{$user_first_name}','{$user_last_name}','{$user_role}','{$user_username}','{$user_email}','{$user_password}','{$user_image}','')";

	$add_user_query = mysqli_query($connection, $query);

	if (!$add_user_query) {
		die("Query Failed" . mysqli_error($connection));
	} else {
		echo "User Created";
	}
}

?>
<div class="container">
	<div class="row">
		<div class="col_md-12">
			<form action="" method="post" enctype="multipart/form-data">


			  <div class="form-group">
			    <label for="user_first_name">FirstName</label>
			    <input type="text" class="form-control" id="user_first_name" name="user_first_name" placeholder="Enter your first name">
			  </div>

			  <div class="form-group">
			    <label for="user_last_name">LastName</label>
			    <input type="text" class="form-control" id="user_last_name" name="user_last_name"placeholder="Enter your last name">
			  </div>
			  <div class="form-group">
			  	<label for="select_role">Select Role</label>
			  	<select name="user_role" id="user_role">
			  		<option value='Subscriber'>Select Role</option>
			  		<option value='Subscriber'>Subscriber</option>
			  		<option value='Admin'>Admin</option>
			  	</select>
			  </div>


			  <div class="form-group">
			    <label for="user_username">UserName</label>
			    <input type="text" class="form-control" id="user_username" name="user_username" placeholder="Enter Username">
			  </div>
			  <div class="form-group">
			    <label for="user_email">Email</label>
			    <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Enter your email">
			  </div>
			  <div class="form-group">
			    <label for="post_status">Password</label>
			    <input type="password" class="form-control" id="post_status" name="user_password" placeholder="Enter your password">
			  </div>
			   <div class="form-group">
			    <label for="user_image">Image</label>
			    <input type="file" id="user_image" name="user_image">
			  </div>


				<!--<div class="form-group">
			    <label for="post_date">Post Date</label>
			    <input type="date" class="form_control" id="post_date" name="post_date">
			  </div>-->
			  <button type="submit" class="btn btn-primary" name="add_user">Add User</button>
			</form>
		</div>
	</div>
</div>



<!--
<?php/*

$query = "SELECT * FROM users";
$select_role_query = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_role_query)) {
	$user_id = $row['user_id'];
	$user_role = $row['user_role'];
	echo "<option value='$user_id'>$user_role</option>";
}

*/?>