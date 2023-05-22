<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();

        $admin_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['admin_id']))));
	
	  $del = $conn->delete_admin($admin_id);

	   if($del == TRUE){
			      echo '<div class="alert alert-success">Delete Admin Successfully!</div><script> setTimeout(function() {  location.replace("manage_admin.php"); }, 1000); </script>';
			    

			  }else{
			    echo '<div class="alert alert-danger">Delete Admin Failed!</div><script> setTimeout(function() {  location.replace("manage_admin.php"); }, 1000); </script>';

	
		}


	}

?>