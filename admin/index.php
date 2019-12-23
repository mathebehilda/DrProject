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
            <a href="index.php" class="list-group-item list-group-item-action active">
              Customers
            </a>
            <a href="new.php" class="list-group-item list-group-item-action">New Orders</a>
            <a href="wait.php" class="list-group-item list-group-item-action">Waiting</a>
            <a href="conf.php" class="list-group-item list-group-item-action">Confirmed</a>
          </div>

          </div>
          <div class="col-md-6 ccontent">
          <br />
            
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    
                    <?php
                      $qnumber = "";
                      if(!empty($_REQUEST["qnumber"])){
                        $cnum = strtoupper($_REQUEST["qnumber"]);
                        $qnumber = "cnumber = '$cnum'";
                      }
                      if($datas = $db->select_from_db("user", "cnumber", "$qnumber")){
                        $cal = 0;
                        echo "<h4 class='addheader text-center' style='background-color:#88D89E;width:100%;color:white;'>Here's a list of our customers</h4>";
                        foreach ($datas as $data){
                          $cnumber = $data['cnumber'];
                          //
                          $fnameData = $db->select_from_db("user", "fname", "cnumber = '$cnumber'");
                          $fname = $fnameData[0]['fname'];
                          //
                          $snameData = $db->select_from_db("user", "sname", "cnumber = '$cnumber'");
                          $sname = $snameData[0]['sname'];
                          //
                          $emailData = $db->select_from_db("user", "email", "cnumber = '$cnumber'");
                          $email = $emailData[0]['email'];
                          //
                          $mobileData = $db->select_from_db("user", "pnumber", "cnumber = '$cnumber'");
                          $mobile = $mobileData[0]['pnumber'];
                          //
                          $addData = $db->select_from_db("user", "maddress", "cnumber = '$cnumber'");
                          $address = $addData[0]['maddress'];

                          echo "<table class='table'>";
                          echo "<tbody>";
                          echo "<tr>";  
                          echo "<th scope='row'>$cnumber</th>";    
                          echo "<td><strong>Name</strong></td>";    
                          echo "<td>$fname $sname</td>";    
                          echo "</tr>";  
                          echo "<tr>"; 
                          echo "<th scope='row'></th>";    
                          echo "<td><strong>Email</strong></td>";    
                          echo "<td>$email";  
                          if(!empty($_REQUEST["qnumber"])){
                              echo "(<a data-toggle='modal' data-target='#editMail$cnumber' href='#'>Edit</a>)";
                          }  
                          echo "</td>";
                          echo "</tr>";  
                          echo "<tr>";  
                          echo "<th scope='row'></th>";    
                          echo "<td><strong>Mobile</strong></td>";    
                          echo "<td>0$mobile";
                          if(!empty($_REQUEST["qnumber"])){
                            echo "(<a data-toggle='modal' data-target='#editMobile$cnumber' href='#'>Edit</a>)";
                          } 
                          echo "</td>";
                          echo "</tr>";
                          echo "<tr>";
                          echo "<th scope='row'></th>";    
                          echo "<td><strong>Address</strong></td>";    
                          echo "<td>$address</td>";    
                          echo "</tr>";
                          echo "</tbody>";
                          echo "</table>";
                          echo "<br />";

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
      <?php 
        if($adatas = $db->select_from_db("user", "cnumber", "$qnumber")){
          $acal = 0;
          foreach ($adatas as $adata){
            $acnumber = $adata['cnumber'];
            //
            $afnameData = $db->select_from_db("user", "fname", "cnumber = '$acnumber'");
            $afname = $afnameData[0]['fname'];
            //

            echo "<div class='modal fade' id='editMail$acnumber' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel$acal' aria-hidden='true'>";
            echo "<div class='modal-dialog' role='document'>";
            echo "<div class='modal-content'>";  
            echo  "<div class='modal-header'>";    
            echo  "<h5 class='modal-title' id='exampleModalLabel$acal'>Edit $afname's Email</h5>";      
            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";      
            echo "<span aria-hidden='true'>&times;</span>";        
            echo "</button>";      
            echo "</div>";    
            echo "<div class='modal-body'>";    
            echo "<form class='editFormMail' name='editDetails' novalidate>";      

            echo "<div class='form-group'>";        
            echo "<input type='hidden' class='form-control' id='cnumber' value='$acnumber'>";          
            echo "<label for='email'>Email Address</label>";          
            echo "<input type='text' class='form-control' id='email' placeholder='eg. me@somemail.com' required data-validation-required-message='Please enter new email address.'>";         
            echo "<p class='help-block text-danger'></p>";          
            echo "</div>";        
            echo "<br />";        
            echo "<div class='success2'></div>";        
            echo "<button id='editButtonMail' type='submit' class='cbutton'>Submit</button>";        
            echo "</form>";      
            echo "</div>";    
            echo "<div class='modal-footer'>";    
            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal' data-dismiss='alert'>Close</button>";      
            echo "</div>";    
            echo "</div>";  
            echo "</div>";
            echo "</div>";

            //For Mobile Phone
            echo "<div class='modal fade' id='editMobile$acnumber' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel$acal' aria-hidden='true'>";
            echo "<div class='modal-dialog' role='document'>";
            echo "<div class='modal-content'>";  
            echo "<div class='modal-header'>";    
            echo "<h5 class='modal-title' id='exampleModalLabel$acal'>Edit $afname's Mobile Number</h5>";      
            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"; 
            echo "<span aria-hidden='true'>&times;</span>";        
            echo "</button>";      
            echo "</div>";    
            echo "<div class='modal-body'>";    
            echo "<form class='editFormMobile' name='editDetails' novalidate>";      

            echo "<div class='form-group'>";        
            echo "<input type='hidden' class='form-control' id='cnumber' value='$acnumber'>";          
            echo "<label for='mnumber'>Mobile Number</label>";          
            echo "<input type='number' class='form-control' id='mnumber' placeholder='eg. 0764490905' required data-validation-required-message='Please enter new mobile number.'>";          
            echo "<p class='help-block text-danger'></p>";          
            echo "</div>";        
            echo "<br />";        
            echo "<div class='success3'></div>";        
            echo "<button id='editButtonMobile' type='submit' class='cbutton'>Submit</button>";        
            echo "</form>";      
            echo "</div>";    
            echo "<div class='modal-footer'>";    
            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";      
            echo "</div>";    
            echo "</div>";  
            echo "</div>";
            echo "</div>";

            ++$acal;
          }
        }

      ?>
      
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
    <script src="../js/adminEditor.js"></script>

    <!-- Custom scripts -->
    <script src="../js/main.js"></script>

  </body>

</html>
