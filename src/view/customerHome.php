<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/21/2015
 * Time: 9:17 PM
 */
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
    exit;
}
require_once '../controller/SqliteRepository.php';
require_once '../model/Customer.php';
require_once '../model/Employee.php';

$repo = new \pnaika\finals\SqliteRepository();
$customerId = isset($_GET['id']) ? $_GET['id'] : '';
$customer = $repo->getCustomerById($customerId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CUSTOMER HOME</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="../style/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
</head>
<body>
<div id="wrapper">

    <div class="page-header">
       <?php print '<header>Hello  '.$customer->getCustomerName().'</header>' ?>
    </div>
    <div>
        <h5>Please select from the below options available!</h5
    </div>

    <table class="table table-striped">
        <tbody>
        <?php
        print '<tr>
            <td>Want to Reserve the site for your vehicle </td>
             <td><a href="createPayment.php?id='.$customer->getId() .'">CLICK HERE!</a></td>
        </tr>';
        print '<tr>
            <td>Want to See your Reservation? </td><td> <a href="showPayment.php?id='. $customer->getId().'">CLICK HERE!</a></td>
        </tr>';
        print '<tr>
            <td> Do you want to Update your profile ? </td><td> <a href="customerProfile.php?id='.$customer->getId().'">CLICK HERE!</a></td>
        </tr>'
        ?>
        </tbody>
    </table>


    <a href="index.php?logout=yes" class="btn btn-primary">logout</a>
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
