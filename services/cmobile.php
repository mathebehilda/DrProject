<?php
$con = mysqli_connect("localhost","root");
mysqli_select_db($con, "hdb");
// Check for empty fields
if(empty($_POST['cnumber'])   ||
   empty($_POST['mnumber']))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$cnumber = strip_tags(htmlspecialchars($_POST['cnumber']));
$mnumber = strip_tags(htmlspecialchars($_POST['mnumber']));

if(mysqli_query($con,"UPDATE user SET pnumber = '$mnumber' WHERE cnumber = '$cnumber'")){
    echo "Done!";   
}else
    echo "Failed!";         
?>