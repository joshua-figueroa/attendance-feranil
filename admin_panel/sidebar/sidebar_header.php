<?php
session_start();
require_once "../config/rfid_class.php";
if(!isset($_SESSION['logged_in'])){
    header("location:../cpanel-login.php");  
 }else{

    $conn = new rfid_attendance();
    $GetAdminSession = trim($_SESSION['user_no']);
    $admin = $conn->fetch_adminsession($GetAdminSession);
    $Attendance = $conn->FetchAttendance_index();
    $students = $conn->FetchAllstudents();
    $staff = $conn->FetchAllstaff();
    $visitors = $conn->FetchAllvisitors();
    $admins = $conn->FetchAllAdmin();
    $gradelevel = $conn->FetchGradelevel();
    $announce = $conn->FetchAnnouncements();
    $allmembers = $conn->FetchallMembers();
    $rfid_used = $conn->RfidUsed();

    function matchPath($path) {
        $tokens = explode('/', $_SERVER['REQUEST_URI']);
        $lastPath = $tokens[sizeof($tokens) - 1];
        $finalPath = explode("?", $lastPath);
        return $path === $finalPath[sizeof($finalPath) - 1] ? "active" : "";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Attendance</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">


    <script type="text/javascript">
        $(document).ready(function () {
             $("#myDataTable").DataTable();
         });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
             $("#main_dashboardtable").DataTable({
              "lengthMenu": [[10, 15, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
             });
             
         });
    </script>

    <script type="text/javascript">
        function isMenuActive(fullPath, str) {
            const arr = fullPath.split("/");
            const lastPath = arr[arr.length - 1].split("?")[0];    
            
            return str === lastPath;
        }
    </script>
    
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                            <?php foreach ($admin as $value) { echo ''.$value['admin_username']; }?>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-item <?php echo matchPath("dashboard.php") ?>">
                            <a href="dashboard.php" class='sidebar-link'>
                                <i class="bi bi-grid"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        
                        <li class="sidebar-item <?php echo matchPath("manage_gradelevel.php") ?>">
                            <a href="manage_gradelevel.php" class='sidebar-link'>
                                <i class="bi bi-person-bounding-box"></i>
                                <span>Grade Level</span>
                            </a>
                        </li>


                        <li class="sidebar-item has-sub <?php echo matchPath("manage_student.php") ?>">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>Member Type</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item <?php echo matchPath("manage_student.php") ?>">
                                    <a href="manage_student.php">Students</a>
                                </li>
                                <li class="submenu-item <?php echo matchPath("manage_staff.php") ?>">
                                    <a href="manage_staff.php">Staffs</a>
                                </li>
                                <li class="submenu-item <?php echo matchPath("manage_visitors.php") ?>">
                                    <a href="manage_visitors.php">Visitors</a>
                                </li>
                            </ul>
                        </li>

                            <li class="sidebar-item <?php echo matchPath("announcement.php") ?>">
                            <a href="announcement.php" class='sidebar-link'>
                                <i class="bi bi-megaphone"></i>
                                <span>Announcement</span>
                            </a>
                        </li>
                        

                        <li class="sidebar-item <?php echo matchPath("attendance_reports.php") ?>">
                            <a href="attendance_reports.php" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical"></i>
                                <span>Reports</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item <?php echo matchPath("manage_admin.php") ?>">
                            <a href="manage_admin.php" class='sidebar-link'>
                                <i class="bi bi-person"></i>
                                <span>Admin</span>
                            </a>
                        </li>

                        
                        <br><br><br><br><br><br><br>
                        <li class="sidebar-item  ">
                            <a href="logout.php" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <?php } ?>