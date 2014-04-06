<?php
	$user = "root";
	$password = "root";
	$database = "dbchickensoup";
	mysql_connect("localhost", $user, $password) or die("ERROR on DB connect");
	@mysql_select_db($database) or die("Unable to select db"); 
?>