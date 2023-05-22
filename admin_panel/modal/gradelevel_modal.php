<!-- Modal -->
<div class="modal fade" id="gradelevelmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> New Grade Level</h5> &nbsp;&nbsp;<i class="bi bi-plus-circle"></i>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form method="POST">
      <div class="modal-body">
        <div id="mgs-glevel">

        </div>
      <div class="col-lg-12 mt-1" id="mgs-dept"></div>

      <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Grade Level: </b></label>
                   <input type="text" id="glevel_name" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-warning" id="btn-gradelevel">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>



<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn-gradelevel');
        btn.addEventListener('click', (e) => {
            e.preventDefault();


            const glevel_name = document.querySelector('input[id=glevel_name]').value;
            console.log(glevel_name);

            var data = new FormData(this.form);

            data.append('glevel_name', glevel_name);
            if(glevel_name == ""){
                $('#mgs-glevel').html('<div class="alert alert-danger">Required Grade Level</div>');
            }else{


                $.ajax({
                    url: '../config/controller/add_gradelevel.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                 success: function(response) {
                          $("#mgs-glevel").html(response);
                          $('#mgs-glevel').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
            }

        });
    });
</script>