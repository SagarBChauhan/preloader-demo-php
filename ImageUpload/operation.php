<?php
include '../../Trip_and_Turn_2.0/operations/Connection.php';
session_start();
if($_FILES['file']['name']!='')
{
    $test=  explode(".", $_FILES['file']['name']);
    $extention=  end($test);
    $target_dir = "upload/Image/dp/".$_SESSION['lid'].$_SESSION['fname'].$_SESSION['lname']."/";
    if(!is_dir($target_dir))
    {
        mkdir($target_dir,0777,true);
    }
    if(file_exists($target_dir)) 
    {
        $name =  rand(100,999).'.'.$extention;
        $location=$target_dir.$name;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) 
        {        
            $sql_upload="UPDATE `tbl_user` SET `Profile_Picture`='$location',`Last_Update_Time`=NOW() WHERE `Login_id`=".$_SESSION['lid'];
            echo $sql_upload;
            $query_upload=  mysqli_query($con, $sql_upload);
            if($query_upload)
            {
                echo 'ok';
                $_SESSION['dp']=$location;
                echo '<img src="'.$location.'" height="150" width="225" class="img-thumbnail" />';            
            }
            else 
            {
                echo 'can not upload';
            }
        } 
        else 
        {
            echo 'no';
        }
    }
}



#Uploading Profile Picture
if (isset($_POST["btn_upload"]))
{
    $target_dir = "upload/Image/dp/".$_SESSION['lid'].$_SESSION['fname'].$_SESSION['lname']."/";
    if(!is_dir($target_dir))
    {
        mkdir($target_dir,0777,true);
    }
    if(file_exists($target_dir)) 
    {
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["btn_upload"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
               // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "<script>swal({ title:'Sorry!', text: 'file ". basename( $_FILES["fileToUpload"]["name"]). " File is not an image!', type: 'warning', buttonsStyling: false, confirmButtonClass: 'btn btn-warning'})</script>";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>swal({ title:'Sorry!', text: 'file ". basename( $_FILES["fileToUpload"]["name"]). " already exists!', type: 'warning', buttonsStyling: false, confirmButtonClass: 'btn btn-warning'})</script>";
            //$uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "<script>swal({ title:'Sorry!', text: 'your file is too large please try 500kb !', type: 'warning', buttonsStyling: false, confirmButtonClass: 'btn btn-warning'})</script>";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "<script>swal({ title:'Sorry!', text: 'only JPG, JPEG, PNG & GIF files are allowed!', type: 'warning', buttonsStyling: false, confirmButtonClass: 'btn btn-warning'})</script>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
//            echo "<script>swal({ title:'Sorry!', text: 'your file ". basename( $_FILES["fileToUpload"]["name"]). " was not uploaded.!', type: 'error', buttonsStyling: false, confirmButtonClass: 'btn btn-danger'})</script>";
        // if everything is ok, try to upload file
        } 
        else 
        {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
            {
                $sql_upload="UPDATE `tbl_user` SET `Profile_Picture`='$target_file',`Last_Update_Time`=NOW() WHERE `Login_id`=$lid";
                echo $sql_upload;
                $query_upload=  mysqli_query($con, $sql_upload);
                if($query_upload)
                {
                    echo 'ok';
                    $_SESSION['dp']=$target_file;
                    echo "<script>profile('".$_SESSION['dp']."','".$_SESSION['user']."','Profile Updated, <br>Looking good..','linear-gradient(304deg, rgba(79,240,197,1) 0%, rgba(179,204,138,1) 21%, rgba(7,245,138,1) 47%, rgba(106,217,193,1) 59%, rgba(13,209,174,1) 74%, rgba(80,226,255,1) 100%);','light')</script>";
                    echo "<script>swal({ title:'Upload Successfull!', text: 'The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded!', type: 'success', buttonsStyling: false, confirmButtonClass: 'btn btn-success'})</script>";
                }
                else {
                    echo "<script>swal({ title:'Can't Upload to database!', text: 'The file ". basename( $_FILES["fileToUpload"]["name"]). " has been not uploaded to database!', type: 'error', buttonsStyling: false, confirmButtonClass: 'btn btn-danger'})</script>";
                }
            } 
            else 
            {
                echo "<script>swal({ title:'Sorry!', text: 'file ". basename( $_FILES["fileToUpload"]["name"]). "  is Unsupported image!', type: 'warning', buttonsStyling: false, confirmButtonClass: 'btn btn-warning'})</script>";
            }
        }
    }
    else 
    {
        echo "<script>swal({ title:'Upload Failed!', text: 'there was an error uploading your file". basename( $_FILES["fileToUpload"]["name"]). " .!', type: 'error', buttonsStyling: false, confirmButtonClass: 'btn btn-danger'})</script>";
    }
}
