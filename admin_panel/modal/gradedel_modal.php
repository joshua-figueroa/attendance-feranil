<div class="modal fade" id="gleveldel-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Delete Gradel Level</h5><i class="bi bi-trash"></i>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
            <div class="modal-body">
            <div class="col-lg-12 mt-1" id="mgs-del-glevel"></div>
                <div class="col-lg-12 mb-1">
                    <div class="form-group">
                        <label for="inputTime"><b>Grade Level:</b></label>
                        <input type="text" id="delete_glevelname" class="form-control" autocomplete="off" readonly="">
                        <span class="deptname-error"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="" id="delete_gradelevelid">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-outline-primary" id="btn-glevel-del">Yes</button>
            </div>
           </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn-glevel-del');
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const gradelevel_id = document.querySelector('input[id=delete_gradelevelid]').value;
            console.log(gradelevel_id);

            var data = new FormData(this.form);

            data.append('gradelevel_id', gradelevel_id);
            



                $.ajax({
                    url: '../config/controller/delete_gradelevel.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                   success: function(response) {
                          $("#mgs-del-glevel").html(response);
                          $('#mgs-del-glevel').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
           // }

        });
    });
</script>