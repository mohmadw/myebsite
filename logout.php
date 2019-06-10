<!--
Name: Logout Page
Purpose: Destroy session and redirect to the login page.
Author: GROUP WORK
Date: 27/02/2017
-->

<?php
session_start();
session_destroy();
header('Location: login.php');
?>