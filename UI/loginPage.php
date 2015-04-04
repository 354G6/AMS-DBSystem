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

        //include dirname(__FILE__) . "core/Customer.php";
    
        $result = 0; //= CustomerLogin($_POST['login_id'], $_POST['password'])
        if ($result == 0) {
            $_SESSION['role']="manager"; //get this from the core login function???

            echo "<script>window.location = '?op=home'</script>";
        }
        else {
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
<form action="?op=<? echo $_GET["op"]?>" method="post"> 
    <div class="textEntry">Login ID: <input type="text" name="login_id" placeholder="e.g. jsmith" value="<?echo $_POST["login_id"]?>" required/></div>
    <div class="textEntry">Password: <input type="password" name="password" placeholder="" required/></div>
    <div class="formAction"><a href="?op=register">Register</a> <input type="submit" value="Log in" /></div>
</form>
</div>