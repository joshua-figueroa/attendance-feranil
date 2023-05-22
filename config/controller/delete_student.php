<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();



		$member_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_id']))));
	
	  $del = $conn->delete_student($member_id);

	   if($del == TRUE){
			      echo '<div class="alert alert-success">Delete Student Successfully!</div><script> setTimeout(function() {  location.replace("manage_student.php"); }, 1000); </script>';
			    

			  }else{
			    echo '<div class="alert alert-danger">Delete Student Failed!</div><script> setTimeout(function() {  location.replace("manage_student.php"); }, 1000); </script>';

	
		}


	}

?>