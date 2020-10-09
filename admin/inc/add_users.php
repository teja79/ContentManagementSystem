<?php
if(isset($_POST['add_user'])){
	$username = $_POST['username'];
	$username = mysqli_real_escape_string($connection,$username);
	
	$password = $_POST['password'];
	$password = mysqli_real_escape_string($connection,$password);
	$password = password_hash($password, PASSWORD_BCRYPT);
	
	$firstname = $_POST['firstname'];
	$firstname = mysqli_real_escape_string($connection,$firstname);
	
	$lastname = $_POST['lastname'];	
	$lastname = mysqli_real_escape_string($connection,$lastname);
	
	$email = $_POST['email'];
	$email = mysqli_real_escape_string($connection,$email);
	
	$role = $_POST['role'];
	$role = mysqli_real_escape_string($connection,$role);
	
	$date = date('Y-m-d H:i:s');
	
	$add_user_q = "INSERT INTO users(username, user_pass, user_firstname, user_lastname, user_email, user_role,user_acc_date) ";
	$add_user_q .= "VALUES ('{$username}', '{$password}', '{$firstname}', '{$lastname}', '{$email}', '{$role}', now() ) ";
	$add_user_query = mysqli_query($connection, $add_user_q);
	if($add_user_query){
		echo "
			<div class='alert alert-success'>
			<strong>Congrats!</strong> Added To database.
			</div>
		";
	}else{
		die("FAILED <br>" .mysqli_error($connection));
	}
}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label for="username">UserName</label>
		<input type="text" class="form-control" name="username"/>
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password"/>
	</div>
	<div class="form-group">
		<label for="role">User Role</label>
		<select name="role" class="form-control">
			<optgroup>
			<option value="subscriber" name="role">Select Option</option>
			<option value="admin" name="role">Admin</option>
			<option value="subscriber" name="role">Subscriber</option>
			</optgroup>
		</select>
	</div>
	<div class="form-group">
		<label for="firstname">First Name</label>
		<input type="text" class="form-control" name="firstname"/>
	</div>
	<div class="form-group">
		<label for="lasttname">Last Name</label>
		<input type="text" class="form-control" name="lastname"/>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" name="email"/>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="add_user" value="Add User"/>
	</div>
</form>