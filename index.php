<!--
Name: Main Page
Purpose: Welcome Page
Author: GROUP WORK
Date: 27/02/2017
-->

<?php
$main = true;
include_once 'header.php';
?>
	<main>
	    <div class="heading">
	        <h2>Main Page - Bank Management System</h2>
	    </div>
		<div>
			<div class="form">
				<div class="input">
					<label>Project:</label>
					<input type="text" value="C2ABank" disabled/>
				</div>
				<div class="input">
					<label>Prefered Browser:</label>
					<input type="text" value="Google Chrome" disabled/>
				</div>
				<div class="input">
					<label>Resources Used:</label>
					<input type="text" value="W3Schools" disabled/>
					<span><b>Link:</b> <a target="_blank" href="https://www.w3schools.com/">Click</a></span>
					<input type="text" value="FontAwesome (Icon toolkit)" disabled/>
					<span>
						<b>Link:</b> <a target="_blank" href="http://fontawesome.io/">Click</a>
					</span>
				</div>
				<div class="input">
					<label>Developed By:</label>
					<input type="text" value="Vladimir Plastikov (C00202262)" disabled/>
					<input type="text" value="Jakub Konkel (C00190374)" disabled/>
					<input type="text" value="Adrian Marzec (C00196492)" disabled/>
					<input type="text" value="Mohammed Hamad (C00210200)" disabled/>
				</div>
				<div class="input">
					<label>Screens:</label>
					<div class="input">
						<span>Vladimir Plastikov</span>
						<input type="text" value="Staff Members >> Add Member" disabled/>
						<input type="text" value="Staff Members >> Amend Member" disabled/>
						<input type="text" value="Staff Members >> Delete Member" disabled/>
						<input type="text" value="Extra >> Lodgements" disabled/>
					</div>
					<div class="input">
						<span>Jakub Konkel</span>
						<input type="text" value="Personal Accounts >> Amend Account" disabled/>
						<input type="text" value="Personal Accounts >> Open Account" disabled/>
						<input type="text" value="Personal Accounts >> Close Account" disabled/>
						<input type="text" value="Personal Accounts >> Account History" disabled/>
					</div>
					<div class="input">
						<span>Adrian Marzec</span>
						<input type="text" value="Staff Members >> Add Customer" disabled/>
						<input type="text" value="Staff Members >> Amend Customer" disabled/>
						<input type="text" value="Staff Members >> Delete Customer" disabled/>
						<input type="text" value="Extra >> Withdrawals" disabled/>
					</div>
					<div class="input">
						<span>Mohammed Hamad</span>
						<input type="text" value="Loan Accounts >> Open Account" disabled/>
						<input type="text" value="Loan Accounts >> Draw Loan" disabled/>
						<input type="text" value="Loan Accounts >> Close Account" disabled/>
						<input type="text" value="Loan Accounts >> Loan History" disabled/>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php
include_once 'footer.php';
?>