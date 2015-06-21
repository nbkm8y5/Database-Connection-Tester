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
<!--[if IE 8]> <html class="no-js lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]> <html class="ie9" lang="en"> <![endif]-->
<!--[if IE 10]> <html class="ie10" lang="en"> <![endif]-->
<!--[if (gt IE 10)|!(IE)]> <html lang="en"> <![endif]-->
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
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
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
    <div class="container">
      <div class="col-md-offset-4 col-md-4">
      <form class="form-signin" id="signInForm">
        <h2 class="form-signin-heading">Log In</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <a href="#">Forgot Password?</a>
        <div class="checkbox">
          <label><input type="checkbox" value="remember-me" >Remember me</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block"  onclick="signIn()" type="submit">Log In</button>
        <button class="btn btn-lg btn-danger btn-block" onclick="resetForm()">Reset Form</button>
      </form>
      <h6 class="text-center">&copy <?php echo date('Y') ?> Rolando Moreno</h6>
    </div> <!-- /container -->
    </div>
</section>
    
    <h1 id="signInAlert" class="text-center"></h1>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="js/clock.js"></script>
    <script src="js/signin.js"></script>
  </body>
</html>