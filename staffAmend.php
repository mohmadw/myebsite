<!--
File Name: staffAmend.php
Name: Amend Staff Member
Purpose: To amend a member of staff.
Author: Vladimirs Plastikovs (C00202262)
Date(Last Update): 08/03/2017
-->

<?php
//FOR TAB TO BE ACTIVE IN MENU
$amendstaff = "true";
include_once 'header.php';

//AMEND FORM
if(isset($_POST["amendStaff"])) {
    $id = $_POST['id'];
    $sname = $_POST['sname'];
    $name = $_POST['name'];
    $street = $_POST['street'];
    $town = $_POST['town'];
    $county = $_POST['county'];
    $phoneNum = $_POST['phoneNum'];
    $dateEmp = $_POST['dateEmp'];
    $jobType = $_POST['jobType'];
    $login = $_POST['login'];
    $date = date('Y-m-d');
    $checkLogin = mysqli_query($con, "SELECT * FROM staff WHERE loginName = '$login' AND staffID != '$id'");
	
	//CHECK IF LOGIN EXISTS // IF THE NAME IS TOO LONG // IF THE NAME FIELD HAS UNSUITABLE CHARACTERS // ASSUMING NONE OF THIS IS TRUE UPDATE THE TABLE ROW // IF ERROR WHEN UPDATING - SHOW "Oops... Something went wrong." ERROR.
    if(mysqli_num_rows($checkLogin) > 0) {
        $error = "User with this <b>Login Name</b> already exists!";
    } elseif(strlen($name) >= 30) {
        $error = "<b>Name</b> field can't have more than 30 characters. Allowed characters: <b>A-Z</b>, <b>a-z</b>";
    } elseif(preg_match('/[^A-Za-z]/', $name)) {
        $error = "<b>Name</b> field has unsuitable characters.";
    } elseif($sql = mysqli_query($con, "UPDATE staff SET surname = '$sname', name = '$name', street = '$street', town = '$town', county = '$county', phoneNo = '$phoneNum', dateEmployed = '$dateEmp', jobType = '$jobType', loginName = '$login', lastUpdate = '$date' WHERE staffID = '$id'")) {
        $success = "Staff member <b>".$name." ".$sname."</b> has been successfully <b>edited</b>!";
    } else {
        $error = "Oops... Something went wrong.";
    }
}
?>

<!-- BODY START -->
	<main>
	    <div class="heading">
	        <h2>Staff Members >> Amend</h2>
	    </div>
		<div>
            <div class="form">
                <div class="input">
					<label>Staff Members:</label>
                    <select id="listbox" onchange="populate(); lockInput();">
    					<option disabled selected value> -- SELECT -- </option>
    					<?php
    					$staffList = mysqli_query($con, "SELECT * FROM staff WHERE isDeleted = '0' ORDER BY name");
    					while($row = mysqli_fetch_array($staffList)) {
    					    $id = $row['staffID'];
                            $sname = $row['surname'];
                            $name = $row['name'];
                            $street = $row['street'];
                            $town = $row['town'];
                            $county = $row['county'];
                            $phoneNum = $row['phoneNo'];
                            $jobTitle = $row['jobTitle'];
                            $dateEmp = $row['dateEmployed'];
                            $jobType = $row['jobType'];
                            $login = $row['loginName'];
                            $lastUpd = $row['lastUpdate'];
                            $allRows = $id.",".$sname.",".$name.",".$street.",".$town.",".$county.",".$phoneNum.",".$jobTitle.",".$dateEmp.",".$jobType.",".$login.",".$lastUpd;
    						echo "<option value = '" .$allRows. "'>" .$row['name']. " ".$row['surname']."</option>";
    					}
    					?>
    				</select>
					<span>Select a saff member from the listbox.</span>
                </div>
<?php
    //INFO BOXES
    if(!empty($success)) {
        echo '<div id="success"><i class="fa fa-check-circle" aria-hidden="true"></i><b>Success!</b> ' .$success. '</div>';
    } elseif(!empty($error)) {
        echo '<div id="error"><i class="fa fa-times-circle" aria-hidden="true"></i><b>Error!</b> ' .$error. '</div>';
    }
