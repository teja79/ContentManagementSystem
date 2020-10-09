<?php
if(isset($_POST['submit_post'])){
	$title = $_POST['title'];
	$title = mysqli_real_escape_string($connection,$title);
	
	$author = $_SESSION['user'];
	$author = mysqli_real_escape_string($connection,$author);
	
	$cat_id = $_POST['cat_id'];
	$cat_id = mysqli_real_escape_string($connection,$cat_id);
	
	$image = $_FILES['image']['name'];
	$image_temp = $_FILES['image']['tmp_name'];
	
	$status = $_POST['status'];
	$status = mysqli_real_escape_string($connection,$status);
	
	$tags = $_POST['tags'];
	$tags = mysqli_real_escape_string($connection,$tags);
	
	$date = date('d-m-y');
	
	$content = $_POST['content'];
	$content = mysqli_real_escape_string($connection,$content);
	
	$commment_count = 0;
	
	move_uploaded_file($image_temp, "../images/$image");
	$add_posts_q = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,post_status) ";
	$add_posts_q .= "VALUES ('{$cat_id}', '{$title}', '{$author}', now(), '{$image}', '{$content}', '{$tags}', '{$status}') ";
	$add_posts_query = mysqli_query($connection, $add_posts_q);
	if($add_posts_query){
		echo "
			<div class='alert alert-success'>
			<strong>Congrats!</strong> Added To database.
			</div>
		";
	}else{
		die("FAILED" .mysqli_error($connection));
	}
}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title"/>
	</div>
	<div class="form-group">
		<label for="cat_id">Post Category</label>
		<select name="cat_id" class="form-control">
			<optgroup>
			<?php
			 $category = "SELECT * FROM category";
			 $category_query = mysqli_query($connection, $category);
			 while($cate = mysqli_fetch_assoc($category_query)){
				$post_cate = $cate['cat_title'];
				$post_cate_id = $cate['cat_id'];
				echo "<option value='$post_cate_id' name='cat_id'>$post_cate</option>";
			 }
			?>
			</optgroup>
		</select>
	</div>
<!--	<div class="form-group">
		<label for="cat_id">Post Category id</label>
		<input type="text" class="form-control" name="cat_id"/>
	</div>-->
	<div class="form-group">
		<label for="image">Post Image</label>
		<input type="file" name="image"/>
	</div>
	<div class="form-group">
		<label for="status">Post Status</label>
		<select name="status" class="form-control">
			<option value="draft">Draft</option>
			<option value="published">Published</option>
		</select>
	</div>
	<div class="form-group">
		<label for="tags">Post Tags</label>
		<input type="text" class="form-control" name="tags"/>
	</div>
	<div class="form-group">
		<label for="content">Post Content</label>
		<textarea type="text" class="form-control" name="content" cols="30" rows="10"></textarea>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="submit_post" value="Add Post"/>
	</div>
</form>