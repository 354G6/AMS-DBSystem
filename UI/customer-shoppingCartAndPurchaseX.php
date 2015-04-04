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
<div id="ShopCartPurchase">
  <h2> <br />
  &nbsp; &nbsp;Shopping Cart</h2>
  </p>
    <div id="NameOfItem">
    // $i < 10 is NOT 10, it just specifies on how many items a customer purchases
    <?php
    for ($i=0; $i < 10; $i++){ ?>
    <p>Name Of Item: <?echo $title?><br />
    Category: <?echo $category?><br />
    
    </p>
    <?php }?>
    </div>
    <div id="Payment">
	
	<p><strong>Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</strong><br />
	Name of Item &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$amount<br />
	Quantity<br />
	Name of Item &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$amount<br />
	Quantity<br />
	<strong>item total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$total_amount</strong>
	</p>
	<br /><br /><br />
	<p>&nbsp;&nbsp;Payment Method</p>
	&nbsp;&nbsp;Card Type: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="Card Type"/><br />
	&nbsp;&nbsp;Cardholder Name: &nbsp;&nbsp;<input type="text" name="Cardholder Name"/><br />
	&nbsp;&nbsp;Card No.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="Card No."/><br />
	&nbsp;&nbsp;Expiry Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
	<input type="text" name="Expiry Date"/><br />
	
	<p align="right"><input type="submit" value="Pay Now"/>&nbsp;&nbsp;&nbsp;<a href="homepage.htm"><input type="submit" value="Cancel"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

	</div>
    
</div>
<p>&nbsp;</p>
</body>
</html>
