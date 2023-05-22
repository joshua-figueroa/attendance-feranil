<?php
  include "../rfid_class.php";

  if(ISSET($_POST['export_attendance'])) {
    $conn = new rfid_attendance();
    
     $memberId = $_POST['memberId'];
     $memberName = $_POST['memberName'];

	 $conn->PrintAttendance($memberId, $memberName);
		
	}

?>

