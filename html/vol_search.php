<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}

require "config/mysql_header.php";

$eid = $_GET['EID'];
//welcome controller
//set css and js for this page
$stylesheet = '/css/welcome.css';
$script = '/js/welcome.js';
$active = 'dashboard';
$select_sql = "SELECT * FROM Events WHERE EID = '$eid';";
$results = mysql_query($select_sql);
$e = mysql_fetch_assoc($results);
$wday = date("w", strtotime($e['start_date']));
if(date("a", strtotime($e['arrive_time']))=="am"){ $am = 1; $pm = 0; }else{ $am = 0; $pm = 1; }

$select_sql = "SELECT * FROM Volunteers V, VAvailable B WHERE V.VID = B.VID AND B.weekday = '$wday' AND B.AM = '$am' AND B.PM = '$pm' ORDER BY V.last_name ASC;";
$result = mysql_query($select_sql);
$v = mysql_fetch_assoc($result);

?>
<?php require "header.php";?>
<?php require "nav.php";?>
<div id="page-content">
	<div id="nav-wrapper">
	<p>You are currently viewing available volunteers on <?php echo $e['start_date']." at ".date("h:i:s A", strtotime($e['arrive_time'])); ?>.</p>
	</div>
	<div id="content-wrapper">
	<h4>Available Volunteers</h4>
		<table class="table table-striped">
			<thead><tr>
				<th>Volunteer Name</th>
				<th></th>
			</tr></thead>
			<?php do{ ?>
				<tr>
					<td><?php echo $v['last_name'].", ".$v['first_name']; ?></td>
					<td><button type="button" class="btn btn-primary" name="call">Called</button></td>
				</tr>
			<?php }while($v = mysql_fetch_assoc($result)); ?>
		</table>
	</div>
</div>

<?php require "footer.php";?>
