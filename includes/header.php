<?php 
	require_once('session.php');
?>
<!DOCTYPE html>
<html>
	<head>
		
		<!-- StyleSheets -->
		
		<!-- GOOGLE FONTS -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:900,700,500,400,300' rel='stylesheet' type='text/css'>
	
		<!-- JavaScripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="./assets/js/jquery-ui.js" type="text/javascript"></script>
		<script src="./assets/js/questionmark.js" type="text/javascript"></script>
		<script src="./assets/js/wordo.js" type="text/javascript"></script>
		<script src="./assets/js/mywl.js" type="text/javascript"></script>
		
		
		<title>Wordo</title>
		<meta name="description" content="Wordo is the clutter-free online dictionary. It's very easy to use.">
		<link rel="shortcut icon" type="image/png" href="./assets/images/favicon.png">
		<link rel="shortcut icon" href="./assets/images/favicon.png">
		<link rel="image_src" href="./assets/images/logo.png" />
		<link rel="stylesheet" href="./assets/styles/style.css" type="text/css" />
		
		<!-- OSD SEARCH CODE -->
		<link rel="search" type="application/opensearchdescription+xml" title="MySite" href="/osd.xml" />

	</head>
	<body>	
	

		<a href="/">
			<div class="logo">wordo
			</div>
		</a>
		<div id="menutopright">
			<?php
			$is_user_logged_in = $_SESSION['Id'];
			if ($is_user_logged_in) {
			?> 
			<a href="./profile.php">Profile</a>
			<a id="logoutbutton" href="./logout.php">Logout</a>
			<?php 
			} else {
			?>
			<a id="loginbutton" href="./login.php">Connect with Twitter</a>	
			<?php
			} 
			?>
			<a id="aboutbutton" href="./about.php">About</a>
		</div>
		<?php 
		$word = substr($_SERVER['REQUEST_URI'],1);
		if ($is_user_logged_in) {
		?>
		<div class="mywl-link" style="display: block; color: rgb(212, 212, 212);">
		<img src="./assets/images/loading.gif" alt="Loading" title="Loading" class="mywl-hide mywl-img">
		&#9829;</div>
		<?php 
		}
		?>