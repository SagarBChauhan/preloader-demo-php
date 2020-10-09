<!doctype html>
<html>
<head lang="en">
<meta charset="utf-8">
<title>Ajax File Upload with jQuery and PHP</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="../../Trip_and_Turn_2.0/assets/js/plugins/bootstrap-notify.js" type="text/javascript"></script>   
<link href="../../Trip_and_Turn_2.0/assets/font-awesome-animation/font-awesome-animation.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row" align="center">
        <div class="col-md-8">            
            <div id="err"></div>
            <form id="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <img src="default-avatar.png" />
                    <input id="uploadImage" type="file" accept="image/*" name="image" />
                    <input class="btn btn-success" type="submit" value="Upload">
                </div>
            </form>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function (e) {
            $("#form").on('submit',(function(e) {
             e.preventDefault();
                $.ajax({
                    url: "ajaxupload.php",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend : function()
                    {
                     $("#preview").fadeOut();
                     $("#err").fadeOut();
                    },
                    success: function(data)
                    {
                        if(data=='invalid')
                        {
                            $("#err").html("Invalid File !").fadeIn();
                            fail()
                        }
                        else if(data=='no')
                        {
                            $("#form")[0].reset();
                            fail()
                        }
                        else
                        {
                            $("#form")[0].reset();
                            success()
                        }
                    },
                    error: function(e) 
                    {
                        $("#err").html(e).fadeIn();
                    }          
                });
            }));
        });
    </script>
    <script>        
        function success(){
        var notify = $.notify('<strong>Uploading.. <i class="fas fa-long-arrow-alt-up faa-bounce animated"></i></strong> Do not close this page...', {
            allow_dismiss: false,
            showProgressbar: true
        });

        setTimeout(function() {
            notify.update({'type': 'success', 'message': '<strong>Success <i class="fas fa-check faa-burst animated"></i></strong> Your page has been saved!', 'progress': 25});
        }, 2000);
        setTimeout(function() {
            $.notify("Profile picture upload successful <i class='fas fa-check faa-burst animated faa-fast'></i>");
        }, 2000);
        
        }
        function fail(){
        var notify = $.notify('<strong>Saving</strong> Do not close this page...', {
            allow_dismiss: false,
            showProgressbar: true
        });

        setTimeout(function() {
            notify.update({'type': 'danger', 'message': '<strong>Failed</strong> Your page has been saved!', 'progress': 25});
        }, 4500);
        }
    </script>
</body>
</html>