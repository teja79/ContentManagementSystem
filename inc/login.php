<?php
include_once "db.php";
ob_start();
function getUserIP() {
	if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
		if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
			$addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
			return trim($addr[0]);
		} else {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	}
	else {
		return $_SERVER['REMOTE_ADDR'];
	}
}
$user_ip = getUserIP();
session_start();
if(isset($_POST['login'])){
	$get_username = $_POST['username'];
	$get_password = $_POST['password'];
	$get_username = mysqli_real_escape_string($connection,$get_username);
	$get_password = mysqli_real_escape_string($connection,$get_password);
	$time_log = date('Y-m-d H:i:s');
	$select_user = "SELECT * FROM users";
	$select_user_query = mysqli_query($connection,$select_user);
	while($login = mysqli_fetch_assoc($select_user_query)){
		$username = $login['username'];
		$password = $login['user_pass'];
		$email = $login['user_email'];
		$firstname = $login['user_firstname'];
		$lastname = $login['user_lastname'];
		$log = $login['user_failed_log'];
		$hack_pass = $login['user_failed_pass'];
		$role = $login['user_role'];
		$user_lastlogin = $login['user_lastlogin'];
		$failed_now = $login['failed_now'];
		$failed_time = $login['failed_time'];
		
		if($username == $_POST['username'] && password_verify($_POST['password'],$password)){
			if($failed_now > 3){
				if(($failed_time+(15*60))>time()){
					$new_time=($failed_time+15*60)-time();
					header("Location: ../index.php?error=Your account is locked for 15 minutes. Please try after {$new_time} Seconds");
					die();
				}else{
					$_SESSION['user'] = $username;
					$_SESSION['role'] = $role;
					$_SESSION['email'] = $email;
					$_SESSION['firstname'] = $firstname;
					$_SESSION['lastname'] = $lastname;
					$login_insert = "UPDATE users SET user_lastlogin = '$user_ip {$time_log}, $user_lastlogin', failed_now=0 WHERE username = '{$username}' ";
					$login_insert_query = mysqli_query($connection,$login_insert);
					if($role == 'admin'){
						header("Location: ../admin");
						die();
					}else{
						header("Location: ../index.php");
						die();
					}
				}
			}else{
				$_SESSION['user'] = $username;
				$_SESSION['role'] = $role;
				$_SESSION['email'] = $email;
				$_SESSION['firstname'] = $firstname;
				$_SESSION['lastname'] = $lastname;
				$login_insert = "UPDATE users SET user_lastlogin = '$user_ip {$time_log}, $user_lastlogin' WHERE username = '{$username}' ";
				$login_insert_query = mysqli_query($connection,$login_insert);
				if($role == 'admin'){
					header("Location: ../admin");
					die();
				}else{
					header("Location: ../index.php");
					die();
				}
			}
		}elseif($username == $get_username && !password_verify($_POST['password'],$password)){
			$curr_time = time();
			$update = "UPDATE users SET user_failed_log = '$user_ip {$time_log}, $log' , user_failed_pass = '$get_password {$time_log}, $hack_pass', failed_now =failed_now+1, failed_time={$curr_time} WHERE username = '{$username}' ";
			$update_log_query = mysqli_query($connection, $update);
			if($failed_now > 3){
				$new_time=($failed_time+15*60)-time();
				header("Location: ../index.php?error=Your account is locked for 15 minutes. Please try after {$new_time} Seconds");
				die();
			}
			header("Location: ../index.php?error=Wrong-Password");
			die();
		}
	}
	header("Location: ../index.php?error=Invalid-Login-Details");
	die();
}else{
header("Location: ../index.php");
die();	
}
?>