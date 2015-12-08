<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/21/2015
 * Time: 8:05 PM
 */

session_start();

require_once '../controller/SqliteRepository.php';
require_once '../model/Customer.php';
require_once '../model/Employee.php';

$u = new \pnaika\finals\SqliteRepository();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['userName']) ? trim($_POST['userName']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $userType = isset($_POST['userType']) ? trim($_POST['userType']) : '';

    if($userType == 'customer'){
        $res = $u->getCustomerDetails($username, $password);
        $id = $res->getId();
        $passwordValue = $res->getPassword();
        $isValid = password_verify($password, $passwordValue);
        if ($username == $res->getCustomerName() && $isValid) {
            $_SESSION['user'] = $username;

            header("Location: customerHome.php?id=$id");
        } else {
            print '<div class="alert alert-danger" role="alert"><strong>INVALID LOGIN ! </strong>'.strtoupper($username).' & '.'PASSWORD ENTERED DOES NOT MATCH IN OUR SYSTEM. '.'</div>';
        }
    } else if($userType == 'employee') {
        $res = $u->getEmployeeDetails($username, $password);
        $id = $res->getEmpId();
        $passwordValue = $res->getPassword();
        $isValid = password_verify($password, $passwordValue);
        if ($username == $res->getEmployeeName() && $isValid) {
            $_SESSION['user'] = $username;

            header("Location: employeeHome.php?empId=$id");
        } else {
            print '<div class="alert alert-danger" role="alert"><strong>INVALID LOGIN ! </strong>'.strtoupper($username).' & '.'PASSWORD ENTERED DOES NOT MATCH IN OUR SYSTEM. '.'</div>';
        }
    } else if($userType == 'admin') {
        $res = $u->getAdminDetails($username, $password);
        $id = $res->getId();
        if ($username == $res->getAdminUserName() && $password == $res->getPassword()) {
            $_SESSION['user'] = $username;

            header("Location: adminHome.php?adminId=$id");
        } else {
            print '<div class="alert alert-danger" role="alert"><strong>INVALID LOGIN ! </strong>'.strtoupper($username).' & '.'PASSWORD ENTERED DOES NOT MATCH IN OUR SYSTEM. '.'</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="../style/style.css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<a href="index.php"><img class="logo" src="../images/logo/gpsLogo.jpg" alt="CCS" title="GLOBAL PARKING SYSTEM"></a>
<div id="wrapper">

    <div id="header-container">
        <ul class="secondary-nav">
            <li><a href="custSignUp.php">CUSTOMER SIGN UP</a></li>
        </ul>
    </div>

    <nav id="main-nav">
        <div id="nav-div">
            <ul>
                <li><a href="about.php">ABOUT US</a></li>
                <li><a href="contact.php">CONTACT US</a></li>
            </ul>
        </div>
    </nav>

    <div>
        <header>WELCOME TO GLOBAL PARKING SYSTEM !!!</header>
    </div>

    <form action="#" method="POST" id="loginForm">
        <div class="form-group">
            <label for="j_username" class="col-sm-2 control-label">USERNAME</label>
            <input class="form-control" placeholder="Username" type="text" id="j_username" name="userName"/>
        </div>
        <div class="form-group">
            <label for="j_password" class="col-sm-2 control-label">PASSWORD</label>
            <input class="form-control" placeholder="Password" id="j_password" type="password" name="password"/>
        </div>
        <div class="form-group">
            <label for="userType" class="col-sm-6 control-label">SELECT YOUR ROLE</label>
            <select class="form-control" name="userType" id="userType" required>
                <option value="customer">CUSTOMER</option>
                <option value="employee">EMPLOYEE</option>
                <option value="admin">ADMIN</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm btn-block">LOG IN</button>
        <button type="reset" class="btn btn-primary btn-sm btn-block">RESET</button>
    </form>
    <footer>
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <span class="glyphicon glyphicon-copyright-mark" aria-hidden="false">CopyRight |PrashanthNaik 2015 ||</span>
                <a href="https://www.linkedin.com/" target="_blank" id="link"><i class="fa fa-linkedin"></i></a>
                <a href="https://www.twitter.com/" target="_blank" id="tw"><i class="fa fa-twitter"></i></a>
                <a href="https://www.facebook.com/" target="_blank" id="fb"><i
                        class="fa fa-facebook-official"></i></a>
                <a href="https://www.whatsapp.com/" target="_blank" id="wa"><i class="fa fa-whatsapp"></i></a>
                <a href="https://www.instagram.com/" target="_blank" id="ins"><i
                        class="fa fa-instagram"></i></a>
                <a href="https://www.google.com/" target="_blank" id="gm"><i class="fa fa-google"></i></a>
            </div>
        </nav>
    </footer>
</div>
</body>
</html>