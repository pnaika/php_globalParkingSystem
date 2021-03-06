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
$customerId = isset($_GET['id']) ? $_GET['id'] : '';
$employeeId = isset($_GET['empId']) ? $_GET['empId'] : '';
if($customerId != '') {
    $customer = $repo->getCustomerById($customerId);
    $payments = $repo->getPaymentByCustId($customerId);
} elseif ($employeeId != ''){
    $employee = $repo->getEmployeeById($employeeId);
    $payments = $repo->getAllPayments();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SHOW ALL PAYMENT</title>
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
    if($customerId != ""){
        print '<div id="header-container">
        <ul class="secondary-nav">
            <li><a href="customerHome.php?id='.$customer->getId().'">BACK</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
        </div>';
    } elseif ($employeeId != "") {
        print '<div id="header-container">
        <ul class="secondary-nav">
            <li><a href="employeeHome.php?empId='.$employee->getEmpId().'">BACK</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
        </div>';
    }
    ?>
    <?php
    if($customerId != ""){
        print '<h1>LIST OF RESERVATION FROM '. $customer->getCustomerName().'</h1>';
    } elseif ($employeeId != "") {
        print '<h1>LIST OF RESERVATION FROM '. $employee->getEmployeeName().'</h1>';
    }
    ?>
    <hr>
    <h3>CLICK ON PAYMENT ID FOR MORE DETAILS</h3>
    <table class="table table-striped">
        <tr>
            <th>DATE OF TRANSACTION</th>
            <th>PAYMENT ID</th>
            <th>AMOUNT</th>
        </tr>
        <?php
        foreach($payments as $payment) {
            print '<tr>';
            print '<td>' . $payment->getPaymentDate() . '</td>';
            if($customerId != ''){
                print '<td><a href="showDetailPayment.php?custId=' . $payment->getCustomerId() . '&payId='.$payment->getPaymentId().'&ROLE=Cust">'. $payment->getPaymentId() .'</a></td>';
            }else if ($employeeId != ''){
                print '<td><a href="showDetailPayment.php?custId=' . $payment->getCustomerId() .'&empId=' . $employee->getEmpId() . '&payId='.$payment->getPaymentId().'&ROLE=Emp">'. $payment->getPaymentId() .'</a></td>';
            }
            print '<td>' . $payment->getPaymentAmount()  . '</td>';
            print '</tr>';
        }
        ?>
    </table>

        <?php
        if ($employeeId != '') {
            print '<a href="getAllPayment.php?empId=' . $employee->getEmpId() . '">MORE DETAILS</a>';
        }
        ?>
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

