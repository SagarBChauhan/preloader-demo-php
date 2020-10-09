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
        <div class="container" style="margin: 200px auto; margin-left: 300px;">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panal-body">
                            <div id="info"></div>
                            <form method="POST" id="myform">
                                <div class="form-group">
                                    <label for="username" >Username</label>
                                    <input type="text" id='User_Name' name="User_Name" placeholder="Enter your username" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="password" >Password</label>
                                    <input type="text" id='Password' name="Password" placeholder="Enter your password" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id='login' name="login" class="btn btn-primary">Login</button>
                                </div>
                            </form>                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <script src="jquery-1.11.1.js" type="text/javascript"></script>
        <script src="bootstrap.min.js" type="text/javascript"></script>
        <script src="jquery.validate.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function (){
                $("#myform").validate({
                    rules:{
                        Password:{
                            required:true
                        },
                        User_Name:{
                            required:true,
                        }
                    },
                    messages:{
                        Password:{
                            required:"Password is required"
                        },
                        User_Name:"username is requiered"
                    },
                    submitHandler:subform
                    
                })
                function subform(){
                    var data =$("#myform").serialize();
                    $.ajax({
                        type: 'POST',
                        url: "data.php",
                        data: data,
                        beforeSend: function () {
                            $("#info").fadeOut();
                            $("#login").html("Sending...");
                        },
                        success: function (resp) {
                            if(resp=="ok"){
                                $("#login").html("<i class='fas fa-spinner fa-spin'></i> &nbsp; Login");
                                setTimeout('window.location.href="deshbord.php";',4000);
                            }
                            else
                            {
                                $("#info").fadeIn(1000,function (){
                                    $("#info").html("<div class='alert alert-danger'>"+resp+"</div>");
                                    $("#login").html('login');
                                })
                            }
                        }
                    })
                }
            })
        </script>
    </body>
</html>
