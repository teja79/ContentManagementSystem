            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
					<form action="search/" method="post">
                        <span class="input-group-btn">
                            <input type="text" name="search" class="form-control" autocomplete="off">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
					</form>
                    </div>
                    <!-- /.input-group -->
                </div>
                <div class="well">
                    <p>Sponsors</p>
                    <iframe data-aa='1026461' src='//acceptable.a-ads.com/1026461' scrolling='no' style='border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
                </div>
                <!-- Blog Login Well -->
				<?php 
				if($_SESSION['user']){
				}else{
				?>
                <div class="well">
					<?php
						if(isset($_GET['error'])){
							$error = $_GET['error'];
							echo "
							<div class='alert alert-danger'>
								<strong>Error: </strong> $error 
							</div>
							<div class='alert alert-warning'>
								<strong>Warning: </strong> Note that Username and Password are case sensitive! 
							</div>
							";
						}else{
							
						}
					?>
                    <h4>Login</h4>
					<form action="inc/login.php" method="post">
						<div class="form-group">
							<input type="text" name="username" placeholder="Username" class="form-control" autocomplete="off"/>
						</div>
						<div class="input-group">
							<input type="password" name="password" class="form-control" placeholder="Password"/>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" name="login">
                                    <span>Login</span>
                                </button>
                            </span>
						</div>
					</form>
                </div>
				<?php
				}
				?>
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
							<?php
								$cat_query = "SELECT * FROM category";
								$get_cat_query = mysqli_query($connection,$cat_query);
								while($row = mysqli_fetch_assoc($get_cat_query)){
									$cat_title = $row['cat_title'];
									$cat_id = $row['cat_id'];
                                    $cleanedStr = clean($cat_title);
									echo "
										<li><a href='category/{$cat_id}/{$cleanedStr}/'>{$cat_title}</a>
										</li>
									";
								}
								
							?>
                            </ul>
                        </div>
                        <!-- /.col-lg-8 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
				<?php include "newpost.php";?>

            </div>