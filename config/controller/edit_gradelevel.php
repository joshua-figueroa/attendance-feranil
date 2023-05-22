<?php
error_reporting(0);
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();
        
        $glevel_name = htmlspecialchars(strip_tags(stripslashes(trim($_POST['glevel_name']))));
        $gradelevel_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['gradelevel_id']))));

	    $add_glevel = $conn->edit_gradelevel($glevel_name, $gradelevel_id);

        if($add_glevel == TRUE){
            echo '<div class="alert alert-success">Update Grade Level Successfully!</div><script> setTimeout(function() {  location.replace("manage_gradelevel.php"); }, 1000); </script>';
            

        }else{
            echo '<div class="alert alert-danger">Update Grade Level Failed!</div><script> setTimeout(function() {  location.replace("manage_gradelevel.php"); }, 1000); </script>';


    }


	}

	

?>

