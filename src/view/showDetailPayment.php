<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/22/2015
 * Time: 1:00 PM
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
require_once '../model/Payment.php';

$repo = new \pnaika\finals\SqliteRepository();
$time = date("d M Y - h:i:s A");
$customerId = isset($_GET['custId']) ? $_GET['custId'] : '';
$employeeId = isset($_GET['empId']) ? $_GET['empId'] : '';
$paymentId = isset($_GET['payId']) ? $_GET['payId'] : '';


if(($_GET['ROLE']) === 'Cust') {
    $customer = $repo->getCustomerById($customerId);
    $paymentDetails =  $repo->getPaymentById($paymentId);
} elseif (($_GET['ROLE']) === 'Emp'){
    $employee = $repo->getEmployeeById($employeeId);
    $paymentDetails =  $repo->getPaymentById($paymentId);
    $customer = $repo->getCustomerById($paymentDetails->getCustomerId());
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SHOW ALL</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="../style/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
</head>
<body>
<a href="#"><img class="logo" src="../images/logo/gpsLogo.jpg" alt="CCS" title="GLOBAL PARKING SYSTEM"></a>
<div id="wrapper">

    <?php
    if(($_GET['ROLE']) === 'Cust'){
        print '<div id="header-container">
        <ul class="secondary-nav">
            <li><a href="showPayment.php?id='.$customer->getId().'">BACK</a></li>
            <li><a href="customerHome.php?id='.$customer->getId().'">HOME</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
        </div>';
    } elseif(($_GET['ROLE']) === 'Emp') {
        print '<div id="header-container">
        <ul class="secondary-nav">
            <li><a href="showPayment.php?empId='.$employee->getEmpId().'">BACK</a></li>
            <li><a href="employeeHome.php?empId='.$employee->getEmpId().'">HOME</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
        </div>';
    }
    ?>
    <hr>
    <h1>PAYMENT DETAILS</h1>
    <h3>PLEASE FIND THE DETAILS BELOW.</h3>
    <table class="table table-striped">
        <tbody>
        <?php
        print '<tr>
            <td>CUSTOMER NAME  </td>
             <td>'. $customer->getCustomerName().'</td>
        </tr>';
        print '<tr>
            <td>CONTACT NUM.</td>
            <td> '. $customer->getPhoneNumber().'</td>
        </tr>';
        print '<tr>
            <td> ADDRESS </td>
            <td> '.$customer->getAddress().'</td>
        </tr>';
        print '<tr>
            <td>EMAIL  </td>
             <td>'. $customer->getEmail().'</td>
        </tr>';
        print '<tr>
            <td>AMOUNT $</td>
            <td> '. $paymentDetails->getPaymentAmount() .'</td>
        </tr>';
        print '<tr>
            <td> PARKING HOURS</td>
            <td>  '. $paymentDetails->getHours() .'</td>
        </tr>';
        print '<tr>
            <td> PAYMENT DATE</td>
            <td>  '. $paymentDetails->getPaymentDate() .'</td>
        </tr>'
        ?>
        </tbody>
    </table>


    <hr>
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

