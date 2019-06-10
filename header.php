<!--
Name: Page Header
Purpose: To be included on most screens for better look and ease of editing. (At the top)
Author: GROUP WORK
Date: 27/02/2017
-->

<?php
//TIMEZONE
date_default_timezone_set('Europe/London');

//SESSION
session_start();

//IF !SESSION REDIRECT TO LOGIN PAGE
if(!isset($_SESSION['userID'])) {
	header('Location: login.php');
}

//DB CONNECTION
include_once 'config/dbconnect.php';

//GET/FETCH INFO OF WHO IS LOGGED IN
$getUser = mysqli_query($con, "SELECT * FROM staff WHERE staffID = '".$_SESSION['userID']."' LIMIT 1");
$userInfo = mysqli_fetch_array($getUser);
?>
<html>
<head>
    <title>Bank Management System</title>
    
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
</head>
<body>
	<header id="header">
		<a class="logo-text" href="/"><i class="fa fa-university" aria-hidden="true"></i>Bank Panel</a>
		<div class="header-name"><?php echo $userInfo['name'].' '.$userInfo['surname']; ?>
		    <a href="logout.php">
		        <i class="fa fa-sign-out" aria-hidden="true"></i>
		    </a>
		</div>
	</header>
<?php
include_once 'menu.php';
?>