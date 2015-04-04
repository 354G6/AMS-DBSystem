<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validated=true;
    $cid = $name = $password = $cpw = $address = $phone = "";
    
    //filter input data
    $cid = filter($_POST["cid"]);
    $name = filter($_POST["name"]);
    $password = $_POST["password"];
    $cpw = $_POST["cpw"];
    $address = filter($_POST["address"]);
    $phone = filter($_POST["phone"]);
  
    //validate
    if ($cid==""||$password==""||$cpw==""||$password!=$cpw) {
        $validated=false;
    }
    
    if ($validated) {
        //clear form data
        $_POST["cid"]="";
        $_POST["name"]="";
        $_POST["address"]="";
        $_POST["phone"]="";
        
        //include dirname(__FILE__) . "core/Customer.php";
        $returnMessage="";
        $result = 0; //= CustomerRegister($cid, $password, $name, $address, $phone)
        if (result == 0) {
            $returnMessage='Registered successfully!<br>Please <a href="?op=login">>>Click Here to Log In<<</a>';
            //echo '<script>alert("Registered successfully!\nPlease Log In using your ID and Password.");</script>';
            //echo '<script>window.location = "?op=login"</script>';
        } else {
            $errorMessage = array( '',
                                'Unable to connect to the database.',
                                'Failed executing query.' //how to get message like "Login ID already exists"?
                            );
            $returnMessage = 'Error:'.$errorMessage[$result];
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
<form action="?procAddItem" method="POST">
    <div class="textEntry">Item UPC: <input type="number" name="itemUPC" id="itemUPC" required/></div>
    <div class="textEntry">Quantity: <input type="number" name="addQuant" id="addQuant" required/></div>
    <div class="textEntry">Price: <input type="text" name="addPrice" id="addPrice" required/></div>
</form>
</div>