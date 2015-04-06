<?php
//include different php pages according to the login session and the operation from GET method

if (!isset($_SESSION["role"])&&$_GET["op"]!="procLogin") { include('loginPage.php'); }
elseif ($_SESSION["role"]=="guest"&&!isset($_GET["op"])) { include('loginPage.php'); }
else {
    switch($_GET["op"]) {
        case "register":
            include('customer-registration.php');
            break;
        case "home":
            include('homepage.php');
            break;
        case "login":
            include('loginPage.php');
            break;
            
        //customer
        case "purchase": //to be done (RICKY)
            include('customer-purchase.php');
            break;
        case "cart": //to be done (RICKY)
            include('customer-shoppingCart.php');
            break;
            
        //manager
        case "additem":
            include('manager-defaultAdd.php');
            break;
        case "procdelivery": //to be done
            include('manager-deliver.php');
            break;
        case "dailysales": //to be done
            include('manager-dailyReport.php');
            break;
        case "topselling": //to be done
            include('manager-topselling.php');
            break;
            
        //clerk
        case "refund": //to be done
            include('clerk-refund.php');
            break;
            
        default:
            echo '<h3>Invalid Operation.</h3>';
            break;
    }

}
?>