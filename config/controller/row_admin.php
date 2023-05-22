
<?php
  require_once "../rfid_class.php";
  if(isset($_POST['admin_id'])){ 	
    $conn = new rfid_attendance();
	 $id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['admin_id']))));
	 $conn->admin_row($id);
		
	}

?>

