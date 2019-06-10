<!--
Name: Close Personal Account
Purpose: Closing Personal Account.
Author: Jakub Konkel
Date: 02/03/2017
-->
<?php
//FOR TAB TO BE ACTIVE IN MENU
$accclose = "true";
include_once 'header.php';

?>

<main>
	<div class="heading">
		<h2>Close Personal Account</h2>
	</div>				
<?php
    //INFO BOXES
    if(!empty($success)) {
        echo '<div id="success"><i class="fa fa-check-circle" aria-hidden="true"></i><b>Success!</b> ' .$success. '</div>';
    } elseif(!empty($error)) {
        echo '<div id="error"><i class="fa fa-times-circle" aria-hidden="true"></i><b>Error!</b> ' .$error. '</div>';
    }
?> 