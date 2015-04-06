<?php
	include_once 'Connect.php';

	function CustomerInsert($cid, $password, $name, $address, $phone){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error; 
		}
		if($sql->query("INSERT INTO Customer VALUES ('$cid', '$password', '$name', '$address', '$phone')") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	function CustomerDelete($cid){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("DELETE FROM Customer WHERE cid = '$cid'") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	// returns a 2d array containing data from the Customer table
	function CustomerDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM Customer");
		if($result === FALSE){
			echo $sql->error;
		}
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
	
	//calls CustomerInsert() but hashes password with salt first
	function CustomerRegister($cid, $password, $name, $address, $phone){
		$r = 0;
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM Customer WHERE cid = '$cid'");
		if($result->num_rows === 0){
			$cost = 10;
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
			$salt = sprintf("$2a$%02d$", $cost) . $salt;
			$hash = crypt($password, $salt);
			CustomerInsert($cid, $hash, $name, $address, $phone);
		}else{
			$r = "Login ID already exists. Please choose another.";
		}
		Close($sql);
		return $r;
	}
	
	
	//returns 0 for successful login, 1 for clerk, 2 for manager, -1 for failure
	function CustomerLogin($cid, $password){
		$r = "Login Failed. Your login id or password may be incorrect.";
		if(($cid == "111111111") && ($password == "password")){
			$r = 1;//make sure manually add to db
		}else if(($cid == "222222222") && ($password == "password")){
			$r = 2;//make sure manually add to db
        //---added for testing purpose only (byPass connection to DB)
        }else if(($cid == "000000000") && ($password == "password")){
			$r = 0;//make sure manually add to db
        //---
		}else{
			$sql = Connect();
			if ($sql->connect_error) {
				echo $sql->connect_error;
			}
			//this is a stupid way to retrieve hash, fix this
			$stmt = $sql->prepare("SELECT password, cid FROM Customer WHERE cid = '$cid'");
			$result = $stmt->execute();
			if($result === FALSE){
				echo $stmt->error;
			}
			$stmt->bind_result($hash, $tcid);
			if($stmt->fetch()){
				if($hash == crypt($password, $hash)){
					$r = 0;
				}
			}
			Close($sql);
		}
		return $r;
	}
?>