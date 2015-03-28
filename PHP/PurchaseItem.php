<?php
	include 'Connect.php';

	function PurchaseItemInsert($receiptId, $upc){
		$sql = Connect();
		$sql->query("INSERT INTO PurchaseItem VALUES ('$receiptId', '$upc')");
		Close($sql);
	}
	
	function PurchaseItemDelete($upc, $title){
		$sql = Connect();
		$sql->query("DELETE FROM PurchaseItem WHERE receiptId = '$receiptId' AND upc = '$upc'");
		Close($sql);
	}
	
	function PurchaseItemDisplay(){
		$sql = Connect();
		$result = $sql->query("SELECT * FROM PurchaseItem");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>