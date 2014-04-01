<?php session_start();
if($_SESSION["logged_in"] != true){
    header("Location: http://".$_SERVER["HTTP_HOST"]);
}

require "../../config/mysql_header.php";

$date = strtotime("last sunday");
$time = strtotime(date("Y-m-d"));
//welcome controller
//set css and js for this page
$stylesheet = '/css/welcome.css';
$script = '/js/welcome.js';
$active = 'dashboard';
?>
<?php require "../header.php";?>
<?php require "../nav.php";?>
<div id="page-content">
	<div id="nav-wrapper">
		<div id="title"><h3>Dashboard</h3></div>
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#">This Week</a></li>
		  <li><a href="#">Next Week</a></li>
		</ul>
	</div>
	<div id="content-wrapper">
		<div class="week-view" id="this-week">
		<?php for ($i=0; $i < 7; $i++) :
			$datef = date("Y-m-d", $date);
			$select_sql = "SELECT * FROM Events E, Recipients R WHERE E.start_date = '$datef' AND E.RID = R.RID ORDER BY EID ASC;";
			$result = mysql_query($select_sql);
			$e = mysql_fetch_assoc($result);?>
			<div class="table-wrapper">
				<h4><?php if($date==$time){ echo "Today"; }else{ echo date("m/d/Y", $date); }?></h4>
				<table class="dynamic-table">
					<thead>
						<tr>
							<th>Recipient</th>
							<th>Event</th>
							<th>Date/Time</th>
							<th>Volunteer</th>
						</tr>
					</thead>
					<tbody>
					<?php if(mysql_num_rows($result)>0){
						do{
							if(isset($e['VID'])){ 
								$event=$e['VID'];
								$link=false;
								$select_sql = "SELECT * FROM Volunteers WHERE VID=$event;";
								$result2 = mysql_query($select_sql);
								$v = mysql_fetch_assoc($result2);
								$class="filled"; $cmsg = $v['first_name']." ".$v['last_name'];
							}else{
								$event=$e['EID'];
								$select_sql = "SELECT * FROM CallLog WHERE EID=$event;";
								$result2 = mysql_query($select_sql);
								$cl = mysql_num_rows($result2);
								$link=true;
								if($cl){ $class="pending"; $cmsg = "Awaiting Response";
								}else{ $class="new"; $cmsg = "Find Volunteer";}
							}
						?>
						<tr>
							<td><?php echo $e['first_name']." ".$e['last_name']; ?></td>
							<td><?php switch($e['event_type']){ case 0: echo "Transportation"; break; case 1: echo "Meals"; break; case 2: echo "Appointment"; break; }?></td>
							<td><?php echo date("m/d/Y H:i:s A", strtotime($e['start_date']." ".$e['arrive_time'])); ?></td>
							<?php if($link){ $linka="/vol_search.php?EID=".$e['EID']; }else{ $linka="#"; }?>
							<td><a href="<?php echo $linka;?>" class="<?php echo $class;?>"><?php echo $cmsg; ?></a></td>
						</tr>
						<?php }while($e = mysql_fetch_assoc($result));
					}?>						
				</table>
			</div>
		<?php 
		$date = strtotime("+1 day", $date);
		endfor;?>
		</div>
		<div class="week-view" id="next-week">
		<?php for ($i=0; $i < 7; $i++) :
			$datef = date("Y-m-d", $date);
			$select_sql = "SELECT * FROM Events E, Recipients R WHERE E.start_date = '$datef' AND E.RID = R.RID ORDER BY EID ASC;";
			$result = mysql_query($select_sql);
			$e = mysql_fetch_assoc($result);?>
			<div class="table-wrapper">
				<h4><?php echo date("m/d/Y", $date);?></h4>
				<table class="dynamic-table">
					<thead>
						<tr>
							<th>Recipient</th>
							<th>Event</th>
							<th>Date/Time</th>
							<th>Volunteer</th>
						</tr>
					</thead>
					<tbody>
					<?php if(mysql_num_rows($result)>0){
						do{
							if(isset($e['VID'])){ 
								$event=$e['VID'];
								$select_sql = "SELECT * FROM Volunteers WHERE VID=$event;";
								$result2 = mysql_query($select_sql);
								$v = mysql_fetch_assoc($result2);
								$class="filled"; $cmsg = $v['first_name']." ".$v['last_name'];
							}else{
								$event=$e['EID'];
								$select_sql = "SELECT * FROM CallLog WHERE EID=$event;";
								$result2 = mysql_query($select_sql);
								$cl = mysql_num_rows($result2);
								if($cl){ $class="pending"; $cmsg = "Awaiting Response";
								}else{ $class="new"; $cmsg = "Find Volunteer";}
							}
						?>
						<tr>
							<td><?php echo $e['first_name']." ".$e['last_name']; ?></td>
							<td><?php switch($e['event_type']){ case 0: echo "Transportation"; break; case 1: echo "Meals"; break; case 2: echo "Appointment"; break; }?></td>
							<td><?php echo date("m/d/Y H:i:s A", strtotime($e['start_date']." ".$e['arrive_time'])); ?></td>
							<td><a href="#" class="<?php echo $class;?>"><?php echo $cmsg; ?></a></td>
						</tr>
						<?php }while($e = mysql_fetch_assoc($result));
					}?>						
				</table>
			</div>
		<?php 
		$date = strtotime("+1 day", $date);
		endfor;?>
	</div>
</div>

<?php require "../footer.php";?>
