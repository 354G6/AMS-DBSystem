<?php
	include_once 'Connect.php';

	function ReturnItemInsert($retid, $upc, $quantity){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("INSERT INTO ReturnItem VALUES ('$retid', '$upc', '$quantity')") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	function ReturnItemDelete($retid, $upc){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("DELETE FROM ReturnItem WHERE retid = '$retid' AND upc = '$upc'") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	// returns a 2d array containing data from the ReturnItem table
	function ReturnItemDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM ReturnItem");
		if($result === FALSE){
			echo $sql->error;
		}
		$table = array();
		while($row = mysqli_fetch_assoc($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>