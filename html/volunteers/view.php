<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}
//die(var_dump($_POST));

$vid = $_GET['vid'];
//check for new vol and do insert and get insert id
if(!$vid && $_POST){

}

//use $vid to get vol record


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
				<form id="new-vol" action="../volunteers/view.php" method="POST" class="form-horizontal">
			      <legend></legend>
			      <div class="row-fluid">
					<fieldset>
						<div class="span5">
							<div class="control-group">  
					            <label class="control-label" for="fname">First Name</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="fname" id="fname">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="lname">Last Name</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="lname" id="lname">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="email">E-Mail</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="email" id="email">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="address">Address</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="address" id="address">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="city">City</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="city" id="city">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="postal">Zip</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="postal" id="postal">  
					            </div>  
					        </div> 
							<div class="control-group">  
					            <label class="control-label" for="hphone">Home Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="hphone" id="hphone">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="cphone">Cell Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="cphone" id="cphone">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="wphone">Work Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="wphone" id="wphone">  
					            </div>  
					        </div>
				        </div>
				        <!-- <div class="span1"></div> -->
				        <div class="span5">
				        	<div class="control-group">  
					            <label class="control-label" for="suv">Has SUV?</label>  
					            <div class="controls">  
					              <select name="suv" id="suv" class="form-control">
					              	<option value="1">Yes</option>
					              	<option value="0">No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="meals">Meals?</label>  
					            <div class="controls">  
					              <select name="meals" id="meals" class="form-control">
					              	<option value="1">Yes</option>
					              	<option value="0">No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="transport">Transport?</label>  
					            <div class="controls">  
					              <select name="transport" id="transport" class="form-control">
					              	<option value="1">Yes</option>
					              	<option value="0">No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="visits">Visits?</label>  
					            <div class="controls">  
					              <select name="visits" id="visits" class="form-control">
					              	<option value="1">Yes</option>
					              	<option value="0">No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="errands">Errands?</label>  
					            <div class="controls">  
					              <select name="errands" id="errands" class="form-control">
					              	<option value="1">Yes</option>
					              	<option value="0">No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="activities">Other Activities</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="activities" id="activities">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="secLang">2nd Language</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="secLang" id="secLang">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="notes">Notes</label>  
					            <div class="controls">  
					              <textarea rows="2" class="input-large" name="notes" id="notes"></textarea>
					            </div>  
					        </div>
				        </div>
					</fieldset>
					</div>
					<div class="modal-footer">
						<input type="submit" name="save" class="btn btn-primary" value="SAVE" /><br/>
					</div>
					</form>
					<script type="text/javascript">
						$('.phone-mask').mask("(999)999-9999");
					</script>
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
