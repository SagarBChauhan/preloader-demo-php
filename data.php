<?php
session_start();
$mysqli = new mysqli("localhost", "root","root", "tt");
if($mysqli->connect_error) {
  exit('Could not connect');
}

#Login
if(isset($_POST['login']))
{
    $usename=trim($_POST['User_Name']);
    $pass= trim($_POST['Password']);
    $password=  md5($pass);    
    $hasil=$mysqli->prepare("SELECT * FROM `tbl_login` WHERE `User_Name`=?");
    $hasil->bind_param("d",$usename);
    $hasil->execute();
    $hasil->bind_result( $User_Id, $User_Name, $Password, $Account_Type_Id, $Status, $Last_Update_Time);
    $hasil->fetch();
    if($Password==$password && $User_Name=$usename)
    {
        echo 'ok';
        $_SESSION['id']=$User_Id;
        $_SESSION['user']=$User_Name;
    }
    else 
    {
        echo "username or password is invalid";
    }  
} 

