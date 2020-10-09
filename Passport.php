<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1' name='viewport' />
        <title></title>
        <link href="bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <style>
            .error{
                fon-size:10pt;
                color: darkred;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h1>Fill</h1>
        <form name="passportForm" method="post" id="passportForm">
            <div class="form-row">
                <div class="form-group  bmd-form-group col-md-4 has-info">
                    <label for="firstname" class="bmd-label-floating" >firstname</label>
                    <input name="firstname" id="firstname"  type="text" class="form-control"   value="<?php if (isset($_SESSION['fname'])){echo $_SESSION['fname'];} ?>">
                </div>
                <div class="form-group  bmd-form-group col-md-4 has-info">
                    <label for="middlename" class="bmd-label-floating" >middlename</label>
                    <input name="middlename" type="text" class="form-control" value="<?php if (isset($_SESSION['mname'])){echo $_SESSION['mname'];} ?>">

                </div>
                <div class="form-group  bmd-form-group col-md-4 has-info">
                    <label for="lastname" class="bmd-label-floating" >lastname</label>
                    <input name="lastname" type="text" class="form-control"  value="<?php if (isset($_SESSION['lname'])){echo $_SESSION['lname'];} ?>">
                </div>
                <div class="form-group  bmd-form-group col-md-4 has-info">
                    <label class="label-control pr-5">Gender:</label>
                    <div class="form-check form-check-radio  form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" checked>
                            Male
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check form-check-radio  form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="Female" >
                            Female
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="form-group bdm-form-group col-md-4">   
                    <label for="DOB" class="label-control">DOB</label>
                    <input type="text" id='DOB' name="DOB"  class="form-control datetimepicker" value="01/01/2001"/>
                </div>
                <div class="input-group mb-3 col-md-4">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-info btn-sm" type="button">Upload Birth Proof</button>
                  </div>
                  <div class="custom-file border mt-1 pt-1 pb-5">
                    <input type="file" class="custom-file-input">
                    <label class="custom-file-label" for="inputGroupFile03">Choose file..</label>
                  </div>
                </div>
                <div class="form-group bdm-form-group col-md-8">
                    <label for="address"  class="bmd-label-floating">Address</label>
                    <input type="text" id='address' name="address"  class="form-control"/>
                </div> 
                <div class="form-group col-md-4">
                    <label for="pincode"  class="bmd-label-floating" >Pin code</label>
                    <input type="text" id='pincode' name="pincode" class="form-control"/>
                </div>
<!--                <div class="form-group col-md-4">
                    <label for="country" >country</label>
                    <select  name="country" id="country-list" onChange="getState(this.value);"  class="custom-select">
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
                </div>                                -->
                <div class="form-group col-md-4">
                    <label for="state">State</label>             
                    <select name="state" id="state-list"  onChange="getCity(this.value);" class="custom-select">
                        <option value disabled selected>Select State</option>
                    </select>
                </div>                                
                <div class="form-group col-md-4">
                    <label for="city">City</label>
                    <select name="city" id="city-list" class="custom-select" required>
                    <option value="">Select City</option>
                    </select>
                </div>                
                <div class="input-group mb-3 col-md-4">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-info btn-sm " type="button">Upload Residence proof</button>
                  </div>
                  <div class="custom-file border mt-1 pt-1 pb-5">
                    <input type="file" class="custom-file-input">
                    <label class="custom-file-label" for="inputGroupFile03">Choose file..</label>
                  </div>
                </div>
                <div class="form-group  bmd-form-group col-md-8 has-info">
                    <label for="addharno" class="bmd-label-floating" >addhar number</label>
                    <input name="addharno" type="text" class="form-control" value="" >                        
                </div>
                <div class="input-group mb-3 col-md-4">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-info btn-sm" type="button">Upload Residence proof</button>
                  </div>
                  <div class="custom-file border mt-1 pt-1 pb-5">
                    <input type="file" class="custom-file-input">
                    <label class="custom-file-label" for="inputGroupFile03">Choose file..</label>
                  </div>
                </div>
                <div class="form-group  bmd-form-group col-md-6 has-info">
                    <label for="email" class="bmd-label-floating" >email</label>
                    <input name="email" type="email" class="form-control" value="">                        
                </div>
                <div class="form-group  bmd-form-group col-md-6 has-info">
                    <label for="contact" class="bmd-label-floating" >contact</label>
                    <input name="contact" type="text" class="form-control" value="">
                </div> 
                <div class="form-group col-md-6">
                    <label for="city">Mode</label>
                    <select name="city" id="city-list" class="custom-select" required>
                        <option value="" disabled>Select Mode</option>
                        <option value="">Normal</option>
                        <option value="">Fast</option>
                    </select>
                </div>  
            </div>
    
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" value="">
                  <a href="" >Accept Terms and Conditions</a>
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-info">Next</button>
        </form>
        
    </div>
        <script src="jquery-1.11.1.js" type="text/javascript"></script>
        <script src="bootstrap.min.js" type="text/javascript"></script>
        <script src="jquery.validate.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function (){
                $("#myform").validate({
                    rules:{
                        firstname:{
                            required:true
                        },
                        middlename:{
                            required:true
                        },
                        lastname:{
                            required:true
                        }
                    },
                    messages:{
                        Password:{
                            required:"Password is required"
                        }
                    },
                    submitHandler:subform
                    
                })
            })
        </script>        
        <script type="text/javascript">
    $( document ).ready( function () {
            $( "#passportForm" ).validate( {
                    rules: {
                            firstname: {
                                    required: true,
                                    minlength: 4
                            },
                            email: {
                                    required: true,
                                    email: true
                            },
                            contatct: {
                                    required: true,
                                    minlength: 10,
                                    maxlength:10,
                                    number:true
                            },
                            subject: {
                                    required: true,
                            },
                            message: {
                                    required: true,
                                    minlength: 5,
                                    maxlength:999
                            }
                    },
                    messages: {
                            firstname: {
                                    required: "<div style='width: 100%; color: red;  font-size: small;'>*Please enter a name</div>",
                                    minlength: "<div style='width: 100%; color: red; font-size: small;'>*Your name must consist of at least 4 characters</div>"
                            },
                            email: "<div style='width: 100%; color: red; font-size: small;'>*Please enter a valid email address</div>",
                            contatct: {
                                    required: "<div style='width: 100%; color: red; font-size: small;'>*Please provide a contact number</div>",
                                    minlength: "<div style='width: 100%; color: red; font-size: small;'>*Your contact number must be only 10 number long</div>",
                                    maxlength: "<div style='width: 100%; color: red; font-size: small;'>*Your contact number must be only 10 number long</div>",
                                    number: "<div style='width: 100%; color: red; font-size: small;'>*only numbers allowd</div>"
                            },
                            subject: {
                                    required: "<div style='width: 100%; color: red; font-size: small;'>*Please select any subject</div>",
                            },                                        
                            message: {
                                    required: "<div style='width: 100%; color: red; font-size: small;'>*Please provide a message</div>",
                                    minlength: "<div style='width: 100%; color: red; font-size: small;'>*Your message must be at least 5 characters long</div>",
                                    maxlength: "<div style='width: 100%; color: red; font-size: small;'>*Your message must be less then 1000 characters long</div>"
                            }                                        
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element)
                    },
                    submitHandler:subform
            } );
    } )
            function subform(){
                var data =$("#passportForm").serialize();
                $.ajax({
                    type: 'POST',
                    url: "operations/database.php",
                    data: data,
                    beforeSend: function () {
                        $("#info").fadeOut();
                        $("#btn_Send_Msg").html("Sending Message &nbsp; <span class='fab fa-telegram-plane faa-passing animated'></span>");
                    },
                    success: function (resp) {
                        if(resp=="ok"){                            
                            $("#info").html("<div class='alert alert-success ml-auto mr-auto '><div class='container'><div class='alert-icon'><i class='material-icons faa-burst faa-fast animated'>check</i></div><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'><i class='material-icons'>clear</i></span></button>Message sent</div></div></div>");
                            $("#btn_Send_Msg").html("Message sent &nbsp; <i class='material-icons faa-burst faa-fast animated'>check</i>");
                        }
                        else
                        {
                            $("#btn_Send_Msg").html("Retry  &nbsp;<i class='fas fa-redo faa-spin'></i>");
                            $("#info").fadeIn(1000,function (){
                                $("#info").html("<div class='alert alert-danger ml-auto mr-auto '><div class='container'><div class='alert-icon'><i class='material-icons faa-burst faa-fast animated'>error_outline</i></div><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'><i class='material-icons'>clear</i></span></button>Message not sent,"+resp+"</div></div></div>");
                                $("#btn_Send_Msg").html('login');
                            })
                        }
                    }
                })
            }

        </script>
        <!--Ajax enquiry ends-->
    </body>
</html>
