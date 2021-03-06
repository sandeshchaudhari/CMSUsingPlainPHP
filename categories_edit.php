<?php include "includes/admin_header.php"
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
                        <div class="col-md-6">
                        <?php
if (isset($_POST['submit'])) {

	$cat_title = $_POST['cat_title'];
	$cat_title = trim($cat_title);
	if ($cat_title == " " OR empty($cat_title)) {

		echo "<h1>This field should not be empty</h1>";
	} else {

		$query = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
		$add_category = mysqli_query($connection, $query);
		if (!$add_category) {

			die("<h1>Qurery Failed</h1>" . mysqli_error($connection));
		}

	}

}

?>
                            <!--Add Category Form-->
                            <form action="" method="post">
                              <div class="form-group">
                                <label for="category">Add Category</label>
                                <input type="text" class="form-control" id="category" name="cat_title" placeholder="Category">
                              </div>


                              <button type="submit" class="btn btn-primary" name="submit">Add Category</button>
                            </form>
<!--------------------------Add Category Form End------------------------------------------------------------>

                            <!--Update Category form-->
                            <?php

if (isset($_GET['update'])) {
	$cat_id = $_GET['update'];
	?>
                            <form action="" method="post">
                              <div class="form-group">

                                <?php
if (isset($_GET['update'])) {
		$cat_id = $_GET['update'];
		$query = "SELECT * FROM categories WHERE cat_id='$cat_id'";
		$select_cat_id = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_assoc($select_cat_id)) {

			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];

			?>
     <label for="category">Update Category</label>';
    <input type='text' class='form-control' id='category' value=<?php echo $cat_title; ?>  name='cat_title' placeholder='Category'>;
        <br>
    <button type='submit' class='btn btn-primary' name='update'>Update Category</button>";

 <?php
}
	}

	?>
                        </div>


                            </form>
<?php
//Update Category
	if (isset($_POST['update'])) {
		$cat_title = $_POST['cat_title'];
		$query = "UPDATE categories SET cat_title='$cat_title' WHERE cat_id='$cat_id'";
		$category_update_result = mysqli_query($connection, $query);
		if (!$category_update_result) {
			die("Query Failed" . mysqli_error($connection));
		}
	}
//Update Category End
	?>


<?php }

?>

                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Category Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
//Select all Categories
$query = "SELECT * FROM categories";
$select_all_category = mysqli_query($connection, $query);
if (!$select_all_category) {
	die("Query Failed" . mysqli_error($connection));
} else {
	while ($row = mysqli_fetch_assoc($select_all_category)) {
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];
		echo "<tr>";
		echo "<td>$cat_id</td>";
		echo "<td>$cat_title</td>";
		echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
		echo "<td><a href='categories.php?update={$cat_id}'>Update</a></td>";
		echo "</tr>";
	}
}

?>
<?php
//Delete selected category

if (isset($_GET['delete'])) {
	$get_cat_id = $_GET['delete'];
	$query = "DELETE FROM categories WHERE cat_id=$get_cat_id";
	$delete_query_result = mysqli_query($connection, $query);
	header("Refresh:0; url=categories.php"); //Refresh the page
	if (!$delete_query_result) {
		die("Query Failed" . mysqli_error($connection));
	}
}

?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
</div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>









