<?php
	include_once 'Connect.php';

	function ReturnItemInsert($retid, $upc){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO ReturnItem VALUES ('$retid', '$upc')") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function ReturnItemDelete($retid, $upc){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("DELETE FROM ReturnItem WHERE retid = '$retid' AND upc = '$upc'") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function ReturnItemDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT * FROM ReturnItem");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>