
<?php
$db["host"] = "localhost";
$db["user"] = "root";
$db["password"] = "password";
$db["database"] = "cms";
foreach ($db as $key => $value) {
	define(strtoupper($key), $value);
}

$connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if ($connection) {
	echo "We are connected";
}
//$connection = mysqli_connect("localhost", "root", "password", "cms");
?>

