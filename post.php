<?php include "inc/db.php";?>
<?php include "inc/header.php";?>
<?php include "inc/nav.php";?>

<style>
    img {
        max-width: 100%;
        height: auto;
    }
</style>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php
if(isset($_GET['post'])){
$tha_post_id = $_GET['post'];
$query = $connection->prepare('SELECT * FROM posts WHERE post_id = ?');
$query->bind_param('s', $tha_post_id);
$query->execute();
$result = $query->get_result();
// $query = "SELECT * FROM posts WHERE post_id = $tha_post_id";
// $select_all_posts_query = mysqli_query($connection,$query);

$post_view = "UPDATE posts SET post_views = post_views+1 WHERE post_id = $tha_post_id ";
$post_view_query = mysqli_query($connection,$post_view);

while($row = mysqli_fetch_assoc($result)){
	
	$post_title = $row["post_title"];
	$post_author = $row["post_author"];
	$post_date = $row["post_date"];
	$post_content = $row["post_content"];
	$post_image = $row["post_image"];
	$post_tags = $row["post_tags"];
	$post_views = $row["post_views"];
	?>

                <!-- First Blog Post -->
                <h2>
                    <?php echo $post_title; ?>
                </h2>
                <p class="lead">
                    by <a href="author/<?php echo $post_author; ?>/"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
       
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
				<p><span style="font-size:16px;"><span class="glyphicon glyphicon-tags"></span> <b>Tags:</b> <?php echo $post_tags; ?></span></p>
				<p><span style="font-size:16px;"><span class="glyphicon glyphicon-eye-open"></span> <b>Post Views</b> <?php echo $post_views; ?></span></p>
				<!-- Go to www.addthis.com/dashboard to customize your tools -->
				<div class="sharethis-inline-share-buttons"></div>
                <hr>
						<div class="well">
						<?php
							if(isset($_POST['submit_comment'])){
									if(isset($_SESSION[user])){
										if(!empty($_POST['comment_content'])){
											$comment_author = $_SESSION['user'];
											$comment_email = $_SESSION['email'];
											$comment_content = $_POST['comment_content'];
											$comment_author = mysqli_real_escape_string($connection,$comment_author);
											$comment_email = mysqli_real_escape_string($connection,$comment_email);
											$comment_content = mysqli_real_escape_string($connection,$comment_content);
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
											$comment_ip = getUserIP();
											$add_comment = "INSERT INTO comments (comment_post_id, comment_author, comment_content, comment_date, comment_email, comment_ip, comment_status) ";
											$add_comment .= "VALUES ($tha_post_id, '{$comment_author}', '{$comment_content}', now(), '{$comment_email}', '{$comment_ip}', 'approved') ";
											$add_comment_query = mysqli_query($connection, $add_comment);
											if(!$add_comment_query){
												die(mysqli_error($connection));
											}else{
												echo "
												<div class='alert alert-info'>
													Comment Added!
												</div>
												";
												$update_comments = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
												$update_comments .= "WHERE post_id = $tha_post_id";
												$update_comments_query - mysqli_query($connection, $update_comments);
											}
									}else{
										echo "<div class='alert alert-danger'>
												<strong>Oh snap!</strong> All Fields are required!
											</div>";	
									}
									}else{
										if(!empty($_POST['comment_author']) && !empty($_POST['comment_email']) && !empty($_POST['comment_content'])){
											$comment_author = $_POST['comment_author'];
											$comment_email = $_POST['comment_email'];
											$comment_content = $_POST['comment_content'];
											$comment_author = mysqli_real_escape_string($connection,$comment_author);
											$comment_email = mysqli_real_escape_string($connection,$comment_email);
											$comment_content = mysqli_real_escape_string($connection,$comment_content);
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
											$comment_ip = getUserIP();
											$add_comment = "INSERT INTO comments (comment_post_id, comment_author, comment_content, comment_date, comment_email, comment_ip) ";
											$add_comment .= "VALUES ($tha_post_id, '{$comment_author}', '{$comment_content}', now(), '{$comment_email}', '{$comment_ip}') ";
											$add_comment_query = mysqli_query($connection, $add_comment);
											if(!$add_comment_query){
												die(mysqli_error($connection));
											}else{
												echo "
												<div class='alert alert-info'>
													Comment Added and awaiting moderation!
												</div>
												";
												$update_comments = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
												$update_comments .= "WHERE post_id = $tha_post_id";
												$update_comments_query - mysqli_query($connection, $update_comments);
											}
										}else{
											echo "<div class='alert alert-danger'>
													<strong>Oh snap!</strong> All Fields are required!
												</div>";
											}
								}
							}	
						?>
						<?php 
							if(isset($_SESSION['user'])){
						?>
						<form action="" method="post">
							<div class="form-group">
								<label for="comment_content">Your Comment</label>
								<textarea class="form-control" name="comment_content"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" name="submit_comment" value="Add Comment" class="btn btn-primary"/>
							</div>
						</form>
						</div>
						<?php
							}
							else{
						?>
						<form action="" method="post">
							<div class="form-group">
								<label for="comment_author">Name</label>
								<input type="name" name="comment_author" class="form-control"/>
							</div>
							<div class="form-group">
								<label for="comment_email">Email</label>
								<input type="email" name="comment_email" class="form-control"/>
							</div>
							<div class="form-group">
								<label for="comment_content">Your Comment</label>
								<textarea class="form-control" name="comment_content"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" name="submit_comment" value="Add Comment" class="btn btn-primary"/>
							</div>
						</form>
						</div>
						<?php
							}
						?>
                <!-- Comment -->
						<?php
							$comment_q = $connection->prepare("SELECT * FROM comments WHERE comment_post_id = ? AND comment_status = 'approved' ORDER BY comment_id DESC ");
							$comment_q->bind_param('s', $tha_post_id);
							$comment_q->execute();
							$comment_query = $comment_q->get_result();
							while($get_comments = mysqli_fetch_assoc($comment_query)){
								$comment_email = $get_comments['comment_email'];
								$comment_author = $get_comments['comment_author'];
								$comment_content = $get_comments['comment_content'];
								$comment_date = $get_comments['comment_date'];
								$default = "https://i.imgur.com/OjglHIB.png";
								$size = 64;
								$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $comment_email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
							?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="<?php echo $grav_url ;?>" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;?>
                            <small><?php echo $comment_date ;?></small>
                        </h4>
                        <?php echo $comment_content ;?>
                    </div>
                </div>
				<hr>
						<?php	
							}
						?>
<?php  } }else{echo "Hack Attempt Logged!, You need a post id to view this page";} ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
		<?php include "inc/sideb.php";?>

        </div>
        <!-- /.row -->
<script>
document.title = 'CMS Project - <?php echo $post_title?>';
</script>
<?php include "inc/footer.php";?>
