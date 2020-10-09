<?php include "inc/db.php";?>
<?php include "inc/header.php";?>
<?php include "inc/nav.php";?>
<?php $post_category_id = $_GET['category'];

$cat_query = $connection->prepare('SELECT * FROM category WHERE cat_id = ?');
$cat_query->bind_param('s', $post_category_id);
$cat_query->execute();
$get_cat_query = $cat_query->get_result();


// $cat_query = "SELECT * FROM category WHERE cat_id = $post_category_id";
// $get_cat_query = mysqli_query($connection,$cat_query);
while($row = mysqli_fetch_assoc($get_cat_query)){
	$cat_title = $row['cat_title'];
}
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Category
                    <small><?php echo $cat_title; ?></small>
                </h1>
<script>
document.title = 'JP Blogs Categories - <?php echo $cat_title;?>';
</script>
<?php
$query = $connection->prepare('SELECT * FROM posts WHERE post_category_id = ?');
$query->bind_param('s', $post_category_id);
$query->execute();
$select_all_posts_query = $query->get_result();


// $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
// $select_all_posts_query = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_all_posts_query)){
	$post_id = $row["post_id"];
	$post_title = $row["post_title"];
	$post_author = $row["post_author"];
	$post_date = $row["post_date"];
	$post_content = substr($row["post_content"],0,75);
	$post_image = $row["post_image"];
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
<?php } ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
		<?php include "inc/sideb.php";?>

        </div>
        <!-- /.row -->

<?php include "inc/footer.php";?>
