<?php include "inc/db.php";?>
<?php include "inc/header.php";?>
<?php include "inc/nav.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Search
                    <small><?php echo $_POST['search']; ?></small>
                </h1>
<?php

if(isset($_POST['submit']) && !empty($_POST["search"])){
	$search = $_POST['search'];
	$search = mysqli_real_escape_string($connection,$search);
	$s_query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' UNION SELECT * FROM posts WHERE post_title LIKE '%$search%' UNION SELECT * FROM posts WHERE post_content LIKE '%$search%'  UNION SELECT * FROM posts WHERE post_author LIKE '%$search%' ";
	$keywords = explode(" ",$search);
	foreach($keywords as $key)
		$s_query .="UNION SELECT * FROM posts WHERE post_tags LIKE '%$key%' UNION SELECT * FROM posts WHERE post_title LIKE '%$key%' UNION SELECT * FROM posts WHERE post_content LIKE '%$key%'  UNION SELECT * FROM posts WHERE post_author LIKE '%$key%' ";
	$search_query = mysqli_query($connection,$s_query);
	
	if(!$search_query){
		die("Query Failed" . mysqli_error($connection));
	}
	
	$count = mysqli_num_rows($search_query);
	
	if($count==0){
		echo "No Results Found";
	}else{
		while($row = mysqli_fetch_assoc($search_query)){
			$post_id = $row['post_id'];
			$post_title = $row["post_title"];
			$post_author = $row["post_author"];
			$post_date = $row["post_date"];
			$post_content = substr($row["post_content"],0,75);
			$post_image = $row["post_image"];
            $post_status = $row["post_status"];
            if($post_status != "published"){
                $count--;
                if($count==0){
                  echo "No Results Found";
                }
                continue;
            }
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
<?php 

							}
							
						}

} 


?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
		<?php include "inc/sideb.php";?>

        </div>
        <!-- /.row -->

<?php include "inc/footer.php";?>
