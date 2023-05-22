<?php
error_reporting(0);
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();
        
        $glevel_name = htmlspecialchars(strip_tags(stripslashes(trim($_POST['glevel_name']))));
	
	    $add_staff = $conn->add_gradelevel($glevel_name);

        if($add_staff == TRUE){
            echo '<div class="alert alert-success">Add Grade Level Successfully!</div><script> setTimeout(function() {  location.replace("manage_gradelevel.php"); }, 1000); </script>';
            

        }else{
            echo '<div class="alert alert-danger">Add Grade Level Failed!</div><script> setTimeout(function() {  location.replace("manage_gradelevel.php"); }, 1000); </script>';


    }


	}

	

?>

