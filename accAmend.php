<!--
Name: Account Amend
Purpose: Amending Personal Accounts.
Author: Jakub Konkel
Date: 02/03/2017
-->

<?php
//FOR TAB TO BE ACTIVE IN MENU
$accamend = "true";
include_once 'header.php';

//AMEND FORM // persAccNo 	dateOpened 	balance lastUpdate <--- DATABASE COLUMNS
if(isset($_POST["amendAcc"])) {
    $persAccNo = $_POST['persAccNo'];
    $dateOpened = $_POST['dateOpened'];
    $balance = $_POST['balance'];
    $lastUpdate = $_POST['lastUpdate'];
    $date = date('Y-m-d');
    $checkCustomer = mysqli_query($con, "SELECT * FROM customer WHERE custID != '$custID'");
	
    if(mysqli_num_rows($checkCustomer) > 0) {
        $error = "User with this <b>Login Name</b> already exists";
    } 
	elseif($sql = mysqli_query($con, "UPDATE persAcc SET balance = '$balance', dateOpened = '$dateOpened' WHERE persAccNo = '$persAccNo'")) {
        $success = "Personal Account with ID <b> #".$persAccNo."</b> balance has changed to <b>".$balance."</b> successfully!";
    } 
	else {
        $error = "Oops... Something went wrong.";
    }
}
?>

<main>
		<div class="heading">
			<h2>Personal Account >> Amend</h2>
		</div>
	<div>
		<div class="form">
		<div class="input">
			<label>Personal Accounts:</label>
			<select id="listbox" onchange="populate(); lockInput();">
				<option disabled selected value> 
				-- SELECT -- 
				</option>
					<?php // persAccNo 	dateOpened 	balance lastUpdate <--- DATABASE COLUMNS
					$persAccList = mysqli_query($con, "SELECT customers.custID,customers.firstName, customers.surname,customers.street, persAcc.persAccNo, persAcc.balance, persAcc.lastUpdate, persAcc.dateOpened  FROM customers INNER JOIN persAcc ON customers.custID = persAcc.custID WHERE isDeleted = '0' ");
					while($row = mysqli_fetch_array($persAccList)) {
						$persAccNo = $row['persAccNo'];
						$dateOpened = $row['dateOpened'];
						$balance = $row['balance'];
						$lastUpdate = $row['lastUpdate'];

						$allRows = $persAccNo.",".$dateOpened.",".$balance.",".$lastUpdate;
									echo "<option value = '" .$allRows. "'>" .$row['firstName']. " ".$row['surname']."</option>";
								}
					?>
			</select>
			<span>Select a personal account from the listbox.</span>
		</div>
		
		
			
	<?php
//INFORMATION BOXES
		if(!empty($success)) {
			echo '<div id="success"><i class="fa fa-check-circle" aria-hidden="true"></i><b>Success!</b> ' .$success. '</div>';
			} 
		elseif(!empty($error)) {
			echo '<div id="error"><i class="fa fa-times-circle" aria-hidden="true"></i><b>Error!</b> ' .$error. '</div>';
			}
	?> 
	
			
			
			
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="form" style="display: none;">
		
		<!--/ persAccNo 	dateOpened 	balance lastUpdate  from datebase-->
		
                    <div id="info" style="display: none;"><i class="fa fa-question-circle"  aria-hidden="true"></i><b>Info!</b> Make sure all the fields are correct!
                        <button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
                        <input onclick="unlockAllInputs()" type="submit" id="submitForm" name="amendAcc" value="Save"/>
                    </div>
                    <a id="amend" onclick="unlockInput()">
                        <div id="lock" style="display: inline-block;"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <div id="unlock" style="display: none;"><i class="fa fa-unlock-alt" id="unlock" aria-hidden="true"></i></div>
                        Amend
                    </a>
                    <div class="input">
                        <label>Personal Account Number</label>
                        <input type="text" name="persAccNo" id="persAccNo" disabled required/>
                    </div>
                    <div class="input">
                        <label>Date Opened</label>
                        <input type="text" name="dateOpened" id="dateOpened" disabled required/>
                        <label>Balance</label>
                        <input type="text" name="balance" id="balance" disabled required/>
                    </div>
                    <div class="input">
                        <label>Date of Last Update</label>
                        <input type="text" name="lastUpdate" id="lastUpdate" disabled required/>
                    </div>
                </form>
                <div id="allowSubmit">
                    <a id="submit" onclick="submitBox()">Save</a>
                </div>
		</div>
	<div>
		</main>







<script type="text/javascript">
//POPULATE THE FIELDS // persAccNo 	dateOpened 	balance lastUpdate <--- DATABASE COLUMNS
function populate() {
    var sel = document.getElementById("listbox");
    var result = sel.options[sel.selectedIndex].value;
    var personDetails = result.split(',');
    document.getElementById("persAccNo").value = personDetails[0];
    document.getElementById("dateOpened").value = personDetails[1];
    document.getElementById("balance").value = personDetails[2];
    document.getElementById("lastUpdate").value = personDetails[3];
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
	document.getElementById('balance').removeAttribute("disabled");
    document.getElementById('persAccNo').disabled = true;
    document.getElementById('lastUpdate').disabled = true;
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
	document.getElementById('balance').disabled = true;
}
	
//UNLOCK ALL FIELDS BEFORE SUBMIT
function unlockAllInputs() {
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].removeAttribute("disabled");
    }
	document.getElementById('balance').removeAttribute("disabled");
}

//SHOW CONFIRMATION BOX
function submitBox() {
    document.getElementById('info').style.display = "block";
    document.getElementById('info').scrollIntoView();
}

//HIDE CONFIRMATION BOX-------------------------------------------------------------------
function hideSubmitBox() {
    document.getElementById('info').style.display = "none";
}
</script>
<?php
include_once 'footer.php';
?>