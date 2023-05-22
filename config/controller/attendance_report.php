<?php
  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();

        $member_type = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_type']))));
        $date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));

	    $conn->attendance_report($member_type, $date1, $date2);


   }
?>

