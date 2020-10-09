<?php

//////////// ADDING CATEGORIES 

	function add_cat(){
		global $connection;
		//ADD Categories
		if(isset($_POST['cat_title'])){
			$cate_title = $_POST[cat_title];
			$cate_title = mysqli_real_escape_string($connection,$cate_title);
			if($cate_title == "" || empty($cate_title)){
				echo "
					<div class='alert alert-warning'>
						<strong>Warning!</strong> You need to write something before clicking submit stupid!
					</div>
				";
			}else{
				$cate_query = "INSERT INTO `category`";
				$cate_query.=" (`cat_id`, `cat_title`) VALUES (NULL, '$cate_title')";
				$cate_add_cat_query = mysqli_query($connection,$cate_query);
				if($cate_add_cat_query){
					echo "
						<div class='alert alert-success'>
						<strong>Congrats!</strong> Added To database.
						</div>
					";
				}else{
					echo "
						<div class='alert alert-danger'>
						<strong>Sorry!</strong> Couldn't add that.
						</div>
					";
					die(mysqli_error($connection));
				}
			}
		}
		
		
	}
	
//////////// DISPLAYING TABLE
	
	function display_table() {
		global $connection;
		$cat_admin ="SELECT * FROM category";
		$cat_admin_select = mysqli_query($connection,$cat_admin);
		while($cat = mysqli_fetch_assoc($cat_admin_select)){
			$cat_id = $cat["cat_id"];
			$cat_title = $cat["cat_title"];
			echo"
			<tr>
				<td>$cat_id</td>
				<td>$cat_title</td>
				<td><a href='categories.php?delete={$cat_id}' class='btn btn-xs btn-danger'>Delete</td>
				<td><a href='categories.php?edit={$cat_id}' class='btn btn-xs btn-primary'>Edit</td>
			</tr>
			";
		}
		
		
		
		
	}

//////////////// DELETE CATEGORIES

	function delete_cat(){
		global $connection;
		if(isset($_GET['delete'])){
		$get_cat_id = $_GET['delete'];
		$delete_query = "DELETE FROM `category` WHERE `cat_id` = {$get_cat_id}";
		$delete_cat_query = mysqli_query($connection,$delete_query);
		header("Location: categories.php");
		}
	}
?>