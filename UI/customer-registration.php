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
        
        include "core/Customer.php";
        $returnMessage="";
        //$result = 0; 
		CustomerRegister($cid, $password, $name, $address, $phone);
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
<h2>Customer Registration</h2>
<div class="feedbackMessage"><?echo $returnMessage?></div>
<div class="instruction">* required</div>
<form action="?op=<?echo $_GET['op'];?>" method="POST" autocomplete="off">
    <div class="textEntry">Login ID*: <input type="text" name="cid" placeholder="e.g. jsmith" value="<?echo $_POST["cid"]?>" required /> <span class="error"></span></div>
    <div class="textEntry">Full Name: <input type="text" name="name"  placeholder="e.g. John Smith" value="<?echo $_POST["name"]?>"/> <span class="error"></span></div>
    <div class="textEntry">Password*: <input type="password" name="password"  placeholder="" required /> <span class="error"></span></div>
    <div class="textEntry">Comfirm Password*: <input type="password" name="cpw"  placeholder="" required /> <span class="error"></span></div>
    <div class="textEntry">Address: <input type="text" name="address"  placeholder="e.g. 888 Mystreet, Mycity" value="<?echo $_POST["address"]?>"/><span class="error"> </span></div>
    <div class="textEntry">Phone: <input type="tel" name="phone" pattern='\d{3}[\-]\d{3}[\-]\d{4}' placeholder="e.g. 604-123-4567" value="<?echo $_POST["phone"]?>"/> <span class="error"> </span></div>

    <div class="formAction">
        <input type="submit" value="Register"/>
        <a href="?op=login">Cancel</a>
    </div>
</form>
</div>
