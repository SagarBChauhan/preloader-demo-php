<?php 
session_start();
include './Connection.php';
if (isset($_GET['restart']))
{
    session_destroy();
}
date_default_timezone_set('Asia/Calcutta'); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1' name='viewport' />
        <title></title>
        <link href="bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
               <link href="font-awesome-animation/font-awesome-animation.min.css" rel="stylesheet" type="text/css"/>
               <link href="../Trip_and_Turn_2.0/assets/css/My.css" rel="stylesheet" type="text/css"/>
        <style>
            .error{
                fon-size:10pt;
                color: darkred;
            }
        </style>
    </head>
    <body onload="myFunction()">
    <div id="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">
    
        <nav class="navbar navbar-light bg-light justify-content-end shadow fixed-top">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="?restart=y"><i class="fas fa-redo"> Fresh Start </i></a>
                </li>
            </ul>
        </nav>
    
        <div id="mail" class="container" style="margin:90px auto; margin-left: 300px;">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panal-body">
                            <p>Time Now: <?php if (isset($_SESSION['expire'])){echo date('d/m/Y h:m:s',  time(date('d/m/Y h:m:s')));} ?></p>
                            <p>expire Time: <?php if (isset($_SESSION['expire'])){echo date('d/m/Y h:m:s',$_SESSION['expire']) ;} ?></p>
                            <div id="info"></div>
                            <form method="Post" id="Registration_Form_Step1" >
                                <div class="form-group">
                                    <label>First Name <small>(required)</small></label>
                                    <input name="firstname" type="text" class="form-control" placeholder="your firstname..."  value="<?php if (isset($_SESSION['fname'])){echo $_SESSION['fname'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Middle Name <small>(required)</small></label>
                                    <input name="middlename" type="text" class="form-control" placeholder="your middlename..." value="<?php if (isset($_SESSION['mname'])){echo $_SESSION['mname'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Last Name <small>(required)</small></label>
                                    <input name="lastname" type="text" class="form-control" placeholder="your lastname..." value="<?php if (isset($_SESSION['lname'])){echo $_SESSION['lname'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email <small>(required)</small></label>
                                    <input name="email" type="email" class="form-control" placeholder="example@abc.com" value="<?php if (isset($_SESSION['email'])){echo $_SESSION['email'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Contact number <small>(required)</small></label>
                                    <input name="contact" type="text" class="form-control" placeholder="Contact number" value="<?php if (isset($_SESSION['contactNo'])){echo $_SESSION['contactNo'];} ?>">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="btn_send" id='btn_send' class='btn btn-success btn-wd'> Send OTP  </button>
                                    <?php if(isset($_SESSION['OTP'])){ ?>
                                    <button type="button" name="btn_next" id='btn_next' class='btn btn-warning btn-wd' onclick="next()"> I have OTP <i class="fas fa-angle-double-right"></i></button>    
                                    <?php } ?>
                                </div>
                            </form>                    
                        </div>
                    </div>
                </div>         
            </div>
        </div>
      
        <div id="OTP" class="container" style="margin:90px auto;">
            <div class="row justify-content-center mt-5">
                <div class="card shadow col-md-6">
                    <article class="card-body">
                        <div id="dis">
                            <h4 class="card-title mb-4 mt-1">Confirm OTP</h4>
                            <hr>
                            <p id="recipient">The OTP is sent to your Registered Email address : <?php if(isset( $_SESSION['email'])){echo $_SESSION['email'];} ?></p>
                            <p >Your OTP will be expired in 2 min(s), Please confirm OTP sooner.</p>
                            <p id="timer"></p>

                            <div id="info2"><?php  if(isset($_SESSION['OTP'])){ echo $_SESSION['OTP']; }?></div>
                            <form method="POST" id="Registration_Form_Step2">
                                <div class="form-group">
                                    <label for="OTP" >OTP</label>
                                    <input type="number" id='uotp' name="uotp"  placeholder="Enter your otp" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id='btn_Confirm' name="btn_Confirm" class="btn btn-primary">Confirm OTP</button>
                                    <button type="button" id='btn_Resend' name="btn_Resend" class="btn btn-primary">Resend OTP <i class="fas fa-redo"></i></button>
                                </div>
                            </form> 
                        </div>
                        <button type="submit" name="btn_prev" id='btn_prev' class='btn btn-warning btn-wd float-left' onclick="perv()"> <i class="fas fa-chevron-left"></i> Back  </button>    
                        <button type="submit" name="btn_next3" id='btn_next3' class='btn btn-warning btn-wd float-right' onclick="next3()"> Next <i class="fas fa-chevron-right"></i>  </button>    
                    </article>
                </div> <!-- card.// -->
            </div> <!-- row.// -->
        </div> 
        <div id="credential" class="container" style="margin:90px auto;">
            <div class="row justify-content-center mt-5">
                <div class="card shadow col-md-6">
                    <article class="card-body">
                            <h4 class="card-title mb-4 mt-1">Credential</h4>
                            <hr>
                            <div id="info3"></div>
                            <form method="POST" id="Registration_Form_Step3">
                                <div class="form-group ">
                                    <label for="username" >Username</label>
                                    <input type="text" id='username' name="username" onchange="checkUsername(this.value)"  placeholder="Enter username" class="form-control"/>
                                    <div id="txtHint" style="width: 100%; font-size: small;">select username</div>
                                </div>
                                <div class="form-group">
                                    <label for="password" >Password</label>
                                    <input type="password" id='password' name="password"  placeholder="Enter password" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="confirmpassword" >Confirm password</label>
                                    <input type="password" id='confirmpassword' name="confirmpassword"  placeholder="Confirm password" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id='btn_Save' name="btn_Save" class="btn btn-primary" disabled>Save</button>
                                </div>
                            </form> 
                        <button type="submit" name="btn_prev2" id='btn_prev2' class='btn btn-warning btn-wd float-left' onclick="perv2()"> <i class="fas fa-chevron-left"></i> Back  </button>    
                        <button type="submit" name="btn_next4" id='btn_next4' class='btn btn-warning btn-wd float-right' onclick="next4()"> Next <i class="fas fa-chevron-right"></i>  </button>    
                    </article>
                </div> <!-- card.// -->
            </div> <!-- row.// -->
        </div> 
        <div id="register" class="container" style="margin:90px auto;">
            <div class="row justify-content-center mt-5">
                <div class="card shadow col-md-6">
                    <article class="card-body">
                            <h4 class="card-title mb-4 mt-1">Register</h4>
                            <hr>
                            <div id="info4"></div>
                            <form method="POST" id="Registration_Form_Step4">
                                <div class="form-group">
                                    <label for="DOB" >DOB</label>
                                    <input type="date" id='DOB' name="DOB"  class="form-control"/>
                                </div>
                                <div class="form-group">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" checked>
                                        <label class="form-check-label" for="male">
                                          Male
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="Female">
                                        <label class="form-check-label" for="female">
                                          Female
                                        </label>
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" >Address</label>
                                    <input type="text" id='address' name="address"  placeholder="Address" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="country" >country</label>
                                    <select  name="country" id="country-list" onChange="getState(this.value);"  class="form-control">
                                        <option value disabled selected>Select Country</option>
                                        <?php
                                        $results=  mysqli_query($con, "SELECT * FROM `tbl_country`;");
                                        foreach($results as $country) {
                                        ?>
                                        <option value="<?php echo $country["Country_Id"]; ?>"><?php echo $country["Name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>             
                                    <select name="state" id="state-list"  onChange="getCity(this.value);" class="form-control">
                                        <option value disabled selected>Select State</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select name="city" id="city-list" class="custom-select d-block w-100" required>
                                    <option value="">Select City</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pincode" >Pin code</label>
                                    <input type="text" id='pincode' name="pincode"  placeholder="Pin" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id='btn_Register' name="btn_Register" class="btn btn-primary">Register</button>
                                </div>
                            </form> 
                        <button type="submit" name="btn_prev3" id='btn_prev3' class='btn btn-warning btn-wd float-left' onclick="perv3()"> <i class="fas fa-chevron-left"></i> Back  </button>    
                        <button type="submit" name="btn_finish" id='btn_finish' class='btn btn-warning btn-wd float-right' onclick="finish()"> finish <i class="fas fa-chevron-right"></i>  </button>    
                    </article>
                </div> <!-- card.// -->
            </div> <!-- row.// -->
        </div> 
</div>
        <script src="jquery-1.11.1.js" type="text/javascript"></script>
        <script src="bootstrap.min.js" type="text/javascript"></script>
        <script src="jquery.validate.min.js" type="text/javascript"></script>  
        
        <script src="../Trip_and_Turn_2.0/assets/js/loader.js" type="text/javascript"></script>
        
        <!--Count Down-->
        <script>
            function countDown(min){
            // Set the date we're counting down to
            var countDownDate = new Date().getTime()+ (min*60000);

            // Update the count down every 1 second
            var x = setInterval(function() {

              // Get todays date and time
              var now = new Date().getTime();

              // Find the distance between now and the count down date
              var distance = countDownDate - now;

              // Time calculations for days, hours, minutes and seconds
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);

              // Output the result in an element with id="demo"
              document.getElementById("timer").innerHTML =minutes + "m " + seconds + "s ";

              // If the count down is over, write some text 
              if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "EXPIRED";
              }
            }, 1000);
            }
        </script>
        <!--Count Down ends-->
        
        
        <!--Custom Navigation-->
        <script>
                $("#mail").show();
                $("#OTP").hide();
                $("#credential").hide();
                $("#register").hide();
            function next(){
                $("#mail").hide();
                $("#OTP").show();
                $("#credential").hide();
                $("#register").hide();
            }
            function perv(){
                $("#mail").show();
                $("#OTP").hide();
                $("#credential").hide();
                $("#register").hide();
            }
            function next3(){
                $("#mail").hide();
                $("#OTP").hide();
                $("#credential").show();
                $("#register").hide();
            }
            function perv2(){
                $("#mail").hide();
                $("#OTP").show();
                $("#credential").hide();
                $("#register").hide();
            }
            function next4(){
                $("#mail").hide();
                $("#OTP").hide();
                $("#credential").hide();
                $("#register").show();
            }
            function perv3(){
                $("#mail").hide();
                $("#OTP").hide();
                $("#credential").show();
                $("#register").hide();
            }
            
            
        </script>
        <!--Custom Navigation ends-->
  
      
        <!--Registration Step 1-->
        <script>
        $(document).ready(function (){
            $("#OTP").hide();
            $("#Registration_Form_Step1").validate({
                rules:{
                    firstname: {
                            required: true,
                            minlength: 3
                    },
                    middlename: {
                            required: true,
                            minlength: 3
                    },
                    lastname: {
                            required: true,
                            minlength: 3
                    },
                    email: {
                            required: true,
                            email: true
                    },
                    contact: {
                            required: true,
                            minlength:10,
                            maxlength:10,
                            number:true
                    }
                },
                messages:{
                    firstname: {
                            required: "<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Please enter a firstname</span>",
                            minlength: "<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Your firstname must consist of at least 3 characters </span>"
                    }
,
                    middlename: {
                            required: "<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Please enter a middlename</span>",
                            minlength: "<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Your middlename must consist of at least 3 characters </span>"
                    },
                    lastname: {
                            required: "<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Please enter a lastname</span>",
                            minlength: "<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Your lastname must consist of at least 3 characters </span>"
                    },
                    email: {
                            required: "<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Please enter a email</span>",
                            email: "<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Your email must be vaild </span>"
                    },
                    contact: {
                            required: "<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Please enter a contact number</span>",
                            minlength:"<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Your lastname must 10 numbers long</span>",
                            maxlength:"<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Your lastname must 10 numbers long</span>",
                            number:"<p class='text-danger mr-2 mt-3'>&larr; &#9888;<p><span class='notification-error'>&#9888; Please enter numbers only</span>"
                    }
                },
                submitHandler:subform

            })
            function subform(){
                var data =$("#Registration_Form_Step1").serialize();                
                $.ajax({
                    type: 'POST',
                    url: "Registration.php?resend=y",
                    data: data,
                    beforeSend: function () {
                        $("#info").fadeOut();
                        $("#btn_send").html("Sending &nbsp; <i class='fas fa-envelope faa-passing animated'></i>");
                    },
                    success: function (resp) {
                        if(resp=="ok"){
                            $("#btn_send").html("OTP sent &nbsp; <i class='fas fa-check faa-burst faa-fast animated'></i>");
//                            setTimeout('window.location.href="Ajax_confirm_OTP.php";',4000);
                            $("#mail").hide();
                            $("#OTP").show();
                            countDown(2);
                        }
                        else if((resp=="registered"))
                        {
                            $("#info").fadeIn(1000,function (){
                                $("#info").html("<div class='alert alert-danger'>Email address you entered,<br> is already registered.<br> Please try to <a href='../Trip_and_Turn_2.0/Login.php'>login</a> instead</div>");
                                $("#btn_send").html('Send OTP');
                            })
                        }
                        else if((resp=="no"))
                        {
                            $("#info").fadeIn(1000,function (){
                                $("#info").html("<div class='alert alert-danger'>"+resp+"</div>");
                                $("#btn_send").html('Send OTP');
                            })
                        }
                    }
                })
            }
        })
        </script>
        <!--Registration Step 1 ends-->

        <!--OTP resend-->
        <script>
        $(document).ready(function(){
          $("#btn_Resend").click(function(){
                var data =$("#Registration_Form_Step1").serialize();
                $.ajax({
                    type: 'POST',
                    url: "Registration.php",
                    data: data,
                    beforeSend: function () {
                        $("#info2").fadeOut();
                        $("#btn_Resend").html("Resending &nbsp; <i class='fas fa-envelope faa-passing animated'></i>");
                    },
                    success: function (resp) {
                        if(resp=="ok"){
                            $("#btn_Resend").html("OTP Resent &nbsp; <i class='fas fa-check faa-burst faa-fast animated'></i>");
//                            setTimeout('window.location.href="Ajax_confirm_OTP.php";',4000);
                            $("#mail").hide();
                            $("#OTP").show();
                            countDown(2);
                        }
                        else if((resp=="registered"))
                        {
                            $("#info2").fadeIn(1000,function (){
                                $("#info2").html("<div class='alert alert-danger'>Email address you entered,<br> is already registered.<br> Please try to <a href='../Trip_and_Turn_2.0/Login.php'>login</a> instead</div>");
                                $("#btn_Resend").html('Resend OTP <i class="fas fa-redo"></i>');
                            })
                        }
                        else
                        {
                            $("#info2").fadeIn(1000,function (){
                                $("#info2").html("<div class='alert alert-danger'>"+resp+"</div>");
                                $("#btn_Resend").html('Resend OTP <i class="fas fa-redo"></i>');
                            })
                        }
                    }
                })
          });
        });
        </script>
        <!--Otp Resend ends-->
        
        <!--Registration Step 2-->
        <script>
            $(document).ready(function (){
                $("#Registration_Form_Step2").validate({
                    rules:{
                        uotp:{
                            required:true,
                            minlength:6,
                            maxlength:6
                        }
                    },
                    messages:{
                        uotp:{
                            required:"otp is required",
                            minlength:"otp must be 6 number long",
                            maxlength:"otp must be 6 number long",
                        }
                    },
                    submitHandler:subform
                    
                })
                function subform(){
                    var data =$("#Registration_Form_Step2").serialize();
                    $.ajax({
                        type: 'POST',
                        url: "Registration.php",
                        data: data,
                        beforeSend: function () {
                            $("#info2").fadeOut();
                            $("#btn_Confirm").html("Checking &nbsp; <i class='fas fa-spinner fa-spin'>");
                        },
                        success: function (resp) {
                            if(resp=="ok"){
                                $("#btn_Confirm").html("Correct &nbsp; <i class='fas fa-check faa-burst faa-fast animated'></i>");
                                //setTimeout('window.location.href="deshbord.php";',4000);
                                $("#OTP").hide();
                                $("#credential").show();
                            }
                            else if(resp=="no")
                            {
                                $("#info2").fadeIn(1000,function (){
                                    $("#info2").html("<div class='alert alert-danger'>Incorrect OTP, Please Try again..</div>");
                                    $("#btn_Confirm").html('Confirm OTP');
                                })
                            }
                            else if(resp=="expiered")
                            {
                                $("#info2").fadeIn(1000,function (){
                                    $("#info2").html("<div class='alert alert-danger'> Your OTP might be expired, you should Restart"+resp+"</div>");
                                    $("#btn_Confirm").hide();
                                })
                            }
                            else
                            {
                                $("#info2").fadeIn(1000,function (){
                                    $("#info2").html("<div class='alert alert-danger'> Unknown error "+resp+"</div>");
                                    $("#btn_Confirm").html('Confirm OTP');
                                })
                            }
                        }
                    })
                }
            })
        </script>
        <!--Registration Step 2 ends-->
        
        <!--Registration Step 3-->
        <script>
            $(document).ready(function (){
                $("#Registration_Form_Step3").validate({
                    rules:{
                        username:{
                            required:true,
                            minlength:3
                        },
                        password:{
                            required:true,
                            minlength:5
                        },
                        confirmpassword:{
                            required:true,
                            minlength:5,
                            equalTo: "#password"
                        }
                    },
                    messages:{
                        username:{
                            required:"username is required",
                            minlength:"username must be at lest 3 character long"
                        },
                        password:{
                            required:"password is required",
                            minlength:"password must be at lest 5 character long"
                        },
                        confirmpassword:{
                            required:"confirm password is required",
                            minlength:"confirm password must be at lest 5 character long",
                            equalTo: "confirm password must same as password"

                        }
                    },
                    submitHandler:subform
                    
                })
                function subform(){
                    var data =$("#Registration_Form_Step3").serialize();
                    $.ajax({
                        type: 'POST',
                        url: "Registration.php",
                        data: data,
                        beforeSend: function () {
                            $("#info3").fadeOut();
                            $("#btn_Save").html("Saving &nbsp; <i class='fas fa-spinner fa-spin'>");
                        },
                        success: function (resp) {
                            if(resp=="ok"){
                                $("#btn_Save").html("Saved &nbsp; <i class='fas fa-check faa-burst faa-fast animated'></i>");
                                //setTimeout('window.location.href="deshbord.php";',4000);
                                $("#credential").hide();
                                $("#register").show();
                            }
                            else if(resp=="unavailable")
                            {
                                $("#info3").fadeIn(1000,function (){
                                    $("#info3").html("<div class='alert alert-danger'> Username Unavailable, Please Try again..</div>");
                                    $("#btn_Save").html('Save');
                                })
                            }
                            else if(resp=="no")
                            {
                                $("#info3").fadeIn(1000,function (){
                                    $("#info3").html("<div class='alert alert-danger'>Failed to save "+resp+", Please Try again..</div>");
                                    $("#btn_Save").html('Save');
                                })
                            }
                        }
                    })
                }
            })
        </script>
        <!--Registration Step 3 ends-->
        
        <!--Registration Step 4-->
        <script>
            $(document).ready(function (){
                $("#Registration_Form_Step4").validate({
                    rules:{
                        address:{
                            required:true,
                            minlength:3
                        },
                        country:{
                            required:true
                        },
                        state:{
                            required:true
                        },
                        city:{
                            required:true
                        },
                        pincode:{
                            required:true,
                            minlength:6,
                            maxlength:6,
                            number:true
                        }
                    },
                    messages:{
                        address:{
                            required:"address is required",
                            minlength:"address must be at lest 3 character long"
                        },
                        country:{
                            required:"country is required"
                        },
                        state:{
                            required:"state is required"
                        },
                        city:{
                            required:"city is required"
                        },
                        pincode:{
                            required:"pincode is required",
                            minlength:"pincode must be 6 numbers long"

                        }
                    },
                    submitHandler:subform
                    
                })
                function subform(){
                    var data =$("#Registration_Form_Step4").serialize();
                    $.ajax({
                        type: 'POST',
                        url: "Registration.php",
                        data: data,
                        beforeSend: function () {
                            $("#info4").fadeOut();
                            $("#btn_Register").html("Recoading &nbsp; <i class='fas fa-spinner fa-spin'>");
                        },
                        success: function (resp) {
                            if(resp=="ok"){
                                $("#btn_Register").html("Recoded &nbsp; <i class='fas fa-check faa-burst faa-fast animated'></i>");
                                //setTimeout('window.location.href="deshbord.php";',4000);
                            }
                            else
                            {
                                $("#info4").fadeIn(1000,function (){
                                    $("#info4").html("<div class='alert alert-danger'>Failed to save "+resp+", Please Try again..</div>");
                                    $("#btn_Register").html('Register');
                                })
                            }
                        }
                    })
                }
            })
        </script>
        <!--Registration Step 4 ends-->

        <!--check username-->
        <script>
            function checkUsername(str) {
              var xhttp;  
              if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                $("#btn_Save").attr('disabled',true);
                $("#username").addClass("text-danger");
                return;
              }
              xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  if(this.responseText=='ok')
                  {
                    document.getElementById("txtHint").innerHTML = "<span style='color: #28a745;'>Username available</span>";
                    $("#btn_Save").attr('disabled',false);
                    $("#username").addClass("text-success");
                    $("#username").removeClass("text-danger");
                  }
                  else if(this.responseText=='no')
                  {
                    document.getElementById("txtHint").innerHTML = "<span style='color: #dc3545;'>Username not available</span>";
                    $("#btn_Save").attr('disabled',true);
                    $("#username").addClass("text-danger");                  }
                }
              };
              xhttp.open("GET", "../Tours_And_Travels/checkUsername.php?q="+str, true);
              xhttp.send();
            }
        </script>
        <!--check username ends-->
        
        <!--sync Address data-->
        <script>
            function getState(val) {
                    $.ajax({
                    type: "POST",
                    url: "Address.php",
                    data:'country_id='+val,
                    success: function(data){
                            $("#state-list").html(data);
                            getCity();
                    }
                    });
            }


            function getCity(val) {
                    $.ajax({
                    type: "POST",
                    url: "Address.php",
                    data:'state_id='+val,
                    success: function(data){
                            $("#city-list").html(data);
                    }
                    });
            }
        </script>
        <!--sync Address data ends-->
    </body>
</html>
