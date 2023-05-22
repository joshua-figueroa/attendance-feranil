<?php
  include "../rfid_class.php";

  if(ISSET($_POST['export_excel_all'])){
  $conn = new rfid_attendance();
    
     $member_type = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_type']))));
 	 $date1_a = date("Y-m-d", strtotime(htmlspecialchars(strip_tags(stripslashes(trim($_POST['date1_attendance']))))));
	 $date1_b = date("Y-m-d", strtotime(htmlspecialchars(strip_tags(stripslashes(trim($_POST['date2_attendance']))))));

	 $conn->PrintSearchAttendance_excel_all($member_type, $date1_a, $date1_b);
		
	}

?>

