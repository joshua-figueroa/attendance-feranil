<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();

		$member_rfid = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_rfid']))));

        $files = addslashes(file_get_contents($_FILES['member_image']['tmp_name']));
	    $member_image ="../uploads/". addslashes($_FILES['member_image']['name']);
	    $file_size =  $_FILES['member_image']['size'];
	    move_uploaded_file($_FILES["member_image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/smart_attendance/uploads/" .
        addslashes($_FILES["member_image"]["name"]));
       
        $member_fname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_fname']))));
        $member_mname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_mname']))));
        $member_lname = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_lname']))));
        $guardian = htmlspecialchars(strip_tags(stripslashes(trim($_POST['guardian']))));
        $guardian_number = htmlspecialchars(strip_tags(stripslashes(trim($_POST['guardian_number']))));
        $gradelevel_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['gradelevel_id']))));
	
	    $add_student = $conn->add_student($member_rfid,$member_image,$member_fname,$member_mname,$member_lname,$guardian,
                                $guardian_number,$gradelevel_id);
        if($user_used== TRUE){
            echo '<div class="alert alert-success">RFID Already Used!</div><script> setTimeout(function() {  location.replace("manage_student.php"); }, 1000); </script>';
            
        }else if($add_student == TRUE){
            echo '<div class="alert alert-success">Add Student Successfully!</div><script> setTimeout(function() {  location.replace("manage_student.php"); }, 1000); </script>';
            

        }else{
            echo '<div class="alert alert-danger">Add Student Failed!</div><script> setTimeout(function() {  location.replace("manage_student.php"); }, 1000); </script>';


    }


	}

	

?>

