
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index/">CMS Project</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
					<?php if($_SESSION['user']){
                    echo "
					<li>
                        <a href='profile.php'>Profile</a>
                    </li>
					<li>
                        <a href='settings.php'>Settings</a>
                    </li>
					<li>
                        <a href='logout.php'>Logout</a>
                    </li>
					";
						if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'superadmin'){
                    echo "
					<li>
                        <a href='admin/'>Admin</a>
                    </li>
					";
						}
					}
					?>
					<li>
						<a href="" align="right">Users Online: <?php echo $count_present;?></a>
					</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
