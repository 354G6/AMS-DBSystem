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
    		$result = topSelling($date, $topNum);
    		if ($result === 0){
    			$returnMessage="The top selling on ".$date." is ".$topNum.". ";
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
<div id="TopSelling">
  <p>Top Selling Items</p>
  <form>
  <div class="textEntry">Date: <input type="text" id="Datepicker1" value="<?echo $_POST["date"]?>" required /></div>
  <div class="textEntry">Top Items: <input type="text" name="topNum" value="<?echo $_POST["topNum"]?> required"/></div>
  <div class="formAction"><input type="submit" name="Next"/></div>
   <?echo
   <script type="text/javascript"> $(function() {
	$( "#Datepicker1" ).datepicker(); });
   </script>
   ?>
</div>
