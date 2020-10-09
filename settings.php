<?php include "inc/db.php";?>
<?php include "inc/header.php";?>
<?php include "inc/nav.php";?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
			<?php if(isset($_SESSION['user'])){?>
				<div class="col-lg-10">
						<?php
							$user = $_SESSION['user'];
							$select = "SELECT * FROM users WHERE username = '{$user}' ";
							$select_query = mysqli_query($connection, $select);
							while($setting = mysqli_fetch_assoc($select_query)){
								$username = $setting['username'];
								$firstname = $setting['user_firstname'];
								$lastname = $setting['user_lastname'];
								$password = $setting['user_pass'];
								$emailname = $setting['user_email'];
							}
						?>
						<?php
						if(isset($_POST['add_user'])){
							
							$first_name = $_POST['firstname'];
							$first_name = mysqli_real_escape_string($connection,$first_name);
							
							$last_name = $_POST['lastname'];	
							$last_name = mysqli_real_escape_string($connection,$last_name);
							
							$email = $_POST['email'];
							$email = mysqli_real_escape_string($connection,$email);
							
							$date = date('Y-m-d H:i:s');
							$add_user_q = "UPDATE users SET ";
							$add_user_q .="user_firstname = '{$first_name}', ";
							$add_user_q .="user_lastname = '{$last_name}', ";
							$add_user_q .="user_email = '{$email}', ";
							$add_user_q .="user_last_update = now() ";
							$add_user_q .= "WHERE username = '{$user}' ";
							$add_user_query = mysqli_query($connection, $add_user_q);
							if($add_user_query){
								echo "
									<div class='alert alert-success'>
									<strong>Congrats!</strong> Updated!.
									</div>
								";
							}else{
								die("Seems Like UserName already exists, or Please try again");
							}
						}

						?>
						<form method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label for="firstname">First Name</label>
								<input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>"/>
							</div>
							<div class="form-group">
								<label for="lasttname">Last Name</label>
								<input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>"/>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" value="<?php echo $emailname; ?>"/>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary" name="add_user" value="Update"/>
							</div>
						</form>
						<h3>Update Password</h3>
						<?php
							if(isset($_POST['update_pass'])){
								$newpass = $_POST['newpass'];
								$newpass = mysqli_real_escape_string($connection,$newpass);
								
								$newpass_r = $_POST['newpass_r'];
								$newpass_r = mysqli_real_escape_string($connection,$newpass_r); 
								
								$oldpass = $_POST['oldpassword'];
								$oldpass = mysqli_real_escape_string($connection,$oldpass); 
								
								if($oldpass){
									if($newpass == $newpass_r){
										if(password_verify($oldpass,$password)){
											$newpass = password_hash($newpass, PASSWORD_BCRYPT);
											$update_pass = "UPDATE users SET user_pass = '{$newpass}' WHERE username = '{$user}' ";
											$update_pass_q = mysqli_query($connection,$update_pass);
											echo "Updated Password!";
										}else{
											echo "Error Old Pass you entered is Wrong!";
										}
									}else{
										echo "Password and repeat Must be same!";
									}
								}else{
									echo "Old Password is required!";
								}
							}
						
						?>
						<form method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label for="old password">Old Password</label>
								<input type="password" class="form-control" name="oldpassword"/>
							</div>
							<div class="form-group">
								<label for="old password">New Password</label>
								<input type="password" class="form-control" name="newpass"/>
							</div>
							<div class="form-group">
								<label for="old password">Repeat New Password</label>
								<input type="password" class="form-control" name="newpass_r"/>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary" name="update_pass" value="Update"/>
							</div>
						</form>
				</div>
				<?php }else{
					echo"You are not Logged in to See this page! Logged as Hack Attempt!";
				}?>
			</div>
			<?php include "inc/sideb.php";?>
        </div>
        <!-- /.row -->
<?php include "inc/footer.php";?>