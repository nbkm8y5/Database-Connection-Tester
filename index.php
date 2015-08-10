<?php
require_once 'php/DatabaseConnection.php';
require_once "php/ContactFormReport.php";

$connect = new DatabaseConnector();
$connect->connect();

$report = new ContactFormReport();
$report->setConn($connect->getConnection());
$report->query();

$connect->closeConnection();
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
        <title>Database Tester Connected to world db</title>

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

        <div class="container-fluid">
            <div class = "col-md-offset-4 col-md-4">
                <img class="img-responsive" src="images/MPS final logo-01.svg" alt="MPS Logo">
                <h1 class="text-center">Database Tester</h1>
                <h6><?php echo $connect->getConnectionInfo(); ?></h6>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Country</th>
                            <th>Population</th>
                        </tr>
                        <?php
                        echo $report->getReport();
                        ?>
                    </table>
                </div>

                <h6>&copy <?php echo date('Y'); ?> Rolando Moreno</h6>
            </div>
        </div>




        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="js/clock.js"></script>
    </body>
</html>