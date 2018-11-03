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
insert_category();
?>
                            <!--Add Category Form-->
                            <form action="" method="post">
                              <div class="form-group">
                                <label for="category">Add Category</label>
                                <input type="text" class="form-control" id="category" name="cat_title" placeholder="Category">
                              </div>


                              <button type="submit" class="btn btn-primary" name="submit">Add Category</button>
                            </form>
<!-------------------------Add Category Form End ------------------------------------------------------>

                            <!--Update Category form-->
<?php

if (isset($_GET['update'])) {
	$cat_id = $_GET['update'];

	include "includes/admin_category_update_form.php";

}

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
find_all_categories();
?>
<?php
//Delete selected category

delete_categories();

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









