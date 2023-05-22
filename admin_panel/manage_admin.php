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
                                                    <h5 class="text-muted font-semibold">Manage Admin</h5>
                                                </div>
                                                <div class="col-md-2 mb-4">
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adminmodal">Add Admin</button>
                                                    <?php
                                                        include 'modal/admin_modal.php';
                                                    
                                                    ?>
                                                    
                                    
                                                </div>
                                            </div>
                                        
                                            
                                        <thead>
                                            <tr>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($admins as $row) {?>
                                            <tr>
                                                <td><?= htmlentities($row['admin_username']); ?></td>
                                                <td><?= htmlentities(ucwords($row['admin_password'])); ?></td>
                                                <td>
                                                    <?php
                                                        if (htmlentities($row['status']) =='active'){
                                                            echo '<strong>Active</strong>';
                                                        }else{
                                                            echo '<strong>Inactive</strong>';
                                                        }
                                                    ?>
                                                </td>
                                                <td style="width:20%">
                                                    <button class="btn btn-primary btn-edit" data-edit="<?= htmlentities($row['admin_id']); ?>">Edit</button>
                                                    <button class="btn btn-danger btn-del" data-del="<?= htmlentities($row['admin_id']); ?>">Delete</button>
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
    include 'modal/adminedit_modal.php';
    include 'modal/admindel_modal.php';
    ?>

    <script>
    $(document).ready(function() {   
        load_data();    
        var count = 1; 
        function load_data() {
            $(document).on('click', '.btn-edit', function() {
               $('#editadminmodal').modal('show');
                var admin_id = $(this).data("edit");
                    //console.log(admin_id);
                    getID(admin_id);     
            
            });
        }

            function getID(admin_id) {
                $.ajax({
                    type: 'POST',
                    url: '../config/controller/row_admin.php',
                    data: {
                        admin_id: admin_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                    $('#edit_adminid').val(response.admin_id);
                    $('#edit_admin_username').val(response.admin_username);
                    $('#edit_admin_password').val(response.admin_password);
                    $('#edit_status').val(response.status);

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
                  $('#admindel-modal').modal('show');
                    var admin_id = $(this).data("del");
                      get_delId(admin_id); //argument    
             
               });
            }

             function get_delId(admin_id) {
                  $.ajax({
                      type: 'POST',
                      url: '../config/controller/row_admin.php',
                      data: {
                        admin_id: admin_id
                      },
                      dataType: 'json',
                      success: function(response2) {
                      $('#delete_adminid').val(response2.admin_id);
                      $('#delete_username').val(response2.admin_username);
      
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