<?php include "inc/ad_head.php";?>
    <div id="wrapper">
		<?php include "inc/ad_nav.php";?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users
                            <small>Page</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-group"></i> Users
                            </li>
                        </ol>
						<?php
						if(isset($_GET['page'])){
							$page = $_GET['page'];
						} else{
							$page = "";
						}
						switch($page){
							case 'add_users'; include "inc/add_users.php";
							break;
							case 'edit_users'; include "inc/edit_users.php";
							break;
							case 'log'; include "inc/users_log.php";
							break;
							default: include "inc/view_all_users.php";
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