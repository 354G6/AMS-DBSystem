<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validated=true;
	$date = "";
	
	// filter input data
    	$date = filter($_POST["date"]);
    	
    	// validate
    	if ($date==""){
    		$validated=false;
    	}
    	
    	if ($validated){
    		// clear from data
    		$_POST["date"]="";
    		
    		//include "core/dailyReport.php";
    		$returnMessage="";
    		$result = 0;//dailyReport($date);
    		if ($result === 0){
    			$returnMessage="Successful";
    		} else {
    			$errorMessage = array( '',
                                'Unable to connect to the database.',
                                'ReceiptID does not exists.'
                            );
            		$returnMessage = 'Error: '.$result;
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
    <h2>Generate Daily Report</h2>
    <div class="feedbackMessage"><?echo $returnMessage?></div>
    <div class="instruction">* required</div>
    <form action="?op=<?echo $_GET['op'];?>" method="POST">
        <div class="textEntry">Date*: <input type="date" name="date" value="<?echo $_POST['date']?>"/></div>
        <div class="formAction"><input type="submit" value="Submit"/></div>
    </form>
</div>
