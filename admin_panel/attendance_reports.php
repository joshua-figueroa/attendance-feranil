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
                                        <div class="col-9">
                                            <h6 class="mb-4">Manage Report</h6>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="inputTime"><b>Member Status </b></label>
                                                <select type="text" id="member_type" class="form-control" onchange = "EnableDisableTextBox(this)">
                                                    <option value="" selected="true" disabled="disabled">&larr; Student &rarr;</option>
                                                    <option value="student">Student</option>
                                                    <option value="staff">Staff</option>
                                                    <option value="visitor">Visitor</option>
                                                    <option value="all">All</option>
                                                </select>
                                                <span class="deptdesc-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-3">

                                            <label><b>Date From:</b></label>
                                            <input type="text" class="form-control" placeholder="Start" id="date1" autocomplete="off" />
                                        </div>
                                        <div class="col-lg-3">
                                            <label><b>Date To:</b></label>
                                            <input type="text" class="form-control" placeholder="End" id="date2" autocomplete="off" />
                                        </div>

                                        <div class="col-lg-2 mt-4">
                                            <label></label>
                                            <button type="button" class="btn btn-primary" id="btn_search"><i class="fa fa-search"></i></button> <button type="button" id="reset" class="btn btn-warning"><i class="fa fa-sync"></i></button>
                                
                                        </div>
                                    </div>
                                    <hr>
                                    </hr>                                   
                                          <tbody id="load_data">
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

<script src="assets/js/jquery.min.js"></script>
<script src = "assets/js/jquery-3.1.1.js"></script>
<script src = "assets/js/jquery-ui.js"></script>

<script type="text/javascript">
    function EnableDisableTextBox(member_type) { //kapag e select si all sa dropdown saka siya mag disables ang date from at to
        var selectedValue = member_type.options[member_type.selectedIndex].value;
        var date1 = document.getElementById("date1");
        var date2 = document.getElementById("date2");
        $('#date1').val("");
        $('#date2').val("");
        $('#load_data').empty();
        date1.disabled = selectedValue == 'all' ? true : false;
        date2.disabled = selectedValue == 'all' ? true : false;
        if (!date1.disabled || !date2.disabled ) {

        }
    }
</script>

 <script type="text/javascript">
      $(document).ready(function(){
      $('#member_type option:selected').val();
      $('#date1').datepicker();
      $('#date2').datepicker();

      $('#btn_search').on('click', function(){  
        if($('#member_type option:selected').val() == ""){
           alert("Please Select Attendance Status");
        }else{
          $member_type =  $('#member_type option:selected').val();
          $date1 = $('#date1').val();
          $date2 = $('#date2').val();
          $('#load_data').empty();
          $loader = $('<tr ><td colspan = "7"><center>Searching....</center></td></tr>');
          $loader.appendTo('#load_data');
          setTimeout(function(){
            $loader.remove();
            $.ajax({
              url: '../config/controller/attendance_report.php',
              type: 'POST',
              data: {
                member_type: $member_type,
                date1: $date1,
                date2: $date2
                
              },
              success: function(res){
                $('#load_data').html(res);
              }
            });
          }, 1000);
        } 
      });
      
      $('#reset').on('click', function(){
        location.reload();
      });
    });
</script>

  <script>
  $( function() {
    $( "#date1" ).datepicker();
  });
  </script>
  <script>
  $( function() {
    $( "#date2" ).datepicker();
  });
  </script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>