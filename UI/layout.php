<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home page</title>
<style type="text/css">
body {
	font-family: Arial, Helvetica, sans-serif;
}
#Header {
	position:relative;
	width:900px;
	background-color:#EEEEEE;
	padding:10px 30px;
}

#Header>h1 {
	padding-bottom:0;
	margin-bottom:0;
	color:#000000;
}

#Header>h3 {
	padding:0px;
	margin: 0px;
	display:inline;
	color: #555555;
}
#Header>ul {
	float: right;
	padding-right:30px;
}
#Contents {
	float: left;
	width: 900px;
}
#Contents>#LeftPanel {
	clear: left;
	float: left;
	width: 200px;
	padding: 20px 0;
	margin: 0 0 0 30px;
	display: inline;
}
#Contents>#RightPanel {
	float: right;
	width: 650px;
	padding: 20px 0;
	display: inline;
}

ul.menu {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

ul#Navi>li {
    display: inline;
	color: #222222;
}

a.menu {
	text-decoration: none;
	padding-right: 20px;
}
</style>
</head>

<body>
<?
//list of operations
$operations = array();
$pages = array();
$role=$_POST["role"];
//customer ($role=cus)
if (role="cus") {
	$operations = array(
					"Purchase Item",
					"Give Feedback"
					);
	$pages = array(
					"itemPurchase",
					"feedback"
					);
}

//manager ($role=man)
elseif (role="man") {
	$operations = array(
					"Add Items to Store",
					"Process Delivery of Order",
					"Generate Daily Sales Report",
					"Get Top Selling Items"
					);
	$pages = array(
					"addItem",
					"processDelivery",
					"dailySales",
					"topSelling"
					);
}

//clerk ($role=clerk)
elseif (role="clerk") {
	$operations = array(
					"Process Return"
					);
	$pages = array(
					"processReturn"
					);
}
?>

<div id="Header">
  <h1 id="AppName">Allegro Music Store DBSystem</h1>
  <h3 id="Author">CMPT354 G6</h3>
  <ul id="Navi" class="menu">
	<li><a class="menu" href="homepage.php">Home</a></li>
	<li><a class="menu" href="login.php">Logout</a></li>
  </ul>
</div>
<div id="Contents">
	<div id="LeftPanel">
	<h4><?php echo $role ?> Menu</h4>
		<ul id="OperationList" class="menu">
			<li><a class="menu" href="?op=op1">Operation1</a></li>
			<li><a class="menu" href="?op=op2">Operation2</a></li>
			<?
			foreach($operations as $op) {
				echo '<li><a class="menu" href="?op='.$page.'">'.$op.'</a></li>';
			}
			?>
		</ul>
	</div>
	<div id="RightPanel">
	  <h2>RightPanel</h2>
	  <?php include();?>
	  abcd
	</div>
</div>
</body>
</html>
