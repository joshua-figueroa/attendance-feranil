<?php
require __DIR__ .'/vendor/autoload.php';
use Twilio\Rest\Client;

include 'config.php';

 class rfid_attendance
     {
      private $server = DB_HOST;
      private $user   = DB_USER;
      private $pass   = DB_PASS;
      private $db     = DB_NAME;
      private $pdo; 

      public function __construct()
      {
           $this->db_connect();
      }

   public function db_connect()
        {
        	$this->pdo = null;
          try{
              $this->pdo = new PDO("mysql:host=".$this->server.";dbname=".$this->db, $this->user, $this->pass);
             	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              if(!$this->pdo){
              	return false;
              }	
          }catch(PDOException $e){
             echo $e->getMessage();
          }
        }

        public function login_admin($username, $password) {
          session_start();
          //bindparam
          $stmt1 = $this->pdo->prepare("SELECT * FROM tbl_admin WHERE admin_username = :auser AND admin_password= :upass AND `status` = :stat" );
          $stmt1->execute(array(':auser' => $username, ':upass' => $password, ':stat' => 'active'));
          $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
 
           if ($stmt1->rowCount() > 0){
            
               $_SESSION['user_no']   = htmlentities($row1['admin_id']);
               $_SESSION['logged_in'] = true;
 
 
               echo '1';
 
           
           }else{
               //echo '0';
              echo "<div class='alert alert-danger'> <i class='fa fa-times'></i>  Incorrect Username or Password</div>";
           }
       }

       
       public function FetchAttendances($rfid_number) {

        $query = $this->pdo->prepare("SELECT member_rfid FROM tbl_members WHERE member_rfid = '$rfid_number'");
        $query->execute(array());
      return $query->fetchAll();
      
    }

    

        public function FetchAttendance() {

          $query = $this->pdo->prepare("SELECT *, m.member_rfid as RFID, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' 
          ,m.member_mname) as member_name
          FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id ORDER BY a.attendance_id DESC");
          $query->execute(array());
        return $query->fetchAll();
      }

      public function FetchAttendance_index() {

       

        $query = $this->pdo->prepare("SELECT *, m.member_rfid as RFID, a.time_out as time_out, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
        FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id WHERE DATE(a.logdate) = CURDATE() ORDER BY  a.time_out DESC");
        $query->execute(array());
        return $query->fetchAll();
    }


      public function FetchAllstudents() {
        $query = $this->pdo->prepare("SELECT * FROM tbl_members m
                                      LEFT JOIN tbl_gradelevel gl ON gl.gradelevel_id = m.gradelevel_id
                                      ORDER BY m.gradelevel_id DESC
                                      ");
        $query->execute(array());
      return $query->fetchAll();
    }

          public function FetchRecord($id) {

        // $query = $this->pdo->prepare("SELECT *, m.member_id as IDS, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
        //                               FROM  tbl_members m LEFT JOIN tbl_attendance a ON a.member_id = m.member_id
        //                               LEFT JOIN  tbl_gradelevel gl ON gl.gradelevel_id = m.gradelevel_id 
        //                               where m.member_type = 'student' ORDER BY a.attendance_id DESC");
            $query = $this->pdo->prepare("SELECT * FROM tbl_attendance WHERE member_id=? ORDER BY logdate DESC");
            $query->execute(array($id));
          return $query->fetchAll();
          }

      public function FetchMember($memberId) {

        $query = $this->pdo->prepare("SELECT * FROM tbl_members m
                                      LEFT JOIN tbl_gradelevel gl ON gl.gradelevel_id = m.gradelevel_id
                                      WHERE member_id = ?");
        $query->execute([$memberId]);
      return $query->fetch();
      }

    public function FetchAllstaff() {

      $query = $this->pdo->prepare("SELECT *, m.member_id as IDS, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
      FROM tbl_members m LEFT JOIN tbl_attendance a ON a.member_id = m.member_id where m.member_type = 'staff' ORDER BY a.attendance_id DESC");
      $query->execute(array());
    return $query->fetchAll();
  }

    public function FetchAllvisitors() {

      $query = $this->pdo->prepare("SELECT *, m.member_id as IDS, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
      FROM tbl_members m LEFT JOIN tbl_attendance a ON a.member_id = m.member_id where m.member_type = 'visitor' ORDER BY a.attendance_id DESC");
      $query->execute(array());
    return $query->fetchAll();
  }


      public function fetch_adminsession($GetAdminSession){
        $query = $this->pdo->prepare("SELECT * FROM  tbl_admin WHERE  admin_id = ? ORDER BY admin_id  DESC");
         $query->execute(array($GetAdminSession));
         return $query->fetchAll();
     }

     public function count_student(){
      $query = $this->pdo->prepare("SELECT COUNT(member_id) as member_id FROM  tbl_members where member_type = 'student'");
              $query->execute(array());
              return $query->fetchAll();
      }
      public function count_staff(){
        $query = $this->pdo->prepare("SELECT COUNT(member_id) as member_id FROM  tbl_members where member_type = 'staff'");
                $query->execute(array());
                return $query->fetchAll();
        }
      
    public function count_visitor(){
      $query = $this->pdo->prepare("SELECT COUNT(member_id) as member_id FROM  tbl_members where member_type = 'visitor'");
              $query->execute(array());
              return $query->fetchAll();
      }
        
    public function count_all(){
      $query = $this->pdo->prepare("SELECT COUNT(member_id) as member_id FROM  tbl_attendance ");
              $query->execute(array());
              return $query->fetchAll();
      }
        
      public function add_student($member_rfid,$member_image,$member_fname,$member_mname,$member_lname,$guardian,
      $guardian_number,$gradelevel_id){
  
        $stats = "active";
        $type = "student";
        $stmt = $this->pdo->prepare("INSERT INTO  `tbl_members` (`member_rfid`,`member_image`
        ,`member_fname`,`member_mname`,`member_lname`,`guardian` ,`guardian_number`,`gradelevel_id`,`member_type`,`member_status`) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $true = $stmt->execute([$member_rfid,$member_image,$member_fname,$member_mname,$member_lname,$guardian,
        $guardian_number ,$gradelevel_id ,$type ,$stats]);
        if ($true == true) {
            return true;
          } else {
            return false;
        }
      }

      public function add_staff($member_rfid,$member_image,$member_fname,$member_mname,$member_lname){
  
        $stats = "active";
        $type = "staff";
        $stmt = $this->pdo->prepare("INSERT INTO  `tbl_members` (`member_rfid`,`member_image`
        ,`member_fname`,`member_mname`,`member_lname`,`member_type`,`member_status`) VALUES(?,?,?,?,?,?,?)");
        $true = $stmt->execute([$member_rfid,$member_image,$member_fname,$member_mname,$member_lname,$type ,$stats]);
        if ($true == true) {
            return true;
          } else {
            return false;
        }
      }

    

    public function student_row($id) {

        $stmt = $this->pdo->prepare("SELECT * FROM `tbl_members` m 
                                      LEFT JOIN tbl_gradelevel gl ON m.gradelevel_id = gl.gradelevel_id 
                                       WHERE m.member_id  = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        echo json_encode($row);
      } 

      public function edit_student($member_rfid,$member_fname,$member_mname,$member_lname,$guardian,
      $guardian_number,$gradelevel_id,$member_status,$member_id) {

        $sql = "UPDATE `tbl_members` SET  `member_rfid` = ?, `member_fname` = ?, `member_mname` = ?,
        `member_lname` = ?, `guardian` = ?, `guardian_number` = ?, `gradelevel_id` = ?, `member_status` = ? WHERE member_id = ?";
        $update = $this->pdo->prepare($sql)->execute([$member_rfid,$member_fname,$member_mname,$member_lname,$guardian,
        $guardian_number,$gradelevel_id,$member_status,$member_id]);
          if ($update == true) {
              return true;
           } else {
              return false;
         }

     }
     
     public function edit_staff($member_rfid,$member_fname,$member_mname,$member_lname,$member_status,$member_id) {

        $sql = "UPDATE `tbl_members` SET  `member_rfid` = ?, `member_fname` = ?, `member_mname` = ?,
        `member_lname` = ?, `member_status` = ? WHERE member_id = ?";
        $update = $this->pdo->prepare($sql)->execute([$member_rfid,$member_fname,$member_mname,$member_lname,$member_status,$member_id]);
          if ($update == true) {
              return true;
           } else {
              return false;
         }

     }

     public function delete_student($member_id){

      $sql = "DELETE FROM `tbl_members` WHERE member_id = ?";
      $delete = $this->pdo->prepare($sql)->execute([$member_id]);
        if ($delete == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_staff($member_id){

      $sql = "DELETE FROM `tbl_members` WHERE member_id = ?";
      $delete = $this->pdo->prepare($sql)->execute([$member_id]);
        if ($delete == true) {
            return true;
        } else {
            return false;
        }
    }


    public function attendance_row($id) {

      $stmt = $this->pdo->prepare("SELECT *, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name FROM tbl_members m
                                 LEFT JOIN tbl_attendance a ON a.member_id = m.member_id  WHERE m.member_rfid  = ?");
      $stmt->execute([$id]);
      $row = $stmt->fetch();
      echo json_encode($row);
    } 

    public function add_attendance($member_rfid){

        date_default_timezone_set("asia/manila");
           $date = date('Y-m-d');
           $time =  date('H:i:s');
           $datetime =  date('Y-m-d H:i');
           $stat = 0;
           $stat2 = 1;

           $stmt1 = $this->pdo->prepare("SELECT * FROM tbl_members WHERE member_rfid = ? AND member_status = 'active'");
           $stmt1->execute([$member_rfid]);
           $row_count = $stmt1->rowCount();
           $result = $stmt1->fetchAll();

           foreach ($result as $value2) {
            $member_fname = htmlentities($value2['member_fname']);
            $member_mname = htmlentities($value2['member_mname']);
            $member_lname = htmlentities($value2['member_lname']);
            $full_name =  $member_fname . ' '.$member_mname .' '. $member_lname;
           }

           $stmt2 = $this->pdo->prepare("SELECT * FROM tbl_members WHERE member_rfid = ? AND member_status = 'inactive'");
           $stmt2->execute([$member_rfid]);
           $row_count2 = $stmt2->rowCount();
           $result1 = $stmt2->fetchAll();

           $stmt3 = $this->pdo->prepare("SELECT * FROM tbl_attendance WHERE member_rfid = ? AND `status` = '1' AND logdate = CURDATE()");
           $stmt3->execute([$member_rfid]);
           $row_count3 = $stmt3->rowCount();
           $result2 = $stmt3->fetchAll();
      
           foreach ($result as $value) {
    
            $memID = htmlentities($value['member_id']);
            $memstatus = htmlentities($value['member_status']);
           }

         if($row_count3 == 1){ 

            return "LOGGED";

         }else if($row_count2 == 1){ 

             return "INACTIVE";

         }else if($row_count <= 0){

             return "NOTHING";

          }else {
                $stmt2 = $this->pdo->prepare("SELECT * FROM tbl_attendance WHERE member_rfid = ? AND logdate = ? AND status = '0' ORDER BY attendance_id DESC");
                  $stmt2->execute([$member_rfid, $date]);
                  $row_count2 = $stmt2->rowCount();
                  $result2 = $stmt2->fetchAll();
                  
                foreach ($result2 as $value) {
                  $attendance_id = htmlentities($value['attendance_id']);
                }
                if($row_count2 > 0){

                  
                  $sid = "ACf824289f5acbdaa933232da7537e0dbd";
                  $token  = "b52a7963bcd1504034153dae227199bd";
                  $twilio = new Client($sid, $token);

                  $message = $twilio->messages->create(
                            "+639605895653", // to
                                [
                                 "from" => "+15075163037", 
                                 "body" => 'Time Out: '. $full_name .' '. $datetime
                                ]
                    );

                
                  $sql = "UPDATE tbl_attendance SET time_out = ?, status = '1', member_rfid = ? WHERE  attendance_id = ?";
                  $stmt = $this->pdo->prepare($sql);
                  $stmt->execute([$time, $member_rfid, $attendance_id]);

                    return "FALSE";

                }else{
                    
                    if($memstatus == 'active'){

                          $sid = "ACf824289f5acbdaa933232da7537e0dbd";
                          $token  = "b52a7963bcd1504034153dae227199bd";
                          $twilio = new Client($sid, $token);

                          $message = $twilio->messages->create(
                                    "+639605895653", // to
                                        [
                                         "from" => "+15075163037", 
                                         "body" =>'Time In: '. $full_name .' '. $datetime
                                        ]
                            );
                            


                      $stmt = $this->pdo->prepare("INSERT INTO tbl_attendance(member_rfid,time_in,logdate, status, member_id) VALUES (?, ?, ?, ?, ?)");
                        $result = $stmt->execute([$member_rfid, $time, $date, $stat, $memID]);
                        
                        return "TRUE";
                          
                    }
              


                }

           }
    
    }


    public function add_visitor($member_image,$member_fname,$member_mname,$member_lname, $purpose){
      date_default_timezone_set("asia/manila");
      $date = date('Y-m-d');
      $time =  date('H:i:s');
      $stat_timein = 0;
      $stat_timeout = 1;

      $type = "visitor";
      $stat = "Pending";
      $member_rfid = 0;

      $stmt = $this->pdo->prepare("INSERT INTO  `tbl_members` (`member_image`,`member_fname`,`member_mname`,`member_lname`, `purpose`,`member_type`, `visitor_status`) VALUES(?,?,?,?,?,?,?)");
      $true = $stmt->execute([$member_image,$member_fname,$member_mname,$member_lname, $purpose, $type, $stat]);
      // $last_id = $this->pdo->lastInsertId();//kinuha natin ang huling ID na insert nong visitor para sa foreign key.

      // $stmt2 = $this->pdo->prepare("INSERT INTO  `tbl_attendance` (member_rfid, time_in, logdate, status, member_id) VALUES(?, ?, ?, ?, ?)");
      // $true2 = $stmt2->execute([$member_rfid, $time, $date, $stat_timein, $last_id]);

      if ($true == true) {
          return true;
        } else {
          return false;
      }
    }


    public function edit_visitor($member_rfid, $member_fname, $member_mname, $member_lname, $purpose, $visitor_status, $member_id) {

        $sql = "UPDATE `tbl_members` SET  `member_rfid` = ?, `member_fname` = ?, `member_mname` = ?,
        `member_lname` = ?, `purpose` = ?, `visitor_status` = ? WHERE member_id = ?";
        $update = $this->pdo->prepare($sql)->execute([$member_rfid, $member_fname, $member_mname, $member_lname, $purpose, $visitor_status, $member_id]);
          if ($update == true) {
              return true;
          } else {
              return false;
        }

    }

    public function visitor_row($id) {

      $stmt = $this->pdo->prepare("SELECT * FROM `tbl_members` WHERE member_id  = ?");
      $stmt->execute([$id]);
      $row = $stmt->fetch();
      echo json_encode($row);
    } 

      public function delete_visitor($member_id){

        $sql = "DELETE FROM `tbl_members` WHERE member_id = ?";
        $delete = $this->pdo->prepare($sql)->execute([$member_id]);
          if ($delete == true) {
              return true;
          } else {
              return false;
          }
      }


      public function add_admin($admin_username,$admin_password){
        $stat = "active";
        $stmt = $this->pdo->prepare("INSERT INTO  `tbl_admin` (`admin_username`,`admin_password`,`status`) VALUES(?,?,?)");
        $true = $stmt->execute([$admin_username,$admin_password, $stat]);
        if ($true == true) {
            return true;
          } else {
            return false;
        }
      }


      public function FetchAllAdmin() {

        $query = $this->pdo->prepare("SELECT * FROM tbl_admin ORDER BY admin_id DESC");
        $query->execute(array());
      return $query->fetchAll();
    }


    public function admin_row($id) {

      $stmt = $this->pdo->prepare("SELECT * FROM `tbl_admin` WHERE admin_id = ?");
      $stmt->execute([$id]);
      $row = $stmt->fetch();
      echo json_encode($row);
    } 

    public function edit_admin($admin_username,$admin_password, $status, $admin_id) {

      $sql = "UPDATE `tbl_admin` SET  `admin_username` = ?, `admin_password` = ?, `status` = ? WHERE admin_id = ?";
      $update = $this->pdo->prepare($sql)->execute([$admin_username,$admin_password, $status, $admin_id]);
        if ($update == true) {
            return true;
        } else {
            return false;
      }

  }

  public function delete_admin($admin_id){

    $sql = "DELETE FROM `tbl_admin` WHERE admin_id = ?";
    $delete = $this->pdo->prepare($sql)->execute([$admin_id]);
      if ($delete == true) {
          return true;
      } else {
          return false;
      }
  }

  public function FetchGradelevel() {

      $query = $this->pdo->prepare("SELECT * FROM tbl_gradelevel ORDER BY gradelevel_id DESC");
      $query->execute(array());
    return $query->fetchAll();
  }

  public function FetchGradelevelStudents() {

    $query = $this->pdo->prepare("SELECT * FROM tbl_gradelevel ORDER BY gradelevel_id ASC");
    $query->execute(array());
  return $query->fetchAll();
}

  public function add_gradelevel($glevel_name){
    $stmt = $this->pdo->prepare("INSERT INTO  `tbl_gradelevel` (`glevel_name`) VALUES(?)");
    $true = $stmt->execute([$glevel_name]);
    if ($true == true) {
        return true;
      } else {
        return false;
    }
  }


  public function gradelevel_row($id) {

    $stmt = $this->pdo->prepare("SELECT * FROM `tbl_gradelevel` WHERE gradelevel_id  = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    echo json_encode($row);
  } 


  public function edit_gradelevel($glevel_name, $gradelevel_id) {

    $sql = "UPDATE `tbl_gradelevel` SET  `glevel_name` = ? WHERE gradelevel_id = ?";
    $update = $this->pdo->prepare($sql)->execute([$glevel_name, $gradelevel_id]);
      if ($update == true) {
          return true;
      } else {
          return false;
    }

}

public function delete_gradelevel($gradelevel_id){

  $sql = "DELETE FROM `tbl_gradelevel` WHERE gradelevel_id = ?";
  $delete = $this->pdo->prepare($sql)->execute([$gradelevel_id]);
    if ($delete == true) {
        return true;
    } else {
        return false;
    }
}



public function add_announcement($gradelevel_id, $member_type, $announce, $g_number){
  date_default_timezone_set("asia/manila");
  $datetime =  date('Y-m-d H:i');
  
  $sid = "ACf824289f5acbdaa933232da7537e0dbd";
  $token  = "b52a7963bcd1504034153dae227199bd";
  $twilio = new Client($sid, $token);
  $br = "<br>";
  $message = $twilio->messages->create(
               $g_number, // to
                [
                 "from" => "+15075163037", 
                 "body" => $announce .' '.$br .' '. $datetime
                ]
    );
    

  $stmt = $this->pdo->prepare("INSERT INTO  `tbl_announcement` (`gradelevel_id`,`member_type`,`announce`) VALUES(?,?,?)");
  $true = $stmt->execute([$gradelevel_id, $member_type, $announce]);
  if ($true == true) {
      return true;
    } else {
      return false;
  }
}

public function announcement_row($id) {

  $stmt = $this->pdo->prepare("SELECT * FROM `tbl_announcement` WHERE announcement_id  = ?");
  $stmt->execute([$id]);
  $row = $stmt->fetch();
  echo json_encode($row);
} 

public function delete_announcement($announcement_id){

  $sql = "DELETE FROM `tbl_announcement` WHERE announcement_id = ?";
  $delete = $this->pdo->prepare($sql)->execute([$announcement_id]);
    if ($delete == true) {
        return true;
    } else {
        return false;
    }
}



public function FetchAnnouncements() {

  $query = $this->pdo->prepare("SELECT * FROM tbl_announcement  ORDER BY announcement_id DESC");
  $query->execute(array());
return $query->fetchAll();
}



public function FetchallMembers() {

  $query = $this->pdo->prepare("SELECT * FROM tbl_members ORDER BY member_id DESC");
  $query->execute(array());
return $query->fetchAll();
}

public function RfidUsed() {

  $query = $this->pdo->prepare("SELECT * FROM tbl_members where member_rfid = 1");
  $query->execute(array());
return $query->fetchAll();
}

public function FetchMemberType() {

  $query = $this->pdo->prepare("SELECT DISTINCT member_type as member_type, member_id FROM  tbl_members GROUP BY member_type ORDER BY member_id ASC");
  $query->execute(array());
return $query->fetchAll();
}


     public function attendance_report($member_type, $date1, $date2){
       if($member_type == 'student'){

            echo '<table class="table .table-hover" id="">
                <thead>
                <tr>

                    <th>Full name</th>
                    <th>RFID Number</th>
                    <th>Guardian </th>
                    <th>Guardian Number</th>
                    <th>Grade Level</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Logged Date</th>
                    <th>Status</th>
              
                </tr>
              </thead>
                
              ';
                $stmt = $this->pdo->prepare("SELECT *, m.member_rfid as RFID, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
                                            FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id
                                            LEFT JOIN tbl_gradelevel gl ON gl.gradelevel_id = m.gradelevel_id 
                                            WHERE m.member_type = ? AND a.logdate BETWEEN ? AND ? ORDER BY a.attendance_id ASC");
                  $stmt->execute(array($member_type, $date1, $date2));
                  $data = $stmt->fetchAll();
                  if($stmt->rowCount() > 0){
                foreach ($data as $row) {
                ?>

              <tr>

                    <td><?= htmlentities($row['member_name']); ?></td>
                    <td><?= htmlentities(ucwords($row['member_rfid'])); ?></td>
                    <td><?= htmlentities(ucwords($row['guardian'])); ?></td>
                    <td><?= htmlentities(ucwords($row['guardian_number'])); ?></td>
                    <td><?= htmlentities(ucwords($row['glevel_name'])); ?></td>
                    <td><?= date("g:i a", strtotime(htmlentities($row['time_in']))); ?></td>
                    <td>
                      <?php if (empty(htmlentities($row['time_out']))) {
                        echo "";
                      }else{
                          echo date("g:i a", strtotime(htmlentities($row['time_out'])));
                      }

                      ?></td>
 
                    <td><?= htmlentities(date("M d, Y",strtotime($row['logdate']))); ?></td>
                          <td>
                              <?php
                                  if (htmlentities($row['member_status']) =='active'){
                                      echo '<strong>Active</strong>';
                                  }else{
                                      echo '<strong>Inactive</strong>';
                                  }
                              ?>
                          </td>



                </tr>

                <?php
                }
                echo '<td colspan="7">       
                        <form method="POST" action="/Smart_attendance/config/controller/print_reportexcel_students.php">
                          <input type="hidden" name="member_type" value='.$member_type.'>
                          <input type="hidden" name="date1_attendance" value='.$date1.'>
                          <input type="hidden" name="date2_attendance" value='.$date2.'>
                          <button class="btn btn-success pull-right" name="export_excel_student"><span class="glyphicon glyphicon-print"></span><i class="fa fa-file-excel"></i> export Excel</button>
                        </form>
                    </td>
                  </tr>';

              }else{

              echo '
              <tr>
                <td colspan = "6"><center>Record Not Found</center></td>
              </tr>
              ';
              }
        }else if($member_type == 'staff'){


            echo '<table class="table .table-hover" id="">
              <thead>
              <tr>

                <th>Full name</th>
                <th>RFID Number</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Logged Date</th>
                <th>Status</th>
            
              </tr>
            </thead>
              
            ';
              $stmt = $this->pdo->prepare("SELECT *, m.member_rfid as RFID, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
                                          FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id
                                          WHERE m.member_type = ? AND a.logdate BETWEEN ? AND ? ORDER BY a.attendance_id ASC");
                $stmt->execute(array($member_type, $date1, $date2));
                $data = $stmt->fetchAll();
                if($stmt->rowCount() > 0){
              foreach ($data as $row) {
              ?>

            <tr>

              <td><?= htmlentities($row['member_name']); ?></td>
              <td><?= htmlentities(ucwords($row['member_rfid'])); ?></td>
              <td><?= date("g:i a", strtotime(htmlentities($row['time_in']))); ?></td>
                    <td>
                      <?php if (empty(htmlentities($row['time_out']))) {
                        echo "";
                      }else{
                          echo date("g:i a", strtotime(htmlentities($row['time_out'])));
                      }

                      ?></td>
 
                    <td><?= htmlentities(date("M d, Y",strtotime($row['logdate']))); ?></td>
          
              <td>
                  <?php
                      if (htmlentities($row['member_status']) =='active'){
                          echo '<strong>Active</strong>';
                      }else{
                          echo '<strong>Inactive</strong>';
                      }
                  ?>
              </td>


              </tr>

              <?php
              }
              echo '<td colspan="4">       
                   <form method="POST" action="/Smart_attendance/config/controller/print_reportexcel_staff.php">
                      <input type="hidden" name="member_type" value='.$member_type.'>
                      <input type="hidden" name="date1_attendance" value='.$date1.'>
                      <input type="hidden" name="date2_attendance" value='.$date2.'>
                      <button class="btn btn-success pull-right" name="export_excel_Staff"><span class="glyphicon glyphicon-print"></span><i class="fa fa-file-excel"></i> export Excel</button>
                     </form>
                    </td>
                </tr>';

            }else{

            echo '
            <tr>
              <td colspan = "4"><center>Record Not Found</center></td>
            </tr>
            ';
            }

        }else if($member_type == 'visitor'){

             echo '<table class="table .table-hover" id="">
              <thead>
              <tr>
              
                <th>Full name</th>
                <th>RFID Number</th>
                <th>Purpose</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Logged Date</th>
                <th>Status</th>
            
              </tr>
            </thead>
              
            ';
              $stmt = $this->pdo->prepare("SELECT *, m.member_rfid as RFID, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
                                          FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id
                                          WHERE m.member_type = ? AND a.logdate BETWEEN ? AND ? ORDER BY a.attendance_id ASC");
                $stmt->execute(array($member_type, $date1, $date2));
                $data = $stmt->fetchAll();
                if($stmt->rowCount() > 0){
              foreach ($data as $row) {
              ?>

            <tr>

                  <td><?= htmlentities($row['member_name']); ?></td>
                  <td><?= htmlentities(ucwords($row['member_rfid'])); ?></td>
                  <td><?= htmlentities(ucwords($row['purpose'])); ?></td>
                  <td><?= date("g:i a", strtotime(htmlentities($row['time_in']))); ?></td>
                    <td>
                      <?php if (empty(htmlentities($row['time_out']))) {
                        echo "";
                      }else{
                          echo date("g:i a", strtotime(htmlentities($row['time_out'])));
                      }

                      ?></td>
 
                    <td><?= htmlentities(date("M d, Y",strtotime($row['logdate']))); ?></td>
              
                  <td>
                      <?php
                          if (htmlentities($row['visitor_status']) =='Approved'){
                              echo '<strong>Approved</strong>';
                          }else{
                              echo '<strong>Pending</strong>';
                          }
                      ?>
                  </td>

              </tr>

              <?php
              }
              echo '<td colspan="6">       
                      <form method="POST" action="/Smart_attendance/config/controller/print_reportexcel_visitor.php">
                        <input type="hidden" name="member_type" value='.$member_type.'>
                        <input type="hidden" name="date1_attendance" value='.$date1.'>
                        <input type="hidden" name="date2_attendance" value='.$date2.'>
                        <button class="btn btn-success pull-right" name="export_excel_visitor"><span class="glyphicon glyphicon-print"></span><i class="fa fa-file-excel"></i> export Excel</button>
                       </form>
                      </td>
                </tr>';

            }else{

            echo '
            <tr>
              <td colspan = "5"><center>Record Not Found</center></td>
            </tr>
            ';
            }


        }else if($member_type == 'all'){
            
                echo '<table class="table .table-hover" id="">
                <thead>
                <tr>

                    <th>Full name</th>
                    <th>RFID Number</th>
                    <th>Guardian </th>
                    <th>Guardian Number</th>
                    <th>Grade Level</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Logged Date</th>
                    <th>Status</th>
              
                </tr>
              </thead>
                
              ';
                $stmt = $this->pdo->prepare("SELECT *, m.member_rfid as RFID, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
                                            FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id
                                            LEFT JOIN tbl_gradelevel gl ON gl.gradelevel_id = m.gradelevel_id 
                                            WHERE m.member_type IN ('student', 'staff', 'visitor')");
                  $stmt->execute(array());
                  $data = $stmt->fetchAll();
                  if($stmt->rowCount() > 0){
                foreach ($data as $row) {
                ?>

              <tr>

                    <td><?= htmlentities($row['member_name']); ?></td>
                    <td><?= htmlentities(ucwords($row['member_rfid'])); ?></td>
                    <td><?= htmlentities(ucwords($row['guardian'])); ?></td>
                    <td><?= htmlentities(ucwords($row['guardian_number'])); ?></td>
                    <td><?= htmlentities(ucwords($row['glevel_name'])); ?></td>
                    <td><?= date("g:i a", strtotime(htmlentities($row['time_in']))); ?></td>
                    <td>
                      <?php if (empty(htmlentities($row['time_out']))) {
                        echo "";
                      }else{
                          echo date("g:i a", strtotime(htmlentities($row['time_out'])));
                      }

                      ?></td>

                    <td><?= htmlentities(date("M d, Y",strtotime($row['logdate']))); ?></td>
                          <td>
                              <?php
                                  if (htmlentities($row['member_status']) =='active'){
                                      echo '<strong>Active</strong>';
                                  }else{
                                      echo '<strong>Inactive</strong>';
                                  }
                              ?>
                          </td>



                </tr>

                <?php
                }
                echo '<td colspan="7">       
                        <form method="POST" action="/Smart_attendance/config/controller/print_reportexcel_all.php">
                          <input type="hidden" name="member_type" value='.$member_type.'>
                          <input type="hidden" name="date1_attendance" value='.$date1.'>
                          <input type="hidden" name="date2_attendance" value='.$date2.'>
                          <button class="btn btn-success pull-right" name="export_excel_all"><span class="glyphicon glyphicon-print"></span><i class="fa fa-file-excel"></i> export Excel</button>
                        </form>
                    </td>
                  </tr>';

              }else{

              echo '
              <tr>
                <td colspan = "6"><center>Record Not Found</center></td>
              </tr>
              ';
              }

        }
     }

     public function PrintAttendance($memberId, $memberName) {
        $timestamp = time();
        $filename = $memberName.' - Attendance Report - ' . $timestamp . '.xls';
          header("Content-Type: application/xls");    
          header("Content-Disposition: attachment; filename=\"$filename\""); 
          header("Pragma: no-cache"); 
          header("Expires: 0");

            $query = $this->pdo->prepare("SELECT * FROM tbl_attendance WHERE member_id=?");
          $query->execute(array($memberId));
          $records = $query->fetchAll();

          $output ="
            <table>
              <thead>
               <tr>
                <th>Attendace ID</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Log Date</th>
               </tr>
              </thead>
              <tbody id='load_data5'>
          ";

          foreach($records as $row) {
            $output .="
                <tr>
                    <td>".$row['attendance_id']."</td>
                    <td>".$row['time_in']."</td>
                    <td>".$row['time_out']."</td>
                    <td>".htmlentities(date("M d, Y",strtotime($row['logdate'])))."</td>
                </tr>
            ";
          }

          $output .="
              </tbody>
              
            </table>
          ";
          
          echo $output;
     }

     
     
    public function PrintSearchAttendance_excel_students($member_type, $date1_a, $date1_b){
          $timestamp = time();
          $filename = 'Attendance_report_students' . $timestamp . '.xls';
          header("Content-Type: application/xls");    
          header("Content-Disposition: attachment; filename=\"$filename\"");  //ito ang nag piprint ng excel
          header("Pragma: no-cache"); 
          header("Expires: 0");

          $output = "";
        
      if(ISSET($member_type, $date1_a, $date1_b) ){
          $output .="
            <table>
              <thead>
               <tr>
                <th>Full name</th>
                <th>RFID Number</th>
                <th>Guardian </th>
                <th>Guardian Number</th>
                <th>Grade Level</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Logged Date</th>
                <th>Status</th>
               </tr>
              <tbody id='load_data5'>

          ";

          $stmt =  $this->pdo->prepare("SELECT *, m.member_rfid as RFID, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
                                        FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id
                                        LEFT JOIN tbl_gradelevel gl ON gl.gradelevel_id = m.gradelevel_id 
                                        WHERE m.member_type = ? AND a.logdate BETWEEN ? AND ? ORDER BY a.attendance_id ASC");
          $stmt->execute([$member_type, $date1_a, $date1_b]); 

            while($fetch2 = $stmt->fetch(PDO::FETCH_ASSOC)){
                     $time_out = "";
                if (empty(htmlentities($fetch2['time_out']))) {
                      $time_out = "";
                  }else{
                      $time_out = date("g:i a", strtotime(htmlentities($fetch2['time_out'])));
                  }
                  if (htmlentities($fetch2['member_status']) =='active'){
                       $stat = 'Active';
                    }else{
                       $stat = 'Inactive';
                    }

             $output .= "
                <tr>

                    <td>". htmlentities($fetch2['member_name'])."</td>
                    <td>". htmlentities($fetch2['member_rfid'])."</td>
                    <td>". htmlentities($fetch2['guardian'])."</td>
                    <td>". htmlentities(ucwords($fetch2['guardian_number']))."</td>
                    <td>". htmlentities(ucwords($fetch2['glevel_name']))."</td>
                    <td>". date("g:i a", strtotime(htmlentities($fetch2['time_in'])))."</td>
                    <td>". $time_out."</td>
                    <td>". htmlentities(date("M d, Y",strtotime($fetch2['logdate'])))."</td>
                    <td>". htmlentities($stat)."</td>
                </tr>
                    ";
          }
          
          $output .="
              </tbody>
              
            </table>
          ";
          
          echo $output;
        }
      
    }


    public function PrintSearchAttendance_excel_staffs($member_type, $date1_a, $date1_b){
          $timestamp = time();
          $filename = 'Attendance_report_staff' . $timestamp . '.xls';
          header("Content-Type: application/xls");    
          header("Content-Disposition: attachment; filename=\"$filename\"");  //ito ang nag piprint ng excel
          header("Pragma: no-cache"); 
          header("Expires: 0");

          $output = "";
        
      if(ISSET($member_type, $date1_a, $date1_b) ){
          $output .="
            <table>
              <thead>
              <tr>
                <th>Full name</th>
                <th>RFID Number</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Logged Date</th>
                <th>Status</th>
              </tr>
              <tbody id='load_data5'>
          ";

          $stmt =  $this->pdo->prepare("SELECT *, m.member_rfid as RFID, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
                                        FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id
                                        WHERE m.member_type = ? AND a.logdate BETWEEN ? AND ? ORDER BY a.attendance_id ASC");
          $stmt->execute([$member_type, $date1_a, $date1_b]); 

            while($fetch2 = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $time_out = "";
                if (empty(htmlentities($fetch2['time_out']))) {
                      $time_out = "";
                  }else{
                      $time_out = date("g:i a", strtotime(htmlentities($fetch2['time_out'])));
                  }
                  if (htmlentities($fetch2['member_status']) =='active'){
                      $stat = 'Active';
                    }else{
                      $stat = 'Inactive';
                    }

            $output .= "
                <tr>

                    <td>". htmlentities($fetch2['member_name'])."</td>
                    <td>". htmlentities($fetch2['member_rfid'])."</td>
                    <td>". date("g:i a", strtotime(htmlentities($fetch2['time_in'])))."</td>
                    <td>". $time_out."</td>
                    <td>". htmlentities(date("M d, Y",strtotime($fetch2['logdate'])))."</td>
                    <td>". htmlentities($stat)."</td>
                </tr>
                    ";
          }
          
          $output .="
              </tbody>
              
            </table>
          ";
          
          echo $output;
        }
      
    }


     public function PrintSearchAttendance_excel_visitors($member_type, $date1_a, $date1_b){
            $timestamp = time();
            $filename = 'Attendance_report_visitors' . $timestamp . '.xls';
            header("Content-Type: application/xls");    
            header("Content-Disposition: attachment; filename=\"$filename\"");  //ito ang nag piprint ng excel
            header("Pragma: no-cache"); 
            header("Expires: 0");

            $output = "";
          
        if(ISSET($member_type, $date1_a, $date1_b) ){
            $output .="
              <table>
                <thead>
                <tr>
                  <th>Full name</th>
                  <th>RFID Number</th>
                  <th>Purpose</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>Logged Date</th>
                  <th>Status</th>
                </tr>
                <tbody id='load_data5'>
            ";

            $stmt =  $this->pdo->prepare("SELECT *, m.member_rfid as RFID, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
                                          FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id
                                          WHERE m.member_type = ? AND a.logdate BETWEEN ? AND ? ORDER BY a.attendance_id ASC");
            $stmt->execute([$member_type, $date1_a, $date1_b]); 

              while($fetch2 = $stmt->fetch(PDO::FETCH_ASSOC)){
                      $time_out = "";
                  if (empty(htmlentities($fetch2['time_out']))) {
                        $time_out = "";
                    }else{
                        $time_out = date("g:i a", strtotime(htmlentities($fetch2['time_out'])));
                    }
                    if (htmlentities($fetch2['member_status']) =='Approved'){
                        $stat = 'Approved';
                      }else{
                        $stat = 'Pending';
                      }

              $output .= "
                  <tr>

                      <td>". htmlentities($fetch2['member_name'])."</td>
                      <td>". htmlentities($fetch2['member_rfid'])."</td>
                      <td>". htmlentities($fetch2['purpose'])."</td>
                      <td>". date("g:i a", strtotime(htmlentities($fetch2['time_in'])))."</td>
                      <td>". $time_out."</td>
                      <td>". htmlentities(date("M d, Y",strtotime($fetch2['logdate'])))."</td>
                      <td>". htmlentities($stat)."</td>
                  </tr>
                      ";
            }
            
            $output .="
                </tbody>
                
              </table>
            ";
            
            echo $output;
          }
        
      }

      //

      public function PrintSearchAttendance_excel_all($member_type, $date1_a, $date1_b){
            $timestamp = time();
            $filename = 'Attendance_report_all' . $timestamp . '.xls';
            header("Content-Type: application/xls");    
            header("Content-Disposition: attachment; filename=\"$filename\"");  //ito ang nag piprint ng excel
            header("Pragma: no-cache"); 
            header("Expires: 0");

            $output = "";
          
        if(ISSET($member_type, $date1_a, $date1_b) ){
            $output .="
            <table>
                  <thead>
                  <tr>
                    <th>Full name</th>
                    <th>RFID Number</th>
                    <th>Guardian </th>
                    <th>Guardian Number</th>
                    <th>Grade Level</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Logged Date</th>
                    <th>Status</th>
                  </tr>
                  <tbody id='load_data5'>
            ";

            $stmt =  $this->pdo->prepare("SELECT *, m.member_rfid as RFID, CONCAT(m.member_lname, ', ' ,m.member_fname, ' ' ,m.member_mname) as member_name
            FROM tbl_attendance a LEFT JOIN tbl_members m ON a.member_id = m.member_id
            LEFT JOIN tbl_gradelevel gl ON gl.gradelevel_id = m.gradelevel_id 
            WHERE m.member_type IN ('student', 'staff', 'visitor')");
                $stmt->execute([]); 

                while($fetch2 = $stmt->fetch(PDO::FETCH_ASSOC)){
                $time_out = "";
                if (empty(htmlentities($fetch2['time_out']))) {
                $time_out = "";
                }else{
                $time_out = date("g:i a", strtotime(htmlentities($fetch2['time_out'])));
                }
                if (htmlentities($fetch2['member_status']) =='active'){
                $stat = 'Active';
                }else{
                $stat = 'Inactive';
                }

                $output .= "
                <tr>

                <td>". htmlentities($fetch2['member_name'])."</td>
                <td>". htmlentities($fetch2['member_rfid'])."</td>
                <td>". htmlentities($fetch2['guardian'])."</td>
                <td>". htmlentities(ucwords($fetch2['guardian_number']))."</td>
                <td>". htmlentities(ucwords($fetch2['glevel_name']))."</td>
                <td>". date("g:i a", strtotime(htmlentities($fetch2['time_in'])))."</td>
                <td>". $time_out."</td>
                <td>". htmlentities(date("M d, Y",strtotime($fetch2['logdate'])))."</td>
                <td>". htmlentities($stat)."</td>
                </tr>
                ";

    
            }
            
            $output .="
                </tbody>
                
              </table>
            ";
            
            echo $output;
          }
        
      }


  }
?>



