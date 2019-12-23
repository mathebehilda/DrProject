<?php
$con = mysqli_connect("localhost","root");
mysqli_select_db($con, "hdb");
include 'database.php';
$db = new database('localhost', 'hdb');
// Check for empty fields
if(empty($_POST['onumber']) || empty($_POST['pmeth']) )
   {
   echo "No arguments Provided!";
   return false;
   }
   
$pmeth = $_POST['pmeth'];   
$onumber = strip_tags(htmlspecialchars($_POST['onumber']));
$confirmed = 1;

if(mysqli_query($con,"UPDATE orders SET confirmed = $confirmed WHERE onumber = '$onumber'")){
    $fields = array("onumber","pmeth");
    $values = array($onumber, $pmeth);
    if($db->insert_into_db("payment", $fields, $values)){
        echo "Done!"; 
    }
    //$sendMail = true;  
}else
    echo "Failed!";  
?>