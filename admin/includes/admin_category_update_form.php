<?php
if (isset($_GET['update'])) {
	$cat_id = $_GET['update'];
	$query = "SELECT * FROM categories WHERE cat_id='$cat_id'";
	$select_cat_id = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($select_cat_id)) {

		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];

		?>
                    <form action="" method="post">
                    <div class="form-group">
                    <label for="category">Update Category</label>';
                    <input type='text' class='form-control' id='category' value=<?php echo $cat_title; ?>  name='cat_title' placeholder='Category'>;
                    <br>
                    <button type='submit' class='btn btn-primary' name='update'>Update Category</button>
                    </div>
                    </form>

 <?php
}
}

?>

<?php
//Update Category
if (isset($_POST['update'])) {
	$cat_title = $_POST['cat_title'];
	$query = "UPDATE categories SET cat_title='$cat_title' WHERE cat_id='$cat_id'";
	$category_update_result = mysqli_query($connection, $query);
	if (!$category_update_result) {
		die("Query Failed" . mysqli_error($connection));
	}
	header("Refresh:0; url=categories.php");
}
//Update Category End
?>
