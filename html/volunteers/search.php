<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}

//volunteer/search controller
//set css and js for this page
$stylesheet = '/css/vol_search.css';
$script = '/js/vol_search.js';
$active = 'volunteer'
?>
<?php require "../header.php";?>
<?php require "../nav.php";?>
<div id="page-content">
	<div id="nav-wrapper">
		<div id="title"><h3>Search Volunteers</h3></div>
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#">Recently Added</a></li>
		  <li><a href="#">Search</a></li>
		</ul>
	</div>
	<div id="content-wrapper">
		<div class="search-view" id="recently-added">
			<div class="table-wrapper">
				<h4>Recently Added</h4>
				<table class="dynamic-table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Phone Number</th>
							<th>Address</th>
							<th>Last Event</th>
						</tr>
						<tbody>
							<tr>
								<td><a href="/volunteers/view.php?vid=1">Joe Frank</a></td>
								<td>(407) 666-5555</td>
								<td>345 Main Street Orlando, FL</td>
								<td>2/14/2014</td>
							</tr>
							<tr>
								<td>Joe Frank</td>
								<td>(407) 666-5555</td>
								<td>345 Main Street Orlando, FL</td>
								<td>2/14/2014</td>
							</tr>
							<tr>
								<td>Joe Frank</td>
								<td>(407) 666-5555</td>
								<td>345 Main Street Orlando, FL</td>
								<td>2/14/2014</td>
							</tr>
						</tbody>
					</thead>
				</table>
			</div>
		</div>
		<div class="search-view" id="search">
			<input type="text" id="vol-search" placeholder="Begin typing to search for volunteers"?>
			<div id="vol-search-results" class="table-wrapper">
				<h4>Search</h4>
				<table class="dynamic-table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Phone Number</th>
						<th>Address</th>
						<th>Last Event</th>
					</tr>
					<tbody>
						<tr>
							<td>Joe Frank</td>
							<td>(407) 666-5555</td>
							<td>345 Main Street Orlando, FL</td>
							<td>2/14/2014</td>
						</tr>
						<tr>
							<td>Joe Frank</td>
							<td>(407) 666-5555</td>
							<td>345 Main Street Orlando, FL</td>
							<td>2/14/2014</td>
						</tr>
						<tr>
							<td>Joe Frank</td>
							<td>(407) 666-5555</td>
							<td>345 Main Street Orlando, FL</td>
							<td>2/14/2014</td>
						</tr>
					</tbody>
				</thead>
			</table>
			</div>
		</div>
	</div>
</div>

<?php require "../footer.php";?>
