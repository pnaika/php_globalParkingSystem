<?php
/**
 * Created by PhpStorm.
 * User: Prashanth
 * Date: 11/21/2015
 * Time: 8:05 PM
 */

session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ABOUT US</title>
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
            <li><a href="customerSignUp.php">CUSTOMER SIGN UP</a></li>
            <li><a href="index.php">LOG IN</a></li>
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

    <header></header>
    <div class="aboutUs">
            <p> Whether you are an existing customer who needs to schedule a service call,
                talk to your sales rep or ask about our latest offers on parking, or you and your company
                are looking for more information on our services, our customer service department will
                handle your inquiry and get you to the person who can get you the information you are looking for.
            </p>
            <p>
                You may contact us by phone or by email.
                Your business is important to us and we pledge to respond to your inquiry within 24 hours.
            </p>
    </div>
    <pre>
		<strong>Mailing Address</strong>       				                                                                          <strong>Phone Number</strong>
		1826 S Canal St      				                                                                          800-555-1825
		Chicago, IL 60616  					                                                                  312-555-3000
		</pre>
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