<!--
Name: Page Menu
Purpose: To be included on most screens for better look and ease of editing. (At the left side of the screen)
Author: GROUP WORK
Date: 27/02/2017
-->

	<nav id="nav">
		<div class="seperate">
			<label>Staff Members</label>
			<li <?php if(!empty($addstaff)) { echo 'class="active"'; } ?>>
				<a href="staffAdd.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Member</a>
			</li>
			<li <?php if(!empty($amendstaff)) { echo 'class="active"'; } ?>>
				<a href="staffAmend.php"><i class="fa fa-pencil" aria-hidden="true"></i>Amend Member</a>
			</li>
			<li <?php if(!empty($deletestaff)) { echo 'class="active"'; } ?>>
				<a href="staffDelete.php"><i class="fa fa-eraser" aria-hidden="true"></i>Delete Member</a>
			</li>
		</div>
		<div class="seperate">
			<label>Customers</label>
			<li <?php if(!empty($custadd)) { echo 'class="active"'; } ?>>
				<a href="custAdd.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Customer</a>
			</li>
			<li <?php if(!empty($custdelete)) { echo 'class="active"'; } ?>>
				<a href="custDelete.php"><i class="fa fa-eraser" aria-hidden="true"></i>Delete Customer</a>
			</li>
			<li <?php if(!empty($custamend)) { echo 'class="active"'; } ?>>
				<a href="custAmend.php"><i class="fa fa-pencil" aria-hidden="true"></i>Amend Customer</a>
			</li>
		</div>
		<div class="seperate">
			<label>Loan Accounts</label>
			<li <?php if(!empty($loanadd)) { echo 'class="active"'; } ?>>
				<a href="loanadd.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>Open Account</a>
			</li>
			<li <?php if(!empty($DrawLoan)) { echo 'class="active"'; } ?>>
				<a href="DrawLoan.php"><i class="fa fa-money" aria-hidden="true"></i>Draw Loan</a>
			</li>
			<li <?php if(!empty($deleteLoan)) { echo 'class="active"'; } ?>>
				<a href="deleteLoan.php"><i class="fa fa-times" aria-hidden="true"></i>Close loan Account</a>
				<li <?php if(!empty($history)) { echo 'class="active"'; } ?>>
				<a href="loanHistory.php"><i class="fa fa-address-book" aria-hidden="true"></i> loan History </a>
			</li>
				
			</li>
		</div>
		<div class="seperate">
			<label>Personal Accounts</label>
			<li <?php if(!empty($accamend)) { echo 'class="active"'; } ?>>
				<a href="accAmend.php"><i class="fa fa-pencil" aria-hidden="true"></i>Amend Account</a>
			</li>
			<li <?php if(!empty($accopen)) { echo 'class="active"'; } ?>>
				<a href="accOpen.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>Open Account</a>
			</li>
			<li <?php if(!empty($accclose)) { echo 'class="active"'; } ?>>
				<a href="accClose.php"><i class="fa fa-times" aria-hidden="true"></i>Close Account</a>
			</li>
			<li <?php if(!empty($acchistory)) { echo 'class="active"'; } ?>>
				<a href="accHistory.php"><i class="fa fa-address-book" aria-hidden="true"></i>Account History</a>
			</li>
		</div>
		<div class="seperate">
			<label>Extra</label>
			<li <?php if(!empty($lodge)) { echo 'class="active"'; } ?>>
				<a href="lodge.php"><i class="fa fa-money" aria-hidden="true"></i>Lodgements</a>
			</li>
		</div>
	</nav>