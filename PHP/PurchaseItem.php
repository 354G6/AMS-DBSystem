<?php
	include_once 'Connect.php';

	function PurchaseItemInsert($receiptId, $upc){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO PurchaseItem VALUES ('$receiptId', '$upc')") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function PurchaseItemDelete($upc, $title){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("DELETE FROM PurchaseItem WHERE receiptId = '$receiptId' AND upc = '$upc'") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function PurchaseItemDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT * FROM PurchaseItem");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>