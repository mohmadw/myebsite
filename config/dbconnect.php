<?php
//CONNECTION DETAILS
$dbhost = "localhost";
$dbuser = "bankuser";
$dbpass = "Bank123";
$dbname = "c2adirector_";

//CONNECTION
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

//IS THE CONNECTION VALID? TEST
if(mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>