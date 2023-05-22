<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registration_css.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Smart Attendance</title>
    
    <style>
        body{
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        h4{
            letter-spacing: 1px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
    </style>
</head>
<body>
<form method="POST">

    <div class="wrapper">
        <div class="container main">
  

            <div class="row">
                <div class="col-md-6 side-image">
                    <!-------Image-------->
                    <img src="img/4.webp" alt="" >
                    <div class="text">
                        
                    </div>
                </div>
     
                 <div class="col-md-6 right">
                 
                     <div class="input-box">
                         <center><h4 class="mb-2">Visitor Registration</h4></center><br>
                     <div class="input-field">
                       <div id="mgs-vtr"></div>
                       <div id="msg_error"></div>
                     </div>
                       
                        <div class="input-field">
                            <input type="text" class="input" id="member_fname"  autocomplete="off">
                            <label for="firstname">Firstname <font color="red">*</font></label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input" id="member_mname" autocomplete="off">
                            <label for="middlename">Middlename</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input" id="member_lname" autocomplete="off">
                            <label for="Lastname">Lastname <font color="red">*</font></label>
                        </div>
                        <div class="input-field">
                            <input type="text" id="purpose" class="input" autocomplete="off">
                            <label for="email">Purpose <font color="red">*</font></label>
                        </div>
                        <div class="input-field mb-4">
                            <input type="file" class="file" id="member_image" autocomplete="off">
                        </div>
                        <div class="input-field">
                            <input type="button" class="submit" id="btn_register" value="Sign Up">
                            
                        </div>
                     </div>
                </div>

            </div>
        </div>
    </div>
    </form>
    <script type="text/javascript">
     document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#btn_register');
        btn.addEventListener('click', (e) => {
            e.preventDefault();
   
            const member_fname = document.querySelector('input[id=member_fname]').value;
            console.log(member_fname);

            const member_mname = document.querySelector('input[id=member_mname]').value;
            console.log(member_mname);

            const member_lname = document.querySelector('input[id=member_lname]').value;
            console.log(member_lname);

            const purpose = document.querySelector('input[id=purpose]').value;
            console.log(purpose);

            const member_image = document.querySelector('input[id=member_image]').value;
            console.log(member_image);

            var data = new FormData(this.form);

            data.append('member_fname', member_fname);
            data.append('member_mname', member_mname);
            data.append('member_lname', member_lname);
            data.append('purpose', purpose);
            data.append('member_image', $('#member_image')[0].files[0]);

            if(member_fname == ""){
                 $('#msg_error').html('<div class="alert alert-danger">Required First Name</div>');
              }else  if(member_lname == ""){
                $('#msg_error').html('<div class="alert alert-danger">Required Last Name</div>');
              }else  if(purpose == ""){
                $('#msg_error').html('<div class="alert alert-danger">Required Purpose</div>');
               }else if(member_image == ""){
                $('#msg_error').html('<div class="alert alert-danger">Required Image</div>');
               }else{
                $.ajax({
                    url: 'config/controller/add_visitorregister.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                 success: function(response) {

                          $('#msg_error').css({"display":"none"});
                          $("#mgs-vtr").html(response);
                          $('#mgs-vtr').animate({ scrollTop: 0 }, 'slow');
                          },
                          error: function(response) {
                            console.log("Failed");
                     }
                });
                
             }

        });
    });
</script>
</body>
</html>