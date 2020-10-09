<?php ////GET FROM DATA FROM DATABSE
if(isset($_POST['edit_user'])){


}
$get_edit_id = $_GET['u_id'];
$edit_user = "SELECT * FROM users WHERE user_id = $get_edit_id ";
$edit_user_q = mysqli_query($connection, $edit_user);
while ($row = mysqli_fetch_assoc($edit_user_q)){
$username = $row['username'];
$password = $row['user_pass'];
$firstname = $row['user_firstname'];
$lastname = $row['user_lastname'];
$email = $row['user_email'];
$role = $row['user_role'];
}
?>
<?php
if(isset($_POST['edit_user'])){
	if($_GET['u_id'] == 1){
		echo "
			<div class='alert alert-danger'>
			<strong>Alert!</strong> You cannot edit Super Admin!
			</div>
		";
	}else{
		$user_id = $_GET['u_id'];
		$edit_username = $_POST['username'];
		$edit_username =

		$edit_user_firstname = $_POST['firstname'];
		$edit_user_firstname = mysqli_real_escape_string($connection,$edit_user_firstname);

		$edit_user_lastname = $_POST['lastname'];
		$edit_user_lastname = mysqli_real_escape_string($connection,$edit_user_lastname);

		$edit_user_role = $_POST['role'];
		$edit_user_role = mysqli_real_escape_string($connection,$edit_user_role);

		$edit_user_email = $_POST['email'];
		$edit_user_email = mysqli_real_escape_string($connection,$edit_user_email);

		$edit_user_update = date('Y-m-d H:i:s');

		$update_user_q = "UPDATE users SET ";
		$update_user_q .= "username = '{$edit_username}', ";
		$update_user_q .= "user_firstname = '{$edit_user_firstname}', ";
		$update_user_q .= "user_lastname = '{$edit_user_lastname}', ";
		$update_user_q .= "user_email = '{$edit_user_email}', ";
		$update_user_q .= "user_role = '{$edit_user_role}', ";
		$update_user_q .= "user_last_update = now() WHERE user_id = {$user_id}";
		$update_user_query = mysqli_query($connection, $update_user_q);
			if($update_user_query){
				header("Location: users.php");
			}else{
				die(mysqli_error($connection));
			}
	}
}
?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label for="usernam">UserName</label>
		<input value="<?php echo $username ;?>" type="text" class="form-control" name="username"/>
	</div>
	<div class="form-group">
		<label for="author">First Name</label>
		<input value="<?php echo $firstname ;?>" type="text" class="form-control" name="firstname"/>
	</div>
	<div class="form-group">
		<label for="author">Last Name</label>
		<input value="<?php echo $lastname ;?>" type="text" class="form-control" name="lastname"/>
	</div>
	<div class="form-group">
		<label for="role">User Role</label>
		<select name="role" class="form-control">
			<optgroup>
			<option value="<?php  echo $role; ?>" name="role"><?php  echo $role; ?></option>
			<?php
			 $user_role_get = "SELECT * FROM users WHERE user_id = $get_edit_id";
			 $user_role_query = mysqli_query($connection, $user_role_get);
			 while($cate = mysqli_fetch_assoc($user_role_query)){
				$post_user_role = $cate['user_role'];
				if($post_user_role == 'admin'){
				echo "<option value='subscriber' name='role'>Subscriber</option>";
				}else{
				echo "<option value='admin' name='role'>Admin</option>";	
				}
			 }
			?>
			</optgroup>
		</select>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input value="<?php echo $email ;?>" type="text" class="form-control" name="email"/>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="edit_user" value="Update User"/>
	</div>
</form>