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
								<li><a class="pop_box" data-form = "new_vol" href="#">Create New</a></li>
								<li><a href="#">Search</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Recipients <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a class="pop_box" data-form="new_rep" href="#">Create New</a></li>
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
			<div id="search-results"></div>
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
		<div class="week-view" id="this-week">
		<?php for ($i=0; $i < 7; $i++) :?>
			<div class="table-wrapper">
				<h4><?php echo ($i == 0) ? "Today" : "12/".(2+$i)."/2014";?></h4>
				<table class="dynamic-table">
					<thead>
						<tr>
							<th>Recipient</th>
							<th>Event</th>
							<th>Date/Time</th>
							<th>Volunteer</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Joe Smith</td>
							<td>Ride</td>
							<td>12/25/2014 12:00 PM</td>
							<td><a href="#" class="new">Find Volunteer</a></td>
						</tr>
						<tr>
							<td>Jane Williams</td>
							<td>Visit</td>
							<td>12/25/2014 12:00 PM</td>
							<td><a href="#" class="pending">Awaiting Response</a></td>
						</tr>
						<tr>
							<td>Mary Jones</td>
							<td>Food</td>
							<td>12/25/2014 12:00 PM</td>
							<td><a href="#" class="filled">Jerry Ross</a></td>
						</tr>
				</table>
			</div>
		<?php endfor;?>
		</div>
		<div class="week-view" id="next-week">
			<?php for ($i=0; $i < 7; $i++) :?>
			<div class="table-wrapper">
				<h4><?php echo "12/".(9+$i)."/2014";?></h4>
				<table class="dynamic-table">
					<thead>
						<tr>
							<th>Recipient</th>
							<th>Event</th>
							<th>Date/Time</th>
							<th>Volunteer</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Joe Smith</td>
							<td>Ride</td>
							<td>12/25/2014 12:00 PM</td>
							<td><a href="#" class="new">Find Volunteer</a></td>
						</tr>
						<tr>
							<td>Jane Williams</td>
							<td>Visit</td>
							<td>12/25/2014 12:00 PM</td>
							<td><a href="#" class="pending">Awaiting Response</a></td>
						</tr>
						<tr>
							<td>Mary Jones</td>
							<td>Food</td>
							<td>12/25/2014 12:00 PM</td>
							<td><a href="#" class="filled">Jerry Ross</a></td>
						</tr>
				</table>
			</div>
		<?php endfor;?>
		</div>
	</div>
</div>

<?php require "../footer.php";?>