<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 10/15/2015
 * Time: 7:03 PM
 */

session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
    exit;
}
require_once '../controller/SqliteRepository.php';

require_once '../model/Employee.php';
$repo = new \pnaika\finals\SqliteRepository();

$customerId = isset($_POST['custId']) ? ($_POST['custId']) : '';
$adminId = ($_POST['adminId']);
?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['custId'])): ?>
<?php
$repo->deleteCustomer($customerId);
 ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>DELETE CUSTOMER</title>
        <link rel="stylesheet" href="../style/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
    </head>
    <body>
    <div id="wrapper">
    <?php
        print '<div id="header-container">
        <ul class="secondary-nav">
            <li><a href="showAllCustomer.php?adminId='.$adminId.'">BACK</a></li>
            <li><a href="employeeHome.php?adminId='.$adminId.'">HOME</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>

        </ul>'
    ?>
        <div class="alert alert-success" role="alert">CUSTOMER DELETED !!</div>

        <footer>
                <nav class="navbar navbar-default navbar-fixed-bottom">
                    <div class="container">
                        <span class="glyphicon glyphicon-copyright-mark" aria-hidden="false">CopyRight |PrashanthNaik 2015 ||</span>
                        <a href="https://www.linkedin.com/" target="_blank" id="link"><i class="fa fa-linkedin"></i></a>
                        <a href="https://www.twitter.com/" target="_blank" id="tw"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.facebook.com/" target="_blank" id="fb"><i class="fa fa-facebook-official"></i></a>
                        <a href="https://www.whatsapp.com/" target="_blank" id="wa"><i class="fa fa-whatsapp"></i></a>
                        <a href="https://www.instagram.com/" target="_blank" id="ins"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.google.com/" target="_blank" id="gm"><i class="fa fa-google"></i></a>
                    </div>
                </nav>
            </footer>
    </div>
    </body>
    </html>
<?php else: ?>
    <!doctype html>
    <html lang="en">
    <head>
         <meta charset="UTF-8">
        <title>DELETE CUSTOMER</title>
        <link rel="stylesheet" href="../style/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
    </head>
    <body>
        <div id="wrapper">
         <?php
        print '<div id="header-container">
        <ul class="secondary-nav">
            <li><a href="showAllCustomer.php?adminId='.$adminId.'">BACK</a></li>
            <li><a href="employeeHome.php?adminId='.$adminId.'">HOME</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>

        </ul>'
    ?>
            <h1>NO CUSTOMER SELECTED FOR DELETION!</h1>
            <footer>
                <nav class="navbar navbar-default navbar-fixed-bottom">
                    <div class="container">
                        <span class="glyphicon glyphicon-copyright-mark" aria-hidden="false">CopyRight |PrashanthNaik 2015 ||</span>
                        <a href="https://www.linkedin.com/" target="_blank" id="link"><i class="fa fa-linkedin"></i></a>
                        <a href="https://www.twitter.com/" target="_blank" id="tw"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.facebook.com/" target="_blank" id="fb"><i class="fa fa-facebook-official"></i></a>
                        <a href="https://www.whatsapp.com/" target="_blank" id="wa"><i class="fa fa-whatsapp"></i></a>
                        <a href="https://www.instagram.com/" target="_blank" id="ins"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.google.com/" target="_blank" id="gm"><i class="fa fa-google"></i></a>
                    </div>
                </nav>
            </footer>
        </div>
    </body>
    </html>
<?php endif; ?>
