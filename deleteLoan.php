<?php
//FOR TAB TO BE ACTIVE IN MENU
$deleteLoan = "true";
include_once 'header.php';

//DELETE FORM
if(isset($_POST["deleteLoan"])) {
    $id = $_POST['id'];
	  $getMember = mysqli_query($con, "SELECT * FROM loanAcc WHERE accNo= '$id'");
    $row = mysqli_fetch_array($getMember);
	if($row['balance'] != 0){
		$error = "Cant close";
	} elseif($sql = mysqli_query($con, "UPDATE loanAcc SET isClosed =1 where accNo=  '$id'" )) {
        $success = "loan account <b>" .$row['accNo']."</b> has been successfully deleted!";
    } else {
        $error = "Oops...    Something went wrong.";
    }
}
?>
	<main>
	    <div class="heading">
	        <h2>looan account >> Delete</h2>
	    </div>
		<div>
            <div class="form">
                <div class="input">
					<label>loan account:</label>
                    <select id="listbox" onchange="populate()">
    					<option disabled selected value> -- SELECT -- </option>
    					<?php
    					$loancustomer = mysqli_query($con, "select customers.custID,customers.firstName,customers.surname,customers.street,loanAcc.accNo,loanAcc.balance,loanAcc.staffID,
						loanAcc.loanAmount,loanAcc.term,loanAcc.intRate,loanAcc.totalInt,loanAcc.repAmount,loanAcc.drawDownDate
 						from customers JOIN loanAcc ON customers.custID=loanAcc.cusID  WHERE isClosed = '0' ");
    					while($row = mysqli_fetch_array($loancustomer)) {
    					    $id = $row['accNo'];
							 $address = $row['street'];
                            $balance = $row['balance'];
                            $custId = $row['accNo'];
                            $sttaffid = $row['staffID'];
                            $loanAmount = $row['loanAmount'];
                            $term = $row['term'];
                            $intrestRrate = $row['intRate'];
                            $Rep = $row['repAmount'];
                            $drwaDate = $row['drawDownDate'];
                            $totalInt = $row['totalInt'];
                           
         $allRows = $id.",".$balance.",".$custId.",".$sttaffid.",".$loanAmount.",".$term.",".$intrestRrate.",".$Rep.",".$drwaDate.
			",".$totalInt. ",".$address ;
    							echo "<option value = '" .$allRows. "'>".$row['firstName'] ."   " .$row['surname']. "</option>";
							
    					}
    					?>
    				</select>
					<span>Select a loan customer from the listbox.</span>
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
                    <div id="info" style="display: none;"><i class="fa fa-times" aria-hidden="true"></i><b>Info!</b> Are you sure you want to delete the selected member?
						<button type="button" onclick="hideSubmitBox()" id="submitForm">Cancel</button>
                        <input type="submit" id="submitForm" name="deleteLoan" value="Delete"/>
                    </div>
					<input type="hidden" name="id" id="id"/>
                    <div class="input">
						 <label>address:</label>
                        <input type="text" name="address" id="address" disabled/>
                        <label>balance:</label>
                        <input type="text" name="balance" id="balance" disabled/>
                        <label>customer id:</label>
                        <input type="text" name="custId" id="custId" disabled/>
                    </div>
                    <div class="input">
						<label>Staff ID:</label>
                        <input type="text" name="sttaffid" id="sttaffid" disabled/>
                
                       
                        <label>loanAmount:</label>
                        <input type="text" name="loanAmount" id="loanAmount" disabled/>
                        <label>Term:</label>
                        <input type="text" name="term" id="term" disabled/>
                    </div>
                    <div class="input">
                        <label>inrest Rate:</label>
                        <input type="text" name="intrestRrate" id="intrestRrate" disabled/>
                    </div>
                    <div class="input">
                        <label>Monthly Repayment:</label>
                        <input type="text" name="Rep" id="Rep" disabled/>
                        <label>Date draw mony:</label>
                        <input type="date" name="drwaDate" id="drwaDate" disabled/>
                        <label>Total Intrest Rate:</label>
						 <input type="text" name="totalInt" id="totalInt" disabled/>
							
							
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
    document.getElementById("id").value = personDetails[0];
    document.getElementById("balance").value = personDetails[1];
    document.getElementById("custId").value = personDetails[2];
    document.getElementById("sttaffid").value = personDetails[3];
    document.getElementById("loanAmount").value = personDetails[4];
    document.getElementById("term").value = personDetails[5];
    document.getElementById("intrestRrate").value = personDetails[6];
    document.getElementById("Rep").value = personDetails[7];
    document.getElementById("drwaDate").value = personDetails[8];
	   document.getElementById("totalInt").value = personDetails[9];
		   document.getElementById("address").value = personDetails[10];
	 
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