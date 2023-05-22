<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();

        $gradelevel_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['gradelevel_id']))));
	
	  $del = $conn->delete_gradelevel($gradelevel_id);

	   if($del == TRUE){
			      echo '<div class="alert alert-success">Delete Grade level Successfully!</div><script> setTimeout(function() {  location.replace("manage_gradelevel.php"); }, 1000); </script>';
			    

			  }else{
			    echo '<div class="alert alert-danger">Delete Grade level Failed!</div><script> setTimeout(function() {  location.replace("manage_gradelevel.php"); }, 1000); </script>';

	
		}


	}

?>