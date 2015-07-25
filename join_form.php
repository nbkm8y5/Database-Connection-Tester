<?php
/*
  Created By Adam Khoury @ www.flashbuilding.com
  -----------------------June 20, 2008-----------------------
 */
// Set error message as blank upon arrival to page
$errorMsg = "";
// First we check to see if the form has been submitted 
if (isset($_POST['username'])) {
    //Connect to the database through our include 
    require_once "php/DatabaseConnection.php";
    $connect = new DatabaseConnector();
    $connect->setLink();
    $connect->getLink();
    // Filter the posted variables
    $username = ereg_replace("[^A-Za-z0-9]", "", $_POST['username']); // filter everything but numbers and letters
    $country = ereg_replace("[^A-Z a-z0-9]", "", $_POST['country']); // filter everything but spaces, numbers, and letters
    $state = ereg_replace("[^A-Z a-z0-9]", "", $_POST['state']); // filter everything but spaces, numbers, and letters
    $city = ereg_replace("[^A-Z a-z0-9]", "", $_POST['city']); // filter everything but spaces, numbers, and letters
    $accounttype = ereg_replace("[^a-z]", "", $_POST['accounttype']); // filter everything but lowercase letters
    $email = stripslashes($_POST['email']);
    $email = strip_tags($email);
    $email = mysql_real_escape_string($email);
    $password = ereg_replace("[^A-Za-z0-9]", "", $_POST['password']); // filter everything but numbers and letters
    // Check to see if the user filled all fields with
    // the "Required"(*) symbol next to them in the join form
    // and print out to them what they have forgotten to put in
    if ((!$username) || (!$country) || (!$state) || (!$city) || (!$accounttype) || (!$email) || (!$password)) {

        $errorMsg = "You did not submit the following required information!<br /><br />";
        if (!$username) {
            $errorMsg .= "--- User Name";
        } else if (!$country) {
            $errorMsg .= "--- Country";
        } else if (!$state) {
            $errorMsg .= "--- State";
        } else if (!$city) {
            $errorMsg .= "--- City";
        } else if (!$accounttype) {
            $errorMsg .= "--- Account Type";
        } else if (!$email) {
            $errorMsg .= "--- Email Address";
        } else if (!$password) {
            $errorMsg .= "--- Password";
        }
    } else {
        // Database duplicate Fields Check
        $sql_username_check = mysql_query("SELECT id FROM members WHERE username='$username' LIMIT 1");
        $sql_email_check = mysql_query("SELECT id FROM members WHERE email='$email' LIMIT 1");
        $username_check = mysql_num_rows($sql_username_check);
        $email_check = mysql_num_rows($sql_email_check);
        if ($username_check > 0) {
            $errorMsg = "<u>ERROR:</u><br />Your User Name is already in use inside our system. Please try another.";
        } else if ($email_check > 0) {
            $errorMsg = "<u>ERROR:</u><br />Your Email address is already in use inside our system. Please try another.";
        } else {
            // Add MD5 Hash to the password variable
            $hashedPass = md5($password);
            // Add user info into the database table, claim your fields then values 
            $sql = mysql_query("INSERT INTO members (username, country, state, city, accounttype, email, password, signupdate) 
		VALUES('$username','$country','$state','$city','$accounttype','$email','$hashedPass', now())") or die(mysql_error());
            // Get the inserted ID here to use in the activation email
            $id = mysql_insert_id();
            // Create directory(folder) to hold each user files(pics, MP3s, etc.) 
            mkdir("memberFiles/$id", 0755);
            // Start assembly of Email Member the activation link
            $to = "$email";
            // Change this to your site admin email
            $from = "developer@rolandomoreno.com";
            $subject = "Complete your registration";
            //Begin HTML Email Message where you need to change the activation URL inside
            $message = '<html>
		<body bgcolor="#FFFFFF">
		Hi ' . $username . ',
		<br /><br />
		You must complete this step to activate your account with us.
		<br /><br />
		Please click here to activate now &gt;&gt;
		<a href="http://www.food.rolandomoreno.com/activation.php?id=' . $id . '">
		ACTIVATE NOW</a>
		<br /><br />
		Your Login Data is as follows: 
		<br /><br />
		E-mail Address: ' . $email . ' <br />
		Password: ' . $password . ' 
		<br /><br /> 
		Thanks! 
		</body>
		</html>';
            // end of message
            $headers = "From: $from\r\n";
            $headers .= "Content-type: text/html\r\n";
            $to = "$to";
            // Finally send the activation email to the member
            mail($to, $subject, $message, $headers);
            // Then print a message to the browser for the joiner 
            print "<br /><br /><br /><h4>OK $firstname, one last step to verify your email identity:</h4><br />
		We just sent an Activation link to: $email<br /><br />
		<strong><font color=\"#990000\">Please check your email inbox in a moment</font></strong> to click on the Activation <br />
		Link inside the message. After email activation you can log in.";
            exit(); // Exit so the form and page does not display, just this success message
        } // Close else after database duplicate field value checks
    } // Close else after missing vars check
} //Close if $_POST
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
            <div class="container text-center">
                <div class="col-md-offset-4 col-md-4">
                    <h4>Sign up for free!</h4>

                    <form action="join_form.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <?php echo "$errorMsg"; ?>
                        </div>
                        <div class="form-group">
                            <label for="userName">User Name</label>
                            <input type="text" class="form-control" id="userName" placeholder="Enter user name" value="<?php echo "$username"; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo "$email"; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password (letters or numbers only, no spaces no symbols)" value="<?php echo "$password"; ?>"  required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo "$email"; ?>"  required>
                        </div>
                        <div class="form-group">
                            <h4>Captcha! Add Captcha here.</h4>
                        </div>
                        <div class="form-group">		
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                        <h6>&copy <?php echo date('Y'); ?> Rolando Moreno</h6>
                    </form>
                <!-- <tr>
                  <td><div align="right">Country:</div></td>
                  <td><select name="country">
                  <option value="<?php echo "$country"; ?>"><?php echo "$country"; ?></option>
                  <option value="Australia">Australia</option>
                  <option value="Canada">Canada</option>
                  <option value="Mexico">Mexico</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="United States">United States</option>
                  <option value="Zimbabwe">Zimbabwe</option>
                  </select></td>
                </tr>
                <tr>
                  <td><div align="right">State: </div></td>
                  <td><input name="state" type="text" value="<?php echo "$state"; ?>" /></td>
                </tr>
                <tr>
                  <td><div align="right">City: </div></td>
                  <td>
                    <input name="city" type="text" value="<?php echo "$city"; ?>" />
                  </td>
                </tr>
                <tr>
                  <td><div align="right">Account Type: </div></td>
                  <td><select name="accounttype">
                    <option value="<?php echo "$accounttype"; ?>"><?php echo "$accounttype"; ?></option>
                    <option value="a">Normal User</option>
                    <option value="b">Expert User</option>
                    <option value="c">Super User</option>
                  </select></td>
                </tr> -->
                </div>
            </div>
        </section>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="js/clock.js"></script>
    </body>
</html>