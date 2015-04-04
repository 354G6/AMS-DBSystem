<?
//$_SESSION["role"]="guest"; 
session_unset();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validated=true;
    $loginID = $password = "";
    
    //filter input data
    $loginID = filter($_POST["login_id"]);
    $password = $_POST["password"];
  
    //validate
    //if () {
    //    $validated=false;
    //}
    
    if ($validated) {
        //clear form data
        $_POST["login_id"]="";

        include "core/Customer.php";
    
        $result = CustomerLogin($loginID, $password);
        if ($result == 0) {
            $_SESSION['role']="customer";
			echo "<script>window.location = '?op=home'</script>";
        }else if($result == 1){
			$_SESSION['role']="clerk";
			echo "<script>window.location = '?op=home'</script>";
		}else if($result == 2){
			$_SESSION['role']="manager";
			echo "<script>window.location = '?op=home'</script>";
        }else {
            $errorMessage = array( '',
                                'Unable to connect to the database.',
                                'Failed executing query.'
                            );
            echo 'Error:'.$errorMessage[$result];
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
<div class="entryBox" id="loginBox">
<h2>Login</h2>
<form action="?op=<? echo $_GET["op"]?>" method="post" autocomplete="off"> 
    <div class="textEntry">Login ID: <input type="text" name="login_id" placeholder="e.g. jsmith" value="<?echo $_POST["login_id"]?>" required/></div>
    <div class="textEntry">Password: <input type="password" name="password" placeholder="" required/></div>
    <div class="formAction"><a href="?op=register">Register</a> <input type="submit" value="Log in" /></div>
</form>
</div>