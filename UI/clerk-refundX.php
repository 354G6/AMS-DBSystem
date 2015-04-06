<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validated=true;
	$ReturnRecID = $ReturnUPC = $ReturnQ = "";
	
	//filter input data
	$ReturnRecID = filter($_POST["ReturnRecID"]);
	$ReturnUPC = filter($_POST["ReturnUPC"]);
	$ReturnQ = $_POST["ReturnQ"];
	
	//validate
	if ($ReturnRecID==""||$ReturnUPC==""||$ReturnQ="") {
		$validated=false;
	}
	
	if ($validated) {
		//clear form data
		$_POST["ReturnRecID"]="";
		$_POST["ReturnUPC"]="";
		$_POST["ReturnQ"]="";
		
		include "core/Return.php";
		$returnMessage="";
		$result = ProcessReturn($ReturnRecID, $ReturnUPC, $ReturnQ);
		if (result === 0){
			$returnMessage="Items you purchased have been returned successfully! You will get your refund back!";
		} else {
			$errorMessage=array('',
					'Unable to connect to the database.',
                                	'Failed executing query.');
                        $returnMessage='Error: '.$result;
		}
	}
}

function filter($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<div class="entryBox">
  <h2>Refund</h2>
  <form action="?op=<?echo $_GET['op'];?>" method="POST">
  <div class="textEntry">Receipt ID: <input type="number" name="ReturnRecID" placeholder="e.g. 35803" value="<?echo $_POST["ReturnRecID"]?>" required /> <span class="error"></span></div>  
  <div class="textEntry">UPC: <input type="number" name="ReturnUPC" placeholder="e.g. 3580380428342" value="<?echo $_POST["ReturnUPC"]?>" required /> <span class="error"></span></div>
  <div class="textEntry">Amount: <input type="number" name="ReturnQ" placeholder="e.g. 3" value="<?echo $_POST["ReturnQ"]?>" required /> <span class="error"></span></div>
  <div class="formAction"><input type="submit" value="Refund"/></div>
  </form>
</div>
