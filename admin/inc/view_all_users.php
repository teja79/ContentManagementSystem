<table class="table table-bordered table-hover">
	<thead>
		<th>ID</th>
		<th>UserName</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Account Creation</th>
		<th>Last Logins</th>
		<th>Role</th>
		<th>Edit</th>
		<th>Admin</th>
		<th>Subscriber</th>
		<th>Delete</th>
		<th>Log</th>
	</thead>
	<tbody>
		<?php
			$user_q = "SELECT * FROM users ";
			$user_q .= "ORDER BY user_id DESC ";
			$user_query = mysqli_query($connection, $user_q);
			while($user_details = mysqli_fetch_assoc($user_query)){
				$user_id = $user_details['user_id'];
				$username = $user_details['username'];
				$user_firstname = $user_details['user_firstname'];
				$user_lastname = $user_details['user_lastname'];
				$user_email = $user_details['user_email'];
				$user_acc_date = $user_details['user_acc_date'];
				$user_lastlogin = $user_details['user_lastlogin'];
				$user_role = $user_details['user_role'];
				$default = "http://i.imgur.com/OjglHIB.png";
				$size = 25;
				$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user_email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
				echo "
					<tr>
						<td>$user_id</td>
						<td><img src='$grav_url' width='25'/>$username</td>
						<td>$user_firstname</td>
						<td>$user_lastname</td>
						<td>$user_email</td>
						<td>$user_acc_date</td>
						<td>$user_lastlogin</td>
						<td>$user_role</td>
						<td><a href='users.php?page=edit_users&u_id=$user_id' class='btn btn-xs btn-primary'>Edit</a></td>
						<td><a href='users.php?admin=$user_id' class='btn btn-xs btn-primary'>Admin</a></td>
						<td><a href='users.php?sub=$user_id' class='btn btn-xs btn-primary'>Subscriber</a></td>
						<td><a href='users.php?delete=$user_id' class='btn btn-xs btn-danger'>Delete</a></td>
						<td><a href='users.php?page=log&log=$user_id' class='btn btn-xs btn-primary'>Log</a></td>
					</tr>
				";
			}
		?>
	</tbody>
</table>
<?php
if(isset($_GET['admin'])){
	if($_GET['admin'] == 1){
		echo"
			<div class='alert alert-danger'>
			<strong>Alert!</strong> You cannot change super admin rights!
			</div>
		";
	}else{
		$make_admin_id = $_GET['admin'];
		$admin_user = "UPDATE users SET user_role = 'admin' WHERE user_id = $make_admin_id ";
		$delete_comment_query = mysqli_query($connection, $admin_user);
		if($delete_comment_query){
			header("Location: users.php");
		}else{
			die(mysqli_error($connection));
		}
	}
}
if(isset($_GET['sub'])){
	if($_GET['sub'] == 1){
		echo"
			<div class='alert alert-danger'>
			<strong>Alert!</strong> You cannot change super admin rights!
			</div>
		";
	}else{
		$make_sub_id = $_GET['sub'];
		$sub_user = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $make_sub_id ";
		$delete_comment_query = mysqli_query($connection, $sub_user);
		if($delete_comment_query){
			header("Location: users.php");
		}else{
			die(mysqli_error($connection));
		}
	}
}
if(isset($_GET['delete'])){
	if($_GET['delete'] == 1){
		echo"
			<div class='alert alert-danger'>
			<strong>Alert!</strong> You cannot delete SuperAdmin!
			</div>
		";
	}else{
		$user_delete_id = $_GET['delete'];
		$delete_users = "DELETE FROM users WHERE user_id = {$user_delete_id} ";
		$delete_users_query = mysqli_query($connection, $delete_users);
		if($delete_users_query){
			header("Location: users.php");
		}else{
			die(mysqli_error($connection));
		}
	}
}
?>