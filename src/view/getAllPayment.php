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

require_once '../model/Employee.php';
require_once '../model/Payment.php';

$repo = new \pnaika\finals\SqliteRepository();
$time = date("d M Y - h:i:s A");

$employeeId = isset($_GET['empId']) ? $_GET['empId'] : '';
$paymentId = isset($_GET['payId']) ? $_GET['payId'] : '';

    $employee = $repo->getEmployeeById($employeeId);
    $payments = $repo->getAllPayments();



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
        print '<div id="header-container">
        <ul class="secondary-nav">
            <li><a href="showPayment.php?empId='.$employee->getEmpId().'">BACK</a></li>
            <li><a href="employeeHome.php?empId='.$employee->getEmpId().'">HOME</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>'
    ?>

    <hr>

        <table class="table table-hover">
            <tr>
                <th>DATE OF TRANSACTION</th>
                <th>PAYMENT ID</th>
                <th>AMOUNT</th>
                <th>CUSTOMER NAME</th>
                <th>CUSTOMER PHONE</th>
                <th>CUSTOMER EMAIL</th>
                <th>CUSTOMER ADDRESS</th>
                <th>LAST UPDATED</th>
                <th>ACTION</th>
            </tr>
            <?php
            foreach($payments as $payment) {
                $customer = $repo->getCustomerById($payment->getCustomerId());
                print '<tr>';
                print '<td>' . $payment->getPaymentDate() . '</td>';
                print '<td>' . $payment->getPaymentId() . '</td>';
                print '<td>' . $payment->getPaymentAmount()  . '</td>';
                print '<td>' . $customer->getCustomerName()  . '</td>';
                print '<td>' . $customer->getPhoneNumber()  . '</td>';
                print '<td>' . $customer->getEmail()  . '</td>';
                print '<td>' . $customer->getAddress()  . '</td>';
                print '<td>' . $customer->getLastUpdate()  . '</td>';
                print '<td><form action="confirmation.php" method="POST">
                            <input type="hidden" name="payId" value="'.$payment->getPaymentId().'">
                            <input type="hidden" name="empId" value="'.$employee->getEmpId().'">
                            <button type="submit" class="btn btn-primary">DELETE</button>
                        </form></td>';
//                print '<td><a href="deletePayment.php?&empId=' . $employee->getEmpId() . '&payId='.$payment->getPaymentId().'&ROLE=Emp"> DELETE </a></td>';
                print '</tr>';
            }
            ?>
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

