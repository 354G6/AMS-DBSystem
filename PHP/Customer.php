<?php
	include 'Connect.php';

	function CustomerInsert($cid, $password, $name, $address, $phone){
		$sql = Connect();
		$sql->query("INSERT INTO Customer VALUES ('$cid', '$password', '$name', '$address', '$phone')");
		Close($sql);
	}
	
	function CustomerDelete($cid){
		$sql = Connect();
		$sql->query("DELETE FROM Customer WHERE cid = '$cid'");
		Close($sql);
	}
	
	function CustomerDisplay(){
		$sql = Connect();
		$result = $sql->query("SELECT * FROM Customer");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>