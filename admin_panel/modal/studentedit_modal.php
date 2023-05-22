<!-- Modal -->
<div class="modal fade" id="editstudentmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Student</h5> &nbsp;&nbsp;<i class="bi bi-pencil"></i>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form method="POST">
      <div class="modal-body">
        <div id="mgs-edit">

        </div>
      <div class="col-lg-12 mt-1" id="mgs-dept"></div>
       <div class="col-lg-12 mb-1">
              <div class="form-group">
                  <label for="inputTime"><b>Rfid number:</b></label>
                  <input type="text" id="edit_member_rfid" class="form-control" autocomplete="off" required>
                  <span class="deptname-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>First Name: </b></label>
                   <input type="text" id="edit_member_fname" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Middle Name: </b></label>
                   <input type="text" id="edit_member_mname" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Last Name: </b></label>
                   <input type="text" id="edit_member_lname" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Guardian: </b></label>
                   <input type="text" id="edit_guardian" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Guardian Number: </b></label>
                   <input type="text" id="edit_guardian_number" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
                <div class="form-group">
                    <label for="inputTime"><b>Grade Level: </b></label>
                        <select class="form-control" id="edit_gradelevel_id" autocomplete="off">
                        <option value="">&larr; Select Grade Level &rarr;</option>
                        <option value=0>Non-Student (Visistor/Staff)</option>
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
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Status: </b></label>
                  <select type="text" id="edit_member_status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <input type="hidden" id="edit_member_id" >
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-warning" id="btn-edit-student">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>



<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn-edit-student');
        btn.addEventListener('click', (e) => {
            e.preventDefault();


            const member_rfid = document.querySelector('input[id=edit_member_rfid]').value;
            console.log(member_rfid);

            const member_fname = document.querySelector('input[id=edit_member_fname]').value;
            console.log(member_fname);

            const member_mname = document.querySelector('input[id=edit_member_mname]').value;
            console.log(member_mname);

            const member_lname = document.querySelector('input[id=edit_member_lname]').value;
            console.log(member_lname);

            const guardian = document.querySelector('input[id=edit_guardian]').value;
            console.log(guardian);

            const guardian_number = document.querySelector('input[id=edit_guardian_number]').value;
            console.log(guardian_number);

            const gradelevel_id = $('#edit_gradelevel_id option:selected').val();
            console.log(gradelevel_id);

            const member_status = $('#edit_member_status option:selected').val();
            console.log(member_status);

            const member_id = document.querySelector('input[id=edit_member_id]').value;
            console.log(member_id);

            var data = new FormData(this.form);

            
            data.append('member_rfid', member_rfid);
            data.append('member_fname', member_fname);
            data.append('member_mname', member_mname);
            data.append('member_lname', member_lname);
            data.append('guardian', guardian);
            data.append('guardian_number', guardian_number);
            data.append('gradelevel_id', gradelevel_id);
            data.append('member_status', member_status);
            data.append('member_id', member_id);


                $.ajax({
                    url: '../config/controller/edit_student.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                 success: function(response) {
                          $("#mgs-edit").html(response);
                          $('#mgs-edit').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
            // }

        });
    });
</script>