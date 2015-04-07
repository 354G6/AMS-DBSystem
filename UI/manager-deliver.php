<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validated=true;
    $receiptId = $deliveryDate = "";
    
    //filter input data
    $receiptId = filter($_POST["receiptId"]);
    $deliveryDate = filter($_POST["deliveryDate"]);
  
    //validate
    if ($receiptId==""||$deliveryDate=="") {
        $validated=false;
    }
    
    if ($validated) {
        //clear form data
        $_POST["receiptId"]="";
        $_POST["deliveryDate"]="";
        
        include "core/Delivery.php";
        $returnMessage="";
		
        $result = ProcessDelivery($receiptId, $deliveryDate);
        if ($result === 0) {
            $returnMessage='Successful!';
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
<h2>Process Delivery</h2>
<div class="feedbackMessage"><?echo $returnMessage?></div>
<div class="instruction">(* = required)</div>
<form action="?op=<?echo $_GET['op'];?>" method="POST" autocomplete="off">
  <div class="textEntry">Receipt ID*: <input type="number" name="receiptId" value="<?echo $_POST["receiptId"]?>" required/></div>
  <div class="textEntry">Delivery Date*:  <input type="date" name="deliveryDate" value="<?echo $_POST["deliveryDate"]?>" required/></div>
  <div class="formAction"><input type="submit" name="Submit"/></div>
</form>
</div>

