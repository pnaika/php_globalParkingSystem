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
require_once '../model/Admin.php';

$repo = new \pnaika\finals\SqliteRepository();
$time = date("d M Y - h:i:s A");

if(isset($_GET['empId'])) {
    $employeeId = $_GET['empId'];
    $employee = $repo->getEmployeeById($employeeId);
    $role = 'EMPLOYEE';
} else if(isset($_GET['adminId'])){
    $adminId = $_GET['adminId'];
    $role = 'ADMIN';
}
$allCustomers = $repo->getAllCustomers();
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
    if($role === "ADMIN"){
        print '<div id="header-container">
        <ul class="secondary-nav">
            <li><a href="adminHome.php?adminId='.$adminId.'">BACK</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
        </div>';
        print '<h4>HELLO ADMIN , THESE ARE THE EMPLOYEE LIST IN OUR COMPANY</h4>';
    } elseif ($role = "EMPLOYEE") {
        print '<div id="header-container">
        <ul class="secondary-nav">
            <li><a href="employeeHome.php?empId='.$employee->getEmpId().'">BACK</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
        </div>';
        print '<h4>HELLO  '. $employee->getEmployeeName().' , THESE ARE THE EMPLOYEE LIST IN OUR COMPANY</h4>';
    }
    ?>

    <hr>
    <table class="table table-striped">
        <tr>
            <th>CUSTOMER NAME</th>
            <th>EMAIL</th>
            <th>ADDRESS</th>
            <th>PHONE</th>
            <th>LAST UPDATE</th>
            <?php if($role === "ADMIN"){
                print '<th>ACTION</th>';
            }?>
        </tr>
        <?php
        foreach($allCustomers as $cust) {
            print '<tr>';
            print '<td>' . $cust->getCustomerName() . '</td>';
            print '<td>' . $cust->getEmail() . '</td>';
            print '<td>' . $cust->getAddress() . '</td>';
            print '<td>' . $cust->getPhoneNumber() . '</td>';
            print '<td>' . $cust->getLastUpdate()  . '</td>';
            if($role === "ADMIN"){
                print '<td><form action="confirmationCustDelete.php" method="POST">
                            <input type="hidden" name="adminId" value="'.$adminId.'">
                            <input type="hidden" name="custId" value="'.$cust->getId().'">
                            <button type="submit" class="btn btn-primary">DELETE</button>
                        </form></td>';
            }
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

