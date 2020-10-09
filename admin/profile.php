<?php include "inc/ad_head.php";?>
    <div id="wrapper">
		<?php include "inc/ad_nav.php";?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Profile
                            <small><?php echo $_SESSION['user'];?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-group"></i> <?php echo $_SESSION['firstname'] . " " . $_SESSION[lastname];?>
                            </li>
                        </ol>
						<div class="col-lg-2">
						<?php
						echo "<img src='../images/cms.png' class='img-responsive'/><br>" . $_SESSION['user'];
						?>
						</div>
						<div class="col-lg-10">
						<h1>Your Personal Details</h1>
						<p>User Name: <?php echo $_SESSION['user']; ?></p>
						<p>First Name: <?php echo $_SESSION['firstname']; ?></p>
						<p>Last Name: <?php echo $_SESSION['lastname']; ?></p>
						<p>Email: <?php echo $_SESSION['email']; ?></p>
						<?php
							$select_user = "SELECT * FROM users WHERE username = '{$_SESSION['user']}' ";
							$select_query = mysqli_query($connection, $select_user);
							while($selected = mysqli_fetch_assoc($select_query)){
								$list_log = $selected['user_failed_log'];
								$login_log = $selected['user_lastlogin'];
								$list_explode = explode(',', $list_log, -1);
								$login_explode = explode(',', $login_log, -1);
								$count = 1;
								?>
					<div class="panel panel-green">
                        <div class="panel-heading">
                            Last Logins
                        </div>
                        <div class="panel-body">
							<?php
									foreach($login_explode as $logex){
							?>
											<div class='alert alert-success alert-dismissable'>
													<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
							<?php
								echo $logex . "<br/>" ;
							?>			
											</div>
											
							<?php
									}
							?>

                        </div>
                        <div class="panel-footer">
                            Please Be noted on these! There may be hack trials!
                        </div>
                    </div>
					<br/><br/>
					<div class="panel panel-red">
                        <div class="panel-heading">
                            Last 5 Failed Logins
                        </div>
                        <div class="panel-body">
							<?php
									$limit = 0;
									foreach($list_explode as $value) if($limit < 5){
							?>
											<div class='alert alert-danger alert-dismissable'>
													<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
							<?php
								$limit++;
								echo  $count++ .")". "&nbsp;&nbsp;" .$value . "<br>" ;
							?>			
											</div>
											
							<?php
									}
								}
							?>

                        </div>
                        <div class="panel-footer">
                            Please Be noted on these! There may be hack trials!
                        </div>
                    </div>
						</div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php include "inc/ad_footer.php";?>