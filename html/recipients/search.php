<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}

require "../../config/mysql_header.php";
require "../helpers/sanitize.php";

//pull last ten recipients added
$recent_sql = "SELECT * FROM Recipients ORDER BY RID DESC LIMIT 10;";

$recent_results = mysql_query($recent_sql);

//volunteer/search controller
//set css and js for this page
$stylesheet = '/css/recip_search.css';
$script = '/js/recip_search.js';
$active = 'recip'
?>
<?php require "../header.php";?>
<?php require "../nav.php";?>
<div id="page-content">
	<div id="nav-wrapper">
		<div id="title"><h3>Search Recipients</h3></div>
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
							<?php while($r = mysql_fetch_assoc($recent_results)):?>
								<tr>
									<td><a class="" href="/recipients/view.php?rid=<?= $r['RID'];?>"><?= $r['first_name']." ".$r['last_name'];?></a></td>
									<td><?= build_phone($r['home_phone']);?></td>
									<td><?= $r['address']." ".$r['city']." ".$r['ZIP'];?></td>
									<?php
									$rid = $r['RID'];
									$event_sql = "SELECT start_date FROM Events WHERE RID = '$rid' ORDER BY start_date DESC LIMIT 1";
									$event_result = mysql_query($event_sql);
									?>
									<?php if(mysql_num_rows($event_result) > 0):?>
										<?php $e = mysql_fetch_row($event_result);?>
										<td><?php echo date('m/d/Y', strtotime($e[0]));?></td>
									<?php else:?>
										<td>None</td>
									<?php endif;?>
								</tr>
							<?php endwhile;?>
						</tbody>
					</thead>
				</table>
			</div>
		</div>
		<div class="search-view" id="search">
			<input type="text" id="vol-search" placeholder="Begin typing to search for recipients"?>
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
					<tbody id="search-results">
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
