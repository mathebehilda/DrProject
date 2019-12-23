<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <link rel="icon" type="image/png" href="img/Icon.png" />

    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font-awesome -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles -->
    <link href="main.css" rel="stylesheet">

  </head>

  <body id="page-top">
    <div class="loader"></div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><img class="img-responsive" height="61" width="200" src="img/HomeLogo.png"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="malls/order.php">View Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" data-toggle="modal" data-target="#registerModal" href="#collection">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">         
          <div class="intro-heading text-uppercase">&nbsp;</div>
          <div class="intro-lead-in">&nbsp;</div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col">
            
          </div>
          <div class="col-md-6 lcontent">
            <h4>Select a mall</h4>
            <div class="list-group">
              <a href="malls/boulevard.php" class="list-group-item list-group-item-action">Boulevard</a>
              <a href="malls/menlyn.php" class="list-group-item list-group-item-action">Menlyn</a>
              <a href="malls/brooklyn.php" class="list-group-item list-group-item-action">Brooklyn</a>
              <a href="malls/thegroove.php" class="list-group-item list-group-item-action">The Groove</a>
              <a href="malls/silverorks.php" class="list-group-item list-group-item-action">Silver Orks</a>
              <a href="malls/olympusvillage.php" class="list-group-item list-group-item-action">Olympus Village</a>  
              <a href="malls/hazeldean.php" class="list-group-item list-group-item-action">Hazeldean Square</a>  
              <a href="malls/centurion.php" class="list-group-item list-group-item-action">Centurion</a>  
              <a href="malls/kollonade.php" class="list-group-item list-group-item-action">Kollonade</a> 
            </div>

          </div>
          <div class="col">
            
          </div>
        </div>
      </div>
    </header>


    <!-- Body -->
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <hr />
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
                          <img class="img-responsive" height="50px" width="50px" src="img/Instagram-logo1.png" alt="">
                        </a>
                        <a href="#">
                          <img class="img-responsive" height="50px" width="50px" src="img/Twitter Logo.png" alt="">
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


    <!-- Bootstrap JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/register.js"></script>

    <!-- Custom scripts -->
    <script src="js/main.js"></script>

  </body>

</html>
