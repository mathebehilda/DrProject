<?php 
    error_reporting(1);
    include '../services/database.php';
    $db = new database('localhost', 'hdb');

    session_start();
    $uname=$_SESSION['eid'];
    if($_REQUEST['log']=='out')
    {
    session_destroy();
    header("location:login.php");
    }
    else if($uname=="")
    {
    header("location:login.php");
    }

?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font-awesome -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles -->
    <link href="../main.css" rel="stylesheet">

  </head>

  <body id="page-top" style="background:url('../img/Night City Glow Wallpapers.jpg');">
    <div class="loader"></div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top adminNav" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php"><img class="img-responsive" height="61" width="200" src="../img/HomeLogo.png"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
          <form class="form-inline" method="get">
            <input class="form-control mr-sm-2" name="qnumber" type="search" placeholder="eg. C1234" aria-label="Search">
            <button class="cbutton my-2 my-sm-0" type="submit">Search</button>
            <a href="?log=out" class="cbutton my-2 my-sm-0 nav-link" type="submit">Logout</a>
          </form>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->


    <!-- Body -->
    <br /><br /><br /><br />
    <div id="myFooter" class="myFooter">
        <div class="footer-copyright">
            <p>Admin Panel </p>
        </div>
    </div>

    <br /><br />
    <div class="container-fluid admin">
        <div class="row justify-content-md-center">
          <div class="col">
            
          <div class="list-group">
            <a href="index.php" class="list-group-item list-group-item-action">
              Customers
            </a>
            <a href="new.php" class="list-group-item list-group-item-action">New Orders</a>
            <a href="wait.php" class="list-group-item list-group-item-action active">Waiting</a>
            <a href="conf.php" class="list-group-item list-group-item-action">Confirmed</a>
          </div>

          </div>
          <div class="col-md-6 ccontent">
          <br />
            
            <div class="container">
                <div class="row">
                    <div class="col-12">
                      <script>
                        if(window.history.replaceState){
                          window.history.replaceState(null, null, window.location.href);
                        }
                      </script>
                    <?php

                      //For Price
                      if(isset($_POST['smsButtonPrice'])){
                            $numbers = "27".$_POST['mobile'];
                            $oc = $_POST['onumber'];
                            $message = "Hi+".$_POST['sname'].",+Please+confirm+your+order+here+https://hsgroceryservice.co.za/malls/order.php?orderN=$oc";
                            $link = "https://platform.clickatell.com/messages/http/send?apiKey=MvsJ-39YQSapAtvYuoN90w==&to=$numbers&content=$message";
                            //$slink = addcslashes($link);
                            if(@file_get_contents($link)){
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                SMS was successfully sent.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                            }else{
                              echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                              Sorry, we could not send the SMS. Please try again.
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";
                            }
                      }


                      $qnumber = "";
                      if(!empty($_REQUEST["qnumber"])){
                        $cnum = strtoupper($_REQUEST["qnumber"]);
                        $qnumber = "cnumber = '$cnum'";
                      }
                      if($datas = $db->select_from_db("user", "cnumber", "$qnumber")){
                        $cal = 0;
                        echo "<h4 class='addheader text-center' style='background-color:#88D89E;width:100%;color:white;'>These orders await clients confirmation</h4>";
                        foreach ($datas as $data){
                          $cnumber = $data['cnumber'];
                          //Name
                          $fnameData = $db->select_from_db("user", "fname", "cnumber = '$cnumber'");
                          $fname = $fnameData[0]['fname'];
                          //Surname
                          $snameData = $db->select_from_db("user", "sname", "cnumber = '$cnumber'");
                          $sname = $snameData[0]['sname'];
                          //Email
                          $emailData = $db->select_from_db("user", "email", "cnumber = '$cnumber'");
                          $email = $emailData[0]['email'];
                          //Mobile Number
                          $mobileData = $db->select_from_db("user", "pnumber", "cnumber = '$cnumber'");
                          $mobile = $mobileData[0]['pnumber'];
                          //Address
                          $addData = $db->select_from_db("user", "maddress", "cnumber = '$cnumber'");
                          $address = $addData[0]['maddress'];

                          if($orders = $db->select_from_db("orders", "onumber", "cnumber = '$cnumber'")){
                            //echo "<h4>Here's a list of our new orders</h4>";
                            $cal2 = 0;
                            foreach ($orders as $order){
                              $onumber = $order['onumber'];
                              //Check if the order was priced
                              if($prices = $db->select_from_db("unitcost", "price", "onumber = '$onumber'")){
                                $price = "R".$prices[0]['price'];

                                //$fmt = numfmt_create('en_US', NumberFormatter::CURRENCY);
                                //$price = numfmt_format_currency($fmt, $price, "USD");
                                //Mall
                                $mallData = $db->select_from_db("orders", "mall", "onumber = '$onumber'");
                                $mall = $mallData[0]['mall'];

                                switch ($mall){
                                  case 'boulevard':
                                          $mall = "Boulevard";
                                          break;
                                  case 'brooklyn':
                                          $mall = "Brooklyn";
                                          break;
                                  case 'centurion':
                                          $mall = "Centurion";
                                          break; 
                                  case 'hazeldean':
                                          $mall = "Hazeldean";
                                          break;   
                                  case 'kollonade':
                                          $mall = "Kollonade";
                                          break;    
                                  case 'menlyn':
                                          $mall = "Menlyn";
                                          break;
                                  case 'olympusvillage':
                                          $mall = "Olympus Village";
                                          break;
                                  case 'silverorks':
                                          $mall = "Silver Orks";
                                          break;
                                  case 'thegroove':
                                          $mall = "The Groove";
                                          break;
                                  default:
                                          $mall = $mall;
                                }
                                //Confirmed
                                $confData = $db->select_from_db("orders", "confirmed", "onumber = '$onumber'");
                                $conf = $confData[0]['confirmed'];
                                //Items
                                $myItems = "";
                                if($items = $db->select_from_db("$mall", "items", "onumber = '$onumber'")){
                                  $cal3 = 0;
                                  foreach($items as $item){
                                    
                                    //Shop
                                    $shopData = $db->select_from_db("$mall", "shop", "onumber = '$onumber'");
                                    $shop = $shopData[$cal3]['shop'];

                                    $myItems .= "<strong>$shop Store</strong>\n".$item['items']."\n\n";
                                    ++$cal3;
                                  }
                                }
                                $myItems = nl2br($myItems);
                                //Display
                                echo "<table class='table'>";
                                echo "<tbody>";
                                echo "<tr>";  
                                echo "<th scope='row'>$cnumber</th>";    
                                echo "<td><strong>Name</strong></td>";    
                                echo "<td>$fname $sname</td>";    
                                echo "</tr>";  
                                echo "<tr>"; 
                                echo "<th scope='row'></th>";    
                                echo "<td><strong>Order Number</strong></td>";    
                                echo "<td>$onumber</td>";    
                                echo "</tr>";  
                                echo "<tr>"; 
                                echo "<th scope='row'></th>";    
                                echo "<td><strong>Mall</strong></td>";    
                                echo "<td>$mall</td>";    
                                echo "</tr>"; 
                                echo "<tr>";  
                                echo "<th scope='row'></th>";    
                                echo "<td><strong>Items</strong></td>";    
                                echo "<td>$myItems</td>";
                                echo "</tr>";
                                  echo "<tr>";
                                  echo "<th scope='row'></th>";    
                                  echo "<td><strong>Price</strong></td>";    
                                  echo "<td>$price</td>";    
                                  echo "</tr>";
                                echo "<tr>";
                                echo "<th scope='row'></th>";    
                                echo "<td><strong>Address</strong></td>";    
                                echo "<td>$address</td>";    
                                echo "</tr>";
                                echo "<tr>";
                                  echo "<th scope='row'></th>";    
                                  echo "<td><strong>Waiting...</strong></td>";    
                                  echo "<td>
                                  <form id='smsFormPrice' method='post' name='editDetails' novalidate>     
                                  <div class='form-group'>        
                                  <input type='hidden' class='form-control' id='onumber' name='onumber' value='$onumber'>  
                                  <input type='hidden' class='form-control' id='mobile' name='mobile' value='$mobile'>
                                  <input type='hidden' class='form-control' id='sname' name='sname' value='$sname'>                         
                                  </div>               
                                  <button id='smsButtonPrice' name='smsButtonPrice' type='submit' class='cbutton'>Re-send SMS</button>      
                                  </form>
                                  </td>";    
                                  echo "</tr>";
                                echo "</tbody>";
                                echo "</table>";
                                echo "<br />";

                                 
                              }
                              ++$cal2;
                            }
                          }else if($cal == 0){
                            echo "<h4 class='addheader text-center' style='background-color:#88D89E;width:100%;color:white;'>Sorry we could not find any order</h4>";
                          }

                          /*
                          
                          */

                          ++$cal;
                        }
                      }else{
                        echo "<h4 class='addheader text-center' style='background-color:#88D89E;width:100%;color:white;'>Sorry we could not find anyone.</h4>";
                      }

                    ?>
                    

                    </div>
                    <div class="col">
                    
                    </div>
                    <div class="col">
                    
                    </div>
                </div>
                
            </div>
            
          </div>

          <div class="col">
            
          </div>
        </div>
      </div>

      <!-- Edits -->

      
      <br />
      <hr />
      <!-- Footer 
      <div id="myFooter" class="myFooter">
          <div class="footer-copyright">
              <p>© HomeSuit Grocery Service 2018 </p>
          </div>
      </div>
                      -->
    <!-- Bootstrap JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->

    <script src="../js/jqBootstrapValidation.js"></script>

    <!-- Custom scripts -->
    <script src="../js/main.js"></script>

  </body>

</html>
