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
                                                    <h5 class="text-muted font-semibold">Manage Announcement</h5>
                                                </div>
                                                <div class="col-md-3 mb-4">
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#announcementmodal">Add Announcement</button>
                                                    <?php
                                                        include 'modal/announcement_modal.php';
                                                    
                                                    ?>
                                                    
                                    
                                                </div>
                                            </div>
                                        
                                            
                                        <thead>
                                            <tr>
                                            <th>Member Type</th>
                                            <th>Announcement</th>
                                            <th>Announcement Date</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($announce as $row) {?>
                                            <tr>
                                                <td><?= htmlentities($row['member_type']); ?></td>
                                                <td><?= htmlentities($row['announce']); ?></td>
                                                <td><?= htmlentities(ucfirst($row['date_created'])); ?></td>
                                                <td style="width:20%">

                                                    <button class="btn btn-danger btn-del" data-del="<?= htmlentities($row['announcement_id']); ?>">Delete</button>
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
    include 'modal/announcementdel_modal.php';
    ?>


<script>
       $(document).ready(function() {   
           load_data();    
           var count = 1; 
           function load_data() {
               $(document).on('click', '.btn-del', function() {
                  $('#announcementndel-modal').modal('show');
                    var announcement_id = $(this).data("del");
                      get_delId(announcement_id); //argument    
             
               });
            }

             function get_delId(announcement_id) {
                  $.ajax({
                      type: 'POST',
                      url: '../config/controller/row_announcement.php',
                      data: {
                        announcement_id: announcement_id
                      },
                      dataType: 'json',
                      success: function(response2) {
                      $('#deleteannouncementid').val(response2.announcement_id);
                      $('#delete_membertype').val(response2.member_type);
      
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