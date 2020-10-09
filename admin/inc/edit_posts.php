<?php ////GET FROM DATA FROM DATABSE
if(isset($_POST['edit_submit_post'])){


}
$get_edit_id = $_GET['p_id'];
$edit_posts = "SELECT * FROM posts WHERE post_id = $get_edit_id ";
$edit_posts_q = mysqli_query($connection, $edit_posts);
while ($row = mysqli_fetch_assoc($edit_posts_q)){
$post_title = $row['post_title'];
$post_author = $row['post_author'];
$post_category_id = $row['post_category_id'];
$post_image = $row['post_image'];
$post_status = $row['post_status'];
$post_tags = $row['post_tags'];
$post_content = $row['post_content'];
}
?>
<?php
if(isset($_POST['edit_submit_post'])){
	if($_SESSION['user'] == 'ravi'){
		$the_post_id = $_GET['p_id'];
		$edit_title = $_POST['edit_title'];
		$edit_title = mysqli_real_escape_string($connection,$edit_title);

		$edit_author = $_SESSION['user'];
		$edit_author = mysqli_real_escape_string($connection,$edit_author);

		$post_category = $_POST['post_category'];
		$post_category = mysqli_real_escape_string($connection,$post_category);

		$edit_image = $_FILES['edit_image']['name'];

		$edit_image_tmp = $_FILES['edit_image']['tmp_name'];

		$edit_status = $_POST['edit_status'];
		$edit_status = mysqli_real_escape_string($connection,$edit_status);

		$edit_tags = $_POST['edit_tags'];
		$edit_tags = mysqli_real_escape_string($connection,$edit_tags);

		$edit_content = $_POST['edit_content'];
		$edit_content = mysqli_real_escape_string($connection,$edit_content);

		move_uploaded_file($edit_image_tmp, "../images/$edit_image");
		if(empty($edit_image)){
			$empty_image = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' ";
			$empty_image_query = mysqli_query($connection,$empty_image);
			while($image = mysqli_fetch_assoc($empty_image_query)){
				$edit_image = $image['post_image'];
			}
		}
		$update_post_q = "UPDATE posts SET ";
		$update_post_q .= "post_title = '{$edit_title}', ";
		$update_post_q .= "post_category_id = '{$post_category}', ";
		$update_post_q .= "post_image = '{$edit_image}', ";
		$update_post_q .= "post_status = '{$edit_status}', ";
		$update_post_q .= "post_tags = '{$edit_tags}', ";
		$update_post_q .= "post_content = '{$edit_content}' ";
		$update_post_q .= "WHERE post_id = '{$the_post_id}' ";
		$update_post_query = mysqli_query($connection, $update_post_q);
		if($update_post_query){
			header("Location: posts.php");
		}else{
			die(mysqli_error($connection));
		}	
	}elseif($_SESSION['user'] == $post_author){
		$the_post_id = $_GET['p_id'];
		$edit_title = $_POST['edit_title'];
		$edit_title = mysqli_real_escape_string($connection,$edit_title);

		$edit_author = $_SESSION['user'];
		$edit_author = mysqli_real_escape_string($connection,$edit_author);

		$post_category = $_POST['post_category'];
		$post_category = mysqli_real_escape_string($connection,$post_category);

		$edit_image = $_FILES['edit_image']['name'];

		$edit_image_tmp = $_FILES['edit_image']['tmp_name'];

		$edit_status = $_POST['edit_status'];
		$edit_status = mysqli_real_escape_string($connection,$edit_status);

		$edit_tags = $_POST['edit_tags'];
		$edit_tags = mysqli_real_escape_string($connection,$edit_tags);

		$edit_content = $_POST['edit_content'];
		$edit_content = mysqli_real_escape_string($connection,$edit_content);

		move_uploaded_file($edit_image_tmp, "../images/$edit_image");
		if(empty($edit_image)){
			$empty_image = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' ";
			$empty_image_query = mysqli_query($connection,$empty_image);
			while($image = mysqli_fetch_assoc($empty_image_query)){
				$edit_image = $image['post_image'];
			}
		}
		$update_post_q = "UPDATE posts SET ";
		$update_post_q .= "post_title = '{$edit_title}', ";
		$update_post_q .= "post_author = '{$edit_author}', ";
		$update_post_q .= "post_category_id = '{$post_category}', ";
		$update_post_q .= "post_image = '{$edit_image}', ";
		$update_post_q .= "post_status = '{$edit_status}', ";
		$update_post_q .= "post_tags = '{$edit_tags}', ";
		$update_post_q .= "post_content = '{$edit_content}' ";
		$update_post_q .= "WHERE post_id = '{$the_post_id}' ";
		$update_post_query = mysqli_query($connection, $update_post_q);
		if($update_post_query){
			header("Location: posts.php");
		}else{
			die(mysqli_error($connection));
		}
	}
	else{
		echo"
			<div class='alert alert-danger'>
			<strong>Alert!</strong> You cannot edit other Admin Posts
			</div>
		";
	}
}
?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input value="<?php echo $post_title ;?>" type="text" class="form-control" name="edit_title"/>
	</div>
	<div class="form-group">
		<label for="cat_id">Post Category</label>
		<select name="post_category" class="form-control">
			<optgroup>
			<option value='<?php echo $post_category_id; ?>' name='post_category'>No Changes</option>
			<?php
			 $category = "SELECT * FROM category";
			 $category_query = mysqli_query($connection, $category);
			 while($cate = mysqli_fetch_assoc($category_query)){
				$post_cate = $cate['cat_title'];
				$post_cate_id = $cate['cat_id'];
				echo "<option value='$post_cate_id' name='post_category'>$post_cate</option>";
			 }
			?>
			</optgroup>
		</select>
	</div>
	<div class="form-group">
		<label for="image">Post Image</label>
		<img src="../images/<?php echo $post_image ;?>" height="25"/><input type="file" name="edit_image"/>
	</div>
	<div class="form-group">
		<label for="edit_status">Post Status</label>
		<select name="edit_status" class="form-control">
			<option value="<?php echo $post_status ;?>">No Changes - <?php echo ucfirst($post_status) ;?></option>
			<option value="draft">Draft</option>
			<option value="published">Published</option>
		</select>
	</div>
	<div class="form-group">
		<label for="tags">Post Tags</label>
		<input value="<?php echo $post_tags ;?>" type="text" class="form-control" name="edit_tags"/>
	</div>
	<div class="form-group">
		<label for="content">Post Content</label>
		<textarea type="text" class="form-control" name="edit_content" cols="30" rows="10"><?php echo $post_content ;?></textarea>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="edit_submit_post" value="Update Post"/>
	</div>
</form>