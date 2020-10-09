<?php

error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set("Asia/Kolkata");
// $db = ["db_host"=>"localhost","db_user"=>"root","db_pass"=>"LR050ab$","db_name"=>"cms"];

$db["db_host"] = "localhost";
$db["db_user"] = "root";
$db["db_pass"] = "";
$db["db_name"] = "blog_copy";

foreach($db as $key => $value){
	
	define(strtoupper($key), $value);
	
	
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

session_start();

	$session = session_id();
	$time = time();
	$time_out = $time - 30;

	$select_online = "SELECT * FROM users_online WHERE session = '{$session}' ";
	$select_send = mysqli_query($connection,$select_online);
	$count_select = mysqli_num_rows($select_send);
	if($count_select == null){
		mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session', '$time')");
	}else{
		mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session' ");
	}
	$select_online = mysqli_query($connection,"SELECT * FROM users_online WHERE time > '{$time_out}' ");
	$count_present = mysqli_num_rows($select_online);
if(isset($_SESSION['user'])){
	$user_session = "SELECT * FROM users WHERE username = '{$_SESSION['user']}'";
	$user_session_query = mysqli_query($connection,$user_session);
	while($sess = mysqli_fetch_assoc($user_session_query)){
		$current_role = $sess['user_role'];
	}
	if($_SESSION['role'] == $current_role){
	}else{
		session_destroy();
		header("Location: index.php");
	}
}else{
	
}

function clean($string) {

    $string = strtolower($string);
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function getPostDetails($tha_post_id){
    global $connection;
    $query = $connection->prepare('SELECT * FROM posts WHERE post_id = ?');
    $query->bind_param('s', $tha_post_id);
    $query->execute();
    $result = $query->get_result();
    // $query = "SELECT * FROM posts WHERE post_id = $tha_post_id";
    // $select_all_posts_query = mysqli_query($connection,$query);

    $post_view = "UPDATE posts SET post_views = post_views+1 WHERE post_id = $tha_post_id ";
    $post_view_query = mysqli_query($connection,$post_view);

    $row = mysqli_fetch_assoc($result);
    return $row;
}

?>