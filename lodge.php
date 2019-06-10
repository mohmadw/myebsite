<!--
File Name: lodge.php
Name: Lodgements
Purpose: To lodge money to an account.
Author: Vladimirs Plastikovs (C00202262)
Date(Last Update): 08/03/2017
-->

<?php
//FOR TAB TO BE ACTIVE IN MENU
$lodge = "true";
include_once 'header.php';

//SEARCH FORM
if(isset($_POST["search"])) {
    $accNum = $_POST['aNum'];
	$accType = $_POST['accountType'];
	
	if($accType == "1") {
		$sql = mysqli_query($con, "SELECT * FROM persAcc JOIN customers ON customers.custID = persAcc.custID WHERE persAccNo = '$accNum'");
		$accTypeName = "Personal";
	} else {
		$sql = mysqli_query($con, "SELECT * FROM loanAcc JOIN customers ON customers.custID = loanAcc.cusID WHERE accNo = '$accNum'");
		$accTypeName = "Loan";
	}
	
    if(mysqli_num_rows($sql) == 0) {
        $error = $accTypeName." account with id: <b>#".$accNum."</b> doesn't exist!";
    } else {
		$row = mysqli_fetch_array($sql);
	}
}

//LODGE FORM
if(isset($_POST["lodge"])) {
    $accNum = $_POST['aNum'];
	$balance = $_POST['balance'];
	$amount = $_POST['amount'];
	$accType = $_POST['accType'];
	$staffID = $_SESSION['userID'];
    $date = date('Y-m-d');
	
	$total = $balance+$amount;
	
	//VARIABLES FOR EASE OF WORKING WITH SQL QUERY
	if($accType == "1") {
		$accType = "persAcc";
		$trans = "persTrans";
		$idName = "persAccNo";
		$accName = "Personal";
	} else {
		$accType = "loanAcc";
		$trans = "loanTrans";
		$idName = "accNo";
		$accName = "Loan";
	}
	
	if($sql = mysqli_query($con, "UPDATE ".$accType." SET balance = ".$total." WHERE ".$idName." = ".$accNum) && $sql = mysqli_query($con, "INSERT INTO ".$trans." (date, amount, ".$idName.", staffID, balance) VALUES ('$date', '$amount', '$accNum', '$staffID', '$total')")) {
		$id = mysqli_insert_id($con);
		$success = "<b>&#8364;".$amount."</b> has been successfully <b>lodged</b> to a <b>".$accName." account</b> with Account Number: <b>#".$accNum."</b>. ".$accName." Transaction ID: <b>#".$id."</b>";
	} else {
		$error = "Oops... Something went wrong.";
	}
}
?>

<!-- BODY START -->
	<main>
	    <div class="heading">
	        <h2>Extra >> Lodgements</h2>
	    </div>
		<div>
            <div class="form">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="input">
						<label>Account Type:</label>
						<select name="accountType" required>
							<option disabled value <?php if(!isset($_POST["search"])) { echo "selected"; } ?>> -- Not Selected -- </option>
							<option value="1" <?php if(isset($_POST["accountType"]) && $_POST["accountType"] == "1") { echo "selected"; } ?>>Personal</option>
							<option value="2" <?php if(isset($_POST["accountType"]) && $_POST["accountType"] == "2") { echo "selected"; } ?>>Loan</option>
						</select>
						<label>Account Number:</label>
						<input type="number" name="aNum" value="<?php if(isset($_POST["search"])) { echo $_POST["aNum"]; } ?>" required/>
						<input type="submit" id="submit" name="search" value="Search" style="float: none; margin-bottom: 0px; margin-top: 5px;"/>
					</div>
				</form>
<?php
    //INFO BOXES
    if(!empty($success)) {
        echo '<div id="success"><i class="fa fa-check-circle" aria-hidden="true"></i><b>Success!</b> ' .$success. '</div>';
    } elseif(!empty($error)) {
        echo '<div id="error"><i class="fa fa-times-circle" aria-hidden="true"></i><b>Error!</b> ' .$error. '</div>';
    }
?>
<?php
	if(isset($_POST["search"]) && empty($error)) {
?>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                    <div id="info" style="display: none;"><i class="fa fa-question-circle"  aria-hidden="true"></i><b>Info!</b> Are you sure you want to make a lodgement?
                        <button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
                        <input type="submit" onclick="unlockAllInputs()" id="submitForm" name="lodge" value="Lodge"/>
                    </div>
					<input type="hidden" name="aNum" value="<?php echo $_POST["aNum"]; ?>"/>
					<input type="hidden" name="balance" value="<?php echo $row["balance"]; ?>"/>
                    <div class="input">
                        <label>Surname:</label>
                        <input type="text" value="<?php echo $row['surname']; ?>" disabled/>
                        <label>First Name:</label>
                        <input type="text" value="<?php echo $row['firstName']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label>Street:</label>
                        <input type="text" value="<?php echo $row['street']; ?>" disabled/>
                        <label>Town:</label>
                        <input type="text" value="<?php echo $row['town']; ?>" disabled/>
                        <span></span>
                        <label>County:</label>
                        <input type="text" value="<?php echo $row['county']; ?>" disabled/>
                        <span></span>
                    </div>
                    <div class="input">
                        <label>Type of Account:</label>
                        <select name="accType" id="accType" disabled>
							<option value="1" <?php if(isset($_POST["accountType"]) && $_POST["accountType"] == "1") { echo "selected"; } ?>>Personal</option>
							<option value="2" <?php if(isset($_POST["accountType"]) && $_POST["accountType"] == "2") { echo "selected"; } ?>>Loan</option>
						</select>
                        <label>Account Open Date:</label>
                        <input type="date" value="<?php echo $row['dateOpened']; ?>" disabled/>
                        <label>Balance:</label>
                        <input type="text" value="<?php echo "&#8364;".$row['balance']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label>Lodgement Ammount:</label>
                        <input type="number" name="amount" placeholder="&#8364;" required/>
                    </div>
                </form>
                <div>
                    <a id="submit" onclick="submitBox()">Lodge</a>
                </div>
<?php
	}
?>
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
	
//UNLOCK ALL FIELDS BEFORE SUBMIT
function unlockAllInputs() {
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].removeAttribute("disabled");
    }
	document.getElementById('accType').removeAttribute("disabled");
}
</script>

<?php
include_once 'footer.php';
?>