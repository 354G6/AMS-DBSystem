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
                $result = ItemInsert(filter($_POST["a1"]),filter($_POST["a2"]),filter($_POST["a3"]),filter($_POST["a4"]),filter($_POST["a5"]),filter($_POST["a6"]),filter($_POST["a7"]),filter($_POST["a8"]));
                break;
            case "LeadSinger":
                $result = LeadSingerInsert(filter($_POST["a1"]), filter($_POST["a2"]));
                break;
            case "HasSong":
                $result = HasSongInsert(filter($_POST["a1"]), filter($_POST["a2"]));
                break;
            case "Order":
                $result = OrderInsert(filter($_POST["a2"]), filter($_POST["a3"]), filter($_POST["a4"]), filter($_POST["a5"]), filter($_POST["a6"]), filter($_POST["a7"]));
                break;
            case "PurchaseItem":
                $result = PurchaseItemInsert(filter($_POST["a1"]), filter($_POST["a2"]), filter($_POST["a3"]));
                break;
            case "Customer":
                $result = CustomerInsert(filter($_POST["a1"]), filter($_POST["a2"]), filter($_POST["a3"]), filter($_POST["a4"]), filter($_POST["a5"]));
                break;
            case "Return":
                $result = ReturnInsert(filter($_POST["a2"]), filter($_POST["a3"]));
                break;
            case "ReturnItem":
                $result = ReturnItemInsert(filter($_POST["a1"]), filter($_POST["a2"]), filter($_POST["a3"]));
                break;
        }
    	//$result = topSelling($date, $topNum);//array($row1,$row2);
    	if (is_null($result)){
    		$returnMessage = "1 Record Inserted to ".$table." Successfully.";
            $_POST["a1"]=$_POST["a2"]=$_POST["a3"]=$_POST["a4"]=$_POST["a5"]=$_POST["a6"]=$_POST["a7"]=$_POST["a8"] = "";
    	} elseif (is_int($result)) {
            $returnMessage = "1 Record('".$result."') Inserted to ".$table." Successfully.";
            $_POST["a1"]=$_POST["a2"]=$_POST["a3"]=$_POST["a4"]=$_POST["a5"]=$_POST["a6"]=$_POST["a7"]=$_POST["a8"] = "";
        } else {
            $returnMessage = 'Error: '.$result;
    	}
}

