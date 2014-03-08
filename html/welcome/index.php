<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}
//welcome controller
//set css and js for this page
$stylesheet = '/css/welcome.css';
$script = '/js/welcome.js'
?>
<?php require "../header.php";?>
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
						<li class="active"><a href="#">Dashboard</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Volenteers <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Create New</a></li>
								<li><a href="#">Search</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Recipients <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Create New</a></li>
								<li><a href="#">Search</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Report 1</a></li>
								<li><a href="#">Report 2</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div id="search-wrapper">
			<input id="global-search" type="text" name="global-search" placeholder="Search" />
		</div>
	</div>
</div>
<div id="page-content">
	<div id="nav-wrapper">
		<div id="title"><h3>Dashboard</h3></div>
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#">This Week</a></li>
		  <li><a href="#">Next Week</a></li>
		</ul>
	</div>
	<div id="content-wrapper">
		
	</div>
</div>

<?php require "../footer.php";?>