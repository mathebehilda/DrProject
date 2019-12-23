<?php
$con = mysqli_connect("localhost","root");
mysqli_select_db($con, "hdb");
// Check for empty fields
if(empty($_POST['cnumber'])   ||
   empty($_POST['email']))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$cnumber = strip_tags(htmlspecialchars($_POST['cnumber']));
$email = strip_tags(htmlspecialchars($_POST['email']));

if(mysqli_query($con,"UPDATE user SET email = '$email' WHERE cnumber = '$cnumber'")){
    echo "Done!";   
}else
    echo "Failed!";         
?>