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

		
		include "core/Return.php";
		$returnMessage="";
		$result = 0;//ProcessReturn($ReturnRecID, $ReturnUPC, $ReturnQ);
		if (result === 0){
			$returnMessage="Items returned! Refund amount: $100.";
            //clear form data
            $_POST["ReturnRecID"]="";
            $_POST["ReturnUPC"]="";
            $_POST["ReturnQ"]="";
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

    <h2>Process Return</h2>
    <div class="feedbackMessage"><?echo $returnMessage?></div>
    <div class="instruction">* required</div>
    <form action="?op=<?echo $_GET['op'];?>" method="POST">
        <div class="textEntry">Receipt ID*: <input type="number" name="ReturnRecID" placeholder="e.g. 35803" value="<?echo $_POST["ReturnRecID"]?>" required /> <span class="error"></span></div>  
        <div class="textEntry">Return Quantity*: <input type="number" name="ReturnQ" placeholder="e.g. 3" value="<?echo $_POST["ReturnQ"]?>" required /> <span class="error"></span></div>
        <div class="formAction"><input type="submit" value="Submit"/></div>
    </form>
</div>

