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

                                        <table class="table .table-hover" id="myDataTable">
                                            <div class="row">
                                                <div class="col-md-10 mb-4">
                                                    <h5 class="text-muted font-semibold">Manage Visitors</h5>
                                                </div>
                                          </div>                                    
                                      
                                        <thead>
                                            <tr>
                                            <th>Image</th>
                                            <th>Full name</th>
                                            <th>RFID Number</th>
                                            <th>Purpose</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($visitors as $row) {?>
                                            <tr>
                                                <td><center><img src="<?php echo htmlentities($row['member_image']);?>" width="50px" height="50px" ></center></td>
                                                <td><?= strtoupper($row['member_lname']).(", ").ucfirst(strtolower($row['member_fname'])) ?></td>
                                                <td>
                                                    <?= 
                                                        $rfid = $row['member_rfid'];
                                                        if (is_null($rfid)) {
                                                            echo "N/A";
                                                        } else {
                                                            ucfirst($rfid);
                                                        }
                                                    ?>
                                                </td>
                                                <td><?= htmlentities(ucwords($row['purpose'])); ?></td>
                                                <td>
                                                    <?php
                                                        if (htmlentities($row['visitor_status']) =='Approved'){
                                                            echo '<strong>Approved</strong>';
                                                        }else{
                                                            echo '<strong>Pending</strong>';
                                                        }
                                                    ?>
                                                </td>
                                                <td style="width:20%">
                                                    <button class="btn btn-primary btn-edit" data-edit="<?= htmlentities($row['IDS']); ?>">Edit</button>
                                                    <button class="btn btn-danger btn-del" data-del="<?= htmlentities($row['IDS']); ?>">Delete</button>
                                                    <a class="btn btn-info btn-del" href="manage_record.php?id=<?= $row['IDS']; ?>">
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
    include 'modal/visitoredit_modal.php';
    include 'modal/visitordel_modal.php';
    ?>

    <script>
    $(document).ready(function() {   
        load_data();    
        var count = 1; 
        function load_data() {
            $(document).on('click', '.btn-edit', function() {
               $('#editvisitormodal').modal('show');
                var member_id = $(this).data("edit");
                    getID(member_id);     
            
            });
        }

            function getID(member_id) {
                $.ajax({
                    type: 'POST',
                    url: '../config/controller/row_visitors.php',
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
                    $('#edit_purpose').val(response.purpose);
                    $('#edit_guardian').val(response.guardian);
                    $('#edit_guardian_number').val(response.guardian_number);
                    $('#edit_gradelevel_id').val(response.gradelevel_id);
                    $('#edit_member_status').val(response.member_status);
                    $('#edit_visitor_status').val(response.visitor_status);

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
                  $('#visitordel-modal').modal('show');
                    var member_id = $(this).data("del");
                      get_delId(member_id); //argument    
             
               });
            }

             function get_delId(member_id) {
                  $.ajax({
                      type: 'POST',
                      url: '../config/controller/row_visitors.php',
                      data: {
                        member_id: member_id
                      },
                      dataType: 'json',
                      success: function(response2) {
                      $('#delete_memberid').val(response2.member_id);
                      $('#edit_fullname').val(response2.member_fname+' '+ response2.member_mname +' '+response2.member_lname);
      
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