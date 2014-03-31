<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}
//die(var_dump($_POST));

$vid = $_GET['vid'];
$dowMap = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
if($vid && isset($_POST['availability'])){
	if($_POST['new']){
		for($i=0; $i<7; $i++){
			$amv = $dowMap[$i]."a";
			$pmv = $dowMap[$i]."p";
			if(isset($_POST[$amv])) $am = 1; else $am = 0;
			if(isset($_POST[$pmv])) $pm = 1; else $pm = 0;
			$insert_sql = "INSERT into VAvailable (weekday, AM, PM, VID) VALUES ($i, $am, $pm, $vid);";
			$rresult = mysql_query($insert_sql) or die(mysql_error());
		}
	}else{
		for($i=0; $i<7; $i++){
			$amv = $dowMap[$i]."a";
			$pmv = $dowMap[$i]."p";
			if(isset($_POST[$amv])) $am = 1; else $am = 0;
			if(isset($_POST[$pmv])) $pm = 1; else $pm = 0;
			$update_sql = "UPDATE VAvailable SET AM=$am, PM=$pm WHERE weekday = $i AND VID = $vid;";
			$rresult = mysql_query($update_sql) or die(mysql_error());
		}
	}
}

$select_sql = "SELECT * FROM Volunteers WHERE VID = '$vid';";
$result = mysql_query($select_sql);
$v = mysql_fetch_assoc($result);

$select_sql2 = "SELECT * FROM VAvailable WHERE VID = '$vid' ORDER BY weekday ASC;";
$result2 = mysql_query($select_sql2);
$va = mysql_fetch_assoc($result2);
if(!$vid && $_POST){

}

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
					              <input type="text" class="input-large" name="fname" id="fname" value="<?php echo $v['first_name'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="lname">Last Name</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="lname" id="lname" value="<?php echo $v['last_name'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="email">E-Mail</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="email" id="email" value="<?php echo $v['email'];?>">  
					            </div>  
					        </div>
						<div class="control-group">  
					            <label class="control-label" for="hphone">Home Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="hphone" id="hphone" value="<?php echo $v['home_phone'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="cphone">Cell Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="cphone" id="cphone" value="<?php echo $v['cell_phone'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="wphone">Work Phone</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="wphone" id="wphone" value="<?php echo $v['work_phone'];?>">  
					            </div>  
					        </div>
				        </div>
				        <!-- <div class="span1"></div> -->
				        <div class="span5">
				        	<div class="control-group">  
					            <label class="control-label" for="suv">Has SUV?</label>  
					            <div class="controls">  
					              <select name="suv" id="suv" class="form-control">
					              	<option value="1" <?php if($v['SUV']) echo "selected";?>>Yes</option>
					              	<option value="0" <?php if(!$v['SUV']) echo "selected";?>>No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="meals">Meals?</label>  
					            <div class="controls">  
					              <select name="meals" id="meals" class="form-control">
					              	<option value="1" <?php if($v['meal']) echo "selected";?>>Yes</option>
					              	<option value="0" <?php if(!$v['meal']) echo "selected";?>>No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="transport">Transport?</label>  
					            <div class="controls">  
					              <select name="transport" id="transport" class="form-control">
					              	<option value="1" <?php if($v['trans']) echo "selected";?>>Yes</option>
					              	<option value="0" <?php if(!$v['trans']) echo "selected";?>>No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="visits">Visits?</label>  
					            <div class="controls">  
					              <select name="visits" id="visits" class="form-control">
					              	<option value="1" <?php if($v['visit']) echo "selected";?>>Yes</option>
					              	<option value="0" <?php if(!$v['visit']) echo "selected";?>>No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="errands">Errands?</label>  
					            <div class="controls">  
					              <select name="errands" id="errands" class="form-control">
					              	<option value="1" <?php if(!$v['errands']) echo "selected";?>>Yes</option>
					              	<option value="0" <?php if(!$v['']) echo "selected";?>>No</option>
					              </select>  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="activities">Other Activities</label>  
					            <div class="controls">  
					              <input type="text" class="input-large phone-mask" name="activities" id="activities" value="<?php echo $v['other_acts'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="secLang">2nd Language</label>  
					            <div class="controls">  
					              <input type="text" class="input-large" name="secLang" id="secLang" value="<?php echo $v['sencond_lang'];?>">  
					            </div>  
					        </div>
					        <div class="control-group">  
					            <label class="control-label" for="notes">Notes</label>  
					            <div class="controls">  
					              <textarea rows="2" class="input-large" name="notes" id="notes"><?php echo $v['comments'];?></textarea>
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
		<div class="vol-view" id="availability">
			<div class="tab-content-wrapper">
				<h4>Availablity</h4>
				<?php if(isset($_POST['availabilty'])){
					if($rresult){ ?>
						<div class="alert alert-success">Availabilty updated successfully!</div>
				<?php 	}else{ ?>
						<div class="alert alert-error">Availabilty did not update successfully!</div>
				<?php }} ?>
				<form name="vol_avail" method="post">
					<table class="table table-striped table-hover">
						<thead><tr>
							<th></th>
							<th>AM</th>
							<th>PM</th>
						</tr></thead>
						<?php 
						if(mysql_num_rows($result2)>0){ ?>
							<input type="hidden" name="new" value="0">
							<?php do{ ?>
							<tr>
								<th><?php echo $dowMap[$va['weekday']];?></th>
								<td><input type="checkbox" class="input-large" name="<?php echo $dowMap[$va['weekday']];?>a" <?php if($va['AM']) echo "checked"; ?>></td>
								<td><input type="checkbox" class="input-large" name="<?php echo $dowMap[$va['weekday']];?>p" <?php if($va['PM']) echo "checked"; ?>></td>
							</tr>
						<?php }while($va = mysql_fetch_assoc($result2)); 
						}else{ ?>
							<input type="hidden" name="new" value="1">
							<?php for($i = 0; $i<7; $i++){?>
								<tr>
									<th><?php echo $dowMap[$i];?></th>
									<td><input type="checkbox" class="input-large" name="<?php echo $dowMap[$i];?>a"></td>
									<td><input type="checkbox" class="input-large" name="<?php echo $dowMap[$i];?>p"></td>
								</tr>
						<?php }} ?>
					</table>
					<button type="submit" class="btn btn-primary" name="availability" value="availability">Update Availability</button>
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
