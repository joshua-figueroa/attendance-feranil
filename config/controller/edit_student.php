<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();


       

		$member_rfid = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_rfid']))));
        
        $member_fname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_fname']))));
        $member_mname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_mname']))));
        $member_lname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_lname']))));
        $guardian = htmlspecialchars(strip_tags(stripslashes(trim($_POST['guardian']))));
        $guardian_number = htmlspecialchars(strip_tags(stripslashes(trim($_POST['guardian_number']))));
        $gradelevel_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['gradelevel_id']))));
        $member_status = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_status']))));
        $member_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_id']))));
	
	    $edit_student = $conn->edit_student($member_rfid,$member_fname,$member_mname,$member_lname,$guardian,
                                $guardian_number,$gradelevel_id,$member_status,$member_id);

        if($edit_student == TRUE){
            echo '<div class="alert alert-success">Updated Student Successfully!</div><script> setTimeout(function() {  location.replace("manage_student.php"); }, 1000); </script>';
            

        }else{
            echo '<div class="alert alert-danger">updated Student Failed!</div><script> setTimeout(function() {  location.replace("manage_student.php"); }, 1000); </script>';


    }


	}

	

?>

