<?php
$server="localhost";
$username="root";
$password="";
$dbname="db";
$conn=mysqli_connect($server,$username,$password,$dbname);
if(!$conn)
{
    die("connection failed");
}
else{
    print("connected successfully");
}
?>