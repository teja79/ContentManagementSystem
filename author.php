<?php include "inc/db.php";?>
<?php include "inc/header.php";?>
<?php include "inc/nav.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php
if(isset($_GET['author'])){
$tha_author_id = $_GET['author'];
$query = $connection->prepare('SELECT * FROM posts WHERE post_author = ?');
$query->bind_param('s', $tha_author_id);
$query->execute();
$result = $query->get_result();
// $query = "SELECT * FROM posts WHERE post_id = $tha_post_id";
// $select_all_posts_query = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($result)){
    $post_id = $row["post_id"];
	$post_title = $row["post_title"];
	$post_author = $row["post_author"];
	$post_date = $row["post_date"];
	$post_content = substr($row["post_content"],0,75);
	$post_image = $row["post_image"];
	$post_tags = $row["post_tags"];
	?>
                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id; ?>/<?php echo clean($post_title);?>/"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author/<?php echo $post_author; ?>/"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
				<a href="post/<?php echo $post_id; ?>/<?php echo clean($post_title);?>/">
					<img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
				</a>
                <hr>
                <p><?php echo $post_content; ?> <a href="post/<?php echo $post_id; ?>/<?php echo clean($post_title);?>/">[ more... ]</a></p>
                <a class="btn btn-primary" href="post/<?php echo $post_id; ?>/<?php echo clean($post_title);?>/">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
<?php } }else{echo "Hack Attempt Logged!, You need a Author info to view this page";} ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
		<?php include "inc/sideb.php";?>
        </div>
        <!-- /.row -->
<script>
document.title = 'JP Blogs Author - <?php echo $post_author;?>';
</script>
<?php include "inc/footer.php";?>
