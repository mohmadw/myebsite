<!--
Name: Add a customer
Purpose: To add a customer in table
Author: Adrian Marzec (C00196492)
Date: 6/3/2017
-->

<?php
//FOR TAB TO BE ACTIVE IN MENU
$custadd = "true";
include_once 'header.php';

//ADD FORM
if(isset($_POST["addCust"])) {
	$name = $_POST['firstName'];
    $sname = $_POST['surname'];
    $street = $_POST['street'];
    $town = $_POST['town'];
    $county = $_POST['county'];
    $dob = $_POST['dob'];
    $phoneNo = $_POST['phoneNo'];
    $email = $_POST['email'];
	$occupation = $_POST['occupation'];
    $salary = $_POST['salary'];
	$guaName = $_POST['guarantorsName'];
    $date = date('Y-m-d');
	if(strlen($name) >= 30) {
        $error = "<b>First Name</b> field can't have more than X characters.";
    } elseif(preg_match('/[^A-Za-z]/', $name)) {
        $error = "<b>First Name</b> field has unsuitable characters.";
    } elseif($sql = mysqli_query($con, "INSERT INTO customers (firstName, surname, street, town, county, dob, phoneNo, email, occupation, salary, guarantorsName,  lastUpdate) VALUES ('$name', '$sname', '$street', '$town', '$county', '$dob', '$phoneNo', '$email', '$occupation', '$salary', '$guarantorsName', '$date')")) {
		$id = mysqli_insert_id($con);
        $success = "Customer <b>".$name." ".$sname."</b> has been successfully added! <b>ID: #".$id."</b>";
    } else {
        $error = "Oops... Something went wrong.";
    }
}
?>
	<main>
	    <div class="heading">
	        <h2>Customers >> Add</h2>
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
                    <div id="info" style="display: none;"><i class="fa fa-question-circle"  aria-hidden="true"></i><b>Info!</b> Are you sure you want to add a new customer?
                        <button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
                        <input onclick="unlockAllInputs()" type="submit" id="submitForm" name="addCust" value="Add"/>
                    </div>
                    <div class="input">
                        <label>Surname:</label>
                        <input type="text" name="surname" title="Allowed characters: A-Z, a-z | Max length: 30 | Required" required/>
                        <label>First Name:</label>
                        <input type="text" name="firstName" title="Allowed characters: A-Z, a-z | Max length: 30 | Required" required/>
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
                        <label>Date of Birth:</label>
						<input type="date" name="dob" required/>
                    </div>
					<div class="input">
                        <label>Phone Number:</label>
                        <input type="text" name="phoneNo" required/>
                    </div>
					<div class="input">
                        <label>Email:</label>
                        <input type="text" name="email" required/>
                    </div>
					<div class="input">
                        <label>Occupation:</label>
                        <input type="text" name="occupation" required/>
                    </div>
					<div class="input">
                        <label>Salary:</label>
                        <input type="text" name="salary" required/>
                    </div>
					<div class="input">
                        <label>Guarantor's Name:</label>
                        <input type="text" name="guarantorsName"/>
                    </div>
                </form>
                <div>
                    <a id="submit" onclick="submitBox()">Add</a>
                </div>
            </div>
		</div>
	</main>
	
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