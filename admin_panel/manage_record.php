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
                    <div class="col-6 col-lg-12">
                        <div class="card">
                            <div class="card-body p-5">
                                <?php
                                    $memberId = $_GET['id'];
                                    $logs = $conn->FetchRecord($memberId);
                                    $memberInfo = $conn->FetchMember($memberId);
                                    $fullName = strtoupper($memberInfo['member_lname']).(", ").ucfirst(strtolower($memberInfo['member_fname']));
                                ?>

                                <h4>Member Information</h4>
                                <div class="row mb-5 mt-4 ms-3 align-items-center">
                                    <div class="col-md-3">
                                        <img src="<?php echo $memberInfo['member_image'];?>" style="height:150px;object-fit:contain;" >
                                    </div>
                                    <div class="col-md-9">
                                        <h5>Name: <?php echo $fullName;?></h5>
                                        <h5>Grade Level: <?php echo $memberInfo['glevel_name'];?></h5>
                                        <h5>Guardian: <?php echo $memberInfo['guardian']." (".$memberInfo['guardian_number'].")";?></h5>
                                        <h5>Status: <?php echo ucFirst($memberInfo['member_status']);?></h5>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-10">
                                        <h4>Attendance Record</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary float-end py-2" onclick="downloadCSV('<?= $fullName; ?>')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download me-2" viewBox="0 0 16 16">
                                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                            </svg>
                                            Export to CSV
                                        </button>
                                    </div>
                                </div>

                                <?php if (count($logs) === 0) { ?>
                                   <div class="alert alert-warning d-flex align-items-center" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle text-black me-2" viewBox="0 0 16 16">
                                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                                        </svg>
                                        <div class="text-black">
                                            No logs found
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                        <table class="table table-hover" id="attendanceTable">
                                            <thead>
                                                <tr>
                                                    <th>Attendance ID</th>
                                                    <th>Time In</th>
                                                    <th>Time Out</th>
                                                    <th>Log Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($logs as $row) {?>
                                                    <tr>
                                                        <td><?= $row['attendance_id']; ?></td>
                                                        <td id="time-in"><?= $row['time_in']; ?></td>
                                                        <td id="time-out"><?= $row['time_out']; ?></td>
                                                        <td><?= date("M d Y",strtotime($row['logdate'])); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">
        function downloadCSV(file) {
            const date = new Date();
            let csv_data = [];
            const rows = document.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                const cols = rows[i].querySelectorAll('td,th');
                const csvrow = [];
                for (let j = 0; j < cols.length; j++) {
                    csvrow.push(cols[j].innerHTML);
                }
                csv_data.push(csvrow.join(","));
            }
            csv_data = csv_data.join('\n');

            const CSVFile = new Blob([csv_data], { type: "text/csv" });
            var temp_link = document.createElement('a');
            temp_link.download = `${file} - Attendance Report (${date.toLocaleDateString().split("/").join("-")}).csv`
            var url = window.URL.createObjectURL(CSVFile);
            temp_link.href = url;
            temp_link.style.display = "none";
            document.body.appendChild(temp_link);
            temp_link.click();
            document.body.removeChild(temp_link);
        }
    </script>  

    <!-- <script>
        $(document).ready(function() {   
        function formatTime(timeString) {
            const timeParts = timeString.split(':');
            const hour = parseInt(timeParts[0]);
            const minute = parseInt(timeParts[1]);
            const second = parseInt(timeParts[2]);

            const date = new Date();
            date.setHours(hour);
            date.setMinutes(minute);
            date.setSeconds(second);

            const formattedTime = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

            const formattedTimeIn = formatTime($("#time-in").text());
            const formattedTimeOut = formatTime($("#time-out").text());

            console.log(formatTime("10:32:13"))

            $("#time-in").text(formattedTimeIn);
            $("#time-out").text(formattedTimeOut);
        });
        
    </script> -->


    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
    </div>
</body>

</html>