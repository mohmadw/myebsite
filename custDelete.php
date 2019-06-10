<!--
Name: Delete a customer
Purpose: To dalete a customer from a table
Author: Adrian Marzec (C00196492)
Date: 7/3/2017
-->

<?php
//FOR TAB TO BE ACTIVE IN MENU
$custDelete = "true";
include_once 'header.php';

//DELETE FORM
if(isset($_POST["deleteCust"])) {
    $custID = $_POST['custID'];
    $getCust = mysqli_query($con, "SELECT * FROM customers WHERE custID = '$custID'");
    $row = mysqli_fetch_array($getCust);
	if($sql = mysqli_query($con, "UPDATE customers SET isDeleted = 1 WHERE custID = '$custID'")) {
        $success = "Customer <b>".$row['firstName']." ".$row['surname']."</b> has been successfully deleted!";
    } else {
        $error = "Oops... Something went wrong.";
    }

}
?>
	<main>
	    <div class="heading">
	        <h2>Customers >> Delete</h2>
	    </div>
		<div>
            <div class="form">
                <div class="input">
					<label>Customers:</label>
                    <select id="listbox" onchange="populate()">
    					<option disabled selected value> -- SELECT -- </option>
    					<?php
    					$custList = mysqli_query($con, "SELECT * FROM customers WHERE isDeleted = '0' ORDER BY firstName");
    					while($row = mysqli_fetch_array($custList)) {
    					    $custID = $row['custID'];
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
                        $allRows = $custID.",".$firstName.",".$surname.",".$street.",".$town.",".$county.",".$dob.",".$phoneNo.",".$email.",".$occupation.",".$salary.",".$guarantorsName;
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
                    <div id="info" style="display: none;"><i class="fa fa-question-circle"  aria-hidden="true"></i><b>Info!</b> Are you sure you want to delete the selected customer?
						<button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
                        <input type="submit" id="submitForm" name="deleteCust" value="Delete"/>
                    </div>
					<input type="hidden" name="custID" id="custID"/>
                    <div class="input">
                        <label>Surname:</label>
                        <input type="text" name="surname" id="surname" disabled/>
                        <label>First Name:</label>
                        <input type="text" name="firstName" id="firstName" disabled/>
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
                        <label>Date of Birth:</label>
                        <input type="date" name="dob" id="dob" disabled/>
                    </div>
                    <div class="input">
                        <label>Phone Number:</label>
                        <input type="text" name="phoneNo" id="phoneNo" disabled/>
                    </div>
				    <div class="input">
                        <label>Email:</label>
                        <input type="email" name="email" id="email" disabled/>
                    </div>
					<div class="input">
                        <label>Occupation:</label>
                        <input type="text" name="occupation" id="occupation" disabled/>
                    </div>
					<div class="input">
                        <label>Salary:</label>
                        <input type="text" name="salary" id="salary" disabled/>
                    </div>
					<div class="input">
                        <label>Guarantor's Name:</label>
                        <input type="text" name="guarantorsName" id="guarantorsName" disabled/>
                    </div>
                </form>
                <div id="allowSubmit">
                    <a id="submit" onclick="submitBox()">Delete</a>
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
    document.getElementById("custID").value = personDetails[0];
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
    document.getElementById('guarantorsName').style.display = "block";
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