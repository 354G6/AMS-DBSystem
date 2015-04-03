<?php
session_start();
//header('Location: homepage.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Allegro Music Store DBSystem | CMPT354 G6</title>
<link type="text/css" rel="stylesheet" href="stylesheets/project.css">
</head>

<body>
<?
//list of operations and pages
$operations = array();

//test data
//$operations = array(
//                "addItem"=>"Add Items to Store",
//                "procDelivery"=>"Process Delivery of Order",
//                "dailySales"=>"Generate Daily Sales Report",
//                "topSelling"=>"Get Top Selling Items"
//                );

//exception when registering
if ($_GET["op"]=="register" || $_GET["op"]=="procReg") $_SESSION["role"]="guest";

if ($_GET["op"]=="login") session_unset();

echo "[DEBUG] YOUR ROLE: (".$_SESSION["role"]."); OPERATION: (".$_GET["op"].")";

//customer ($role=cust) 
if ($_SESSION["role"]=="customer") {
	$operations = array(
					"itemPurchase"=>"Purchase Item",
					"feedback"=>"Give Feedback"
					);
}

//manager ($role=mana)
elseif ($_SESSION["role"]=="manager") {
	$operations = array(
				    "addItem"=>"Add Items to Store",
				    "procDelivery"=>"Process Delivery of Order",
				    "dailySales"=>"Generate Daily Sales Report",
				    "topSelling"=>"Get Top Selling Items"
					);
}

//clerk ($role=clerk)
elseif ($_SESSION["role"]=="clerk") {
	$operations = array(
					"processReturn"=>"Process Return"
					);
}
elseif ($_SESSION["role"]=="guest") {}

else {
    //session_unset();
}
?>

<div id="Header">
  <h1 id="AppName">Allegro Music Store DBSystem</h1>
  <h3 id="Author">CMPT354 G6</h3>
  <ul id="Navi" class="menu">
	<li><a class="menu" href="?op=home">Home</a></li>
	<? if (isset($_SESSION["role"]) && $_SESSION["role"]!="guest") echo'<li><a class="menu" href="?op=login">Logout</a></li>';?>
  </ul>
</div>
<div id="Contents">
	<div id="LeftPanel">
	    <h4 class="menu"><?php if (isset($_SESSION["role"]) && $_SESSION["role"]!="guest") echo $_SESSION["role"].' Menu'; ?></h4>
		<ul id="OperationList" class="menu">
			<?php
            $i = 0;
			foreach($operations as $page => $op) {
				echo '<li><a class="menu" href="?op='.$page.'">'.$op.'</a></li>';
                $i++;
			}
			?>
		</ul>
	</div>
	<div id="RightPanel">
	  <div>[DEBUG]Operation: <?echo $_GET['op'];?></div>
	  <div>[DEBUG]Contents:</div>
      <?php include('rightPanel.php');?>
	</div>
</div>
<div id="Footer">
    <div id="copyright">(C) Copyright 2015 Spring CMPT354 Group 6</div>
    <div> Group Members: Ricky Wong, Yaolong Lin, Nicholas Walsh, Alan Li, Venus Ye</div>
</div>
</body>
</html>
