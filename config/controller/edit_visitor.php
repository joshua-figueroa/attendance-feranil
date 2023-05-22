<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();
		$member_rfid = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_rfid']))));
        $member_fname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_fname']))));
        $member_mname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_mname']))));
        $member_lname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_lname']))));
        $purpose = htmlspecialchars(strip_tags(stripslashes(trim($_POST['purpose']))));
        $visitor_status = htmlspecialchars(strip_tags(stripslashes(trim($_POST['visitor_status']))));
        $member_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_id']))));
	
	    $edit_visitor = $conn->edit_visitor($member_rfid, $member_fname, $member_mname,$member_lname, $purpose, $visitor_status, $member_id);

        if($edit_visitor == TRUE){
            echo '<div class="alert alert-success">Updated Visitor Successfully!</div><script> setTimeout(function() {  location.replace("manage_visitors.php"); }, 1000); </script>';
            
        }else{
            echo '<div class="alert alert-danger">updated Visitor Failed!</div><script> setTimeout(function() {  location.replace("manage_visitors.php"); }, 1000); </script>';


       }

	}

?>

