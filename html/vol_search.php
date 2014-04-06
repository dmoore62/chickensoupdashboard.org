<?php

require "../config/mysql_header.php";
require "helpers/sanitize.php";

$eid = $_GET['eid'];

$select_sql = "SELECT * FROM Events E, Recipients R WHERE E.EID = '$eid' AND E.RID = R.RID;";
$results = mysql_query($select_sql);
$e = mysql_fetch_assoc($results);
$wday = date("w", strtotime($e['start_date']));
$time_of_day = date("a", strtotime($e['start_date'].$e['arrive_time']));
//start with empty array to push restraints onto
$restraints = array();
//dynamically build query
//first event type
if($e['event_type'] == 0){
	array_push($restraints, "V.trans = 1");
}elseif($e['event_type'] == 1){
	array_push($restraints, "V.visit = 1");
}else{
	array_push($restraints, "V.meal = 1");
}

//then availability
array_push($restraints, "B.weekday = {$wday}");
if($time_of_day == "am"){
	array_push($restraints, "B.AM = 1");
}else{
	array_push($restraints, "B.PM = 1");
}

if(!$e['SUV']){
	array_push($restraints, "V.SUV = 0");
}

if(!$e['child']){
	array_push($restraints, "(V.child1 = 0 AND V.child2 = 0 AND V.child3 = 0)");
}

//glue them together
$restraint_str = implode(" AND ", $restraints);
$select_sql = "SELECT V.last_name, V.first_name, V.VID, V.email, V.home_phone, V.cell_phone FROM Volunteers V, VAvailable B WHERE V.VID = B.VID AND ".$restraint_str;
// if(date("a", strtotime($e['start_date'].$e['arrive_time']))=="am"){ $am = 1; $pm = 0; }else{ $am = 0; $pm = 1; }
// $suv = $e['SUV'];
// if($e['child']){
// 	$select_sql = "SELECT V.last_name, V.first_name, V.VID FROM Volunteers V, VAvailable B WHERE V.VID = B.VID AND B.weekday = '$wday' AND B.AM = '$am' AND B.PM = '$pm' AND V.SUV = '$suv' ORDER BY V.last_name ASC";
// }else{
// 	$select_sql = "SELECT V.last_name, V.first_name, V.VID FROM Volunteers V, VAvailable B WHERE V.VID = B.VID AND B.weekday = '$wday' AND B.AM = '$am' AND B.PM = '$pm' AND (V.child1 = 0 AND V.child2 = 0 AND V.child3 = 0) AND V.SUV = '$suv' ORDER BY V.last_name ASC";
// }
$result = mysql_query($select_sql);



//get vols called for this event
$called_sql = "SELECT VID FROM CallLog WHERE EID = '$eid';";
$called_result = mysql_query($called_sql);
$called_vols = array();
while($i = mysql_fetch_row($called_result)){ 
	array_push($called_vols, $i[0]);
}
?>
<div class="modal" id="vol-modal">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Available Volunteers</h4>
    </div>
	<div id="modal-body">
		<div class="content-wrapper">
		<!-- <p><?php var_dump($e);?></p>-->
		<!-- <p><?php var_dump($select_sql);?></p> --> 
		<!-- <p>You are currently viewing available volunteers on <?php echo $e['start_date']." at ".date("h:i:s A", strtotime($e['arrive_time'])); ?>.</p> -->
		<div class="table-wrapper">
			<table class="dynamic-styled">
				<thead>
					<tr>
						<th>Volunteer Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Last Event</th>
						<th>Last Contacted</th>
						<th>Contacted?</th>
						<th>Add to Event</th>
						
					</tr>
				</thead>
				<tbody>
					<?php while($v= mysql_fetch_assoc($result)): 
						$vid = $v['VID'];
						$recent_sql = "SELECT start_date FROM Events WHERE VID = '$vid' ORDER BY start_date DESC LIMIT 1";
						$recent_result = mysql_query($recent_sql);
						if(mysql_num_rows($recent_result) > 0){
							$re = mysql_fetch_row($recent_result);
							$event_time = date('m/d/Y', strtotime($re[0]));
						}else{
							$event_time = "N/A";
						}

						//get last contact
						$call_sql = "SELECT call_time FROM CallLog WHERE VID = '$vid' ORDER BY call_time DESC LIMIT 1";
						$call_result = mysql_query($call_sql);
						if(mysql_num_rows($call_result) > 0){
							$cr = mysql_fetch_row($call_result);
							$call_time = date('m/d/Y', strtotime($cr[0]));
						}else{
							$call_time = "N/A";
						}

						$contact_phone = ($v['home_phone']) ? build_phone($v['home_phone']) : build_phone($v['cell_phone']);
					?>
						<tr>
							<td><a href="/volunteers/view.php?vid=<?php echo $v['VID'];?>" title="View Profile"><?php echo $v['last_name'].", ".$v['first_name']; ?></a></td>
							<td><a href="mailto:<?php echo $v['email'];?>" title="Send Email"><?php echo $v['email'];?></a></td>
							<td><?php echo $contact_phone;?></td>
							<td><?php echo $event_time;?></td>
							<td><?php echo $call_time;?></td>
							<td><input class="ajax_call" data-vid="<?php echo $v['VID'];?>"  data-eid="<?php echo $eid;?>" type="checkbox" name="called" <?php echo (in_array($v['VID'], $called_vols)) ? "checked" : "";?>/></td>
							<td><button data-vid="<?php echo $v['VID'];?>"  data-eid="<?php echo $eid;?>" type="button" class="ajax_add btn btn-primary" name="call">Add to Event</button></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
	<div class="modal-footer"></div>
</div>
<script type="text/javascript">
	$('table.dynamic-styled').dataTable({
		"aaSorting" : [[4, 'desc']]
	});

	$('.ajax_call').on('click', function(e){
		//e.preventDefault();
		var cur = $(this);
		var vol = cur.attr('data-vid');
		var eid = cur.attr('data-eid');
		//alert(eid);
		if(cur.is(":checked")){
			//alert('unchecked');
			//do ajax to phone insert
			$.ajax({
				method:"POST",
				data: {vid : vol,
						eid: eid},
				url: "../log_call.php",
				success: function(resp){
					//change class on button or div
					var button = $(".pop_box[data-for-id='"+eid+"']");
					button.removeClass('new').addClass('pending').html("Awaiting Response");
				},
				error:function(err){
					console.log(err);
				}
			});
		}else{
			//alert('checked');
			//do ajax to delete call record
			e.preventDefault();
		}
	});

	$('.ajax_add').on('click', function(e){
		e.preventDefault();
		var cur = $(this);
		var vol = cur.attr('data-vid');
		var eid = cur.attr('data-eid');
		$.ajax({
				method:"POST",
				data: {vid : vol,
						eid: eid},
				url: "../log_event.php",
				success: function(resp){
					window.location = "/welcome"
				},
				error:function(err){
					console.log(err);
				}
			});
	});
</script>
