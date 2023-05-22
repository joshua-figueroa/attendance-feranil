<div class="modal fade" id="studentdel-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Delete Student</h5><i class="bi bi-trash"></i>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
            <div class="modal-body">
            <div class="col-lg-12 mt-1" id="mgs-del-std"></div>
                <div class="col-lg-12 mb-1">
                    <div class="form-group">
                        <label for="inputTime"><b>Rfid number:</b></label>
                        <input type="text" id="delete_rfidnumber" class="form-control" autocomplete="off" readonly="">
                        <span class="deptname-error"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="" id="delete_studentid">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-outline-primary" id="btn-std-del">Yes</button>
            </div>
           </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn-std-del');
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const member_id = document.querySelector('input[id=delete_studentid]').value;
            console.log(member_id);

            var data = new FormData(this.form);

            data.append('member_id', member_id);



                $.ajax({
                    url: '../config/controller/delete_student.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                   success: function(response) {
                          $("#mgs-del-std").html(response);
                          $('#mgs-del-std').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
           // }

        });
    });
</script>