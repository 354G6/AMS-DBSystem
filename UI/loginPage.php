<?
//$_SESSION["role"]="guest"; 
session_unset();
?>
<div class="entryBox" id="loginBox">
<h2>Login</h2>
<form action="?op=procLogin" method="post"> 
    <div class="textEntry">Login ID: <input type="text" name="login_id" placeholder="Type your Login ID"/></div>
    <div class="textEntry">Password: <input type="password" name="pw" placeholder="Type your Password"/></div>
    <div class="formAction"><a href="?op=register">Register</a> <input type="submit" value="Log in"/></div>
</form>
</div>