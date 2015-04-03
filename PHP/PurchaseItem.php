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
	
	function PurchaseItemDelete($receiptId, $upc){
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
	
	//returns table rows with report info and the total price in last element of array
	function DailyReport($date){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		//$date format must be yyyy-mm-dd
		$result = $sql->query("SELECT upc, category, SUM(price), SUM(quantity) 
							   FROM Item 
							   INNER JOIN PurchaseItem 
							   ON Item.upc=PurchaseItem.upc 
							   INNER JOIN Order 
							   ON PurchaseItem.receiptId=Order.receiptId
							   WHERE DATE(`date`) = '$date';
							   GROUP BY upc");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		$totalPrice = 0;
		for($i = 0; $i < count($table); $i++){
			$totalPrice = $totalPrice + $table[i][2];
		}
		$table[] = $totalPrice;
		return $table;
	}
?>