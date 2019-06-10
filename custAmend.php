<!--
Name: Amend a Customer
Purpose: To amend a customer.
Author: Adrian Marzec (C00196492)
Date: 7/3/2017
-->

<?php
//FOR TAB TO BE ACTIVE IN MENU
$custAmend = "true";
include_once 'header.php';

//AMEND FORM
if(isset($_POST["custAmend"])) {
    $id = $_POST['id'];
	$firstName = $_POST['firstName'];
    $surname = $_POST['surname'];
    $street = $_POST['street'];
    $town = $_POST['town'];
    $county = $_POST['county'];
    $dob = $_POST['dob'];
    $phoneNo = $_POST['phoneNo'];
    $email = $_POST['email'];
    $occupation = $_POST['occupation'];
	$salary = $_POST['salary'];
	$guarantorsName = $_POST['guarantorsName'];
	$staffID = $_POST['staffID'];
    $date = date('Y-m-d');
} 
if($sql = mysqli_query($con, "UPDATE customers SET firstName = '$firstName', surname = '$surname', street = '$street', town = '$town', county = '$county', dob = '$dob', phoneNo = '$phoneNo', email = '$email', occupation = '$occupation', salary = '$salary', guarantorsName = '$guarantorsName', lastUpdate = '$date', staffID = '$staffID'  WHERE custID = '$id'")) {
        $success = "Customer <b>".$firstName." ".$surname."</b> has been successfully edited!";
    } else {
        $error = "Oops... Something went wrong.";
    }

?>
	<main>
	    <div class="heading">
	        <h2>Customers >> Amend</h2>
	    </div>
		<div>
            <div class="form">
                <div class="input">
					<label>Customers:</label>
                    <select id="listbox" onchange="populate(); lockInput();">
    					<option disabled selected value> -- SELECT -- </option>
    					<?php
    					$custList = mysqli_query($con, "SELECT * FROM customers WHERE isDeleted = '0' ORDER BY firstName");
    					while($row = mysqli_fetch_array($custList)) {
    					    $id = $row['custID'];
							$firstName = $row['firstName'];
                            $surname = $row['surname'];
                            $street = $row['street'];
                            $town = $row['town'];
                            $county = $row['county'];
                            $dob = $row['dob'];
                            $phoneNo = $row['phoneNo'];
                            $email = $row['email'];
                            $occupation = $row['occupation'];
                            $salary = $row['salary'];
							$guarantorsName = $row['guarantorsName'];
                            $update = $row['lastUpdate'];
                            $allRows = $id.",".$firstName.",".$surname.",".$street.",".$town.",".$county.",".$dob.",".$phoneNo.",".$email.",".$occupation.",".$salary.",".$guarantorsName.",".$update;
    						echo "<option value = '" .$allRows. "'>" .$row['firstName']. " ".$row['surname']."</option>";
    					}
    					?>
    				</select>
					<span>Select a customer from the listbox.</span>
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
                    <div id="info" style="display: none;"><i class="fa fa-question-circle"  aria-hidden="true"></i><b>Info!</b> Make sure all the fields are correct!
                        <button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
                        <input onclick="unlockAllInputs()" type="submit" id="submitForm" name="custAmend" value="Save"/>
                    </div>
                    <a id="amend" onclick="unlockInput()">
                        <div id="lock" style="display: inline-block;"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <div id="unlock" style="display: none;"><i class="fa fa-unlock-alt" id="unlock" aria-hidden="true"></i></div>
                        Amend
                    </a>
                    <div class="input">
                        <label>Cust ID:</label>
                        <input type="text" name="id" id="id" disabled required/>
                    </div>
                    <div class="input">
                        <label>First Name:</label>
                        <input type="text" name="firstName" id="firstName" disabled required/>
                        <label>Surname:</label>
                        <input type="text" name="surname" id="surname" disabled required/>
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
                        <label>Date of Birth:</label>
                        <input type="text" name="dob" id="dob" disabled required/>
                    </div>
					 <div class="input">
                        <label>Phone Number:</label>
                        <input type="text" name="phoneNo" id="phoneNo" disabled required/>
                    </div>
                    <div class="input">
                        <label>Email:</label>
                        <input type="text" name="email" id="email" disabled required/>
					</div>
					<div class="input">
                        <label>Occupation:</label>
                        <input type="text" name="occupation" id="occupation" disabled required/>
					</div>
                    <div class="input">
                        <label>Salary:</label>
                        <input type="text" name="salary" id="salary" disabled required/>
                    </div>
                    <div class="input">
                        <label>Guarantor's Name:</label>
                        <input type="text" name="guarantorsName" id="guarantorsName" disabled />
                    </div>
					<div class="input">
                        <label>Last Update:</label>
                        <input type="date" name="update" id="update" disabled />
                    </div>
                </form>
                <div id="allowSubmit">
                    <a id="submit" onclick="submitBox()">Save</a>
                </div>
            </div>
		</div>
	</main>
	
<script type="text/javascript">
//POPULATE THE FIELDS
function populate() {
    var sel = document.getElementById("listbox");
    var result = sel.options[sel.selectedIndex].value;
    var personDetails = result.split(',');
    document.getElementById("id").value = personDetails[0];
    document.getElementById("firstName").value = personDetails[1];
    document.getElementById("surname").value = personDetails[2];
    document.getElementById("street").value = personDetails[3];
    document.getElementById("town").value = personDetails[4];
    document.getElementById("county").value = personDetails[5];
    document.getElementById("dob").value = personDetails[6];
    document.getElementById("phoneNo").value = personDetails[7];
    document.getElementById("email").value = personDetails[8];
    document.getElementById("occupation").value = personDetails[9];
    document.getElementById("salary").value = personDetails[10];
    document.getElementById("guarantorsName").value = personDetails[11];
	document.getElementById("update").value = personDetails[12];
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
    document.getElementById('id').disabled = true;
	document.getElementById('dob').disabled = true;
    document.getElementById('update').disabled = true;
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
	//document.getElementById('jobType').disabled = true;
}

//UNLOCK ALL FIELDS BEFORE SUBMIT
function unlockAllInputs() {
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].removeAttribute("disabled");
    }
	//document.getElementById('jobType').removeAttribute("disabled");
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