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

    <?php 
        include '../services/database.php';
        $db = new database('localhost', 'hdb');
        $err = "";

        if(isset($_POST['login'])){
            if($uname = $db->select_from_db("admin", "username", "")){
                if($upass = $db->select_from_db("admin", "password", "")){
                    if($_POST['username'] == $uname[0]['username'] && $_POST['password'] == $upass[0]['password']){
                        session_start();
                        $_SESSION['eid']=$uname;
                        header("location:index.php");
                    }else{
                        $err = "Username and Password did not match";
                    }
                }
            }
        }
    
    ?>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top adminNav" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php"><img class="img-responsive" height="61" width="200" src="../img/HomeLogo.png"></a>
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
                  

                    ?>
                    <h4>Enter login details</h4>
                    <form method="post">
                    <div class="list-group">
                        <input class="list-group-item2 form-control list-group-item-action orderNo" type="text" name="username" placeholder="Enter Username" required>
                        <input class="list-group-item2 form-control list-group-item-action orderNo" type="password" name="password" placeholder="Enter Password" required>
                        <button type="submit" name="login" class="text-center list-group-item list-group-item-action cbutton"><strong>Login</strong></button>
                        <?php if($err != ""){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    $err
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>";
                        }?>
                    </div>
                    </form>
                    

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
