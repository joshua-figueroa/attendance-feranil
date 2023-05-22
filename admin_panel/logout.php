
<?php
	session_start();
	session_destroy();
	header('location:../cpanel-login.php');
?>