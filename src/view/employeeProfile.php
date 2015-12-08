<?php

session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
    exit;
}

require_once '../controller/SqliteRepository.php';
require_once '../model/Employee.php';
$repo = new \pnaika\finals\SqliteRepository();

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['empId'])): ?>
    <?php
    $employee = $repo->getEmployeeById(($_POST['empId'])); ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>EMPLOYEE PROFILE</title>
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
            <li><?php print '<a href="employeeHome.php?empId='.$employee->getEmpId().'">HOME</a>'?></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
        </div>
        <h1>EDIT EMPLOYEE DETAILS</h1>
        <form action="employeeProfile.php" method="POST" id="loginForm">
            <input type="hidden" name="employeeId" value="<?php print $_POST['empId']; ?>">
            <div class="form-group">
                <label for="cName">EMPLOYEE'S FULL NAME/USER NAME</label>
                <input type="text" name="cName" class="form-control" id="cName" placeholder="FULL NAME" value="<?php print $employee->getEmployeeName(); ?>" required>
                <br>
            </div>
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="EMail"value="<?php print $employee->getEmpEmail(); ?>">
            </div>
            <div class="form-group">
                <label for="phone">PHONE NUMBER</label>
                <input type="number" name="phone" class="form-control" id="phone" min="1000000000" max="9999999999" placeholder="PHONE NUMBER" value="<?php print $employee->getEmpPhoneNumber(); ?>">
            </div>
            <div class="form-group">
                <label for="address">ADDRESS</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="ADDRESS" value="<?php print $employee->getEmpAddress(); ?>">
            </div>
            <div class="form-group">
                <label for="password">IF YOU WISH TO HAVE NEW PASSWORD?</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="PASSWORD" required>
            </div>
            <button type="submit" class="btn btn-default">SAVE</button>
            <button type="reset" class="btn btn-default">RESET</button>
        </form>
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
<?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['employeeId'])): ?>
    <?php
    $employeeName = isset($_POST['cName']) ? input($_POST['cName']) : '';
    $email = isset($_POST['email']) ? input($_POST['email']) : '';
    $phoneNumber = isset($_POST['phone']) ? input($_POST['phone']) : '';
    $address = isset($_POST['address']) ? input($_POST['address']) : '';;
    $password = isset($_POST['password']) ? input($_POST['password']) : '';;
    $formIsValid = true;
    $employeeNameErr = '';
    $passwordErr = '';
    $time = date("d M Y - h:i:s A");
    if (empty($employeeName)){
        $formIsValid = false;
        $employeeNameErr = '<span style="color: #f00;">NAME IS A REQUIRED FIELD!</span>';
    }
    if (empty($password)){
        $formIsValid = false;
        $passwordErr = '<span style="color: #f00;">PASSWORD IS MANDATORY!</span>';
    }
    ?>
    <?php if ($formIsValid): ?>
         <?php
            $employee = $repo->getEmployeeById($_POST['employeeId']);
            $employee->setEmployeeName($employeeName);
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $employee->setPassword($hashPassword);
            $employee->setEmpAddress($address);
            $employee->setEmpEmail($email);
            $employee->setEmpPhoneNumber($phoneNumber);
            $employee->setEmpLastUpdate($time);
            $repo->saveEmployee($employee);
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>UPDATE EMPLOYEE PROFILE</title>
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
            <li><?php print '<a href="employeeHome.php?empId='.$employee->getEmpId().'">HOME</a>'?></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
        </div>
            <div class="alert alert-success" role="alert">EMPLOYEE DETAILS GOT UPDATED!</div>
            <h3>PLEASE USE YOUR NEW USERNAME AND PASSWORD TO LOGIN NEXT TIME :) </h3>
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
    <?php else: ?>
        <?php
        $employee = $repo->getEmployeeById(($_POST['employeeId'])); ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>UPDATE EMPLOYEE PROFILE</title>
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
            <li><?php print '<a href="employeeHome.php?empId='.$employee->getEmpId().'">HOME</a>'?></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
        </ul>
        </div>
        <h1>EDIT EMPLOYEE PROFILE</h1>
        <form action="employeeProfile.php" method="POST" id="loginForm">
             <input type="hidden" name="employeeId" value="<?php print $_POST['employeeId']; ?>">
             <div class="form-group">
                 <label for="cName">EMPLOYEE'S FULL NAME/USER NAME</label>
                 <input type="text" name="cName" class="form-control" id="cName" placeholder="FULL NAME" value="<?php print $employee->getEmployeeName(); ?>" required>
                 <?php print $employeeNameErr; ?>
             </div>
             <div class="form-group">
                 <label for="email">EMAIL</label>
                 <input type="email" name="email" class="form-control" id="email" placeholder="EMail"value="<?php print $employee->getEmpEmail(); ?>">
             </div>
             <div class="form-group">
                 <label for="phone">PHONE NUMBER</label>
                 <input type="number" name="phone" class="form-control" id="phone" min="1000000000" max="9999999999" placeholder="PHONE NUMBER" value="<?php print $employee->getEmpPhoneNumber(); ?>">
             </div>
             <div class="form-group">
                 <label for="address">ADDRESS</label>
                 <input type="text" name="address" class="form-control" id="address" placeholder="ADDRESS" value="<?php print $employee->getEmpAddress(); ?>">
             </div>
             <div class="form-group">
                 <label for="password">IF YOU WISH TO HAVE NEW PASSWORD?</label>
                 <input type="password" name="password" class="form-control" id="password" placeholder="PASSWORD" required>
                 <?php print $passwordErr; ?>
             </div>
             <button type="submit" class="btn btn-default">SAVE</button>
             <button type="reset" class="btn btn-default">RESET</button>
        </form>
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
    <?php endif; ?>
<?php else: ?>
    <!doctype html>
    <html lang="en">
    <head>
        <title>EDIT EMPLOYEE PROFILE</title>
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
    <?php
        $employee = $repo->getEmployeeById(($_POST['empId'])); ?>
    <div id="header-container">
        <ul class="secondary-nav">
            <li><a href="http://google.com" target="_blank">Google</a></li>
            <li><a href="index.php?logout=yes">LOGOUT</a></li>
            <li><?php print '<a href="employeeHome.php?empId='.$employee->getEmpId().'">HOME</a>'?></li>
        </ul>
        </div>
          <h1>NO EMPLOYEE IS SELECTED TO EDIT</h1>

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
<?php endif;?>