<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}

$vid = $_GET['vid'];

//volunteer/search controller
//set css and js for this page
$stylesheet = '/css/vol_view.css';
$script = '/js/vol_view.js';
$active = 'volunteer'
?>
<?php require "../header.php";?>
<?php require "../nav.php";?>
<div id="page-content">
	<div id="nav-wrapper">
		<div id="title"><h3>Volunteer Info</h3></div>
		<ul class="nav nav-tabs">
		  <li class="active" data-tab="general"><a href="#">General</a></li>
		  <li data-tab="availablity"><a href="#">Availablity</a></li>
		  <li data-tab="history"><a href="#">History</a></li>
		</ul>
	</div>
	<div id="content-wrapper">
		<div class="vol-view" id="general">
			<div class="tab-content-wrapper">
				<h4>General Info</h4>
				<form name="vol_save" action="vol_save.php" method="POST">
					
				</form>
			</div>
		</div>
		<div class="vol-view" id="availablity">
			<div class="tab-content-wrapper">
				<h4>Availablity</h4>
				<form name="vol_avail" action="avail_post.php" method="POST">
				
				</form>
			</div>
		</div>
		<div class="vol-view" id="history">
			<div class="tab-content-wrapper">
				<h4>History</h4>
				<table class="dynamic-table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Recipient</th>
							<th>Event Type</th>
							<th>Comment</th>
						</tr>
						<tbody>
							<tr>
								<td>9/13/2013</td>
								<td><a href="/recipients/view.php?rip=1">Mary Smith</a></td>
								<td>Ride</td>
								<td>To the doctor</td>
							</tr>
							<tr>
								<td>8/13/2013</td>
								<td><a href="/recipients/view.php?rip=1">Mary Smith</a></td>
								<td>Visit</td>
								<td>2 hours</td>
							</tr>
							<tr>
								<td>7/13/2013</td>
								<td><a href="/recipients/view.php?rip=1">Mary Smith</a></td>
								<td>Ride</td>
								<td>To the doctor</td>
							</tr>
						</tbody>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<?php require "../footer.php";?>
