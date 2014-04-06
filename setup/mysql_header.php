<?php
	//setup db credentials and copy file into a config folder outside the html folder

	$user = "root";
	$password = "root";
	$database = "dbchickensoup";
	mysql_connect("localhost", $user, $password) or die("ERROR on DB connect");
	@mysql_select_db($database) or die("Unable to select db"); 
?>
