<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}
require "../../config/mysql_header.php";
require "../helpers/sanitize.php";

$rid = $_GET['rid'];
$show_events = false;
if(!$rid){
	if($_POST['save'] == 'SAVE'){
		//new recip insert and return id
		$insert_data = array(
			'first_name' => sanitize($_POST['fname']),
			'last_name' => sanitize($_POST['lname']),
			'email' => sanitize($_POST['email']),
			'address' => sanitize($_POST['address']),
			'city' => sanitize($_POST['city']),
			'ZIP' => sanitize($_POST['postal']),
			'home_phone' => format_phone(sanitize($_POST['hphone']))
			);
		$columns = implode(", ", array_keys($insert_data));
		$values = "'".implode("', '", $insert_data)."'";
		$insert_sql = "INSERT into Recipients ($columns) VALUES ($values);";
		//die($insert_sql);
		mysql_query($insert_sql) or die(mysql_error());
		//die(mysql_insert_id());
		$rid = mysql_insert_id() or die('here');
		// echo "<pre>";
		// echo $rid;
	}else if($_POST['save'] == 'UPDATE'){
		//update info
		$rid = $_POST['rid'];
		$update_data = array(
			'first_name' => sanitize($_POST['fname']),
			'last_name' => sanitize($_POST['lname']),
			'email' => sanitize($_POST['email']),
			'address' => sanitize($_POST['address']),
			'city' => sanitize($_POST['city']),
			'ZIP' => sanitize($_POST['postal']),
			'home_phone' => format_phone(sanitize($_POST['hphone'])),
			'cell_phone' => format_phone(sanitize($_POST['cphone'])),
			'directions' => sanitize($_POST['directions']),
			'contact' => sanitize($_POST['contact']),
			'limitations' => sanitize($_POST['limitations']),
			'child' => $_POST['child'],
			'SUV' => $_POST['suv'],
			'contact_relationship' => format_phone(sanitize($_POST['contact_phone']))
			);

		//this is cryptic and shity, but it creates the correct update string
		foreach ($update_data as $key => $value) {
			$update_ary[] = "$key = '$value'";
		}

		$update_str = implode(", ",	$update_ary);

		$update_sql = "UPDATE Recipients SET $update_str WHERE RID = '$rid';";
		
		mysql_query($update_sql) or die(mysql_error());
	}else if($_POST['save'] == 'CREATE EVENT'){
		//this should come from new event form
		//die(var_dump($_POST));
		$show_events = true;
		$rid = $_POST['recip-id'];
		$event_type = $_POST['event-type'];

		//first all the data independent of event-type
		$insert_data = array(
			'event_type' => sanitize($_POST['event-type']),
			'start_date' => date('Y-m-d H:i:s', strtotime($_POST['from-date'])),
			'arrive_time' => date('H:i:s', strtotime($_POST['time'])),
			'RID' => $rid,
			'recurring' => $_POST['recurring']
			);

		//now all specific cases
		switch ($event_type) {
			case '0':
				//transportation
				$insert_data['round_trip'] = $_POST['round-trip'];
				$insert_data['stay'] = $_POST['stay'];
				$insert_data['appt_time'] = date('H:i:s', strtotime($_POST['appt-time']));
				$insert_data['destion'] = sanitize($_POST['destination']);
				$insert_data['comments'] = sanitize($_POST['directions']);
				$insert_data['instructions'] = sanitize($_POST['spec-instructions']);
				break;
			case '1':
				//visit
			 	$insert_data['end_time'] = date('H:i:s', strtotime($_POST['end-time']));
				$insert_data['appt_time'] = date('H:i:s', strtotime($_POST['appt-time']));
				$insert_data['destion'] = sanitize($_POST['location']);
				$insert_data['comments'] = sanitize($_POST['directions']);
				$insert_data['instructions'] = sanitize($_POST['spec-instructions']);
				break;
			case '2':
				$insert_data['end_date'] = date('Y-m-d H:i:s', strtotime($_POST['to-date']));
				$insert_data['stay'] = $_POST['stay'];
				$insert_data['appt_time'] = date('H:i:s', strtotime($_POST['deliver-time']));
				$insert_data['destion'] = sanitize($_POST['deliver-to']);
				$insert_data['comments'] = sanitize($_POST['directions']);
				$insert_data['instructions'] = sanitize($_POST['restrictions']);
				$insert_data['portion'] = sanitize($_POST['portions']);
				break;			
			default:
				break;
		}

		$columns = implode(", ", array_keys($insert_data));
		$values = "'".implode("', '", $insert_data)."'";
		$insert_sql = "INSERT into Events ($columns) VALUES ($values);";

		//create event
		mysql_query($insert_sql) or die(mysql_error());
	}
}

