<?php include "includes/db.php";?>
 <?php include "includes/header.php";?>


    <!-- Navigation -->

    <?php include "includes/navigation.php";?>


    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
            <?php
//Resistration Form
//Extracting values From form
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	if (!empty($username) && !empty($email) && !empty($password)) {
		$username = mysqli_real_escape_string($connection, $username);
		$password = mysqli_real_escape_string($connection, $password);
		$query = "SELECT rand_salt FROM users";
		$select_rand_salt_query = mysqli_query($connection, $query);
		if (!$select_rand_salt_query) {
			die(mysqli_error($connection));
		}
		while ($row = mysqli_fetch_assoc($select_rand_salt_query)) {
			$rand_salt = $row['rand_salt'];
			echo $rand_salt;

		}
		$password = crypt($password, $rand_salt);
		$query = "INSERT INTO users(user_username,user_password,user_email,user_role,user_first_name,user_last_name,user_image) VALUES('$username','$password','$email','subscriber','','','')";
		$user_registration_query = mysqli_query($connection, $query);
		if (!$user_registration_query) {
			die(mysqli_error($connection) . '' . mysqli_errno($connection));
		}
		$message = "You have been Registered Successfully";
	} else {
		$message = "Fields Cannot Be empty";
	}

} else {
	$message = "";
}

//Ecaping values for preventing hacking

//storing into database

?>
                <div class="form-wrap">
                <h6 class="text-center bg-success"><?php echo $message; ?></h6>
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
