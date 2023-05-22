<!-- Modal -->
<div class="modal fade" id="editgradelevelmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Grade Level</h5> &nbsp;&nbsp;<i class="bi bi-pencil"></i>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form method="POST">
      <div class="modal-body">
        <div id="mgs-editglevel">

        </div>
      <div class="col-lg-12 mt-1" id="mgs-dept"></div>

      <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Grade Level: </b></label>
                   <input type="text" id="edit_glevel_name" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" id="edit_gradelevelid">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-warning" id="btn-editgradelevel">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>



<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn-editgradelevel');
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const glevel_name = document.querySelector('input[id=edit_glevel_name]').value;
            console.log(glevel_name);

            const gradelevel_id = document.querySelector('input[id=edit_gradelevelid]').value;
            console.log(gradelevel_id);

            var data = new FormData(this.form);

            data.append('glevel_name', glevel_name);
            data.append('gradelevel_id', gradelevel_id);
            


                $.ajax({
                    url: '../config/controller/edit_gradelevel.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                 success: function(response) {
                          $("#mgs-editglevel").html(response);
                          $('#mgs-editglevel').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
           //}

        });
    });
</script>