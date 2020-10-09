<?php 
session_start();
if(!isset($_SESSION['user']))
{
    header("location:index.php");
}
if(isset($_GET['logout'])=='yes')
{
    session_destroy();
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        Username: <?php echo $_SESSION['user']; ?>
        <p><a href="?logout=yes" >Logout</a></p>
    </body>
</html>
