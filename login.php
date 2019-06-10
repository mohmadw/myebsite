<!--
Name: Login Page
Purpose: The login screen you will be redirected to if not logged in.
Author: GROUP WORK
Date: 27/02/2017
-->

<?php
//SESSION
session_start();

//IF SESSION EXISTS REDIRECT TO INDEX PAGE
if(isset($_SESSION['userID'])) {
	header ("location: index.php");
	exit();
}

//DB CONNECT
include_once 'config/dbconnect.php';

if(isset($_POST['login'])) {
    $id = $_POST['id'];
    $_SESSION['userID'] = $id;
    header ("location: index.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
        <title>Secure Area</title>

        <link rel="stylesheet" href="css/login.css" type="text/css">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    </head>

	<body>
	    <div class="login">
			<h4>Who will be working on the current operation?</h4>
			<form action="login.php" method="post">
				<select name="id">
					<option disabled selected value> -- SELECT -- </option>
					<?php
					$staffList = mysqli_query($con, "SELECT staffID, name, surname FROM staff WHERE isDeleted = 0 ORDER BY name");
					while($row = mysqli_fetch_array($staffList)) {
						echo "<option value = " .$row['staffID']. ">" .$row['name']. " ".$row['surname']."</option>";
					}
					?>
				</select>
				<input type="submit" name="login" value="Enter">
    		</form>
		    <?php
			if (isset($errormsg)) {
				echo '<div class="info">' .$errormsg. '</div>';
			}
		    ?>
    	</div>
	</body>
</html>