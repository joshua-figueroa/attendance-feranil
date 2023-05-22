<!-- Modal -->
<div class="modal fade" id="staffmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> New Staff</h5> &nbsp;&nbsp;<i class="bi bi-plus-circle"></i>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form method="POST">
      <div class="modal-body">
        <div id="mgs-stf">

        </div>
      <div class="col-lg-12 mt-1" id="mgs-dept"></div>
       <div class="col-lg-12 mb-1">
              <div class="form-group">
                  <label for="inputTime"><b>Rfid number:</b></label>
                  <input type="text" id="member_rfid" class="form-control" autocomplete="off" required>
                  <span class="deptname-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>image: </b></label>
                   <input type="file" id="member_image" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>First Name: </b></label>
                   <input type="text" id="member_fname" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Middle Name: </b></label>
                   <input type="text" id="member_mname" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Last Name: </b></label>
                   <input type="text" id="member_lname" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-warning" id="btn-staff">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>



<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn-staff');
        btn.addEventListener('click', (e) => {
            e.preventDefault();


            const member_rfid = document.querySelector('input[id=member_rfid]').value;
            console.log(member_rfid);

            const member_image = document.querySelector('input[id=member_image]').value;
            console.log(member_image);

            const member_fname = document.querySelector('input[id=member_fname]').value;
            console.log(member_fname);

            const member_mname = document.querySelector('input[id=member_mname]').value;
            console.log(member_mname);

            const member_lname = document.querySelector('input[id=member_lname]').value;
            console.log(member_lname);

            var data = new FormData(this.form);

            
            data.append('member_rfid', member_rfid);
            data.append('member_image', $('#member_image')[0].files[0]);
            data.append('member_fname', member_fname);
            data.append('member_mname', member_mname);
            data.append('member_lname', member_lname);
            
            if(member_rfid == ""){
                $('#mgs-stf').html('<div class="alert alert-danger">Required RFID Number</div>');
            }else if(member_image == ""){
                console.log("asdas");
                $('#mgs-stf').html('<div class="alert alert-danger">Required Image</div>');
            }else if(member_fname == ""){
                $('#mgs-stf').html('<div class="alert alert-danger">Required First name</div>');
            }else if(member_mname == ""){
                $('#mgs-stf').html('<div class="alert alert-danger">Required Middle name</div>');
            }else if(member_lname == ""){
                $('#mgs-stf').html('<div class="alert alert-danger">Required Last name</div>');
            }else{
                $.ajax({
                    url: '../config/controller/add_staff.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                 success: function(response) {
                          $("#mgs-stf").html(response);
                          $('#mgs-stf').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
             }

        });
    });
</script>