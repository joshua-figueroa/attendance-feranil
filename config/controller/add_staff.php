<?php
error_reporting(0);
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
	
	    $add_staff = $conn->add_staff($member_rfid,$member_image,$member_fname,$member_mname,$member_lname);

        if($add_staff == TRUE){
            echo '<div class="alert alert-success">Add Staff Successfully!</div><script> setTimeout(function() {  location.replace("manage_staff.php"); }, 1000); </script>';
            

        }else{
            echo '<div class="alert alert-danger">Add Staff Failed!</div><script> setTimeout(function() {  location.replace("manage_staff.php"); }, 1000); </script>';


    }


	}

	

?>

