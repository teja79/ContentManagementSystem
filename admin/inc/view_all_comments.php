<table class="table table-bordered table-hover">
	<thead>
		<th>ID</th>
		<th>Author</th>
		<th>In response to</th>
		<th>Comment</th>
		<th>Date</th>
		<th>Email</th>
		<th>IP Address</th>
		<th>Status</th>
		<th>Approve</th>
		<th>Unapprove</th>
		<th>Delete</th>
	</thead>
	<tbody>
		<?php
			$comment_q = "SELECT * FROM comments ";
			$comment_q .= "ORDER BY comment_id DESC ";
			$comment_query = mysqli_query($connection, $comment_q);
			while($get_comments = mysqli_fetch_assoc($comment_query)){
				$comment_id = $get_comments['comment_id'];
				$comment_author = $get_comments['comment_author'];
				$comment_post_id = $get_comments['comment_post_id'];
				$comment_content = $get_comments['comment_content'];
				$comment_date = $get_comments['comment_date'];
				$comment_email = $get_comments['comment_email'];
				$comment_ip = $get_comments['comment_ip'];
				$comment_status = $get_comments['comment_status'];
				$default = "http://i.imgur.com/OjglHIB.png";
				$size = 25;
				$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $comment_email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
				$display_comment = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
				$display_comment_query = mysqli_query($connection, $display_comment);
				while($dis_com = mysqli_fetch_assoc($display_comment_query)){
					$dis_comment = $dis_com['post_title'];
				}
				echo "
					<tr>
						<td>$comment_id</td>
						<td><img src='$grav_url' width='25'/>$comment_author</td>
						<td><a href='../post.php?post=$comment_post_id' target='_blank'>$dis_comment</td>
						<td>$comment_content</td>
						<td>$comment_date</td>
						<td>$comment_email</td>
						<td><a href='http://ipaddress.is/$comment_ip' target='_blank'>$comment_ip</td>
						<td>$comment_status</td>
						<td><a href='comments.php?approve=$comment_id' class='btn btn-xs btn-primary'>Approve</a></td>
						<td><a href='comments.php?unapprove=$comment_id' class='btn btn-xs btn-danger'>Unapprove</a></td>
						<td><a href='comments.php?delete=$comment_id' class='btn btn-xs btn-danger'>Delete</a></td>
					</tr>
				";
			}
		?>
	</tbody>
</table>
<?php
if(isset($_GET['approve'])){
	$comment_pprove_id = $_GET['approve'];
	$approve_comments = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_pprove_id ";
	$delete_comment_query = mysqli_query($connection, $approve_comments);
	if($delete_comment_query){
		header("Location: comments.php");
	}else{
		die(mysqli_error($connection));
	}
}
if(isset($_GET['unapprove'])){
	$comment_unpprove_id = $_GET['unapprove'];
	$unapprove_comments = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_unpprove_id ";
	$delete_comment_query = mysqli_query($connection, $unapprove_comments);
	if($delete_comment_query){
		header("Location: comments.php");
	}else{
		die(mysqli_error($connection));
	}
}
if(isset($_GET['delete'])){
	$comment_delete_id = $_GET['delete'];
	$delete_comments = "DELETE FROM comments WHERE comment_id = {$comment_delete_id} ";
	$delete_comment_query = mysqli_query($connection, $delete_comments);
	if($delete_comment_query){
		header("Location: comments.php");
	}else{
		die(mysqli_error($connection));
	}
}
?>