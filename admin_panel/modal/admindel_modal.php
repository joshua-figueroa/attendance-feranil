<div class="modal fade" id="admindel-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Delete Admin</h5><i class="bi bi-trash"></i>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
            <div class="modal-body">
            <div class="col-lg-12 mt-1" id="mgs-del-admin"></div>
                <div class="col-lg-12 mb-1">
                    <div class="form-group">
                        <label for="inputTime"><b>Username:</b></label>
                        <input type="text" id="delete_username" class="form-control" autocomplete="off" readonly="">
                        <span class="deptname-error"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="" id="delete_adminid">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-outline-primary" id="btn-admin-del2">Yes</button>
            </div>
           </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn-admin-del2');
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const admin_id = document.querySelector('input[id=delete_adminid]').value;
            console.log(admin_id);

            var data = new FormData(this.form);

            data.append('admin_id', admin_id);



                $.ajax({
                    url: '../config/controller/delete_admin.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                   success: function(response) {
                          $("#mgs-del-admin").html(response);
                          $('#mgs-del-admin').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
           // }

        });
    });
</script>