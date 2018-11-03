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
             <h1 class="page-header text-center">
                Welcome To My First Project
                    <small>Developed By Sandesh </small>
                </h1>

            <?php

$query = "SELECT * FROM posts";
$select_all_post_query = mysqli_query($connection, $query);
if (!$select_all_post_query) {
	die(mysqli_error($connection));
}
//counting no of pages for pagination
$count_no_posts = mysqli_num_rows($select_all_post_query);
$no_of_pages = ceil($count_no_posts / 2);
echo $no_of_pages;
$post_no = 0;
$page_no = 1;
if (isset($_GET['page_no'])) {
	$page_no = $_GET['page_no'];
	$post_no = $page_no * 2 - 2;
} else {
	$post_no = 0;
}

$pagination_query = "SELECT * FROM posts LIMIT $post_no,2";
$pagination_query_result = mysqli_query($connection, $pagination_query);
if (!$pagination_query_result) {
	die(mysqli_error($connection));
}
while ($row = mysqli_fetch_assoc($pagination_query_result)) {
	$post_id = $row['post_id'];
	$post_title = $row['post_title'];
	$post_author = $row['post_author'];
	$post_date = $row['post_date'];
	$post_image = $row['post_image'];
	$post_content = $row['post_content'];
	?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?post_author=<?php echo $post_author; ?>&post_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>"></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

<?php }

?>



            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"
?>

        </div>
        <!--Pagination !-->

        <div class="text-center">
            <nav aria-label="Page navigation" >
  <ul class="pagination ">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>

    <?php
for ($i = 1; $i <= $no_of_pages; $i++) {
	if ($i == $page_no) {
		echo "<li ><a class='active-link' href='index.php?page_no=$i'>$i</a></li>";
	} else {
		echo "<li><a href='index.php?page_no=$i'>$i</a></li>";
	}

}
?>



    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
        </div>

        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"?>
