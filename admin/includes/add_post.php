<div class="container">
	<div class="row">
		<div class="col_md-12">
			<form action="" method="post" enctype="multipart/form-data">


			  <div class="form-group">
			    <label for="post_title">Post Title</label>
			    <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Enter post title">
			  </div>
			  <div class="form-group">
			  <label for="select_category">Select Category</label>
			  <select name="cat_title" id="select_category" class="form-control">

			  <?php

$query = "SELECT * FROM categories";
$select_cat_query = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_cat_query)) {
	$cat_title = $row['cat_title'];
	$cat_id = $row['cat_id'];
	echo "<option value='$cat_id'>$cat_title</option>";
}

?>
				</select>
				</div>
			  <div class="form-group">
			    <label for="post_category_id">Post Category Id</label>
			    <input type="text" class="form-control" id="post_category_id" name="post_category_id"placeholder="Enter Post Category Id">
			  </div>
			  <div class="form-group">
			    <label for="post_author">Post Author</label>
			    <input type="text" class="form-control" id="post_author" name="post_author" placeholder="Enter Post Author">
			  </div>
			  <div class="form-group">
			    <label for="post_status">Post Status</label>
			    <select class="form-control" name="post_status" >
			    	<option value="">Select Status</option>
			    	<option value="published">Published</option>
			    	<option value="draft">Draft</option>
			    </select>
			  </div>
			   <div class="form-group">
			    <label for="post_image">Image</label>
			    <input type="file" id="post_image" name="post_image">
			  </div>
			  <div class="form-group">
			    <label for="post_tags">Post Tags</label>
			    <input type="text" class="form-control" id="post_tags" name="post_tags" placeholder="Enter Post Tags">
			  </div>
			  <div class="form-group">
			    <label for="post_content">Post Content</label>
			    <textarea class="form-control" rows="3" name="post_content"></textarea>
			  </div>
				<div class="form-group">
			    <label for="post_date">Post Date</label>
			    <input type="date" class="form_control" id="post_date" name="post_date">
			  </div>
			  <button type="submit" class="btn btn-primary" name="create_post">Publish Post</button>
			</form>
		</div>
	</div>
</div>

<?php
if (isset($_POST['create_post'])) {
	$post_title = $_POST['post_title'];
	$post_category_id = $_POST['post_category_id'];
	$post_author = $_POST['post_author'];
	$post_status = $_POST['post_status'];
	$post_image = $_FILES['post_image']['name'];
	$post_image_temp = $_FILES['post_image']['tmp_name'];
	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];
	$post_date = date('d-m-y');
	$post_comment_count = 0;
	move_uploaded_file($post_image_temp, "../images/$post_image");
	$query = "INSERT INTO posts(post_title,post_category_id,post_author,post_status,post_image,post_tags,post_content,post_date,post_comment_count) VALUES('{$post_title}','{$post_category_id}','{$post_author}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}','{$post_date}','{$post_comment_count}')";

	$create_post_query = mysqli_query($connection, $query);
	if (!$create_post_query) {
		die("Query Failed" . mysqli_error($connection));
	} else {
		echo "<p class='bg-success'>Post Added Successfully</p>";
	}
}

?>