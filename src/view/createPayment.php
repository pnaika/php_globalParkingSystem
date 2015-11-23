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
require_once '../model/Payment.php';

$repo = new \pnaika\finals\SqliteRepository();
$customerId = isset($_GET['id']) ? $_GET['id'] : '';
$customer = $repo->getCustomerById($customerId);

$parkingHours = isset($_POST['timeofParking']) ? input($_POST['timeofParking']) : '';
$formIsValid = true;
$hoursFieldErr = '';

$time = date("d M Y - h:i:s A");

if (empty($parkingHours)){
    $formIsValid = false;
    $hoursFieldErr = '<span style="color: #f00;">Required Field!</span>';
}

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reserve Parking</title>
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

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <?php if ($formIsValid): ?>
            <?php
                $customerId = isset($_GET['id']) ? $_GET['id'] : '';
                $customer = $repo->getCustomerById($customerId);

                $payment = new \pnaika\finals\Payment();
                $payment->setHours($parkingHours);
                $amount = $payment->getHours() * 10;
                $payment->setPaymentAmount($amount);
                $payment->setPaymentDate($time);
                $payment->setCustomerId($customer->getId());

                $repo->savePayments($payment);

                print '<h1>Reservation Successful!!!</h1>
                    <h4>Please find the Details below.</h4>
                    <p>Customer Name :'. $customer->getCustomerName().'</p>
                    <p>Contact Num. :'. $customer->getPhoneNumber().'</p>
                    <p>Address : '.$customer->getAddress().'</p>
                    <p>Email :  '. $customer->getPhoneNumber().'</p>
                    <p>Amount : '. $payment->getPaymentAmount() .'</p>
                    <p>Parking Hours : '. $payment->getHours() .'</p>
                    <p>Payment Date : '. $payment->getPaymentDate() .'</p>

                    <h3><a href="customerHome.php?id='.$customer->getId().'">HOME</a></h3>'
            ?>
        <?php else: ?>
            <h1>RESERVE A SLOT!</h1>
            <div>
                <h5>Please fill the below information and Submit your Reservation.</h5
            </div>
            <?php
            $customerId = isset($_GET['id']) ? $_GET['id'] : '';
            $customer = $repo->getCustomerById($customerId);

            print '<form action="createPayment.php?id='.$customer->getId().'" method="POST" id="loginForm">
                <div class="form-group">
                    <label for="timeofParking">How many hours you wish to park ?</label>
                    <input type="number" min="1" max="24" name="timeofParking" class="form-control" id="timeofParking" placeholder="How many hours you wish to park ?"
                           value="<?php print $parkingHours; ?>">
                    <?php print $hoursFieldErr; ?>
                    <br>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-default">SUBMIT</button>
                    <button type="reset" class="btn btn-default">RESET</button>
                </div>
            </form>'
            ?>

            <h3><a href="customerHome.php">HOME</a></h3>
        <?php endif; ?>
    <?php else: ?>
        <h1>RESERVE A SLOT!</h1>
        <div>
            <h5>Please fill the below information and Submit your Reservation.</h5
        </div>
        <?php
        $customerId = isset($_GET['id']) ? $_GET['id'] : '';
        $customer = $repo->getCustomerById($customerId);

        print '<form action="createPayment.php?id='.$customer->getId().'" method="POST" id="loginForm">
                <div class="form-group">
                    <label for="timeofParking">How many hours you wish to park ?</label>
                    <input type="number" min="1" max="24" name="timeofParking" class="form-control" id="timeofParking" placeholder="How many hours you wish to park ?"
                           value="<?php print $parkingHours; ?>">
                    <?php print $hoursFieldErr; ?>
                    <br>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-default">SUBMIT</button>
                    <button type="reset" class="btn btn-default">RESET</button>
                </div>
            </form>'
        ?>

        <h3><a href="customerHome.php">HOME</a></h3>
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
