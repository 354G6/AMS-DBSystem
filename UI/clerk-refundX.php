<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validated=true;
	$ReturnRecID = $ReturnUPC = $ReturnQ = "";
	
	//filter input data
	$ReturnRecID = filter($_POST["ReturnRecID"]);
	$ReturnUPC = filter($_POST["ReturnUPC"]);
	$ReturnQ = $_POST["ReturnQ"];
	
	//validate
	if ($ReturnRecID==""||$ReturnUPC=="") {
		$validated=false;
	}
	
	if ($validated) {
		//clear form data
		$_POST["ReturnRecID"]="";
		$_POST["ReturnUPC"]="";
		$_POST["ReturnQ"]="";
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
  <form action="?op=<?echo $_GET['op'];?>" method="POST">
  <div class="textEntry">Receipt ID: <input type="text" name="ReturnRecID" placeholder="e.g. 35803" value="<?echo $_POST["ReturnRecID"]?>" required /> <span class="error"></span></div>  
  <div class="textEntry">UPC: <input type="text" name="ReturnUPC" placeholder="e.g. 3580380428342" value="<?echo $_POST["ReturnUPC"]?>" required /> <span class="error"></span></div>
  <div class="textEntry">Amount: <input type="text" name="ReturnQ" placeholder="e.g. 3" value="<?echo $_POST["ReturnQ"]?>" required /> <span class="error"></span></div>
  </form>
</div>
