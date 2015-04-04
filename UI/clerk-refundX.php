<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validated=true;
	$cid = $name = $password = $cpw = $address = $phone = "";

	//filter input data
	$cid = filter($_POST["cid"]);
	$name = filter($_POST["name"]);
	$password = $_POST["password"];
	
	//validate
	if ($cid==""||$password==""||$cpw==""||$password!=$cpw) {
		$validated=false;
	}
	if ($validated) {
		//clear form data
		$_POST["cid"]="";
		$_POST["name"]="";
		$_POST["address"]="";
	} else {
		
	}
}

function filter($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<div id="Refund">
  <h2>Refund</h2>
  <form>
  <p>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; Receipt ID:</p>
  <p>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; UPC:</p>
  <p>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; Amount:</p>
	&nbsp;&nbsp;
	<div id="LeftPanel"><p>&nbsp;&nbsp;Card Refund</p>
	&nbsp;&nbsp;Card Type: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="Card Type"/><br /><br />
	&nbsp;&nbsp;Cardholder Name: &nbsp;&nbsp;<input type="text" name="Cardholder Name"/><br /><br />
	&nbsp;&nbsp;Card No.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="Card No."/><br /><br />
	&nbsp;&nbsp;Expiry Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
	<input type="text" name="Expiry Date"/><br /><br />
	<p align="right"><input type="submit" name="Next"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></div>
  </form>
</div>
</body>
</html>
