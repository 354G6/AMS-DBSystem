<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validated=true;
    $upc = $quantity = $price = "";
    
    //filter input data
    $upc = filter($_POST["itemUPC"]);
    $quantity = filter($_POST["addQuant"]);
    $price = filter($_POST["addPrice"]);
  
    //validate
    if ($upc==""||$quantity=="") {
        $validated=false;
    }
    
    if ($validated) {
        //clear form data
        $_POST["itemUPC"]="";
        $_POST["addQuant"]="";
        $_POST["addPrice"]="";
        
        include "core/Item.php";
        $returnMessage="";
        $result = AddItems($upc, $price, $quantity);
        if ($result === 0) {
            $returnMessage='Added successfully!';
        } else {
            $errorMessage = array( '',
                                'Unable to connect to the database.',
                                'Failed executing query.'
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
<h3>Add Item</h3>
<div class="feedbackMessage"><?echo $returnMessage?></div>
<div class="instruction">(* required)</div>
<form action="?op=<?echo $_GET['op']?>" method="POST" autocomplete="off">
    <div class="textEntry">Item UPC*: <input type="number" name="itemUPC" placeholder="e.g. 1 23456 78999 9" id="itemUPC" value="<?echo $_POST["itemUPC"]?>" required/></div>
    <div class="textEntry">Add Quantity*: <input type="number" name="addQuant" placeholder="e.g. 120" id="addQuant" value="<?echo $_POST["addQuant"]?>" required/></div>
    <div class="textEntry">New Price: <input type="number" step="0.01" name="addPrice" placeholder="e.g. 25" id="addPrice" value="<?echo $_POST["addPrice"]?>"/></div>

    <div class="formAction">
        <input type="submit" value="Add Item"/>
        <a href="?op=home">Cancel</a>
    </div>
</form>
</div>