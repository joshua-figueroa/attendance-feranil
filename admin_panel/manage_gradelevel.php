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
                                                <div class="col-md-9 mb-4">
                                                    <h5 class="text-muted font-semibold">Manage Grade Level</h5>
                                                </div>
                                                <div class="col-md-3 mb-4">
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#gradelevelmodal">Add Grade level</button>
                                                    <?php
                                                        include 'modal/gradelevel_modal.php';
                                                    
                                                    ?>
                                                    
                                    
                                                </div>
                                            </div>
                                        
                                            
                                        <thead>
                                            <tr>
                                            <th>Grade Level</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($gradelevel as $row) {?>
                                            <tr>
                                                <td><?= htmlentities($row['glevel_name']); ?></td>
                            
                                                <td style="width:20%">
                                                    <button class="btn btn-primary btn-edit" data-edit="<?= htmlentities($row['gradelevel_id']); ?>">Edit</button>
                                                    <button class="btn btn-danger btn-del" data-del="<?= htmlentities($row['gradelevel_id']); ?>">Delete</button>
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
    include 'modal/gradeedit_modal.php';
    include 'modal/gradedel_modal.php';
    ?>

    <script>
    $(document).ready(function() {   
        load_data();    
        var count = 1; 
        function load_data() {
            $(document).on('click', '.btn-edit', function() {
               $('#editgradelevelmodal').modal('show');
                var gradelevel_id = $(this).data("edit");
                    //console.log(admin_id);
                    getID(gradelevel_id);     
            
            });
        }

            function getID(gradelevel_id) {
                $.ajax({
                    type: 'POST',
                    url: '../config/controller/row_gradelevel.php',
                    data: {
                        gradelevel_id: gradelevel_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                    $('#edit_gradelevelid').val(response.gradelevel_id);
                    $('#edit_glevel_name').val(response.glevel_name);

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
                  $('#gleveldel-modal').modal('show');
                    var gradelevel_id = $(this).data("del");
                      get_delId(gradelevel_id); //argument    
             
               });
            }

             function get_delId(gradelevel_id) {
                  $.ajax({
                      type: 'POST',
                      url: '../config/controller/row_gradelevel.php',
                      data: {
                        gradelevel_id: gradelevel_id
                      },
                      dataType: 'json',
                      success: function(response2) {
                      $('#delete_gradelevelid').val(response2.gradelevel_id);
                      $('#delete_glevelname').val(response2.glevel_name);
      
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