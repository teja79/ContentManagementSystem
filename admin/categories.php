<?php include "inc/ad_head.php";?>
    <div id="wrapper">
		<?php include "inc/ad_nav.php";?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                            <small>Page</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i> Categories
                            </li>
                        </ol>
                    </div>
					<div class="col-xs-6">
						<?php add_cat(); ?>
						<form action="<?php $_PHP_SELF;?>" method="post">
							<div class="form-group">
								<label for="cat_title">Add Category</label>
								<input class="form-control" name="cat_title" type="text"/>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" value="Add Category" class="btn btn-primary"/>
							</div>
						</form>
					<?php //UPDATE QUERY
						if(isset($_GET['edit'])){
						include "inc/update_cat.php";
						}
					?>
					</div>
					<div class="col-xs-6">
						<?php //DELETE Categories
							delete_cat();
						?>
						<table class="table table-bordered table-hover">
							<thead>
								<th>ID</th>
								<th>Category</th>
								<th>Delete</th>
								<th>Edit</th>
							</thead>
							<tbody>
							<?php //Display TABLE
							display_table();
							?>
							</tbody>
						</table>
					</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php include "inc/ad_footer.php";?>