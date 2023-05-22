
<?php
  require_once "../rfid_class.php";
  if(isset($_POST['gradelevel_id'])){ 	
    $conn = new rfid_attendance();
	 $id = htmlspecialchars(strip_tags(stripslashes(trim($_POST['gradelevel_id']))));
	 $conn->gradelevel_row($id);
		
	}

?>

