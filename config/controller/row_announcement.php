
<?php
  require_once "../rfid_class.php";
  if(isset($_POST['announcement_id'])){ 	
    $conn = new rfid_attendance();
	 $id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['announcement_id']))));
	 $conn->announcement_row($id);
		
	}

?>

