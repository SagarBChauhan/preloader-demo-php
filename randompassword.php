<?php
function randomPassword()
{
    $pass="";
    $alphabet="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$&*";
    for($i=0;$i<8;$i++)
    {
        $n=  rand(0,  strlen($alphabet));
        $temp=substr($alphabet, $n, 1);
        $pass=$pass.$temp;
    }
    echo $pass;
}
randomPassword();