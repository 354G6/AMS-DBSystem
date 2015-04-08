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
                $result = ItemDelete(filter($_POST["pk1"]));
                break;
            case "LeadSinger":
                $result = LeadSingerDelete(filter($_POST["pk1"]), filter($_POST["pk2"]));
                break;
            case "HasSong":
                $result = HasSongDelete(filter($_POST["pk1"]), filter($_POST["pk2"]));
                break;
            case "Order":
                $result = OrderDelete(filter($_POST["pk1"]));
                break;
            case "PurchaseItem":
                $result = PurchaseItemDelete(filter($_POST["pk1"]), filter($_POST["pk2"]));
                break;
            case "Customer":
                $result = CustomerDelete(filter($_POST["pk1"]));
                break;
            case "Return":
                $result = ReturnDelete(filter($_POST["pk1"]));
                break;
            case "ReturnItem":
                $result = ReturnItemDelete(filter($_POST["pk1"]), filter($_POST["pk2"]));
                break;
        }
    	//$result = topSelling($date, $topNum);//array($row1,$row2);
    	if (is_null($result)){
    		$returnMessage = "1 Record Deleted From ".$table." Successfully.";
            $_POST["pk1"]=$_POST["pk1"]="";
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
    <form action="?op=<?echo $_GET['op'];?>" method="POST" autocomplete="off">
        <div class="textEntry">Table*:
            <select id="targettable" name="targettable" onchange="showInputForm()" >
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
        <div id="pk">
        </div>
        <div class="formAction" id="formAction"></div>
    </form>
</div>

<script>
window.onload = showInputForm;
function showInputForm() {
    <?
    if(isset($table)) {
        echo 'document.getElementById("targettable").value="'.$table.'";';
    }
    ?>
    var table = document.getElementById('targettable').value;
    switch(table) {
    case "Item":
        document.getElementById('pk').innerHTML = '<div class="textEntry">upc*: <input type="number" name="pk1" value="<?echo $_POST["pk1"]?>" required/></div>';
        break;
    case "LeadSinger":
        document.getElementById('pk').innerHTML = '<div class="textEntry">upc*: <input type="number" name="pk1" value="<?echo $_POST["pk1"]?>" required/></div>'
                                                  +'<div class="textEntry">name*: <input type="text" name="pk2" value="<?echo $_POST["pk2"]?>" required/></div>';
        break;
    case "HasSong":
        document.getElementById('pk').innerHTML = '<div class="textEntry">upc*: <input type="number" name="pk1" value="<?echo $_POST["pk1"]?>" required/></div>'
                                                   +'<div class="textEntry">title*: <input type="text" name="pk2" value="<?echo $_POST["pk2"]?>" required/></div>';
        break;
    case "Order":
        document.getElementById('pk').innerHTML = '<div class="textEntry">receiptId*: <input type="number" name="pk1" value="<?echo $_POST["pk1"]?>" required/></div>';
        break;
    case "PurchaseItem":
        document.getElementById('pk').innerHTML = '<div class="textEntry">receiptId*: <input type="number" name="pk1" value="<?echo $_POST["pk1"]?>" required/></div>'
                                                    +'<div class="textEntry">upc*: <input type="number" name="pk2" value="<?echo $_POST["pk2"]?>" required/></div>';
        break;
    case "Customer":
        document.getElementById('pk').innerHTML = '<div class="textEntry">cid*: <input type="text" name="pk1" value="<?echo $_POST["pk1"]?>" required/></div>';
        break;
    case "Return":
        document.getElementById('pk').innerHTML = '<div class="textEntry">retid*: <input type="number" name="pk1" value="<?echo $_POST["pk1"]?>" required/></div>';
        break;
    case "ReturnItem":
        document.getElementById('pk').innerHTML = '<div class="textEntry">retid*: <input type="number" name="pk1" value="<?echo $_POST["pk1"]?>" required/></div>'
                                                    +'<div class="textEntry">upc*: <input type="number" name="pk2" value="<?echo $_POST["pk2"]?>" required/></div>';
        break;
    }
    document.getElementById('formAction').innerHTML = '<input type="submit" value="Delete"/>';
}
</script>
