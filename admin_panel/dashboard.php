<?php
    include_once 'sidebar/sidebar_header.php'
?>

 <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Administrator Dashboard</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card"s>
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8" >
                                                <h6 class="text-muted font-semibold">Total <br> Students</h6>
                                                <?php
                                                    require_once "../config/rfid_class.php";
                                                    $conn = new rfid_attendance();
                                                    $stud = $conn->count_student();
                                                  foreach ($stud as $row) { ?>
                                               
                                                  <h6 class="font-extrabold mb-0"><?php echo htmlentities($row['member_id']); ?></h6>
                                                 
                                                  <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total<br>Staffs</h6>
                                                <?php
                                                    require_once "../config/rfid_class.php";
                                                    $conn = new rfid_attendance();
                                                    $stud = $conn->count_staff();
                                                  foreach ($stud as $row) { ?>
                                               
                                                  <h6 class="font-extrabold mb-0"><?php echo htmlentities($row['member_id']); ?></h6>
                                                 
                                                  <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total <br> Visitors</h6>
                                                <?php
                                                    require_once "../config/rfid_class.php";
                                                    $conn = new rfid_attendance();
                                                    $stud = $conn->count_visitor();
                                                  foreach ($stud as $row) { ?>
                                               
                                                  <h6 class="font-extrabold mb-0"><?php echo htmlentities($row['member_id']); ?></h6>
                                                 
                                                  <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Daily <br>logged</h6>
                                                <?php
                                                    require_once "../config/rfid_class.php";
                                                    $conn = new rfid_attendance();
                                                    $stud = $conn->count_all();
                                                  foreach ($stud as $row) { ?>
                                               
                                                  <h6 class="font-extrabold mb-0"><?php echo htmlentities($row['member_id']); ?></h6>
                                                 
                                                  <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      <div class="col-6 col-lg-12">
                 <div class="card">
                <div class="card-body px-3 py-4-5">
           <table class="table table-bordered" id="main_dashboardtable">
            <h5 class="text-muted font-semibold">Daily Attendance</h5>
          <thead>
            <tr>
              <th>Image</th>
              <th>Full name</th>
              <th>RFID Number</th>
              <th>Time In</th>
              <th>Time Out</th>
              <th>Logged Date</th>
            </tr>
          </thead>
          <tbody>
        <?php foreach ($Attendance as $row) {?>
              <tr>
                <td><center><img src="<?php echo htmlentities($row['member_image']);?>" width="50px" height="50px" ></center></td>
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

              </tr>
              <?php } ?>
          </tbody>
        </table>
        
        
        </div>
        </div>
        </div>

                        </div>
                </section>
              </div>
            </div>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>