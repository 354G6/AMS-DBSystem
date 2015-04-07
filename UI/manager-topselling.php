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
    		
    		include "core/topSelling.php";
    		$returnMessage="";
            
            //UI testdata
            //$row1 = array('upc'=>'123456789999', 'title'=>'Test DVD', 'company'=>'abc', 'stock'=>'100', 'Quantities Sold'=>'323'); //for testing only
            //$row2 = array('upc'=>'123456780000', 'title'=>'Test CD', 'company'=>'ZZz', 'stock'=>'45', 'Quantities Sold'=>'122'); //for testing only
        
            
    		$result = topSelling($date, $topNum);//array($row1,$row2);
    		if (is_array($result)){
    			$returnMessage="Successful";
    		} else {
                //$errorMessage = array( '',
                //                'Unable to connect to the database.',
                //                'ReceiptID does not exists.'
                //            );
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
    <div class="instruction">(* = required)</div>
    <form action="?op=<?echo $_GET['op'];?>" method="POST">
        <div class="textEntry">Date*: <input type="date" name="date" value="<?echo $_POST["date"]?>" required /></div>
        <div class="textEntry"># Items to display*: <input type="number" name="topNum" placeholder="e.g. 20" value="<?echo $_POST["topNum"]?>" required/></div>
        <div class="formAction"><input type="submit" value="Submit"/></div>
    </form>
</div>

<?php
if (is_array($result)) {
    echo
    '<div class="instruction">Result:</div>
    <table>';

    $labelRow=true;
    foreach($result as $row) {
        if ($labelRow) {
            echo '<tr class="labelrow">';
            foreach($row as $key=>$value) {
                echo '<th class="labelcell">'.$key.'</th>';
            }
            $labelRow=false;
            echo '</tr>';
        }
        //if ($row['stock']>0) {
            echo '<tr class="datarow">';
            foreach($row as $key=>$value) {
                echo '<td>'.$value.'</td>';
            }
            echo '</tr>';
        //}
        $i++;
    }
    
    echo
    '</table>';
}
?>
