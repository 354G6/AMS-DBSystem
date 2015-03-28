<?php
	include 'Connect.php';

	function ReturnItemInsert($retid, $upc){
		$sql = Connect();
		$sql->query("INSERT INTO ReturnItem VALUES ('$retid', '$upc')");
		Close($sql);
	}
	
	function ReturnItemDelete($upc, $title){
		$sql = Connect();
		$sql->query("DELETE FROM ReturnItem WHERE retid = '$retid' AND upc = '$upc'");
		Close($sql);
	}
	
	function ReturnItemDisplay(){
		$sql = Connect();
		$result = $sql->query("SELECT * FROM ReturnItem");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>