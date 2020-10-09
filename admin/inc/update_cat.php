<?php
if(isset($_GET['edit'])){
	$get_cat_id = $_GET['edit'];
	$get_query = "SELECT * FROM `category` WHERE `cat_id` = $get_cat_id";
	$get_query_update = mysqli_query($connection,$get_query);
	if($update = mysqli_fetch_assoc($get_query_update)){
		$update_link = $update['cat_title'];
	}
}
?>
	<form action="<?php $_PHP_SELF;?>" method="post">
		<div class="form-group">
			<label for="edit_cat_title">Update Category</label>
			<input class="form-control" name="edit_cat_title" type="text" value="<?php if(isset($update_link)){echo $update_link;}?>"/>
		</div>
		<div class="form-group">
			<input type="submit" name="edit_submit" value="Update Category" class="btn btn-primary"/>
		</div>
	</form>
<?php
	$updated_cat_title = $_POST['edit_cat_title'];
	$updated_cat_title = mysqli_real_escape_string($connection,$updated_cat_title);
	if(isset($_POST['edit_submit'])){
	$edit_update = "UPDATE category SET cat_title = '{$updated_cat_title}' WHERE cat_id = $get_cat_id";
	$edit_update_query = mysqli_query($connection,$edit_update);
	header("Location: categories.php");
	}
?>