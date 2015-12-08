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
        <p>
            Global Parking Systems, Inc. is a diverse provider of professional parking, ground transportation, facility maintenance, security and event logistics services to real estate
            owners and managers in a wide array of markets.
        </p>
        <p>
            Our organization&#39;s cultural underpinning is a commitment to put Innovation In Operation. That
            means we are constantly challenging ourselves to use our tools and cultural attributes &#45; innovation +
            creativity + excellence + integrity + initiative + knowledge + technology + experience + efficiency &#45; to
            develop new and better ways of doing things in order to improve the
            effectiveness and efficiency of everything we do. That is our promise, both to ourselves and to you
        </p>
        <p>
            Contact<b> Global Parking Systems, Inc.</b>	by telephone or email to place your order and begin your parking equipment installation
        </p>
    </div>
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