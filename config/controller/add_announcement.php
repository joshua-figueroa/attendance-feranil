<?php
error_reporting(0);
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();
        
        $gradelevel_id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['gradelevel_id']))));
        $member_type = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_type']))));
        $announce = htmlspecialchars(strip_tags(stripslashes(trim($_POST['announce']))));
        // $guardian_number = htmlspecialchars(strip_tags(stripslashes(trim($_POST['guardian_number']))));

        $guardian_number = ["+639605895653", "+639605895653"];
        for($i = 0; $i < count($guardian_number); $i++){
           $g_number = $guardian_number[$i];
           $add_announce = $conn->add_announcement($gradelevel_id, $member_type, $announce, $g_number);

        }
        if($add_announce == TRUE){
            echo '<div class="alert alert-success">Add Announcement Successfully!</div><script> setTimeout(function() {  location.replace("announcement.php"); }, 1000); </script>';
            

        }else{
            echo '<div class="alert alert-danger">Add Announcement Failed!</div><script> setTimeout(function() {  location.replace("announcement.php"); }, 1000); </script>';


      }


	}

	

?>

