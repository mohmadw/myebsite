<!--
File Name: staffAdd.php
Name: Add Staff Member
Purpose: To add a member of staff.
Author: Vladimirs Plastikovs (C00202262)
Date(Last Update): 08/03/2017
-->

<?php
//FOR TAB TO BE ACTIVE IN MENU
$addstaff = "true";
include_once 'header.php';

//ADD FORM
if(isset($_POST["addStaff"])) {
    $sname = $_POST['sname'];
    $name = $_POST['name'];
    $street = $_POST['street'];
    $town = $_POST['town'];
    $county = $_POST['county'];
    $phoneNum = $_POST['phoneNum'];
    $dateEmp = $_POST['dateEmp'];
    $jobType = $_POST['jobType'];
	$jobTitle = $_POST['jobTitle'];
    $login = $_POST['login'];
    $date = date('Y-m-d');
    $checkLogin = mysqli_query($con, "SELECT * FROM staff WHERE loginName = '$login'");

	//CHECK IF LOGIN EXISTS // IF THE NAME IS TOO LONG // IF THE NAME FIELD HAS UNSUITABLE CHARACTERS // ASSUMING NONE OF THIS IS TRUE INSERT THE TABLE ROW // IF ERROR WHEN INSERTING - SHOW "Oops... Something went wrong." ERROR.
    if(mysqli_num_rows($checkLogin) > 0) {
        $error = "User with this <b>Login Name</b> already exists!";
    } elseif(strlen($name) >= 30) {
        $error = "<b>First Name</b> field can't have more than 30 characters.";
    } elseif(preg_match('/[^A-Za-z]/', $name)) {
        $error = "<b>First Name</b> field has unsuitable characters. Allowed characters: <b>A-Z</b>, <b>a-z</b>";
    } elseif($sql = mysqli_query($con, "INSERT INTO staff (surname, name, street, town, county, phoneNo, dateEmployed, jobType, jobTitle, loginName, lastUpdate) VALUES ('$sname', '$name', '$street', '$town', '$county', '$phoneNum', '$dateEmp', '$jobType', '$jobTitle', '$login', '$date')")) {
		$id = mysqli_insert_id($con);
        $success = "Staff member <b>".$name." ".$sname."</b> has been successfully <b>added</b>! <b>ID: #".$id."</b>";
    } else {
        $error = "Oops... Something went wrong.";
    }
}
?>

<!-- BODY START -->
	<main>
	    <div class="heading">
	        <h2>Staff Members >> Add</h2>
	    </div>
		<div>
            <div class="form">
<?php
    //INFO BOXES
    if(!empty($success)) {
        echo '<div id="success"><i class="fa fa-check-circle" aria-hidden="true"></i><b>Success!</b> ' .$success. '</div>';
    } elseif(!empty($error)) {
        echo '<div id="error"><i class="fa fa-times-circle" aria-hidden="true"></i><b>Error!</b> ' .$error. '</div>';
    }
?>  
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                    <div id="info" style="display: none;"><i class="fa fa-question-circle"  aria-hidden="true"></i><b>Info!</b> Are you sure you want to add a new staff member?
                        <button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
                        <input onclick="unlockAllInputs()" type="submit" id="submitForm" name="addStaff" value="Add"/>
                    </div>
                    <div class="input">
                        <label>Surname:</label>
                        <input type="text" name="sname" required/>
                        <label>First Name:</label>
                        <input type="text" name="name" required/>
                    </div>
                    <div class="input">
                        <label>Street:</label>
                        <input type="text" name="street" required/>
                        <label>Town:</label>
                        <input type="text" name="town" required/>
                        <label>County:</label>
                        <input type="text" name="county" required/>
                    </div>
                    <div class="input">
                        <label>Phone Number:</label>
                        <input type="text" name="phoneNum" required/>
                    </div>
                    <div class="input">
                        <label>Job Title:</label>
                        <input type="text" name="jobTitle" required/>
                        <label>Date Employed:</label>
                        <input type="date" name="dateEmp" required/>
                        <label>Job Type:</label>
						<select name="jobType" required>
							<option disabled value selected> -- Not Selected -- </option>
							<option value="1">Part-Time</option>
							<option value="2">Full-Time</option>
						</select>
                    </div>
                    <div class="input">
                        <label>Login Name:</label>
                        <input type="text" name="login" autocomplete="off" required/>
                    </div>
                </form>
                <div>
                    <a id="submit" onclick="submitBox()">Add</a>
                </div>
            </div>
		</div>
	</main>
<!-- BODY END -->

<script type="text/javascript">
//SHOW CONFIRMATION BOX
function submitBox() {
    document.getElementById('info').style.display = "block";
	document.getElementById('info').scrollIntoView();
}
	
//HIDE CONFIRMATION BOX
function hideSubmitBox() {
    document.getElementById('info').style.display = "none";
}
</script>

<?php
include_once 'footer.php';
?>