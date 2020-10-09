<?php

if(isset($_POST['checkBoxArray'])){
	if($_SESSION['user'] == ravi){
		foreach ($_POST['checkBoxArray'] as $postidValue){
			$bulk_options = $_POST['bulk_options'];
				switch($bulk_options){
					case 'published':
					$bulk_publish = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postidValue} ";
					$bulk_publish_query = mysqli_query($connection,$bulk_publish);
					break;
				}
				switch($bulk_options){
					case 'draft':
					$bulk_draft = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postidValue} ";
					$bulk_draft_query = mysqli_query($connection,$bulk_draft);
					break;
				}
				switch($bulk_options){
					case 'delete':
					$bulk_delete = "DELETE FROM posts WHERE post_id = {$postidValue} ";
					$bulk_delete_query = mysqli_query($connection,$bulk_delete);
					break;
				}
		}
	}
}

?>
<form action="" method="post">
<?php
	if($_SESSION['user'] == ravi){
		?>
	<div id="bulkOptionContainer" class="col-xs-4">
		<select class="form-control" name="bulk_options" id="">
			<option value="">Select Options</option>
			<option value="published">Publish</option>
			<option value="draft">Draft</option>
			<option value="delete">Delete</option>
		</select>
	</div>
	<div>
		<input type="submit" name="submit" class="btn btn-success" value="Apply"/>
	</div><br/>
	<?php
	}
	?>
	<div>
		<a class="btn btn-primary" href="posts.php?page=add_posts">Add New</a>
	</div><br/>
	<table class="table table-bordered table-hover">
		<thead>
			<th><input id="selectAllBoxes" type="checkbox"/></th>
			<th>ID</th>
			<th>Author</th>
			<th>Category</th>
			<th>Title</th>
			<th>Date</th>
			<th>Image</th>
			<th>Content</th>
			<th>Tags</th>
			<th>Comments</th>
			<th>Status</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>
		<tbody>
			<?php
				$posts_q = "SELECT * FROM posts ";
				$post_query = mysqli_query($connection, $posts_q);
				while($get_posts = mysqli_fetch_assoc($post_query)){
					$post_id = $get_posts['post_id'];
					$post_author = $get_posts['post_author'];
					$post_category_id = $get_posts['post_category_id'];
					$post_title = $get_posts['post_title'];
					$post_date = $get_posts['post_date'];
					$post_image = $get_posts['post_image'];
					$post_content = substr($get_posts['post_content'],0,21);
					$post_tags = $get_posts['post_tags'];
					$post_comment_count = $get_posts['post_comment_count'];
					$post_status = $get_posts['post_status'];
					$display_cat = "SELECT * FROM category WHERE cat_id = $post_category_id ";
					$display_cat_query = mysqli_query($connection, $display_cat);
					while($dis_cat = mysqli_fetch_assoc($display_cat_query)){
						$dis_cate = $dis_cat['cat_title'];
					}
					echo "
						<tr>
							<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$post_id'/></td>
							<td>$post_id</td>
							<td>$post_author</td>
							<td>$dis_cate</td>
							<td><a href='../post.php?post=$post_id' target='_blank'>$post_title</td>
							<td>$post_date</td>
							<td><img src='../images/$post_image'width='100'/></td>
							<td>$post_content [..]</td>
							<td>$post_tags</td>
							<td>$post_comment_count</td>
							<td>$post_status</td>
							<td><a href='posts.php?page=edit_posts&p_id=$post_id' class='btn btn-xs btn-primary'>Edit</a></td>
							<td><a href='posts.php?delete=$post_id' class='btn btn-xs btn-danger'>Delete</a></td>
						</tr>
					";
				}
			?>
		</tbody>
	</table>
</form>
<?php
if(isset($_GET['delete'])){
	if($_SESSION['user'] == 'ravi'){
		$the_delete_id = $_GET['delete'];
		$delete_posts = "DELETE FROM posts WHERE post_id = {$the_delete_id} ";
		$delete_posts_query = mysqli_query($connection, $delete_posts);
		if($delete_posts_query){
			header("Location: posts.php");
		}else{
			die(mysqli_error($connection));
		}	
	}else{
		echo"
			<div class='alert alert-danger'>
			<strong>Alert!</strong> Your are not Super Admin to Delete Posts!
			</div>
		";
	}
}
?>