<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validated=true;
	$date = $topNum = "";
	
	// filter input data
    	$date = filter($_POST["date"]);
    	$topNum = filter($_POST["topNum"]);
    	
    	// validate
    	if ($date==""||$topNum==""){
    		$validated=false;
    	}
    	
    	if ($validated){
    		// clear from data
    		$_POST["date"]="";
    		$_POST["topNum"]="";
    		
    		//include "core/topSelling.php";
    		$returnMessage="";
    		$result = 0;//topSelling($date, $topNum);
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
    <h2>Get Top Selling Items</h2>
    <div class="feedbackMessage"><?echo $returnMessage?></div>
    <div class="instruction">* required</div>
    <form action="?op=<?echo $_GET['op'];?>" method="POST">
        <div class="textEntry">Date: <input type="date" name="date" value="<?echo $_POST["date"]?>" required /></div>
        <div class="textEntry"># Items to display: <input type="number" name="topNum" placeholder="e.g. 20" value="<?echo $_POST["topNum"]?>" required/></div>
        <div class="formAction"><input type="submit" name="Submit"/></div>
    </form>
</div>
