                <div class="well">
                    <h4>Random 5 Posts</h4>
                    <p>
						<?php
							$random = "SELECT * FROM posts WHERE post_status = 'published'  ORDER BY RAND() LIMIT 5";
							$random_query = mysqli_query($connection,$random);
							while($ran = mysqli_fetch_assoc($random_query)){
								$ran_id = $ran['post_id'];
								$ran_title = substr($ran['post_title'],0,17);
								$ran_tit = strlen($ran['post_title']);
								$ran_image = $ran['post_image'];
								$ran_author = $ran['post_author'];
								$ran_date = $ran['post_date'];
								?>
<div class="row" style="padding:10px;">
	<p style="float:left"><span style="font-size:18px;"><a href="post/<?php echo $ran_id; ?>/<?php echo clean($ran_title);?>/"><?php echo $ran_title; if( $ran_tit > 17){echo "...";}else{}?></a></span><br><span style="font-size:12px;">By: <a href="author/<?php echo $ran_author; ?>/"><?php echo $ran_author;?></a> at <span class="glyphicon glyphicon-time"></span> <?php echo $ran_date;?></span></p>
	<a href="post/<?php echo $ran_id; ?>/<?php echo clean($ran_title);?>/">
		<img class="img-responsive" src="images/<?php echo $ran_image;?>" alt="" style="height:35px;float:right;" />
	</a>
</div>
								



								
								
								

								
								
								
<?php
								}
						
						
						
						
						?>
					</p>
                </div>
                <div class="well">
                    <h4>Most Viewed 5 Posts</h4>
                    <p>
						<?php
							$random = "SELECT * FROM posts WHERE post_status = 'published'  ORDER BY post_views DESC LIMIT 5";
							$random_query = mysqli_query($connection,$random);
							while($ran = mysqli_fetch_assoc($random_query)){
								$ran_id = $ran['post_id'];
								$ran_title = substr($ran['post_title'],0,17);
								$ran_tit = strlen($ran['post_title']);
								$ran_image = $ran['post_image'];
								$ran_author = $ran['post_author'];
								$ran_date = $ran['post_date'];
								?>
<div class="row" style="padding:10px;">
	<p style="float:left"><span style="font-size:18px;"><a href="post/<?php echo $ran_id; ?>/<?php echo clean($ran_title);?>/"><?php echo $ran_title; if( $ran_tit > 17){echo "...";}else{}?></a></span><br><span style="font-size:12px;">By: <a href="author/<?php echo $ran_author; ?>/"><?php echo $ran_author;?></a> at <span class="glyphicon glyphicon-time"></span> <?php echo $ran_date;?></span></p>
	<a href="post/<?php echo $ran_id; ?>/<?php echo clean($ran_title);?>/">
		<img class="img-responsive" src="images/<?php echo $ran_image;?>" alt="" style="height:35px;float:right;" />
	</a>
</div>
								



								
								
								

								
								
								
<?php
								}
						
						
						
						
						?>
					</p>
                </div>