//either way, get all recip info
$select_sql = "SELECT * FROM Recipients WHERE RID = '$rid';";
$result = mysql_query($select_sql);
$r = mysql_fetch_assoc($result);
//die(var_dump($r));

//Then get all recip events
$event_sql = "SELECT * FROM Events WHERE RID = '$rid' ORDER BY EID DESC;";
$event_results = mysql_query($event_sql);

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
		  <li class="<?php echo ($show_events) ? "" : "active";?>" data-tab="general"><a href="#">General</a></li>
		  <li class="<?php echo ($show_events) ? "active" : "";?>"data-tab="events"><a href="#">Events</a></li>
		  <li data-tab="history"><a href="#">History</a></li>
		</ul>
	</div>
	<div id="content-wrapper">
		<div class="recip-view <?php echo ($show_events) ? "hide" : "";?>" id="general">
			<div class="tab-content-wrapper">
				<h4>General Info<a href="#" data-form="event_form"  data-for="rid" data-for-id="<?= $rid?>" class="pop_box btn btn-success">Create Event</a></h4>
				<form id="new-recip" action="../recipients/view.php" method="POST" class="form-horizontal">
			      <legend></legend>
			      <div class="row-fluid">
					<fieldset>
						<div class="span5">
							<div class="control-group">  
					            <label class="control-label" for="fname">First Name</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="fname" id="fname" value="<?= $r['first_name'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="lname">Last Name</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="lname" id="lname" value="<?= $r['last_name'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="email">E-Mail</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="email" id="email" value="<?= $r['email'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="address">Address</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="address" id="address" value="<?= $r['address'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="city">City</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="city" id="city" value="<?= $r['city'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="postal">Zip</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="postal" id="postal" value="<?= $r['ZIP'];?>">  
					            </div>  
					        </div> 
							<div class="control-group">  
					            <label class="control-label" for="hphone">Home Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="hphone" id="hphone" value="<?= $r['home_phone'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="cphone">Cell Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="cphone" id="cphone" value="<?= $r['cell_phone'];?>">  
					            </div>  
					        </div>
				        </div>
				        <!-- <div class="span1"></div> -->
				        <div class="span5">
				        	<div class="control-group">  
					            <label class="control-label" for="suv">Use SUV?</label>  
					            <div class="controls">  
					              <select name="suv" id="suv" class="form-control">
					              	<option <?php echo ($r['SUV'] == 1) ? "selected" : "";?> value="1">Yes</option>
					              	<option <?php echo ($r['SUV'] == 0) ? "selected" : "";?> value="0">No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="child">Kids?</label>  
					            <div class="controls">  
					              <select name="child" id="child" class="form-control">
					              	<option <?php echo ($r['child'] == 1) ? "selected" : "";?> value="1">Yes</option>
					              	<option <?php echo ($r['child'] == 0) ? "selected" : "";?> value="0">No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="activities">Contact</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="contact" id="contact" value="<?= $r['contact'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="secLang">Contact Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="contact_phone" id="contact_phone" value="<?= $r['contact_relationship']?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="notes">Directions</label>  
					            <div class="controls">  
					              <textarea rows="2" class="input-large" name="directions" id="directions"><?= $r['limitations'];?></textarea>
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="notes">Limitations</label>  
					            <div class="controls">  
					              <textarea rows="2" class="input-large" name="limitations" id="limitations"><?= $r['directions'];?></textarea>
					            </div>  
					        </div>
					        <input type="hidden" name="rid" value="<?= $r['RID'];?>">
				        </div>
					</fieldset>
					</div>
					<div class="modal-footer">
						<input type="submit" name="save" class="btn btn-primary" value="UPDATE" />
					</div>
					</form>
			</div>
		</div>
		<div class="recip-view <?php echo ($show_events) ? "" : "hide";?>" id="events">
			<div class="tab-content-wrapper">
				<h4>Events</h4>
					<?php while($e = mysql_fetch_assoc($event_results)): ?>
						<?php if($e['event_type'] == '0'):?>
							<form name="vol_avail" action="recip_post.php" method="POST" class="form-horizontal">
							<legend>Transportation - <?php echo date("m/d/Y", strtotime($e['start_date']));?></legend>
							<div class="row-fluid">
							<div class="span6">
							<fieldset>
					    		<input id="recip-id" type="hidden" name="recip-id" value="<?php echo $rid;?>"/>
								<input id="event-type-input" type="hidden" name="event-type" value="0"/>
					    		<div class="control-group">
					    			<label class="control-label" for="from-date">Date:</label>
					    			<div class="controls">
					    				<input type="text" name="from-date" id="from-date" class="datepick" value="<?php echo date('m/d/Y', strtotime($e['start_date']));?>"/>
					    			</div>
					    		</div>
					    		<div class="control-group">  
								    <label class="control-label" for="round-trip">Round Trip?</label>  
								        <div class="controls">  
								            <select name="round-trip" id="round-trip" class="form-control">
								             	<option <?php echo ($e['round_trip']) ? "selected" : "";?> value="1">Yes</option>
								              	<option <?php echo (!$e['round_trip']) ? "selected" : "";?> value="0">No</option>
								            </select>  
								        </div>  
								</div>
								<div class="control-group">  
								    <label class="control-label" for="stay">Stay with Client?</label>  
								        <div class="controls">  
								            <select name="stay" id="stay" class="form-control">
								             	<option <?php echo ($e['stay']) ? "selected" : "";?> value="1">Yes</option>
								              	<option <?php echo (!$e['stay']) ? "selected" : "";?> value="0">No</option>
								            </select>  
								        </div>  
								</div>
					    		<div class="control-group">
					    			<label class="control-label" for="time">Pick Up Time</label>
					    			<div class="controls">
					    				 <div class="input-append bootstrap-timepicker">
											<input id="time" name="time" type="text" class="timepick" value="<?php echo date('H:i a', strtotime($e['arrive_time']));?>">
											<span class="add-on"><i class="icon-time"></i></span>
										</div>
					    			</div>
					    		</div>
					    		<div class="control-group">
					    			<label class="control-label" for="appt-time">Appt. Time</label>
					    			<div class="controls">
					    				 <div class="input-append bootstrap-timepicker">
											<input id="appt-time" name="appt-time" type="text" class="timepick" value="<?php echo date('H:i a', strtotime($e['appt_time']));?>">
											<span class="add-on"><i class="icon-time"></i></span>
										</div>
					    			</div>
					    		</div>
					    		<div class="control-group">
					    			<label class="control-label" for="destination">Destination</label>
					    			<div class="controls">
					    				<input type="text" name="destination" id="destination" value="<?php echo $e['destion'];?>"/>
					    			</div>
					    		</div>
					    		</fieldset>
					    		</div>
					    		<div class="span6">
					    		<fieldset>
					    		<div class="control-group">
					    			<label class="control-label" for="appt-length">Appt. Length</label>
					    			<div class="controls">
					    				<input type="text" name="appt-length" id="appt-length"/>
					    			</div>
					    		</div>
					    		<div class="control-group">
					    			<label class="control-label" for="directions">Directions</label>
					    			<div class="controls">
					    				<textarea id="directions" name="directions"><?php echo $e['comment'];?></textarea>
					    			</div>
					    		</div>
					    		<div class="control-group">
					    			<label class="control-label" for="spec-instructions">Special Instructions</label>
					    			<div class="controls">
					    				<textarea id="spec-instructions" name="spec-instructions"><?php echo $e['instructions'];?></textarea>
					    			</div>
					    		</div>
					    		<div class="control-group">  
								    <label class="control-label" for="recurring">Recurring Event?</label>  
								        <div class="controls">  
								            <select name="recurring" id="recurring" class="form-control">
								             	<option <?php echo ($e['recurring']) ? "selected" : "";?> value="1">Yes</option>
								              	<option <?php echo (!$e['recurring']) ? "selected" : "";?>value="0">No</option>
								            </select>  
								        </div>  
								</div>
								<div class="control-group">  
								    <label class="control-label" for="needs">Other Needs?</label>  
								        <div class="controls">  
								            <select name="needs" id="needs" class="form-control">
								             	<option value="1">Yes</option>
								              	<option value="0">No</option>
								            </select>  
								        </div>  
								</div>
					    	</fieldset>
					    	</div>
					    	</form>
						<?php elseif($e['event_type'] == '1'):?>
							<form id="new-event" method="POST" class="form-horizontal">
					      		<legend>Visit - <?php echo date('m/d/Y', strtotime($e['start_date']));?></legend>
					      		<div class="row-fluid">
					      		<div class="span6">
						    	<fieldset>
						    		<input id="recip-id" type="hidden" name="recip-id" value="<?php echo $rid;?>"/>
									<input id="event-type-input" type="hidden" name="event-type" value="1"/>
						    		<div class="control-group">
						    			<label class="control-label" for="from-date">Date:</label>
						    			<div class="controls">
						    				<input type="text" name="from-date" id="from-date" class="datepick" value="<?php echo date('m/d/Y', strtotime($e['start_date']));?>"/>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="time">Start Time</label>
						    			<div class="controls">
						    				 <div class="input-append bootstrap-timepicker">
												<input id="time" name="time" type="text" class="timepick" value="<?php echo date('H:i a', strtotime($e['arrive_time']));?>">
												<span class="add-on"><i class="icon-time"></i></span>
											</div>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="end-time">End Time</label>
						    			<div class="controls">
						    				 <div class="input-append bootstrap-timepicker">
												<input id="end-time" name="end-time" type="text" class="timepick" value="<?php echo date('H:i a', strtotime($e['end_time']));?>">
												<span class="add-on"><i class="icon-time"></i></span>
											</div>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="location">Location</label>
						    			<div class="controls">
						    				<input type="text" name="location" id="location" value="<?php echo $e['destion'];?>"/>
						    			</div>
						    		</div>
						    		</fieldset>
						    		</div>
						    		<div class="span6">
						    		<fieldset>
						    		<div class="control-group">
						    			<label class="control-label" for="directions">Directions</label>
						    			<div class="controls">
						    				<textarea id="directions" name="directions"><?php echo $e['comments'];?></textarea>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="spec-instructions">Special Instructions</label>
						    			<div class="controls">
						    				<textarea id="spec-instructions" name="spec-instructions"><?php echo $e['instructions'];?></textarea>
						    			</div>
						    		</div>
						    		<div class="control-group">  
									    <label class="control-label" for="recurring">Recurring Event?</label>  
									        <div class="controls">  
									            <select name="recurring" id="recurring" class="form-control">
									             	<option <?php echo ($e['stay']) ? "selected" : "";?> value="1">Yes</option>
									              	<option <?php echo (!$e['stay']) ? "selected" : "";?> value="0">No</option>
									            </select>  
									        </div>  
									</div>
									<div class="control-group">  
									    <label class="control-label" for="needs">Other Needs?</label>  
									        <div class="controls">  
									            <select name="needs" id="needs" class="form-control">
									             	<option value="1">Yes</option>
									              	<option value="0">No</option>
									            </select>  
									        </div>  
									</div>
						    	</fieldset>
						    	</div>
						    	</div>
							</form>
						<?php else:?>
							<form id="new-event" action="../recipients/view.php" method="POST" class="form-horizontal">
					      		<legend>Meal - <?php echo date("m/d/Y", strtotime($e['start_date']));?></legend>
					      		<div class="row-fluid">
					      		<div class="span6">
						    	<fieldset>
						    		<input id="recip-id" type="hidden" name="recip-id" value="<?php echo $rid;?>"/>
									<input id="event-type-input" type="hidden" name="event-type" value="2"/>
						    		<div class="control-group">
						    			<label class="control-label" for="from-date">Date: From</label>
						    			<div class="controls">
						    				<input type="text" name="from-date" id="from-date" class="datepick" value="<?php echo date('m/d/Y', strtotime($e['start_date']));?>"/>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="to-date">To</label>
						    			<div class="controls">
						    				<input type="text" name="to-date" id="to-date" class="datepick" value="<?php echo date('m/d/Y', strtotime($e['end_date']));?>"/>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="time">Time</label>
						    			<div class="controls">
						    				 <div class="input-append bootstrap-timepicker">
												<input id="time" name="time" type="text" class="timepick" value="<?php echo date('H:i a', strtotime($e['arrive_time']));?>">
												<span class="add-on"><i class="icon-time"></i></span>
											</div>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="portions">Portions</label>
						    			<div class="controls">
						    				<input type="text" name="portions" id="portions" value="<?php echo $e['portion'];?>"/>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="restrictions">Dietary Restrictions</label>
						    			<div class="controls">
						    				<textarea id="restrictions" name="restrictions"><?php echo $e['instructions'];?></textarea>
						    			</div>
						    		</div>
						    		</fieldset>
						    		</div>
						    		<div class="span6">
						    		<fieldset>
						    		<div class="control-group">
						    			<label class="control-label" for="deliver-to">Deliver To</label>
						    			<div class="controls">
						    				<input type="text" name="deliver-to" id="deliver-to" value="<?php echo $e['location'];?>"/>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="deliver-time">Deliver Time</label>
						    			<div class="controls">
						    				 <div class="input-append bootstrap-timepicker">
												<input id="deliver-time" name="deliver-time" type="text" class="timepick" value="<?php echo date('H:i a', strtotime($e['appt_time']));?>">
												<span class="add-on"><i class="icon-time"></i></span>
											</div>
						    			</div>
						    		</div>
						    		<div class="control-group">
						    			<label class="control-label" for="directions">Directions</label>
						    			<div class="controls">
						    				<textarea id="directions" name="directions"><?php echo $e['comments'];?></textarea>
						    			</div>
						    		</div>
						    		<div class="control-group">  
									    <label class="control-label" for="recurring">Recurring Event?</label>  
									        <div class="controls">  
									            <select name="recurring" id="recurring" class="form-control">
									             	<option <?php echo ($e['recurring']) ? "selected" : "";?> value="1">Yes</option>
									              	<option <?php echo (!$e['recurring']) ? "selected" : "";?> value="0">No</option>
									            </select>  
									        </div>  
									</div>
									<div class="control-group">  
									    <label class="control-label" for="needs">Other Needs?</label>  
									        <div class="controls">  
									            <select name="needs" id="needs" class="form-control">
									             	<option value="1">Yes</option>
									              	<option value="0">No</option>
									            </select>  
									        </div>  
									</div>
						    	</fieldset>
						    	</div>
						    	</div>
								</form>
						<?php endif;?>
						<?php //var_dump($e);?>
					<?php endwhile; ?>
				</form>
			</div>
		</div>
		<div class="recip-view hide" id="history">
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
