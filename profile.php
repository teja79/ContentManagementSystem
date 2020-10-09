<?php include "inc/db.php";?>
<?php include "inc/header.php";?>
<?php include "inc/nav.php";?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
			<?php if(isset($_SESSION['user'])){?>
				<div class="col-lg-2">
				<?php
				$user_mail = $_SESSION['email'];
				$default = "http://i.imgur.com/OjglHIB.png";
				$size = 250;
				$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user_mail ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
				echo "<img src='$grav_url' class='img-responsive'/><br>" . $_SESSION['user'];
				?>
				</div>
				<div class="col-lg-8">
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
					<div class="panel panel-success">
                        <div class="panel-heading">
                            Last 5 Logins
                        </div>
                        <div class="panel-body">
							<?php
									$limit = 0;
									foreach($login_explode as $logex)if($limit < 5){
							?>
											<div class='alert alert-success alert-dismissable'>
													<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<?php
								$limit++;
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
					<div class="panel panel-danger">
                        <div class="panel-heading">
                            Last 5 Failed Logins
                        </div>
                        <div class="panel-body">
							<?php
									$limit = 0;
									foreach($list_explode as $value) if($limit < 5){
							?>
											<div class='alert alert-danger alert-dismissable'>
													<a type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
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
				<?php }else{
					echo"You are not Logged in to See this page! Logged as Hack Attempt!";
				}?>
			</div>
			<?php include "inc/sideb.php";?>
        </div>
        <!-- /.row -->
<?php include "inc/footer.php";?>