<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}

require "../../config/mysql_header.php";

$to = date('m/d/Y');
$from = date('m/d/Y', strtotime("- 3 months"));

if($_POST['Update'] == 'Update'){
	$to = $_POST['to-date'];
	$from = $_POST['from-date'];
}

$sql_to = date("Y-m-d H:i:s", strtotime($to));
$sql_from = date("Y-m-d H:i:s", strtotime($from));

$report_sql = "SELECT *, V.first_name as vfirst, V.last_name as vlast, R.first_name as rfirst, R.last_name as rlast FROM Events E 
			   INNER JOIN Recipients R ON E.RID = R.RID 
			   LEFT OUTER JOIN Volunteers V ON E.VID = V.VID
			   WHERE E.start_date >= '$sql_from' AND E.start_date <= '$sql_to'
			   ORDER BY E.start_date DESC";
$result = mysql_query($report_sql);

//welcome controller
//set css and js for this page
$stylesheet = '/css/report.css';
$script = '/js/report.js';
$active = 'report';
?>
<?php require "../header.php";?>
<?php require "../nav.php";?>
<div id="page-content">
	<div id="nav-wrapper">
		<div id="title"><h3>Events Report</h3></div>
		<!-- <ul class="nav nav-tabs">
		  <li class="active"><a href="#">This Week</a></li>
		  <li><a href="#">Next Week</a></li>
		</ul> -->
	</div>
	<div id="content-wrapper">
		<form action="" method="POST" id="report-form" class="form-horizontal">
			<legend><h4>Select Time Interval</h4></legend>
			<fieldset>
			<div class="row-fluid">
				<div class="span5">
		    		<div class="control-group">
		    			<label class="control-label" for="from-date">Start Date:</label>
		    			<div class="controls">
		    				<input type="text" name="from-date" id="from-date" class="datepick" value="<?php echo $from;?>"/>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="span5">
		    		<div class="control-group">
		    			<label class="control-label" for="from-date">End Date:</label>
		    			<div class="controls">
		    				<input type="text" name="to-date" id="to-date" class="datepick" value="<?php echo $to;?>"/>
		    			</div>
		    		</div>
		    	</div>
	    	</div>
	    	</fieldset>
	    	<div class="modal-footer">
						<button type="submit" name="Update" value="Update" class="btn btn-primary">Run Report</button>
			</div>
		</form>
		<div class="table-wrapper">
			<table class="dynamic-styled">
				<thead>
					<tr>
						<th>Event Date:</th>
						<th>Recipient:</th>
						<th>Event Type:</th>
						<th>Volunteer:</th>
						<th>Location:</th>
					</tr>
				</thead>
				<tbody>
					<?php while($e = mysql_fetch_assoc($result)):?>
						<tr>
							<td><?php echo date("m/d/Y", strtotime($e['start_date']));?></td>
							<td><a href="/recipients/view.php?rid=<?php echo $e['RID'];?>" title="View Profile"><?php echo $e['rfirst']." ".$e['rlast'];?></a></td>
							<td><?php echo ($e['event_type'] == 0) ? "Transportation" : ($e['event_type'] == 1) ? "Visit" : "Meal";?></td>
							<?php if(isset($e['VID'])):?>
								<td><a href="/volunteers/view.php?vid=<?php echo $e['VID']?>" title="View Profile"><?php echo $e['vfirst']." ".$e['vlast'];?></a></td>
							<?php else:?>
								<td>N/A</td>
							<?php endif;?>
							<td><?php echo $e['destion'];?></td>
						</tr>
					<?php endwhile;?>
				</tbody>
			</table>
		</div> 
	</div>
</div>
<?php require "../footer.php";?>