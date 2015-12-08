<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/26/2015
 * Time: 7:46 PM
 */

require_once '../controller/SqliteRepository.php';
require_once '../model/Customer.php';
$repo = new \pnaika\finals\SqliteRepository();

if (isset($_GET['$adminId'])){
    $adminId = $_GET['adminId'];
    $role = 'ADMIN';
} elseif (isset($_POST['adminId'])) {
    $adminId = $_POST['adminId'];
    $role = 'ADMIN';
} else {
    $adminId = '';
    $role = '';
}

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CREATE NEW USER</title>
    <link rel="stylesheet" href="../style/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
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
            <li><a href="adminHome.php">BACK</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
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

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <?php
            $customerName = isset($_POST['cName']) ? input($_POST['cName']) : '';
            $email = isset($_POST['email']) ? input($_POST['email']) : '';
            $phoneNumber = isset($_POST['phone']) ? input($_POST['phone']) : '';
            $address = isset($_POST['address']) ? input($_POST['address']) : '';;
            $password = isset($_POST['password']) ? input($_POST['password']) : '';;
            $formIsValid = true;
            $customerNameErr = '';
            $passwordErr = '';
            $time = date("d M Y - h:i:s A");
            if (empty($customerName)){
                $formIsValid = false;
                $customerNameErr = '<span style="color: #f00;">NAME IS A REQUIRED FIELD!</span>';
            }
            if (empty($password)){
                $formIsValid = false;
                $passwordErr = '<span style="color: #f00;">PASSWORD IS MANDATORY!</span>';
            }
        ?>
        <?php if ($formIsValid): ?>
            <?php
            $repo = new \pnaika\finals\SqliteRepository();
            $customerDetails = new \pnaika\finals\Customer();
            $customerDetails->setCustomerName($customerName);
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $customerDetails->setPassword($hashPassword);
            $customerDetails->setAddress($address);
            $customerDetails->setEmail($email);
            $customerDetails->setPhoneNumber($phoneNumber);
            $customerDetails->setLastUpdate($time);
            $repo->saveCustomer($customerDetails);
            ?>
            <header></header>

            <div class="alert alert-success" role="alert">
                <h2>CUSTOMER PROFILE GOT CREATED!</h2>
                <h5>CUSTOMER SHOULD USE NEWLY CREATED USERNAME AND PASSWORD TO LOGIN :) </h5>
            </div>

        <?php else: ?>
            <header>CREATE NEW USER</header>
            <form action="customerSignUp.php" method="POST" id="loginForm">
                <input type="hidden" name="adminId" value="<?php print $adminId; ?>">
                <div class="form-group">
                    <label for="cName">FULL NAME/USER NAME</label>
                    <input type="text" name="cName" class="form-control" id="cName" placeholder="FULL NAME" required>
                    <?php print $customerNameErr; ?>
                </div>
                <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="EMail">
                </div>
                <div class="form-group">
                    <label for="phone">PHONE NUMBER</label>
                    <input type="number" name="phone" class="form-control" id="phone" min="1000000000" max="9999999999" placeholder="PHONE NUMBER">
                </div>
                <div class="form-group">
                    <label for="address">ADDRESS</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="ADDRESS">
                </div>
                <div class="form-group">
                    <label for="password">IF YOU WISH TO HAVE NEW PASSWORD?</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="PASSWORD" required>
                    <?php print $passwordErr; ?>
                </div>
                <button type="submit" class="btn btn-default">SAVE</button>
                <button type="reset" class="btn btn-default">RESET</button>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <header>CREATE NEW USER</header>
        <form action="customerSignUp.php" method="POST" id="loginForm">
            <input type="hidden" name="adminId" value="<?php print $adminId; ?>">
            <div class="form-group">
                <label for="cName">FULL NAME/USER NAME</label>
                <input type="text" name="cName" class="form-control" id="cName" placeholder="FULL NAME"  required>
                <br>
            </div>
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="EMail" >
            </div>
            <div class="form-group">
                <label for="phone">PHONE NUMBER</label>
                <input type="number" name="phone" class="form-control" min="1000000000" max="9999999999" id="phone" placeholder="PHONE NUMBER">
            </div>
            <div class="form-group">
                <label for="address">ADDRESS</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="ADDRESS" >
            </div>
            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="PASSWORD"  required>
            </div>
            <button type="submit" class="btn btn-default">SAVE</button>
            <button type="reset" class="btn btn-default">RESET</button>
        </form>
    <?php endif; ?>
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