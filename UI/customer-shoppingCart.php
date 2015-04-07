<?php
include "core/itemPurchase.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
	$checkOutList = $_POST['item'];
    $itemQuantityList = $_POST['quantity'];
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
if (isset($_SESSION['itemlist'])) {
    $result = shoppingCartFetch($_SESSION['itemlist']);
    if (is_array($result)) {
        echo
        '
        <h3>Items in your shopping cart:</h3>
        <div class="instruction">(Select the items you want to buy)</div>
        <form action="?op='.$_GET['op'].'" method="POST">
        <table>';

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
            echo '<th class="labelcell">Quantity</th>';
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
            echo '<td><input type="number" style="width:30px" name="quantity[]" id="q'.$i.'" value="'.$_SESSION['itemquantity'][$i].'"/></td>';
            echo '</tr>';
        //}
        $i++;
    }
    
        echo
        '</table>
        <div class="formAction">
            <input type="submit" value="Check Out" name="checkout"/>
        </div>
        </form>
        ';
    }
}
?>

<script>
function setQuantity(i) {
    if (document.getElementById("c"+i).checked) {
        document.getElementById("q"+i).disabled = false;
        document.getElementById("q"+i).value = "1";
    } else {
        document.getElementById("q"+i).disabled = true;
        document.getElementById("q"+i).value = "0";
    }
}
</script>