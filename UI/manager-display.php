<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validated=true;
	$date = $topNum = "";
	
	// filter input data
    	$table = $_POST["targettable"];
    	
    	   		
    	include "core/Include.php";
    	$returnMessage="";
            
        //UI testdata
        //$row1 = array('upc'=>'123456789999', 'title'=>'Test DVD', 'company'=>'abc', 'stock'=>'100', 'Quantities Sold'=>'323'); //for testing only
        //$row2 = array('upc'=>'123456780000', 'title'=>'Test CD', 'company'=>'ZZz', 'stock'=>'45', 'Quantities Sold'=>'122'); //for testing only
        
        switch($table) {
            case "Item":
                $result = ItemDisplay();
                break;
            case "LeadSinger":
                $result = LeadSingerDisplay();
                break;
            case "HasSong":
                $result = HasSongDisplay();
                break;
            case "Order":
                $result = OrderDisplay();
                break;
            case "PurchaseItem":
                $result = PurchaseItemDisplay();
                break;
            case "Customer":
                $result = CustomerDisplay();
                break;
            case "Return":
                $result = ReturnDisplay();
                break;
            case "ReturnItem":
                $result = ReturnItemDisplay();
                break;
        }
    	//$result = topSelling($date, $topNum);//array($row1,$row2);
    	if (is_array($result)){
    		$returnMessage = "Successful";
    	} else {
            $returnMessage = 'Error: '.$result;
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
    <h2>Display Table</h2>
    <div class="feedbackMessage"><?echo $returnMessage?></div>
    <div class="instruction">(* = required)</div>
    <form action="?op=<?echo $_GET['op'];?>" method="POST">
        <div class="textEntry">Table*:
            <select name="targettable">
                <option value="Item">Item</option>
                <option value="LeadSinger">LeadSinger</option>
                <option value="HasSong">HasSong</option>
                <option value="Order">Order</option>
                <option value="PurchaseItem">PurchaseItem</option>
                <option value="Customer">Customer</option>
                <option value="Return">Return</option>
                <option value="ReturnItem">ReturnItem</option>
            </select>
        </div>
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
