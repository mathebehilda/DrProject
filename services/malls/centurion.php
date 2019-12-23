<?php
include '../database.php';
$db = new database('localhost', 'hdb');
// Check for empty fields

$numOfShops = ($_POST['numOfShops']);
$cnumber = strip_tags(htmlspecialchars($_POST['cnumber']));
$mall = "centurion";
$onumber = "";
function getOnumber($db, $onumber){
    $digits = 4;
    $onumber = rand(pow(10, $digits-1), pow(10, $digits)-1);

    while ($db->select_from_db("orders", "cnumber", "onumber = '$onumber'")){
        $onumber = rand(pow(10, $digits-1), pow(10, $digits)-1);
    }
    return "OR".$onumber;
}

// Register
$onumber = getOnumber($db, $onumber);
$confirm = 0;
$ordered = false;
$sendMail = false;
$itemsOrdered = "";

while($numOfShops != 0){
    if(!empty($_POST['items'.$numOfShops])){
        if($db->select_from_db("user", "user_id", "cnumber = '$cnumber'")){
            $myitems = addslashes($_POST['items'.$numOfShops]);
            $fields = array("cnumber","onumber","mall", "confirmed");
            $values = array($cnumber,$onumber,$mall,$confirm);
            if(!$ordered && $db->insert_into_db("orders", $fields, $values)){
                $ordered = true;
                $fields = array("shop","items","onumber","cnumber");
                $values = array($_POST['shop'.$numOfShops],$myitems,$onumber,$cnumber);
                if($db->insert_into_db("$mall", $fields, $values)){
                    $success = "Thank you for making your order";


                    $sendMail = true;
                    $itemsOrdered .= $_POST['shop'.$numOfShops]." Store\n".$myitems;



                }else{
                    $success = "Your order was not successful!";
                }
            }else{
                $fields = array("shop","items","onumber","cnumber");
                $values = array($_POST['shop'.$numOfShops],$myitems,$onumber,$cnumber);
                if($db->insert_into_db("$mall", $fields, $values)){
                    $success = "Thank you for making your order";
                    
                    $sendMail = true;
                    $itemsOrdered .= "\n\n".$_POST['shop'.$numOfShops]." Store\n".$myitems;

                }else{
                    $success = "Your order was not successful!";
                }
            }    
        }else
            $success = "Sorry, we could not find you!";
    }
    --$numOfShops;
}


if($sendMail){
    //Mail Service
    //Set Up varibales
    if($myname = $db->select_from_db("user", "fname", "cnumber = '$cnumber'")){
        $fname = $myname[0]['fname'];
    }
    if($email = $db->select_from_db("user", "email", "cnumber = '$cnumber'")){
        $email_address = $email[0]['email'];
    }

    //Send mail to self
    $to = 'tbsmokone@outlook.com';
    $email_subject = "New Client";
    $email_body = "You have received a new order.\n\n"."Here are the details:\n\nName: $fname\n\nEmail: $email_address\n\n$fname is requesting for the following things\n\n$itemsOrdered";
    $headers = "From: noreply@hsgroceryservice.co.za\n";
    $headers .= "Reply-To: $email_address";   

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
                                                        <strong>Hi, '. "$fname ($cnumber)" .' </strong>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td style="color: #606060; font-size: 14px; line-height: 22px; font-family: Arial, Helvetica, sans-serif;">
                                                        Thank you for placing an order. Your order
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td style="color: #606060; font-size: 14px; line-height: 22px; font-family: Arial, Helvetica, sans-serif;">
                                                        '. "$itemsOrdered" .'
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td style="color: #606060; font-size: 14px; line-height: 22px; font-family: Arial, Helvetica, sans-serif;">
                                                        is currently being processed. You will receive an SMS within an 1 hour to confirm the costs for your order.
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

    //Check if the client was notified about the order before yourself
    if(mail($uto,$usubject,$ubody,$uheader)){
        mail($to,$email_subject,$email_body,$headers);
    }
    //Another
    
}

           
?>