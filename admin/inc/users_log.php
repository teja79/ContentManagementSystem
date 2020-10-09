<?php
if($_SESSION['role'] == 'superadmin'){
	if(isset($_GET['log'])){
	$log_id = $_GET['log'];
	$error = "SELECT * FROM users WHERE user_id = $log_id ";
	$error_query = mysqli_query($connection, $error);
		while($log = mysqli_fetch_assoc($error_query)){
			$list_log = $log['user_failed_log'];
			$list_pass = $log['user_failed_pass'];
			$user_name = $log['username'];
			$list_explode = explode(',', $list_log, -1);
			$list_passid = explode(',', $list_pass, -1);
			$count = 1;
			$countp = 1;
			?>
			<h2>User: </h2><h3><?php echo $user_name; ?></h3>
			<pre> <?php
				foreach($list_explode as $value){
					echo $value . " <=" . $count++ ."<br>" ;
				}	
		?>
			</pre>
			<h3>Pass Trails</h3>
			<pre> <?php
				foreach($list_passid as $valuep){
					echo $valuep . " <=" . $countp++ ."<br>" ;
				}	
		?>
			</pre>
			<?php
		}
	}
}else{
	die("This Feature is Only for Super Admins");
}
?>