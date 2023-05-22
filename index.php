<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
             $("#myDataTable").DataTable({
              "lengthMenu": [[3, 10, 15, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
             });
             
         });
         
    </script>

    <title>Smart Attendance</title>
    
    <style>
		body{
			background-image: url("img/wave.png");
            background-repeat: no-repeat;
            background-size: 100% 200vh;
     
		}
    
	</style>
  </head>
  <body>
  <div class="container">
<div class="row">
  <div class="col-md-6 mt-4">
    <div class="">
        <img src="img/profile.png" id="view_photo" style="border-radius:50%; width:500px; height:500px; margin-top:5%; z-index:1;">
    </div>
  </div>
  <div class="col-md-6" style="margin-top:10%">
		<div class="login-content">
          <a href="visitors_registration.php" style="padding:5px;border:1px solid black;background-color:#20c997;color:#fff;border:none;text-decoration:none;border-radius:2px 2px 2px 2px">Visitor</a>
          <p class="card-text mt-4">
                <!-- <div id="mgs-add"></div> -->
                <input type="text" class="form-control" name="" id="rfidcard">
        
                <!-- <div class="card-body">
                    <p id="fname"></p>
                    <p id="lname"></p>
                </div> -->
           
                     <div class="center">
                     <center><h2 class="title"><span id="view_time"></span></h2>
                        <h2 class="title" id="view_member_name"></h2>
                        <h6>Name</h6>
                        <h2 class="title" ><span id="view_gradelevel_id"></span></h2>
                        <h6>Classification</h6></center>
              
                     </div>
                        

                <script>
                     $(document).ready(function(){
                      $('#rfidcard').focus();
        
                    $('body').mousemove(function(){
                
                        var fridcard = $('#rfidcard').focus();
                    });
                 $('#rfidcard').on('change', function(){
                    
                        var member_rfid = $('#rfidcard').val();
                        myfunction(member_rfid);//argument

                          $.ajax({
                            url: 'config/controller/add_attendance.php',
                              type: "POST",
                              data:{member_rfid:member_rfid},
                              async: false,
                              cache: false,
                            success: function(response) {
                              console.log(response);
                            
                              $("#mgs-add").html(response);
                              $("#view_time").html(response);
                              $('#mgs-add').animate({ scrollTop: 0 }, 'slow');
                              },
                              error: function(response) {
                                console.log("Failed");
                              }
                          });

                        $('#rfidcard').val("");
                     
                   });
                   
                });
       
                    
                </script>
                   <script>
                     function myfunction(member_rfid){
    
                          $.ajax({
                                    type: 'POST',
                                    url: 'config/controller/row_attendance.php',
                                    data: {
                                        member_rfid: member_rfid
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                       
                                    if (response.member_status =='active'){
                                   
                                      $('#view_member_rfid').text(response.member_rfid);
                                      $('#view_member_name').text(response.member_name);
                                      $('#view_gradelevel_id').text(response.gradelevel_id);
                                      if(response.member_image == ""){
                                          $('#view_photo').attr("src", "../img/profile.png"); 
                                      }else{
                                          $('#view_photo').attr("src", response.member_image.slice(3));
                                      }
                                    }else{
                                      
                                    }

                                }
                            });            
                        }
                   </script>
                
            <br><br>
            <div class="table-responsive">
                    <table class="table table-bordered" id="myDataTable">
                      <thead>
                        <tr>
                          <th scope="col">Photo</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">Time In</th>
                          <th scope="col">Time Out</th>
                          <th scope="col">Date logged</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php
                         require_once "config/rfid_class.php";
                          $conn = new rfid_attendance();
                          $rfid_no = $conn->FetchAttendance_index();
                         foreach ($rfid_no as $row) { 
                          $pic = substr($row['member_image'],3);
                             if($pic == "../uploads/"){
                                $image = "uploads/default/depositphotos_531920820-stock-illustration-photo-available-vector-icon-default.jpg";
                              }else{
                                $image = $pic;
                              }
                          ?>
                        <tr>
                          <td><center><img src="<?php echo $image;?>" width="50px" height="50px" ></center></td>
                          <td><?= htmlentities($row['member_name']); ?></td>
                         <td><?= date("g:i a", strtotime(htmlentities($row['time_in']))); ?></td>
                          <td>
                             <?php if (empty(htmlentities($row['time_out']))) {
                                echo "";
                               }else{
                                  echo date("g:i a", strtotime(htmlentities($row['time_out'])));
                               }

                              ?></td>

                          <td><?= htmlentities(date("M d, Y",strtotime($row['logdate']))); ?></td>
                        </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
  </body>
</html>