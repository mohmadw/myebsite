	


<?php
//FOR TAB TO BE ACTIVE IN MENU
$loanadd = "true";
include_once 'header.php';

//ADD FORM
if (isset($_POST["loanadd"])) {
	$custID = $_POST ['id'];
	$loanAmount = $_POST['loanAmount'];
	$term = $_POST['Term'];
	$staffID = $_SESSION['userID'];
	$intRate = $_POST['rate'];
	$dateOpened = $_POST['dRange'];
	$total=	$loanAmount*$term *$intRate/100;
	$monthB=($loanAmount+$total)/($term*12);

		
    if($sql = mysqli_query($con, "INSERT INTO loanAcc ( loanAmount,cusID,staffID, term, intRate,dateOpened,totalInt,repAmount) VALUES ( '$loanAmount','$custID','$staffID', '$term','$intRate','$dateOpened','$total','$monthB')")) {
		

        $success = "the repament  is:(monthB)<b>".$monthB."</b>And the total amount is  (total):<b>".$total."</b>";
    } else {
        $error = "Oops... Something went wrong.";
    }
		}

		?>

	<main>
	    <div class="heading">
	        <h2>Loan Accounts >> Add</h2>
	    </div>
		<div>
	
            <div class="form">
				<div class="input">
						<label>Open a Loan Account:</label>
					<select id="listbox" onchange="populate()" name="surname">
						<option disabled selected value> -- SELECT -- </option>
						<?php
						$customerList = mysqli_query($con, "SELECT customers.custID,customers.firstName, customers.surname,customers.street, persAcc.dateOpened  FROM customers INNER JOIN persAcc ON customers.custID = persAcc.custID WHERE isDeleted = '0' ");
						while($row = mysqli_fetch_array($customerList)) {
							$id = $row['custID'];
							$dateOpened = $row['dateOpened'];
							$address = $row['street'];
							$allRows = $id.",".$dateOpened.",".$address;
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
  
  

                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"id="form" style="display: none;">
						
					
                    <div id="info" style="display: none;"><i class="fa fa-plus-circle" aria-hidden="true"></i><b>Info!</b> Are you sure you want to add a new loan Account?
                        <button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
						<input type="submit" id="submitForm" name="loanadd" value="Add"/>
						
						
						
                    </div>
                    <input type="hidden" name="id" id="id"/>
                    <div class="input">
                        <label>Date Opened:</label>
                        <input type="date" name="dateOpened" id="dateOpened" disabled/>
						  <label>address:</label>
                        <input type="text" name="address" id="address" disabled/>
                        <span></span>
                    </div>
                    <div class="input">
                        <label>Loan Ammount:</label>
                        <input type="text" name="loanAmount"  required="" pattern="[0-9]+(\.[0-9][0-9]?)?" />
						<label>Term:</label>
                        <input type="text" name="Term" required/>
							<label>Inerest Rate:</label>
                        <input type="text" name="rate" required/>
						<label>Date loan Arranged:</label>
                        <input type="date" name="dRange" required/>
						   


                        <span>     </span>
				
							
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
    document.getElementById("dateOpened").value = personDetails[1];
	document.getElementById("address").value = personDetails[2];
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