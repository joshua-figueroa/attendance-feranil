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
                                    <div class="card-body px-3 py-4-5">

                                        <table class="table table-hover" id="myDataTable">
                                            <div class="row">
                                                <div class="col-md-10 mb-4">
                                                    <h5 class="text-muted font-semibold">Manage Students</h5>
                                                </div>
                                                <div class="col-md-2 mb-4">
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentmodal">Add Student</button>
                                                    <?php
                                                        include 'modal/student_modal.php';
                                                    
                                                    ?>
                                                </div>
                                            </div>
                                        
                                            
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>RFID Number</th>
                                                <th>Guardian </th>
                                                <th>Guardian Number</th>
                                                <th>Grade Level</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($students as $row) {?>
                                            <tr>
                                                <td><center><img src="<?php echo htmlentities($row['member_image']);?>" width="50px" height="50px" ></center></td>
                                                <td><?= strtoupper($row['member_lname']).(", ").ucfirst(strtolower($row['member_fname'])); ?></td>
                                                <td><?= ucwords($row['member_rfid']); ?></td>
                                                <td><?= ucwords($row['guardian']); ?></td>
                                                <td><?= ucwords($row['guardian_number']); ?></td>
                                                <td>
                                                    <?= 
                                                        $gLevel = $row['glevel_name'];
                                                        if (is_null($gLevel)) {
                                                            echo "N/A - ".ucfirst($row['member_type']);
                                                        } else {
                                                            ucfirst($gLevel);
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if (htmlentities($row['member_status']) == 'active'){
                                                            echo '<strong>Active</strong>';
                                                        }else{
                                                            echo '<strong>Inactive</strong>';
                                                        }
                                                    ?>
                                                </td>
                                                <td style="width:20%" class="text-center">
                                                    <button class="btn btn-primary btn-edit" data-edit="<?= $row['member_id']; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                        </svg>
                                                    </button>
                                                    <button class="btn btn-danger btn-del" data-del="<?= $row['member_id']; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                    </svg>
                                                    </button>
                                                    <a class="btn btn-info" href="manage_record.php?id=<?= $row['member_id']; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                        </svg>
                                                    </a>
                                                </td>


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
    <?php
    include 'modal/studentedit_modal.php';
    include 'modal/studentdel_modal.php';
    ?>

    <script>
    $(document).ready(function() {   
        load_data();    
        var count = 1; 
        function load_data() {
            $(document).on('click', '.btn-edit', function() {
               $('#editstudentmodal').modal('show');
                var member_id = $(this).data("edit");
                    getID(member_id);     
                    console.log(member_id);
            });
        }

            function getID(member_id) {
                $.ajax({
                    type: 'POST',
                    url: '../config/controller/row_students.php',
                    data: {
                        member_id: member_id
                    },
                    dataType: 'json',
                    success: function(response) {

                    $('#edit_member_id').val(response.member_id);
                    $('#edit_member_rfid').val(response.member_rfid);
                    $('#edit_member_image').val(response.member_image);
                    $('#edit_member_fname').val(response.member_fname);
                    $('#edit_member_mname').val(response.member_mname);
                    $('#edit_member_lname').val(response.member_lname);
                    $('#edit_guardian').val(response.guardian);
                    $('#edit_guardian_number').val(response.guardian_number);
                    $('#edit_gradelevel_id').val(response.gradelevel_id);
                    $('#edit_member_status').val(response.member_status);

                }
            });
            }
    
    });
    
</script>

<script>
       $(document).ready(function() {   
           load_data();    
           var count = 1; 
           function load_data() {
               $(document).on('click', '.btn-del', function() {
                  $('#studentdel-modal').modal('show');
                    var member_id = $(this).data("del");
                      get_delId(member_id); //argument    
             
               });
            }

             function get_delId(member_id) {
                  $.ajax({
                      type: 'POST',
                      url: '../config/controller/row_students.php',
                      data: {
                        member_id: member_id
                      },
                      dataType: 'json',
                      success: function(response2) {
                      $('#delete_studentid').val(response2.member_id);
                      $('#delete_rfidnumber').val(response2.member_rfid);
      
                   }
                });
             }
       
       });
        
 </script>


    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>