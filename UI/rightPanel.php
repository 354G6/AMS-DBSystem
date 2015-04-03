<?php
if (!isset($_SESSION["role"])&&$_GET["op"]!="procLogin") { include('loginPage.php'); }
else {
    switch($_GET["op"]) {
        case "register":
            include('customer-registration.php');
            break;
        case "procReg":
            include('processRegistration.php');
            break;
        case "home":
            include('homepage.php');
            break;
        case "procLogin":
            include('processLogin.php');
            break;
        case "login":
            include('loginPage.php');
            break;
        default:
            echo 'Invalid Operation.';
            break;
    }

}
?>