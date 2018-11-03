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
if (isset($_GET['post_id'])) {
	$post_id = $_GET['post_id'];
	$query = "SELECT * FROM posts WHERE post_id=$post_id";
	$select_all_post_query = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($select_all_post_query)) {
		$post_title = $row['post_title'];
		$post_author = $row['post_author'];
		$post_date = $row['post_date'];
		$post_image = $row['post_image'];
		$post_content = $row['post_content'];
	}

	?>


                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
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

<?php }

?>
                <!-- Blog Comments -->

                <!-- Comments Form -->


                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="comment_author">Name</label>
                        <input type="text" class="form-control" id="comment_author" name="comment_author" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                         <label for="comment_email">Email address</label>
                        <input type="email" class="form-control" id="comment_email" name="comment_email" placeholder="Enter your Email">
                    </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit_comment">Submit</button>
                    </form>
                </div>

<?php
//Storing Comments in database
if (isset($_POST['submit_comment'])) {
	//Extracting values From Form
	$comment_post_id = $_GET['post_id'];
	$comment_author = $_POST['comment_author'];
	$comment_email = $_POST['comment_email'];
	$comment_content = $_POST['comment_content'];
	if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
		$query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES ('$comment_post_id','$comment_author','$comment_email','$comment_content','Unapprove',now())";
		$add_comment_result = mysqli_query($connection, $query);
		if (!$add_comment_result) {
			die(mysqli_error($connection));
		}
	} else {
		echo "<script>alert('Field cannot be empty.');</script>";
	}

}

?>


                <hr>



                <!-- Posted Comments -->

                <!-- Comment -->
                 <?php
$query = "SELECT * FROM comments WHERE comment_post_id=$post_id AND comment_status='Approved' ORDER BY comment_id ASC";
$print_comment_result = mysqli_query($connection, $query);
if (!$print_comment_result) {
	die(mysqli_error($connection));
} else {
	while ($row = mysqli_fetch_assoc($print_comment_result)) {
		$comment_author = $row['comment_author'];
		$comment_email = $row['comment_email'];
		$comment_content = $row['comment_content'];
		$comment_date = $row['comment_date'];

		?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>


<?php

	}

}
?>
 <?php
//Count Number of Comment
if (isset($_POST['submit_comment'])) {
	$query = "SELECT * FROM posts WHERE post_id=$post_id";
	$select_all_post = mysqli_query($connection, $query);
	if (!$select_all_post_query) {
		die(mysqli_error($connection));

	}
	while ($row = mysqli_fetch_assoc($select_all_post)) {
		$post_comment_count = $row['post_comment_count'];
		$post_comment_count = $post_comment_count + 1;
		$query = "UPDATE posts SET post_comment_count='$post_comment_count' WHERE post_id=$post_id";
		$post_comment_count_update_result = mysqli_query($connection, $query);
		if (!$post_comment_count_update_result) {
			mysqli_error($connection);
		}

	}

}

?>


        </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"
?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"?>
