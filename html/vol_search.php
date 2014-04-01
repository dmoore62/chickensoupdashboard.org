<?php

require "../config/mysql_header.php";

$eid = $_GET['eid'];
//welcome controller
//set css and js for this page

$select_sql = "SELECT * FROM Events WHERE EID = '$eid';";
$results = mysql_query($select_sql);
$e = mysql_fetch_assoc($results);
$wday = date("w", strtotime($e['start_date']));
if(date("a", strtotime($e['arrive_time']))=="am"){ $am = 1; $pm = 0; }else{ $am = 0; $pm = 1; }

//$select_sql = "SELECT * FROM Volunteers V, VAvailable B WHERE V.VID = B.VID AND B.weekday = '$wday' AND B.AM = '$am' AND B.PM = '$pm' ORDER BY V.last_name ASC;";
$select_sql = "SELECT * FROM Volunteers;";
$result = mysql_query($select_sql);
//$v = mysql_fetch_assoc($result);

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
							<td><input class="ajax_call" data-vid="<?php echo $v['VID'];?>"  data-eid="<?php echo $e['EID'];?>" type="checkbox" name="called"/></td>
							<td><button data-vid="<?php echo $v['VID'];?>"  data-eid="<?php echo $e['EID'];?>" type="button" class="ajax_add btn btn-primary" name="call">Add to Event</button></td>
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
		if(cur.is(":checked")){
			//alert('unchecked');
			//do ajax to phone insert

		}else{
			//alert('checked');
			//do ajax to delete call record
		}
	});

	$('.ajax_add').on('click', function(e){
		e.preventDefault();
		alert('clicked');
	});
</script>
