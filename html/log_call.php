<?php
	require "../config/mysql_header.php";

	$eid = $_POST['eid'];
	$vid = $_POST['vid'];
	$time = date("Y-m-d H:i:s");

	$insert_sql = "INSERT INTO CallLog (call_time, VID, EID) VALUES ('$time', '$vid', '$eid');";
	mysql_query($insert_sql);
	if(mysql_errno()){
		echo $insert_sql;
	}else{
		echo mysql_error();
	}	
?>