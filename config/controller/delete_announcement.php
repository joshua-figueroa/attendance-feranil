<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();

        $announcement_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['announcement_id']))));
	
	  $del = $conn->delete_announcement($announcement_id);

	   if($del == TRUE){
			      echo '<div class="alert alert-success">Delete Announcement Successfully!</div><script> setTimeout(function() {  location.replace("announcement.php"); }, 1000); </script>';
			    

			  }else{
			    echo '<div class="alert alert-danger">Delete Announcement Failed!</div><script> setTimeout(function() {  location.replace("announcement.php"); }, 1000); </script>';

	
		}


	}

?>