<!-- Modal -->
<div class="modal fade" id="adminmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> New Admin</h5> &nbsp;&nbsp;<i class="bi bi-plus-circle"></i>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form method="POST">
      <div class="modal-body">
        <div id="mgs-adn">

        </div>
      <div class="col-lg-12 mt-1" id="mgs-dept"></div>

      <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Username: </b></label>
                   <input type="text" id="admin_username" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>

          <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputTime"><b>Password: </b></label>
                   <input type="text" id="admin_password" class="form-control" autocomplete="off" required>
                  <span class="deptdesc-error"></span>
              </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-warning" id="btn-admin">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>



<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn-admin');
        btn.addEventListener('click', (e) => {
            e.preventDefault();


            const admin_username = document.querySelector('input[id=admin_username]').value;
            console.log(admin_username);

            const admin_password = document.querySelector('input[id=admin_password]').value;
            console.log(admin_password);

            var data = new FormData(this.form);
            data.append('admin_username', admin_username);
            data.append('admin_password', admin_password);

            if(admin_username == ""){
                $('#mgs-adn').html('<div class="alert alert-danger">Required Username</div>');
            }else if(admin_password == ""){
                console.log("asdas");
                $('#mgs-adn').html('<div class="alert alert-danger">Required Password</div>');
            }else{

                $.ajax({
                    url: '../config/controller/add_admin.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                 success: function(response) {
                          $("#mgs-adn").html(response);
                          $('#mgs-adn').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
             }

        });
    });
</script>