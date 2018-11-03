<?php include "includes/db.php"
?>
<?php include "includes/header.php"
?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php
if (isset($_GET['post_author'])) {
	$post_author = $_GET['post_author'];
	$query = "SELECT * FROM posts WHERE post_author='$post_author'";
	$select_authors_post = mysqli_query($connection, $query);
	if (!$select_authors_post) {
		die(mysqli_error($connection) . " " . mysqli_errno($connection));
	}
	while ($row = mysqli_fetch_assoc($select_authors_post)) {
		$post_title = $row['post_title'];
		$post_author = $row['post_author'];
		$post_date = $row['post_date'];
		$post_image = $row['post_image'];
		$post_content = $row['post_content'];

		?>



                <h1 class="page-header">
                    All Posts By <?php echo $post_author; ?>

                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" >
                <hr>
                <p><?php echo $post_content; ?></p>


                <hr>

<?php }}

?>

        </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"
?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"?>