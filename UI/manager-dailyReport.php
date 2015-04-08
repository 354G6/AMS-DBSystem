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
    		
    		include_once "core/PurchaseItem.php";
    		$returnMessage="";
    		$result = DailyReport($date);
    		if (is_array($result)){
				if(count($result) !== 0){
					$returnMessage="Successful!";
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
    <div class="instruction">(* = required)</div>
    <form action="?op=<?echo $_GET['op'];?>" method="POST">
        <div class="textEntry">Date*: <input type="date" name="date" value="<?echo $_POST['date']?>"/></div>
        <div class="formAction"><input type="submit" value="Submit"/></div>
    </form>
</div>

<?php
if (is_array($result)) {
	echo
	'<div class="instruction">Daily Report:</div>
	<form action="?op='.$_GET['op'].'" method="POST">
	<table>';
	$labelRow=true;
	foreach($result as $row){
        if ($labelRow) {
            echo '<tr class="labelrow">';
            foreach($row as $key=>$value) {
                echo '<th class="labelcell">'.$key.'</th>';
            }
            $labelRow=false;
            echo '</tr>';
        }
		echo '<tr class="datarow">';
		foreach($row as $key=>$value) {
			echo '<td class="datacell">'.$value.'</td>';
		}
		echo '</tr>';
	}
		
	echo '</table>';
		
	include_once "core/PurchaseItem.php";
	$total = DailyTotal($result);
	echo 'Total: '.$total;
}
?>
	

