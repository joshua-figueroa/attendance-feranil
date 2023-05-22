
<?php
  require_once "../rfid_class.php";
  if(isset($_POST['member_id'])){ 	
    $conn = new rfid_attendance();
	 $id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_id']))));
	 $conn->student_row($id);
		
	}

?>

