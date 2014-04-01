<?php

require "../config/mysql_header.php";

$eid = $_GET['EID'];

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
