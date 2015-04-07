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
    		
    		include "core/PurchaseItem.php";
    		$returnMessage="";
    		$result = DailyReport($date);
    		if (is_array($result)){
				if(count($result) !== 0){
					$returnMessage="Successful";
				}else{
					$returnMessage = 'No results.';
				}
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
	
	<?php
	if (is_array($result)) {
		echo
		'<div class="instruction">Daily Report:</div>
		<form action="?op='.$_GET['op'].'" method="POST">
		<table>';
		
		foreach($result as $row){
			if(count($row) === 4){
				echo '<tr>';
				for($i = 0; $i < 4; $i++) {
					echo '<td>'.$row[$i].'</td>';
				}
				echo '</tr>';
			}
		}
		
		echo '</table>';
	}
	
	//include_once "core/PurchaseItem.php";
	//$total = DailyTotal($result);
	//echo 'Total: '.$total;
	?>
	
</div>
