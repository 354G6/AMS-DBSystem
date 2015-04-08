<?php
$returnMessage = 'No item in your shopping cart. <br><a href="?op=purchase">>>Search for an item here<<</a>';
include "core/itemPurchase.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validated=true;
	$cardNum = $expiryDate = "";
	
	//filter input data
	$cardNum = filter($_POST["cardNum"]);
	$expiryDate = $_POST["expiryDate"];
	    
	if ($validated) {
		//echo "cardnum: $cardNum";
        $result = itemPurchase($_POST['item'], $_POST['quantity'],$cardNum,$expiryDate);
        if ($result===0) {
            $returnMessage = "Purchased Sucessfully!";
        } else {
            $returnMessage = 'Error: '.$result;
        }
    }
}

function filter($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
<div class="entryBox">
<h2>Shopping Cart</h2>
<div class="feedbackMessage"><?echo $returnMessage?></div>
<div class="instruction"></div>

<?
$pricelist = array();
if (isset($_SESSION['itemlist'])) {

    $result = shoppingCartFetch(array_keys($_SESSION['itemlist']));
    if (is_array($result)) {
        $returnMessage = "";
        echo
        '
        <h3>Items in your shopping cart:</h3>
        <div class="instruction">(Select the items you want to buy)</div>
        <form action="?op='.$_GET['op'].'" method="POST" autocomplete="off">
        <table id="carttable">';

        $labelRow=true;
        $i=0;
        foreach($result as $row) {
            if ($labelRow) {
                echo '<tr class="labelrow"><th>select?</th>';
                foreach($row as $key=>$value) {
                    if ($key!='upc') {
                        echo '<th class="labelcell">'.$key.'</th>';
                    }
                }
                echo '<th class="labelcell">Quantity</th>
                        <th class="labelcell">Subtotal</th>';
                $labelRow=false;
                echo '</tr>';
            }
            //if ($row['stock']>0) {
                echo '<tr ><td><input type="checkbox" name="item[]" value="'.$row['upc'].'" id="c'.$i.'" checked="true" onclick="setQuantity('.$i.');"/></td>';
                foreach($row as $key=>$value) {
                    if ($key!='upc') {
                        echo '<td><label for="c'.$i.'">'.$value.'</label></td>';
                    }
                }
                $pricelist[] = $row['price'];
                echo '<td><input type="number" style="width:50px" name="quantity[]" id="q'.$i.'" value="'.$_SESSION['itemlist'][$row['upc']].'" oninput="calcSubtotal('.$i.')" required/></td>';
                echo '<td><label for="c'.$i.'" id="st'.$i.'">'.($row['price']*$_SESSION['itemlist'][$row['upc']]).'</label></td>';
                echo '</tr>';
            //}
            $i++;
        }
        echo
        '<tr>';
        for ($j=0;$j<$i-2;$j++) {
        echo '<td></td>';
        }
        echo
        '<td></td><td></td><td></td><td></td><th>Total:</th>
        <td id="total"></td></tr>';
    
        echo
        '</table>
        
        <div class="formAction">
        <h4 style="margin-bottom:5px;">Payment Info</h4>
            (* = required)<br>
            <div class="textEntry">Credit Card Number*: <input type="text" name="cardNum" placeholder="e.g. 4485 9461 2586 5303" required /></div>
            <div class="textEntry">Expiry Date*: <input type="date" name="expiryDate" required /></div>
            <input type="submit" value="Check Out" name="checkout"/>
        </div>
        </form>
        ';
    }
}
?>

<script>
<?php
//$js_array = json_encode($pricelist);
//echo $js_array;
//echo "var pricelist = ". $js_array . ";\n";
?>
var pricelist =<?php echo json_encode($pricelist);?>;

calcTotal();

function setQuantity(i) {
    if (document.getElementById("c"+i).checked) {
        document.getElementById("q"+i).disabled = false;
        document.getElementById("q"+i).value = "1";
        calcSubtotal(i);
    } else {
        document.getElementById("q"+i).disabled = true;
        document.getElementById("q"+i).value = "0";
        calcSubtotal(i);
    }
}

function calcSubtotal(i) {
    if (document.getElementById("c"+i).checked) {
        //alert(pricelist[i]*document.getElementById("q"+i).value);
        quantity = 0;
        if (!isNaN(parseInt(document.getElementById("q"+i).value))) {
            quantity=parseInt(document.getElementById("q"+i).value);
        }
        document.getElementById("st"+i).innerHTML = pricelist[i]*quantity;
        calcTotal();
    } else {
        document.getElementById("st"+i).innerHTML = "0";
        calcTotal();
    }
}

function calcTotal() {
    var numRows = document.getElementById("carttable").rows.length-2;
    var sum = 0;
    for(i = 0; i<numRows; i++) {
        subtotal = 0;
        if (!isNaN(parseInt(document.getElementById("st"+i).innerHTML))) {
            subtotal=parseFloat(document.getElementById("st"+i).innerHTML);
        }
        sum = sum + subtotal;
    }
    document.getElementById("total").innerHTML = sum;
}
</script>