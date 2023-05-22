<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();

		$username = htmlspecialchars(strip_tags(stripslashes(trim($_POST['username']))));
		$password = htmlspecialchars(strip_tags(stripslashes(trim($_POST['password']))));
	
	    $conn->login_admin($username, $password);
	}

?>

