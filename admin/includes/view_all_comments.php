
   <table class="table table-bordered table-hover">
                            <caption style="color:black;font-weight: bold;">All Comments</caption>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response To</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php

$query = "SELECT * FROM comments";
$select_all_comments = mysqli_query($connection, $query);
if (!$select_all_comments) {
	die("Query Failed" . mysqli_error($connection));
} else {
	while ($row = mysqli_fetch_assoc($select_all_comments)) {
		$comment_id = $row['comment_id'];
		$comment_post_id = $row['comment_post_id'];
		$comment_author = $row['comment_author'];
		$comment_email = $row['comment_email'];
		$comment_content = $row['comment_content'];
		$comment_status = $row['comment_status'];
		$comment_date = $row['comment_date'];

		?>



                                <tr>
                                    <td><?php echo $comment_id; ?></td>
                                    <td><?php echo $comment_author; ?></td>
                                     <td><?php echo $comment_content; ?></td>
                                     <td><?php echo $comment_email; ?></td>
                                     <td><?php echo $comment_status; ?></td>
<?php
$query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
		$select_post_title = mysqli_query($connection, $query);
		if (!$select_post_title) {
			die(mysqli_error($connection));
		}
		while ($row = mysqli_fetch_assoc($select_post_title)) {
			$post_title = $row['post_title'];
			$post_id = $row['post_id'];
			echo "<td><a href='../post.php?post_id=$post_id'>$post_title</a></td>";

			?>




                                     <td><?php echo $comment_date; ?></td>
                                     <td><a href='comments.php?approve=<?php echo $comment_id; ?>'>Approve</a></td>
                                     <td><a href='comments.php?unapprove=<?php echo $comment_id; ?>'>Unapprove</a></td>
                                     <td><a href='#'>Edit</a></td>
            <td><a onclick="return confirm('Are you sure you want to delete this item?');"  href='comments.php?delete=<?php echo $comment_id; ?>'>Delete</a></td>

            <?php }?>


                                    <?php /*
		$query = "SELECT * FROM categories WHERE cat_id='$post_category_id'";
		$select_cat_id = mysqli_query($connection, $query);
		if (!$select_cat_id) {
		die(mysqli_error($connection));
		} else {

		while ($row = mysqli_fetch_assoc($select_cat_id)) {
		$cat_title = $row['cat_title'];
		}
		}

		 */?>



                                </tr>
<?php
}
}

?>
                          </tbody>
                        </table>
<?php

if (isset($_GET['delete'])) {
	$comment_id = $_GET['delete'];
	$query = "DELETE FROM comments WHERE comment_id=$comment_id";
	$delete_comment_query = mysqli_query($connection, $query);
	header("Location:comments.php");
	if (!$delete_comment_query) {
		die(mysqli_error($connection));
	} else {
		echo "hello";
	}
}

//Approve Comments
if (isset($_GET['approve'])) {
	$comment_id = $_GET['approve'];
	$query = "UPDATE comments SET comment_status='Approved' WHERE comment_id=$comment_id";
	$approve_comment_query = mysqli_query($connection, $query);
	header("Location:comments.php");
	if (!$approve_comment_query) {
		die(mysqli_error($connection));
	} else {
		echo "hello";
	}
}

//UNApprove Comments
if (isset($_GET['unapprove'])) {
	$comment_id = $_GET['unapprove'];
	$query = "UPDATE comments SET comment_status='Unapproved' WHERE comment_id=$comment_id";
	$unapprove_comment_query = mysqli_query($connection, $query);
	header("Location:comments.php");
	if (!$unapprove_comment_query) {
		die(mysqli_error($connection));
	} else {
		echo "hello";
	}
}
?>

