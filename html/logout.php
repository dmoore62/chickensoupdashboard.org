<?php session_start();
session_destroy();
//this is the input cleaner
	require "helpers/sanitize.php";
	//basically your login controller
	//check if already logged in
	if($_SESSION['logged_in'] == true){
		header("Location: /welcome/");
	}else{
		//check if form is posting back
		if($_POST){
			$username = sanitize($_POST["username"]);
			$password = sanitize($_POST["password"]);

			if($username == 'admin' && $password == 'password'){
				$_SESSION['logged_in'] = true;
				//echo "here";
				header("Location: /welcome/");
			}else{
				$error = "Invalid Login";
			}
		}
	}?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Chicken Soup</title>

    <!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
    <!-- iPhone: Don't render numbers as call links -->
    <meta name="format-detection" content="telephone=no">

    <link rel="shortcut icon" href="favicon.ico" />
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
    
    <!-- The scripts-->
    <link rel="stylesheet" type="text/css" href="/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">

    <!-- The Scripts-->
    <script type="text/javascript" src="/js/jQuery.1.11.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/js/login.js"></script>

</head>
<body>
	<!-- This is the view -->
	<div id="login-wrapper">
		<h4>Login</h4>
		<?php echo (isset($error)) ? $error."<br/>" : "";?>
		<form id="login-form" method="post" action="">
			<input type="text" name="username" value="" placeholder="Username"/><br/>
			<input type="password" name="password" value="" placeholder="Password"><br/>
			<input type="submit" value="LOGIN"/>
		</form>
	</div>
</body>
</html>