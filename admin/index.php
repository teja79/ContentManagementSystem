<?php include "inc/ad_head.php";?>

    <div id="wrapper">

		<?php include "inc/ad_nav.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $_SESSION['user'];?> <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
										<?php
											$posts = "SELECT * FROM posts";
											$posts_query = mysqli_query($connection,$posts);
											$post_count = mysqli_num_rows($posts_query);
											echo $post_count;
										?>
										</div>
                                        <div>Total Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
										<?php
											$comments = "SELECT * FROM comments";
											$comment_query = mysqli_query($connection,$comments);
											$comment_count = mysqli_num_rows($comment_query);
											echo $comment_count;
										?>
										</div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
										<?php
											$users = "SELECT * FROM users";
											$user_query = mysqli_query($connection,$users);
											$user_count = mysqli_num_rows($user_query);
											echo $user_count;
										?>
										</div>
                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
										<?php
											$category = "SELECT * FROM category";
											$category_query = mysqli_query($connection,$category);
											$category_count = mysqli_num_rows($category_query);
											echo $category_count;
										?>
										</div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
<!--                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                            </div>
                            <div class="panel-body"> 
                                <div id="morris-area-chart"></div>
								
                            </div>
                        </div> 
                    </div>-->
				  <script type="text/javascript">
					  google.load("visualization", "1.1", {packages:["bar"]});
					  google.setOnLoadCallback(drawChart);
					  function drawChart() {
						var data = google.visualization.arrayToDataTable([
						  ['Data', 'Count'],
						  <?php
							$posts_active = "SELECT * FROM posts WHERE post_status = 'published' ";
							$posts_active_query = mysqli_query($connection,$posts_active);
							$post_active_count = mysqli_num_rows($posts_active_query);
							$posts_draft = "SELECT * FROM posts WHERE post_status = 'draft' ";
							$posts_draft_query = mysqli_query($connection,$posts_draft);
							$post_draft_count = mysqli_num_rows($posts_draft_query);
							$pending_comments = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
							$pending_comment_query = mysqli_query($connection,$pending_comments);
							$pending_comment_count = mysqli_num_rows($pending_comment_query);
							$subscribers = "SELECT * FROM users WHERE user_role = 'subscriber' ";
							$subscribers_query = mysqli_query($connection,$subscribers);
							$subscribers_count = mysqli_num_rows($subscribers_query);
							
							$title = ['Total Posts', 'Published Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
							$count = [$post_count, $post_active_count, $post_draft_count, $comment_count, $pending_comment_count, $user_count, $subscribers_count, $category_count];
							for($i =0; $i < 8; $i++){
								echo "['{$title[$i]}'" . "," . "{$count[$i]}],";
							}
						  ?>
						  // ['2014', 1000],
						  // ['2015', 1170],
						  // ['2016', 660],
						  // ['2017', 1030]
						]);

						var options = {
						  chart: {
							title: '',
							subtitle: '',
						  }
						};

						var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

						chart.draw(data, options);
					  }
					</script>
					<div id="columnchart_material" style="height: 500px;"></div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "inc/ad_footer.php";?>