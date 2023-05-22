<?php

  include "../rfid_class.php";

	if(ISSET($_POST)){
		$conn = new rfid_attendance();


		$member_rfid = htmlspecialchars(strip_tags(stripslashes(trim($_POST['member_rfid']))));
	
	 $add = $conn->add_attendance($member_rfid);

	 date_default_timezone_set("asia/manila");
	 $date = date('Y-m-d');
	 $time =  date('H:i:s');


		if($add === "TRUE"){
			       
			//echo '<div class="alert alert-success">Successfully Time In<script> setTimeout(function() {  location.replace("index.php"); }, 100000); </script></div>';
			echo '<div class="alert alert-success">Successfully Time In: '.$time.' <script> setTimeout(function() {  location.replace("index.php"); }, 100000); </script></div>';
			    

	  }else if($add === "FALSE"){

		    echo '<div class="alert alert-danger">Time Out:   '.$time.'<script> setTimeout(function() {  location.replace("index.php"); }, 100000); </script></div>';
		}
        
        
        if ($add == "INACTIVE"){
            echo '<div class="alert alert-info">Member Inactive!</div><script> setTimeout(function() {  location.replace("index.php"); }, 100000); </script>';
        }
        else if($add == "NOTHING"){

		     '<div class="alert alert-warning">RFID Number Not Found!</div><script> setTimeout(function() {  location.replace("index.php"); }, 100000); </script>';
		}
		// else if ($add == "LOGGED"){
            
        //     echo '<div class="alert alert-warning">Already Logged</div><script> setTimeout(function() {  location.replace("index.php"); }, 100000); </script>';
        // }



	}

	

?>

