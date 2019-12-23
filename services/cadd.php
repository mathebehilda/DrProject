<?php
$con = mysqli_connect("localhost","root");
mysqli_select_db($con, "hdb");
// Check for empty fields
if(empty($_POST['cnumber'])   ||
   empty($_POST['line11']))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$cnumber = strip_tags(htmlspecialchars($_POST['cnumber']));
$line1 = strip_tags(htmlspecialchars($_POST['line11']));
$line2 = strip_tags(htmlspecialchars($_POST['line22']));
$address = $line1.", ".$line2;

if(mysqli_query($con,"UPDATE user SET maddress = '$address' WHERE cnumber = '$cnumber'")){
    echo "Done!";   
}else
    echo "Failed!";         
?>