<?php
include 'database.php';
$db = new database('localhost', 'hdb');
// Check for empty fields
if(empty($_POST['fname'])     ||
   empty($_POST['sname'])     ||
   empty($_POST['email'])     ||
   empty($_POST['pnumber'])   ||
   empty($_POST['line1'])     ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$fname = strip_tags(htmlspecialchars($_POST['fname']));
$sname = strip_tags(htmlspecialchars($_POST['sname']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$pnumber = strip_tags(htmlspecialchars($_POST['pnumber']));
$line1 = strip_tags(htmlspecialchars($_POST['line1']));
$line2 = strip_tags(htmlspecialchars($_POST['line2']));
$address = $line1.", ".$line2;

$cnumber;
$sendMail = false;

// Customer Number
function getCnumber($db, $cnumber){
    $digits = 4;
    $cnumber = rand(pow(10, $digits-1), pow(10, $digits)-1);

    while ($db->select_from_db("user", "user_id", "cnumber = '$cnumber'")){
        $cnumber = rand(pow(10, $digits-1), pow(10, $digits)-1);
    }
    return "C".$cnumber;
}


// Register
$cnumber = getCnumber($db, $cnumber);
$fields = array("fname","sname","email","pnumber","maddress","cnumber");
$values = array($fname, $sname,$email_address,$pnumber,$address, $cnumber);
if(!$db->select_from_db("user", "user_id", "email = '$email_address'")){
    if($db->insert_into_db("user", $fields, $values)){
        $feedback = "Registered";
        $sendMail = true;
    }
    else {
    $feedback = "You were not registered, try again later";
    }      
}else
    $feedback = "We already know you, try signing in";


if($sendMail){
    //Mail Service
    //Set Up varibales
    // Create another email for client
    $uto = "$email_address";
    $usubject = "Homesuit Grocery Services 2018";
    $ubody = '
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Homesuit Mailer</title>
    </head>
    <body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif;">
        <table cellspacing="0" cellpadding="0" width="100%" height="100%">
            <tr>
                <td align="center">
                    <table cellspacing="0" cellpadding="0" width="734">
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" width="100%">
                                    <tr>
                                        <td>
                                            <img border="0" style="display: block;" src="mailer/header.jpg" alt="Enter as a business unit and stand to win R20 000*" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table cellspacing="0" cellpadding="0" width="734px">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td style="color: #209c78; font-size: 24px; line-height: 22px; font-family: Arial, Helvetica, sans-serif;">
                                                        <strong>Hi, '. "$fname" .' </strong>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td style="color: #606060; font-size: 14px; line-height: 22px; font-family: Arial, Helvetica, sans-serif;">
                                                        Thank you for registering with us.
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td style="color: #606060; font-size: 14px; line-height: 22px; font-family: Arial, Helvetica, sans-serif;">
                                                        Your customer number is <strong>'. "$cnumber" .'</strong>. Please keep it safe.
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td style="color: #606060; font-size: 14px; line-height: 22px; font-family: Arial, Helvetica, sans-serif;">
                                                        We look forward to working with you. Place your first order <a href="hsgroceryservice.co.za">here</a>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>
                                            <table style="color: #209c78; font-family: Arial, Helvetica, sans-serif;" cellspacing="0" cellpadding="0" width="734px">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <table style="font-size: 24px;">
                                                            <tr>
                                                                <td>
                                                                        <strong>Let us take care of you </strong>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                        <strong>while you take over the world</strong>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        
                                                    </td>
                                                    <td style="text-align: right; font-size: 13px; color: gray; font-family: Arial, Helvetica, sans-serif;" align="right">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                        Contact us
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                        Homesuit Grocery Service
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                        Mobile: +27 76 469 0904
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                        Email: hsgs@gmail.com
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                        Website: <a href="hsgroceryservice.co.za">hsgroceryservice.co.za</a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                            
                                        </td>
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: white; background-color: #209c78; font-family: Arial, Helvetica, sans-serif;" width="734px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: white; background-color: #209c78; font-family: Arial, Helvetica, sans-serif;" width="734px">
                                    © HomeSuit Grocery Service 2018 
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; color: white; background-color: #209c78; font-family: Arial, Helvetica, sans-serif;" width="734px">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>    
    ';
    $uheader = "From: noreply@hsgroceryservice.co.za\r\n";
    $uheader .= "Reply-To: office@homesuit.com\r\n";
    $uheader .= "MIME-Version: 1.0\r\n";
    $uheader .= "Content-Type: text/html; charset=UTF-8\r\n";

    mail($uto,$usubject,$ubody,$uheader);
}

           
?>