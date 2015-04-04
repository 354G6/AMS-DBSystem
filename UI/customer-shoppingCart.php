<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validated=true;
	$cid = $category = $title = $leadingSinger = $quantity = $cardNum = $expiryDate = "";
	
	//filter input data
	$cid = filter($_POST["cid"]);
	$category = filter($_POST["category"]);
	$title = $_POST["title"];
	$leadingSinger = $_POST["leadingSinger"];
	$quantity = filter($_POST["quantity"]);
	$cardNum = filter($_POST["cardNum"]);
	$expiryDate = filter($_POST["expiryDate"]);
	
	//validate
	if ($cid==""||$cardNum=="") {
		$validated=false;
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
<div class="instruction">Specify an item you want:</div>

<div class="entryBox">
	<div class="formAction">
        <select>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
        </select>
        <!-- <a href="?op=login">Cancel</a> -->
    </div>
</div>
</div>
