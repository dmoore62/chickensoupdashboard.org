<?php

require "../config/mysql_header.php";

$eid = $_GET['eid'];

$select_sql = "SELECT * FROM Events E, Recipients R WHERE E.EID = '$eid' AND E.RID = R.RID;";
$results = mysql_query($select_sql);
$e = mysql_fetch_assoc($results);
$wday = date("w", strtotime($e['start_date']));
if(date("a", strtotime($e['start_date'].$e['arrive_time']))=="am"){ $am = 1; $pm = 0; }else{ $am = 0; $pm = 1; }
$suv = $e['SUV'];
if($e['child']){
	$select_sql = "SELECT V.last_name, V.first_name, V.VID FROM Volunteers V, VAvailable B WHERE V.VID = B.VID AND B.weekday = '$wday' AND B.AM = '$am' AND B.PM = '$pm' AND V.SUV = '$suv' ORDER BY V.last_name ASC;";
}else{
	$select_sql = "SELECT V.last_name, V.first_name, V.VID FROM Volunteers V, VAvailable B WHERE V.VID = B.VID AND B.weekday = '$wday' AND B.AM = '$am' AND B.PM = '$pm' AND (V.child1 = 0 AND V.child2 = 0 AND V.child3 = 0) AND V.SUV = '$suv' ORDER BY V.last_name ASC;";
}
$select_sql = "SELECt * FROM Volunteers;";
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
		<!-- <p>You are currently viewing available volunteers on <?php echo $e['start_date']." at ".date("h:i:s A", strtotime($e['arrive_time'])); ?>.</p> -->
		<div class="table-wrapper">
			<table class="dynamic-styled">
				<thead>
					<tr>
						<th>Volunteer Name</th>
						<th>Last Event</th>
						<th>Called?</th>
						<th>Add to Event</th>
					</tr>
				</thead>
				<tbody>
					<?php while($v= mysql_fetch_assoc($result)): ?>
						<tr>
							<td><?php echo $v['last_name'].", ".$v['first_name']; ?></td>
							<td>4/01/2014</td>
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
	$('table.dynamic-styled').dataTable();

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
					//alert(resp);
					//go header
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
