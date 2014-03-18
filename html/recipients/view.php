<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}

$rid = $_GET['rid'];

//volunteer/search controller
//set css and js for this page
$stylesheet = '/css/recip_view.css';
$script = '/js/recip_view.js';
$active = 'recip'
?>
<?php require "../header.php";?>
<?php require "../nav.php";?>
<div id="page-content">
	<div id="nav-wrapper">
		<div id="title"><h3>Care Recipient Info</h3></div>
		<ul class="nav nav-tabs">
		  <li class="active" data-tab="general"><a href="#">General</a></li>
		  <li data-tab="events"><a href="#">Events</a></li>
		  <li data-tab="history"><a href="#">History</a></li>
		</ul>
	</div>
	<div id="content-wrapper">
		<div class="recip-view" id="general">
			<div class="tab-content-wrapper">
				<h4>General Info</h4>
				<form name="vol_save" action="recip_save.php" method="POST">
					
				</form>
			</div>
		</div>
		<div class="recip-view" id="events">
			<div class="tab-content-wrapper">
				<h4>Events</h4>
				<form name="vol_avail" action="recip_post.php" method="POST">
				
				</form>
			</div>
		</div>
		<div class="recip-view" id="history">
			<div class="tab-content-wrapper">
				<h4>History</h4>
				<table class="dynamic-table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Volunteer</th>
							<th>Event Type</th>
							<th>Comment</th>
						</tr>
						<tbody>
							<tr>
								<td>9/13/2013</td>
								<td><a href="/recipients/view.php?rid=1">Mary Smith</a></td>
								<td>Ride</td>
								<td>To the doctor</td>
							</tr>
							<tr>
								<td>8/13/2013</td>
								<td><a href="/recipients/view.php?rid=1">Mary Smith</a></td>
								<td>Visit</td>
								<td>2 hours</td>
							</tr>
							<tr>
								<td>7/13/2013</td>
								<td><a href="/recipients/view.php?rid=1">Mary Smith</a></td>
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
