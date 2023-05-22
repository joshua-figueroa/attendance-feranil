<?php
error_reporting(0);
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();
        
        $admin_username = htmlspecialchars(strip_tags(stripslashes(trim($_POST['admin_username']))));
        $admin_password = htmlspecialchars(strip_tags(stripslashes(trim($_POST['admin_password']))));
	
	    $add_staff = $conn->add_admin($admin_username,$admin_password);

        if($add_staff == TRUE){
            echo '<div class="alert alert-success">Add Admin Successfully!</div><script> setTimeout(function() {  location.replace("manage_admin.php"); }, 1000); </script>';
            

        }else{
            echo '<div class="alert alert-danger">Add Admin Failed!</div><script> setTimeout(function() {  location.replace("manage_admin.php"); }, 1000); </script>';


    }


	}

	

?>

