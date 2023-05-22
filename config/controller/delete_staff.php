<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();

		$member_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_id']))));
	
	  $del = $conn->delete_staff($member_id);

	   if($del == TRUE){
			      echo '<div class="alert alert-success">Delete Staff Successfully!</div><script> setTimeout(function() {  location.replace("manage_staff.php"); }, 1000); </script>';
			    

			  }else{
			    echo '<div class="alert alert-danger">Delete Staff Failed!</div><script> setTimeout(function() {  location.replace("manage_staff.php"); }, 1000); </script>';

	
		}


	}

?>