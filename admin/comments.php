<?php include "inc/ad_head.php";?>
    <div id="wrapper">
		<?php include "inc/ad_nav.php";?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Comments
                            <small>Page</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Comments
                            </li>
                        </ol>
						<?php
						if(isset($_GET['page'])){
							$page = $_GET['page'];
						} else{
							$page = "";
						}
						switch($page){
							case 'add_posts'; include "inc/add_posts.php";
							break;
							case 'edit_posts'; include "inc/edit_posts.php";
							break;
							case '36'; echo "36";
							break;
							default: include "inc/view_all_comments.php";
							break;
						}
						?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php include "inc/ad_footer.php";?>