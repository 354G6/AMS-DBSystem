<div class="entryBox">
<h2>Customer Registration</h2>
<form action="?op=procReg" method="post"> 
<div class="textEntry">Login ID*: <input type="text" name="cid" placeholder="Type your Login ID"/></div>
<div class="textEntry">Full Name: <input type="text" name="name"  placeholder="Type your Full Name"/></div>
<div class="textEntry">Password*: <input type="password" name="password"  placeholder="Type your Password"/></div>
<div class="textEntry">Comfirm Password*: <input type="password" name="cpw"  placeholder="Re-type the Password"/></div>
<div class="textEntry">Address: <input type="text" name="address"  placeholder="Type your Address"/></div>
<div class="textEntry">Phone: <input type="text" name="phone"  placeholder="Type your Phone Number"/></div>

<div class="formAction">
<input type="submit" value="Register"/>
<a href="javascript:window.history.back();">Cancel</a>
</div>
</form>
<div id="loginBox">

<!-- validation scripts required -->