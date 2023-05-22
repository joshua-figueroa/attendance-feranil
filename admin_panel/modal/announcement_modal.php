<!-- Modal -->
<div class="modal fade" id="announcementmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> New Announcement</h5> &nbsp;&nbsp;<i class="bi bi-plus-circle"></i>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form method="POST">
      <div class="modal-body">
        <div id="mgs-announce"></div>


      <div class="col-lg-12 mt-1" id="mgs-dept"></div>
      <div class="row">

          <div class="col-lg-6">
                <div class="form-group">
                    
                    <label for="inputTime"><b>Member Type: </b></label>
                    <select class="form-control" id="member_type" onchange = "EnableDisableTextBox(this)"  autocomplete="off">
                        <option value="" selected="true" disabled="disabled">&larr; Select Member Type &rarr;</option>
                         <option value="student">Student</option>
                         <option value="staff">Staff</option>
                    </select>

                    <span class="glevel-error"></span>
                </div>
          </div>

          <div class="col-lg-6">
                <div class="form-group">
                    <label for="inputTime"><b>Students: </b></label>
                        <select class="form-control" id="gradelevel_id"  autocomplete="off">
                        <option value="" selected="true" disabled="disabled">&larr; Select Students &rarr;</option>
                        <?php
                        require_once "../config/rfid_class.php";
                        $conn = new rfid_attendance();
                        $depts = $conn->FetchGradelevelStudents();
                        foreach ($depts as $row) { ?>
                        <option value="<?php echo htmlentities($row['gradelevel_id']); ?>"><?php echo htmlentities($row['glevel_name']); ?></option>
                        <?php } ?>
                    </select>
                    <span class="glevel-error"></span>
                </div>
          </div>

      </div>
      <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Announce: </b></label>
                   <textarea type="text" rows="6" id="announce" class="form-control mt-1" autocomplete="off" required></textarea>
                  <span class="deptdesc-error"></span>
              </div>
          </div>

  
          
      </div>
      <div class="modal-footer">
      <?php
        require_once "../config/rfid_class.php";
            $conn = new rfid_attendance();
            $depts = $conn->FetchallMembers();
        foreach ($depts as $row) { ?>
         <input type="hidden" id="guardian_number"  value="<?php echo $row['guardian_number'];?>">
         <?php } ?>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-warning" id="btn-announce">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    function EnableDisableTextBox(member_type) { //kapag e select si all sa dropdown saka siya mag disables ang date from at to
        var selectedValue = member_type.options[member_type.selectedIndex].value;
        var member_type = $('#member_type option:selected').val();
        $('#gradelevel_id').val("");
        gradelevel_id.disabled = selectedValue == 'staff' ? true : false;
          if (!member_type.disabled ) {
        }
    }
</script>




<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn-announce');
        btn.addEventListener('click', (e) => {
            e.preventDefault();

//             var elements = document.getElementsByTagName("input")
// for (var i = 0; i < elements.length; i++) {
//     if(elements[i].value == "")
//         alert('empty');
//     //Do something
// }

            const gradelevel_id = $('#gradelevel_id option:selected').val();
            console.log(gradelevel_id);

            const member_type = $('#member_type option:selected').val();
            console.log(member_type);

            const announce = document.querySelector('textarea[id=announce]').value;
            console.log(announce);

            var data = new FormData(this.form);
       
            // const cars = ["+639605895653", "+639605895653"];

            // for (var i = 0; i < cars.length; i++){
            //         var guardian_number = cars[i];
            //         // console.log('===============all number ================');
            //         // console.log(x);
            //  data.append('guardian_number', guardian_number);
            // }

            data.append('gradelevel_id', gradelevel_id);
            data.append('member_type', member_type);
            data.append('announce', announce);
           
            if(member_type == ""){
               $('#mgs-announce').html('<div class="alert alert-danger">Required Select Member Type</div>');
             }else if(announce == ""){
               $('#mgs-announce').html('<div class="alert alert-danger">Required Announcement</div>');
             }else{
                $.ajax({
                    url: '../config/controller/add_announcement.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                 success: function(response) {
                          $("#mgs-announce").html(response);
                          $('#mgs-announce').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
             }

        });
    });
</script>


