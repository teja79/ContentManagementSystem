<?php include "inc/db.php";?>
<?php include "inc/header.php";?>
<?php include "inc/nav.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    jpU.Ooo Blogs
                    <small>
					<?php
					if($_SESSION['user']){
					echo $_SESSION['user'];	
					}else{
					 echo "Latest Posts";	
					}
					?>
					</small>
                </h1>
<?php
$howmany = 3;
if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}

if($page == "" || $page == 1 || $page == null){
	$limit = 0;
}else{
	$limit = ($page*$howmany) - $howmany;
}

?>
<?php

$count_posts = "SELECT * FROM posts WHERE post_status = 'published' ";
$count_query = mysqli_query($connection,$count_posts);
$posts_count = mysqli_num_rows($count_query);
$pages = ceil($posts_count/$howmany);


// $query = "SELECT * FROM posts WHERE post_status = 'published' ";
// $query .= "ORDER BY post_id DESC LIMIT $limit, $howmany ";
// $select_all_posts_query = mysqli_query($connection,$query);



$query = $connection->prepare("SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT ?, ? ");
$query->bind_param('ii', $limit,$howmany);
$query->execute();
$select_all_posts_query = $query->get_result();




while($row = mysqli_fetch_assoc($select_all_posts_query)){
	$post_id = $row["post_id"];
	$post_title = $row["post_title"];
	$post_author = $row["post_author"];
	$post_date = $row["post_date"];
	$post_content = substr($row["post_content"],0,15);
	$post_image = $row["post_image"];
	$post_status = $row["post_status"];
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
<ul class="pagination">
<?php

for($i=1; $i <= $pages; $i++){
	if($i == $page){
		echo "<li class='active'><a href='page/$i/'>$i</a></li>";
	}else{
		echo "<li><a href='page/$i/'>$i</a></li>";
	}
}
?>
</ul>
            </div>

            <!-- Blog Sidebar Widgets Column -->
		<?php include "inc/sideb.php";?>

        </div>
        <!-- /.row -->

<?php include "inc/footer.php";?>
