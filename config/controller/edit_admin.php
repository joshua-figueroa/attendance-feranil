<?php
error_reporting(0);
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();
        
        $admin_username = htmlspecialchars(strip_tags(stripslashes(trim($_POST['admin_username']))));
        $admin_password = htmlspecialchars(strip_tags(stripslashes(trim($_POST['admin_password']))));
        $status = htmlspecialchars(strip_tags(stripslashes(trim($_POST['status']))));
	    $admin_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['admin_id']))));

	    $edit_admin = $conn->edit_admin($admin_username,$admin_password, $status, $admin_id);

        if($edit_admin == TRUE){
            echo '<div class="alert alert-success">Update Admin Successfully!</div><script> setTimeout(function() {  location.replace("manage_admin.php"); }, 1000); </script>';
            

        }else{
            echo '<div class="alert alert-danger">Update Admin Failed!</div><script> setTimeout(function() {  location.replace("manage_admin.php"); }, 1000); </script>';


    }


	}

	

?>