?>  
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="form" style="display: none;">
                    <div id="info" style="display: none;"><i class="fa fa-question-circle"  aria-hidden="true"></i><b>Info!</b> Are you sure you want to add a new member of staff?
                        <button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
                        <input onclick="unlockAllInputs()" type="submit" id="submitForm" name="amendStaff" value="Save"/>
                    </div>
                    <a id="amend" onclick="unlockInput()">
                        <div id="lock" style="display: inline-block;"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <div id="unlock" style="display: none;"><i class="fa fa-unlock-alt" id="unlock" aria-hidden="true"></i></div>
                        Amend
                    </a>
                    <div class="input">
                        <label>Staff ID:</label>
                        <input type="text" name="id" id="id" disabled required/>
                    </div>
                    <div class="input">
                        <label>Surname:</label>
                        <input type="text" name="sname" id="sname" disabled required/>
                        <label>First Name:</label>
                        <input type="text" name="name" id="name" disabled required/>
                    </div>
                    <div class="input">
                        <label>Street:</label>
                        <input type="text" name="street" id="street" disabled required/>
                        <label>Town:</label>
                        <input type="text" name="town" id="town" disabled required/>
                        <label>County:</label>
                        <input type="text" name="county" id="county" disabled required/>
                    </div>
                    <div class="input">
                        <label>Phone Number:</label>
                        <input type="text" name="phoneNum" id="phoneNum" disabled required/>
                    </div>
                    <div class="input">
                        <label>Job Title:</label>
                        <input type="text" name="jobTitle" id="jobTitle" disabled required/>
                        <label>Date Employed:</label>
                        <input type="date" name="dateEmp" id="dateEmp" disabled required/>
                        <label>Job Type:</label>
						<select id="jobType" name="jobType" disabled required>
							<option disabled value> -- Not Selected -- </option>
							<option value="1">Part-Time</option>
							<option value="2">Full-Time</option>
						</select>
                    </div>
                    <div class="input">
                        <label>Login Name:</label>
                        <input type="text" name="login" id="login" disabled required/>
                    </div>
                    <div class="input">
                        <label>Last Update:</label>
                        <input type="date" name="lastUpd" id="lastUpd" disabled />
                    </div>
                </form>
                <div id="allowSubmit">
                    <a id="submit" onclick="submitBox()">Save</a>
                </div>
            </div>
		</div>
	</main>
<!-- BODY END -->
	
<script type="text/javascript">
//POPULATE THE FIELDS
function populate() {
    var sel = document.getElementById("listbox");
    var result = sel.options[sel.selectedIndex].value;
    var personDetails = result.split(',');
    document.getElementById("id").value = personDetails[0];
    document.getElementById("sname").value = personDetails[1];
    document.getElementById("name").value = personDetails[2];
    document.getElementById("street").value = personDetails[3];
    document.getElementById("town").value = personDetails[4];
    document.getElementById("county").value = personDetails[5];
    document.getElementById("phoneNum").value = personDetails[6];
    document.getElementById("jobTitle").value = personDetails[7];
    document.getElementById("dateEmp").value = personDetails[8];
    document.getElementById("jobType").value = personDetails[9];
    document.getElementById("login").value = personDetails[10];
    document.getElementById("lastUpd").value = personDetails[11];
    document.getElementById('form').style.display = "block";
}

//UNLOCK/LOCK FIELDS
function unlockInput() {
    var inputs = document.getElementsByTagName("input");
    if (document.getElementById('unlock').style.display == "none") {
       document.getElementById('unlock').style.display = "inline-block";
       document.getElementById('lock').style.display = "none";
       document.getElementById('allowSubmit').style.display = "block";
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].removeAttribute("disabled");
        }
	document.getElementById('jobType').removeAttribute("disabled");
    document.getElementById('id').disabled = true;
    document.getElementById('jobTitle').disabled = true;
    document.getElementById('lastUpd').disabled = true;
    } else {
        lockInput();
    }
}

//LOCK ALL FIELDS
function lockInput() {
    var inputs = document.getElementsByTagName("input");
    document.getElementById('lock').style.display = "inline-block";
    document.getElementById('unlock').style.display = "none";
    document.getElementById('allowSubmit').style.display = "none";
    document.getElementById('info').style.display = "none";
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = true;
    }
	document.getElementById('jobType').disabled = true;
}

//UNLOCK ALL FIELDS BEFORE SUBMIT
function unlockAllInputs() {
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].removeAttribute("disabled");
    }
	document.getElementById('jobType').removeAttribute("disabled");
}

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