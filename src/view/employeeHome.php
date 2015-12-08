<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/21/2015
 * Time: 9:17 PM
 */
require_once '../controller/SqliteRepository.php';
require_once '../model/Customer.php';
require_once '../model/Employee.php';

$repo = new \pnaika\finals\SqliteRepository();
$employeeId = isset($_GET['empId']) ? $_GET['empId'] : '';
$employee = $repo->getEmployeeById($employeeId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMPLOYEE HOME</title>
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

    <div id="header-container">
        <ul class="secondary-nav">
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
    </div>

    <div class="page-header">
        <?php print '<h1>HELLO  '.strtoupper($employee->getEmployeeName()).'</h1>' ?>
    </div>
    <div>
        <h5>PLEASE SELECT FROM THE BELOW OPTION!</h5
    </div>

    <table class="table table-striped">
        <tbody>
        <?php
        print '<tr>
            <td>ALL EMPLOYEE RECORDS </td>
             <td><a href="showAllEmployee.php?empId='.$employee->getEmpId() .'">CLICK HERE!</a></td>
        </tr>';
        print '<tr>
            <td>CUSTOMER DETAILS </td>
            <td> <a href="showAllCustomer.php?empId='.$employee->getEmpId().'">CLICK HERE!</a></td>
        </tr>';
        print '<tr>
            <td>PAYMENT INFORMATION </td>
            <td> <a href="showPayment.php?empId='.$employee->getEmpId().'">CLICK HERE!</a></td>
        </tr>';
        ?>
        </tbody>
    </table>


    <table class="table">
        <?php
        print
            '<tr>
            <td> DO YOU WANT TO UPDATE YOUR PROFILE ? </td>
            <td>
            <form method="post" action="employeeProfile.php?empId='.$employee->getEmpId().'">
                <input type="hidden" name="empId" value="'.$employee->getEmpId().'">
                <button type="submit" class="btn btn-primary">CLICK HERE!</button>
            </form>
            </td>
        </tr>';
        ?>
    </table>
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
