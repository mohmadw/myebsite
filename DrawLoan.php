<?php
//FOR TAB TO BE ACTIVE IN MENU
$DrwaLoan = "true";
include_once 'header.php';
if (isset($_POST["DrawLoan"])) {
	$cusID = $_POST['id'];
	$loanAmount = $_POST['loanAmount'];
	$balan= $_POST['balance'];
	$drwa =  $loanAmount+$balan;
	 if($sql = mysqli_query($con,  "UPDATE persAcc SET balance = '$drwa' WHERE custID = '$cusID'") && $sql = mysqli_query($con,  "UPDATE loanAcc SET loanAmount = '-$drwa' WHERE cusID = '$cusID'")) { 
    
 

        $success = "Loan added!";
    } else {

        $error = "Oops... Something went wrong.";
    }
}
?>



	<main>
	    <div class="heading">
	        <h2>Drwa Dowan a loan</h2>
	    </div>
		<div>
            <div class="form">
				<div class="input">
					<label>Loan Drwa:</label>
					<select id="listbox" onchange="populate()" name="surname">
						<option disabled selected value> -- SELECT -- </option>
						<?php
						$customerList = mysqli_query($con, "select customers.firstName,customers.surname,customers.street,loanAcc.accNo,loanAcc.balance,loanAcc.cusID ID,
						loanAcc.loanAmount,loanAcc.term,loanAcc.repAmount,loanAcc.dateOpened
 						from customers JOIN loanAcc ON customers.custID=loanAcc.cusID WHERE isClosed = '0' ");
						while($row = mysqli_fetch_array($customerList)) {
							$id = $row['ID'];
							$address = $row['street'];
							$loanAmount = $row['loanAmount'];
							$Term = $row['term'];
							$DateArrange = $row['dateOpened'];
							$monthlyRe = $row['repAmount'];
							$balan = $row['balance'];
							$loanAmount1=$row['loanAmount'];
							$allRows = $id.",".$address.",".$loanAmount.",".$Term.",".$DateArrange.",".$monthlyRe.",".$balan.",".$loanAmount1;
							echo "<option value = '" .$allRows. "'>".$row['firstName'] .$row['surname']. "</option>";
						}
						?>
					</select>
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
                    <div id="info" style="display: none;"><i class="fa fa-money"  aria-hidden="true"></i><b>Info!</b> Are you sure you want to add a new staff member?
                        <button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
						<input type="submit" id="submitForm" name="DrawLoan" value="Add"/>
                    </div>
                    <input type="hidden" name="id" id="id"/>
                    <div class="input">
                        <label>address:</label>
                        <input type="text" name="address" id="address" disabled/>
						  <label>Loan Ammount:</label>
                        <input type="text" id="loanAmount" disabled/>
						  <label>term:</label>
                        <input type="text" name="Term" id="Term" disabled/>
						  <label>date arrange:</label>
                        <input type="date" name="DateArrange" id="DateArrange" disabled/>
						  <label>monthly repayment:</label>
                        <input type="text" name="monthlyRe" id="monthlyRe" disabled/>
						    <input type="hidden" name="balance" id="balance"/>
						<input type="hidden" name="loanAmount" id="loanAmount1"/>
							
                        <span></span>
                    </div>
                   
                </form>
                <div id="allowSubmit">
                    <a id="submit" onclick="submitBox()">Add</a>
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
    document.getElementById("address").value = personDetails[1];
	document.getElementById("loanAmount").value = personDetails[2];
	 document.getElementById("Term").value = personDetails[3];
	document.getElementById("DateArrange").value = personDetails[4];
	document.getElementById("monthlyRe").value = personDetails[5];
		document.getElementById("balance").value = personDetails[6];
		document.getElementById("loanAmount1").value = personDetails[7];
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