<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();


       

		$member_rfid = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_rfid']))));
        
        $member_fname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_fname']))));
        $member_mname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_mname']))));
        $member_lname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_lname']))));
        $member_status = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_status']))));
        $member_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_id']))));
	
	    $edit_staff = $conn->edit_staff($member_rfid,$member_fname,$member_mname,$member_lname,$member_status,$member_id);

        if($edit_staff == TRUE){
            echo '<div class="alert alert-success">Updated Staff Successfully!</div><script> setTimeout(function() {  location.replace("manage_staff.php"); }, 1000); </script>';
            

        }else{
            echo '<div class="alert alert-danger">updated Staff Failed!</div><script> setTimeout(function() {  location.replace("manage_staff.php"); }, 1000); </script>';


    }


	}

	

?>

