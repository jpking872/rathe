<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
				<h1 class="site-title">
					<a href="./"><img src="images/logoWhite.svg" alt="logo" width="84" height="32"></a>
				</h1>
													
				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">
					<i class="fa fa-bars"></i>
				</a>
				<ul class="nav nav-pills flex-column sidebar-nav">
					<li class="nav-item"><a class="nav-link" href="./">
						<i class="fa fa-dashboard"></i> Dashboard <span class="sr-only">(current)</span></a>
					</li>


					<li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-1">
						<i class="fa fa-book">&nbsp;</i> My Titles 
						<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
							<i class="fa fa-plus"></i>
						</span>
					</a>
						<ul class="children collapse" id="sub-item-1">
							<li class="nav-item"><a class="nav-link" href="new_title.php"> Add Title </a></li>
							<li class="nav-item"><a class="nav-link" href="view_titles.php"> Edit Title </a></li>

						</ul>
					</li>


					<li class="nav-item"><a class="nav-link" href="earnings.php">
						<i class="fa fa-bar-chart"></i> Earnings</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="profile.php">
						<i class="fa fa-user-circle mr-1"></i> Profile</a>
					</li>

					<li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-2">
						<i class="fa fa-file-o">&nbsp;</i> Reporting 
						<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
							<i class="fa fa-plus"></i>
						</span>
					</a>
						<ul class="children collapse" id="sub-item-2">
							

							<li class="nav-item"><a class="nav-link" href="#">
								Bookshelf
							</a></li>
						</ul>
					</li>
					<li class="nav-item"><a class="nav-link" href="myblog.php"><i class="fa fa-newspaper-o"></i> My Blog</a></li>
					
					
				</ul>
				<a href="../login.php" class="logout-button"><em class="fa fa-power-off"></em> Signout</a>
			</nav>