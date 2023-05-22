<!DOCTYPE html>
<html>
<head>
    <title>Smart Attendance</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form method="POST"  id="logform">
            <div class="form-group">
                        <div class="">
                        <center><span id="myalert2"></span></center>
                        </div>
                        <div id="myalert" style="display:none;">

                            <div class="">
                               <center><span id="alerttext"></span></center>
                            </div>


                        </div>
                        <div id="myalert3" style="display:none;">
                            <div class="">
                                <div class="alert alert-success" id="alerttext3">

                                </div>

                            </div>
                        </div>
                    </div>

			<img src="img/avatar.svg" id="a">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" id="username" name ="username">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" id="password" name="password">
            	   </div>
				   
            	</div>
            	<input type="submit" id = "login-button" name = "submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
	<script>
	// Wait for document to load
        $(document).ready(() => {
            $('#logform').on('submit', () => {
                return false;
            });
        });
        $('#logform').keypress((e) => {
            if (e.which === 13) {
                $('#logform').submit();
                console.log('form submitted');
            }
        })


        $(document).on('click', '#login-button', function() {

            if ($('#email_address').val() != '' && $('#password').val() != '') {

                var imgs = '<img src="../assets/img/ajax-loader.gif" style="height: 20px; width: 20px;"/>';
                $('#login-button').html(imgs + ' Loading...');
                $('#myalert').slideUp();
                $('#myalert3').slideUp();
                var logform = $('#logform').serialize();
                setTimeout(function() {
                    $.ajax({
                        method: 'POST',
                        url: 'config/controller/login.php',
                        data: logform,
                        success: function(data) {
                            if (data == 1) {

                                $('#myalert3').slideDown();
                                $('#alerttext3').html(data);
                                $('#alerttext3').html('<i class="fa fa-check"></i> Login Successful. User Verified!');
                                $('#login-button').text('Login');
                                $('#logform')[0].reset();
                                $('#myalert').hide();
                                $('#alerttext').hide();
                                $('#myalert2').hide();
                                $('#alerttext2').hide();
                                setTimeout(function() {
                                    window.location = '/admin_panel/dashboard.php';
                                }, 1000);
                            }  else {
                                $('#myalert').slideDown();
                                $('#alerttext').html(data);
                                $('#logtext').text('Login');
                                $('#logform')[0].reset();
                                $('#myalert2').hide();
                                $('#alerttext3').hide();

                            }
                        }
                    });
                }, 1000);
            } else {
                $('#myalert2').slideDown();
                $('#myalert').hide();
                $('#alerttext3').hide();
                $('#myalert2').html('<div class="alert alert-warning err_msg"><i class="fa fa-info"></i> Please input both fields</div>');
                $('#logtext').text('Login');
                $('#logform')[0].reset();

            }
        });
	</script>
</body>
</html>

