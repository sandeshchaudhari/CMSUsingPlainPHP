<?php include "db.php";?>
<?php session_start();?>
<?php

if (isset($_POST['login'])) {
	header("Location:../index.php");
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];
	echo $user_name;
	echo $password;
	$user_name = mysqli_real_escape_string($connection, $user_name);
	$password = mysqli_real_escape_string($connection, $password);
	$query = "SELECT * FROM users WHERE user_username='$user_name'";
	$select_user_query = mysqli_query($connection, $query);
	if (!$select_user_query) {
		die(mysqli_error($connection));
	}
	while ($row = mysqli_fetch_assoc($select_user_query)) {
		$user_id = $row['user_id'];
		$user_username = $row['user_username'];
		$user_password = $row['user_password'];
		$user_first_name = $row['user_first_name'];
		$user_last_name = $row['user_last_name'];
		$user_email = $row['user_email'];
		$user_role = $row['user_role'];
		$password = crypt($password, $user_password);
		if ($user_name !== $user_username && $password !== $user_password) {
			echo 'string';
			header("Location:../index.php");
		} else if ($user_name == $user_username && $password == $user_password) {

			$_SESSION['user_username'] = $user_username;
			$_SESSION['user_first_name'] = $user_first_name;
			$_SESSION['user_last_name'] = $user_last_name;
			$_SESSION['user_email'] = $user_email;
			$_SESSION['user_role'] = $user_role;
			header("Location:../admin");

		} else {
			echo "password mismatch";
			header("Location:../index.php");

		}
	}
}
?>
<?php

foreach (getallheaders() as $name => $value) {
	echo "$name: $value\n";
}

?>