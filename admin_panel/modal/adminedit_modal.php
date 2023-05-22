<!-- Modal -->
<div class="modal fade" id="editadminmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Admin</h5> &nbsp;&nbsp;<i class="bi bi-pencil"></i>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form method="POST">
      <div class="modal-body">
        <div id="mgs-editadn">

        </div>
      <div class="col-lg-12 mt-1" id="mgs-dept"></div>

      <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Username: </b></label>
                   <input type="text" id="edit_admin_username" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>

          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Password: </b></label>
                   <input type="text" id="edit_admin_password" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          
          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Status: </b></label>
                  <select type="text" id="edit_status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                  <span class="deptdesc-error"></span>
              </div>
          </div>


      </div>
      <div class="modal-footer">
        <input type="hidden" id="edit_adminid">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-warning" id="edit-btn-admin">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>



<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#edit-btn-admin');
        btn.addEventListener('click', (e) => {
            e.preventDefault();


            const admin_username = document.querySelector('input[id=edit_admin_username]').value;
            console.log(admin_username);

            const admin_password = document.querySelector('input[id=edit_admin_password]').value;
            console.log(admin_password);

            const status = $('#edit_status option:selected').val();
            console.log(status);

            const admin_id = document.querySelector('input[id=edit_adminid]').value;
            console.log(admin_id);

            var data = new FormData(this.form);
            data.append('admin_username', admin_username);
            data.append('admin_password', admin_password);
            data.append('status', status);
            data.append('admin_id', admin_id);

                $.ajax({
                    url: '../config/controller/edit_admin.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                 success: function(response) {
                          $("#mgs-editadn").html(response);
                          $('#mgs-editadn').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
            // }

        });
    });
</script>