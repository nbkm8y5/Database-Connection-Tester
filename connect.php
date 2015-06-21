<?php
session_start(); // Must start session first thing
/* 
Created By Adam Khoury @ www.flashbuilding.com 
-----------------------June 20, 2008----------------------- 
*/
// See if they are a logged in member by checking Session data
$memberProfile = "";
$memberAccount = "";
$logout = "";
$joinForm ="";
$loginForm ="";
if (isset($_SESSION['id'])) {
  // Put stored session variables into local php variable
    $userid = $_SESSION['id'];
    $username = $_SESSION['username'];
  $memberProfile = '<a href="member_profile.php?id=' . $userid . '">' . $username . '</a>'; 
  $memberAccount = '<a href="member_account.php">Account</a>'; 
  $logout = '<a href="logout.php">Log Out</a>';
} else {
  $joinForm = '<a href="join_form.php">Register</a>';
  $loginForm ='<a href="login.php">Login</a>';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Skeleton Website">
    <meta name="author" content="Rolando Moreno">
    <title>Database Tester with Bootstrap nav</title>

    <link rel="icon" type="image/png" href="images/bhLogo.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!--IPage server style sheets-->
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/bodyStyle.css">

     <!--Google Font-->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="clock()">
    <header>
      <div class="navbar-wrapper">
      <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><img id="logo" src="images/bhLogoMini.jpg" style="position:relative; bottom:15px"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><?php echo$memberProfile; ?></li>
                <li><?php echo$memberAccount; ?></li>
                <li><?php echo$logout; ?></li>   
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><?php echo$joinForm; ?></li>
                <li><?php echo$loginForm; ?></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Utilities</li>
                    <li><a href="connect.php">Test Database Connection</a></li>
                    <li><a href="mysql_connect_quicktest.php">Test Database Connection PHP</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
      <div class-"container">
        <div class="col-md-offset-4 col-md-4 text-center">
          <a href="index.html"><img src="images/bhLogo.png"></a>
          <h1 id="clock" class="text-center"></h1>
        </div>
      </div>
    </header>
<section>
  <div class="row">
<div class="container">
  <div class="col-md-offset-4 col-md-4 text-center">
    <h4>
      <?php
        $success = "DATABASE CONNECTION SUCCESSFUL";
        // See if we can in fact for sure get connected to that database for querying
        require_once "php/test_connect.php";
        // If the script makes it past that first line we are good to go using that one line
        // in every script we create that requires a connection to that database
        echo $success;
      ?>
    </h4>
    <h6>&copy <?php echo date('Y'); ?> Rolando Moreno</h6>
  </div> 
</div>
</div>
</section>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="js/clock.js"></script>
  </body>
</html>