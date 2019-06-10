<!--
Name: Loan Account History.
Purpose: Checking Loan Account History.
Author: Mohammed Hamad
Date: 07/03/2017
-->



		
<?php
//FOR TAB TO BE ACTIVE IN MENU
$history = "true";
include_once 'header.php';


?>

		
		
					
	
		
	


	

	
				
		


		
	
	
	



		
		<main>
	    <div class="heading">
	        <h2>Looan history >> </h2>
	    </div>
		<div>
	
	
            			
            <div class="form">
				<div class="input">							
						
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                   		<a href="loanHistory.php"><i class="fa fa-address-book" aria-hidden="true"></i>Account History</a>
					
                       	<?php
					$loanHistory = mysqli_query($con, "select * from loanAcc  WHERE isClosed = '0' ");
					
					while($row = mysqli_fetch_array($loanHistory)) {
					echo		$row['accNo']."<br>";
								echo		 $row['balance']."<br>";
								echo		$row['cusID']."<br>";
								echo		$row['staffID']."<br>";
							echo			$row['loanAmount']."<br>";
							echo			$row['term']."<br>";
						echo				$row['dateOpened']."<br>";
						echo				$row['repAmount']."<br>";
						echo				$row['drawDownDate']."<br>";
					echo					$row['totalInt']."<br>";
					}
					?>
					
	
		
	
<?php
include_once 'footer.php';
?>
				
	
					