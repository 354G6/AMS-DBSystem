<h1>Hello World.</h1>
<?php
include 'test.php';
    echo "Hello world!<br>Congratulations!";
	echo "<br>Ricky";
	
	// Using mysqli (connecting from App Engine)
	// Before connecting an IPv4 address must be requested from google cloud for the sql instance for the first parameter
	// (unless someone can get it working with the PIv6 address) (ACCESS CONTROL->IP adress)
	// You may need to add your IP address to those allowed to connect externally
	// (ACCESS CONTROL->Authorization)
	$sql = new mysqli('173.194.246.51:3306',
	'nicholas',
	'amspassword',
	'AMS_CMPT354'
	);
	
	if ($sql->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		echo "Connection success.";
	}
	
	$sql->close();
?>