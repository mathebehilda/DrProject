<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View Order</title>

    <!-- Bootstrap CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font-awesome -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles -->
    <link href="../main.css" rel="stylesheet">
    <script>
        //Pmeth Value (Payment Method)
        function changeP(){
          document.conDetails.pmethv.value = 'upfront';
          return true;
        }
        function changeP2(){
          document.conDetails.pmethv.value = 'ondel';
          return true;
        }
  
    </script>

  </head>

  <body id="page-top">
    <div class="loader"></div>

    <?php 
        include '../services/database.php';
        $db = new database('localhost', 'hdb');
    
    ?>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../index.php"><img class="img-responsive" height="61" width="200" src="../img/HomeLogo.png"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#cranges">View Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" data-toggle="modal" data-target="#registerModal" href="#">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">         
          <div class="intro-heading text-uppercase"></div>
          <div class="intro-lead-in">&nbsp;</div>
        </div>
      </div>
      <div class="container">
          <div class="row justify-content-md-center">
            <div class="col">
              
            </div>
            <div class="col-md-6 lcontent">
              <h4>Enter order number</h4>
            <form method="post">
              <div class="list-group">
                <input class="list-group-item form-control list-group-item-action orderNo" name="orderNo" placeholder="Enter Order Number">
                <button type="submit" name="order" class="text-center list-group-item list-group-item-action cbutton"><strong>View</strong></button>
              </div>
            </form>
  
            </div>
            <div class="col">
              
            </div>
          </div>
        </div>
      
    </header>


    <!-- Body -->
    <br /><br />
    <div class="container-fluid">
        <div class="row justify-content-md-center">
          <div class="col">
            
          </div>
          <div class="col-md-6 bcontent">
            <script>
              if(window.history.replaceState){
                window.history.replaceState(null, null, window.location.href);
              }
            </script>
          <?php 
            if(isset($_POST['order'])){
                $onumber = $_POST['orderNo'];
                if($cnumber = $db->select_from_db("orders", "cnumber", "onumber = '$onumber'")){
                    $cnum = $cnumber[0]['cnumber'];
                    $malls = $db->select_from_db("orders", "mall", "onumber = '$onumber'");
                    $confirmed = $db->select_from_db("orders", "confirmed", "onumber = '$onumber'");
                    $address = $db->select_from_db("user", "maddress", "cnumber = '$cnum'");
                    $fmall = $malls[0]['mall'];

                    switch ($fmall){
                      case 'boulevard':
                              $fmall = "Boulevard";
                              break;
                      case 'brooklyn':
                              $fmall = "Brooklyn";
                              break;
                      case 'centurion':
                              $fmall = "Centurion";
                              break; 
                      case 'hazeldean':
                              $fmall = "Hazeldean";
                              break;   
                      case 'kollonade':
                              $fmall = "Kollonade";
                              break;    
                      case 'menlyn':
                              $fmall = "Menlyn";
                              break;
                      case 'olympusvillage':
                              $fmall = "Olympus Village";
                              break;
                      case 'silverorks':
                              $fmall = "Silver Orks";
                              break;
                      case 'thegroove':
                              $fmall = "The Groove";
                              break;
                      default:
                              $fmall = $fmall;
                    }

                    $yadd = $address[0]['maddress'];
                    $confirm = $confirmed[0]['confirmed'];
                    if($myname = $db->select_from_db("user", "fname", "cnumber = '$cnum'")){
                        $fname = $myname[0]['fname'];
                        echo "<br/><h4>Hi, $fname. <a href='order.php'>Not me?</a>.</h4>";
                        echo "<small>Here are the details for your order</small> at $fmall Mall<br/><br/>";
                        if($mall = $db->select_from_db("orders", "mall", "onumber = '$onumber'")){
                            $small = $mall[0]['mall'];
                            if($shops = $db->select_from_db("$small", "shop", "onumber = '$onumber'")){
                                if($groz = $db->select_from_db("$small", "items", "onumber = '$onumber'")){
                                    $count = 0;
                                    foreach ($shops as $ss){
                                        $grocery = stripslashes($groz[$count]['items']);
                                        $grocery = nl2br($grocery);
                                        $myshop = $ss['shop'];
                                        echo "<h5>$myshop</h5>";
                                        echo "<p>$grocery</p><br /><hr />";
                                        ++$count;
                                    }
                                }
                            }
                        }
                        if($price = $db->select_from_db("unitcost", "price", "onumber = '$onumber'")){
                          $uprice = $price[0]['price'];
                          $uservice = 200;
                          if($uprice <= 1000){
                            $uservice += 100;
                          }elseif($uprice > 1000 && $uprice <= 2000){
                            $uservice += 200;
                          }elseif($uprice > 2000 && $uprice <= 3000){
                            $uservice += 300;
                          }elseif($uprice > 3000 && $uprice <= 4000){
                            $uservice += 400;
                          }elseif($uprice > 4000 && $uprice <= 5000){
                            $uservice += 500;
                          }elseif($uprice > 5000 && $uprice <= 6000){
                            $uservice += 600;
                          }elseif($uprice > 6000 && $uprice <= 7000){
                            $uservice += 700;
                          }elseif($uprice > 7000 && $uprice <= 8000){
                            $uservice += 800;
                          }elseif($uprice > 8000 && $uprice <= 9000){
                            $uservice += 900;
                          }elseif($uprice > 9000 && $uprice <= 10000){
                            $uservice += 1000;
                          }
                          $utotal = $uprice + $uservice;

                          echo '<div class="container">';
                          echo '<div class="row">';
                          echo '<div class="col-sm">';
                          echo "Price:";
                          echo "<h3>R$uprice</h3>";
                          echo '</div>';
                          echo '<div class="col-sm">';
                          echo "Service Fee:";
                          echo "<h3>R$uservice</h3>";
                          echo '</div>';
                          echo '<div class="col-sm">';
                          echo "Total:";
                          echo "<h3>R$utotal</h3>";
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo "<br/><hr/>";

                          if($confirm == 0){
                            echo '<div class="container">';
                            echo '<div class="row">';
                            echo '<div class="col-sm">';
                            echo "Delivery Address:<br/><p>$yadd</p> (<a data-toggle='modal' data-target='#editAddress' href='#'>Edit Address</a>)<br/><br/>";
                            echo "<form id='conForm' name='conDetails' novalidate>";
                            echo "<div class='form-group'>";
                            echo "<input type='hidden' class='form-control' id='onumber' value='$onumber'>";
                            echo "<input type='hidden' class='form-control' id='pmethv' name='pmethv' value='upfront'>";
                            echo "</div>";
                            echo "<small>Confirm to accept our <a href='#' data-toggle='modal' data-target='#pterms'>terms</a></small>";
                            echo "<div id='success3'></div>";
                            echo "<button id='conButton' type='submit' class='cbutton'>Confirm Order</button>";
                            echo '</div>';
                            echo '<div class="col-sm">';
                            echo "Payment Method<br/>";
                            echo "<p>";
                            echo '<input type="radio" class="pmeth" id="pmeth" name="pmeth" value="upfront" checked onclick="changeP()"> Upfront&nbsp;&nbsp;';
                            echo '<input type="radio" class="pmeth" id="pmeth" name="pmeth" value="ondel" onclick="changeP2()"> On Delivery<br/>';
                            echo "1510534472, Capitec, MR TA MOKONE";
                            echo "</p>";
                            echo '</div>';
                            echo "</form>";
                            echo '</div>';
                            echo '</div>';
                          }else{
                            echo "This order was handled.";
                          }
                        }
                        
                        echo "<br/><br/>";
                    }
                }
            }
            if(@$onumber = $_REQUEST['orderN']){
                //$onumber = $_GET['orderNo'];
                if($cnumber = $db->select_from_db("orders", "cnumber", "onumber = '$onumber'")){
                    $cnum = $cnumber[0]['cnumber'];
                    $malls = $db->select_from_db("orders", "mall", "onumber = '$onumber'");
                    $confirmed = $db->select_from_db("orders", "confirmed", "onumber = '$onumber'");
                    $address = $db->select_from_db("user", "maddress", "cnumber = '$cnum'");
                    $fmall = $malls[0]['mall'];
                    switch ($fmall){
                      case 'boulevard':
                              $fmall = "Boulevard";
                              break;
                      case 'brooklyn':
                              $fmall = "Brooklyn";
                              break;
                      case 'centurion':
                              $fmall = "Centurion";
                              break; 
                      case 'hazeldean':
                              $fmall = "Hazeldean";
                              break;   
                      case 'kollonade':
                              $fmall = "Kollonade";
                              break;    
                      case 'menlyn':
                              $fmall = "Menlyn";
                              break;
                      case 'olympusvillage':
                              $fmall = "Olympus Village";
                              break;
                      case 'silverorks':
                              $fmall = "Silver Orks";
                              break;
                      case 'thegroove':
                              $fmall = "The Groove";
                              break;
                      default:
                              $fmall = $fmall;
                    }
                    $yadd = $address[0]['maddress'];
                    $confirm = $confirmed[0]['confirmed'];
                    if($myname = $db->select_from_db("user", "fname", "cnumber = '$cnum'")){
                        $fname = $myname[0]['fname'];
                        echo "<br/><h4>Hi, $fname. <a href='order.php'>Not me?</a>.</h4>";
                        echo "<small>Here are the details for your order</small> at $fmall mall<br/><br/>";
                        if($mall = $db->select_from_db("orders", "mall", "onumber = '$onumber'")){
                            $small = $mall[0]['mall'];
                            if($shops = $db->select_from_db("$small", "shop", "onumber = '$onumber'")){
                                if($groz = $db->select_from_db("$small", "items", "onumber = '$onumber'")){
                                    $count = 0;
                                    foreach ($shops as $ss){
                                        $grocery = stripslashes($groz[$count]['items']);
                                        $grocery = nl2br($grocery);
                                        $myshop = $ss['shop'];
                                        echo "<h5>$myshop</h5>";
                                        echo "<p>$grocery</p><br />";
                                        ++$count;
                                    }
                                }
                            }
                        }
                        if($price = $db->select_from_db("unitcost", "price", "onumber = '$onumber'")){
                          $uprice = $price[0]['price'];
                          $uservice = 200;
                          if($uprice <= 1000){
                            $uservice += 100;
                          }elseif($uprice > 1000 && $uprice <= 2000){
                            $uservice += 200;
                          }elseif($uprice > 2000 && $uprice <= 3000){
                            $uservice += 300;
                          }elseif($uprice > 3000 && $uprice <= 4000){
                            $uservice += 400;
                          }elseif($uprice > 4000 && $uprice <= 5000){
                            $uservice += 500;
                          }elseif($uprice > 5000 && $uprice <= 6000){
                            $uservice += 600;
                          }elseif($uprice > 6000 && $uprice <= 7000){
                            $uservice += 700;
                          }elseif($uprice > 7000 && $uprice <= 8000){
                            $uservice += 800;
                          }elseif($uprice > 8000 && $uprice <= 9000){
                            $uservice += 900;
                          }elseif($uprice > 9000 && $uprice <= 10000){
                            $uservice += 1000;
                          }
                          $utotal = $uprice + $uservice;
                          
                          echo '<div class="container">';
                          echo '<div class="row">';
                          echo '<div class="col-sm">';
                          echo "Price:";
                          echo "<h3>R$uprice</h3>";
                          echo '</div>';
                          echo '<div class="col-sm">';
                          echo "Service Fee:";
                          echo "<h3>R$uservice</h3>";
                          echo '</div>';
                          echo '<div class="col-sm">';
                          echo "Total:";
                          echo "<h3>R$utotal</h3>";
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo "<br/><br/>";

                          if($confirm == 0){
                            echo "Delivery Address:<br/><p>$yadd</p> (<a data-toggle='modal' data-target='#editAddress' href='#'>Edit Address</a>)<br/><br/>";
                            echo "<form id='conForm' name='conDetails' novalidate>";
                            echo "<div class='form-group'>";
                            echo "<input type='hidden' class='form-control' id='onumber' value='$onumber'>";
                            echo "</div>";
                            echo "<div id='success3'></div>";
                            echo "<button id='conButton' type='submit' class='cbutton'>Confirm Order</button>";
                            echo "</form>";
                          }else{
                            echo "This order was handled.";
                          }
                        }
                        echo "<br/><br/>";
                    }
                }
            }
          ?>
          </div>
          <div class="col">
            
          </div>
        </div>
      </div>
      <br />
      <!-- Footer -->
      <div id="myFooter" class="myFooter">
          <div class="container">
              <div class="row">
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-3">
                      <h5>Customer Care</h5>
                      <ul>
                          <li>HomeSuit Grocery Service</li>
                          <li><strong>Mobile:</strong> 0764690904</li>
                          <li><strong>Email:</strong> hsgs@gmail.com</li>
                      </ul>
                  </div>
                  <div class="col-sm-2">
                      <h5>Privacy & Terms Policy</h5>
                      <ul>
                          <li><a href="#">Privacy Policy</a></li>
                          <li><a href="#">Terms of Use</a></li>
                      </ul>
                  </div>
                  <div class="col-sm-1">
                      <div class="social-networks">
                        <a href="#">
                          <img class="img-responsive" height="50px" width="50px" src="../img/Instagram-logo1.png" alt="">
                        </a>
                        <a href="#">
                          <img class="img-responsive" height="50px" width="50px" src="../img/Twitter Logo.png" alt="">
                        </a>
                      </div>
                  </div>
                  <div class="col-sm-3">
                  
                  </div>
              </div>
          </div>
          <div class="footer-copyright">
              <p>© HomeSuit Grocery Service 2018 </p>
          </div>
      </div>


      <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Register</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="registerForm" name="regDetails" novalidate>
                <div class="form-group">
                  <label for="fname">First Name</label>
                  <input type="text" class="form-control" id="fname" placeholder="First Name" required data-validation-required-message="Please enter your first name.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <label for="sname">Surname</label>
                  <input type="text" class="form-control" id="sname" placeholder="Surname" required data-validation-required-message="Please enter your surname.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="E-mail Address" required data-validation-required-message="Please enter your email.">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <label for="pnumber">Phone Number</label>
                  <input type="number" class="form-control" id="pnumber" placeholder="Phone Number" required data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <label for="line1">Address</label>
                  <input type="text" class="form-control" id="line1" placeholder="1234 Main St" required data-validation-required-message="Please enter your physical address.">
                  <p class="help-block text-danger"></p>
                  <input type="text" class="form-control" id="line2" placeholder="Apartment, Studio, or Floor">
                </div>
                <br />
                <div id="success1"></div>
                <button id="regButton" type="submit" class="cbutton">Submit</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">Edit Address</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="editForm" name="editDetails" novalidate>

                <div class="form-group">
                  <label for="cnumber">Customer Number</label>
                  <input type="text" maxlength="5" class="form-control disabled" disabled id="cnumber" placeholder="<?php echo $cnum; ?>" required data-validation-required-message="Please enter your customer number.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <label for="line11">Address</label>
                  <input type="text" class="form-control" id="line11" placeholder="1234 Main St" required data-validation-required-message="Please enter your physical address.">
                  <p class="help-block text-danger"></p>
                  <input type="text" class="form-control" id="line22" placeholder="Apartment, Studio, or Floor">
                </div>
                <br />
                <div id="success2"></div>
                <button id="editButton" type="submit" class="cbutton">Submit</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="pterms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">Payment Terms</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            HomeSuit grocery service currently offer EFT and cash on delivery for customers to pay for the service. Please pay attention to the payments methods below. 
            <br /><br />
            1. EFT payment
            <br /><br />
            This method requires customer to directly transfer the amount of money (total price of the service) from their bank account to HomeSuit's account. If you choose this method of payment, banking details are on the page of confirming service cost.
            Customer's order will only be processed once payment reflect on the account. If not, customer will have to send proof of payment to Info@hsgroceryservice.co.za for the order to be processed.
            Cancelation of order with this method of payment will result in customer covering incurred charges in refunding. The customer only have two hours after he/ she made the payment to cancel the order and receive refund. No refund after 2 hours of making the payment. No refund after the order have been delivered, only handle the returns of products. 
            <br /><br />
            2. Cash on delivery
            <br /><br />
            This means customer will pay for the order when it arrives at his/her door step. This method of payment requires customer to have the exact amount of money, as confirmed services cost, as our Grocery specialists do not carry speed points or petty cash. Note that a handling fee of R20 will be charged on the checkout. Make sure that the grocery specialist provide you with receipt and keep it as proof of payment. 
            Cash on delivery is limited to the orders that are less than R5000. Customers can only cancel the order before the notification of the delivery of the order. No refund after the order have been delivered, only handle the returns of products. 


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


    <!-- Bootstrap JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/cadd.js"></script>
    <script src="../js/conorder.js"></script>
    <script src="../js/register.js"></script>

    <!-- Custom scripts -->
    <script src="../js/main.js"></script>

  </body>

</html>
