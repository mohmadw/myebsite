<!--
File Name: staffDelete.php
Name: Delete Staff Member
Purpose: To delete a member of staff.
Author: Vladimirs Plastikovs (C00202262)
Date(Last Update): 08/03/2017
-->

<?php
//FOR TAB TO BE ACTIVE IN MENU
$deletestaff = "true";
include_once 'header.php';

//DELETE FORM
if(isset($_POST["deleteStaff"])) {
    $id = $_POST['id'];
    $getMember = mysqli_query($con, "SELECT * FROM staff WHERE staffID = '$id'");
    $row = mysqli_fetch_array($getMember);
	
	//CHECK IF THE ACCOUNT BEING DELETE HAS A "MANAGER" JOBTITLE. IF IT DOES, CHECK IF THE ACCOUNT WHO IS TRYING TO DELETE HAS "CHIEF OF HUMAN RESOURCES" JOBTITLE.
	if($row['jobTitle'] == "Manager" && $userInfo['jobTitle'] != "Chief of Human Resources") {
		$error = "The staff member you have selected is a <b>manager</b>. Only <b>'Chief of Human Resources'</b> has a permission to delete <b>Managers</b>!";
	} elseif($sql = mysqli_query($con, "UPDATE staff SET isDeleted = 1 WHERE staffID = '$id'")) {
        $success = "Staff member <b>".$row['name']." ".$row['surname']."</b> has been successfully <b>deleted</b>!";
    } else {
        $error = "Oops... Something went wrong.";
    }
}
?>

<!-- BODY START -->
	<main>
	    <div class="heading">
	        <h2>Staff Members >> Delete</h2>
	    </div>
		<div>
            <div class="form">
                <div class="input">
					<label>Staff Members:</label>
                    <select id="listbox" onchange="populate()">
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
                            $allRows = $id.",".$sname.",".$name.",".$street.",".$town.",".$county.",".$phoneNum.",".$jobTitle.",".$dateEmp.",".$jobType.",".$login;
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
                    <div id="info" style="display: none;"><i class="fa fa-question-circle"  aria-hidden="true"></i><b>Info!</b> Are you sure you want to delete the selected member of staff?
						<button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
                        <input type="submit" id="submitForm" name="deleteStaff" value="Delete"/>
                    </div>
					<input type="hidden" name="id" id="id"/>
                    <div class="input">
                        <label>Surname:</label>
                        <input type="text" name="sname" id="sname" disabled/>
                        <label>First Name:</label>
                        <input type="text" name="name" id="name" disabled/>
                    </div>
                    <div class="input">
                        <label>Street:</label>
                        <input type="text" name="street" id="street" disabled/>
                        <label>Town:</label>
                        <input type="text" name="town" id="town" disabled/>
                        <label>County:</label>
                        <input type="text" name="county" id="county" disabled/>
                    </div>
                    <div class="input">
                        <label>Phone Number:</label>
                        <input type="text" name="phoneNum" id="phoneNum" disabled/>
                    </div>
                    <div class="input">
                        <label>Job Title:</label>
                        <input type="text" name="jobTitle" id="jobTitle" disabled/>
                        <label>Date Employed:</label>
                        <input type="date" name="dateEmp" id="dateEmp" disabled/>
                        <label>Job Type:</label>
						<select id="jobType" name="jobType" disabled>
							<option disabled value> -- Not Selected -- </option>
							<option value="1">Part-Time</option>
							<option value="2">Full-Time</option>
						</select>
                    </div>
                    <div class="input">
                        <label>Login Name:</label>
                        <input type="text" name="login" id="login" disabled/>
                    </div>
                </form>
                <div id="allowSubmit">
                    <a id="submit" onclick="submitBox()">Delete</a>
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
    document.getElementById('form').style.display = "block";
    document.getElementById('allowSubmit').style.display = "block";
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