function filter($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
    if ($data === "")
        $data=NULL;
	return $data;
}
?>
<div class="entryBox">
    <h2>Display Table</h2>
    <div class="feedbackMessage"><?echo $returnMessage?></div>
    <div class="instruction">(* = required)</div>
    <form action="?op=<?echo $_GET['op'];?>" method="POST" autocomplete="off">
        <div class="textEntry">Table*:
            <select id="targettable" name="targettable" onchange="showInputForm()">
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
        <div id="form" >
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
        document.getElementById('form').innerHTML = '<div class="textEntry">upc*: <input type="number" name="a1" value="<?echo $_POST["a1"]?>" required/></div>'
                                                    +'<div class="textEntry">title*: <input type="text" name="a2" value="<?echo $_POST["a2"]?>" required/></div>'
                                                    +'<div class="textEntry">type*: <input type="text" name="a3" value="<?echo $_POST["a3"]?>" required/></div>'
                                                    +'<div class="textEntry">category: <input type="text" name="a4" value="<?echo $_POST["a4"]?>" /></div>'
                                                    +'<div class="textEntry">company: <input type="text" name="a5" value="<?echo $_POST["a5"]?>" /></div>'
                                                    +'<div class="textEntry">year: <input type="number" name="a6" value="<?echo $_POST["a6"]?>" /></div>'
                                                    +'<div class="textEntry">price*: <input type="number" name="a7" value="<?echo $_POST["a7"]?>" required/></div>'
                                                    +'<div class="textEntry">stock: <input type="number" name="a8" value="<?echo $_POST["a8"]?>" /></div>';
        break;
    case "LeadSinger":
        document.getElementById('form').innerHTML = '<div class="textEntry">upc*: <input type="number" name="a1" value="<?echo $_POST["a1"]?>" required/></div>'
                                                  +'<div class="textEntry">name*: <input type="text" name="a2" value="<?echo $_POST["a2"]?>" required/></div>';
        break;
    case "HasSong":
        document.getElementById('form').innerHTML = '<div class="textEntry">upc*: <input type="number" name="a1" value="<?echo $_POST["a1"]?>" required/></div>'
                                                   +'<div class="textEntry">title*: <input type="text" name="a2" value="<?echo $_POST["a2"]?>" required/></div>';
        break;
    case "Order":
        document.getElementById('form').innerHTML = '<div class="textEntry">receiptId*: <input type="number" placeholder="(Generated)" value="(Generated)" disabled/></div>'
                                                   +'<div class="textEntry">date*: <input type="date" name="a2" value="<?echo $_POST["a2"]?>" required/></div>'
                                                   +'<div class="textEntry">cid*: <input type="text" name="a3" value="<?echo $_POST["a3"]?>" required/></div>'
                                                   +'<div class="textEntry">card#*: <input type="number" name="a4" value="<?echo $_POST["a4"]?>" required/></div>'
                                                   +'<div class="textEntry">expiryDate*: <input type="date" name="a5" value="<?echo $_POST["a5"]?>" required/></div>'
                                                   +'<div class="textEntry">expectedDate: <input type="date" name="a6" value="<?echo $_POST["a6"]?>" /></div>'
                                                   +'<div class="textEntry">deliveredDate: <input type="date" name="a7" value="<?echo $_POST["a7"]?>" /></div>';
        break;
    case "PurchaseItem":
        document.getElementById('form').innerHTML = '<div class="textEntry">receiptId*: <input type="number" name="a1" value="<?echo $_POST["a1"]?>" required/></div>'
                                                    +'<div class="textEntry">upc*: <input type="number" name="a2" value="<?echo $_POST["a2"]?>" required/></div>'
                                                    +'<div class="textEntry">quantity*: <input type="number" name="a3" value="<?echo $_POST["a3"]?>" required/></div>';
        break;
    case "Customer":
        document.getElementById('form').innerHTML = '<div class="textEntry">cid*: <input type="text" name="a1" value="<?echo $_POST["a1"]?>" required/></div>'
                                                    +'<div class="textEntry">password*: <input type="password" name="a2" value="<?echo $_POST["a2"]?>" required/></div>'
                                                    +'<div class="textEntry">name*: <input type="text" name="a3" value="<?echo $_POST["a3"]?>" required/></div>'
                                                    +'<div class="textEntry">address: <input type="number" name="a4" value="<?echo $_POST["a4"]?>" /></div>'
                                                    +'<div class="textEntry">phone: <input type="number" name="a5" value="<?echo $_POST["a5"]?>" /></div>';
        break;
    case "Return":
        document.getElementById('form').innerHTML = '<div class="textEntry">retid*: <input type="number" placeholder="(Generated)" value="(Generated)" disabled/></div>'
                                                    +'<div class="textEntry">date*: <input type="date" name="a2" value="<?echo $_POST["a2"]?>" required/></div>'
                                                    +'<div class="textEntry">receiptId*: <input type="number" name="a3" value="<?echo $_POST["a3"]?>" required/></div>';
        break;
    case "ReturnItem":
        document.getElementById('form').innerHTML = '<div class="textEntry">retid*: <input type="number" name="a1" value="<?echo $_POST["a1"]?>" required/></div>'
                                                    +'<div class="textEntry">upc*: <input type="number" name="a2" value="<?echo $_POST["a2"]?>" required/></div>'
                                                    +'<div class="textEntry">quantity*: <input type="number" name="a3" value="<?echo $_POST["a3"]?>" required/></div>';
        break;
    }
    document.getElementById('formAction').innerHTML = '<input type="submit" value="Insert"/>';
}
</script>
