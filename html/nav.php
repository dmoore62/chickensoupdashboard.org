<div id="title-header">
	<div id="title-content">
		<div id="title">
			<h2>Chicken Soup</h2>
		</div>
		<a href="http://<?php echo $_SERVER["HTTP_HOST"];?>/logout.php">Logout</a>
	</div>
</div>
<div id="nav-bar">
	<div id="nav-wrapper">
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-collapse" id="main-nav">
					<ul class="nav navbar-nav">
						<li class="<?php echo ($active == 'dashboard') ? 'active' : '';?>"><a href="/welcome">Dashboard</a></li>
						<li class="dropdown <?php echo ($active == 'volunteer') ? 'active' : '';?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Volunteers <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a class="pop_box" data-form = "vol_form" href="#">Create New</a></li>
								<li><a href="/volunteers/search.php">Search</a></li>
							</ul>
						</li>
						<li class="dropdown <?php echo ($active == 'recip') ? 'active' : '';?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Recipients <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a class="pop_box" data-form="rep_form" href="#">Create New</a></li>
								<li><a href="/recipients/search.php">Search</a></li>
							</ul>
						</li>
						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Report 1</a></li>
								<li><a href="#">Report 2</a></li>
							</ul>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		<div id="search-wrapper">
			<input id="global-search" type="text" name="global-search" placeholder="Search" />
			<div id="search-results"></div>
		</div>
	</div>
</div>