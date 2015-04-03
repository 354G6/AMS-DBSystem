<?php
	include_once 'Connect.php';

	function CustomerInsert($cid, $password, $name, $address, $phone){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO Customer VALUES ('$cid', '$password', '$name', '$address', '$phone')") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function CustomerDelete($cid){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("DELETE FROM Customer WHERE cid = '$cid'") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function CustomerDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT * FROM Customer");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
	
	//calls CustomerInsert() but hashes password first
	function CustomerRegister($cid, $password, $name, $address, $phone){
		//$cost = 10;
		//$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		//$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hash = crypt($password);
		return CustomerInsert($cid, $hash, $name, $address, $phone);
	}
	
	function CustomerLogin($cid, $password){
		$r = 2;
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		//this is a stupid way to retrieve hash, fix this
		$stmt = $sql->prepare("SELECT password FROM Customer WHERE cid = '$cid'");
		$stmt->execute();
		$stmt->bind_result($hash);
		if($stmt->fetch()){
			if($hash == crypt($password, $hash)){
				$r = 0;
			}else{
				$r = 2;
			}
		}
		Close($sql);
		return $r;
	}
?>