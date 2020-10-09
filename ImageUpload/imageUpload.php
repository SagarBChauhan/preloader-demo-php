<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1' name='viewport' />
        <title></title>
        <link href="../bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
            <label>Select Image</label>
            <input type="file" name="file" id="file">
            <br>
            <span id="uploaded_Image"></span>
            
            <div id="info"></div>
        </div>
        <script src="../jquery-1.11.1.js" type="text/javascript"></script>
        <script src="../bootstrap.min.js" type="text/javascript"></script>
        <script src="../jquery.validate.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function (){
                $(document).on("change","#file",function (){
                    var property=document.getElementById("file").files[0];
                    var Image_name=property.name;
                    var Image_extention=Image_name.split(".").pop().toLowerCase();
                    var size=property.size;
                    if(jQuery.inArray(Image_extention,['gif','png','jpg','jpeg'])== -1)
                    {
                        alert("Invalid file Extention")
                    }
                    else if(size>2000000)
                    {
                        alert("size must be less than 2mb")
                    }
                    else
                    {
                        var form_data=new FormData();
                        form_data.append("file",property);
                        $.ajax({
                            url: "operation.php",
                            type: 'POST',
                            data: form_data,
                            contentType: false,
                            processData: false,
                            cache: false,
                            beforeSend: function () {
                                $("#uploaded_Image").html("<label class='text-success'>Uploding Image...</label>");
                            },
                            success: function (data) {
                                $('#uploaded_Image').html(data);
                            }
                            
                        })
                    }
                    alert("Image Name: "+Image_name+"Image Extention"+Image_extention)
                });
            });
        </script>
        <script>
            $(document).ready(function (){
                $("#myform").validate({
                    rules:{
                        fileToUpload:{
                            required:true
                        }
                    },
                    messages:{
                        fileToUpload:{
                            required:"<br><br>Password is required"
                        }
                    },
                    submitHandler:subform
                    
                })
                function subform(){
                    var data =$("#myform").serialize();
                    $.ajax({
                        type: 'POST',
                        url: "operation.php",
                        data: data,
                        contentType: false,
                        cache: false,
                        beforeSend: function () {
                            $("#info").fadeOut();
                            $("#btn_upload").html("Uploading...");
                        },
                        success: function (resp) {
                            if(resp=="ok"){
                                $("#btn_upload").html("<i class='fas fa-spinner fa-spin'></i> &nbsp; Uploaded");
                                setTimeout('window.location.href="deshbord.php";',4000);
                            }
                            else
                            {
                                $("#info").fadeIn(1000,function (){
                                    $("#info").html("<div class='alert alert-danger'>"+resp+"</div>");
                                    $("#btn_upload").html('Upload');
                                })
                            }
                        }
                    })
                }
            })
        </script>
<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('preview');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
    </body>
</html>
