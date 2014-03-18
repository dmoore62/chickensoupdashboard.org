<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}

$date = strtotime("last sunday");
$time = strtotime(date("Y-m-d"));
//welcome controller
//set css and js for this page
$stylesheet = '/css/welcome.css';
$script = '/js/welcome.js';
$active = 'dashboard';
?>
<?php require "../header.php";?>
<?php require "../nav.php";?>
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
				<h4><?php if($date==$time){ echo "Today"; }else{ echo date("m/d/Y", $date); }?></h4>
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
		<?php 
		$date = strtotime("+1 day", $date);
		endfor;?>
		</div>
		<div class="week-view" id="next-week">
			<?php for ($i=0; $i < 7; $i++) :?>
			<div class="table-wrapper">
				<h4><?php echo date("m/d/Y", $date);?></h4>
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
		<?php 	
		$date = strtotime("+1 day", $date);
		endfor;?>
		</div>
	</div>
</div>

<?php require "../footer.php";?>
