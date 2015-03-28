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
?>