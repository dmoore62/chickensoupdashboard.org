<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}
require "../../config/mysql_header.php";
require "../helpers/sanitize.php";

$rid = $_GET['rid'];
if(!$rid){
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
}

//either way, get all recip info
$select_sql = "SELECT * FROM Recipients WHERE RID = '$rid';";
$result = mysql_query($select_sql);
$r = mysql_fetch_assoc($result);
//die(var_dump($r));

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
				<h4>General Info<a href="#" data-form="event_form" class="pop_box btn btn-success">Create Event</a></h4>
				<form id="new-recip" action="../recipients/view.php" method="POST" class="form-horizontal">
			      <legend></legend>
			      <div class="row-fluid">
					<fieldset>
						<div class="span5">
							<div class="control-group">  
					            <label class="control-label" for="fname">First Name</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="fname" id="fname" value=<?= $r['first_name'];?>>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="lname">Last Name</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="lname" id="lname" value=<?= $r['last_name'];?>>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="email">E-Mail</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="email" id="email" value=<?= $r['email'];?>>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="address">Address</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="address" id="address" value=<?= $r['address'];?>>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="city">City</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="city" id="city" value=<?= $r['city'];?>>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="postal">Zip</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="postal" id="postal" value=<?= $r['ZIP'];?>>  
					            </div>  
					        </div> 
							<div class="control-group">  
					            <label class="control-label" for="hphone">Home Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="hphone" id="hphone" value=<?= $r['home_phone'];?>>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="cphone">Cell Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="cphone" id="cphone" value=<?= $r['cell_phone'];?>>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="wphone">Work Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="wphone" id="wphone" value=<?= $r['work_phone'];?>>  
					            </div>  
					        </div>
				        </div>
				        <!-- <div class="span1"></div> -->
				        <div class="span5">
				        	<div class="control-group">  
					            <label class="control-label" for="suv">Use SUV?</label>  
					            <div class="controls">  
					              <select name="suv" id="suv" class="form-control">
					              	<option <?php echo ($r['suv'] == 1) ? "selected" : "";?> value="1">Yes</option>
					              	<option <?php echo ($r['suv'] == 0) ? "selected" : "";?> value="0">No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="meals">Kids?</label>  
					            <div class="controls">  
					              <select name="meals" id="meals" class="form-control">
					              	<option <?php echo ($r['child'] == 1) ? "selected" : "";?> value="1">Yes</option>
					              	<option <?php echo ($r['child'] == 0) ? "selected" : "";?> value="0">No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="activities">Contact</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="contact" id="contact">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="secLang">Contact Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="contact_phone" id="contact_phone">  
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
